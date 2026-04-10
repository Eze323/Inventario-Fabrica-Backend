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
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
    $table->string('name'); // <--- Asegurate que esta línea ESTÉ ahí
    $table->string('area')->nullable();
    $table->boolean('is_monitored')->default(false);
    $table->integer('x')->default(0);
    $table->integer('y')->default(0);
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
