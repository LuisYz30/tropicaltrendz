<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categorias';

    protected $primaryKey = 'idcategoria';

    protected $fillable = [
        'nombre',
    ];

    public $timestamps = false;

    public function productos()
    {
        return $this->hasMany(Producto::class, 'idcategoria');  // Clave foránea correctamente definida
    }
}
