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

    @can('customers.index')
    <div class="col-lg-3 col-md-4 col-sm-6 col-12 layout-spacing">
        <div class="widget widget-one_hybrid widget-engagement">
            <div class="widget-heading">
                <div class="w-title mb-0">
                    <div class="w-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    </div>
                    <div class="">
                        <p class="w-value">{{ $customers }}</p>
                        <h5 class="">Clientes</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan

    @can('quotes.index')
    <div class="col-lg-3 col-md-4 col-sm-6 col-12 layout-spacing">
        <div class="widget widget-one_hybrid widget-referral">
            <div class="widget-heading">
                <div class="w-title mb-0">
                    <div class="w-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-repeat"><polyline points="17 1 21 5 17 9"></polyline><path d="M3 11V9a4 4 0 0 1 4-4h14"></path><polyline points="7 23 3 19 7 15"></polyline><path d="M21 13v2a4 4 0 0 1-4 4H3"></path></svg>
                    </div>
                    <div class="">
                        <p class="w-value">{{ $quotes }}</p>
                        <h5 class="">Cotizaciones</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
    
    @can('currencies.index')
    <div class="col-lg-3 col-md-4 col-sm-6 col-12 layout-spacing">
        <div class="widget widget-one_hybrid widget-followers">
            <div class="widget-heading">
                <div class="w-title mb-0">
                    <div class="w-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                    </div>
                    <div class="">
                        <p class="w-value">{{ $currencies }}</p>
                        <h5 class="">Monedas</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endcan
</div>

@endsection