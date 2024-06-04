<?php

use Database\Seeders\AdminSeeder;
use Database\Seeders\AppointmentSeeder;
use Database\Seeders\SuperAdminSeeder;
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
        $this->call(AppointmentSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SuperAdminSeeder::class);
    }
}
