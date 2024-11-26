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
        Schema::create('staffs', function (Blueprint $table) {
            $table->increments('staff_code');
            $table->string('fullName',70);
            $table->string('imgOfStaff')->nullable();
            $table->date('birthday');
            $table->string('sex',5);
            $table->string('address');
            $table->date('workingDay');
            $table->boolean('status');
            $table->string('phone',20)->unique();
            $table->string('password');
            $table->unsignedInteger('position_code');
            $table->foreign('position_code')->references('position_code')->on('positions')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
