<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Station::all();
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
    public function show(string $line)
    {
        $token = getenv('METRO_LISBOA_TOKEN');

        if (!$token) throw new Exception('The Metro\'s API is required in order to seed the database. '
        . 'Please set the METRO_LISBOA_TOKEN environment variable.');
        $response = Http::withOptions(['verify' => false])
            ->withHeader('Authorization', 'Bearer ' . $token)->acceptJson()
            ->get('https://api.metrolisboa.pt:8243/estadoServicoML/1.0.1/tempoEspera/Linha/' . $line)
            ->json();

        return $response;
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
