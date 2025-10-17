<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Collaboration;
use App\Models\Company;
use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class SampleDataSeeder extends Seeder
{
    public function run(): void
    {
        // Create a few countries with cities
        $countries = Country::factory()->count(4)->create();

        // Ensure each country has some cities
        $countries->each(function ($country) {
            City::factory()->count(rand(3, 6))->create([
                'country_id' => $country->id,
            ]);
        });

        // Create companies mapped to existing countries
        $countries->each(function ($country) {
            Company::factory()->count(rand(3, 6))->create([
                'country_id' => $country->id,
            ]);
        });

        $companies = Company::all();
        $cities = City::all();

        // Generate collaborations
        $records = [];
        for ($i = 0; $i < 60; $i++) {
            $a = $companies->random();
            $b = $companies->where('id', '!=', $a->id)->random();
            $city = $cities->random();

            $records[] = [
                'company_id' => $a->id,
                'collaborator_id' => $b->id,
                'city_id' => $city->id,
                'collaboration_date' => now()->subDays(rand(0, 365))->format('Y-m-d'),
                'status' => Arr::random(['active', 'pending', 'completed', 'canceled']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Collaboration::insert($records);
    }
}
