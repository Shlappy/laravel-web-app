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
        Schema::create('statements', function (Blueprint $table) {
            $table->id();
            $table->date('created_at');
            $table->string('INN', 10);
            $table->string('name');
            $table->integer('debit');
            $table->text('purpose');
            $table->text('comment')->nullable();
            $table->foreignId('tag_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();
            $table->unsignedBigInteger('parent')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statements');
    }
};
