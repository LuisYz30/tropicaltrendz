<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Models\CarritoTemporal;
use App\Models\Factura;
use App\Models\DetalleFactura;
use Carbon\Carbon;

class PagoController extends Controller
{
    public function pagar()
{
    $carrito = session('carrito', []);
    if (empty($carrito)) {
        return redirect()->route('carrito.ver')->with('error', 'El carrito está vacío.');
    }

    $total = 0;
    foreach ($carrito as $item) {
        $total += floatval( $item['precio']) * intval($item['cantidad']);
    }
    $total = number_format($total, 2, '.', '');
    $userId = Auth::id();
    if (!$userId) {
        return redirect()->route('login')->with('error', 'Debes iniciar sesión para pagar.');
    }

    // Datos PayU
    $apiKey     = env('PAYU_API_KEY');
    $merchantId = env('PAYU_MERCHANT_ID');
    $accountId  = env('PAYU_ACCOUNT_ID');
    $reference  = 'ORDER-' . uniqid();
    $currency   = 'COP';
    $signature  = md5("$apiKey~$merchantId~$reference~$total~$currency");
    $test       = env('PAYU_TEST', 'true') === 'true' ? 1 : 0;


    // Guarda el carrito con la referencia única generada
    CarritoTemporal::create([
        'referencia' => $reference,
        'user_id' => $userId,
        'datos' => json_encode($carrito),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    session(['user_id_pago' => $userId]);

    return view('pagos.formulario_payu', [
        'merchantId'        => $merchantId,
        'accountId'         => $accountId,
        'description'       => 'Compra en Tropical Trendz',
        'referenceCode'     => $reference,
        'amount'            => $total,
        'currency'          => $currency,
        'signature'         => $signature,
        'buyerEmail'        => Auth::user()->email,
        'test'              => $test,
        'responseUrl'       => env('PAYU_RESPONSE_URL'),
        'confirmationUrl'   => env('PAYU_CONFIRMATION_URL'),
    ]);
}

    public function exito(Request $request)
{
    $referencia = $request->input('referenceCode'); // Viene desde PayU
    $userId = session('user_id_pago');
    $carrito = session('carrito', []);

    // Si no hay sesión, buscamos en la tabla carrito_temporal
    if (empty($carrito) || !$userId) {
        $registro = DB::table('carrito_temporal')->where('referencia', $referencia)->first();

        if (!$registro) {
            Log::error("No se encontró carrito para referencia $referencia");
            return redirect()->route('carrito.ver')->with('error', 'No se pudo procesar el pago.');
        }

        $carrito = json_decode($registro->datos, true);
        $userId = $registro->user_id;
    }

    // Continuamos con la creación de factura como siempre
    $totalCompra = 0;
    foreach ($carrito as $item) {
        $totalCompra += $item['precio'] * $item['cantidad'];
    }

    $factura = Factura::create([
        'user_id' => $userId,
        'fecha' => Carbon::now(),
        'metodo_pago_id' => 1, // PayU
        'total' => $totalCompra,
    ]);

    foreach ($carrito as $item) {
    $producto = DB::table('productos')
        ->join('categorias', 'productos.idcategoria', '=', 'categorias.idcategoria')
        ->select('productos.nombre as nombre_producto', 'categorias.nombre as categoria')
        ->where('productos.idproducto', $item['idproducto'])
        ->first();

    DetalleFactura::create([
        'factura_id' => $factura->id,
        'idproducto' => $item['idproducto'],
        'nombre_producto' => $producto->nombre_producto ?? 'Producto eliminado',
        'categoria' => $producto->categoria ?? 'Sin categoría',
        'idtalla' => $item['idtalla'],
        'cantidad' => $item['cantidad'],
        'precio_unitario' => $item['precio'],
    ]);
        session(['factura_id' => $factura->id]);

        DB::table('producto_tallas')
            ->where('idproducto', $item['idproducto'])
            ->where('idtalla', $item['idtalla'])
            ->decrement('stock', $item['cantidad']);
    }

    // Limpia la sesión y elimina el carrito temporal
    session()->forget('carrito');
    session()->forget('user_id_pago');
    DB::table('carrito_temporal')->where('referencia', $referencia)->delete();

    return view('pagos.exito')->with('message', '¡Pago exitoso con PayU');
}

public function confirmacion(Request $request)
{
    try {
        $state = $request->input('transactionState');
        $reference = $request->input('reference_sale');
        $amount = floatval($request->input('value'));
        $currency = $request->input('currency');
        $signatureRecibida = $request->input('sign');

        // Validar la firma
        $apiKey = env('PAYU_API_KEY');
        $merchantId = env('PAYU_MERCHANT_ID');
        $signatureEsperada = md5("$apiKey~$merchantId~$reference~$amount~$currency");

        if ($signatureRecibida !== $signatureEsperada) {
            Log::warning("Firma inválida en confirmación PayU: referencia $reference");
            return response('Firma inválida', 400);
        }

        if ($state != 4) {
            Log::info("Pago no aprobado en confirmación PayU: estado $state, referencia $reference");
            return response('Pago no aprobado', 200);
        }

        // Buscar carrito temporal
        $carritoTemporal = DB::table('carrito_temporal')->where('referencia', $reference)->first();

        if (!$carritoTemporal) {
            Log::error("No se encontró carrito temporal con referencia: $reference");
            return response('Carrito no encontrado', 404);
        }

        $carrito = json_decode($carritoTemporal->datos, true);
        $userId = $carritoTemporal->user_id;

        $factura = Factura::create([
            'user_id' => $userId,
            'fecha' => Carbon::now(),
            'metodo_pago_id' => 1, // PayU
            'total' => $amount,
        ]);

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

        // Limpiar carrito temporal
        DB::table('carrito_temporal')->where('referencia', $reference)->delete();

        Log::info("Confirmación exitosa: factura $factura->id generada");
        return response('OK', 200);

    } catch (\Exception $e) {
        Log::error('Error en confirmación PayU: ' . $e->getMessage());
        return response('Error en confirmación', 500);
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
