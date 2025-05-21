<?php

namespace App\Http\Controllers;

use App\Models\Resena;
use Illuminate\Http\Request;

class ResenaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'calificacion' => 'required|integer|min:1|max:5',
            'opinion' => 'required|string',
            'seccion' => 'required|in:hombre,mujer,niños',
        ]);

        Resena::create($request->all());

        return back()->with('success', '¡Gracias por tu reseña!');
    }

    public function index($seccion)
    {
        $resenas = Resena::where('seccion', $seccion)->latest()->get();
        return view('resenas.index', compact('resenas', 'seccion'));
    }
}
