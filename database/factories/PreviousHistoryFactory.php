<?php

namespace Database\Factories;

use App\Models\PreviousHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PreviousHistory>
 */
class PreviousHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = PreviousHistory::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->name,
            'link' => $this->faker->url,
            'id' => $this->faker->uuid,
            'budget' => $this->faker->numerify,
            'searched_at' => $this->faker->dateTime,
            'location' => $this->faker->randomElement(["Turku", "Helsinki", "Rauma", "Pori"])
        ];
    }
}
