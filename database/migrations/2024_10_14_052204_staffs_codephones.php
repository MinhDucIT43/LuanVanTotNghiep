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
        Schema::create('staffs_codephones', function (Blueprint $table) {
            $table->unsignedInteger('staff_code');
            $table->foreign('staff_code')->references('staff_code')->on('staffs')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->unsignedInteger('codephone_code');
            $table->foreign('codephone_code')->references('codephone_code')->on('codephones')->onDelete('NO ACTION')->onUpdate('NO ACTION');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs_codephones');
    }
};