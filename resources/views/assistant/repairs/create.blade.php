@extends('layouts.assistant')

@section('page-title', 'Registrar reparación')

@section('contenido')

    <h5 class="center section teal-text text-darken-3">Selecciona el carro al que se desea someter a reparación</h5>

    @if(count($cars) > 0)
        <script >let users = {}, mechanics = []</script>

        <div class="btn-cont">
            <a href="#mdlMechanics" class="modal-trigger btn teal darken-1" {{ count($mechanics) == 0 ? 'disabled' : '' }}>Mecánicos</a>
        </div>

        <table id="tblCars" class="center">
            <thead>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Transmisión</th>
                <th>Acción</th>
            </thead>
            <tbody>
                @foreach($cars as $car)
                    <tr>
                        <td>{{ $car->license }}</td>
                        <td>{{ $car->model->brand->name }}</td>
                        <td>{{ $car->model->name }}</td>
                        <td>{{ $car->year }}</td>
                        <td>{{ $car->transmission->name }}</td>
                        <td>
                            <script>
                                users['{{ $car->id }}'] = @json($car->clients);
                            </script>
                            <a href="#mdlOwners" class="modal-trigger btn btnOwners waves-effect waves-light" car_id="{{ $car->id }}" title="Ver propietarios"><i class="material-icons">contacts</i></a>
                            <a href="#mdlConfirm" class="modal-trigger btn btnConfirm waves-effect waves-light btn teal darken-4" car_id="{{ $car->id }}" title="Asignar reparación"><i class="material-icons">build</i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="card-panel red darken-3 center-align">
            <span class="white-text">
                No hay carros registrados para asignarles una reparación!
            </span>
        </div>
    @endif

    <div id="mdlMechanics" class="modal bottom-sheet">
        <div class="modal-content">
            <form name="frmMechanics" id="frmMechanics">
                <table id="tblMechanics" class="center">
                    <thead>
                        <th>DUI</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Correo Electrónico</th>
                        <th>Teléfono</th>
                        <th>Seleccionar</th>
                    </thead>
                    <tbody>
                    @if(count($mechanics) > 0)
                        @foreach($mechanics as $mechanic)
                            <script >mechanics.push(@json($mechanic))</script>
                            <tr>
                                <td>{{ $mechanic->dui }}</td>
                                <td>{{ $mechanic->name }}</td>
                                <td>{{ $mechanic->lastname }}</td>
                                <td>{{ $mechanic->email }}</td>
                                <td>{{ $mechanic->phone }}</td>
                                <td>
                                    <p>
                                        <label>
                                            <input value='@json($mechanic)' name="rdbMechanics" class="mechanich_chk" type="checkbox" />
                                            <span></span>
                                        </label>
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <td colspan="6" class="center red lighten-4 red-text text-darken-4">No hay mecánicos registrados para que sean asignados a la reparación.</td>
                    @endif
                    </tbody>
                </table>
            </form>
        </div>

        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
        </div>
    </div>

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
                <tbody>
                    
                </tbody>
            </table>
        </div>

        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
        </div>
    </div>

    <div id="mdlConfirm" class="modal">
        <div class="modal-content">
            <h4 class="center">Estás segur@ de asignar una reparación a este vehículo?</h4>
            <div class="center" id="mechanicsCont"></div>
            <div style="display: flex; justify-content: center; margin-top: 5%;">
                {!! Form::model($repair, ['name' => 'frmConfirm', 'route'=> ['repairs.store']]) !!}
                    {{ Form::hidden('car_id') }}
                    {{ Form::hidden('mechanics_id') }}
                    <a class="modal-action modal-close waves-effect waves-light btn red">Cancelar <i class='material-icons right'>cancel</i></a>
                    {!! Form::button("<i class='material-icons right'>check</i> Confirmar", ['class' => 'center btnSubmit waves-effect waves-light btn green darken-1',  'type' => 'submit']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // $("button.btnSubmit[type=submit]").append(`<i class="material-icons">check_circle</i>`);
        $("#tblCars").DataTable();
        $("#tblMechanics").DataTable();
        let selectedMechanics = [];

        $('.btnOwners').click(function(){
            $("#tblOwners tbody").html("");
            users[$(this).attr('car_id')].forEach((el, i) => {
                $("#tblOwners tbody").append(`
                    <tr>
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

        $('.btnConfirm').click(function(){
            selectedMechanics = [];
            if($('#frmMechanics .mechanich_chk:checked').length > 0){
                $('#mdlConfirm .modal-content #mechanicsCont').html('<ul><b class="teal-text text-darken-4">Mecánicos seleccionados</b></ul>');

                $('#frmMechanics .mechanich_chk:checked').each((i, el) => {
                    // console.log(el);
                    let m = JSON.parse(el.value);
                    selectedMechanics.push(m.id);
                    $('#mdlConfirm .modal-content #mechanicsCont ul').append(`<li><b>DUI:</b> ${m.dui}<br><b>Nombre:</b> ${m.name} ${m.lastname}</li>`);
                });
            }else{
                $('#mdlConfirm .modal-content #mechanicsCont').html(`<div class="alert red lighten-5 red-text text-darken-4">No has seleccionado ningún mecánico</div>`);
            }

            frmConfirm.car_id.value = $(this).attr('car_id');
            frmConfirm.mechanics_id.value = JSON.stringify(selectedMechanics);
        });

        $(frmConfirm).submit(function(e){
            if($('#frmMechanics .mechanich_chk:checked').length == 0){
                e.preventDefault();
                M.toast({html: "Debes asignar por lo menos un mecánico para la reparación...", classes: "red darken-1", displayLength: 2000});
            }
        })
    </script>
@endsection