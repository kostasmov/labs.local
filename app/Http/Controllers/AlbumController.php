<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Photo;

class AlbumController extends Controller
{
    public function index()
    {
        $photos = Photo::photos;
        $titles = Photo::titles;

        return view('album', compact('photos', 'titles'));
    }
}
