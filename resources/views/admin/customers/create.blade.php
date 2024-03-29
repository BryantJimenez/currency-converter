@extends('layouts.admin')

@section('title', 'Crear Cliente')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="javascript:void(0);">Clientes</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
	<a href="javascript:void(0);">Registro</a>
</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/css/elements/alert.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">
	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-12">
						<h4>Crear Cliente</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">
				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('customers.store') }}" method="POST" class="form" id="formCustomer" enctype="multipart/form-data">
							@csrf
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Foto (Opcional)</label>
									<input type="file" name="photo" accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" />
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<div class="row">
										<div class="form-group col-12">
											<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
											<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ old('name') }}">
										</div>

										<div class="form-group col-12">
											<label class="col-form-label">Apellido<b class="text-danger">*</b></label>
											<input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" required placeholder="Introduzca un apellido" value="{{ old('lastname') }}">
										</div>
									</div> 
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">País<b class="text-danger">*</b></label>
									<select class="form-control @error('country_id') is-invalid @enderror" name="country_id" required>
										<option value="">Seleccione</option>
										@foreach($countries as $country)
										<option value="{{ $country->code }}" @if(old('country_id')==$country->code) selected @endif>{{ $country->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">DNI<b class="text-danger">*</b></label>
									<input class="form-control @error('dni') is-invalid @enderror" type="text" name="dni" required placeholder="Introduzca un documento nacional de identidad" value="{{ old('dni') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Correo Electrónico (Opcional)</label>
									<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Introduzca un correo electrónico" value="{{ old('email') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Teléfono<b class="text-danger">*</b></label>
									<input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" required placeholder="Introduzca un teléfono" value="{{ old('phone') }}" id="phone">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Dirección<b class="text-danger">*</b></label>
									<input class="form-control @error('address') is-invalid @enderror" type="text" name="address" required placeholder="Introduzca una dirección" value="{{ old('address') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Agregar Cuenta Bancaria?<b class="text-danger">*</b></label>
									<select class="form-control @error('account_question') is-invalid @enderror" name="account_question" required>
										<option value="0" @if(old('account_question')=='0') selected @endif>No</option>
										<option value="1" @if(old('account_question')=='1') selected @endif>Si</option>
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12 account-data @if(old('account_question')!='1') d-none @endif">
									<label class="col-form-label">Banco<b class="text-danger">*</b></label>
									<input class="form-control @error('bank') is-invalid @enderror" type="text" name="bank" @if(old('account_question')!='1') disabled @else required @endif placeholder="Introduzca un banco" value="{{ old('bank') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12 account-data @if(old('account_question')!='1') d-none @endif">
									<label class="col-form-label">Número de Cuenta<b class="text-danger">*</b></label>
									<input class="form-control number @error('number') is-invalid @enderror" type="text" name="number" @if(old('account_question')!='1') disabled @else required @endif placeholder="Introduzca un número de cuenta" value="{{ old('number') }}">
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="customer">Guardar</button>
										<a href="{{ route('customers.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendor/dropify/dropify.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection