<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Talla;

class ProductoController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric',
        'idcategoria' => 'required|exists:categorias,idcategoria',
        'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'tallas' => 'required|array|min:1',
        'tallas.*' => 'exists:tallas,idtalla',
    ]);

    // Subir imagen
    $rutaImagen = $request->hasFile('imagen') 
        ? $request->file('imagen')->store('productos', 'public') 
        : null;

    $producto = new Producto();
    $producto->nombre = $request->nombre;
    $producto->descripcion = $request->descripcion;
    $producto->precio = $request->precio;
    $producto->imagen = $rutaImagen;
    $producto->idcategoria = $request->idcategoria;
    $producto->save();

    foreach ($request->tallas as $idtalla) {
        $stock = $request->stock_tallas[$idtalla] ?? 0;
        if ($stock > 0) {
            DB::table('producto_tallas')->insert([
                'idproducto' => $producto->idproducto,
                'idtalla' => $idtalla,
                'stock' => $stock,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    return redirect()->back()->with('success', 'Producto creado correctamente.');
}


    

    public function index()
{
   
}

public function create()
{
    $categorias = Categoria::all();
    $tallas = Talla::all();

    return view('admin.productos.create', compact('categorias', 'tallas'));
}

public function edit($id)
{
    $producto = Producto::findOrFail($id);
    $categorias = Categoria::all();
    $tallas = Talla::all(); // 👈 Agrega esta línea

    return view('admin.productos.edit', compact('producto', 'categorias', 'tallas'));
}

public function update(Request $request, $id)
{
    $producto = Producto::findOrFail($id);

    $request->validate([
        'nombre' => 'required',
        'descripcion' => 'required',
        'precio' => 'required|numeric',
        'idcategoria' => 'required|exists:categorias,idcategoria',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        'tallas' => 'required|array|min:1',
        'tallas.*' => 'exists:tallas,idtalla',
    ]);

    // Actualiza los campos básicos
    $data = $request->only(['nombre', 'descripcion', 'precio', 'idcategoria']);

    if ($request->hasFile('imagen')) {
        $data['imagen'] = $request->file('imagen')->store('productos', 'public');
    }

    $producto->update($data);

    // ✅ ACTUALIZA TALLAS Y STOCK EN TABLA PIVOTE
    $producto->tallas()->sync([]); // Limpia relaciones anteriores

    $syncData = [];
    foreach ($request->tallas as $idtalla) {
        $stock = $request->stock_tallas[$idtalla] ?? 0;
        if ($stock > 0) {
            $syncData[$idtalla] = ['stock' => $stock];
        }
    }

    $producto->tallas()->sync($syncData); // Asigna las nuevas tallas y stock

    // Redirección
    $seccion = strtolower($request->input('seccion'));
    return redirect()->route("index")->with('success', 'Producto actualizado correctamente');
}

public function destroy($id, Request $request)
{
    $producto = Producto::findOrFail($id);
    $producto->delete();

    // Leer parámetro de sección desde la URL (por ejemplo, /admin/productos/5?seccion=mujer)
    $seccion = $request->query('seccion');

    if ($seccion) {
        return redirect()->route('productos.index', ['seccion' => $seccion])
                         ->with('success', 'Producto eliminado correctamente.');
    }

    return redirect()->back()->with('success', 'Producto eliminado correctamente.');
}

public function informes()
{
    $categoriaFiltro = request('categoria');

    $compras = DB::table('facturas')
        ->join('users', 'facturas.user_id', '=', 'users.id')
        ->join('metodo_pagos', 'facturas.metodo_pago_id', '=', 'metodo_pagos.id')
        ->select('facturas.id', 'users.name', 'users.telefono', 'facturas.fecha', 'facturas.total', 'metodo_pagos.nombre as metodo_pago')
        ->orderBy('facturas.fecha', 'desc')
        ->paginate(10, ['*'], 'compras_page')
        ->withQueryString();

        $ventasPorProducto = DB::table('detalle_facturas')
        ->select('nombre_producto', DB::raw('SUM(cantidad) as total_vendido'))
        ->groupBy('nombre_producto')
        ->orderByDesc('total_vendido')
        ->take(5)
        ->get();


    // Aquí filtramos inventario si se seleccionó una categoría
    $inventarioQuery = Producto::with(['categoria', 'tallas']);
    if ($categoriaFiltro) {
        $inventarioQuery->where('idcategoria', $categoriaFiltro);
    }
    $inventario = $inventarioQuery
        ->paginate(10, ['*'], 'inventario_page')
        ->withQueryString();

    $categorias = Categoria::all();

    return view('admin.productos.informes', compact('compras', 'ventasPorProducto', 'inventario', 'categorias'));
}
public function detallesFactura($facturaId)
{
    $detalles = DB::table('detalle_facturas')
    ->join('tallas', 'detalle_facturas.idtalla', '=', 'tallas.idtalla')
    ->where('detalle_facturas.factura_id', $facturaId)
    ->select(
        'detalle_facturas.nombre_producto as producto',
        'detalle_facturas.categoria as categoria',
        'tallas.nombre as talla',
        'detalle_facturas.precio_unitario',
        'detalle_facturas.cantidad'
    )
    ->get();
    return response()->json($detalles);
}


}
