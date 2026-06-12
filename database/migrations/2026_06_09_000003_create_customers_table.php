<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->nullable()->unique();
            $table->string('address', 500)->nullable();
            $table->string('phone', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
