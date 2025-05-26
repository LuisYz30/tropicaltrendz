<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request){
        $user = User::create($request->validated());
        return redirect()->route('index')->with('success', 'Usuario registrado correctamente');
    }
}
