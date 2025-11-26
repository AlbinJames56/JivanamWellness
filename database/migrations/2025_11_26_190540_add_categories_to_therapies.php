<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Add categories to therapies
        Schema::table('therapies', function (Blueprint $table) {
            if (!Schema::hasColumn('therapies', 'categories')) {
                $table->json('categories')->nullable()->after('tags');
            }
        });

        // Remove columns from pain_techniques
        Schema::table('pain_techniques', function (Blueprint $table) {
            // IMPORTANT: check and drop individually to avoid issues
            if (Schema::hasColumn('pain_techniques', 'categories')) {
                $table->dropColumn('categories');
            }

            if (Schema::hasColumn('pain_techniques', 'category')) {
                $table->dropColumn('category');
            }
        });
    }

    public function down()
    {
        // Remove categories from therapies
        Schema::table('therapies', function (Blueprint $table) {
            if (Schema::hasColumn('therapies', 'categories')) {
                $table->dropColumn('categories');
            }
        });

        // Restore columns for pain_techniques (if you ever roll back)
        Schema::table('pain_techniques', function (Blueprint $table) {
            if (!Schema::hasColumn('pain_techniques', 'category')) {
                $table->string('category')->nullable();
            }

            if (!Schema::hasColumn('pain_techniques', 'categories')) {
                $table->json('categories')->nullable();
            }
        });
    }
};
