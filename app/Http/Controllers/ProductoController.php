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
            'imagen' => 'required|image|mimes:jpeg,png,jpg,web|max:2048',  
        ]);

         // Subir la imagen
    $imagenPath = $request->file('imagen')->store('productos', 'public');
    
        // Crear el producto y guardar la ruta de la imagen
        Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'idcategoria' => $request->idcategoria,
            'imagen' => $imagenPath,  // Guardar la ruta directamente
        ]);
    
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente');
    }
}
