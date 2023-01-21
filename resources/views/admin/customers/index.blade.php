@extends('layouts.admin')

@section('title', 'Lista de Clientes')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="javascript:void(0);">Clientes</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
	<a href="javascript:void(0);">Lista</a>
</li>
@endsection

@section('links')
<link rel="stylesheet" href="{{ asset('/admins/css/elements/alert.css') }}">
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
	<div class="col-12 layout-spacing">
		<div class="statbox widget box box-shadow">
			<div class="widget-header">
				<div class="row">
					<div class="col-12">
						<h4>Lista de Clientes</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12 mt-3">
						@can('customers.create')
						<div class="text-right mr-3">
							<a href="{{ route('customers.create') }}" class="btn btn-sm btn-primary">Agregar</a>
						</div>
						@endcan

						<table class="table table-normal table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Nombre Completo</th>
									<th>País</th>
									<th>DNI</th>
									<th>Correo</th>
									<th>Teléfono</th>
									<th>Estado</th>
									@if(auth()->user()->can('customers.show') || auth()->user()->can('customers.edit') || auth()->user()->can('customers.contact.create') || auth()->user()->can('customers.account.create') || auth()->user()->can('customers.active') || auth()->user()->can('customers.deactive') || auth()->user()->can('customers.delete'))
									<th class="no-content">Acciones</th>
									@endif
								</tr>
							</thead>
							<tbody>
								@foreach($users as $user)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td class="d-flex align-items-center">
										<img src="{{ image_exist('/admins/img/users/', $user->photo, true) }}" class="rounded-circle mr-2" width="45" height="45" alt="{{ $user->fullname }}" title="{{ $user->fullname }}"> {{ $user->fullname }}
									</td>
									<td>{{ $user['country']->name }}</td>
									<td>{{ $user->dni }}</td>
									<td>@if(!is_null($user->email)){{ $user->email }}@else{{ 'No Ingresado' }}@endif</td>
									<td>@if(!is_null($user->phone)){{ $user->phone }}@else{{ 'No Ingresado' }}@endif</td>
									<td>{!! state($user->state) !!}</td>
									@if(auth()->user()->can('customers.show') || auth()->user()->can('customers.edit') || auth()->user()->can('contacts.create') || auth()->user()->can('accounts.create') || auth()->user()->can('customers.active') || auth()->user()->can('customers.deactive') || auth()->user()->can('customers.delete'))
									<td>
										<div class="btn-group btn-svg-sm" role="group">
											@can('customers.show')
											<a href="{{ route('customers.show', ['user' => $user->slug]) }}" class="btn btn-primary btn-sm bs-tooltip mr-0" title="Perfil">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
											</a>
											@endcan
											@can('customers.edit')
											<a href="{{ route('customers.edit', ['user' => $user->slug]) }}" class="btn btn-info btn-sm bs-tooltip mr-0" title="Editar">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
											</a>
											@endcan
											@can('contacts.create')
											<button type="button" class="btn btn-secondary btn-sm bs-tooltip mr-0" title="Agregar Contacto" onclick="contactCustomer('{{ $user->slug }}', '{{ $user->name." ".$user->lastname }}')">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-link"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
											</button>
											@endcan
											@can('accounts.create')
											<button type="button" class="btn btn-dark btn-sm bs-tooltip mr-0" title="Agregar Cuenta Bancaria" onclick="accountCustomer('{{ $user->slug }}', '{{ $user->name." ".$user->lastname }}')">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-credit-card"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
											</button>
											@endcan
											@if($user->state=='Activo')
											@can('customers.deactive')
											<button type="button" class="btn btn-warning btn-sm bs-tooltip mr-0" title="Desactivar" onclick="deactiveCustomer('{{ $user->slug }}')">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-power"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
											</button>
											@endcan
											@else
											@can('customers.active')
											<button type="button" class="btn btn-success btn-sm bs-tooltip mr-0" title="Activar" onclick="activeCustomer('{{ $user->slug }}')">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
											</button>
											@endcan
											@endif
											@can('customers.delete')
											<button type="button" class="btn btn-danger btn-sm bs-tooltip mr-0" title="Eliminar" onclick="deleteCustomer('{{ $user->slug }}')">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
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
</div>

@can('contacts.create')
@include('admin.partials.modals.contacts.create')
@endcan

@can('accounts.create')
@include('admin.partials.modals.accounts.create')
@endcan

@can('customers.deactive')
<x-modal-simple modal="deactiveCustomer" form="formDeactiveCustomer" method="PUT" title="¿Estás seguro de que quieres desactivar este cliente?" close="Cancelar" button="Desactivar"></x-modal-simple>
@endcan

@can('customers.active')
<x-modal-simple modal="activeCustomer" form="formActiveCustomer" method="PUT" title="¿Estás seguro de que quieres activar este cliente?" close="Cancelar" button="Activar"></x-modal-simple>
@endcan

@can('customers.delete')
<x-modal-simple modal="deleteCustomer" form="formDeleteCustomer" method="DELETE" title="¿Estás seguro de que quieres eliminar este cliente?" close="Cancelar" button="Eliminar"></x-modal-simple>
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