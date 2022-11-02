@extends('layouts.client')

@section('page-title')
    Vehículos
@endsection

@section('contenido')
    <script>
        let users = {};
    </script>
    <div class="row">
        <h6 class="center blue-text text-darken-2">Mis vehículos</h6>
        @if(count($cars) == 0) <!-- Si el array esta vacío -->
            <div class="card-panel red darken-3 center-align">
                <span class="white-text">
                    No hay vehículos registrados bajo tu nombre!
                </span>
            </div>
        @elseif(count($cars) > 0)
            @foreach($cars as $car)
                <script >users['{{ $car->id }}'] = @json($car->clients)</script>
                <div class="col l6">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="materialboxed" height="250" src="{{ ( (count($car->images) > 0) ? Storage::url($car->images[0]->name) : Storage::url('cars/default.jpg') ) }}">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">{{ $car->model->name }} - {{ $car->year }}<i class="material-icons right">more_vert</i></span>
                            <p>
                                <a href="{{ route('cars.show',  $car->id) }}">Ver Reparaciones</a> |
                                <a href="#mdlOwners" class="modal-trigger btnOwners" car_id="{{ $car->id }}">Ver Representantes</a>
                            </p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4 center-align">{{ $car->model->name }}<i class="material-icons right">close</i></span>
                            <p>
                                <ul>
                                    <li>Matrícula: {{ $car->license }}</li>
                                    <li>Marca: {{ $car->model->brand->name }}</li>
                                    <li>Motor: {{ $car->motor }}</li>
                                    <li>Millaje: {{ $car->mileage }}</li>
                                    <li>Transmisión: {{ $car->transmission->name }}</li>
                                    <li>Observaciones: {{ $car->observations }}</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

            <div id="mdlOwners" class="modal bottom-sheet">
                <div class="modal-content">
                    <table id="tblOwners" class="center">
                        <thead>
                            <th>DUI</th>
                            <th>Nombre completo</th>
                            <th>Correo Electrónico</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
    
                <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
                </div>
            </div>

            <div id="mdlConfirm" class="modal">
                <div class="modal-content" >
                    <h4 class="center">Estás segur@ que quieres habilitar este usuario para que represente tu vehículo?</h4><br><br>
                    <div class="btn-cont">
                        <a class="modal-action modal-close waves-effect btn red">Cancelar <i class="material-icons right">cancel</i></a>
                        <a id="btnEnable" class="waves-effect btn green">Confirmar <i class="material-icons right">check</i></a>
                    </div>
                </div>
            </div>

            {!! Form::open(['route' => ['cars.enabledClient'], 'method' => 'POST', 'id' => 'frmUpdateClient']) !!}
                <input type="hidden" id="client" name="client">
                <input type="hidden" id="car" name="car">
                <input type="hidden" id="status" name="status">
            {!! Form::close() !!} <!-- Fin Formulario para eliminar -->
        @endif
    </div>
    <div class="row">
        <h6 class="center blue-text text-darken-2">Vehículos que represento</h6>
        @if(count($r_cars) == 0)
            <div class="card-panel red darken-3 center-align">
                <span class="white-text">
                    No representas ningún vehículo!
                </span>
            </div>
        @elseif(count($r_cars) > 0)
            @foreach($r_cars as $car)
                <div class="col l6">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="materialboxed" height="250" src="{{ ( (count($car->images) > 0) ? Storage::url($car->images[0]->name) : Storage::url('cars/default.jpg') ) }}">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4">{{ $car->model->name }} - {{ $car->year }}<i class="material-icons right">more_vert</i></span>
                            <p>
                                <a href="{{ route('cars.show',  $car->id) }}">Ver Reparaciones</a>
                            </p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4 center-align">{{ $car->model->name }}<i class="material-icons right">close</i></span>
                            <p>
                                <ul>
                                    <li>Matrícula: {{ $car->license }}</li>
                                    <li>Marca: {{ $car->model->brand->name }}</li>
                                    <li>Motor: {{ $car->motor }}</li>
                                    <li>Millaje: {{ $car->mileage }}</li>
                                    <li>Transmisión: {{ $car->transmission->name }}</li>
                                    <li>Observaciones: {{ $car->observations }}</li>
                                </ul>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection

@section('script')
    <script>
        (function(){
            let loader = new Loader(), user_id;
            $(document).on('click', '.btnEnableUser', function(){
                user_id = $(this).attr('user_id');
                $('#mdlOwners').modal('close');
                loader.in();
                $("#frmUpdateClient #client").val(user_id);
                $("#frmUpdateClient #car").val($(this).attr('car_id'));
                $("#frmUpdateClient #status").val($(this).attr('user_status'));
                setTimeout(function(){
                    loader.out();
                    $('#mdlConfirm').modal('open');
                }, 1000);
            })

            $('.btnOwners').click(function(){
                $("#tblOwners tbody").html("");
                users[$(this).attr('car_id')].forEach((el, i) => {
                    let _e = typeof el.pivot === 'undefined' && i == 0;
                    $("#tblOwners tbody").append(`
                        <tr class="${ !_e ? el.pivot.enabled == 0 ? 'red lighten-5' : '' : ''}"">
                            <td>${el.dui}</td>
                            <td>${el.name} ${el.lastname}</td>
                            <td>${el.email}</td>
                            <td>${ !_e ? el.pivot.enabled == 0 ? 'Deshabilitado' : 'Habilitado' : ' - '}</td>
                            <td>
                                <a user_id="${el.id}" car_id="${$(this).attr('car_id')}" 
                                    user_status="${ !_e ? el.pivot.enabled == 0 ? '1' : '0' : ' - '}"
                                    ${ !_e ? el.pivot.enabled == 0 ? "title='Habilitar representante'"  : "title='Deshabilitar representante'" : ' - '}
                                    class="btnEnableUser btn blue darken-2 waves-effect">
                                    <i class="material-icons">${ !_e ? el.pivot.enabled == 0 ? 'check' : 'cancel' : ' - '}</i>
                                </a>
                            </td>
                        </tr>
                    `);
                })
            });

            $("#btnEnable").click(function(){
                var url = $('#frmUpdateClient').attr('action'),
                    data = $('#frmUpdateClient').serializeArray()
                ;
                loader.in();
                $.post(url, data, function(r){
                    if(r === "1"){
                       $('#mdlEliminar').modal('close');
                       M.toast({html: 'Modifiación exitosa!', completeCallback: function(){ location.reload(); } });
                    }else{
                       M.toast({html: 'Modificación no exitosa!' });
                    }
                }).fail(function(err){
                   M.toast({html: 'Error en el ajax!' });
                });
                loader.out();
            });
        })();
    </script>
@endsection