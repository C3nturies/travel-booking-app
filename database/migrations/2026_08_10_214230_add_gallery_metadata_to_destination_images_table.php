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
        Schema::table('destination_images', function (Blueprint $table) {
            $table->string('alt_text')->nullable()->after('image_url');
            $table->string('caption')->nullable()->after('alt_text');
            $table->unsignedInteger('width')->nullable()->after('caption');
            $table->unsignedInteger('height')->nullable()->after('width');
            $table->boolean('is_active')->default(true)->after('height');

            $table->index(['destination_id', 'is_active', 'sort_order'], 'destination_images_lookup_index');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destination_images', function (Blueprint $table) {
            $table->dropIndex('destination_images_lookup_index');

            $table->dropColumn([
                'alt_text',
                'caption',
                'width',
                'height',
                'is_active',
            ]);
        });
    }
};
