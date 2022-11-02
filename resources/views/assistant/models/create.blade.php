@extends('layouts.assistant')
@section('page-title','Registrar Modelo')
@section('contenido')
<script>
        $(document).ready(function(){
            $('select').formSelect();
          });
</script>
<div class="row">
    <div class="row">
            @include('assistant.models.fragment.alert')
                <div class="row">&nbsp;</div>
            {!! Form::open(['route'=> ['models.store']]) !!}
                @include('assistant.models.fragment.form')
            {!! Form::close() !!}
        </div>
</div>
<div class="col-s5">
        <a class="waves-effect waves-light btn" href="{{ route('models.index') }}">Ver modelos</a>
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
    @if($error == "El campo Marca es obligatorio.")
        <script>
                lbltxt = document.getElementById("helBrand");
                lbltxt.innerHTML = "Selecciona una marca!!";
                lbltxt.setAttribute("class","helper-text red-text text-darken-2");
        </script>
    @endif
    @endforeach
@endif
@endsection
