<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('logs_tipos')->insert([
            ['tipo' => 1, 'name' => 'Error', 'name_eng' => 'Error'],
            ['tipo' => 2, 'name' => 'Warning', 'name_eng' => 'Warning'],
        ]);

        DB::table('roles')->insert([
            ['name' => 'Admin', 'guard_name' => 'web', 'status' => 'active', 'created_at' => now()],
            ['name' => 'User', 'guard_name' => 'web', 'status' => 'active', 'created_at' => now()],
        ]);

        DB::table('permissions')->insert([
            ['name' => 'view', 'guard_name' => 'web', 'ordem' => 1, 'created_at' => now()],
            ['name' => 'edit', 'guard_name' => 'web', 'ordem' => 2, 'created_at' => now()],
        ]);

        DB::table('users')->insert([
            [
                'empresa' => 0,
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('123'),
                'status' => 'active',
                'is_master' => 1,
                'created_at' => now(),
            ],
        ]);
    }
}
