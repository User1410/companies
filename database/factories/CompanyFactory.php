<?php

namespace Database\Factories;

use App\Services\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company(),
            'email' => $this->faker->safeEmail(),
            'logo' => Service::getRandomImage('public', 100, 100), //$faker->image doesn't work
            'website' => $this->faker->url()
        ];
    }
}
