@extends('layouts.assistant')

@section('page-title')
    Vehículos
@endsection

@section('contenido')
   <!-- <div class=""> -->
        <div class="row">
            @if(Session::has('message'))
                <div class="row col s8 offset-s2 alert lighten-2 white-text">
                    <p class="center-align teal-text">{{ Session::get('message') }}</p>
                </div>
            @endif
            <!-- <h1 class="center">Lista de vehículos</h1> -->
            @if(count($cars) == 0) <!-- Si el array esta vacío -->
                <div class="card-panel red darken-3 center-align">
                    <span class="white-text">
                        No hay vehículos registrados!
                    </span>
                </div>
            @elseif(count($cars) > 0)
                <table class="tbl centered" id="tblCars">
                    <thead>
                        <tr>
                            <th>Matrícula</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Motor</th>
                            <th>Año</th>
                            <th>Transmisión</th>
                            <th>Cilindros</th>
                            <th>Modificar</th>
                            <th>Ver</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cars as $car)
                        <tr data="{{ $car->id }}">
                            <td> {{ $car->license }} </td>
                            <td> {{ $car->model->brand->name }} </td>
                            <td> {{ $car->model->name }} </td>
                            <td> {{ $car->motor }} </td>
                            <td> {{ $car->year }} </td>
                            <td> {{ $car->transmission->name }} </td>
                            <td> {{ $car->displacement }} </td>
                            <td>
                                <a title="Modificar" class="waves-effect teal-text text-darken-1" 
                                    href="{{ route('cars.edit', $car->id) }}">
                                    <i class="material-icons">mode_edit</i>
                                </a>
                            </td>
                            <td>
                                <a title="Ver" class="waves-effect teal-text text-darken-1" 
                                    href="{{ url('/asi/cars/'.$car->id) }}">
                                    <i class="material-icons">remove_red_eye</i>
                                </a>
                            </td>
                            <td>
                                @if(count($car->repairs) == 0)
                                    <a href="#!" class="btn-delete waves-effect teal-text text-darken-1" title="Eliminar">
                                        <i class="material-icons">delete</i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <a href="{{ route('cars.create') }}" class="btn cyan darken-4" style="margin: 3% 0">Registrar nuevo vehículo <i class="material-icons right">add</i></a>

       <div id="mdlEliminar" class="modal">
           <div class="modal-content">
               <h4 class="center-align">Eliminación de Vehículo</h4>
               <p class="center-align">¿Está seguro de eliminar el vehículo?</p>
           </div>
           <div class="modal-footer">
                <a href="#!" id="btnEliminar" class="waves-effect waves-red btn-flat">Eliminar</a>
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
           </div>
       </div>

        {!! Form::open(['route' => ['cars.destroy', ':CAR_ID'], 'method' => 'DELETE', 'id' => 'frmDelete']) !!} <!-- Formulario para eliminar -->
            <input type="hidden" id="txtIdCar">
        {!! Form::close() !!} <!-- Fin Formulario para eliminar -->
        
        <script>
            $(document).ready(function(){
                $('.modal').modal();
            });

            $('.btn-delete').click(function(e){ //Proceso para 'eliminar'
                e.preventDefault();
                var id = $(this).parent().parent('tr').attr('data');
                $('#frmDelete #txtIdCar').val(id);
                $('#mdlEliminar').modal('open');
            });

            function eliminarCarrera(){
                var url = $('#frmDelete').attr('action').replace(':CAR_ID', $('#frmDelete #txtIdCar').val() ),
                    data = $('#frmDelete').serialize()
                ;
                $.post(url, data, function(r){
                    if(r === "1"){
                       //$(this).parent().parent('tr').fadeOut(); //Quitamos la fila
                       $('#mdlEliminar').modal('close');
                       M.toast({html: 'Eliminación exitosa!', completeCallback: function(){ location.reload(); } });
                    }else{
                       M.toast({html: 'Eliminación no exitosa!' });
                    }
                }).fail(function(err){
                   M.toast({html: 'Error en el ajax!' });
                });
            }

            $(document).on('click', '#mdlEliminar', function (e) {
                if ($(e.target).attr("id") == $("#btnEliminar").attr("id")) {
                    eliminarCarrera();
                }
            });
        </script>
    <!-- </div> -->
@endsection