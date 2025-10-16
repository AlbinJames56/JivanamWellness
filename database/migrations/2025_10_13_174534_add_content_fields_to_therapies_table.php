<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('therapies', function (Blueprint $table) {
            // accessibility + SEO
            $table
                ->string('image_alt')
                ->nullable()
                ->after('image');
            $table
                ->string('meta_title')
                ->nullable()
                ->after('image_alt');
            $table
                ->string('meta_description')
                ->nullable()
                ->after('meta_title');

            // extra content
            $table
                ->text('excerpt')
                ->nullable()
                ->after('summary');

            // structured content stored as JSON arrays
            $table
                ->json('benefits')
                ->nullable()
                ->after('content'); // array of strings
            $table
                ->json('contraindications')
                ->nullable()
                ->after('benefits');
            $table
                ->json('gallery')
                ->nullable()
                ->after('image'); // array of image paths

            // commerce/availability
            $table
                ->decimal('price', 10, 2)
                ->nullable()
                ->after('tag');
            $table
                ->string('price_currency', 4)
                ->default('INR')
                ->after('price');
            $table
                ->boolean('available')
                ->default(true)
                ->after('price_currency');
        });
    }

    public function down(): void
    {
        Schema::table('therapies', function (Blueprint $table) {
            $table->dropColumn([
                'image_alt',
                'meta_title',
                'meta_description',
                'excerpt',
                'benefits',
                'contraindications',
                'gallery',
                'price',
                'price_currency',
                'available',
            ]);
        });
    }
};
