<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class LineSeeder extends Seeder
{
    /**
     * Retrieve the lines from the Metro's API.
     * This requires the token to be defined in the application's
     * environment. Either define the token in .env or set it on
     * the system's environment variables.
     */
    public function run(string $token): void
    {
        $response = Http::withOptions(['verify' => false])
            ->withHeader('Authorization', $token)->acceptJson()
            ->get('https://api.metrolisboa.pt:8243/estadoServicoML/1.0.1/estadoLinha/todos')
            ->json()['resposta'];

        foreach ($response as $line => $state) {
            if (str_starts_with($line, 'tipo_')) continue;

            DB::table('lines')->insert([
                'displayName' => $this->_capitalize($line),
                'stringId' => $line,
            ]);
        }
    }

    private function _capitalize(string $str)
    {
        return strtoupper($str[0]) . substr(strtolower($str), 1);
    }
}
