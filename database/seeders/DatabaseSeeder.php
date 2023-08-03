<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        \App\Models\Status::factory()->create(['name' => 'Upcoming',    'color' => '0']);
        \App\Models\Status::factory()->create(['name' => 'Processing', 'color' => '1']);
        \App\Models\Status::factory()->create(['name' => 'Completed',  'color' => '9']);

        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            PermissionRoleTableSeeder::class,
            RoleUserTableSeeder::class,

        ]);

    }


}
