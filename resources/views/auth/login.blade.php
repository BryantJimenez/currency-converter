@extends('layouts.auth')

@section('title', 'Ingresar')

@section('content')

<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">
                    <h1 class=""><span class="brand-name">INGRESAR</span></h1>
                    @if(Route::has('register'))
                    <p class="signup-link mb-3">No tienes cuenta? <a href="{{ route('register') }}">Registrate</a></p>
                    @endif
                    <form class="text-left" action="{{ route('login') }}" method="POST" id="formLogin">
                        {{ csrf_field() }}

                        @include('admin.partials.errors')

                        <div class="form">
                            <div id="username-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required value="{{ old('email') }}" minlength="5" maxlength="191">
                            </div>

                            <div id="password-field" class="field-wrapper input mb-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" required placeholder="Contraseña" minlength="8" maxlength="40">
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
                                    <button type="submit" class="btn btn-primary" action="login">Ingresar</button>
                                </div>
                            </div>

                            <div class="field-wrapper text-center keep-logged-in">
                                <div class="n-chk new-checkbox checkbox-outline-primary">
                                    <label class="new-control new-checkbox checkbox-outline-primary">
                                        <input type="checkbox" class="new-control-input">
                                        <span class="new-control-indicator"></span>Mantenerme logueado
                                    </label>
                                </div>
                            </div>

                            <div class="field-wrapper">
                                <a href="{{ route('password.request') }}" class="forgot-pass-link">Has Olvidado Tu Contraseña?</a>
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

@endsection






