<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    protected $model = Restaurant::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->company . ' ' . $this->faker->word,
            'description' => $this->faker->paragraph(2),
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'cuisine_type' => $this->faker->randomElement(['Italienne', 'Française', 'Japonaise', 'Marocaine', 'Indienne', 'Mexicaine', 'Végétarienne']),
            'capacity' => $this->faker->numberBetween(20, 120),
            'phone' => $this->faker->phoneNumber,
            'image' => 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?auto=format&fit=crop&w=800&q=80',
        ];
    }
}
