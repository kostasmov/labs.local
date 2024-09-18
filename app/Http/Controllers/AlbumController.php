<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Photo;

class AlbumController extends Controller
{
    public function index(): View
    {
        $photos = Photo::photos;
        $titles = Photo::titles;

        return view('album', compact('photos', 'titles'));
    }
}
