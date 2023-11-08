<?php

namespace Database\Factories;

use App\Models\Museum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Museum>
 */
class MuseumFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Museum::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'per_ticket_price' => [
                'adult' => $this->faker->numerify,
                'student' => $this->faker->numerify,
                'child' => $this->faker->numerify,
            ],
            'opens_at' => $this->faker->randomElement(['8 AM', '9 AM', '10 AM']),
            'closes_at' => $this->faker->randomElement(['3 PM', '4 PM', '5 PM']),
            'holidays' => $this->faker->randomElement(['SATURDAY-SUNDAY', 'SATURDAY', 'SUNDAY']),
            'address' => $this->faker->address
        ];
    }
}
