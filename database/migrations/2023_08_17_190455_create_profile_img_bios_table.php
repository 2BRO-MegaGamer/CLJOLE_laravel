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
        Schema::create('profile_img_bios', function (Blueprint $table) {
            $table->string('user_id');
            $table->string('prof_Img_name')->nullable()->default(NULL);
            $table->string('prof_Img_size')->nullable()->default(NULL);
            $table->string('path')->nullable()->default(NULL);
            $table->string('type')->nullable()->default(NULL);
            $table->string('prof_Bio')->default('There is no information');
            $table->string('prof_Color')->default('#ffffff');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_img_bios');
    }
};
