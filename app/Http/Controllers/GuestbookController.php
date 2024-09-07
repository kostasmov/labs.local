<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestbookController extends Controller
{
    public function index()
    {
        return view('guestbook');
    }
}
