<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::create(['idcategoria' => 1, 'nombre' => 'Hombre']);
        Categoria::create(['idcategoria' => 2, 'nombre' => 'Mujer']);
        Categoria::create(['idcategoria' => 3, 'nombre' => 'Niños']);
    }
}
