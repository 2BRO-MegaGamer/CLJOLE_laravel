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
        Schema::create('chat_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_user_1',50);
            $table->string('id_user_2',50);
            $table->string('MES_type',7);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_infos');
    }
};
