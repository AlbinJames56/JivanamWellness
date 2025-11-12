<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('therapies', function (Blueprint $table) {
            // add new tags column (JSON)
            $table->json('tags')->nullable()->after('tag');
        });

        // backfill tags from existing `tag` string (comma separated)
        // guard with try/catch to avoid blocking on unexpected data
        try {
            $therapies = DB::table('therapies')->select('id', 'tag')->get();
            foreach ($therapies as $t) {
                if ($t->tag === null) {
                    DB::table('therapies')->where('id', $t->id)->update(['tags' => null]);
                    continue;
                }
                // split by comma, trim and remove empty parts
                $arr = array_filter(array_map('trim', explode(',', $t->tag)));
                DB::table('therapies')->where('id', $t->id)->update(['tags' => json_encode(array_values($arr))]);
            }
        } catch (\Throwable $e) {
            // don't fail the migration if something goes wrong with DB update
            // you can log if needed: \Log::error($e->getMessage());
        }
    }

    public function down()
    {
        Schema::table('therapies', function (Blueprint $table) {
            $table->dropColumn('tags');
        });
    }
};
