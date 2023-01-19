@extends('layouts.admin')

@section('title', 'Detalles de Moneda')

@section('breadcrumb')
<li class="breadcrumb-item">
	<a href="javascript:void(0);">Monedas</a>
</li>
<li class="breadcrumb-item active" aria-current="page">
	<a href="javascript:void(0);">Detalles</a>
</li>
@endsection

@section('links')
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/admins/vendor/table/datatable/dt-global_style.css') }}">
@endsection

@section('content')

<div class="row layout-top-spacing">
	<div class="col-12 layout-spacing">

		<div class="user-profile layout-spacing">
			<div class="widget-content widget-content-area p-4">
				<div class="d-flex justify-content-between">
					<h3 class="pb-3">Datos de la Moneda</h3>
					@can('currencies.edit')
					<a href="{{ route('currencies.edit', ['currency' => $currency->slug]) }}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
					@endcan
				</div>
				<div class="user-info-list">

					<div class="">
						<ul class="contacts-block list-unstyled mw-100 mx-2 mb-0">
							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Nombre:</b> {{ $currency->name }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>ISO:</b> {{ $currency->iso }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Simbolo:</b> {{ $currency->symbol }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Lado del Simbolo:</b> {{ $currency->side }}</span>
							</li>

							<li class="contacts-block__item">
								<span class="h6 text-black"><b>Estado:</b> {!! state($currency->state) !!}</span>
							</li>

							<li class="contacts-block__item">
								<a href="{{ route('currencies.index') }}" class="btn btn-secondary">Volver</a>
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
						<h4>Tasas de Intercambios</h4>
					</div>
				</div>
			</div>
			<div class="widget-content widget-content-area shadow-none">

				<div class="row">
					<div class="col-12 mt-3">
						<table class="table table-hover table-normal">
							<thead>
								<tr>
									<th>#</th>
									<th>Tasa</th>
									<th>Moneda Origen</th>
									<th>Moneda Destino</th>
								</tr>
							</thead>
							<tbody>
								@foreach($currency['exchanges'] as $changes)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ number_format($changes->pivot->conversion_rate, 2, ',', '.') }}</td>
									<td>{{ $currency->name.' ('.$currency->iso.')' }}</td>
									<td>{{ $changes->name.' ('.$changes->iso.')' }}</td>
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

@endsection

@section('scripts')
<script src="{{ asset('/admins/vendor/table/datatable/datatables.js') }}"></script>
@endsection