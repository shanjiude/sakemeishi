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
        Schema::create('user_soda_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーID
            $table->enum('soda_preference', ['like', 'neutral', 'dislike'])->default('neutral'); // 炭酸の好み
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_soda_preferences');
    }
};
