<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\BlogRequest;

use App\Models\Blog;
use App\Models\Comment;

use Illuminate\Support\Facades\Validator;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BlogController extends Controller
{
    public function index(): View
    {
        $posts = Blog::orderBy('created_at', 'desc')->paginate(2);

        return view('blog', compact('posts'));
    }

    public function editor(): View
    {
        return view('blog-editor');
    }

    public function loader(): View
    {
        return view('blog-loader');
    }

    public function submit(BlogRequest $request): RedirectResponse
    {
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
        }

        $message = base64_encode($request->input('message'));
        $theme = base64_encode($request->input('theme'));

        Blog::create([
            'theme' => $theme,
            'message' => $message,
            'image' => $imagePath,
        ]);

        return redirect()->route('blog')->with('success', 'Запись добавлена!');
    }

    public function comment_submit(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'postID' => 'required|exists:blogs,id',
            'comment' => 'required|max:500',
            'userID' => 'required|exists:users,id'
        ]);

        $comment = new Comment();
        $comment->blog_id = $validated['postID'];
        $comment->comment = base64_encode($validated['comment']);
        $comment->user_id = $validated['userID'];

        $comment->save();

        return response()->json([
            'blog_id' => $comment->blog_id,
            'created_at' => $comment->created_at->format('d.m.Y H:i'),
            'user_name' => $comment->user->name,
            'comment_text' => nl2br(e($validated['comment']))
        ]);
    }

    public function upload(Request $request): RedirectResponse
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
                'theme' => 'required|string',
                'message' => 'required',
                'image' => 'nullable|string'
            ];

            $validator = Validator::make($data, $rules);

            if ($validator->fails()) {
                return redirect()->back()->withErrors("Ошибка валидации данных");
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
