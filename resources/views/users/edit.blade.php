@extends((auth()->user()->isAdmin())? 'layouts.admin': ((auth()->user()->isAssistant())? 'layouts.assistant':'layouts.client') )

@section('page-title')
    Usuario: {{ $user->name }}
@endsection

@section('contenido')

{{-- Formulario de ingreso de datos --}}
<form id="frm_usuario" name="frmUser" autocomplete="off" method="POST" >

    {!! csrf_field() !!}
    <div class="row">

        <div class="input-field col s12 m6">
            <i class="material-icons prefix ">person_outline</i>
            <input name="name" id="txt_nombres" type="text" value="{{ $user->name }}">
            <label for="txt_nombres">Nombres</label>
        </div>
        
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">person</i>
            <input name="lastname" id="txt_apellidos" type="text" value="{{ $user->lastname }}">
            <label for="txt_apellidos">Apellidos</label>
        </div>
    
    </div>

    <div class="row">
        
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">phone</i>
            <input name="phone" id="txt_telefono" type="tel" value="{{ $user->phone }}">
            <label for="txt_telefono">Telefono</label>
        </div>
        
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">perm_contact_calendar</i>
            <input id="date_pick" name="birthdate" type="text" class="datepicker" placeholder="fecha de nacimiento" value="{{ $user->birthdate }}">
        </div>

    </div>

    <div class="row">
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">chrome_reader_mode</i>
            <input name="dui" id="txt_dui" type="text" value="{{ $user->dui }}">
            <label for="txt_dui">Dui</label>
        </div>

        <div class="input-field col s12 m6">
            <i class="material-icons prefix">people</i>
            <select id="sel_user_type" name="user_type_id">
                @foreach ($user_type as $tipo)
                    <option value="{{$tipo->id }}" {{ ($user->user_type_id == $tipo->id)? 'selected' : '' }}> {{ $tipo->name }} </option>
                @endforeach
            </select>
            <label>Tipo de usuario</label>
        </div>
        
    </div>

    <input type="hidden" name="_method" value="PUT">

    <div class="row">

        <div class="input-field col s12">
            <i class="material-icons prefix">email</i>
            <input name="email" id="txt_correo_electronico" type="email" value="{{ $user->email }}" autocomplete="off">
            <label for="txt_correo_electronico">Correo electrónico</label>
        </div>

    </div>

    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">map</i>
            <textarea name="address" id="txt_direccion" class="materialize-textarea">{{ $user->address }}</textarea>
            <label for="txt_direccion">Direccion</label>
        </div>
    </div>
    
    <div class="row">
        <div class="input-field col s12">
            <button id="btn_guardar" type="submit" class="waves-effect waves-light btn green">Guardar</button>
            <button id="btn_limpiar" type="reset" class="waves-effect waves-light btn red">Limpiar</button>
        </div>
    </div>
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
            return /^[267][0-9]{3}[ -]?[0-9]{4}$/.test( value );
        }, 'Ingrese un teléfono válido.');

        jQuery.validator.addMethod("dui", function(value, element) {
            return /^[0-9]{8}-[0-9]$/.test( value );
        }, 'Ingresa un DUI válido.');

        jQuery.validator.addMethod("email_validation", function(value, element) {
            return /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/.test( value );
        }, 'Ingresa un correo válido..');

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
                    url: "{{ url(strtolower(auth()->user()->userType->id).'/users/'.$user->id) }}",
                    data: formdata,
                    success: function (data) {

                        if (data.success) { //
                            // Obtenemos el form
                            $('#txt_nombres').attr('value', $('#txt_nombres').val());
                            $('#txt_apellidos').attr('value', $('#txt_apellidos').val());
                            $('#txt_telefono').attr('value', $('#txt_telefono').val());
                            $('#txt_dui').attr('value', $('#txt_dui').val());
                            $('#txt_correo_electronico').attr('value', $('#txt_correo_electronico').val());
                            $('#txt_direccion').attr('value', $('#txt_correo_electronico').val());
                            $('#sel_user_type').val($('#sel_user_type').val());

                            loader.out();
                            M.toast({html:  'Usuario modificado', classes: 'rounded' });
                            M.updateTextFields();
                            $("#frm_usuario")[0].reset();
                            M.updateTextFields();
                            //window.location.replace("{{ url(strtolower(auth()->user()->userType->id).'/users') }}");
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

                        M.toast({html:  "Error: " + jqXhr.status +': '+ errorThrown });
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

        $("#frm_usuario").submit(function(stay){
            stay.preventDefault();
            return false;
        });
    });

</script>
@endsection