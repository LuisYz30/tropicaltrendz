<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MercadoPago\Resources\Payment;
use MercadoPago\MercadoPagoConfig;

class PagoController extends Controller
{
    public function pagar()
    {
        MercadoPagoConfig::setAccessToken(env('APP_USR-8709899275358984-042910-09d66948345146a7d26d0b78795db0be-513783823'));

        $carrito = session('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito.ver')->with('error', 'El carrito está vacío.');
        }

        $items = [];
        foreach ($carrito as $producto) {
            $items[] = [
                "title" => $producto['producto'] . ' (Talla: ' . $producto['talla_nombre'] . ')',
                "quantity" => intval($producto['cantidad']),
                "unit_price" => floatval($producto['precio']),
                "currency_id" => "COP"
            ];
        }

        $preferenceData = [
            "items" => $items,
            "back_urls" => [
                "success" => route('pago.exito'),
                "failure" => route('pago.fallo'),
                "pending" => route('pago.pendiente'),
            ],
        ];

        $client = new \MercadoPago\Client\Preference\PreferenceClient();
        $preference = $client->create($preferenceData);

        return redirect($preference->init_point);
    }

    public function exito(Request $request)
{
    $paymentId = $request->query('payment_id');
    if (!$paymentId) {
        return redirect()->route('carrito.ver')->with('error', 'No se recibió el ID del pago.');
    }

    MercadoPagoConfig::setAccessToken(env('APP_USR-8709899275358984-042910-09d66948345146a7d26d0b78795db0be-513783823'));

    try {
        $paymentClient = new \MercadoPago\Client\payment\PaymentClient();
        $payment = $paymentClient->get($paymentId);

        if ($payment && $payment->status === 'approved') {
            $carrito = session('carrito', []);

            foreach ($carrito as $item) {
                DB::table('producto_tallas')
                    ->where('idproducto', $item['idproducto'])
                    ->where('idtalla', $item['idtalla'])
                    ->decrement('stock', $item['cantidad']);
            }

            session()->forget('carrito');

            return view('pagos.exito')->with('message', 'Pago aprobado y stock actualizado.');
        } else {
            return redirect()->route('carrito.ver')->with('error', 'El pago no fue aprobado.');
        }
    } catch (\Exception $e) {
        Log::error('Error verificando pago o actualizando stock: ' . $e->getMessage());
        return redirect()->route('carrito.ver')->with('error', 'Error procesando el pago.');
    }
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
