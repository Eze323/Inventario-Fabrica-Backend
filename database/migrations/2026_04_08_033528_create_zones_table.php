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
        Schema::create('zones', function (Blueprint $table) {
        $table->string('id')->primary(); // Usaremos zn_01, zn_02, etc.
        $table->string('name');
        $table->integer('x');
        $table->integer('y');
        $table->integer('w');
        $table->integer('h');
        $table->string('color');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zones');
    }
};
