<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Interest;

class InterestsController extends Controller
{
    public function index(): View
    {
        $films = Interest::films;
        $albums = Interest::albums;
        $seasons = Interest::seasons;

        return view('interests', compact('films', 'albums', 'seasons'));
    }
}
