<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        Producto::create([
            'nombre' => 'Producto de ejemplo 1',
            'descripcion' => 'Descripción del producto 1',
            'precio' => 80000.00,
            'idcategoria' => 1,
            'imagen' => 'fh1.png',
        ]);

        Producto::create([
            'nombre' => 'Producto de ejemplo 2',
            'descripcion' => 'Descripción del producto 2',
            'precio' => 90000.00,
            'idcategoria' => 2,
            'imagen' => 'fm2.png',
        ]);

        Producto::create([
            'nombre' => 'Producto de ejemplo 3',
            'descripcion' => 'Descripción del producto 3',
            'precio' => 80000.00,
            'idcategoria' => 3,
            'imagen' => 'fh3.jpg',
        ]);
    }
}
