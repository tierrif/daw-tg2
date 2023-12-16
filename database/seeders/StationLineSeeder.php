<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class StationLineSeeder extends Seeder
{
    /**
     * Joins Stations to Lines by checking their connection
     * on the Metro API. 
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
            // Parse the array as it's in a string format in the response.
            $parsedLineArray = $this->_parseArray($station['linha']);
            // Replace the line names by their string ID equivalent.
            $parsedLineArray = array_map(fn ($line) => strtolower($line), $parsedLineArray);

            foreach ($parsedLineArray as $line) {
                // Get the database IDs for the station and the line so it's added to the N-N relationship table.
                $stationId = DB::table('stations')->where('stringId', 'LIKE', $station['stop_id'])->first()->id;
                $lineId = DB::table('lines')->where('stringId', 'LIKE', $line)->first()->id;

                // Insert this composite primary key pair.
                DB::table('stationlines')->insert([
                    'stationId' => $stationId,
                    'lineId' => $lineId,
                ]);
            }
        }
    }

    private function _parseArray(string $unparsedArray)
    {
        // Remove brackets and trim the unparsed array so it turns into a comma-separated format.
        $commaSeparatedValues = substr($unparsedArray, 1, strlen($unparsedArray) - 2);

        // Split them by the commas (and the additional space).
        return explode(', ', $commaSeparatedValues);
    }
}
