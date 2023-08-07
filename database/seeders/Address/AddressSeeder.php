<?php

namespace Database\Seeders\Address;

use App\Models\User;
use App\Models\Address;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AddressSeeder extends Seeder
{
    public function run(): void
    {
        User::pluck('id')->each(function ($userId) {
            Address::factory()->count(3)->create([
                'user_id' => $userId,
                'title' => fake()->word(),
                'street' => fake()->streetAddress(),
                'postal_code' => fake()->postcode(),
            ]);
        });
    }
}
