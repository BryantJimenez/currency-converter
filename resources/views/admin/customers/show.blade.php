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
<link href="{{ asset('/admins/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')

<div class="row layout-top-spacing">
	<div class="col-xl-4 col-lg-6 col-md-6 col-12 layout-spacing">
		<x-card-user user="{{ $user->slug }}" route="{{ route('customers.edit', ['user' => $user->slug]) }}" permission="customers.edit"></x-card-user>
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
								<a href="{{ route('customers.index') }}" class="btn btn-secondary">Volver</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection