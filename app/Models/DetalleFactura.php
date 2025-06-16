<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
    protected $table = 'detalle_facturas'; // asegúrate que la tabla se llame así en la BD
    protected $primaryKey = 'id'; // clave primaria

    protected $fillable = [
        'factura_id',      // llave foránea hacia facturas
        'idproducto',
        'idtalla',
        'cantidad',
        'precio_unitario',
    ];

    public $timestamps = false;

    public function factura()
    {
        return $this->belongsTo(Factura::class, 'factura_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'idproducto');
    }

    // Esta función te calcula el subtotal automáticamente
    public function getSubtotalAttribute()
    {
        return $this->cantidad * $this->precio_unitario;
    }
}
