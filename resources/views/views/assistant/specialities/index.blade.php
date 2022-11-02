@extends('layouts.assistant')
@section('page-title','Lista de Especialidades')

@section('contenido')
<div class="row">
        @include('assistant.specialities.fragment.alert')
        <div class="row">&nbsp;</div>
        @if(count($especialty) == 0)
        <div class="card-panel red darken-3 center-align">
            <span class="white-text">
                No hay Especialidades registradas!
            </span>
        </div>
        @elseif(count($especialty) > 0)
        <table class="centered tbl" id="tblSpecialty">
                <thead id="headSpecialty">
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Modificar</th>
                    <th>Ver</th>
                    <th>Eliminar</th>
                </thead>
                <tbody>
                    @foreach($especialty as $especiality)
                    <tr data="{{ $especiality->id  }}">
                      <td>{{ $especiality->name  }}</td>
                      <td>{{ $especiality->description  }}</td>
                    <td>
                    <a title="Modificar" class="waves-effect waves-teal btn-flat blue-text darken-2" href="{{ route('specialties.edit', $especiality->id) }}"><i class="material-icons">mode_edit</i></a>
                    </td>
                    <td>
                    <a title="Ver" href="{{ route('specialties.show',$especiality->id) }}" class="waves-effect waves-teal btn-flat teal-text darken-2"><i class="material-icons">remove_red_eye</i></a>
                    </td>
                    <td>
                    @if(count($especiality->mechanics) == 0)
                    <a href="#modal1" title="Eliminar" class="waves-effect waves-light btn red darken-4 modal-trigger btnBorrar"><i class="material-icons">delete</i></a>
                    @elseif(count($especiality->mechanics) > 0)
                    <a href="javascript:void(0)" disabled="true"  title="Eliminar" class="waves-effect waves-light btn red darken-4 modal-trigger btnBorrar"><i class="material-icons">delete</i></a>
                    @endif
                </td>
            </tr>
            @endforeach
                </tbody>
            </table>
        @endif       
        <div id="modal1" class="modal">
                <div class="modal-content">
                  <h4>Eliminar Especialidad</h4>
                  <p>Estas seguro que deseas eliminar esta especialidad?</p>
                </div>
                <div class="modal-footer">
                    <a href="#!" id="confirmB" class="modal-action modal-close waves-effect waves-red btn-flat">
                        Eliminar
                    </a>
                </div>
        </div>
    </div>
    <a href="{{ route('specialties.create') }}" class="btn cyan darken-4" style="margin: 3% 0">Registrar nueva especialidad <i class="material-icons right">add</i></a>
    {!! Form::open(['route' => ['specialties.destroy', ':IdSpeciality'], 'method' => 'DELETE', 'id' => 'frmBorrar']) !!} <!-- Formulario para eliminar -->
    {!! Form::close() !!} <!-- Fin Formulario para eliminar -->

    <script>
            var ids = 0;
            var ur = "";
            var datos = "";
            $(document).ready(function (){
                $('.modal').modal();

                var th = document.getElementById('headSpecialty');
                //th.setAttribute('class','blue-grey darken-4 white-text');

                $('.btnBorrar').click(function(){
                    var id = $(this).parent().parent('tr').attr('data');
                    var url = $('#frmBorrar').attr('action').replace(':IdSpeciality',id);
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
                            M.toast({html: "La especialidad se elimino correctamente" });
                            setInterval('location.reload()',1000);
                        }else{
                            M.toast({html: "La especialidad no se puede eliminar" });
                        }
                    });
                });
            });
    </script>
@endsection