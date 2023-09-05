<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
     
        return [    
            'title' => fake()->jobTitle(),
            'content' => fake()->paragraph(),
            'image' => fake()->imageUrl(),
            'user_id' => User::factory()
         

        ];
    }
}
