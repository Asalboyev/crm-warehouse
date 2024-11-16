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
            $table->decimal('thickness', 8, 3);  // Thickness (Stenka) with three decimal precision
            $table->float('length');  // Length in meters
            $table->string('metal_type');  // Metal Type (Qora/Oq)
            $table->double('price_per_ton',8,1);  // Price per Ton with two decimal precision
            $table->double('length_per_ton',8,1);  // Length per Ton (meters)
            $table->double('price_per_meter',8,1);  // Price per Meter with three decimal precision
            $table->double('price_per_item');  // Price per Item
            $table->float('price_per_package');  // Price per Package with two decimal precision
            $table->float('items_per_package')->nullable();  // Items per Package
            $table->double('package_weight',8,1);  // Package Weight in Tons
            $table->double('package_length',8,1);  // Package Length (meters)
            $table->double('weight_per_item',8,1)->nullable();  // Weight per item in tons with six decimal precision
            $table->double('weight_per_meter',8,1);  // Weight per meter
            $table->integer('total_units');  // Total units (total items across all packages)
            $table->double('bron_package',8,1)->nullable();  // Reserved packages
            $table->double('bron_one_pc',8,1)->nullable();  // Reserved single items
            $table->double('grains_package',8,1)->nullable();  // Grains per package (if applicable)
            $table->integer('total_packages')->nullable();  // Total packages in stock
            $table->double('items_in_package',8,1)->nullable();  // Loose items (outside of package)
            $table->decimal('total_weight', 12, 3)->nullable();  // Total weight of all packages/items
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
