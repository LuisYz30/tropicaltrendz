<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
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

        if(auth::attempt($credentials)){
            $request->session()->regenerate(); // previene session fixation
            return redirect()->route('index');
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas'])->withInput();
}




public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('index');
}


}
