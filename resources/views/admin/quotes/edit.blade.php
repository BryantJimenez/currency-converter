@extends('layouts.admin')

@section('title', 'Editar Cotización')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="javascript:void(0);">Cotizaciones</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
	<a href="javascript:void(0);">Editar</a>
</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/css/elements/alert.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@livewireStyles
@endsection

@section('content')

<div class="row layout-top-spacing">
	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-12">
						<h4>Editar Cotización</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('quotes.update', ['quote' => $quote->id]) }}" method="POST" class="form" id="formQuote">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Remitente<b class="text-danger">*</b></label>
									<select class="form-control selectpicker custom-error @error('customer_source_id') is-invalid @enderror" name="customer_source_id" required title="Seleccione" data-live-search="true" data-size="10">
										@foreach($customers as $customer)
										<option value="{{ $customer->slug }}" @if(old('customer_source_id', $quote['customer_source']->slug ?? NULL)==$customer->slug) selected @endif>{{ $customer->fullname.' (DNI: '.$customer->dni.')' }}</option>
										@endforeach
									</select>
									<div class="custom-error-customer_source_id"></div>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Beneficiario<b class="text-danger">*</b></label>
									<select class="form-control selectpicker custom-error @error('customer_destination_id') is-invalid @enderror" name="customer_destination_id" required title="Seleccione" data-live-search="true" data-size="10">
										@foreach($customers as $customer)
										<option value="{{ $customer->slug }}" @if(old('customer_destination_id', $quote['customer_destination']->slug ?? NULL)==$customer->slug) selected @endif>{{ $customer->fullname.' (DNI: '.$customer->dni.')' }}</option>
										@endforeach
									</select>
									<div class="custom-error-customer_destination_id"></div>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Cuenta Bancaria de Destino<b class="text-danger">*</b></label>
									<select class="form-control @error('account_destination_id') is-invalid @enderror" name="account_destination_id" required>
										<option value="">Seleccione</option>
										@if(!is_null(old('customer_destination_id', $quote['customer_destination']->slug ?? NULL)))
										@foreach($customers->where('slug', old('customer_destination_id', $quote['customer_destination']->slug ?? NULL))->first()['accounts'] ?? [] as $account)
										<option value="{{ $account->slug }}" @if(old('account_destination_id', $quote['account_destination']->slug ?? NULL)==$account->slug) selected @endif>{{ $account->bank.' ('.$account->number.')' }}</option>
										@endforeach
										@endif
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Moneda de Origen<b class="text-danger">*</b></label>
									<select class="form-control @error('currency_source_id') is-invalid @enderror" name="currency_source_id" required>
										<option value="">Seleccione</option>
										@foreach($currencies as $currency)
										<option value="{{ $currency->slug }}" @if(old('currency_source_id', $quote['currency_source']->slug ?? NULL)==$currency->slug) selected @endif>{{ $currency->name.' ('.$currency->iso.')' }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Moneda de Destino<b class="text-danger">*</b></label>
									<select class="form-control @error('currency_destination_id') is-invalid @enderror" name="currency_destination_id" required>
										<option value="">Seleccione</option>
										@foreach($currencies as $currency)
										<option value="{{ $currency->slug }}" @if(old('currency_destination_id', $quote['currency_destination']->slug ?? NULL)==$currency->slug) selected @endif>{{ $currency->name.' ('.$currency->iso.')' }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Motivo<b class="text-danger">*</b></label>
									<textarea class="form-control @error('reason') is-invalid @enderror" name="reason" required placeholder="Introduzca un motivo" rows="2">{{ old('reason', $quote->reason) }}</textarea>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Tipo de Operación<b class="text-danger">*</b></label>
									<select class="form-control @error('type_operation') is-invalid @enderror" name="type_operation" required>
										<option value="">Seleccione</option>
										<option value="1" @if(old('type_operation', $quote->type_operation)=='1' || old('type_operation', $quote->type_operation)=='Pagar en Destino') selected @endif>Pagar en Destino</option>
										<option value="2" @if(old('type_operation', $quote->type_operation)=='2' || old('type_operation', $quote->type_operation)=='Comisión Incluida') selected @endif>Comisión Incluida</option>
										<option value="3" @if(old('type_operation', $quote->type_operation)=='3' || old('type_operation', $quote->type_operation)=='Sin Comisión') selected @endif>Sin Comisión</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Monto<b class="text-danger">*</b></label>
									<input class="form-control min-decimal custom-error @error('amount') is-invalid @enderror" type="text" name="amount" required placeholder="Introduzca un monto" value="{{ old('amount', ($quote->type_operation_original=='1') ? $quote->amount_destination : $quote->amount) }}">
									<div class="custom-error-amount"></div>
								</div>

								<div class="form-group col-12">
									<button type="button" class="btn btn-primary text-uppercase w-100" onclick="calculateCuote();">Calcular</button>
								</div>

								<div class="col-12">
									<livewire:admin.quotes.converter :currency_source="old('currency_source_id', $quote['currency_source']->slug)" :currency_destination="old('currency_destination_id', $quote['currency_destination']->slug)" :type_operation="old('type_operation', $quote->type_operation_original)" :amount="($quote->type_operation_original=='1') ? old('amount', $quote->amount_destination) : old('amount', $quote->amount)" />
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary mr-0" action="quote">Actualizar</button>
										<a href="{{ route('quotes.index') }}" class="btn btn-secondary">Volver</a>
									</div>
								</div> 
							</div>
						</form>
					</div>                                        
				</div>

			</div>
		</div>
	</div>

</div>

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@livewireScripts
@endsection