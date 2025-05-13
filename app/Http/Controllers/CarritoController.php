<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Talla;

class CarritoController extends Controller
{
    public function agregar(Request $request)
    {
        // Obtener el producto y talla
        $producto = Producto::findOrFail($request->idproducto);
        $talla = Talla::findOrFail($request->talla);

        $cantidad = $request->input('cantidad', 1);

        // Obtener el carrito desde la sesión
        $carrito = session()->get('carrito', []);

        // Crear una clave única combinando el ID del producto y el ID de la talla
        $clave = $producto->idproducto . '-' . $talla->idtalla;

        // Asignar la subcarpeta según la categoría del producto (por ejemplo, hombre, mujer, etc.)
        $subcarpeta = strtolower($producto->categoria->nombre); // Asumiendo que hay una relación 'categoria' con nombre

        // Si la categoría no tiene nombre o no está definida, asignamos 'otros'
        if (empty($subcarpeta)) {
            $subcarpeta = 'otros';
        }

        // Construir la ruta de la imagen
        $imagePath = 'images/' . $subcarpeta . '/' . $producto->imagen;

        // Si el producto no está en el carrito, agregarlo
        if (!isset($carrito[$clave])) {
            $carrito[$clave] = [
                'producto' => $producto->nombre,
                'precio' => $producto->precio,
                'talla' => $talla->nombre,
                'cantidad' => $cantidad,
                'imagen' => $imagePath // La ruta dinámica de la imagen
            ];
        } else {
            // Si el producto ya está en el carrito, incrementar la cantidad
            $carrito[$clave]['cantidad'] += $cantidad;
        }

        // Guardar el carrito en la sesión
        session(['carrito' => $carrito]);

        // Redirigir a la vista del carrito
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
