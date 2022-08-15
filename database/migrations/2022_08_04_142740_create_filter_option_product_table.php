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
        Schema::create('filter_option_product', function (Blueprint $table) {
            $table->foreignId('filter_option_id')->constrained('filter_options')->cascadeOnDelete();
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
        Schema::table('filter_option_product', function (Blueprint $table) {
            $table->dropForeign('filter_option_product_filter_option_id_foreign');
            $table->dropForeign('filter_option_product_product_id_foreign');
        });

        Schema::dropIfExists('filter_option_product');
    }
};
