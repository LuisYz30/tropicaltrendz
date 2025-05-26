<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reseñas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('producto_id');
        $table->unsignedBigInteger('user_id');
        $table->tinyInteger('calificacion'); // 1 a 5 estrellas
        $table->text('comentario');
        $table->timestamps();
    
        $table->foreign('producto_id')->references('idproducto')->on('productos')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reseñas');
    }
};
