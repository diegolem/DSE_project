@extends('layouts.assistant')
@section('page-title','Modelo')
@section('contenido')
<div class="row">
        <div class="row">
            <div class="col s2"></div>
                <div class="col s8">
                  <div class="card grey lighten-4">
                    <div class="card-content black-text">
                      <span class="card-title center"><strong>Datos</strong></span>
                      <p>
                            <strong>Nombre del modelo:</strong>
                            <div class="col sm6">
                                - {{$model->name}}
                            </div>
                      </p>
                      <div class="row">&nbsp;</div>
                      <p>
                            <strong>Descripción:</strong>
                            <div class="col sm6">
                                - {{$model->brand->name}}
                            </div>
                      </p><div class="row">&nbsp;</div>
                    </div>
                    <div class="card-action">
                            <a title="Modificar" class="waves-effect waves-teal btn-flat" href="{{ route('models.edit', $model->id) }}"><i class="material-icons">mode_edit</i></a>
                    </div>
                  </div>
                </div>
        </div>           
<div class="row">
    <div class="col s5"></div>
            <div class="col s6">
                <a class="waves-effect waves-light btn" href="{{ route('models.index') }}">Regresar</a>
            </div>
</div>
<div class="row">
        <div class="col s12">
                @if(count($model->cars) == 0)
                <div class="card-panel red darken-3 center-align">
                    <span class="white-text">
                        No hay ningún carro con este modelo
                    </span>
                </div>
            @elseif(count($model->cars) > 0)
            <div class="col s3"><h6><strong>Carros con este modelo:</strong></h6></div>
            <table class="centered tbl" id="tblModelCars">
                <thead id="headModelCars">
                    <th>Matrícula</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Motor</th>
                    <th>Año</th>
                    <th>Transmición</th>
                    <th>Cilindros</th>
                </thead>
                <tbody>
                @foreach($cars as $car)
                    <tr data="{{ $car->id  }}">
                        <td> {{ $car->license  }} </td>
                        <td> {{ $car->Bname  }} </td>
                        <td> {{ $car->Mname }} </td>
                        <td> {{ $car->motor }} </td>
                        <td> {{ $car->year }} </td>
                        <td> {{ $car->Tname }} </td>
                        <td> {{ $car->displacement }} </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>
@endsection