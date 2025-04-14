<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AddressDetails;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AddressDetails>
 */
class AddressDetailsFactory extends Factory
{
    protected $model = AddressDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'   => User::factory(),
            'address'   => $this->faker->streetAddress(),
            'city'      => $this->faker->city(),
            'zip_code'  => $this->faker->postcode(),
            'country'   => $this->faker->country(),
        ];
    }
}
