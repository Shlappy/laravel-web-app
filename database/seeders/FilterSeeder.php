<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Filter;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class FilterSeeder extends Seeder
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
    Schema::enableForeignKeyConstraints();

    Filter::factory()
      ->count(300)
      ->create();
  }
}
