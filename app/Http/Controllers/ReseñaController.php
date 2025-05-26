<?php

namespace App\Http\Controllers;

use App\Models\Reseña;
use Illuminate\Http\Request;

class ReseñaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
        'producto_id' => 'required|exists:productos,idproducto',
        'calificacion' => 'required|integer|min:1|max:5',
        'comentario' => 'required|string|max:1000',
        ]);

        Reseña::create([
        'producto_id' => $request->producto_id,
        'user_id' => auth()->id(),
        'calificacion' => $request->calificacion,
        'comentario' => $request->comentario,
        ]);

        return back()->with('success', '¡Gracias por tu reseña!');
    }
}
