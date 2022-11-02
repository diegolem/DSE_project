@extends('layouts.assistant')
@section('page-title','Categoría')
@section('contenido')
<div class="row">
        <div class="row">
            <div class="col s2"></div>
                <div class="col s8">
                  <div class="card grey lighten-4">
                    <div class="card-content black-text">
                      <span class="card-title center"><strong>Datos</strong></span>
                      <p>
                            <strong>Nombre de la categoría:</strong>
                            <div class="col sm6">
                                - {{$category->name}}
                            </div>
                      </p>
                      <div class="row">&nbsp;</div>
                      <p>
                            <strong>Descripción:</strong>
                            <div class="col sm6">
                                - {{$category->description}}
                            </div>
                      </p><div class="row">&nbsp;</div>
                    </div>
                    <div class="card-action">
                            <a title="Modificar" class="waves-effect waves-teal btn-flat" href="{{ route('category.edit', $category->id) }}"><i class="material-icons">mode_edit</i></a>
                    </div>
                  </div>
                </div>
        </div>           
<div class="row">
    <div class="col s5"></div>
            <div class="col s6">
                <a class="waves-effect waves-light btn" href="{{ route('category.index') }}">Regresar</a>
            </div>
</div>
</div>
@endsection