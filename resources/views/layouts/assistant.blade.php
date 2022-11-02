@extends('layouts.master')

@section('titulo')[Asistente]@endsection

@section('assets')
    @parent
    {{ Html::style('css/main.css') }}
    {{ Html::style('css/assistant.css') }}
@endsection

    @section('header')
        <header>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>

            <nav class="teal darken-1">
                <div class="container">
                    <a href="#" data-target="user_nav" class="sidenav-trigger "><i class="material-icons">menu</i></a>
                    <div class="nav-wrapper"><a class="brand-logo center">@yield('page-title', 'Asistente')</a></div>
                </div>
            </nav>

            <ul id="user_nav" class="sidenav sidenav-fixed">
                <li>
                    <div class="user-view">
                        <div class="background teal darken-1">
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
                <li class="active nav-item">
                    <a href="{{ url('/asi/') }}">
                        <i class="material-icons">home</i>Inicio</a>
                    </li>
                <li class="nav-item"><a href="{{ url('/asi/users/'. auth()->user()->id) }}"><i class="material-icons">info</i>Mi cuenta</a></li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a class="collapsible-header"> <i class="material-icons">person</i> Usuarios</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="{{ url('/asi/users/') }}">Mostrar <i class="material-icons left">remove_red_eye</i></a>
                                    </li>
                                    <li>
                                        <a href=" {{ url('/asi/users/create') }} ">Registrar <i class="material-icons left">add</i></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a class="collapsible-header"><i class="material-icons">directions_car</i>Vehiculos</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="{{ url('/asi/cars')  }}">Mostrar <i class="material-icons left">remove_red_eye</i></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('cars.create') }}">Registrar <i class="material-icons left">add</i></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                    </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a class="collapsible-header"><i class="material-icons">build</i>Reparaciones</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="{{ route('repairs.index')  }}">Mostrar <i class="material-icons left">remove_red_eye</i></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('repairs.create') }}">Registrar <i class="material-icons left">add</i></a>
                                    </li>
                                </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                            <li>
                            <a class="collapsible-header"><i class="material-icons">branding_watermark</i>Marcas</a>
                            <div class="collapsible-body">
                                    <ul>
                                    <li>
                                        <a href="{{ route('brands.index') }}">Mostrar <i class="material-icons left">remove_red_eye</i></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('brands.create') }}">Registrar <i class="material-icons left">add</i></a>
                                    </li>
                                </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a class="collapsible-header"><i class="material-icons">layers</i>Modelos</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li>
                                        <a href="{{ route('models.index') }}">Mostrar <i class="material-icons left">remove_red_eye</i></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('models.create') }}">Registrar <i class="material-icons left">add</i></a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        </ul>
                    </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a class="collapsible-header"><i class="material-icons">star</i>Especialidades</a>
                            <div class="collapsible-body">
                                <ul>
                                    <li>

                                        <a href="{{ route('specialties.index') }}">Mostrar <i class="material-icons left">remove_red_eye</i></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('specialties.create') }}">Registrar <i class="material-icons left">add</i></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('mechanic.storecreate') }}">Añadir Especialidad a mecánicos</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="no-padding">
                        <ul class="collapsible collapsible-accordion">
                            <li>
                                <a class="collapsible-header"><i class="material-icons">poll</i>Categorías</a>
                                <div class="collapsible-body">
                                    <ul>
                                        <li>
                                            <a href="{{ route('category.index') }}">Mostrar <i class="material-icons left">remove_red_eye</i></a>
                                        </li>
                                        <li>
                                            <a href="{{ route('category.create') }}">Registrar <i class="material-icons left">add</i></a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                <li>
                    <div class="divider"></div>
                </li>
                <li>
                    <a class="subheader"></a>
                </li>
                <li  class="nav-item">
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

@section('footer')
    @yield('footer')
@endsection

@section('script')
    @yield('script')
@endsection