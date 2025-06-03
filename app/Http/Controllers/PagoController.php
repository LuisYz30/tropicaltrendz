<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Preference\Preference;
use MercadoPago\Preference\Item;

class PagoController extends Controller
{
    public function pagar()
    {
        // Configura tus credenciales (temporalmente aquí)
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));


        $carrito = session('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito.ver')->with('error', 'El carrito está vacío.');
        }

        $preference = new Preference();

        foreach ($carrito as $item) {
            $product = new Item();
            $product->title = $item['producto'] . ' (Talla: ' . $item['talla'] . ')';
            $product->quantity = $item['cantidad'];
            $product->unit_price = floatval($item['precio']);
            $preference->items[] = $product;
        }

        // URLs de retorno
        $preference->back_urls = [
            "success" => route('pago.exito'),
            "failure" => route('pago.fallo'),
            "pending" => route('pago.pendiente')
        ];
        $preference->auto_return = "approved";

        $preference->save();

        return redirect($preference->init_point);
    }

    public function exito() {
        return view('pagos.exito');
    }

    public function fallo() {
        return view('pagos.fallo');
    }

    public function pendiente() {
        return view('pagos.pendiente');
    }
}
