<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $administrator_permissions  = Permission::all();

        Role::findOrFail(1)->permissions()->sync($administrator_permissions ->pluck('id'));

        

    }
}
