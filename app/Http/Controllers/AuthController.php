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
            
            // Mensaje flash de éxito
            session()->flash('success', 'Inicio de sesión exitoso.');

            if ($redirect && strpos($redirect, '/') === 0) {
                return redirect($redirect); // Redirige a la URL anterior
            }

            return redirect()->route('index');
        }

        // Error de autenticación
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

        // Crear usuario
        $user = User::create([
            'name' => $request->name,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Iniciar sesión automáticamente
        Auth::login($user);

        // Mensaje flash de éxito
        return redirect()->route('index')->with('success', 'Registro exitoso. ¡Bienvenido a Tropical Trendz!');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Mensaje flash de cierre de sesión
        return redirect()->route('index')->with('success', 'Sesión cerrada correctamente.');
    }
}
