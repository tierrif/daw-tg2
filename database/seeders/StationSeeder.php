<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class StationSeeder extends Seeder
{
    /**
     * Retrieve the stations from the Metro's API.
     * This requires the token to be defined in the application's
     * environment. Either define the token in .env or set it on
     * the system's environment variables.
     */
    public function run(string $token): void
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeader('Authorization', $token)->acceptJson()
            ->get('https://api.metrolisboa.pt:8243/estadoServicoML/1.0.1/infoEstacao/todos')
            ->json()['resposta'];
    
        foreach ($response as $station) {
            DB::table('stations')->insert([
                'displayName' => $station['stop_name'],
                'stringId' => $station['stop_id'],
            ]);
        }
    }
}
