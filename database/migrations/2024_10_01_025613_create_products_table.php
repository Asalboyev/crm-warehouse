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
            $table->decimal('price_per_ton', 12, 2);  // Price per Ton with two decimal precision
            $table->float('length_per_ton');  // Length per Ton (meters)
            $table->decimal('price_per_meter', 12, 3);  // Price per Meter with three decimal precision
            $table->decimal('price_per_item', 12, 3);  // Price per Item
            $table->decimal('price_per_package', 12, 2);  // Price per Package with two decimal precision
            $table->float('items_per_package')->nullable();  // Items per Package
            $table->float('package_weight');  // Package Weight in Tons
            $table->float('package_length');  // Package Length (meters)
            $table->decimal('weight_per_item', 12, 6)->nullable();  // Weight per item in tons with six decimal precision
            $table->decimal('weight_per_meter', 12, 6);  // Weight per meter
            $table->float('total_units');  // Total units (total items across all packages)
            $table->float('bron_package')->nullable();  // Reserved packages
            $table->float('bron_one_pc')->nullable();  // Reserved single items
            $table->float('grains_package')->nullable();  // Grains per package (if applicable)
            $table->float('total_packages')->nullable();  // Total packages in stock
            $table->float('items_in_package')->nullable();  // Loose items (outside of package)
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
