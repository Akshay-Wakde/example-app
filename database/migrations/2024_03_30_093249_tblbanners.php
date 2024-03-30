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
        Schema::create('tblbanners', function (Blueprint $table) {
            $table->increments('banner_id');
            $table->string('banner_name');
            $table->string('image_name');
            $table->string('image_url');
            $table->enum('is_online', ['No', 'Yes']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tblbanners');
    }
};
