<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new Service();
        $service->name = 'Asesoria Visa Americana';
        $service->price = 180.000;
        $service->commission = 50.000;
        $service->save();

        $service = new Service();
        $service->name = 'Asesoria Visa Canada';
        $service->price = 280.000;
        $service->commission = 60.000;
        $service->save();

        $service = new Service();
        $service->name = 'Derecho Consular Visa Americana';
        $service->price = 700.000;
        $service->commission = 20.000;
        $service->save();

        $service = new Service();
        $service->name = 'Derecho Consular Visa Canadience';
        $service->price = 630.000;
        $service->commission = 20.000;
        $service->save();

        $service = new Service();
        $service->name = 'Cambio de Formularios';
        $service->price = 60.000;
        $service->commission = 10.000;
        $service->save();
    }
}
