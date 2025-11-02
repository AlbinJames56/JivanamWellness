<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->text('notes')->nullable();
            $table->dateTime('preferred')->nullable();
            $table->unsignedBigInteger('therapy_id')->nullable();
            $table->string('therapy_slug')->nullable();
            $table->string('status')->default('pending'); // pending, confirmed, rescheduled, cancelled, completed
            $table->dateTime('confirmed_date')->nullable(); // admin rescheduled date
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
