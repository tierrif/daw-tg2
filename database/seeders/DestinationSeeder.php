<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DestinationSeeder extends Seeder
{
    /**
     * Retrieve the destinations from the Metro's API.
     * This requires the token to be defined in the application's
     * environment. Either define the token in .env or set it on
     * the system's environment variables.
     */
    public function run(string $token): void
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeader('Authorization', $token)->acceptJson()
            ->get('https://api.metrolisboa.pt:8243/estadoServicoML/1.0.1/infoDestinos/todos')
            ->json()['resposta'];

        foreach ($response as $destination) {
            DB::table('destinations')->insert([
                'displayName' => $destination['nome_destino'],
                'apiId' => $destination['id_destino'],
            ]);
        }
    }
}
