<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'administrador';
        $role->display_name = 'Administrador';
        $role->save();

        $role = new Role();
        $role->name = 'consultor';
        $role->display_name = 'Consultor';
        $role->save();
    }
}
