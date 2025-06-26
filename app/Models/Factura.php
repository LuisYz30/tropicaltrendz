<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Factura extends Model
{
    protected $table = 'facturas';
    protected $primaryKey = 'id';

    protected $fillable = [
        'fecha',
        'user_id',
        'metodo_pago_id',
        'total',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleFactura::class, 'factura_id');
    }

    public function getFechaFormateadaAttribute(): string
    {
        return $this->fecha->format('d/m/Y');
    }
}
