<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\AddressDetails;
use App\Models\CardDetails;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name'  => $this->faker->lastName(),
            'email'      => $this->faker->unique()->safeEmail(),
            'username'   => $this->faker->unique()->userName(),
            'password'   => $this->faker->password(),
            'is_admin'   => false,
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            AddressDetails::factory()->count(1)->create([
                'user_id' => $user->id,
            ]);

            CardDetails::factory()->count(2)->create([
                'user_id' => $user->id,
            ]);
        });
    }

    public function admin(): static
    {
        return $this->state(fn () => [
            'is_admin' => true,
        ]);
    }
}
