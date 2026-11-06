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
    public function up(): void
    {
        if (! Schema::hasColumn('tweets', 'views_count')) {
            Schema::table('tweets', function (Blueprint $table) {
                $table->unsignedBigInteger('views_count')->default(0)->after('is_video');
            });

            // Backfill initial counts from existing tweet_views records safely
            DB::statement('
                UPDATE tweets t
                SET t.views_count = COALESCE((
                    SELECT COUNT(*) FROM tweet_views tv WHERE tv.tweet_id = t.id
                ), 0)
            ');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('tweets', 'views_count')) {
            Schema::table('tweets', function (Blueprint $table) {
                $table->dropColumn('views_count');
            });
        }
    }
};

