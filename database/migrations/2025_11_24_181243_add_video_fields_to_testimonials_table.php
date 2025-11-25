<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoFieldsToTestimonialsTable extends Migration
{
    public function up()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->boolean('is_video')->default(false)->after('text');
            $table->string('video')->nullable()->after('is_video'); // stored path/filename
            $table->string('video_thumbnail')->nullable()->after('video'); // optional thumbnail image
        });
    }

    public function down()
    {
        Schema::table('testimonials', function (Blueprint $table) {
            $table->dropColumn(['is_video', 'video', 'video_thumbnail']);
        });
    }
}
