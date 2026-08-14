<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            Schema::table('destinations', function (Blueprint $table) {
                $table->string('optimized_hero_image')->nullable()->after('hero_image');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            Schema::table('destinations', function (Blueprint $table) {
                $table->dropColumn('optimized_hero_image');
            });
        });
    }
};
