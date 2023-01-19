@extends('layouts.admin')

@section('title', 'Crear Moneda')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="javascript:void(0);">Monedas</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
	<a href="javascript:void(0);">Registro</a>
</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/css/elements/alert.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">
	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-12">
						<h4>Crear Moneda</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">
				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('currencies.store') }}" method="POST" class="form" id="formCurrency">
							@csrf
							<div class="row">
								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
									<input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required placeholder="Introduzca un nombre" value="{{ old('name') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">ISO<b class="text-danger">*</b></label>
									<input class="form-control @error('iso') is-invalid @enderror" type="text" name="iso" required placeholder="Introduzca el código ISO" value="{{ old('iso') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Simbolo<b class="text-danger">*</b></label>
									<input class="form-control @error('symbol') is-invalid @enderror" type="text" name="symbol" required placeholder="Introduzca un simbolo" value="{{ old('symbol') }}">
								</div>

								<div class="form-group col-lg-6 col-md-6 col-12">
									<label class="col-form-label">Lado del Simbolo<b class="text-danger">*</b></label>
									<select class="form-control @error('side') is-invalid @enderror" name="side" required>
										<option value="">Seleccione</option>
										<option value="1" @if(old('side')=='1') selected @endif>Derecha</option>
										<option value="2" @if(old('side')=='2') selected @endif>Izquierda</option>
									</select>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="currency">Guardar</button>
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
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection