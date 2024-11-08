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
        Schema::create('turnovers', function (Blueprint $table) {
            $table->id();$table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('type', ['kirim', 'chiqim']); // kirim = incoming, chiqim = outgoing
            $table->integer('quantity_pack')->default(0); // Pack quantity
            $table->integer('quantity_piece')->default(0); // Individual unit quantity
            $table->decimal('total_weight', 10, 2)->default(0); // Total weight in tons
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnovers');
    }
};
