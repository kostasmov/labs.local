<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactsController extends Controller
{
    public function index(): View
    {
        return view('contacts');
    }

    public function submit(ContactRequest $request): RedirectResponse
    {
        return redirect()->back()->with('success', 'Сообщение отправлено!');
    }
}
