<?php

namespace App\Http\Controllers;

use App\Models\Line;
use App\Models\Station;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function PHPUnit\Framework\isEmpty;


class FrequentUserController extends Controller
{
    public function index()
    {
        $user = Auth::getUser();
        $name = $user['name'];
        $lines = Line::all();
        $balance = $user['balance'];
        $frequentStations = User::with('stations')->get()->firstWhere('email', $user['email'])['stations'];
        $allStations = Station::all()->toArray();
        $filterStations = [];
        $frequentStationsArr = User::with('stations')->get()->firstWhere('email', $user['email'])->toArray()['stations'];
        foreach ($allStations as $s){
            $asStation = array_filter($frequentStationsArr, function ($f) use ($s) {
                return $f['id'] == $s['id'];
            });
            //echo (count($asStation) == 0);
            if(count($asStation) === 0)
                array_push($filterStations, $s);
        }
        return view('pages.frequent-user', ['username' => $name, 'userId' => $user['id'], 'lines' => $lines,
            'balance' => $balance, 'frequentStations' => $frequentStations, 'allStations' => $filterStations]);
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
