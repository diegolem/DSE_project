@extends('layouts.assistant')
@section('contenido')

@section('page-title')
    Marcas
@endsection
<div class="row">
    @if(count($brands) == 0)
        <div class="card-panel red darken-3 center-align">
                    <span class="white-text">
                        No hay marcas registradas!
                    </span>
        </div>
    @elseif(count($brands) > 0)
        <table class="centered tbl" id="tblBrands">
            <thead>
            <th>Nombre de la marca</th>
            <th>País</th>
            <th>Acciones</th>
            </thead>
            <tbody>
            @foreach ($brands as $brand)
                <tr data="{{ $brand->id }}">
                    <td>{{$brand->name}}</td>
                    <td>{{$brand->Cname}}</td>
                    <td colspan="2" style="display: flex; justify-content: space-around;">
                        {{link_to_route('brands.edit', 'Modificar', ['id'=>$brand->id], ['class'=>'btn-small waves-effect waves-light orange'])}}
                        @if(count($brand->models) == 0)
                        <a href="#modal1" title="Eliminar" class="waves-effect waves-light btn red darken-4 modal-trigger btnBorrar"><i class="material-icons">delete</i></a>
                        @elseif(count($brand->models) > 0)
                        <a href="#modal1" disabled="true"  title="Eliminar" class="waves-effect waves-light btn red darken-4 modal-trigger btnBorrar"><i class="material-icons">delete</i></a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="{{ route('brands.create') }}" class="btn cyan darken-4" style="margin: 3% 0">Registrar nueva marca <i class="material-icons right">add</i></a>
        <div class="row">
            @if(Session::has('messageS'))
                <script>
                    M.toast({html: 'La marca se modifico correctamente' })
                </script>
            @endif
            @if(Session::has('messageR'))
                <script>
                    M.toast({html: 'La marca se registro correctamente' })
                </script>
            @endif
            @if(Session::has('Emessage'))
                <p class="center-align red-text darken-4">{{ Session::get('Emessage') }}</p>
            @endif
        </div>
    @endif
</div>



<div id="modal1" class="modal">
    <div class="modal-content">
      <h4>Eliminar Marca</h4>
      <p>Estas seguro que deseas eliminar esta marca?</p>
    </div>
    <div class="modal-footer">
        <a href="#!" id="confirmB" class="modal-action modal-close waves-effect waves-red btn-flat">
            Eliminar
        </a>
    </div>
</div>
{!! Form::open(['route' => ['brands.destroy', ':idBrand'], 'method' => 'DELETE', 'id' => 'frmBorrar']) !!} <!-- Formulario para eliminar -->
{!! Form::close() !!}

<script>
            var ids = 0;
            var ur = "";
            var datos = "";
            $(document).ready(function (){
                $('.modal').modal();

                $('.btnBorrar').click(function(){
                    var id = $(this).parent().parent('tr').attr('data');
                    var url = $('#frmBorrar').attr('action').replace(':idBrand',id);
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
                            M.toast({html: "Marca eliminada correctamente" });
                            setInterval('location.reload()',1000);
                        }else if(r === "0"){
                            M.toast({html: "La marca no se puede eliminar" });
                        }
                    });
                });
            });
</script>



@endsection