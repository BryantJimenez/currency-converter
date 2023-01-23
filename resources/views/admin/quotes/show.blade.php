@extends('layouts.admin')

@section('title', 'Detalles de Cotización')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="javascript:void(0);">Cotizaciones</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
	<a href="javascript:void(0);">Detalles</a>
</li>
@endsection

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row layout-top-spacing">
	<div class="col-xl-4 col-lg-6 col-md-6 col-12 layout-spacing">
		<x-card-user user="{{ $quote['customer_source']->slug }}" route="{{ route('customers.edit', ['user' => $quote['customer_source']->slug]) }}" permission="customers.edit" title="Datos del Remitente"></x-card-user>
	</div>

	<div class="col-xl-4 col-lg-6 col-md-6 col-12 layout-spacing">
		<x-card-user user="{{ $quote['customer_destination']->slug }}" route="{{ route('customers.edit', ['user' => $quote['customer_destination']->slug]) }}" permission="customers.edit" title="Datos del Beneficiario"></x-card-user>
	</div>

	<div class="col-xl-4 col-12 layout-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area p-4">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Datos de la Cotización</h3>
					@can('quotes.edit')
					<a href="{{ route('quotes.edit', ['quote' => $quote->id]) }}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
					@endcan
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2 mb-0">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Moneda de Origen:</b> {{ $quote['currency_source']->name }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Moneda de Destino:</b> {{ $quote['currency_destination']->name }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Tasa de Conversión:</b> {{ number_format($quote->conversion_rate, 4, ',', '.') }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Tipo de Operación:</b> {{ $quote->type_operation }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>A Cobrar:</b> {{ currency_format($quote->total, $quote['currency_source']->symbol, $quote['currency_source']->side, 2, ',', '.') }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Comisión:</b> {{ currency_format($quote->commission, $quote['currency_source']->symbol, $quote['currency_source']->side, 2, ',', '.') }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>IVA:</b> {{ currency_format($quote->iva, $quote['currency_source']->symbol, $quote['currency_source']->side, 2, ',', '.').' ('.$quote->iva_percentage.'%)' }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Total:</b> {{ currency_format($quote->amount, $quote['currency_source']->symbol, $quote['currency_source']->side, 2, ',', '.') }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>En Destino:</b> {{ currency_format($quote->amount_destination, $quote['currency_destination']->symbol, $quote['currency_destination']->side, 2, ',', '.') }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Cuenta Bancaria de Destino:</b> @if(!is_null($quote['account_destination'])){{ $quote['account_destination']->bank.' ('.$quote['account_destination']->number.')' }}@else{{ 'No Ingresado' }}@endif</span>
							</li>

							<li class="contacts-block__item">
								@can('quotes.pdf.invoice')
								<a href="{{ route('quotes.pdf.invoice', ['quote' => $quote->id]) }}" class="btn btn-primary" target="_blank">Factura</a>
								@endcan
								<a href="{{ route('quotes.index') }}" class="btn btn-secondary">Volver</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
@endsection