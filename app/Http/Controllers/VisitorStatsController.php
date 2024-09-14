<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;

class VisitorStatsController extends Controller
{
    public function index()
    {
        $visits = Visitor::orderBy('visited_at', 'desc')->paginate(6);

        return view('visitor-stats', compact('visits'));
    }
}
