<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Interest;

class InterestsController extends Controller
{
    public function index()
    {
        $films = Interest::films;
        $albums = Interest::albums;
        $seasons = Interest::seasons;

        return view('interests', compact('films', 'albums', 'seasons'));
    }
}
