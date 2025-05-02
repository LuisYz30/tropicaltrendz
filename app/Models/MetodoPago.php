<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    protected $primaryKey = 'idmetodo';

    protected $fillable = [
        'tiposmetodo',
        'id_factura',
    ];

    public $timestamps = false;

    /**
     * Relación con la tabla Factura
     */
    public function facturas()
    {
        return $this->belongsTo(Factura::class, 'idfactura');
    }

}
