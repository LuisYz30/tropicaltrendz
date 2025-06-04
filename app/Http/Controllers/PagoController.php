<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use Illuminate\Support\Facades\Log;

class PagoController extends Controller
{
    public function pagar()
{
    try {
        // Configurar el token de acceso
        MercadoPagoConfig::setAccessToken('APP_USR-8709899275358984-042910-09d66948345146a7d26d0b78795db0be-513783823');

        $carrito = session('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito.ver')->with('error', 'El carrito está vacío.');
        }

        // Construir el array de items para la preferencia
        $items = [];
        foreach ($carrito as $producto) {
            $items[] = [
                "title" => $producto['producto'] . ' (Talla: ' . $producto['talla'] . ')',
                "quantity" => intval($producto['cantidad']),
                "unit_price" => floatval($producto['precio']),
                "currency_id" => "COP"
            ];
        }

        // Datos para la preferencia
        $preferenceData = [
            "items" => $items,
            "back_urls" => [
                "success" => route('pago.exito'),   // **Muy importante que esta ruta exista y esté bien definida**
                "failure" => route('pago.fallo'),
                "pending" => route('pago.pendiente'),
            ],
            
        ];

        // Log para verificar URLs
        Log::info('URL pago.exito generada: ' . route('pago.exito'));

        // Crear preferencia usando PreferenceClient
        $client = new PreferenceClient();
        $preference = $client->create($preferenceData);

        // Redirigir al init_point
        return redirect($preference->init_point);

    } catch (\MercadoPago\Exceptions\MPApiException $e) {
        $response = $e->getApiResponse();
        $errorMessage = $response ? json_encode($response->getContent(), JSON_PRETTY_PRINT) : $e->getMessage();
        Log::error('Error al crear preferencia de MercadoPago (MPApiException): ' . $errorMessage);
        return redirect()->route('carrito.ver')->with('error', 'Ocurrió un error al procesar el pago.');
    } catch (\Exception $e) {
        Log::error('Error general al crear preferencia de MercadoPago: ' . $e->getMessage());
        return redirect()->route('carrito.ver')->with('error', 'Ocurrió un error inesperado al procesar el pago.');
    }
}

    public function exito()
    {
        return view('pagos.exito');
    }

    public function fallo()
    {
        return view('pagos.fallo');
    }

    public function pendiente()
    {
        return view('pagos.pendiente');
    }
}
