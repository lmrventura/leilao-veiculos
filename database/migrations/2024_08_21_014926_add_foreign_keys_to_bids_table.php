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
        Schema::table('bids', function (Blueprint $table) {
            // Adicionar a coluna  se ainda não existir
            $table->unsignedBigInteger('auction_id')->after('id');
            $table->unsignedBigInteger('buyer_id')->after('auction_id');

            // Adicionar a foreign key
            $table->foreign('auction_id')->references('id')->on('auctions')->onDelete('cascade');
            $table->foreign('buyer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bids', function (Blueprint $table) {
            // Remover a foreign key
            $table->dropForeign(['auction_id']);
            $table->dropForeign(['buyer_id']);
            
            // Remover as colunas auction_id e buyer_id, se necessário
            $table->dropColumn(['auction_id', 'buyer_id']);
        });
    }
};
