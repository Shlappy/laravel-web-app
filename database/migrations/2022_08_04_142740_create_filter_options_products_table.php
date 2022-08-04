<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_options_products', function (Blueprint $table) {
            $table->foreignId('filter_options_id')->constrained('filter_options')->cascadeOnDelete();
            $table->foreignUuid('product_id')->constrained('products')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filter_options_products', function (Blueprint $table) {
            $table->dropForeign('filter_options_products_filter_options_id_foreign');
            $table->dropForeign('filter_options_products_product_id_foreign');
        });

        Schema::dropIfExists('filter_options_products');
    }
};
