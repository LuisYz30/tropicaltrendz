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
    Schema::create('resenas', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->tinyInteger('calificacion'); // de 1 a 5
        $table->text('opinion');
        $table->string('seccion'); // hombre, mujer, niños
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resenas');
    }
};
