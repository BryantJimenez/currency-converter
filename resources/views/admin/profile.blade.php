@extends('layouts.admin')

@section('title', 'Perfil de Usuario')

@section('breadcrumb')
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
		<x-card-user user="{{ Auth::user()->slug }}" route="{{ route('profile.edit') }}" permission="profile.edit" title="Datos Personales"></x-card-user>
	</div>
</div>

@endsection