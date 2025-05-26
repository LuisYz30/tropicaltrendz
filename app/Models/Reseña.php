<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reseña extends Model
{
    protected $fillable = ['producto_id', 'user_id', 'calificacion', 'comentario'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}