@extends('layouts.admin')

@section('title', 'Inicio')

@section('links')
<link href="{{ asset('/admins/css/dashboard/dash_1.css') }}" rel="stylesheet" type="text/css" class="dashboard-analytics" />
@endsection

@section('content')

<div class="row layout-top-spacing">
	<div class="col-lg-6 col-md-8 col-12 layout-spacing">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area rounded">
                <h6 class="font-weight-bold mb-3">Bienvenido:</h6>
                <p class="font-weight-bold mb-0">Administre todo su negocio de forma simple, fácil, comoda y a medida!</p>
            </div>
        </div>
    </div>

    @can('users.index')
    <div class="col-lg-3 col-md-4 col-sm-6 col-12 layout-spacing">
        <div class="widget widget-one_hybrid widget-followers">
            <div class="widget-heading">
                <div class="w-title mb-0">
                    <div class="w-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    </div>
                    <div class="">
                        <p class="w-value">{{ $users }}</p>
                        <h5 class="">Usuarios</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>

@endsection