@extends('layouts.master')
@section('titulo')
    [Cliente]
@endsection

@section('assets')
    {{ Html::style('css/main.css') }}
    {{ Html::style('css/client.css') }}
@show

@section('header')
    <header>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

        <nav class="blue darken-1">
            <div class="container">
                <a href="#" data-target="user_nav" class="sidenav-trigger "><i class="material-icons">menu</i></a>
                <div class="nav-wrapper"><a class="brand-logo center">@yield('page-title', 'Cliente')</a></div>
            </div>
        </nav>

        <ul id="slide-out" class="sidenav sidenav-fixed">
            <li>
                <div class="user-view">
                    <div class="background blue darken-1">
                    </div>
                    <a>
                        <img class="circle" src="{{ asset('favicon.png')  }}">
                    </a>
                    <a>
                        <span class="white-text name">{{ explode(' ', auth()->user()->name)[0] . ' ' . explode(' ', auth()->user()->lastname)[0] }}</span>
                    </a>
                    <a>
                        <span style="font-weight: bold;" class="white-text email">[{{ auth()->user()->userType->name }}]</span>
                    </a>
                    <a>
                        <span class="white-text email">{{ auth()->user()->email }}</span>
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ url('/cle/') }}">
                    <i class="material-icons">home</i>Inicio
                </a>
            </li>
            <li class="nav-item"><a href="{{ url('/cle/users/'. auth()->user()->id) }}"><i class="material-icons">info</i>Mi cuenta</a></li>
            <li class="nav-item"><a href="{{ route('cars.index') }}"><i class="material-icons">directions_car</i>Mis vehículos</a></li>
            <li>
                <div class="divider"></div>
            </li>
            <li>
                <a class="subheader"></a>
            </li>
            <li class="nav-item">
                <a onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a>
            </li>
        </ul>
    </header>
@endsection

@section('filtro')
    @yield('filtro')
@endsection

@section('contenido')
    @yield('contenido')
@endsection

@section('script')
    @yield('script')
@endsection