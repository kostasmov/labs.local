<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestRequest;

class TestController extends Controller
{
    public function submit(TestRequest $request)
    {
        return redirect()->back()->with('success', 'Тест успешно пройден!');
    }

    public function index()
    {
        return view('test');
    }
}
