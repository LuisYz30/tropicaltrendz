<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarritoTemporal extends Model
{
    protected $table = 'carrito_temporal';

    protected $fillable = [
        'referencia',
        'user_id',
        'datos',
        ];
}
