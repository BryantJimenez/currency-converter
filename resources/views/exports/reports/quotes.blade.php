<!DOCTYPE html>
<html>
<head>
    <title>Cotizaciones</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th style="font-weight: bold;">Referencia</th>
                <th style="font-weight: bold;">Fecha</th>
                <th style="font-weight: bold;">Destino</th>
                <th style="font-weight: bold;">Ordenante</th>
                <th style="font-weight: bold;">Dirección</th>
                <th style="font-weight: bold;">Teléfono</th>
                <th style="font-weight: bold;">Beneficiario</th>
                <th style="font-weight: bold;">Moneda</th>
                <th style="font-weight: bold;">Importe</th>
                <th style="font-weight: bold;">Costo Envio</th>
                <th style="font-weight: bold;">Total</th>
                <th style="font-weight: bold;">Usuario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quotes as $quote)
            <tr>
                <td>{{ $quote->reference }}</td>
                <td>{{ $quote->created_at->format('d-m-Y') }}</td>
                <td>{{ mb_strtoupper($quote['customer_destination']['country']->name, 'UTF-8') }}</td>
                <td>{{ mb_strtoupper($quote['customer_source']->fullname, 'UTF-8') }}</td>
                <td>{{ mb_strtoupper($quote['customer_source']->address, 'UTF-8') }}</td>
                <td>{{ $quote['customer_source']->phone }}</td>
                <td>{{ mb_strtoupper($quote['customer_destination']->fullname, 'UTF-8') }}</td>
                <td>{{ mb_strtoupper($quote['currency_source']->name, 'UTF-8') }}</td>
                <td>{{ number_format($quote->amount, 2, ',', '') }}</td>
                <td>{{ number_format($quote->commission+$quote->iva, 2, ',', '') }}</td>
                <td>{{ number_format($quote->total, 2, ',', '') }}</td>
                <td>{{ mb_strtoupper($quote['user']->fullname ?? '', 'UTF-8') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="8" style="font-weight: bold;">Totales en: {{ mb_strtoupper($quote['currency_source']->name, 'UTF-8') }}</td>
                <td style="font-weight: bold;">{{ number_format($quotes->sum('amount'), 2, ',', '') }}</td>
                <td style="font-weight: bold;">{{ number_format($quotes->sum('commission')+$quotes->sum('iva'), 2, ',', '') }}</td>
                <td colspan="2" style="font-weight: bold;">{{ number_format($quotes->sum('total'), 2, ',', '') }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>