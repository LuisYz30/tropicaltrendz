<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Factura extends Model
{

    protected $primaryKey = 'idfactura';

    
    protected $fillable=[
        'fecha',
        'descripcion',
        'idcliente', //llave foranea
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(User::class, 'idcliente');
    }

    public function detallefactura(): HasMany
    {
        return $this->hasMany(DetalleFactura::class, 'idfactura');
    }

    public function getFechaFormateadaAttribute(): string
    {
        return $this->fecha->format('d/m/Y');
    }

    public function getTotalAttribute(): float
    {
        return $this->detalles->sum(function($detalle) {
            return $detalle->cantidad * $detalle->precio_unitario;
        });
    }
}
