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
      $table->string('name');
      $table->char('type', 10);
      $table->char('value', 250);
      $table->foreignId('product_id')
        ->constrained()
        ->onDelete('cascade');
      });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('filters');
  }
};
