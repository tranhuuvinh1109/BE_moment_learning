<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CourseFactory extends Factory
{
    protected $model = Course::class;

		public function definition()
    {
        return [
            'name' => $this->faker->sentence,
            'teacher' => User::factory()->create()->id,
            'category' => Category::factory()->create()->id,
            'price' => $this->faker->randomFloat(2, 10, 100),
            'description' => $this->faker->paragraph,
            'image' => 'path/to/your/image.jpg',
            'total_star' => $this->faker->numberBetween(1, 5),
            'created_at' => now(),
        ];
    }
}
