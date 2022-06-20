<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CategoryFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $parent_id = Category::inRandomOrder()->first();

    return [
      'name' => $this->faker->name(),
      'parent_id' => rand(0, 1) === 1 && !is_null($parent_id) ? $parent_id->id : null
    ];
  }
}
