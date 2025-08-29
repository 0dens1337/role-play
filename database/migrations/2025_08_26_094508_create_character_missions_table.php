<?php

use App\Models\Character;
use App\Models\Mission;
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
        Schema::create('character_missions', function (Blueprint $table) {
            $table->foreignIdFor(Character::class)->constrained();
            $table->foreignIdFor(Mission::class)->constrained();
            $table->tinyInteger('status')->default(1);
            $table->string('image_proof')->nullable();
            $table->text('description_proof')->nullable();
            $table->dateTime('deadline')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('character_missions');
    }
};
