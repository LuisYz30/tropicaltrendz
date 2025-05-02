<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoTalla extends Model
{
protected $primaryKey = 'idproducto_talla';

    protected $fillable = [
        'idproducto', //llave foranea
        'idtalla', //llave foranea
        'stock',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idproducto');
    }

    public function talla()
    {
        return $this->belongsTo(Talla::class, 'idtalla');
    }
}
