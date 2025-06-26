
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura</title>
    <link rel="stylesheet" href="{{ public_path('css/factura.css') }}">
</head>
<body>
    <div class="main-content">
    <div class="clearfix">
        <div class="logo">
             <img src="{{ public_path('images/LogoEmpresa/LogoTT_sinfondo.png') }}" alt="Logo" style="max-height: 200px;">
        </div>
        <div class="factura-info">
            <h2>FACTURA</h2>
            <p>Nº {{ $factura->id }}</p>
        </div>
    </div>

    <div class="contacto">INFORMACIÓN DE CONTACTO</div>
    <div class="contacto-info">
        <p><strong>Nombre:</strong> {{ $factura->user->name }}</p>
        <p><strong>Correo:</strong> {{ $factura->user->email }}</p>
        <p><strong>Fecha:</strong> {{ $factura->fecha->format('d/m/Y') }}</p>
        <p><strong>Método de Pago:</strong> PayU</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>DESCRIPCIÓN</th>
                <th>TALLA</th>
                <th>CANTIDAD</th>
                <th>PRECIO</th>
            </tr>
        </thead>
        <tbody>
            @foreach($factura->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->nombre_producto }}</td>
                    <td>{{ $detalle->idtalla }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->precio_unitario, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">TOTAL: ${{ number_format($factura->total, 0, ',', '.') }}</p>

    </div>

    <footer>
        <p>322 3290696</p>
        <p>tropitrendz@gmail.com</p>
        <p>www.Tropical_Trendz.com</p>
   </footer>

</body>
</html>

