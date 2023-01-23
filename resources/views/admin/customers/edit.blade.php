@extends('layouts.admin')

@section('title', 'Editar Cliente')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="javascript:void(0);">Clientes</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
    <a href="javascript:void(0);">Editar</a>
</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/css/elements/alert.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/dropify/dropify.min.css') }}">
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
	                    <h4>Editar Cliente</h4>
	                </div>
	            </div>
	        </div>
	        <div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('customers.update', ['user' => $user->slug]) }}" method="POST" class="form" id="formCustomer" enctype="multipart/form-data">
							@csrf
							@method('PUT')
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Foto (Opcional)</label>
									<input type="file" name="photo" accept="image/*" class="dropify" data-height="125" data-max-file-size="20M" data-allowed-file-extensions="jpg png jpeg web3" data-default-file="{{ $user->photo_url }}" />
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<div class="row">
										<div class="form-group col-12">
											<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
											<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ old('name', $user->name) }}">
										</div>

										<div class="form-group col-12">
											<label class="col-form-label">Apellido<b class="text-danger">*</b></label>
											<input class="form-control @error('lastname') is-invalid @enderror" type="text" name="lastname" required placeholder="Introduzca un apellido" value="{{ old('lastname', $user->lastname) }}">
										</div>
									</div> 
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">País<b class="text-danger">*</b></label>
									<select class="form-control @error('country_id') is-invalid @enderror" name="country_id" required>
										<option value="">Seleccione</option>
										@foreach($countries as $country)
										<option value="{{ $country->code }}" @if(old('country_id', $user['country']->code ?? NULL)==$country->code) selected @endif>{{ $country->name }}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">DNI<b class="text-danger">*</b></label>
									<input class="form-control @error('dni') is-invalid @enderror" type="text" name="dni" required placeholder="Introduzca un documento nacional de identidad" value="{{ old('dni', $user->dni) }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Correo Electrónico (Opcional)</label>
									<input class="form-control @error('email') is-invalid @enderror" type="email" name="email" placeholder="Introduzca un correo electrónico" value="{{ old('email', $user->email) }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Teléfono<b class="text-danger">*</b></label>
									<input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" required placeholder="Introduzca un teléfono" value="{{ old('phone', $user->phone) }}" id="phone">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Dirección<b class="text-danger">*</b></label>
									<input class="form-control @error('address') is-invalid @enderror" type="text" name="address" required placeholder="Introduzca una dirección" value="{{ old('address', $user->address) }}">
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary mr-0" action="customer" slug="{{ $user->slug }}">Actualizar</button>
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
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection