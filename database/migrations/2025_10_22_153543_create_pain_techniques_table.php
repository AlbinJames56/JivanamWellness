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
        Schema::create('pain_techniques', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable(); // short description
            $table->text('more_info')->nullable(); // long details / HTML
            $table->string('image')->nullable();
            $table->json('benefits')->nullable(); // array of strings
            $table->string('category')->nullable();
            $table->string('duration')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('price_currency', 6)->default('INR');
            $table->boolean('featured')->default(false);
            $table->boolean('available')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pain_techniques');
    }
};
