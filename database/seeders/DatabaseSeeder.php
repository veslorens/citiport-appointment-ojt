<?php

use Database\Seeders\AdminSeeder;
use Database\Seeders\SuperAdminSeeder;
use Database\Seeders\AppointmentSeeder;
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
        $this->call(AdminSeeder::class);
        $this->call(AppointmentSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SuperAdminSeeder::class);
        $this->call(SuperAdminSeeder::class);
    }
}
