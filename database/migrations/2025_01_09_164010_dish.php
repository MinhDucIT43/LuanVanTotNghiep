<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dish', function (Blueprint $table) {
            $table->id();
            $table->string('nameDish',70);
            $table->integer('price');
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('typeofdish_id');
            $table->foreign('typeofdish_id')->references('id')->on('typeofdish')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dish');

    }
};
