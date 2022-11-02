@extends('layouts.assistant')
@section('page-title','Registrar Categoría')
@section('contenido')
<div class="row">
    <div class="row">
            @include('assistant.categories.fragment.alert')
                <div class="row">&nbsp;</div>
            {!! Form::open(['route'=> ['category.store']]) !!}
                @include('assistant.categories.fragment.form')
            {!! Form::close() !!}
        </div>
</div>
<div class="col-s5">
        <a class="waves-effect waves-light btn" href="{{ route('category.index') }}">Ver categorías</a>
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
