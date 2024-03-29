@extends('layouts.admin')

@section('title', 'Lista de Monedas')

@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="javascript:void(0);">Monedas</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
    <a href="javascript:void(0);">Lista</a>
</li>
@endsection

@section('links')
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
	                    <h4>Lista de Monedas</h4>
	                </div>
	            </div>
	        </div>
	        <div class="widget-content widget-content-area shadow-none">

	        	<div class="row">
					<div class="col-12 mt-3">
						@can('currencies.create')
						<div class="text-right mr-3">
							<a href="{{ route('currencies.create') }}" class="btn btn-sm btn-primary">Agregar</a>
						</div>
						@endcan

                        <table class="table table-normal table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
									<th>Nombre</th>
									<th>ISO</th>
									<th>Simbolo</th>
									<th>Lado del Simbolo</th>
									<th>Estado</th>
                                    @if(auth()->user()->can('currencies.show') || auth()->user()->can('currencies.edit') || auth()->user()->can('currencies.active') || auth()->user()->can('currencies.deactive') || auth()->user()->can('currencies.delete'))
									<th class="no-content">Acciones</th>
									@endif
                                </tr>
                            </thead>
                            <tbody>
								@foreach($currencies as $currency)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $currency->name }}</td>
									<td>{{ $currency->iso }}</td>
									<td>{{ $currency->symbol }}</td>
									<td>{{ $currency->side }}</td>
									<td>{!! state($currency->state) !!}</td>
									@if(auth()->user()->can('currencies.show') || auth()->user()->can('currencies.edit') || auth()->user()->can('currencies.active') || auth()->user()->can('currencies.deactive') || auth()->user()->can('currencies.delete'))
									<td>
										<div class="btn-group btn-svg-sm" role="group">
											@can('currencies.show')
											<a href="{{ route('currencies.show', ['currency' => $currency->slug]) }}" class="btn btn-primary btn-sm bs-tooltip mr-0" title="Detalles">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
											</a>
											@endcan
											@can('currencies.edit')
											<a href="{{ route('currencies.edit', ['currency' => $currency->slug]) }}" class="btn btn-info btn-sm bs-tooltip mr-0" title="Editar">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
											</a>
											@endcan
											@can('exchanges.edit')
											<a href="{{ route('currencies.exchanges.edit', ['currency' => $currency->slug]) }}" class="btn btn-secondary btn-sm bs-tooltip mr-0" title="Editar Tasas de Intercambio">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-repeat"><polyline points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg>
											</a>
											@endcan
											@if($currency->state=='Activo')
											@can('currencies.deactive')
											<button type="button" class="btn btn-warning btn-sm bs-tooltip mr-0" title="Desactivar" onclick="deactiveCurrency('{{ $currency->slug }}')">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-power"><path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path><line x1="12" y1="2" x2="12" y2="12"></line></svg>
											</button>
											@endcan
											@else
											@can('currencies.active')
											<button type="button" class="btn btn-success btn-sm bs-tooltip mr-0" title="Activar" onclick="activeCurrency('{{ $currency->slug }}')">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-circle"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
											</button>
											@endcan
											@endif
											@can('currencies.delete')
											<button type="button" class="btn btn-danger btn-sm bs-tooltip mr-0" title="Eliminar" onclick="deleteCurrency('{{ $currency->slug }}')">
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

@can('currencies.deactive')
<x-modal-simple modal="deactiveCurrency" form="formDeactiveCurrency" method="PUT" title="¿Estás seguro de que quieres desactivar esta moneda?" close="Cancelar" button="Desactivar"></x-modal-simple>
@endcan

@can('currencies.active')
<x-modal-simple modal="activeCurrency" form="formActiveCurrency" method="PUT" title="¿Estás seguro de que quieres activar esta moneda?" close="Cancelar" button="Activar"></x-modal-simple>
@endcan

@can('currencies.delete')
<x-modal-simple modal="deleteCurrency" form="formDeleteCurrency" method="DELETE" title="¿Estás seguro de que quieres eliminar esta moneda?" close="Cancelar" button="Eliminar"></x-modal-simple>
@endcan

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('/admins/vendor/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('/admins/vendor/lobibox/Lobibox.js') }}"></script>
@endsection