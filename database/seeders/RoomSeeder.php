<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rooms')->insert([
            'title' => "Habitación doble",
            'price' => "120€ x noche",
            'description' => "Habitación con dos camas individuales, aire acondicionado, wifi gratuito y baño propio. ",
            'image' => "https://1drv.ms/u/s!AveYy8HMu9oj-w1xh7gUFp0c4pnc"
        ]);
        DB::table('rooms')->insert([
            'title' => "Habitación matrimonio",
            'price' => "120€ x noche",
            'description' => "Habitación con una cama de matrimonio, aire acondicionado, wifi gratuito y baño propio",
            'image' => "https://1drv.ms/u/s!AveYy8HMu9oj-wyXxm0FQ2G-bxAf"
        ]);
        DB::table('rooms')->insert([
            'title' => "Dos habitaciones",
            'price' => "240€ x noche",
            'description' => "Dos habitaciones con baño propio cada una, aire acondicionado y wifi gratuito",
            'image' => "https://1drv.ms/u/s!AveYy8HMu9oj-wv18ZMuoKsaXbgm"
        ]);
        DB::table('rooms')->insert([
            'title' => "Finca completa",
            'price' => "400€ x noche",
            'description' => "La finca completa incluye piscina exterior, aparcamiento, terraza amplia, aire acondicionado, wifi gratuito, desayuno incluido, recepción 24h",
            'image' => "https://1drv.ms/u/s!AveYy8HMu9oj-w50pMBoJV-s-anD"
        ]);

    }
}
