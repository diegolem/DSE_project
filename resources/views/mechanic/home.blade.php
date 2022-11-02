@extends('layouts.mechanic')
@section('page-title','Mecánico')

@section('contenido')
<div class="row">
    <h4 class="center deep-purple-text">Mis reparaciones</h4>
    @if(Session::has('msg'))
        <div class="alert {{ Session::get('msg_type') }} lighten-2 {{ Session::get('msg_type') }}-text text-darken-4 center">
            {{ Session::get('msg') }}
        </div>
    @endif
    
    <div class="row">&nbsp;</div>
    @if(count($repairs) == 0)
    <div class="card-panel red darken-3 center-align">
        <span class="white-text">
            No hay reparaciones asignadas en curso!!
        </span>
    </div>
    @elseif(count($repairs) > 0)
    <table class="centered tbl" id="tblSpecialty">
        <thead id="headSpecialty">
            <th>Código de Reparación</th>
            <th>Fecha de entrada</th>
            <th>Fecha de salida</th>
            <th>Estado</th>
            <th>Acciones</th>
        </thead>
            <tbody>
                @foreach($repairs as $repair)
                <tr>
                    <td>{{ $repair->code }}</td>
                    <td>{{ $repair->admissionDate }}</td>
                    <td>{{ ($repair->departureDate == null) ? "-" :  $repair->departureDate }}</td>
                    <td>{{ $repair->status == 1 ? 'Finalizado' : 'En reparación' }}</td>
                    <td>
                        <a href="{{ route('mechanic.details.create', ['repair_id' => $repair->id]) }}" class="btn waves-effect deep-purple waves-light" title="Añadir detalle"><i class="material-icons">add</i></a>
                        <a href="{{ route('mechanic.repairs.show', ['repair_id' => $repair->id]) }}" class="btn waves-effect deep-purple waves-light" title="Ver reparación"><i class="material-icons">remove_red_eye</i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
@endsection