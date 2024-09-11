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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            // $table->json('image');
            // $table->string('image_path');
            $table->string('make'); //$table->string('manufacturer');
            $table->string('model');
            $table->year('year');
            $table->string('fuel');
            $table->integer('km');
            $table->string('doors');
            $table->string('color')->nullable();
            $table->string('plate');
            $table->string('transmission');
            // $table->string('vin')->unique();
            //$table->json('optionals'); // create database entity later
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
