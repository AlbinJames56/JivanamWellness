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
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedBigInteger('clinic_id')->nullable()->after('therapy_id');
            $table->foreign('clinic_id')->references('id')->on('clinics')->onDelete('set null');
            $table->timestamp('booked_at')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropForeign(['clinic_id']);
            $table->dropColumn(['clinic_id', 'booked_at']);
        });
    }

};
