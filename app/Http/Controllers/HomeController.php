<?php

namespace App\Http\Controllers;

use App\Models\Line;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('pages.home', [
            'lines' => Line::all(),
        ]);
    }
}
