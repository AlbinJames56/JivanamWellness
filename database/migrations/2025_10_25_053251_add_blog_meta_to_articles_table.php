<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (!Schema::hasColumn('articles', 'category')) {
                $table
                    ->string('category')
                    ->nullable()
                    ->after('excerpt');
            }
            if (!Schema::hasColumn('articles', 'author_name')) {
                $table
                    ->string('author_name')
                    ->nullable()
                    ->after('category');
            }
            if (!Schema::hasColumn('articles', 'author_avatar')) {
                $table
                    ->string('author_avatar')
                    ->nullable()
                    ->after('author_name');
            }
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'author_avatar')) {
                $table->dropColumn('author_avatar');
            }
            if (Schema::hasColumn('articles', 'author_name')) {
                $table->dropColumn('author_name');
            }
            if (Schema::hasColumn('articles', 'category')) {
                $table->dropColumn('category');
            }
        });
    }
};
