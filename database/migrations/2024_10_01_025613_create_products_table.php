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
            $table->string('product_name');  // Product Name
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); // Category
            $table->string('country'); // Country
            $table->decimal('thickness', );  // Thickness (Stenka)
            $table->float('length');  // Length in meters
            $table->string('metal_type');  // Metal Type (Qora/Oq)
            $table->decimal('price_per_ton', );  // Price per Ton
            $table->decimal('length_per_ton', );  // Length per Ton (meters)
            $table->decimal('price_per_meter', );  // Price per Meter
            $table->decimal('price_per_item', );  // Price per Item
            $table->decimal('price_per_package', );  // Price per Package
            $table->integer('items_per_package');  // Items per Package
            $table->integer('package_weight', );  // Package Weight in Tons
            $table->integer('package_length');  // Package Length (meters)
            $table->integer('weight_per_item',);
            $table->integer('weight_per_meter',);  // Weight per meter
            $table->integer('total_units',);
            $table->integer('grains_package',)->nullable();
            $table->string('total_packages')->nullable();  // Total Packages in stock
            $table->integer('items_in_package')->nullable();  // Items available (outside of package)
            $table->decimal('total_weight', )->nullable();
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
