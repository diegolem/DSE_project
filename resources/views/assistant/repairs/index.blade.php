@extends('layouts.assistant')
@section('page-title','Reparaciones')
@section('contenido')

    @if(Session::has('msg'))
        <div class="alert {{ Session::get('msg_type') }} lighten-2 {{ Session::get('msg_type') }}-text text-darken-4 center">
            {{ Session::get('msg') }}
        </div>
    @endif

    @if(count($repairs) > 0)
        <script >let users = {}</script>
        <table id="tblRepairs" class="centered tbl">
            <thead>
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
                        <script >users['{{ $repair->car->id }}'] = @json($repair->car->clients)</script>
                        <a href="#mdlOwners" class="modal-trigger btn btnOwners waves-effect waves-light" car_id="{{ $repair->car->id }}" title="Ver propietarios"><i class="material-icons">contacts</i></a>
                        <a href="{{ route('repairs.show', ['repair_id' => $repair->id]) }}" class="btn waves-effect teal darken-1 waves-light" title="Ver reparación"><i class="material-icons">remove_red_eye</i></a>
                        <a href="{{ route('details.create', ['repair_id' => $repair->id]) }}" class="btn waves-effect teal darken-3 waves-light" title="Añadir detalle"><i class="material-icons">add</i></a>
                        <a href="{{ route('repairs.pdf', ['id' => $repair->id]) }}" 
                            class="btn waves-effect teal darken-3 waves-light" title="Ver Factura">
                            <i class="material-icons">insert_drive_file</i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div id="mdlOwners" class="modal bottom-sheet">
            <div class="modal-content">
                <table id="tblOwners" class="center">
                    <thead>
                        <th>DUI</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Correo Electrónico</th>
                        <th>Teléfono</th>
                        <th>Rol</th>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
            </div>
        </div>
    @else
        <div class="card-panel red darken-3 center-align">
            <span class="white-text">
                No hay reparaciones registradas!
            </span>
        </div>
    @endif

    <a href="{{ route('repairs.create') }}" class="btn cyan darken-4" style="margin: 3% 0">Registrar nueva reparación <i class="material-icons right">add</i></a>
@endsection

@section('script')
    <script>
        $('.btnOwners').click(function(){
            $("#tblOwners tbody").html("");
            users[$(this).attr('car_id')].forEach((el, i) => {
                let _e = typeof el.pivot === 'undefined' && i == 0;
                $("#tblOwners tbody").append(`
                    <tr class="${ !_e ? el.pivot.enabled == 0 ? 'red lighten-5' : '' : ''}" ${ !_e ? el.pivot.enabled == 0 ? 'title="El representante aún no posee verificación por parte del dueño..."' : '' : ''}>
                        <td>${el.dui}</td>
                        <td>${el.name}</td>
                        <td>${el.lastname}</td>
                        <td>${el.email}</td>
                        <td>${el.phone}</td>
                        <td>${i == 0 ? 'Dueño' : 'Representante'}</td>
                    </tr>
                `);
            })
        });
    </script>
@endsection
