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
            $table->string('name', 255);
            $table->text('image');
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->string('brand', 100)->nullable();
            $table->string('color', 255)->nullable();
            $table->string('size', 255)->nullable();
            $table->string('slug', 255)->unique();
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');
            $table->integer('stock')->nullable();
            $table->tinyInteger('is_active')->default(0);
            $table->bigInteger('created_by')->nullable();
            $table->softDeletes()->nullable();
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
