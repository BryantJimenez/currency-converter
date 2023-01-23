<!DOCTYPE html>
<html>
<head>
	<title>Lista de Cotizaciones</title>
	<link href="{{ public_path('/admins/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

	<style>
		@page {
			margin: 50px 50px 50px;
		}

		body, h1, h2, h3, h4, h5, h6, p {
			font-family: Helvetica !important;
		}

		.text-black {
			color: #000000;
		}

		table, th, td {
			border: 1px solid #000000 !important;
			border-collapse: collapse !important;
		}

		.table td, .table th {
			line-height: 10px !important;
			padding-top: 1px !important;
			padding-left: 1px !important;
			padding-right: 1px !important;
			padding-bottom: 1px !important;
		}

		.table td.small, .table th.small {
			font-size: 10px !important;
		}
	</style>

	<div id="content mt-2">
		<h5 class="text-black text-center text-uppercase">Lista de Cotizaciones</h5>

		<div class="w-100 mt-2">
			<table class="table">
				<thead>
					<tr>
						<th class="text-black font-weight-bold small">Referencia</th>
						<th class="text-black font-weight-bold small">Fecha</th>
						<th class="text-black font-weight-bold small">Destino</th>
						<th class="text-black font-weight-bold small">Ordenante</th>
						<th class="text-black font-weight-bold small">Dirección</th>
						<th class="text-black font-weight-bold small">Teléfono</th>
						<th class="text-black font-weight-bold small">Beneficiario</th>
						<th class="text-black font-weight-bold small">Moneda</th>
						<th class="text-black font-weight-bold small">Importe</th>
						<th class="text-black font-weight-bold small">Costo Envio</th>
						<th class="text-black font-weight-bold small">Total</th>
					</tr>
				</thead>
				<tbody>
					@foreach($quotes as $quote)
					<tr>
						<td class="text-black small">{{ $quote->reference }}</td>
						<td class="text-black small">{{ $quote->created_at->format('d-m-Y') }}</td>
						<td class="text-black text-uppercase small">{{ $quote['customer_destination']['country']->name }}</td>
						<td class="text-black text-uppercase small">{{ $quote['customer_source']->fullname }}</td>
						<td class="text-black text-uppercase small">{{ $quote['customer_source']->address }}</td>
						<td class="text-black small">{{ $quote['customer_source']->phone }}</td>
						<td class="text-black text-uppercase small">{{ $quote['customer_destination']->fullname }}</td>
						<td class="text-black text-uppercase small">{{ $quote['currency_source']->name }}</td>
						<td class="text-black small">{{ number_format($quote->amount, 2, ',', '') }}</td>
						<td class="text-black small">{{ number_format($quote->commission+$quote->iva, 2, ',', '') }}</td>
						<td class="text-black small">{{ number_format($quote->total, 2, ',', '') }}</td>
					</tr>
					@endforeach
					<tr>
						<td colspan="8" class="text-black font-weight-bold small">Totales en: <span class="text-uppercase">{{ $quote['currency_source']->name }}</span></td>
						<td class="text-black font-weight-bold small">{{ number_format($quotes->sum('amount'), 2, ',', '') }}</td>
						<td class="text-black font-weight-bold small">{{ number_format($quotes->sum('commission')+$quotes->sum('iva'), 2, ',', '') }}</td>
						<td class="text-black font-weight-bold small">{{ number_format($quotes->sum('total'), 2, ',', '') }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>