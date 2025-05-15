<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function hombre(Request $request)
    {
        $categoria = Categoria::where('nombre', 'Hombre')->firstOrFail();
    
        $query = Producto::where('idcategoria', $categoria->idcategoria);
    
        if ($request->filled('precio_min')) {
            $query->where('precio', '>=', $request->precio_min);
        }
    
        if ($request->filled('precio_max')) {
            $query->where('precio', '<=', $request->precio_max);
        }
    
        $productos = $query->get();
    
        return view('categorias.hombre', compact('productos', 'request'));
    }

    public function mujer()
    {
        $categoria = Categoria::where('nombre', 'Mujer')->firstOrFail();
        $productos = Producto::where('idcategoria', $categoria->idcategoria)->get();
        return view('categorias.mujer', compact('productos'));
    }

    public function niños()
    {
        $categoria = Categoria::where('nombre', 'Niños')->firstOrFail();
        $productos = Producto::where('idcategoria', $categoria->idcategoria)->get();
        return view('categorias.niños', compact('productos'));
    }

    public function detalleProducto($id)
    {
        $producto = Producto::with('tallas')->findOrFail($id);
        $tallas = $producto->tallas;

        return view('categorias.detalle', compact('producto', 'tallas'));
    }
}


    // public function ofertas()
    // {
    //     $productos = Producto::where('oferta', true)->get(); // Asegúrate que la tabla tenga un campo "oferta"
    //     return view('categorias.ofertas', compact('productos'));
    // }
   
