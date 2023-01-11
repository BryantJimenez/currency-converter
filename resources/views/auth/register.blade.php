@extends('layouts.auth')

@section('title', 'Registro de Usuario')

@section('content')

<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">
                    <h1 class="">Registro de Usuario</h1>
                    <p class="signup-link mb-3">Ya tienes una cuenta? <a href="{{ route('login') }}">Ingresa</a></p>
                    <form class="text-left" action="{{ route('register') }}" method="POST" id="formRegister">
                        {{ csrf_field() }}

                        @include('admin.partials.errors')
                        
                        <div class="form">
                            <div id="name-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" required placeholder="Nombre" value="{{ old('name') }}" minlength="2" maxlength="191">
                            </div>

                            <div id="lastname-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="lastname" name="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" required placeholder="Apellido" value="{{ old('lastname') }}" minlength="2" maxlength="191">
                            </div>

                            <div id="email-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required value="{{ old('email') }}" minlength="5" maxlength="191">
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Contraseña" minlength="8" maxlength="40">
                            </div>

                            <div class="field-wrapper terms_condition">
                                <div class="n-chk new-checkbox checkbox-outline-primary">
                                    <label class="new-control new-checkbox checkbox-outline-primary" for="terms-conditions">
                                        <input type="checkbox" class="new-control-input" name="terms" required id="terms-conditions">
                                        <span class="new-control-indicator"></span><span>Acepto los <a href="javascript:void(0);" data-dismiss="modal" data-toggle="modal" data-target="#modal-terms"> términos y condiciones</a></span>
                                    </label>
                                </div>
                            </div>

                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper toggle-pass">
                                    <p class="d-inline-block">Mostrar Contraseña</p>
                                    <label class="switch s-primary">
                                        <input type="checkbox" id="toggle-password" class="d-none">
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" action="register">Registrate</button>
                                </div>
                            </div>
                        </div>
                    </form>                        
                    <p class="terms-conditions">©{{ date('Y') }} Todos los derechos reservados <a href="https://otterscompany.com">Otters Company</a>.</p>
                </div>                    
            </div>
        </div>
    </div>
    <div class="form-image">
        <div class="l-image"></div>
    </div>
</div>

<div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Términos y Condiciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="height: 70vh; overflow-y: scroll;">
                <div class="row">
                    <div class="col-12">
                        {{-- {!! $setting->terms !!} --}}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger rounded" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@endsection