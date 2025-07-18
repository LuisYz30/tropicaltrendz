<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.passwords.email'); // Asegúrate de tener esta vista
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
    ? back()->with('status', '¡Hemos enviado el enlace de restablecimiento a tu correo!')
    : back()->withErrors(['email' => 'No se pudo enviar el enlace. Verifica tu correo.']);
    }
}