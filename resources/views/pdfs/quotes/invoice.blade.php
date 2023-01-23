<!DOCTYPE html>
<html>
<head>
	<title>Factura</title>
	<link href="{{ public_path('/admins/css/bootstrap/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>

	<style>
		@page {
			margin: 30px 50px 30px;
		}

		body, h1, h2, h3, h4, h5, h6, p {
			font-family: Helvetica !important;
		}

		.font-monospace {
			font-family: monospace !important;
		}

		.text-black {
			color: #000000;
		}

		.small-xs {
			font-size: 10px;
			line-height: 100%;
		}

		table, th, td {
			border: 1px solid #000000 !important;
			border-collapse: collapse !important;
		}

		.table.table-border-none, .table.table-border-none th, .table.table-border-none td {
			border: none !important;
			padding: 0px !important;
		}

		.table.table-border-none th.border-top, .table.table-border-none td.border-top {
			border-top: 1px solid #000000 !important;
		}

		.table.table-square th, .table.table-square td {
			font-size: 14px;
			line-height: 125%;
			border: none !important;
			padding-top: 1px !important;
			padding-bottom: 1px !important;
		}

		.table.table-square th.border-left, .table.table-square td.border-left {
			border-left: 1px solid #000000 !important;
		}

		.table.table-square th.border-bottom, .table.table-square td.border-bottom {
			border-bottom: 1px solid #000000 !important;
		}

		.customer-data {
			font-size: 13px;
			line-height: 125%;
		}

		hr.dashed {
			border-top: 1px dashed #000000;
			border-bottom: none;
		}
	</style>

	<div id="content mt-2">
		@foreach($types as $type)
		<div class="w-100">
			<table class="table table-square">
				<tbody>
					<tr>
						<td class="text-black my-2"><b>Via:</b> {{ $type }}</td>
						<td class="text-black text-right my-2"><b>Fecha:</b> {{ $quote->created_at->format('d-m-Y') }}</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="w-100">
			<table class="table table-square mb-2">
				<tbody>
					<tr>
						<td class="text-black font-weight-bold text-right w-25 mt-2">Monto Inicial:</td>
						<td class="text-black text-right w-25 mt-2">{{ number_format($quote->amount, 2, ",", ".").' '.$quote['currency_source']->iso }}</td>
						<td class="border-left w-50 mt-2"></td>
					</tr>
					<tr>
						<td class="text-black font-weight-bold text-right w-25">Cargo por Servicio:</td>
						<td class="text-black text-right w-25">{{ number_format($quote->commission, 2, ",", ".").' '.$quote['currency_source']->iso }}</td>
						<td class="text-black text-center border-left w-50"><b>Nro. Giro:</b> {{ $quote->reference }}</td>
					</tr>
					<tr>
						<td class="text-black font-weight-bold text-right border-bottom w-25">IVA:</td>
						<td class="text-black text-right border-bottom w-25">{{ number_format($quote->iva, 2, ",", ".").' '.$quote['currency_source']->iso }}</td>
						<td class="text-black font-weight-bold text-center border-left w-50">Monto a Recibir en Destino:</td>
					</tr>
					<tr>
						<td class="text-black font-weight-bold text-right w-25">Monto Total Recibido:</td>
						<td class="text-black text-right w-25">{{ number_format($quote->total, 2, ",", ".").' '.$quote['currency_source']->iso }}</td>
						<td class="text-black text-center border-left w-50">{{ number_format($quote->amount_destination, 2, ",", ".").' '.$quote['currency_destination']->iso }}</td>
					</tr>
					<tr>
						<td class="text-black font-weight-bold text-right w-25 mb-2">Tasa de Cambio:</td>
						<td class="text-black text-right w-25 mb-2">{{ number_format($quote->conversion_rate, 4, ",", ".") }}</td>
						<td class="border-left w-50 mb-2"></td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="w-100">
			<p class="text-black font-weight-bold mb-1">Beneficiario</p>

			<div class="customer-data">
				<p class="text-black mb-0"><b>DNI:</b> <span class="text-uppercase">{{ $quote['customer_destination']->dni }}</span></p>
				<p class="text-black mb-0"><b>Nombre:</b> <span class="text-uppercase">{{ $quote['customer_destination']->name }}</span></p>
				<p class="text-black mb-0"><b>Apellido:</b> <span class="text-uppercase">{{ $quote['customer_destination']->lastname }}</span></p>
				<p class="text-black mb-0"><b>Dirección:</b> <span class="text-uppercase">{{ $quote['customer_destination']->address }}</span></p>
				<p class="text-black mb-0"><b>Teléfono:</b> <span class="text-uppercase">{{ $quote['customer_destination']->phone }}</span></p>
				<p class="text-black mb-0"><b>Mensaje:</b> <span class="text-uppercase">{{ $quote->reason }}</span></p>
			</div>

			<hr class="my-1">

			<p class="text-black font-weight-bold mb-1">Remitente</p>

			<div class="customer-data">
				<p class="text-black mb-0"><b>Identificación:</b> <span class="text-uppercase">{{ $quote['customer_source']->dni }}</span></p>
				<p class="text-black mb-0"><b>Nombre:</b> <span class="text-uppercase">{{ $quote['customer_source']->name }}</span></p>
				<p class="text-black mb-0"><b>Apellido:</b> <span class="text-uppercase">{{ $quote['customer_source']->lastname }}</span></p>
				<p class="text-black mb-0"><b>Dirección:</b> <span class="text-uppercase">{{ $quote['customer_source']->address }}</span></p>
			</div>

			<hr class="my-1">

			<p class="text-black font-weight-bold mb-1">Datos del Deposito Bancario</p>

			<table class="table table-border-none customer-data mb-0">
				<tbody>
					<tr>
						<td class="text-black w-50 mb-0"><b>Banco:</b> <span class="text-uppercase">{{ $quote['account_destination']->bank }}</span></td>
						<td class="text-black text-right w-50 mb-0"><b>Cuenta:</b> <span class="text-uppercase">{{ $quote['account_destination']->number }}</span></td>
					</tr>
				</tbody>
			</table>
		</div>

		@if($type=='Empresa')
		<div class="w-100">
			<table class="table table-border-none mt-4 mb-2">
				<tbody>
					<tr>
						<td class="text-black font-weight-bold text-center border-top small-xs w-25 my-0">Firma Cajero</td>
						<td class="w-50 my-0"></td>
						<td class="text-black font-weight-bold text-center border-top small-xs w-25 my-0">Firma del Cliente</td>
					</tr>
				</tbody>
			</table>
		</div>
		@endif

		<div class="w-100">
			<table class="table table-border-none mb-0">
				<tbody>
					<tr>
						<td class="text-black font-monospace small my-0">Usuario: <span class="text-uppercase">{{ auth()->user()->fullname }}</span></td>
						<td class="text-black text-right font-monospace small my-0">Fecha Hora: {{ date('d-m-Y H:i:s') }}</td>
					</tr>
				</tbody>
			</table>
		</div>

		@if(!$loop->last)
		<hr class="dashed my-3">
		@endif
		@endforeach
	</div>
</body>
</html>