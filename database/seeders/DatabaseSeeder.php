<?php

namespace Database\Seeders;

use Database\Seeders\AdminUserTableSeeder;
use Database\Seeders\PermissionTableSeeder;
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
       $this->call([
        PermissionTableSeeder::class,
        AdminUserTableSeeder::class,
       ]);
    }
}
