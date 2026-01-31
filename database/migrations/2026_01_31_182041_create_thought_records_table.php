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
        Schema::create('thought_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->text('situation')->nullable(); // 状況
            $table->string('emotion')->nullable(); // 気分・感情
            $table->integer('emotion_intensity')->nullable(); // 気分の強さ 0-100
            $table->text('automatic_thought')->nullable(); // 自動思考
            $table->text('evidence')->nullable(); // 根拠
            $table->text('counter_evidence')->nullable(); // 反証
            $table->text('adaptive_thought')->nullable(); // 適応的思考
            $table->integer('emotion_after')->nullable(); // その後の気分の強さ 0-100
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thought_records');
    }
};
