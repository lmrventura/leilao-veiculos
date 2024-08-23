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
        Schema::table('auctions', function (Blueprint $table) {
            // Adicionar a coluna vehicle_id
            $table->unsignedBigInteger('vehicle_id')->after('id');

            // Adicionar a foreign key
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('auctions', function (Blueprint $table) {
            // Remover a foreign key
            $table->dropForeign(['vehicle_id']);
            
            // Remover a coluna vehicle_id
            $table->dropColumn('vehicle_id');
        });
    }
};
