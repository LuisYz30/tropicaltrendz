@component('mail::message')
{{-- Logo y título --}}
<div style="text-align: center; background-color: #001F77; padding: 20px 0;">
    <img src="{{ asset('images/logo-tropical.png') }}" alt="Logo Tropical Trendz" style="max-width: 150px; margin-bottom: 10px;">
</div>

{{-- Contenedor principal --}}
<div style="background-color: #ffffff; padding: 40px; border-radius: 10px; font-family: 'Segoe UI', sans-serif; color: #333;">

# ¿Olvidaste tu contraseña?

Hemos recibido una solicitud para restablecer tu contraseña. Haz clic en el botón de abajo para continuar:

@component('mail::button', ['url' => $actionUrl, 'color' => 'primary'])
Restablecer contraseña
@endcomponent

Este enlace expirará en 60 minutos.  
Si no solicitaste este cambio, puedes ignorar este mensaje.

Gracias,  
**El equipo de Tropical Trendz**
</div>

{{-- Footer --}}
<div style="text-align: center; padding: 20px; font-size: 12px; color: #ffffff; background-color: #001F77; border-radius: 0 0 10px 10px;">
    © {{ date('Y') }} Tropical Trendz. Todos los derechos reservados.
</div>
@endcomponent
