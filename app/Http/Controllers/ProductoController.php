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

    public function index()
{
    $productos = Producto::with('categoria')->get();
    return view('admin.productos.index', compact('productos'));
}

public function create()
{
    $categorias = Categoria::all();
    return view('admin.productos.create', compact('categorias'));
}

public function edit($id)
{
    $producto = Producto::findOrFail($id);
    $categorias = Categoria::all();
    return view('admin.productos.edit', compact('producto', 'categorias'));
}

public function update(Request $request, $id)
{
    $producto = Producto::findOrFail($id);

    $request->validate([
        'nombre' => 'required',
        'descripcion' => 'required',
        'precio' => 'required|numeric',
        'idcategoria' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,web|max:2048',
    ]);

    $data = $request->only(['nombre', 'descripcion', 'precio', 'idcategoria']);

    if ($request->hasFile('imagen')) {
        $data['imagen'] = $request->file('imagen')->store('productos', 'public');
    }

    $producto->update($data);

    return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
}

public function destroy($id)
{
    $producto = Producto::findOrFail($id);
    $producto->delete();

    return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
}
}
