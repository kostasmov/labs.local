<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TestValidationRequest;
use App\Http\Requests\TestVerificationRequest;

class TestController extends Controller
{
    public function submit(Request $request)
    {
        $hasQuest1 = $request->filled('quest1');
        $hasQuest2 = $request->filled('quest2');
        $hasQuest3 = $request->filled('quest3');

        if ($hasQuest1 && $hasQuest2 && $hasQuest3) {
            app(TestVerificationRequest::class);
        } else {
            app(TestValidationRequest::class);
        }

        return redirect()->back()->withInput()->with('success', 'Тест успешно пройден!');
    }

    public function index()
    {
        return view('test');
    }
}
