<form method="POST" action="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/" id="payu-form">
    <input name="merchantId"    type="hidden" value="{{ $merchantId }}">
    <input name="accountId"     type="hidden" value="{{ $accountId }}">
    <input name="description"   type="hidden" value="Compra en Tropical Trendz">
    <input name="referenceCode" type="hidden" value="{{ $referenceCode }}">
    <input name="amount"        type="hidden" value="{{ $amount }}">
    <input name="tax"           type="hidden" value="0">
    <input name="taxReturnBase" type="hidden" value="0">
    <input name="currency"      type="hidden" value="COP">
    <input name="signature"     type="hidden" value="{{ $signature }}">
    <input name="test"          type="hidden" value="1"> {{-- Cambia a 0 en producción --}}
    <input name="buyerEmail"    type="hidden" value="{{ $buyerEmail }}">
    <input name="responseUrl"   type="hidden" value="{{ url('/pago/exito') }}">
    <input name="confirmationUrl" type="hidden" value="{{ url('/pago/confirmacion') }}">
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('payu-form').submit();
    });
</script>