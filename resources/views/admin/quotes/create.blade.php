@extends('layouts.admin')

@section('title', 'Crear Cotización')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="javascript:void(0);">Cotizaciones</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
	<a href="javascript:void(0);">Registro</a>
</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/css/elements/alert.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
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
						<h4>Crear Cotización</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">
				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('quotes.store') }}" method="POST" class="form" id="formQuote">
							@csrf
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Remitente<b class="text-danger">*</b></label>
									<select class="form-control selectpicker custom-error @error('customer_source_id') is-invalid @enderror" name="customer_source_id" required title="Seleccione" data-live-search="true" data-size="10">
										@foreach($customers as $customer)
										<option value="{{ $customer->slug }}" @if(old('customer_source_id')==$customer->slug) selected @endif>{{ $customer->fullname.' (DNI: '.$customer->dni.')' }}</option>
										@endforeach
									</select>
									<div class="custom-error-customer_source_id"></div>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Beneficiario<b class="text-danger">*</b></label>
									<select class="form-control selectpicker custom-error @error('customer_destination_id') is-invalid @enderror" name="customer_destination_id" required title="Seleccione" data-live-search="true" data-size="10">
										@foreach($customers as $customer)
										<option value="{{ $customer->slug }}" @if(old('customer_destination_id')==$customer->slug) selected @endif>{{ $customer->fullname.' (DNI: '.$customer->dni.')' }}</option>
										@endforeach
									</select>
									<div class="custom-error-customer_destination_id"></div>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Cuenta Bancaria de Destino<b class="text-danger">*</b></label>
									<select class="form-control @error('account_destination_id') is-invalid @enderror" name="account_destination_id" required>
										<option value="">Seleccione</option>
										@if(!is_null(old('customer_destination_id')))
										@foreach($customers->where('slug', old('customer_destination_id'))->first()['accounts'] ?? [] as $account)
										<option value="{{ $account->slug }}" @if(old('account_destination_id')==$account->slug) selected @endif>{{ $account->bank.' ('.$account->number.')' }}</option>
										@endforeach
										@endif
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Moneda de Origen<b class="text-danger">*</b></label>
									<select class="form-control @error('currency_source_id') is-invalid @enderror" name="currency_source_id" required>
										<option value="">Seleccione</option>
										@foreach($currencies as $currency)
										<option value="{{ $currency->slug }}" iso="{{ $currency->iso }}" @if(old('currency_source_id')==$currency->slug) selected @endif>{{ $currency->name.' ('.$currency->iso.')' }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Moneda de Destino<b class="text-danger">*</b></label>
									<select class="form-control @error('currency_destination_id') is-invalid @enderror" name="currency_destination_id" required>
										<option value="">Seleccione</option>
										@foreach($currencies as $currency)
										<option value="{{ $currency->slug }}" iso="{{ $currency->iso }}" @if(old('currency_destination_id')==$currency->slug) selected @endif>{{ $currency->name.' ('.$currency->iso.')' }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Motivo<b class="text-danger">*</b></label>
									<textarea class="form-control @error('reason') is-invalid @enderror" name="reason" required placeholder="Introduzca un motivo" rows="2">{{ old('reason') }}</textarea>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Tipo de Operación<b class="text-danger">*</b></label>
									<select class="form-control @error('type_operation') is-invalid @enderror" name="type_operation" required>
										<option value="">Seleccione</option>
										<option value="1" @if(old('type_operation')=='1') selected @endif>Pagar en Destino</option>
										<option value="2" @if(old('type_operation')=='2') selected @endif>Comisión Incluida</option>
										<option value="3" @if(old('type_operation')=='3') selected @endif>Sin Comisión</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Monto<b class="text-danger">*</b></label>
									<input class="form-control min-decimal custom-error @error('amount') is-invalid @enderror" type="text" name="amount" required placeholder="Introduzca un monto" value="{{ old('amount', 0.00) }}">
									<div class="custom-error-amount"></div>
								</div>

								@can('quotes.input.state_payment')
								<div class="form-group col-12">
									<label class="col-form-label">Estado de Pago<b class="text-danger">*</b></label>
									<select class="form-control @error('state_payment') is-invalid @enderror" name="state_payment" required>
										<option value="">Seleccione</option>
										<option value="1" @if(old('state_payment')=='1') selected @endif>Pagado en Destino</option>
										<option value="2" @if(old('state_payment')=='2') selected @endif>Pendiente</option>
										<option value="3" @if(old('state_payment')=='3') selected @endif>Inconsistente por Datos Errados</option>
									</select>
								</div>
								@endcan

								<div class="form-group col-12">
									<button type="button" class="btn btn-primary text-uppercase w-100" onclick="calculateCuote();">Calcular</button>
								</div>

								<div class="col-12">
									<livewire:admin.quotes.converter :currency_source="old('currency_source_id')" :currency_destination="old('currency_destination_id')" :type_operation="old('type_operation')" :amount="old('amount', 0.00)" />
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="quote">Guardar</button>
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
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@livewireScripts
@endsection