<?php

namespace Database\Seeders;

use App\Models\Zone;
use Illuminate\Database\Seeder;

class ZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zone = new Zone();
        $zone->name = 'Bogota';
        $zone->save();

        $zone = new Zone();
        $zone->name = 'Medellin';
        $zone->save();

        $zone = new Zone();
        $zone->name = 'Pereira';
        $zone->save();

        $zone = new Zone();
        $zone->name = 'Santander';
        $zone->save();


    }
}
