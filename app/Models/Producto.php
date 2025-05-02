<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Producto extends Model
{
    protected $primaryKey = 'idproducto';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'idcategoria', //llave foranea
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'idcategoria');
    }

        /**
     * Accesor para precio formateado
     */
    public function getPrecioFormateadoAttribute(): string
    {
        return '$' . number_format($this->precio, 0, ',', '.');
    }

}
