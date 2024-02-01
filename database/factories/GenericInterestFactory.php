<?php

namespace Database\Factories;

use App\Models\GenericInterest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GenericInterest>
 */
class GenericInterestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = GenericInterest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $random = $this->faker->randomElement(
            [
                ['title' => 'Nature', 'icon' => 'mdi-nature'],
                ['title' => 'Nightlife', 'icon' => 'mdi-glass-wine'],
                ['title' => 'November', 'icon' => 'mdi-calendar-range'],
                ['title' => 'Portland', 'icon' => 'mdi-map-marker'],
                ['title' => 'Biking', 'icon' => 'mdi-bike'],
            ]
        );

        return [
            'title' => $random['title'],
            'icon' => $random['icon'],
        ];
    }
}
