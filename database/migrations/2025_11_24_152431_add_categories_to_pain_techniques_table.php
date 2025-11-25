<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoriesToPainTechniquesTable extends Migration
{
    public function up()
    {
        Schema::table('pain_techniques', function (Blueprint $table) {
            // add json column to store multiple categories
            $table->json('categories')->nullable()->after('category');
        });

        // backfill: move existing single `category` values into `categories` array (safe for small dataset)
        // Note: you can remove this block if you prefer to backfill via tinker or artisan command.
        if (class_exists(\App\Models\PainTechnique::class)) {
            \App\Models\PainTechnique::withoutEvents(function () {
                \App\Models\PainTechnique::chunk(200, function ($rows) {
                    foreach ($rows as $row) {
                        if (!empty($row->category) && empty($row->categories)) {
                            $row->categories = [$row->category];
                            $row->saveQuietly();
                        }
                    }
                });
            });
        }
    }

    public function down()
    {
        Schema::table('pain_techniques', function (Blueprint $table) {
            $table->dropColumn('categories');
        });
    }
}
