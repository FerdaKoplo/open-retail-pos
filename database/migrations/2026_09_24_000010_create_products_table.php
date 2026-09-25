<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('tax_rate_id')->constrained('tax_rates')->cascadeOnDelete();
            $table->string('sku', 100);
            $table->string('name', 200);
            $table->text('description')->nullable();
            $table->decimal('cost_price', 15,2);
            $table->decimal('selling_price', 15, 2);
            $table->string('unit', 50);
            $table->boolean('track_stock');
            $table->boolean('track_batch');
            $table->boolean('track_expiry');
            $table->boolean('is_active');
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
