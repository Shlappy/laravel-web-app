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
        Schema::create('filters', function (Blueprint $table) {
            $table->id();
            $table->uuid('product_id');
            $table->string('value');
            $table->string('code');
            $table->foreignId('specs_id')
                ->constrained('filter_specs')
                ->cascadeOnDelete();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filters', function (Blueprint $table) {
            $table->dropForeign('filters_category_id_foreign');
            $table->dropForeign('filters_product_id_foreign');
            $table->dropForeign('filters_specs_id_foreign');
        });

        Schema::dropIfExists('filters');
    }
};
