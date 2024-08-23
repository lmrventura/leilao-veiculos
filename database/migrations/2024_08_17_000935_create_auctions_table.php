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
        Schema::create('auctions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            
            // $table->foreignId('vehicle_id')->constrained()->onDelete('cascade'); // Foreign key to vehicles table
            // $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
            // $table->unsignedBigInteger('vehicle_id');
            // $table->foreign('vehicle_id')->references('id')->on('vehicles'); //->onDelete('cascade');
            
            $table->decimal('starting_bid', 10, 2); // Example field for the auction
            $table->string("status"); //open or closed
            $table->timestamp('start_time')->useCurrent();
            $table->timestamp('end_time')->nullable();
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auctions');
    }
};
