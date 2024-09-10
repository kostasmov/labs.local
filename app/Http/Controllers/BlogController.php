<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;

use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function submit(BlogRequest $request)
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
        }

        Blog::create([
            'theme' => $request->input('theme'),
            'message' => $request->input('message'),
            'image' => $imagePath,
        ]);

        return redirect()->route('blog')->with('success', 'Запись добавлена!');
    }

    public function index()
    {
        $posts = Blog::orderBy('created_at', 'desc')->get();

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
        $lines = file($file->getRealPath());

        if ($file->getSize() == 0) {
            return redirect()->back()->withErrors('Файл пустой');
        }

        foreach ($lines as $lineNumber => $line) {
            if ($lineNumber === 0) continue;

            $row = explode(';', $line);

            if (count($row) < 4 || empty($row[1]) || empty($row[2]) || empty($row[3])) {
                return redirect()->back()->withErrors('Ошибка в структуре файла');
            }

            Blog::create([
                'theme' => $row[1],
                'message' => $row[2],
                'image' => !($row[3] == 'NULL') ? $row[3] : null
            ]);
        }

        return redirect()->route('blog')->with('success', 'Данные успешно загружены');
    }
}
