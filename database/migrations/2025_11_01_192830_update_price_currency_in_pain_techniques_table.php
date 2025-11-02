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
        Schema::table('pain_techniques', function (Blueprint $table) {
            $table->string('price_currency', 4)
                ->default('INR')
                ->change();
        });
    }

    public function down()
    {
        Schema::table('pain_techniques', function (Blueprint $table) {
            $table->string('price_currency', 4)
                ->nullable(false)
                ->default(null)
                ->change();
        });
    }
};
