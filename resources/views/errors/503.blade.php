@extends('layouts.error')

@section('title', 'Error 503')

@section('content')

<div class="container-fluid error-content">
	<div class="">
		<h1 class="error-number">503</h1>
		<p class="mini-text">Este sitio cargara en pocos minutos!</p>
		<p class="error-text mb-4 mt-1">Por favor intentelo más tarde!</p>
		<a href="@if(Route::has('web')){{ route('web') }}@elseif(Route::has('admin')){{ route('admin') }}@elseif(Route::has('login')){{ route('login') }}@else{{ '/' }}@endif" class="btn btn-primary mt-5">Volver al Inicio</a>
	</div>
</div>

@endsection