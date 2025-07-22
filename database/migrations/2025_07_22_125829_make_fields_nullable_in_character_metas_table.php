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
        Schema::table('character_metas', function (Blueprint $table) {
            $table->string('short_description')->nullable()->change();
            $table->string('image')->nullable()->change();
            $table->jsonb('likes')->nullable()->change();
            $table->jsonb('dislikes')->nullable()->change();
            $table->string('text_color')->nullable()->change();
            $table->string('background_color')->nullable()->change();
            $table->string('accent_color')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('character_metas', function (Blueprint $table) {
            $table->string('short_description')->nullable(false)->change();
            $table->string('image')->nullable(false)->change();
            $table->jsonb('likes')->nullable(false)->change();
            $table->jsonb('dislikes')->nullable(false)->change();
            $table->string('text_color')->nullable(false)->change();
            $table->string('background_color')->nullable(false)->change();
            $table->string('accent_color')->nullable(false)->change();
        });
    }
};
