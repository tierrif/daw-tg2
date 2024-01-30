<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use PHPUnit\Logging\Exception;

class LineController extends Controller
{
    public function index()
    {
        $token = getenv('METRO_LISBOA_TOKEN');

        if (!$token) throw new Exception('The Metro\'s API is required. '
            . 'Please set the METRO_LISBOA_TOKEN environment variable.');
        $response = Http::withOptions(['verify' => false])
            ->withHeader('Authorization', 'Bearer ' . $token)->acceptJson()
            ->get('https://api.metrolisboa.pt:8243/estadoServicoML/1.0.1/estadoLinha/todos')
            ->json();

        return $response;
    }
}
