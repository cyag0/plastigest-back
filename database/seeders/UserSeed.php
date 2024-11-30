<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Cesar Yahir',
            'last_name' => 'Alarcon Gaspar',
            'email' => 'cyag.cesar@gmail.com',
            'password' => bcrypt('1234'),
        ]);
    }
}
