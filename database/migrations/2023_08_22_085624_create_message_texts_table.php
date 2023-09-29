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
        Schema::create('message_texts', function (Blueprint $table) {
            $table->id();
            $table->string('Mes_id');
            $table->string('user_send_id');
            $table->longText('message_text');
            $table->string('is_mes_seen')->default('false');
            $table->string('is_send_notif')->default('false');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_texts');
    }
};
