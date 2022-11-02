@extends('layouts.assistant')
@section('page-title','Añadir Especialidades a los mecánicos')
@section('contenido')
<div class="row">

<div class="row">
        <div class="col s12">
                @if(count($especialty) == 0)
                <div class="card-panel red darken-3 center-align">
                    <span class="white-text">
                        No hay ninguna especialidad registrada!!
                    </span>
                </div>
            @elseif(count($especialty) > 0)
            <table class="centered tbl" id="tblMechanicSpecialty">
                <thead id="headMechanicSpecialty">
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Acción</th>
                </thead>
                <tbody>

                </tbody>
            </table>
            <div class="row">&nbsp;</div>
            <div class="col s4"></div>
            <div class="col s6">
                <button disabled="true" class="waves-effect waves-light btn green darken-1" id="btnAgregar"><i class="material-icons left">add_circle_outline</i>Agregar Seleccionados</button>
            </div>
            @endif
        </div>
    </div>
    
    {!! Form::open(['route'=> ['specialties.mechanicStore']]) !!}
    <div class="row">
        <div class="input-field col s8 offset-s2" id="txtSpecialty">
                <select id="sltEspecialty">
                    @foreach($especialty as $espe)
                        <option value="{{$espe->id}}">{{$espe->name}}</option>
                    @endforeach
                </select>
                <label for="sltEspecialty">Seleccione una especialidad</label>
        <span class="helper-text red-text text-darken-2" id="helSpecialty" data-error="wrong" data-success="right"></span>
        </div>
    </div>
    {!! Form::close() !!}
    
    <div class="row">
        <div class="col s5"></div>
                <div class="col s6">
                    <a class="waves-effect waves-light btn" href="{{ route('specialties.index') }}">Regresar</a>
                </div>
    </div>
</div>
<form action="{{ route('mechanic.get') }}" id="frmMechanic">
</form>

<form action="{{ route('specialties.mechanicStore') }}" id="frmPrueba">
    </form>

<script>
    var codigs = [];
    var confir = false;
    var idE = 0;
    $(document).ready(function(){

        $('#sltEspecialty').change(function(){
            var cuenta = 0;
            let loader = new Loader();
            loader.in();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: $('#frmMechanic').attr('action'),
                type: 'POST',
                data: {idE: $('#sltEspecialty').val()},
                success: function(r){
                    let data = [];
                    if(r.length > 0){
                        $("#tblMechanicSpecialty tbody").html("");
                        r.forEach(function(el){
                            data.push({
                                dui: el.dui, 
                                nombre: el.name, 
                                apellido: el.lastname,
                                accion: `<p>
                                    <label>
                                      <input data="${el.id}" class="chk" type="checkbox" />
                                      <span>Agregar</span>
                                    </label>
                                    </p>`
                            });
                        });
                        $("#tblMechanicSpecialty").DataTable({
                            destroy: true,
                            data,
                            columns: [
                                { data: 'dui' },
                                { data: 'nombre' },
                                { data: 'apellido' },
                                { data: 'accion' }
                            ]
                        });
                        loader.out();
                    }else if(r === "0"){
                        M.toast({html: "Ha ocurrido un error" });
                        setInterval('location.reload()',1000);
                    }else{
                        M.toast({html: "Ha ocurrido un error" });
                        setInterval('location.reload()',1000);
                    }
                }
            });
            idE = $('#sltEspecialty').val();
        });

        $(document).on('change','.chk',function(){
            var arrayId = [];
            $('.chk:checked').each(
                function() {
                    var id = $(this).attr('data');
                    arrayId.push(id);
                }
            );
            codigs = arrayId;
            if(codigs.length > 0){
                var ele = document.getElementById('btnAgregar');
                ele.removeAttribute("disabled");
            }else if(codigs.length == 0){
                var ele = document.getElementById('btnAgregar');
                ele.setAttribute("disabled","true");
            }
            console.log(codigs);
        });

        $('#btnAgregar').click(function(){
            let loader = new Loader();
    	    loader.in();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: $("#frmPrueba").attr('action'),
                type: 'POST',
                data: {id: codigs,
                       idE: idE},
                success: function(r){
                    loader.out();
                    if(r === "1"){
                        M.toast({html: "Especialidad al mecánico agregada con éxito" });
                        setInterval('location.reload()',1000);
                    }else if(r === "0"){
                        M.toast({html: "Algunos mecanicos no se pudieron agregar" });
                    }else{
                        console.log(r);
                    }
                }
            });
        });
    });
</script>
@endsection