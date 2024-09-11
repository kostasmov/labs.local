<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestValidationRequest;
use App\Http\Requests\TestVerificationRequest;

use App\Models\TestResult;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function submit(TestValidationRequest $request)
    {
        TestResult::create([
            'full_name' => $request->input('full_name'),
            'course' => $request->input('course'),

            'quest1' => (int) $request->input('quest1'),
            'quest2' => (int) $request->input('quest2'),
            'quest3' => (int) $request->input('quest3'),

            'correct1' => $request->input('quest1') === '2',
            'correct2' => $request->input('quest1') === '3',
            'correct3' => $request->input('quest1') === 'триггер'
        ]);

        app(TestVerificationRequest::class);

        return redirect()->back()->withInput()->with('success', 'Тест успешно пройден!');
    }

    public function index()
    {
        return view('test');
    }
}
