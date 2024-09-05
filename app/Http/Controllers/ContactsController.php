<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class ContactsController extends Controller
{
    public function submit(ContactRequest $request)
    {
        return redirect()->back()->with('success', 'Сообщение отправлено!');
    }

    public function index()
    {
        return view('contacts');
    }
}
