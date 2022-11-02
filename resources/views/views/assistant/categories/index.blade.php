@extends('layouts.assistant')
@section('page-title','Lista de Categorías')

@section('contenido')
<div class="row">
        @include('assistant.categories.fragment.alert')
        <div class="row">&nbsp;</div>
        @if(count($categories) == 0)
        <div class="card-panel red darken-3 center-align">
            <span class="white-text">
                No hay categorías registradas!
            </span>
        </div>
        @elseif(count($categories) > 0)
        <table class="centered tbl" id="tblCategories">
                <thead id="headCategories">
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Modificar</th>
                    <th>Ver</th>
                    <th>Eliminar</th>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr data="{{ $category->id  }}">
                       <td>{{ $category->name  }}</td>
                       <td>{{ $category->description  }}</td>
                    <td>
                    <a title="Modificar" class="waves-effect waves-teal btn-flat blue-text darken-2" href="{{ route('category.edit',$category->id) }}"><i class="material-icons">mode_edit</i></a>
                    </td>
                    <td>
                        <a title="Ver" href="{{ route('category.show',$category->id) }}" class="waves-effect waves-teal btn-flat teal-text darken-2"><i class="material-icons">remove_red_eye</i></a>
                    </td>
                    <td>
                        @if(count($category->repairs) == 0)
                        <a href="#modal1" title="Eliminar" class="waves-effect waves-light btn red darken-4 modal-trigger btnBorrar"><i class="material-icons">delete</i></a>
                        @elseif(count($category->repairs) > 0)
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
                  <h4>Eliminar Categoría</h4>
                  <p>Estas seguro que deseas eliminar esta categoría?</p>
                </div>
                <div class="modal-footer">
                    <a href="#!" id="confirmB" class="modal-action modal-close waves-effect waves-red btn-flat">
                        Eliminar
                    </a>
                </div>
        </div>
    </div>
    <a href="{{ route('category.create') }}" class="btn cyan darken-4" style="margin: 3% 0">Registrar nueva categoría <i class="material-icons right">add</i></a>
    {!! Form::open(['route' => ['category.destroy', ':IdCategory'], 'method' => 'DELETE', 'id' => 'frmBorrar']) !!} <!-- Formulario para eliminar -->
    {!! Form::close() !!} <!-- Fin Formulario para eliminar -->
    <script>
            var ids = 0;
            var ur = "";
            var datos = "";
            $(document).ready(function (){
                $('.modal').modal();
                var th = document.getElementById('headCategories');
                //th.setAttribute('class','blue-grey darken-4 white-text');
                $('.btnBorrar').click(function(){
                    var id = $(this).parent().parent('tr').attr('data');
                    var url = $('#frmBorrar').attr('action').replace(':IdCategory',id);
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
                            M.toast({html: "Categoría eliminada correctamente" });
                            setInterval('location.reload()',1000);
                        }else if(r === "0"){
                            M.toast({html: "La categoría no se puede eliminar" });
                        }
                    });
                });
            });
    </script>
@endsection