<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition()
  {
    $price = rand(100, 1000000);
    $oldPrice = null;
    if ($this->randomFloat(0, 1) > 0.5) $oldPrice = $price * $this->randomFloat(0.3);

    return [
      'name' => $this->faker->name(),
      'price' => $price,
      'old_price' => $oldPrice,
      'stock' => rand(0, 50000),
      'images' => json_encode($this->randomImages()),
    ];
  }

  public function randomFloat($min = 0, $max = 1)
  {
    return $min + mt_rand() / mt_getrandmax() * ($max - $min);
  }

  /**
   * @return array Array of images
   */
  public function randomImages()
  {
    $images = [];
    $count = rand(0, 0);
    for ($i = 0; $i <= $count; $i++) {
      $images[] = $this->faker->image(storage_path('app/public/images/products'), 200, 200, false);
    }

    return $images;
  }
}
