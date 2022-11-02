@extends('layouts.assistant')
@section('contenido')

@section('page-title')
    Edicion de marcas
@endsection
    <div class="row">
        <h1>Modificar Marca</h1>
        {!!Form::open(['route'=>['brands.update', $brand->id], 'method'=>'PUT', 'id'=>'frmUpdate'])!!}
        <div class="row">
            <div class="input-field">
                {!! Form::text('nombre', $brand->name, ['id' => 'txtMotor']) !!}
                {!! Form::label('txtNombre', 'Nombre') !!}

                @if(Session::has('Emessage'))
                    <p class="red-text darken-4">{{ Session::get('Emessage') }}</p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="input-field">
                {!! Form::select('country_id', $countries, $brand->country_id) !!}
                {!! Form::label('txtPais', 'País') !!}
            </div>
        </div>

        <div class="row center-align">
            {{ Form::button('Modificar', ['type' => 'submit' , 'class' => 'btn waves-effect waves-light']) }}

        </div>
        {!!Form::close()!!}
    </div>

    <div class="row">

    </div>
@endsection