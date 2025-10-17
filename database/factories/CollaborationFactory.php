<?php

namespace Database\Factories;

use App\Models\Collaboration;
use App\Models\Company;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollaborationFactory extends Factory
{
    protected $model = Collaboration::class;

    public function definition(): array
    {
        return [
            'company_id' => Company::factory(),
            'collaborator_id' => Company::factory(),
            'city_id' => City::factory(),
            'collaboration_date' => $this->faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
            'status' => $this->faker->randomElement(['active', 'pending', 'completed', 'canceled']),
        ];
    }
}
