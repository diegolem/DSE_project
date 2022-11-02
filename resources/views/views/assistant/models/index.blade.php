@extends('layouts.assistant')
@section('page-title','Lista de Modelos')

@section('contenido')
<div class="row">
        @include('assistant.models.fragment.alert')
        <div class="row">&nbsp;</div>
        @if(count($models) == 0)
        <div class="card-panel red darken-3 center-align">
            <span class="white-text">
                No hay modelos registrados!
            </span>
        </div>
        @elseif(count($models) > 0)
        <table class="centered tbl" id="tblModels">
                <thead id="headModels">
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modificar</th>
                    <th>Ver</th>
                    <th>Eliminar</th>
                </thead>
                <tbody>
                    @foreach($models as $model)
                    <tr data="{{ $model->id  }}">
                       <td>{{ $model->name  }}</td>
                       <td>{{ $model->brand->name  }}</td>
                    <td>
                    <a title="Modificar" class="waves-effect waves-teal btn-flat blue-text darken-2" href="{{ route('models.edit',$model->id) }}"><i class="material-icons">mode_edit</i></a>
                    </td>
                    <td>
                        <a title="Ver" href="{{ route('models.show',$model->id) }}" class="waves-effect waves-teal btn-flat teal-text darken-2"><i class="material-icons">remove_red_eye</i></a>
                    </td>
                    <td>
                        @if(count($model->cars) == 0)
                        <a href="#modal1" title="Eliminar" class="waves-effect waves-light btn red darken-4 modal-trigger btnBorrar"><i class="material-icons">delete</i></a>
                        @elseif(count($model->cars) > 0)
                        <a href="#modal1" disabled="true"  title="Eliminar" class="waves-effect waves-light btn red darken-4 modal-trigger btnBorrar"><i class="material-icons">delete</i></a>
                        @endif
                </td>
            </tr>
            @endforeach
                </tbody>
            </table>
        @endif
        <div id="modal1" class="modal">
                <div class="modal-content">
                  <h4>Eliminar Modelo</h4>
                  <p>Estas seguro que deseas eliminar este modelo?</p>
                </div>
                <div class="modal-footer">
                    <a href="#!" id="confirmB" class="modal-action modal-close waves-effect waves-red btn-flat">
                        Eliminar
                    </a>
                </div>
        </div>
    </div>
    <a href="{{ route('models.create') }}" class="btn cyan darken-4" style="margin: 3% 0">Registrar nuevo modelo<i class="material-icons right">add</i></a>
    {!! Form::open(['route' => ['models.destroy', ':IdModel'], 'method' => 'DELETE', 'id' => 'frmBorrar']) !!} <!-- Formulario para eliminar -->
    {!! Form::close() !!} <!-- Fin Formulario para eliminar -->
    <script>
            var ids = 0;
            var ur = "";
            var datos = "";
            $(document).ready(function (){
                $('.modal').modal();
                var th = document.getElementById('headModels');
                //th.setAttribute('class','blue-grey darken-4 white-text');
                $('.btnBorrar').click(function(){
                    var id = $(this).parent().parent('tr').attr('data');
                    var url = $('#frmBorrar').attr('action').replace(':IdModel',id);
                    var data = $('#frmBorrar').serialize();
                    ids = id;
                    ur = url;
                    datos = data;
                });
                $('#confirmB').click(function(){
                    let loader = new Loader();
    	            loader.in();
                    $.post(ur,datos, function(r){
                        loader.out();
                        if(r === "1"){
                            M.toast({html: "Modelo eliminado correctamente" });
                            setInterval('location.reload()',1000);
                        }else if(r === "0"){
                            M.toast({html: "El modelo no se puede eliminar" });
                        }
                    });
                });
            });
    </script>
@endsection