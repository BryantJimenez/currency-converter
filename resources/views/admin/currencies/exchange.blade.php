@extends('layouts.admin')

@section('title', 'Editar Tasas de Intercambio de Moneda')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="javascript:void(0);">Monedas</a>
</li>
<li class="breadcrumb-item">
	<a href="javascript:void(0);">Tasas de Intercambio</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
	<a href="javascript:void(0);">Editar</a>
</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/css/elements/alert.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.css') }}">
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">
	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-12">
						<h4>Editar Tasas de Intercambio de Moneda</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('currencies.exchanges.update', ['currency' => $currency->slug]) }}" method="POST" class="form" id="formCurrencyExchange">
							@csrf
							@method('PUT')
							<div class="row">
								@foreach($exchanges as $exchange)
								<div class="form-group col-lg-9 col-md-8 col-12">
									<label class="col-form-label">Conversión</label>
									<input class="form-control text-dark" type="text" disabled value="{{ $currency->name.' ('.$currency->iso.') a '.$exchange->name.' ('.$exchange->iso.')' }}">
									<input type="hidden" name="currency_id[{{ $loop->index }}]" value="{{ old('currency_id.'.$loop->index, $exchange->slug) }}">
								</div>

								<div class="form-group col-lg-3 col-md-4 col-12">
									<label class="col-form-label">Tasa de Conversión<b class="text-danger">*</b></label>
									<input class="form-control min-decimal custom-error @error('conversion_rate.'.$loop->index) is-invalid @enderror" type="text" name="conversion_rate[{{ $loop->index }}]" required placeholder="Introduzca una tasa" value="{{ old('conversion_rate.'.$loop->index, $exchange['exchanges_reverse']->first()['pivot']->conversion_rate ?? '') }}" id="{{ 'conversion-rate-'.$loop->index }}">
									<div class="custom-error-conversion-rate-{{ $loop->index }}"></div>
								</div>

								@if(!$loop->last)
								<div class="col-12">
									<hr>
								</div>
								@endif
								@endforeach

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary mr-0" action="currency">Actualizar</button>
										<a href="{{ route('currencies.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendor/touchspin/jquery.bootstrap-touchspin.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection