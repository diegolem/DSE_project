@extends('layouts.assistant')
@section('page-title','Modificar especialidad')
@section('contenido')
<div class="row">

    @include('assistant.specialities.fragment.alert')
        <div class="row">&nbsp;</div>
    {!! Form::model($especia, ['route'=> ['specialties.update',$especia->id], 'method'=> 'PUT']) !!}
        @include('assistant.specialities.fragment.form')
    {!! Form::close() !!}

</div>
<div class="col-s5">
    <a class="waves-effect waves-light btn" href="{{ route('specialties.index') }}">Ver especialidades</a>
</div>
@endsection