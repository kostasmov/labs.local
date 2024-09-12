<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;

use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function submit(BlogRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
        }

        $message = $request->input('message');
        $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');
        $message = preg_replace('/(\r\n|\r|\n){2}/', '<br><br>', $message);
        $message = preg_replace('/(\r\n|\r|\n)/', '<br>', $message);

        $theme = htmlspecialchars($request->input('theme'), ENT_QUOTES, 'UTF-8');

        Blog::create([
            'theme' => $theme,
            'message' => $message,
            'image' => $imagePath,
        ]);

        return redirect()->route('blog')->with('success', 'Запись добавлена!');
    }

    public function index()
    {
        $posts = Blog::orderBy('created_at', 'desc')->paginate(2);

        return view('blog', compact('posts'));
    }

    public function editor()
    {
        return view('blog-editor');
    }

    public function loader()
    {
        return view('blog-loader');
    }

    public function upload(Request $request)
    {
        $file = $request->file('file');

        if ($file->getSize() == 0) {
            return redirect()->back()->withErrors('Файл пустой');
        }

        $handle = fopen($file->getRealPath(), 'r');

        $blogs = [];
        $i = 0;

        while (($fields = fgetcsv($handle, 0)) !== false) {
            $i++;
            if ($i === 1) continue;

            if (count($fields) < 5) {
                return redirect()->back()->withErrors("Ошибка в структуре файла на строке $i");
            }

            $data = [
                'theme' => $fields[1],
                'message' => $fields[2],
                'image' => !($fields[3] == 'NULL') ? $fields[3] : null
            ];

            $rules = [
                'theme' => 'required|string|max:100',
                'message' => 'required|max:1000',
                'image' => 'nullable|string'
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors("Ошибка валидации файла");
            }

            $blogs[] = $data;
        }

        fclose($handle);

        foreach ($blogs as $blogData) {
            Blog::create($blogData);
        }

        return redirect()->route('blog')->with('success', 'Данные успешно загружены');
    }
}
