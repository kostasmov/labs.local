<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\GuestbookRequest;

use Illuminate\Support\Facades\Storage;
use DateTime;

class GuestbookController extends Controller
{
    public function submit(GuestbookRequest $request)
    {
        $validated = $request->validated();
        $currentDateTime = (new DateTime())->format('d.m.Y H:i:s');
        $filePath = 'messages/messages.inc';

        $formattedMessage = "{$validated['last_name']};{$validated['first_name']};" .
            ($request['patronym'] ?? '') .
            ";{$validated['mail']};" . base64_encode($validated['message']) .
            ";{$currentDateTime}";

        if (Storage::size($filePath) == 0) {
            Storage::put($filePath, $formattedMessage);
        } else {
            Storage::append($filePath, $formattedMessage);
        }

        return redirect()->back()->with('success', 'Отзыв отправлен!');
    }

    public function index()
    {
        $filePath = 'messages/messages.inc';
        $messages = [];

        if (Storage::size($filePath) > 0) {
            $lines = Storage::get($filePath);
            $lines = preg_split('/\r\n|\r|\n/', trim($lines));

            foreach ($lines as $line) {
                $fields = explode(';', $line);
                $messages[] = [
                    'name' => $fields[0] . ' ' . $fields[1] . ' ' . ($fields[2] ?? ''),
                    'email' => $fields[3],
                    'message' => base64_decode($fields[4]),
                    'date' => DateTime::createFromFormat('d.m.Y H:i:s', $fields[5])
                ];
            }

            usort($messages, function ($a, $b) {
                return $b['date'] <=> $a['date'];
            });
        }

        return view('guestbook', ['messages' => $messages]);
    }

    public function loader()
    {
        return view('guestbook-loader');
    }

    public function upload(Request $request)
    {
        $filePath = $request->file('file')->getRealPath();
        $fileContent = file_get_contents($filePath);
        $lines = preg_split('/\r\n|\r|\n/', trim($fileContent));

        foreach ($lines as $line) {
            $fields = explode(';', $line);

            if (count($fields) < 6 || DateTime::createFromFormat('d.m.Y H:i:s', $fields[5]) === false) {
                return redirect()->back()->withErrors('ОШИБКА: неверный формат данных');
            }
        }

        Storage::put('messages/messages.inc', $fileContent);

        return redirect()->route('guestbook')->with('success', 'Данные успешно загружены');
    }
}
