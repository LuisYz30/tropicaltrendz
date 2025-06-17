<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; 


class PerfilController extends Controller
{
    public function edit()
    {
        return view('cliente.editPerfil', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        

        $request->validate([
            'name' => 'required|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:100',
        ]);

        $user->name = $request->name;
        $user->telefono = $request->telefono;
        $user->direccion = $request->direccion;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('index')->with('success', 'Perfil actualizado correctamente.');
    }
}
