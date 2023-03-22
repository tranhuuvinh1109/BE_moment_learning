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
        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('teacher')->unsigned();
            $table->bigInteger('category')->unsigned();
            $table->double('price');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->double('total_star')->nullable();
            $table->foreign('category')->references('id')->on('category');
            $table->foreign('teacher')->references('id')->on('teacher');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
