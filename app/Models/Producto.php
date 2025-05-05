<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Producto extends Model
{
    protected $primaryKey = 'idproducto';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'idcategoria', //llave foranea
        'imagen',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'idcategoria');
    }

    public function tallas(): BelongsToMany
    {
    return $this->belongsToMany(Talla::class, 'producto_tallas', 'idproducto', 'idtalla');
    }

        /**
     * Accesor para precio formateado
     */
    public function getPrecioFormateadoAttribute(): string
    {
        return '$' . number_format($this->precio, 0, ',', '.');
    }

}
