<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use MercadoPago\Resources\Payment;
use MercadoPago\MercadoPagoConfig;
use App\Models\Factura;
use App\Models\DetalleFactura;
use Carbon\Carbon;

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
            $totalCompra = 0;

            // Calcular total
            foreach ($carrito as $item) {
                $totalCompra += $item['precio'] * $item['cantidad'];
            }

            // Guardar factura
            $factura = Factura::create([
                'user_id' => auth()->id(),
                'fecha' => Carbon::now(),
                'metodo_pago_id' => 1, // Si tienes método MercadoPago en metodo_pagos, asigna su id
                'total' => $totalCompra,
            ]);

            // Guardar detalle factura y actualizar stock
            foreach ($carrito as $item) {
                DetalleFactura::create([
                    'factura_id' => $factura->id,
                    'idproducto' => $item['idproducto'],
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
