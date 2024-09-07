<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestValidationRequest;
use App\Http\Requests\TestVerificationRequest;

class TestController extends Controller
{
    public function submit(TestValidationRequest $request)
    {
        app(TestVerificationRequest::class);

        return redirect()->back()->withInput()->with('success', 'Тест успешно пройден!');
    }

    public function index()
    {
        return view('test');
    }
}
