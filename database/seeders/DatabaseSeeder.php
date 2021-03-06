<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
//        $this->call(RoleSeeder::class);
//        $this->call(PermissionSeeder::class);
        $this->call(LaratrustSeeder::class);
    }
}
