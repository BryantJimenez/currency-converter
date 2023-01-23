@extends('layouts.admin')

@section('title', 'Editar Ajustes')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="javascript:void(0);">Ajustes</a>
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
						<h4>Editar Ajustes</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('settings.update') }}" method="POST" class="form" id="formSetting">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-lg-4 col-md-4 col-12">
									<label class="col-form-label">Comisión Fija (Menos de {{ number_format($settings->max_fixed_commission ?? 80000.00, 2, ',', '.') }})<b class="text-danger">*</b></label>
									<input class="form-control decimal custom-error @error('fixed_commission') is-invalid @enderror" type="text" name="fixed_commission" required placeholder="Introduzca una comisión" value="{{ old('fixed_commission', $setting->fixed_commission ?? 0.00) }}">
									<div class="custom-error-fixed_commission"></div>
								</div>

								<div class="form-group col-lg-4 col-md-4 col-12">
									<label class="col-form-label">Comisión Porcentual (Desde {{ number_format($settings->max_fixed_commission ?? 80000.00, 2, ',', '.') }})<b class="text-danger">*</b></label>
									<input class="form-control percentage-decimal custom-error @error('percentage_commission') is-invalid @enderror" type="text" name="percentage_commission" required placeholder="Introduzca una comisión" value="{{ old('percentage_commission', $setting->percentage_commission ?? 0.00) }}">
									<div class="custom-error-percentage_commission"></div>
								</div>

								<div class="form-group col-lg-4 col-md-4 col-12">
									<label class="col-form-label">IVA (%)<b class="text-danger">*</b></label>
									<input class="form-control percentage-decimal custom-error @error('iva') is-invalid @enderror" type="text" name="iva" required placeholder="Introduzca un IVA" value="{{ old('iva', $setting->iva ?? 0.00) }}">
									<div class="custom-error-iva"></div>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary mr-0" action="setting">Actualizar</button>
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