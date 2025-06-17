<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MercadoPago\Resources\Payment;
use MercadoPago\MercadoPagoConfig;
use App\Models\Factura;
use Illuminate\Support\Facades\Auth;
use App\Models\DetalleFactura;
use Carbon\Carbon;

class PagoController extends Controller
{
    public function pagar()
    {
        MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

        $carrito = session('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito.ver')->with('error', 'El carrito está vacío.');
        }

        $items = [];
        foreach ($carrito as $producto) {
            $items[] = [
                "title" => $producto['producto'] . ' (Talla: ' . $producto['talla'] . ')',
                "quantity" => intval($producto['cantidad']),
                "unit_price" => floatval($producto['precio']),
                "currency_id" => "COP"
            ];
        }

        $userId = Auth::id();
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para continuar con el pago.');
        }

        session(['user_id_pago' => $userId]);

        $preferenceData = [
            "items" => $items,
            "back_urls" => [
                "success" => "https://5996-186-102-5-59.ngrok-free.app/pago/exito",
                "failure" => "https://5996-186-102-5-59.ngrok-free.app/pago/fallo",
                "pending" => "https://5996-186-102-5-59.ngrok-free.app/pago/pendiente",
            ],
            "auto_return" => "approved",
            "metadata" => [
                "user_id" => $userId
            ]
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

        MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

        try {
            $paymentClient = new \MercadoPago\Client\Payment\PaymentClient();
            $payment = $paymentClient->get($paymentId);

            // Para depuración (puedes quitarlo cuando confirmes que funciona bien)
            // dd($payment);

            if ($payment && $payment->status === 'approved') {
                $carrito = session('carrito', []);
                $totalCompra = 0;

                foreach ($carrito as $item) {
                    $totalCompra += $item['precio'] * $item['cantidad'];
                }

                $userId = session('user_id_pago');

                if (!$userId) {
                    Log::error('No se pudo recuperar user_id: ni en metadata ni en sesión.');
                    return redirect()->route('carrito.ver')->with('error', 'No se pudo recuperar el usuario para la factura.');
                }

                $factura = Factura::create([
                    'user_id' => $userId,
                    'fecha' => Carbon::now(),
                    'metodo_pago_id' => 1,
                    'total' => $totalCompra,
                ]);

                Log::info('Factura creada ID: ' . $factura->id);

                foreach ($carrito as $item) {
                    $nombreProducto = DB::table('productos')
                        ->where('idproducto', $item['idproducto'])
                        ->value('nombre');

                    DetalleFactura::create([
                        'factura_id' => $factura->id,
                        'idproducto' => $item['idproducto'],
                        'nombre_producto' => $nombreProducto,
                        'categoria' => $item['categoria'] ?? 'N/A',
                        'idtalla' => $item['idtalla'],
                        'cantidad' => $item['cantidad'],
                        'precio_unitario' => $item['precio'],
                    ]);

                    DB::table('producto_tallas')
                        ->where('idproducto', $item['idproducto'])
                        ->where('idtalla', $item['idtalla'])
                        ->decrement('stock', $item['cantidad']);
                }

                session()->forget('carrito');
                session()->forget('user_id_pago');

                return view('pagos.exito')->with('message', 'Pago aprobado y stock actualizado.');
            } else {
                return redirect()->route('carrito.ver')->with('error', 'El pago no fue aprobado.');
            }
        } catch (\Exception $e) {
    Log::error('Error verificando pago o actualizando stock: ' . $e->getMessage());
    return response()->json([
        'error' => 'Error procesando el pago.',
        'mensaje' => $e->getMessage(),
        'linea' => $e->getLine(),
        'archivo' => $e->getFile()
    ]);
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
