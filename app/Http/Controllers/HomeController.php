<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\Station;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('pages.home', [
            'lines' => Line::all(),
            'stations' => Station::with('lines')->get(),
        ]);
    }
}
