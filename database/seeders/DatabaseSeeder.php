<?php

namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $token = getenv('METRO_LISBOA_TOKEN');

        if (!$token) throw new Exception('The Metro\'s API is required in order to seed the database. '
            . 'Please set the METRO_LISBOA_TOKEN environment variable.');

        $token = 'Bearer ' . $token;

        $this->call(StationSeeder::class, false, ['token' => $token]);
        $this->call(LineSeeder::class, false, ['token' => $token]);
        $this->call(DestinationSeeder::class, false, ['token' => $token]);
        $this->call(StationLineSeeder::class, false, ['token' => $token]);
        $this->call(UserSeeder::class, false);
    }
}
