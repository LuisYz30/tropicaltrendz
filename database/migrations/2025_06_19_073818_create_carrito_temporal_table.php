<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrito_temporal', function (Blueprint $table) {
            $table->id();
            $table->string('referencia')->unique();
            $table->unsignedBigInteger('user_id');
            $table->json('datos'); // Aquí guardamos el carrito completo como JSON
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrito_temporal');
    }
};
