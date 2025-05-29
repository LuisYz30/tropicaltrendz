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
        Schema::create('producto_tallas', function (Blueprint $table) {
            $table->idproducto_tallas();
            $table->unsignedBigInteger('idproducto');
            $table->unsignedBigInteger('idtalla');
            $table->unsignedInteger('stock');
            $table->foreign('idproducto')->references('idproducto')->on('productos')->onDelete('cascade');
            $table->foreign('idtalla')->references('idtalla')->on('tallas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('producto_tallas');
    }
};
