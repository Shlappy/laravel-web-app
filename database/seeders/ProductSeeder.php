<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::cleanDirectory(storage_path('app/public/images/products'));

        Schema::disableForeignKeyConstraints();
        DB::table('products')->truncate();
        Schema::enableForeignKeyConstraints();

        Product::factory()
            ->count(120)
            ->create();
    }
}
