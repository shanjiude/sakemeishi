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
        Schema::create('user_alcohol_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('alcohol_type_id')->constrained()->onDelete('cascade');
            $table->enum('preference', ['like', 'neutral', 'dislike']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_alcohol_preferences');
    }
};
