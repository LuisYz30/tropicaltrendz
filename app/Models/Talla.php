<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Talla extends Model
{
    protected $primaryKey = 'idtalla';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = false;
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_talla', 'idtalla', 'idproducto')
                    ->withPivot('stock');
    }
}
