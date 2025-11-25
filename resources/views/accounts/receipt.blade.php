<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recibo - Cuenta {{ $account->name }}</title>

    <style>
        body {
            font-family: sans-serif;
            background: #f3f3f3;
            padding: 20px;
        }
        .ticket {
            max-width: 380px;
            margin: 0 auto;
            background: white;
            border-radius: 6px;
            padding: 20px;
            box-shadow: 0 0 10px #aaa;
        }
        h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        .info {
            font-size: 14px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            font-size: 14px;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 5px 0;
        }
        th {
            border-bottom: 1px solid #ddd;
        }
        tfoot td {
            border-top: 1px solid #ddd;
            font-weight: bold;
            padding-top: 8px;
        }
        .btn-container {
            margin-top: 20px;
            text-align: center;
        }
        .btn {
            display: inline-block;
            padding: 10px 14px;
            background: #2563eb;
            color: white;
            border-radius: 6px;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="ticket">
        <h2>Recibo de Cuenta</h2>

        <div class="info">
            <div><strong>Cuenta:</strong> {{ $account->name }}</div>
            <div><strong>Turno:</strong> {{ $account->shift->id }}</div>
            <div><strong>Fecha cierre:</strong> {{ now() }}</div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cant</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($sales as $sale)
                <tr>
                    <td>{{ $sale->product->name }}</td>
                    <td>{{ $sale->quantity }}</td>
                    <td>${{ number_format($sale->total_amount, 0) }}</td>
                </tr>
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="2">TOTAL</td>
                    <td>${{ number_format($total, 0) }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="btn-container">
            <a href="javascript:window.print()" class="btn">Imprimir</a>
            <br><br>
            <a href="{{ route('accounts.index') }}" class="btn" style="background:#475569">Volver</a>
        </div>
    </div>

</body>
</html>
