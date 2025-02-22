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
        Schema::create('user_alcohol_strengths', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('strength')->unsigned()->comment('お酒の強さ（1:弱い 〜 5:強い）');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_alcohol_strengths');
    }
};
