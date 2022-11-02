@extends('layouts.assistant')
@section('page-title')
    Modificar Vehículo
@endsection
@section('contenido')
    <div class="row">
        <!-- <h1>Modificar vehículo</h1> -->
        <script >let users = [], selectedClients = [];</script>
        @if(Session::has('message'))
            <div class="row col s8 offset-s2">
                <p class="center-align teal-text">{{ Session::get('message') }}</p>
            </div>
        @endif
        <br>
        {!! Form::open(['route' => ['cars.update', $car->id], 'method' => 'PUT', 'id' => 'frmUpdate', 'onsubmit' => 'addClients()']) !!}
            {{ Form::hidden('clients', $clients, ['id '=> 'clients']) }}
            {{ Form::hidden('owner', $car->user_id, ['id '=> 'owner']) }}
            <div class="row">
                <div class="input-field col s8 offset-s2 center-align">
                    <a href="#mdlClients" class="waves-effect waves-light btn modal-trigger">Elegir Clientes</a>
                </div>
                <div class="col s8 offset-s2">
                    @if ($errors->has('clients'))
                        <span class="error-block red-text">
                            <strong>{{ $errors->first('clients') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8 offset-s2">
                    {!! Form::text('license', $car->license, ['id' => 'txtLicense']) !!}
                    {!! Form::label('txtLicense', 'Matrícula') !!}

                    @if ($errors->has('license'))
                        <span class="error-block red-text">
                            <strong>{{ $errors->first('license') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8 offset-s2">
                    {!! Form::text('motor', $car->motor, ['id' => 'txtMotor']) !!}
                    {!! Form::label('txtMotor', 'Motor') !!}

                    @if ($errors->has('motor'))
                        <span class="error-block red-text">
                            <strong>{{ $errors->first('motor') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8 offset-s2">
                    {!! Form::text('displacement', $car->displacement, ['id' => 'txtDisplacement']) !!}
                    {!! Form::label('txtDisplacement', 'Cilindraje') !!}

                    @if ($errors->has('displacement'))
                        <span class="error-block red-text">
                            <strong>{{ $errors->first('displacement') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8 offset-s2">
                    {!! Form::text('mileage', $car->mileage, ['id' => 'txtMileage']) !!}
                    {!! Form::label('txtMileage', 'Millaje') !!}

                    @if ($errors->has('mileage'))
                        <span class="error-block red-text">
                            <strong>{{ $errors->first('mileage') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8 offset-s2">
                    {!! Form::number('year', $car->year, ['id' => 'txtYear']) !!}
                    {!! Form::label('txtYear', 'Año') !!}

                    @if ($errors->has('year'))
                        <span class="error-block red-text">
                            <strong>{{ $errors->first('year') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8 offset-s2">
                    {!! Form::select('model_id', $models, $car->model_id) !!}
                    {!! Form::label('', 'Modelo') !!}

                    @if ($errors->has('model_id'))
                        <span class="error-block red-text">
                            <strong>{{ $errors->first('model_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8 offset-s2">
                    {!! Form::select('transmission_id', $transmissions, $car->transmission_id) !!}
                    {!! Form::label('', 'Transmisión') !!}

                    @if ($errors->has('transmission_id'))
                        <span class="error-block red-text">
                            <strong>{{ $errors->first('transmission_id') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s8 offset-s2">
                    {!! Form::textarea('observations', $car->observations, ['class'=> 'materialize-textarea' ,'id' => 'txtObersvations']) !!}
                    {!! Form::label('txtObersvations', 'Observaciones') !!}

                    @if ($errors->has('observations'))
                        <span class="error-block red-text">
                            <strong>{{ $errors->first('observations') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row center-align col s8 offset-s2">
                {!! Form::button('Modificar', ['class' => 'waves-effect waves-light btn',  'type' => 'submit']) !!}
            </div>
        {!! Form::close() !!}
        <div id="mdlClients" class="modal bottom-sheet">
            <div class="modal-content">
                <form name="frmClients" id="frmClients">
                    <table id="tblClients" class="center tbl">
                        <thead>
                            <th>DUI</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Correo Electrónico</th>
                            <th>Teléfono</th>
                            <th>Seleccionar</th>
                            <th>Propietario</th>
                        </thead>
                        <tbody>
                        @if(count($users) > 0)
                            @foreach($users as $user)
                                <script >users.push(@json($user))</script>
                                <tr>
                                    <td>{{ $user->dui }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->lastname }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>
                                        @if(in_array($user->id, $clients->toArray()))
                                            <script>selectedClients.push({{ $user->id }});</script>
                                        @endif
                                        <p>
                                            <label>
                                                <input value='@json($user)' name="rdbClients" class="client_chk" type="checkbox"
                                                {{ (in_array($user->id, $clients->toArray())) ? "checked" : "" }} />
                                                <span></span>
                                            </label>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <label>
                                                <input name="owner" type="radio" value="{{ $user->id }}"
                                                {{ ($user->id == $car->user_id) ? "checked" : "" }} />
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
    </div>
    
    <script>
        $.validator.setDefaults({
            errorClass: 'invalid',
            validClass: 'none',
            errorPlacement: function(error, element) {
                $(element).parent().find('span.helper-text').remove();
                $(element).parent()
                    .append(`<span class='helper-text' data-error='${error.text()}'></span>`);
            }
        });

        $.validator.addMethod('validLicense', function(value, element) {
            return this.optional(element) || /^((O|CD|CC|MI|N|PNC|E|P|A|C|V|PR|T|RE|AB|MB|F|M|D)\d{3})(-?)((\s\d{3})|\d{3})$/.test(value);
        }, 'Ingrese una matrícula válida.');
        
        $.validator.addMethod('validNum', function(value, element) {
            return this.optional(element) || /^[1-9]\d*$/.test(value);
        }, 'Ingrese una valor válido.');

        $('#frmUpdate').validate({
            rules: {
                clients: {
                    required: true
                },
                license:{
                    required: true,
                    validLicense: true
                },
                motor:{
                    required: true
                },
                displacement:{
                    required: true,
                    validNum: true
                },
                mileage:{
                    required: true,
                    validNum: true
                },
                year:{
                    required: true,
                    validNum: true
                },
                model_id:{
                    required: true
                },
                transmission_id:{
                    required: true
                },
                observations:{
                    required: true
                }
            },
            messages:{
                clients: {
                    required: 'El campo clientes es requerido'
                },
                license:{
                    required: 'El campo matrícula es requerdio'
                },
                motor:{
                    required: 'El campo motor es requerido'
                },
                displacement:{
                    required: 'El campo cilindraje es requerido'
                },
                mileage:{
                    required: 'El campo millaje es requerido'
                },
                year:{
                    required: 'El campo año es requerido'
                },
                model_id:{
                    required: 'El campo modelo es requerido'
                },
                transmission_id:{
                    required: 'El campo transmisión es requerido'
                },
                observations: {
                    required: 'El campo observaciones es requerido'
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
        function addClients(){
            selectedClients = [];
            $('#tblClients .client_chk:checked').each((i, el) => {
                let m = JSON.parse(el.value);
                selectedClients.push(m.id);
            });
            $("#frmUpdate #clients").val((selectedClients));
            $("#frmRegisterCar #owner").val($("#frmClients input[name='owner']:checked").val());
        }
    </script>
@endsection()