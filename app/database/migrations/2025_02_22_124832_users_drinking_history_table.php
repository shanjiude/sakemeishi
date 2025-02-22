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
        Schema::create('users_drinking_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ユーザーID
            $table->foreignId('alcohol_type_id')->constrained()->onDelete('cascade'); // お酒の種類ID
            $table->string('brand')->nullable(); // 飲んだ銘柄（任意）
            $table->timestamp('drank_at')->useCurrent(); // 飲んだ日時
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users_drinking_history');
    }
};
