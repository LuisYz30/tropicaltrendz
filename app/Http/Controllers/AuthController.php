<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Procesar inicio de sesión 
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $redirect = $request->input('redirectAfterLogin');
            
            if ($redirect && strpos($redirect, '/') === 0) {
                return redirect($redirect); // Redirige a la URL anterior
            }

            // Si no hay redirección guardada, va al index por defecto
            return redirect()->route('index');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
    }

    // Mostrar formulario de registro
    public function showRegisterForm()
    {
        return view('login');
    }

    // Procesar registro
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'telefono' => 'required|string|max:20',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }
}
