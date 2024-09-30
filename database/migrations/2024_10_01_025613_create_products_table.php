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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('main_product_id')->constrained('main_products')->onDelete('cascade');
            $table->string('name')->nullable(); // Mahsulot nomi
            $table->decimal('price_per_ton', 10, 2); // Narxi tonna uchun
            $table->integer('total_packages'); // Pochkalar soni
            $table->integer('total_units'); // Umumiy donalar soni (Dona)
            $table->integer('individual_units'); // Alohida donalar soni (Dona)
            $table->decimal('total_weight', 10, 2); // Umumiy ogirligi (Tonna)
            $table->decimal('total_length', 10, 2); // Umumiy Uzunligi (m)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
