<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $service_type = ['New', 'Renewal', 'Payment'];
        $service_name = ['Business Permit Application', 'Business Permit Renewal', 'Payment of Business Permit'];
        $offices = ['BLPD', 'CSWDO'];
        $status = ['Completed', 'Pending', 'In Progress', 'Rejected'];

        foreach (range(1, 100) as $index) {
            \DB::table('appointments')->insert([
                'service_name' => $service_name[array_rand($service_name)],
                'service_type' => $service_type[array_rand($service_type)],
                'office' => $offices[array_rand($offices)],
                'status' => $status[array_rand($status)],
                'booked_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),

            ]);
        }

        // Add more tables and data as needed
    }
}