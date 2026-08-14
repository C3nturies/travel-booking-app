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
            $table->integer('discount_percent')->nullable()->after('price');
            $table->date('available_from')->nullable()->after('discount_percent');
            $table->date('available_until')->nullable()->after('available_from');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn([
                'discount_percent',
                'available_from',
                'available_until',
            ]);
        });
    }
};
