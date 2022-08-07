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
        Schema::create('filter_options', function (Blueprint $table) {
            $table->id();
            $table->string('string_value')->nullable();
            $table->integer('numeric_value')->nullable();
            $table->string('slug');

            $table->foreignId('filter_id')
                ->constrained('filters')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('filter_options', function (Blueprint $table) {
            $table->dropForeign('filter_options_category_id_foreign');
            $table->dropForeign('filter_options_filter_id_foreign');
        });

        Schema::dropIfExists('filter_options');
    }
};
