@extends('layouts.app')

@section('content')

<section class="metodo-pago-section">
 <h2 class="pago-title">Metodos de pago</h2>
    <div class="pago-container">
 

        <div class="pago-card">
            <div class="pago-img-box">
                <img src="/images/metodos_de_pago/tarjeta.png" alt="Tarjetas">
            </div>
            <h3 class="pago-titulo">Tarjetas de Crédito/Débito</h3>
            <p class="pago-descripcion">Mercadopago acepta todas las tarjetas Visa y MasterCard.</p>
        </div>

        <div class="pago-card">
            <div class="pago-img-box">
                <img src="/images/metodos_de_pago/pse.png" alt="PSE">
            </div>
            <h3 class="pago-titulo">PSE</h3>
            <p class="pago-descripcion">Pagos seguros directamente desde tu cuenta bancaria.</p>
        </div>

        <div class="pago-card">
            <div class="pago-img-box">
                <img src="/images/metodos_de_pago/efecty.png" alt="Efecty">
            </div>
            <h3 class="pago-titulo">Efecty</h3>
            <p class="pago-descripcion">Paga en efectivo en puntos autorizados Efecty.</p>
        </div>
        
        
    </div>
</section>