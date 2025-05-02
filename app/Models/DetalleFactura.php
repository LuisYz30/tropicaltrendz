<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $table = 'detalle_factura';

    protected $primaryKey = 'id_detalle';

    protected $fillable = [
        'idfactura', //llave foranea
        'idproducto', //llave foranea
        'cantidad',
        'precio_unitario',
        'subtotal',
    ];

    public $timestamps = false;

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'idfactura');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idproducto');
    }

    public function getSubtotalAttribute()
    {
        return $this->cantidad * $this->precio_unitario;
    }
}
