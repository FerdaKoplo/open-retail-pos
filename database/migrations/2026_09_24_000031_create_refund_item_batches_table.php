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
        Schema::create('refund_item_batches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('refund_item_id')->constrained('refund_items')->cascadeOnDelete();
            $table->foreignId('sale_item_batch_id')->constrained('sale_item_batches')->cascadeOnDelete();
            $table->foreignId('product_batch_id')->constrained('product_batches')->cascadeOnDelete();
            $table->decimal('quantity', 15 ,3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_item_batches');
    }
};
