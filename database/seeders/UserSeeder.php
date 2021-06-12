<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Lucia Bermejo',
            'email' => 'lubersol@gmail.com',
            'password' => Hash::make('1234'),
            'rol' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'Nuria Bermejo',
            'email' => 'nubersol@gmail.com',
            'password' => Hash::make('nubersol'),
            'rol' => 'admin'
        ]);
        DB::table('users')->insert([
            'name' => 'Carlos Bermejo',
            'email' => 'carber@gmail.com',
            'password' => Hash::make('carlangas'),
            'rol' => 'admin'
        ]);
    }
}
