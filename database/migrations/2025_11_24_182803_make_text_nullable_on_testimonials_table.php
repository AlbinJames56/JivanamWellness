<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            // make text nullable
            $table->text('text')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('testimonials', function (Blueprint $table) {
            // revert to not nullable (if you want)
            $table->text('text')->nullable(false)->change();
        });
    }
};
