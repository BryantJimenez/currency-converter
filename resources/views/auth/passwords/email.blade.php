@extends('layouts.auth')

@section('title', 'Recuperar Contraseña')

@section('content')

<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                <div class="form-content">
                    <h1 class="">Recuperar Contraseña</h1>
                    <p class="signup-link mb-3">Ya tienes cuenta? <a href="{{ route('login') }}">Ingresa</a></p>
                    <form class="text-left" action="{{ route('password.email') }}" method="POST" id="formRecovery">
                        {{ csrf_field() }}

                        @include('admin.partials.errors')

                        <div class="form">
                            <div id="email-field" class="field-wrapper input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><circle cx="12" cy="12" r="4"></circle><path d="M16 8v5a3 3 0 0 0 6 0v-1a10 10 0 1 0-3.92 7.94"></path></svg>
                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" required autocomplete="email" autofocus value="{{ old('email') }}" minlength="5" maxlength="191">
                            </div>

                            <div class="d-sm-flex justify-content-between">
                                <div class="field-wrapper">
                                    <button type="submit" class="btn btn-primary" action="recovery">Enviar</button>
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

@endsection