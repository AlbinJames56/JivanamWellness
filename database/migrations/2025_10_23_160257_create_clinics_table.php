<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table
                ->string('slug')
                ->nullable()
                ->index();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('hours')->nullable();
            $table->string('phone')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_open')->default(false);
            $table->json('specialties')->nullable(); // array of strings
            // optional geo and meta
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinics');
    }
};
