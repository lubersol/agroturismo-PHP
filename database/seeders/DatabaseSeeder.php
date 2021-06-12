<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\Room::factory(10)->create();

        //Rooms Seed
        $this->call(RoomSeeder::class);
        $this->call(UserSeeder::class);

    }

    
}
