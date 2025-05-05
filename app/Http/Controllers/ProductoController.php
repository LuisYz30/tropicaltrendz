<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function store(Request $request)
    {
        // Validación del formulario
        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'precio' => 'required|numeric',
            'idcategoria' => 'required|exists:categorias,id',
            'imagen' => 'required|string',  // Cambié para aceptar el nombre de la imagen
        ]);
    
        // Crear el producto y guardar la ruta de la imagen
        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'idcategoria' => $request->idcategoria,
            'imagen' => $request->imagen,  // Guardar la ruta directamente
        ]);
    
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }
}
