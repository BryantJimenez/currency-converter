@extends('layouts.admin')

@section('title', 'Perfil de Cliente')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="javascript:void(0);">Clientes</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
	<a href="javascript:void(0);">Perfil</a>
</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/css/elements/alert.css') }}">
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
<link href="{{ asset('/admins/css/components/custom-modal.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/vendor/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/admins/css/components/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('/admins/vendor/lobibox/Lobibox.min.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">
	<div class="col-xl-4 col-lg-6 col-md-6 col-12 layout-spacing">
		<x-card-user user="{{ $user->slug }}" route="{{ route('customers.edit', ['user' => $user->slug]) }}" permission="customers.edit" title="Datos Personales"></x-card-user>
	</div>

	<div class="col-xl-8 col-lg-6 col-md-6 col-12 layout-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area p-4">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Datos Adicionales</h3>
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2 mb-0">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>País:</b> @if(!is_null($user['country'])){{ $user['country']->name }}@else{{ 'No Ingresado' }}@endif</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>DNI:</b> {{ $user->dni }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Dirección:</b> {{ $user->address }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>N° de Cuentas Bancarias:</b> {{ $user['accounts']->count() }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>N° de Contactos:</b> {{ $user['contacts']->count() }}</span>
							</li>

							<li class="contacts-block__item">
								<a href="{{ route('customers.index') }}" class="btn btn-secondary">Volver</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-12">
						<h4>Cuentas Bancarias del Cliente</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12 mt-3">
						@can('accounts.create')
						<div class="text-right mr-3">
							<button type="button" class="btn btn-sm btn-primary" onclick="accountCustomer('{{ $user->slug }}', '{{ $user->fullname }}')">Agregar</button>
						</div>
						@endcan

						<table class="table table-hover table-normal">
							<thead>
								<tr>
									<th>#</th>
									<th>Banco</th>
									<th>Número de Cuenta</th>
									<th>Estado</th>
									@if(auth()->user()->can('accounts.edit'))
									<th class="no-content">Acciones</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($user['accounts'] as $account)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $account->bank }}</td>
									<td>{{ $account->number }}</td>
									<td>{!! state($account->state) !!}</td>
									@if(auth()->user()->can('accounts.edit'))
									<td>
										<div class="btn-group btn-svg-sm" role="group">
											@can('accounts.edit')
											<button type="button" class="btn btn-info btn-sm bs-tooltip mr-0" title="Editar Cuenta Bancaria" onclick="accountCustomerEdit('{{ $user->slug }}', '{{ $account->slug }}', '{{ $user->fullname }}', '{{ $account->bank }}', '{{ $account->number }}')">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
											</button>
											@endcan
										</div>
									</td>
									@endif
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-12">
						<h4>Contactos del Cliente</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12 mt-3">
						@can('contacts.create')
						<div class="text-right mr-3">
							<button type="button" class="btn btn-sm btn-primary" onclick="contactCustomer('{{ $user->slug }}', '{{ $user->fullname }}')">Agregar</button>
						</div>
						@endcan

						<table class="table table-hover table-normal">
							<thead>
								<tr>
									<th>#</th>
									<th>Alias</th>
									<th>Nombre</th>
									<th>País</th>
									<th>DNI</th>
									<th>Correo</th>
									<th>Teléfono</th>
									<th>Estado</th>
								</tr>
							</thead>
							<tbody>
								@foreach($user['contacts'] as $contact)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $contact->pivot->alias }}</td>
									<td>{{ $contact->fullname }}</td>
									<td>{{ $contact['country']->name }}</td>
									<td>{{ $contact->dni }}</td>
									<td>@if(!is_null($contact->email)){{ $contact->email }}@else{{ 'No Ingresado' }}@endif</td>
									<td>@if(!is_null($contact->phone)){{ $contact->phone }}@else{{ 'No Ingresado' }}@endif</td>
									<td>{!! state($contact->state) !!}</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@can('contacts.create')
@include('admin.partials.modals.contacts.create')
@endcan

@can('accounts.create')
@include('admin.partials.modals.accounts.create')
@endcan

@can('accounts.edit')
<x-modal-form modal="accountCustomerEdit" size="modal-lg" form="formAccountCustomerEdit" method="PUT" title="Editar una cuenta bancaria" validate="customer" close="Cancelar" button="Actualizar">
	<div class="row">
		<div class="col-12">
			@include('admin.partials.errors')
			<p>Campos obligatorios (<b class="text-danger">*</b>)</p>
		</div>

		<div class="form-group col-12">
			<label class="col-form-label">Cliente</label>
			<input class="form-control text-dark" type="text" name="name" disabled value="">
		</div>

		<div class="form-group col-12">
			<label class="col-form-label">Banco<b class="text-danger">*</b></label>
			<input class="form-control @error('bank') is-invalid @enderror" type="text" name="bank" required placeholder="Introduzca un banco" value="{{ old('bank') }}">
		</div>

		<div class="form-group col-12">
			<label class="col-form-label">Número de Cuenta<b class="text-danger">*</b></label>
			<input class="form-control number @error('number') is-invalid @enderror" type="text" name="number" required placeholder="Introduzca un número de cuenta" value="{{ old('number') }}">
		</div>
	</div>
</x-modal-form>
@endcan

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('/admins/vendor/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/jquery.validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/additional-methods.js') }}"></script>
<script src="{{ asset('/admins/vendor/validate/messages_es.js') }}"></script>
<script src="{{ asset('/admins/js/validate.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection