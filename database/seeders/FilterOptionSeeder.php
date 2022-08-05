<?php declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Filters\FilterOption;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FilterOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('filters')->truncate();
        DB::table('filter_options')->truncate();
        DB::table('filter_option_product')->truncate();
        Schema::enableForeignKeyConstraints();

        // Fill filter_options and filters tables
        $filterOptions = FilterOption::factory()
            ->count(500)
            ->create();

        // Fill pivot table
        $filterOptions->each(function (Model $item) {
            $product = Product::inRandomOrder()->firstOrFail();
            $item->category_id = $product->category_id;
            $item->save();

            if ($item) {
                $item->products()->attach($product->id);
            }

            // Fill category_filter table (or in Filters?)

        });
    }
}
