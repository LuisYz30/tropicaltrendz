<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Talla;

class CarritoController extends Controller
{
    public function agregar(Request $request)
{
    $producto = Producto::findOrFail($request->idproducto);
    $talla = Talla::findOrFail($request->talla);
    $cantidad = $request->input('cantidad', 1);

    // Obtener stock desde la tabla pivote
    $stockDisponible = $producto->tallas()->where('producto_tallas.idtalla', $talla->idtalla)->first()->pivot->stock ?? 0;

    // Verificación del stock
    if ($cantidad > $stockDisponible) {
        return redirect()->back()->withErrors(['cantidad' => 'No hay suficiente stock para la talla seleccionada.']);
    }

    $carrito = session()->get('carrito', []);
    $clave = $producto->idproducto . '-' . $talla->idtalla;
    $subcarpeta = strtolower($producto->categoria->nombre) ?: 'otros';
    $imagePath = asset('storage/' . $producto->imagen);

    // Si no existe en carrito, agregar
    if (!isset($carrito[$clave])) {
    $carrito[$clave] = [
        'idproducto' => $producto->idproducto,
        'idtalla' => $talla->idtalla,
        'producto' => $producto->nombre,
        'precio' => $producto->precio,
        'talla' => $talla->nombre,
        'cantidad' => $cantidad,
        'imagen' => $imagePath,
        'categoria' => $producto->categoria->nombre
    ];
} else {
    $nuevaCantidad = $carrito[$clave]['cantidad'] + $cantidad;

    if ($nuevaCantidad > $stockDisponible) {
        return redirect()->back()->withErrors(['cantidad' => 'No puedes agregar más de lo disponible en stock para esta talla.']);
    }

    $carrito[$clave]['cantidad'] = $nuevaCantidad;
}

    session(['carrito' => $carrito]);

    return redirect()->route('carrito.ver')->with('success', 'Producto agregado al carrito.');
}



    public function ver()
    {
        // Obtener el carrito desde la sesión
        $carrito = session('carrito', []);
        return view('categorias.carrito', compact('carrito'));
    }

    public function vaciar()
    {
        // Vaciar el carrito
        session()->forget('carrito');
        return redirect()->route('carrito.ver')->with('success', 'Carrito vaciado con éxito.');
    }

    public function eliminar(Request $request)
    {
        // Obtener la clave del producto a eliminar
        $clave = $request->clave;

        // Obtener el carrito desde la sesión
        $carrito = session()->get('carrito', []);

        // Eliminar el producto de la sesión si existe
        if (isset($carrito[$clave])) {
            unset($carrito[$clave]);
            session(['carrito' => $carrito]);
        }

        // Redirigir a la vista del carrito
        return redirect()->route('carrito.ver')->with('success', 'Producto eliminado del carrito.');
    }
}
