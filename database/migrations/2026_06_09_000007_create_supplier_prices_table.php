<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('supplier_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('supplier_id')->constrained('suppliers');
            $table->decimal('purchase_price', 10, 2);
            $table->dateTime('valid_from')->nullable();
            $table->dateTime('valid_to')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('supplier_prices');
    }
};
