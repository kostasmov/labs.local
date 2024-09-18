<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestValidationRequest;
use App\Http\Requests\TestVerificationRequest;

use App\Models\TestResult;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TestController extends Controller
{
    public function index(): View
    {
        $results = TestResult::orderBy('created_at', 'desc')->get();

        return view('test', compact('results'));
    }

    public function submit(TestValidationRequest $request): RedirectResponse
    {
        TestResult::create([
            'full_name' => $request->input('full_name'),
            'course' => $request->input('course'),

            'quest1' => (int) $request->input('quest1'),
            'quest2' => (int) $request->input('quest2'),
            'quest3' => $request->input('quest3'),

            'correct1' => $request->input('quest1') === '2',
            'correct2' => $request->input('quest2') === '3',
            'correct3' => $request->input('quest3') === 'триггер'
        ]);

        app(TestVerificationRequest::class);

        return redirect()->back()->withInput()->with('success', 'Тест успешно пройден!');
    }
}
