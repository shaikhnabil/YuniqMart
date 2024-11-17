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
        Schema::create('shipping', function (Blueprint $table) {
            $table->id();
            $table->string('method_name'); // Shipping method name (e.g., Standard, Express)
            $table->decimal('base_rate', 10, 2); // Base shipping rate
            $table->decimal('rate_per_kg', 10, 2)->nullable(); // Optional rate based on weight
            $table->unsignedBigInteger('product_id')->nullable(); // If shipping rate is product-specific
            $table->timestamp('shipping_date')->nullable();
            $table->timestamp('delivery_date')->nullable(); // Estimated delivery time
            $table->string('shipping_status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping');
    }
};
