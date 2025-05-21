<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resena extends Model
{
    protected $fillable = ['nombre', 'calificacion', 'opinion', 'seccion'];
}
