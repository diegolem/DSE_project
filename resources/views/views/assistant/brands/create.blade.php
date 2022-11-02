@extends('layouts.assistant')
@section('contenido')

@section('page-title')
    Registro de marcas
@endsection
<div class="row">

            {!! Form::open(['route'=>'brands.store', 'method'=>'POST','id'=>'frmRegisterBrand']) !!}
            <div class="row">
                <div class="input-field col s8 offset-s2">
                    {!! Form::text('nombre','',['id'=>'txtNombre'])!!}
                    {!! Form::label('txtNombre', 'Nombre')!!}
                    @if(Session::has('Emessage'))
                    <span class="" id="helName" data-error="wrong" data-success="right"></span>
                    @endif
                </div>
            </div>
        
            <div class="row">
                <div class="input-field col s8 offset-s2 center-align">
                    {!! Form::select('country_id', $countries)!!}
                    {!! Form::label('', 'País de origen')!!}
                </div>
            </div>
        
            <div class="row center-align">
                {!! Form::button('Registrar', ['class'=>'waves-effect btn', 'type'=>'submit'])!!}
            </div>
            {!! Form::close() !!}
    
</div>

<div class="col-s5">
    <a class="waves-effect waves-light btn" href="{{ route('brands.index') }}">Ver marcas</a>
</div>

                    @if(Session::has('Emessage'))
                    <script>
                        lbltxt = document.getElementById("helName");
                        lbltxt.innerHTML = "Ingresa un nombre válido";
                        lbltxt.setAttribute("class","helper-text red-text text-darken-2");
                    </script>
                    @endif
@endsection