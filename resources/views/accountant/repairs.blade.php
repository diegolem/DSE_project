@extends('layouts.admin')

@section('page-title')
    Reparaciones
@endsection

@section('contenido')
@if(count($repairs) > 0)
<script>
    let users = {};
    let detalles = {};
</script>
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
                <script>
                    users['{{ $repair->car->id }}'] = @json($repair->car->clients);
                    
                    var json = {};

                    @foreach ($repair->details as $detalle)
                        json['{{ $detalle->id }}'] = @json($detalle);
                    @endforeach
                        detalles['{{ $repair->car->id }}'] = json;
                </script>
                <a href="#mdlOwners" class="modal-trigger btn btnOwners waves-effect waves-light teal darken-1" car_id="{{ $repair->car->id }}" title="Ver propietarios"><i class="material-icons">info_outline</i></a>
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
            </thead>
            <tbody>

            </tbody>
        </table>

        <table id="tbl_detail" class="center striped" style="margin-top: 1rem;">
            <thead>
                <th>Detalle</th>
                <th>Descripcion</th>
                <th>Monto</th>
                <th>Fecha</th>
            </thead>
            <tbody>

            </tbody>
        </table>

        <footer class="page-footer red darken-4" style="padding-top: 0rem;">
            <div class="container" style="padding-top: 0rem;">
                <div class="row" style="padding-top: 0rem;">
                    <div class="col l6 s12">
                        <h5 class="white-text">Monto total:</h5>
                    </div>
                    <div class="col l4 offset-l2 s12">
                        <h5 class="white-text" id="monto_total"></h5>
                    </div>
                </div>
            </div>
          </footer>
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

@endsection

@section('script')
    <script>
        $('.btnOwners').click(function(){
            $("#tblOwners tbody").html("");
            $("#tbl_detail tbody").html("");
            $('#monto_total').html("");

            var car_id = $(this).attr('car_id');

            var val = detalles[car_id];

            var total = 0;

            $.each( val, function( key, value ) {
                $("#tbl_detail tbody").append(`
                    <tr>
                        <td>${value.detail}</td>
                        <td>${value.description}</td>
                        <td>${value.amount}$</td>
                        <td>${value.date}$</td>
                    </tr>
                `);

                total += parseFloat(value.amount);
            });
            
            $('#monto_total').html('' + parseFloat(Math.round(total * 100) / 100).toFixed(2) + '$');

            users[car_id].forEach(el => {
                $("#tblOwners tbody").append(`
                    <tr>
                        <td>${el.dui}</td>
                        <td>${el.name}</td>
                        <td>${el.lastname}</td>
                        <td>${el.email}</td>
                        <td>${el.phone}</td>
                    </tr>
                `);
            });
});
    </script>
@endsection