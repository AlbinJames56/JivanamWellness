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
        Schema::table('clinics', function (Blueprint $table) {
            $table->string('location_link')->nullable()->after('specialties');
            // If you want to drop lat/lng:
              $table->dropColumn(['latitude','longitude']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clinics', function (Blueprint $table) {
            $table->string('location_link')->nullable()->after('specialties');
            // If you want to drop lat/lng:
            // $table->dropColumn(['latitude','longitude']);
        });
    }
};
