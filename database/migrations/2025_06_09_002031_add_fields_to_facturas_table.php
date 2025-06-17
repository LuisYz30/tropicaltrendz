<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('facturas', function (Blueprint $table) {
        // Opcional: foreign keys
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('metodo_pago_id')->references('id')->on('metodo_pagos')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('facturas', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropForeign(['metodo_pago_id']);
        $table->dropColumn(['user_id', 'fecha', 'metodo_pago_id', 'total']);
    });
}

};
