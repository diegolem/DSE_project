@extends(auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.assistant')

@section('page-title')
    Nuevo Usuario
@endsection

@section('contenido')

{{-- Formulario de ingreso de datos --}}
<form id="frm_usuario" autocomplete="off" method="POST" action="{{ route('users.store') }}" enctype="text/plain">

    {!! csrf_field() !!}
    <div class="row">

        <div class="input-field col s12 m6">
            <i class="material-icons prefix ">person_outline</i>
            <input name="name" id="txt_nombres" type="text" class="validate">
            <label for="txt_nombres">Nombres</label>
        </div>
        
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">person</i>
            <input name="lastname" id="txt_apellidos" type="text" class="validate">
            <label for="txt_apellidos">Apellidos</label>
        </div>
    
    </div>

    <div class="row">
        
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">phone</i>
            <input name="phone" id="txt_telefono" type="tel" class="validate">
            <label for="txt_telefono">Telefono</label>
        </div>
        
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">perm_contact_calendar</i>
            <input id="date_pick" name="birthdate" type="text" class="datepicker" placeholder="fecha de nacimiento">
        </div>

    </div>

    <div class="row">
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">chrome_reader_mode</i>
            <input name="dui" id="txt_dui" type="text" class="validate">
            <label for="txt_dui">Dui</label>
        </div>

        <div class="input-field col s12 m6">
            <i class="material-icons prefix">people</i>
            <select name="user_type_id">
                @php $i = true; @endphp
                @foreach ($user_type as $tipo)
                    <option value="{{$tipo->id }}" {{ ($i)? 'selected' : '' }}> {{ $tipo->name }} </option>
                    @php $i = false; @endphp
                @endforeach
            </select>
            <label>Tipo de usuario</label>
        </div>
        
    </div>

    <div class="row">

        <div class="input-field col s12">
            <i class="material-icons prefix">email</i>
            <input name="email" id="txt_correo_electronico" type="email" class="validate" value="" autocomplete="off">
            <label for="txt_correo_electronico">Correo electrónico</label>
        </div>

    </div>

    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">map</i>
            <textarea name="address" id="txt_direccion" class="materialize-textarea"></textarea>
            <label for="txt_direccion">Direccion</label>
        </div>
    </div>

    <div class="row">
        <div class="input-field col s12">
            <button id="btn_guardar" type="submit" class="waves-effect waves-light btn teal darken-3">Guardar</button>
            <button id="btn_limpiar" type="reset" class="waves-effect waves-light btn red darken-4">Limpiar</button>
        </div>
    </div>
    
    @if ($errors->any())
        
        @foreach ($errors->all() as $error)
            <div class="chip">
                {{ $error }}
                <i class="close material-icons">close</i>
            </div>
        @endforeach

    @endif

</form>


@endsection

@section('script')
    <script>
        function serialize_json(serial){
            let json = {};

            serial.split("&").forEach(function(datos){
                var item = datos.split("=");
                json[item[0]] = item[1];
            });

            return json;
        }

        function serializeArray_json(serial){
            let json = {};

            for (let i = 0; i < serial.length; i++) {
                const element = serial[i];
                json[element.name] = element.value;
            }

            return json;
        }

        $(document).ready(function(){
            $('#btn_limpiar').on('click', function(){
                M.updateTextFields();
                $('#frm_usuario')[0].reset();
                M.updateTextFields();
                return false;
            });

            jQuery.validator.addMethod("number_phone", function(value, element) {
                return /^[2,7][0-9]{3}-[0-9]{4}$/.test( value );
            }, 'invalid phone number.');

            jQuery.validator.addMethod("dui", function(value, element) {
                return /^[0-9]{8}-[0-9]$/.test( value );
            }, 'invalid dui.');

            jQuery.validator.addMethod("email_validation", function(value, element) {
                return /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/.test( value );
            }, 'invalid email.');

            $("#frm_usuario").validate({
                rules: {
                    
                    name: "required",
                    lastname: "required",
                    phone: {
                        required: true,
                        number_phone: true
                    },
                    birthdate: {
                        required: true,
                        date: true
                    },
                    dui: { 
                        required:true,
                        dui:true
                    },
                    user_type_id: "required",
                    email: {
                        required: true,
                        email_validation: true
                    }
                },
                submitHandler: function(form) {
                    var formdata = serializeArray_json($("#frm_usuario").serializeArray()); // here $(this) refere to the form its submitting
                    var loader = new Loader();
                    loader.in();
                    $.ajax({
                        type: 'POST',
                        url: "{{ url(strtolower(auth()->user()->userType->id).'/users') }}",
                        data: formdata,
                        success: function (data) {

                            if (data.success) { // 
                                M.toast({html:  data.msg, classes: 'rounded' });
                                $("#frm_usuario")[0].reset();
                            } else {
                                $.each(data.errors, function(key, value){
                                    M.toast({html:  value, classes: 'rounded' });
                                });
                            }
                            loader.out();

                        },
                        error : function ( jqXhr, json, errorThrown ) 
                        {
                            var errors = jqXhr.responseJSON;
                            var errorsHtml= '';
                            $.each( errors, function( key, value ) {
                                errorsHtml += '<li>' + value[0] + '</li>'; 
                            });

                            M.toast({html:  "Error: " + jqXhr.status +': '+ errorThrown + ' ' + JSON.stringify(json)});
                            loader.out();
                        }
                    });
                },
                invalidHandler: function(event, validator) {
                    // 'this' refers to the form
                    var errors = validator.numberOfInvalids();
                    if (errors) {
                        for (var i in validator.errorMap) {
                            M.toast({html: i + " " + validator.errorMap[i], classes: 'rounded' });
                        }
                    }
                }
            });

            $('#date_pick').datepicker({
                selectMonths: true,
                selectYears: 200, 
                format: 'yyyy-mm-dd',
                maxDate: new Date(),
                minDate: new Date(1950,1,1),
            });

            $("#frm_usuario").submit(function(stay){
                stay.preventDefault(); 

                return false;
            });
        });
    
    </script>
@endsection