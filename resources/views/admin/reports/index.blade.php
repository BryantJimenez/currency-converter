@extends('layouts.admin')

@section('title', 'Exportar Reportes')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="javascript:void(0);">Reportes</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
	<a href="javascript:void(0);">Exportar</a>
</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/css/elements/alert.css') }}">
<link href="{{ asset('/admins/vendor/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('/admins/vendor/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('/admins/vendor/bootstrap-select/bootstrap-select.min.css') }}">
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
						<h4>Exportar Reportes de Cotizaciones</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('reports.export') }}" method="POST" class="form" id="formReport">
							@csrf
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">Usuario (Opcional)</label>
									<select class="form-control selectpicker custom-error @error('user_id') is-invalid @enderror" name="user_id" title="Seleccione" data-live-search="true" data-size="10">
										<option value="">Seleccione</option>
										@foreach($users as $user)
										<option value="{{ $user->slug }}" @if(old('user_id')==$user->slug) selected @endif>{{ $user->fullname }}</option>
										@endforeach
									</select>
									<div class="custom-error-user_id"></div>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Fecha de Inicio<b class="text-danger">*</b></label>
									<input class="form-control" type="text" name="start" placeholder="Seleccione una fecha" value="{{ old('start') }}" id="startDateSearchFlatpickr">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Fecha Final<b class="text-danger">*</b></label>
									<input class="form-control" type="text" name="end" placeholder="Seleccione una fecha" value="{{ old('end') }}" id="endDateSearchFlatpickr">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Moneda de Origen<b class="text-danger">*</b></label>
									<select class="form-control @error('currency_id') is-invalid @enderror" name="currency_id" required>
										<option value="">Seleccione</option>
										@foreach($currencies as $currency)
										<option value="{{ $currency->slug }}" @if(old('currency_id')==$currency->slug) selected @endif>{{ $currency->name.' ('.$currency->iso.')' }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Tipo de Documento<b class="text-danger">*</b></label>
									<select class="form-control @error('type') is-invalid @enderror" name="type" required>
										<option value="">Seleccione</option>
										<option value="1" @if(old('type')=='1') selected @endif>PDF</option>
										<option value="2" @if(old('type')=='2') selected @endif>Excel</option>
									</select>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary mr-0" action="report">Exportar</button>
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
<script src="{{ asset('/admins/vendor/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('/admins/vendor/flatpickr/es.js') }}"></script>
<script src="{{ asset('/admins/vendor/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection