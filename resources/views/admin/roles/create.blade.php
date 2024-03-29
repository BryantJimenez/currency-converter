@extends('layouts.admin')

@section('title', 'Crear Rol')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="javascript:void(0);">Roles</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
	<a href="javascript:void(0);">Registro</a>
</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/css/elements/alert.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">
	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-12">
						<h4>Crear Rol</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">
				<div class="row">
					<div class="col-12">

						@include('admin.partials.errors')

						<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
						<form action="{{ route('roles.store') }}" method="POST" class="form" id="formRole">
							@csrf
							<div class="row">
								<div class="form-group col-12">
									<label class="col-form-label">Nombre<b class="text-danger">*</b></label>
									<input class="form-control @error('name') is-invalid @enderror" type="text" required name="name" placeholder="Introduzca un nombre" value="{{ old('name') }}">
								</div>

								<div class="form-group col-12">
									<label class="col-form-label">Permisos<b class="text-danger">*</b></label>
									<select class="form-control selectpicker @error('permission_id') is-invalid @enderror" name="permission_id[]" required title="Seleccione" data-size="10" data-selected-text-format="count > 5" data-count-selected-text="{0} Permisos Seleccionados" multiple>
										@if(is_null(old('permission_id')))
										@foreach($permissions as $permission)
										<option value="{{ $permission->name }}">@lang('permissions.'.$permission->name)</option>
										@endforeach
										@else
										{!! selectArrayPermissions($permissions, old('permission_id')) !!}
										@endif
									</select>
									<div class="custom-error-permission_id"></div>
								</div>

								<div class="form-group col-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary" action="role">Guardar</button>
										<a href="{{ route('roles.index') }}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection