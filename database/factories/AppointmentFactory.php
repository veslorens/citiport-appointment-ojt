<?php

namespace Database\Factories;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Appointment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $service_names = ['Business Permit Application', 'Business Permit Renewal', 'Payment of Business Permit'];
        $service_types = ['New', 'Renewal', 'Payment'];
        $offices = ['BLPD', 'CSWDO'];
        $status = ['Completed', 'Pending', 'In Progress', 'Rejected'];

        return [
            'service_name' => $this->faker->randomElement($service_names),
            'service_type' => $this->faker->randomElement($service_types),
            'office' => $this->faker->randomElement($offices),
            'status' => $this->faker->randomElement($status),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
