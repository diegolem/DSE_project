@extends(auth()->user()->user_type_id == 'ASI' ? 'layouts.assistant' : 'layouts.mechanic')
@section('page-title','Reparación')
@section('contenido')

    @if(Session::has('msg'))
        <div class="alert {{ Session::get('msg_type') }} lighten-2 {{ Session::get('msg_type') }}-text text-darken-4 center">
            {{ Session::get('msg') }}
        </div>
    @endif

    <script>
        let owners = @json($repair->car->clients),
            mechanics = @json($repair->mechanics);
    </script>

    <h3 class="center {{ auth()->user()->user_type_id == 'ASI' ? 'cyan' : 'deep-purple' }}-text text-darken-4">Reparación {{ $repair->code }}</h3>
    <div style="display: flex; justify-content: center; font-size: 18px;">
        <ul>
            <li><b>Fecha de entrada:</b> {{ $repair->admissionDate }}</li>
            <li><b>Fecha de salida:</b> {{ is_null($repair->departureDate) ? 'Sin establecer' : $repair->departureDate}}</li>
            <li><b>Estado:</b> {{ $repair->state == 0 ? 'En reparación' : 'Finalizada' }}</li>
        </ul>
    </div>

    <div style="display: flex; justify-content: space-evenly; width: 70%; margin: auto">
        <a href="#mdlDetails"  {{ count($repair->details) == 0 ? 'disabled' : '' }} title="Detalles" class="modal-trigger btnDetails waves-effect waves-light btn btn-large {{ auth()->user()->user_type_id == 'ASI' ? '' : 'deep-purple' }}"><i class="large material-icons">history</i></a>
        <a href="#mdlUsers" title="Propietarios" class="modal-trigger btnOwners waves-effect waves-light btn btn-large {{ auth()->user()->user_type_id == 'ASI' ? '' : 'deep-purple' }}"><i class="large material-icons">contacts</i></a>
        <a href="#mdlCar" title="Carro" class="modal-trigger btnCar waves-effect waves-light btn btn-large {{ auth()->user()->user_type_id == 'ASI' ? '' : 'deep-purple' }}"><i class="large material-icons">directions_car</i></a>
        <a href="#mdlUsers"  {{ count($repair->mechanics) == 0 ? 'disabled' : '' }} title="Mecánicos" class="modal-trigger btnMechanics waves-effect waves-light btn btn-large {{ auth()->user()->user_type_id == 'ASI' ? '' : 'deep-purple' }}"><i class="large material-icons">group</i></a>
        @php
            if($repair->status == 0 && auth()->user()->user_type_id == 'ASI'){
                echo "<a href='#mdlConfirm' title='Finalizar reparación' class='modal-trigger btnMechanics waves-effect waves-light btn btn-large'><i class='large material-icons'>check</i></a>";
            }
        @endphp
    </div>

    <div id="mdlCar" class="modal">
        <div class="modal-content">
            <h3 class="center {{ auth()->user()->user_type_id == 'ASI' ? 'cyan' : 'deep-purple' }}-text text-darken-4">Información del carro</h3>
            <div style="display: flex; justify-content: center; font-size: 18px;">
                <ul>
                    <li><b>Placa:</b> {{ $repair->car->license }}</li>
                    <li><b>Cilindraje:</b> {{ $repair->car->displacement }}</li>
                    <li><b>Millas:</b> {{ $repair->car->mileage }}</li>
                    <li><b>Año:</b> {{ $repair->car->year }}</li>
                    <li><b>Modelo:</b> {{ $repair->car->model->name }}</li>
                    <li><b>Transmisión:</b> {{ $repair->car->transmission->name }}</li>
                    <li><b>Observaciones:</b></li>
                    <li>{{ $repair->car->observations }}</li>
                </ul>
            </div>
        </div>

        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
        </div>
    </div>

    {{-- <a href="{{ route('repairs.index') }}">Regresar</a> --}}

    <div id="mdlDetails" class="modal bottom-sheet">
        <div class="modal-content">
            <table id="tblDetails" class="center">
                <thead>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                </thead>
                <tbody>
                @if(count($repair->details) > 0)
                    @foreach($repair->details as $detail)
                        <tr>
                            <td>{{ $detail->detail }}</td>
                            <td>{{ $detail->description }}</td>
                            <td>${{ number_format($detail->amount, 2) }}</td>
                            <td>{{ \Carbon\Carbon::createFromTimeString($detail->date)->format('d-m-Y') }}</td>
                        </tr>
                    @endforeach
                @else
                    <td colspan="4" class="red lighten-5 red-text text-darken-4 center">No hay detalles registrados para esta reparación.</td>
                @endif
                </tbody>
            </table>
        </div>

        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
        </div>
    </div>

    <div id="mdlUsers" class="modal bottom-sheet">
        <div class="modal-content">
            <table id="tblUsers" class="center">
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

    <div id="mdlConfirm" class="modal">
        <div class="modal-content" >
            <h4 class="center">Estás segur@ que quieres dar por finalizada esta reparación?</h4><br><br>
            <form name="frmFinish" id="frmFinish">
                <div class="row">
                    <div class="input-field col s10 offset-s1">
                        <select name="cmbUser" id="cmbUser">
                        @php $_i = 0 @endphp
                        @foreach($repair->car->clients as $client)
                            <option role="{{ $_i++ === 0 ? 'd' : 'r' }}" value="{{ $client->id }}">{{ $client->name . " " . $client->lastname }}</option>
                        @endforeach
                        </select>
                        <label for="cmbUser">Selecciona el usuario que retirará el vehículo del taller</label>
                    </div>
                </div>
            </form>
            <div class="btn-cont">
                <a class="modal-action modal-close waves-effect btn red">Cancelar <i class="material-icons right">cancel</i></a>
                <a id="btnFinish" class="waves-effect btn green">Confirmar <i class="material-icons right">check</i></a>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('.btnOwners').click(function(){
            $("#mdlUsers #tblUsers tbody").html("");
            owners.forEach((el, i) => {
                let _e = typeof el.pivot === 'undefined' && i == 0;
                $("#mdlUsers #tblUsers tbody").append(`
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

        $('.btnMechanics').click(function(){
            $("#mdlUsers #tblUsers tbody").html(mechanics.length > 0 ? "" : `<tr><td colspan="5" class="red lighten-5 red-text text-darken-4 center">No hay mecánicos asignados a esta reparación</td></tr>`);
            mechanics.forEach(el => {
                $("#mdlUsers #tblUsers tbody").append(`
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

        $('#btnFinish').click(function(){
            let loader = new Loader();
            loader.in();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('repairs.finish') }}",
                type: 'POST',
                data: {
                    id: '{{ $repair->status == 0 ? $repair->id : "-100" }}',
                    user_id: frmFinish.cmbUser.value.trim(),
                    role: $(frmFinish.cmbUser).children('option:selected').attr('role')
                },
                success: function(r){
                    loader.out();
                    if(r == "1" || r === "0"){
                        let msg = r == "1" ? 'La reparación ha sido finalizada éxitosamente!' : 'Ha ocurrido un error :$';

                        M.toast({html: msg, classes: `${r == 1 ? 'green' : 'red'}`, displayLength: 1000, completeCallback: function(){
                            location.reload();
                        }});
                    }else if(r == "-2"){
                        M.toast({html: 'El cliente que desea retirar el vehículo no posee permiso del dueño para representarlo...', classes: 'yellow darken-2', displayLength: 2500});
                    }else{
                        M.toast({html: 'La reparación que deseas finalizar no existe...', displayLength: 1000});
                    }
                }
            });
        });
    </script>
@endsection
