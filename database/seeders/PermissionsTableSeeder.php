<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'title' => 'management_access',
            ],

            [
                'title' => 'management_user_access',
            ],


        ];


        Permission::insert($permissions);
    }
}
