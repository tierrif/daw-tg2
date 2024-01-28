<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         * Create by default an admin account
         */
        DB::table('users')->insert([
            'name' => 'Francisco Adm',
            'email' => 'jose20fernandes03@admin.com',
            'password' => '$2y$12$gpagzgS7ZsiwXabsWG6BnepIIyYTq3Oyrl/fzp.Cmonm/7hFC2cqm',
            'permissions' => true,
            'balance' => 0,
        ]);
    }
}
