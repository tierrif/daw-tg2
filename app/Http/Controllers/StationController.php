<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StationController extends Controller
{
    public function index()
    {
        return Station::all();
    }

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
}
