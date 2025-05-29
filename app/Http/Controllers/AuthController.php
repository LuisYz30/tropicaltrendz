<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{


    //Procesar inicio de sesión 
public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $remember = ($request->has('remember') ? true : false);

        $credentials = $request->only('email','password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->rol == 'admin') {
                return redirect()->route('productos.index');
            }
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

    Auth::login($user); // Inicia sesión automáticamente después de registrarse

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
