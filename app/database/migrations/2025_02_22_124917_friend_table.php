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
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // フォローする側
            $table->foreignId('friend_id')->constrained('users')->onDelete('cascade'); // フォローされる側
            $table->timestamps();

            $table->unique(['user_id', 'friend_id']); // 同じ組み合わせは1つだけ
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('friends');
    }
};
