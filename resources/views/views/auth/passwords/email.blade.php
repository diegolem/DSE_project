@extends('layouts.public')
@section('titulo', 'Recuperar contraseña')

@section('assets')
    {!! Html::style('css/login.css') !!}
@show

@section('header')
    <nav>
        <div class="nav-wrapper {{ env('primary_color')  }} darken-3">
            <a href="{{ url('/') }}" class="brand-logo">
                <img height="40px" width="40px" src="{{ asset('favicon.png') }}">
                {{ config('app.name') }}
            </a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="{{ url('/') }}">Inicio</a></li>
                <li><a href="{{ url('register') }}">Registrarme</a></li>
                <li><a href="{{ url('login') }}">Iniciar Sesión</a></li>
            </ul>
        </div>
    </nav>
@endsection

@section('contenido')
    <div class="row">
        <h2 class="center {{ env('PRIMARY_COLOR') }}-text text-darken-3">
            {{ env('APP_NAME') }}
            <img height="40px" width="40px" src="{{ asset('favicon.png') }}">
        </h2>
        <h5 class="center grey-text text-darken-1">[Recuperar contraseña]</h5>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                {{ csrf_field() }}

                <div class="input-field col m6 offset-m3 s8 offset-s2 {{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">Correo electrónico</label>
                    <input id="email" type="email" class="" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="error-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="col s12 btn-cont">
                    <button type="submit" class="btn {{ env('primary_color')  }} darken-3 waves-effect">
                        Enviar link para recuperar la contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
