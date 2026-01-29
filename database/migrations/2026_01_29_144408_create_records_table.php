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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->integer('mood_score')->nullable(); // 気分スコア 1-10
            $table->decimal('sleep_hours', 3, 1)->nullable(); // 睡眠時間（例：7.5時間）
            $table->text('note')->nullable(); // メモ
            $table->boolean('took_medication')->default(false); // 服薬したか
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};