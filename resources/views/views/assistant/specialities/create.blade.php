@extends('layouts.assistant')
@section('page-title','Registrar especialidad')
@section('contenido')
<div class="row">
    @include('assistant.specialities.fragment.alert')
        <div class="row">&nbsp;</div>
    {!! Form::open(['route'=> ['specialties.store']]) !!}
        @include('assistant.specialities.fragment.form')
    {!! Form::close() !!}
</div>
<div class="col-s5">
    <a class="waves-effect waves-light btn" href="{{ route('specialties.index') }}">Ver especialidades</a>
</div>

@if(count($errors))
        @foreach($errors->all() as $error)
        @if($error == "El campo Nombre es obligatorio.")
            <script>
                lbltxt = document.getElementById("helName");
                lbltxt.innerHTML = "El campo Nombre es obligatorio.";
                lbltxt.setAttribute("class","helper-text red-text text-darken-2");
            </script>
        @endif
	    @if($error == "El campo Descripción es obligatorio.")
            <script>
                    lbltxt = document.getElementById("helDescri");
                    lbltxt.innerHTML = "El campo Descripción es obligatorio.";
                    lbltxt.setAttribute("class","helper-text red-text text-darken-2");
            </script>
            @endif
        @endforeach
@endif
@endsection