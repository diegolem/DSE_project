@extends('layouts.master')
@section('titulo')
    [Administrador]
@endsection

@section('assets')
    {{ Html::style('css/main.css') }}
    {{ Html::style('css/admin.css') }}
@show

@section('header')
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
    <header>
        <!--nav class="top-nav grey darken-4">
            <div class="container">
                <a href="#" data-target="user_nav" class="sidenav-trigger "><i class="material-icons">menu</i></a>
                <div class="nav-wrapper"><a class="page-title">@yield('page-title', 'Título')</a></div>
            </div>
        </nav-->

        <nav class="grey darken-4">
            <div class="container">
                <a href="#" data-target="user_nav" class="sidenav-trigger "><i class="material-icons">menu</i></a>
                <div class="nav-wrapper"><a class="brand-logo center">@yield('page-title', 'Administrador')</a></div>
            </div>
        </nav>

        <ul id="user_nav" class="sidenav sidenav-fixed">
            <li>
                <div class="user-view">
                    <div class="background grey darken-4">
                    </div>
                    <a><img class="circle" src="{{ asset('favicon.png')  }}"></a>
                    <a>
                        <span class="white-text name">{{ explode(' ', auth()->user()->name)[0] . ' ' . explode(' ', auth()->user()->lastname)[0]  }}</span>
                        <span style="font-weight: bold;" class="white-text email">[{{ auth()->user()->userType->name }}]</span>
                    </a>
                    <a><span class="white-text email">{{ auth()->user()->email }}</span></a>
                </div>
            </li>
            <li class="nav-item"><a href="{{ url('/adm/') }}"><i class="material-icons">home</i>Inicio</a></li>
            <li class="nav-item"><a href="{{ url('/adm/users/'. auth()->user()->id) }}"><i class="material-icons">info</i>Mi cuenta</a></li>
            <li class="no-padding">
                <ul class="collapsible collapsible-accordion">
                    <li>
                        <a class="collapsible-header"><i class="material-icons">person</i> Usuarios</a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a href="{{ url('/adm/users/') }}">Mostrar <i class="material-icons left">remove_red_eye</i></a></li>
                                <li><a href=" {{ url('/adm/users/create') }} ">Registrar <i class="material-icons left">add</i></a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>
            <li class="nav-item"><a href="{{ route('accountant.repairs') }}"><i class="material-icons">build</i>Reparaciones</a></li>

        <li class="no-padding">
            <ul class="collapsible collapsible-accordion">
                <li>
                    <a class="collapsible-header"><i class="material-icons">insert_chart</i> Graficos</a>
                    <div class="collapsible-body">
                        <ul>
                            <li><a href="{{ route('accountant.chart_newclient') }}"><i class="material-icons left">group</i>Nuevos clientes</a></li>
                            <li><a href="{{ route('accountant.chart_ingreso') }}"><i class="material-icons left">monetization_on</i>Ingresos mensuales</a></li>
                            <li><a href="{{ route('accountant.chart_automovil') }}"><i class="material-icons left">directions_car</i>Registros de automoviles</a></li>
                            <li><a href="{{ route('accountant.chart_mecanicos') }}"><i class="material-icons left">traffic</i>Mecanicos frecuentes</a></li>
                            <li><a href="{{ route('accountant.chart_client') }}"><i class="material-icons left">store</i>Clientes frecuentes</a></li>
                            <li><a href="{{ route('accountant.chart_categoria') }}"><i class="material-icons left">local_offer</i>Categorias</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </li>
            <li>
                <a class="subheader">Opciones</a>
            </li>
            <li class="nav-item">
                <a href="" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="material-icons">exit_to_app</i>Cerrar Sesión</a>
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
