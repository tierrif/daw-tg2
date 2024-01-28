<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\Station;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FrequentUserController extends Controller
{
    public function index()
    {
        $user = Auth::getUser();
        $name = $user['name'];
        $lines = Line::all();
        $balance = $user['balance'];
        $stations = User::with('stations')->get()->firstWhere('email', $user['email'])['stations'];
        return view('pages.frequent-user', ['username' => $name, 'userId' => $user['id'], 'lines' => $lines,
            'balance' => $balance, 'frequentStations' => $stations, 'allStations' => Station::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
