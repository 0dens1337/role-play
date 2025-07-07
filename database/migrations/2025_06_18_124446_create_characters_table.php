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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('occupation')->nullable();
            $table->integer('age')->nullable();
            $table->string('race')->nullable();
            $table->string('gender')->nullable();
            $table->text('biography')->nullable();
            $table->text('personality')->nullable();
            $table->text('appearance')->nullable();
            $table->text('contracts')->nullable();

            $table->string('artifacts')->nullable();
            $table->text('magic_skills')->nullable();
            $table->text('non_magic_skills')->nullable();

            $table->foreignId('user_id')->constrained('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
