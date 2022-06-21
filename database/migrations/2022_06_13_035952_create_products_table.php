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
    Schema::create('products', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->integer('price')->unsigned()->nullable();
      $table->integer('old_price')->unsigned()->nullable();
      $table->unsignedMediumInteger('stock')->nullable();
      $table->string('slug')->nullable()->unique();
      $table->boolean('published')->default(true);
      $table->string('images')->nullable();
      $table->foreignId('category_id')
        ->nullable()
        ->constrained()
        ->nullOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('products', function (Blueprint $table) {
      $table->dropForeign('products_category_id_foreign');
    });

    Schema::dropIfExists('products');
  }
};
