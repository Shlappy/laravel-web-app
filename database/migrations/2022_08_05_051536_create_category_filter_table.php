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
        Schema::create('category_filter', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('filter_id')->constrained()->cascadeOnDelete();
            $table->unsignedInteger('sort')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_filter', function (Blueprint $table) {
            $table->dropForeign('category_filter_category_id_foreign');
            $table->dropForeign('category_filter_filter_id_foreign');
        });

        Schema::dropIfExists('category_filter');
    }
};
