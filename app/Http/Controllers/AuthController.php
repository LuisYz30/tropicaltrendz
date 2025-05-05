<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Mostrar formulario de login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    //Procesar inicio de sesión 
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if(auth::attempt($credentials)){
            // Autenticación exitosa, ambos roles van al mismo lugar
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
    }

}
