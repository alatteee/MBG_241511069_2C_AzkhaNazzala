<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('user')->insert([

            // Akun Gudang
            [
                'name' => 'Gudang C',
                'email' => 'gudang.c@mbg.id',
                'password' => Hash::make('gudang123'),
                'role' => 'gudang',
                'created_at' => now(),
            ],
            [
                'name' => 'Gudang B',
                'email' => 'gudang.b@mbg.id',
                'password' => Hash::make('gudang123'),
                'role' => 'gudang',
                'created_at' => now(),
            ],

            // Akun Dapur
            [
                'name' => 'Dapur A',
                'email' => 'dapur.a@mbg.id',
                'password' => Hash::make('dapur123'),
                'role' => 'dapur',
                'created_at' => now(),
            ],
            [
                'name' => 'Dapur B',
                'email' => 'dapur.b@mbg.id',
                'password' => Hash::make('dapur123'),
                'role' => 'dapur',
                'created_at' => now(),
            ],

        ]);
    }
}
