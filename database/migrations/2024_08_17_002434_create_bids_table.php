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
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            // $table->foreignId('auction_id')->constrained()->onDelete('cascade');
            // $table->foreignId('buyer_id')->constrained('users')->onDelete('cascade');
            $table->decimal('value', 10, 2); // Bid amount
            $table->timestamp('date_time'); // Date and time of the bid
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids');
    }
};
