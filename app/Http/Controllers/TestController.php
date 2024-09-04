<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestRequest;

class TestController extends Controller
{
    public function submit(TestRequest $request)
    {
//        dd($request->all());
        return redirect()->back(); //->with('success', 'Данные успешно отправлены!');
    }

    public function index()
    {
        return view('test');
    }
}
