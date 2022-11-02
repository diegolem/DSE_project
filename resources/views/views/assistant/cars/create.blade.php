@extends('layouts.assistant')

@section('page-title')
    Registrar Vehículo
@endsection

@section('contenido')
    <!-- <div class="container"> -->
    <script >let users = [];</script>
        <div class="row">
            
            @if(Session::has('message'))
                <div class="row col s8 offset-s2 ">
                    <p class="center-align teal-text">{{ Session::get('message') }}</p>
                </div>
            @endif
            <br>
            {!! Form::open(['route' => 'cars.store', 'files' => true, 'method' => 'POST', 
                'id' => 'frmRegisterCar', 'onsubmit' => 'addClients()']) !!}
                {{ Form::hidden('clients', null, ['id '=> 'clients']) }}
                {{ Form::hidden('owner', null, ['id '=> 'owner']) }}
                
                <div class="row">
                    <div class="input-field col s8 offset-s2 center-align">
                        <a href="#mdlClients" class="waves-effect waves-light btn modal-trigger">Elegir Clientes</a>
                        
                    </div>
                    <div class="col s8 offset-s2">
                        @if ($errors->has('owner'))
                            <span class="error-block red-text">
                                <strong>{{ $errors->first('owner') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s8 offset-s2">
                        {!! Form::text('license', '', ['id' => 'txtLicense']) !!}
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
                        {!! Form::text('motor', '', ['id' => 'txtMotor']) !!}
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
                        {!! Form::text('displacement', '', ['id' => 'txtDisplacement']) !!}
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
                        {!! Form::text('mileage', '', ['id' => 'txtMileage']) !!}
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
                        {!! Form::number('year', '', ['id' => 'txtYear']) !!}
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
                        {!! Form::select('model_id', $models) !!}
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
                        {!! Form::select('transmission_id', $transmissions) !!}
                        {!! Form::label('', 'Transmisión') !!}

                        @if ($errors->has('transmission_id'))
                            <span class="error-block red-text">
                                <strong>{{ $errors->first('transmission_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="input-field file-field col s8 offset-s2">
                        <div class="btn">
                            <span>Imágenes</span>
                            <input type="file" name="images[]" multiple>
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path" type="text" placeholder="Una, varias o ninguna imágen.">
                            
                            @if ($errors->has('images'))
                                <span class="error-block red-text">
                                    <strong>{{ $errors->first('images') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s8 offset-s2">
                        {!! Form::textarea('observations', '', ['class'=> 'materialize-textarea' ,'id' => 'txtObersvations']) !!}
                        {!! Form::label('txtObersvations', 'Observaciones') !!}
                    
                        @if ($errors->has('observations'))
                            <span class="error-block red-text">
                                <strong>{{ $errors->first('observations') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row center-align col s8 offset-s2">
                    {!! Form::button('Registrar', ['class' => 'waves-effect waves-light btn',  'type' => 'submit']) !!}
                </div>
            {!! Form::close() !!}
        </div>
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
                                        <p>
                                            <label>
                                                <input value='@json($user)' name="rdbClients" class="client_chk" type="checkbox" />
                                                <span></span>
                                            </label>
                                        </p>
                                    </td>
                                    <td>
                                        <p>
                                            <label>
                                                <input name="owner" type="radio" value="{{ $user->id }}" />
                                                <span></span>
                                            </label>
                                        </p>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <td colspan="7" class="center red lighten-4 red-text text-darken-4">No existen clientes registrados para que se les asigne un vehículo.</td>
                        @endif
                        </tbody>
                    </table>
                </form>
    
            </div>
                


            <div class="modal-footer">
                <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat">Cerrar</a>
            </div>
        </div>

    <!-- </div> -->
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

        $('#frmRegisterCar').validate({
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
        let selectedClients = [];

        function addClients(){
            selectedClients = [];
            $('#frmClients .client_chk:checked').each((i, el) => {
                let m = JSON.parse(el.value);
                selectedClients.push(m.id);
            });
            $("#frmRegisterCar #clients").val((selectedClients));
            $("#frmRegisterCar #owner").val($("#frmClients input[name='owner']:checked").val());
        }
    </script>
@endsection