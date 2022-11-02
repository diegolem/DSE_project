@extends('layouts.client')

@section('page-title')
    Vehículo[Reparaciones]
@endsection

@section('contenido')
    <script>
        let details = {}, mechanics = {};
    </script>
    <div class="row">
        @if(count($car->images) > 0)
            <h4 class="center-align">Imágenes</h4>
            <div class="carousel">
                @foreach($car->images as $image)
                    <a href="#!" class="carousel-item"> <img src="{{ Storage::url($image->name) }}"></a>
                @endforeach
            </div>
        @endif
        <h4 class="center-align">Reparaciones</h4>
        @if(count($car->repairs) >0 )
            <table class="centered responsive-table tbl">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Fecha de Inicio</th>
                        <th>Fecha Final</th>
                        <th>Estado</th>
                        <th>N° Detalles</th>
                        <th>Detalles</th>
                        <th>Mecánicos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($car->repairs as $repair)
                        <tr>
                            <td>{{ $repair->code }}</td>
                            <td>{{ $repair->admissionDate }}</td>
                            <td>{{ ( ($repair->departureDate == '') ? 'No asignada' : $repair->departureDate) }}</td>
                            <td>{{ ($repair->status == 1) ? 'Reparado' : 'En Reparación' }}</td>
                            <td>{{ count($repair->details) }}</td>
                            <td>
                                <script>
                                    details['{{ $repair->id }}'] = @json($repair->details);
                                </script> <!-- Arreglo con reparaciones -->
                                <a href="#mdlDetails" 
                                    class="modal-trigger btn blue darken-2 btnDetails waves-effect waves-light" 
                                    detail_id="{{ $repair->id }}" title="Ver Detalles">
                                    <i class="material-icons">line_weight</i>
                                </a>
                            </td>
                            <td>
                                <script>
                                    mechanics['{{ $repair->id }}'] = @json($repair->mechanics);
                                </script><!-- Arreglo con mecánicos -->
                                <a href="#mdlMechanics" 
                                    class="modal-trigger btn blue darken-2 btnMechanics waves-effect waves-light" 
                                    detail_id="{{ $repair->id }}" title="Ver Mecánicos">
                                    <i class="material-icons">contacts</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="card-panel red darken-3 center-align">
                <span class="white-text">
                    No hay reparaciones registradas!
                </span>
            </div>
        @endif
    </div>
    <div id="mdlDetails" class="modal bottom-sheet"><!-- Modal para Detalles -->
        <div class="modal-content">
            <table id="tblDetails" class="centered">
                <thead>
                    <th>Detalle</th>
                    <th>Descripción</th>
                    <th>Monto ($)</th>
                    <th>Fecha</th>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>

        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
        </div>
    </div>
    <div id="mdlMechanics" class="modal bottom-sheet"><!-- Modal para Mecánicos -->
        <div class="modal-content">
            <table id="tblMechanics" class="centered">
                <thead>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Edad</th>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>

        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('.carousel').carousel();
            $('select').formSelect();

            $(".btnDetails").click(function(){
                $("#tblDetails tbody").html("");
                if(details[$(this).attr('detail_id')].length == 0){
                    $("#tblDetails tbody").html(`
                        <td colspan="4" class="center red lighten-4 red-text text-darken-4">
                            No hay detalles en la reparación seleccionada.
                        </td>
                    `);
                }else{
                    details[$(this).attr('detail_id')].forEach(element => {
                        $("#tblDetails tbody").append(`
                            <tr>
                                <td>${element.detail}</td>
                                <td>${element.description}</td>
                                <td>${element.amount}</td>
                                <td>${element.date}</td>
                            </tr>
                        `);
                    });
                }
            });

            $(".btnMechanics").click(function() {
                $("#tblMechanics tbody").html("");
                if(mechanics[$(this).attr('detail_id')].length == 0){
                    $("#tblMechanics tbody").html(`
                        <td colspan="4" class="center red lighten-4 red-text text-darken-4">
                            No hay mecánicos en la reparación seleccionada.
                        </td>
                    `);
                }else{
                    mechanics[$(this).attr('detail_id')].forEach(element => {
                        $("#tblMechanics tbody").append(`
                            <tr>
                                <td>${element.name}</td>
                                <td>${element.lastname}</td>
                                <td>${element.age}</td>
                            </tr>
                        `);
                    });
                }
            });
        });
    </script>
@endsection