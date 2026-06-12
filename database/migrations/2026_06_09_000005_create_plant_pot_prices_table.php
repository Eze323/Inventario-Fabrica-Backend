<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plant_pot_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->string('pot_size', 50);
            $table->decimal('price', 10, 2);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plant_pot_prices');
    }
};
