@extends('layouts.assistant')
@section('page-title','Especialidad')
@section('contenido')
<div class="row">
        <div class="row">
            <div class="col s2"></div>
                <div class="col s8">
                  <div class="card grey lighten-4">
                    <div class="card-content black-text">
                      <span class="card-title center"><strong>Datos</strong></span>
                      <p>
                            <strong>Nombre de la especialidad:</strong>
                            <div class="col sm6">
                                - {{$especialty->name}}
                            </div>
                      </p>
                      <div class="row">&nbsp;</div>
                      <p>
                            <strong>Descripción:</strong>
                            <div class="col sm6">
                                - {{$especialty->description}}
                            </div>
                      </p><div class="row">&nbsp;</div>
                    </div>
                    <div class="card-action">
                            <a title="Modificar" class="waves-effect waves-teal btn-flat" href="{{ route('specialties.edit', $especialty->id) }}"><i class="material-icons">mode_edit</i></a>
                    </div>
                  </div>
                </div>
        </div>           
<div class="row">
    <div class="col s5"></div>
            <div class="col s6">
                <a class="waves-effect waves-light btn" href="{{ route('specialties.index') }}">Regresar</a>
            </div>
</div>

<div class="row">
        <div class="col s12">
                @if(count($especialty->mechanics) == 0)
                <div class="card-panel red darken-3 center-align">
                    <span class="white-text">
                        No hay ningún mecánico con esta especialidad
                    </span>
                </div>
            @elseif(count($especialty->mechanics) > 0)
            <div class="col s4">&nbsp;</div>
            <div class="col s4"><h6><strong>Mecánicos con esta especialidad</strong></h6></div>
            <table class="striped centered" id="tblMechanicSpecialty">
                <thead id="headMechanicSpecialty">
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Acción</th>
                </thead>
                <tbody>
                @foreach($especialty->mechanics as $mechanic)
                    <tr>
                        <td>{{ $mechanic->dui}}</td>
                       <td>{{ $mechanic->name  }}</td>
                       <td>{{ $mechanic->lastname  }}</td>
                       <td>
                           <p>
                            <label>
                              <input data="{{$mechanic->id}}" class="chk" type="checkbox" />
                              <span>Eliminar</span>
                            </label>
                            </p>
                        </td>
                    </tr>
            @endforeach
                </tbody>
            </table>
            <div class="row">&nbsp;</div>
            <div class="col s4"></div>
            <div class="col s6">
                <button disabled="true" class="waves-effect waves-light btn red darken-4" id="btnEliminar"><i class="material-icons left">delete</i>Borrar Seleccionados</button>
            </div>
            @endif
        </div>
    </div>
    <form action="{{ route('specialties.mechanicDestroy') }}" id="frmPrueba">
    </form>

    {!! Form::hidden('idE',$especialty->id , ['id'=>'idEspecialty']) !!}
</div>
<script>
    var codigs = [];
    var confir = false;
    $(document).ready(function(){

        var th = document.getElementById('headMechanicSpecialty');
        th.setAttribute('class','blue-grey darken-4 white-text');
        $('#tblMechanicSpecialty').DataTable({
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            }
        });
        $('.chk').change(function(){
            var arrayId = [];
            $('.chk:checked').each(
                function() {
                    var id = $(this).attr('data');
                    arrayId.push(id);
                }
            );
            codigs = arrayId;
            if(codigs.length > 0){
                var ele = document.getElementById('btnEliminar');
                ele.removeAttribute("disabled");
            }else if(codigs.length == 0){
                var ele = document.getElementById('btnEliminar');
                ele.setAttribute("disabled","true");
            }
        });
        
        $('#btnEliminar').click(function(){
            let loader = new Loader();
    	    loader.in();
            var id = codigs[0];
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: $("#frmPrueba").attr('action'),
                type: 'POST',
                data: {id: codigs,
                       idE: $("#idEspecialty").attr('value')},
                success: function(r){
                    loader.out();
                    if(r === "1"){
                        M.toast({html: "Especialidad del mecánico removida con éxito " });
                        setInterval('location.reload()',1000);
                    }else if(r === "0"){
                        M.toast({html: "No se pudo eliminar el mecánico" });
                    }
                }
            });
        });

    });
</script>
@endsection