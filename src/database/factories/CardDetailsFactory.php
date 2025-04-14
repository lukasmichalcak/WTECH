<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\CardDetails;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardDetails>
 */
class CardDetailsFactory extends Factory
{
    protected $model = CardDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'           => User::factory(),
            'number'            => $this->faker->creditCardNumber(),
            'expiration_date'   => $this->faker->creditCardExpirationDate(),
            'cv'                => (string) $this->faker->numberBetween(100, 999),
        ];
    }
}
