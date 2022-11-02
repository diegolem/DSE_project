@extends('layouts.public')
@section('titulo', 'Página de Inicio')

@section('assets')
{!! Html::style('css/index.css') !!}
@show
@section('header')
<div class="container">
    <nav class="transparent z-depth-0" id="nav">
        <div class="nav-wrapper">
            <a href="{{ url('/') }}" class="brand-logo">
                <img height="40px" width="40px" src="{{ asset('favicon.png') }}">
                {{ config('app.name') }}
            </a>
            <ul class="right hide-on-med-and-down" id="opc">    
                <li><a href="{{ url('login') }}">Iniciar Sesión</a></li>
                <li><a href="{{ url('register') }}">Registrarme</a></li>
            </ul>
        </div>
    </nav>
</div>
    
@endsection

@section('contenido')
<div class="col s12 m4 18">
    <h1 class="center-align amber-text">Bienvenido a Ignite</h1>
    <h5 class="center-align white-text">Tu taller digital</h5>
</div> 
<br><br>
<div class="container">

        <h4 class="center-align amber-text">¿Qué es Ignite?</h4>
        <h6 class="white-text center-align">
            Ignite es un taller con una plataforma digital en la cuál se demuestra la eficiencia de las nuevas tecnologías
            y los beneficios que estas traen al usarse correctamente.
        </h6>
          
</div>

<br>
<br>
<br>
<div class="parallax-container">
    <div class="parallax">
        <img id="para" src="http://data.1freewallpapers.com/download/v8-amg-engine.jpg" style="display: block;">
    </div>
</div>
<br><br>
<div class="container">
        <h4 class="center-align amber-text">¿Cómo está creado Ignite?</h4>
        <h6 class="white-text center-align">Como bien mencionamos, Ignite es un proyecto digital que implementa tecnologías actuales,
            esta desarrollado bajo el framework Laravel de PHP como base, asimismo se implementan otras tecnologías como
            JavaScript y su librería mas conocida Jquery, tambien se hace uso de AJAX y MySQL como gestor de Base de Datos,
            como podemos imaginar, la construccion de este proyecto usa tecnologías básicas, que bien implementadas
            dan lugar a proyectos como este, y más avanzados.
        </h6> 
        <br><br>
<h4 class="center-align amber-text">¿Cuál es el objetivo de un taller con plataforma digital?</h4>
<h6 class="white-text center-align">El objetivo principal es la gestion de la información y la agilización de procesos. Las nuevas tecnologías han facilitado
    mucho esta tarea, con su rapidez y facilidad de ser usada, estas herramientas estan al alcance de cualquier 
    persona, la comodidad de poder realizar toda transacción desde cualquier lugares donde este se encuentre,
    es una gran ayuda tanto al cliente como a la empresa encargada de brindar los servicios correspondientes.
</h6>
<br><br>
</div>
<div class="parallax-container">
        <div class="parallax">
            <img id="para" src="http://www.seriouswheels.com/pics-2011/def/2011-Ford-Mustang-GT-Engine-Compartment-2-1280x960.jpg" style="display: block;">
        </div>
    </div>
    <br><br>
<div class="container">
        <h4 class="center-align amber-text">¿Qué puedo realizar en Ignite?</h4>
        <h6 class="white-text center-align">
            El primer paso para formar parte de esta plataforma es Registrarte, una vez registrado como usuario,
            puedes solicitar a uno de nuestros agentes, ingresar tus vehículos, 
            al ingresarlo, se llenara un formulario con el fin brindar de una idea del problema que este presenta.
        </h6>
        <br><br>
        <h4 class="center-align amber-text">¿Qué realiza Ignite con mi vehículo?</h4>
        <h6 class="white-text center-align">
            Ignite asigna a un especialista en el problema que presenta tu vehículo, este realiza su propio
            diagnostico sobre él, y actúa de acuerdo a ello, todo queda Registrado, y puedes solicitar que
            dicho registro se te muestre para ver que fué exactamente lo que aplicaron sobre él.
        </h6>
</div>


@endsection
@section('footer')
<footer class="page-footer amber darken-3">
        <div class="footer-copyright">
          <div class="container black-text center-align">
          © 2022 Copyright Ignite
          </div>
        </div>
      </footer>
@endsection