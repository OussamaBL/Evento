<?php

namespace Database\Factories;

use App\Models\Event;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Event>
 */
class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'place' => fake()->word(),
            'title' => fake()->sentence(),
            'price' => fake()->numberBetween(10, 100),
            'duration' => fake()->numberBetween(1, 24),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['accepted', 'refused', 'pending']),
            'acceptance' => fake()->randomElement(['auto', 'manual']),
            'nbr_place' => fake()->numberBetween(50, 500),
            'place_dispo' => fake()->numberBetween(0, 50),
            'date_event' => fake()->date,
            'user_id' => function () {
                $user = User::factory()->create();
                $user->assignRole('organizer');
                return $user->id;
            },
            'category_id' => 3,
            'created_at' => fake()->dateTimeBetween('-2 years', 'now'),
            'updated_at' => fake()->dateTimeBetween('-2 years', 'now'),
        ];
    }
}
