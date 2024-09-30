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
        Schema::create('main_products', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->string('name'); // Mahsulot nomi
            $table->string('country'); // Mahsulot davlati
            $table->string('size'); // Olchami
            $table->integer('thickness'); // Qalinligi
            $table->string('metal_type'); // Metal turi
            $table->integer('units_per_package'); // 1 pochkada nechta dona
            $table->integer('units_per_meter'); // 1 dona necha metr
            $table->decimal('length', 8, 2)->nullable(); // 1 metr
            $table->decimal('weight_per_meter', 8, 2)->nullable();
            $table->id();

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
