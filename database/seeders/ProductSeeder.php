<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Add category id
    // $products = Product::all();
    // foreach ($products as $product) {
    //   $product->category_id = \App\Models\Category::inRandomOrder()->first()->id;
    //   $product->save();
    // }

    // Main
    // Schema::disableForeignKeyConstraints();
    // DB::table('products')->truncate();
    // Schema::enableForeignKeyConstraints();

    // Product::factory()
    //   ->count(130)
    //   ->create();
  }
}
