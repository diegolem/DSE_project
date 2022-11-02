@extends(auth()->user()->isAdmin()? 'layouts.admin' : 'layouts.assistant')

@section('page-title')
    Usuarios
@endsection

@section('filtro')
    <div class="row">
        <form class="col s12" id="target">
            
            <div class="row">
                <div class="input-field col s12 m6">
                    <i class="material-icons prefix">account_circle</i>
                    <input name="nombre" type="text" class="validate" id="txt_nombre_completo" >
                    <label for="txt_nombre_completo">Nombre completo</label>
                </div>
                <div class="input-field col s12 m6">
                    <select name="tipo" id="sel_tipo_usuario">
                        <option selected value="-1">Tipo de usuario</option>
                        @foreach ($user_type as $tipo)
                            <option value="{{ $tipo->id }}"> {{ $tipo->name }} </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="button" id="btn_filtrar" class="waves-effect waves-light btn teal darken-3">Filtrar</button>
                    <button type="reset" id="btn_reset" class="waves-effect waves-light btn red darken-4">Resetar</button>
                </div>
            </div>
        </form>
    </div>
    {{-- Uso del post --}}
    <script>
        // Filtrar los datos
        $(document).ready(function(){

            $("#btn_filtrar").click(function(event ){
                event.preventDefault();
                $( "#cont" ).load( "<?php echo url(strtolower(auth()->user()->userType->id).'/users'); ?>", $('#target').serialize(), function( response, status, xhr ) {
                    if ( status == "error" ) {
                        var toastHTML = "<span>" + xhr.status + " " + xhr.statusText +"</span><button class='btn-flat toast-action'><i class='material-icons'>cancel</i></button>";
                        M.toast({ html: toastHTML });
                    }
                });
            });

            $("#btn_reset").click(function(event ){
                $( "#cont" ).load( "<?php echo url(strtolower(auth()->user()->userType->id).'/users'); ?>", function( response, status, xhr ) {
                    if ( status == "error" ) {
                        var toastHTML = "<span>" + xhr.status + " " + xhr.statusText +"</span><button class='btn-flat toast-action'><i class='material-icons'>cancel</i></button>";
                        M.toast({ html: toastHTML });
                    }
                });
            });

        });
    </script>
@endsection

@section('contenido')

    @if (count($users) <= 0)
        <div class="red white-text z-depth-4 center-align" style="margin-top: 2rem; padding: 2rem;"><i class="material-icons" style="margin-right: 1rem;">error</i>No posee datos</div>
    @endif

    @if (count($users) > 0)
        <table id="tbl_user" class="responsive-table centered tbl">
            <thead class="">
                <th>DUI</th>
                <th>Nombre</th>
                <th>Tipo Usuario</th>
                <th>Acciones</th>
            </thead>
            <tbody class="">
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->dui }}</td>
                    <td>{{ $user->name . ' ' . $user->lastname }}</td>
                    <td>{{ $user->userType->name }}</td>
                    <td>
                        @if (auth()->user()->isAssistant())
                            @if (!$user->isAdmin())
                                <a href="{{ url(strtolower(auth()->user()->userType->id).'/users/'.$user->id.'/edit') }}" class="blue-text"><i class="material-icons" title="Actualizar">update</i></a>
                            @endif
                        @else
                            <a href="{{ url(strtolower(auth()->user()->userType->id).'/users/'.$user->id.'/edit') }}" class="blue-text"><i class="material-icons" title="Actualizar">update</i></a>
                        @endif

                        @if (auth()->user()->isAssistant())
                            @if (!$user->isAdmin())
                                @if ($user->isClient())
                                    @if (count($user->cars) == 0)
                                        <a href="{{ url(strtolower(auth()->user()->userType->id).'/users/'.$user->id) }}" class="red-text a_destroy"><i class="material-icons" title="Dar de baja">remove_circle</i></a>    
                                    @endif
                                @else
                                    @if ($user->isMechanic())
                                        @if (count($user->specialties) == 0 && count($user->repairs) == 0)
                                            <a href="{{ url(strtolower(auth()->user()->userType->id).'/users/'.$user->id) }}" class="red-text a_destroy"><i class="material-icons" title="Dar de baja">remove_circle</i></a>    
                                        @endif
                                    @else
                                        <a href="{{ url(strtolower(auth()->user()->userType->id).'/users/'.$user->id) }}" class="red-text a_destroy"><i class="material-icons" title="Dar de baja">remove_circle</i></a>
                                    @endif
                                @endif  
                            @endif
                        @else
                            @if ($user->isClient())
                                @if (count($user->cars) == 0)
                                    <a href="{{ url(strtolower(auth()->user()->userType->id).'/users/'.$user->id) }}" class="red-text a_destroy"><i class="material-icons" title="Dar de baja">remove_circle</i></a>    
                                @endif
                            @else
                                @if ($user->isMechanic())
                                    @if (count($user->specialties) == 0 && count($user->repairs) == 0)
                                        <a href="{{ url(strtolower(auth()->user()->userType->id).'/users/'.$user->id) }}" class="red-text a_destroy"><i class="material-icons" title="Dar de baja">remove_circle</i></a>    
                                    @endif
                                @else
                                    <a href="{{ url(strtolower(auth()->user()->userType->id).'/users/'.$user->id) }}" class="red-text a_destroy"><i class="material-icons" title="Dar de baja">remove_circle</i></a>
                                @endif
                            @endif
                        @endif

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    {{--
        <div class="black" style="display: flex; justify-content: center">
            {{ $users->links() }}
        </div>
    --}}
    
    <div id="mdlEliminar" class="modal">
        <div class="modal-content">
            <input type="hidden" id="txt_url"/>
            <h4 class="center-align">Eliminación de un usuario</h4>
            <p class="center-align">¿Está seguro de eliminar el usuario?</p>
        </div>
        <div class="modal-footer">
            <a href="#!" id="btnEliminar" class="waves-effect waves-red btn-flat">Eliminar</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cerrar</a>
        </div>
    </div>

    <script>
        var $fila;
        /*
        $('.pagination li a').on('click', function(e){
            e.preventDefault();
            var url = "" + $(this).attr('href');
            
            var datos = JSON.parse('<?php echo json_encode($datos); ?>');

            var ser = "nombre=" + datos.nombre + "&tipo=" + datos.tipo;

            $( "#cont" ).load( url, ser, function( response, status, xhr ) {
                if ( status == "error" ) {
                    var toastHTML = "<span>" + xhr.status + " " + xhr.statusText +"</span><button class='btn-flat toast-action'><i class='material-icons'>cancel</i></button>";
                    M.toast({ html: toastHTML });
                }
            });

        });
        */
        $('select').formSelect();
        $('.modal').modal();

        $('#btnEliminar').on("click", function(event){
            event.preventDefault();
            var url = $('#txt_url').val();

            $.ajax({
                type: 'POST',
                url: url,
                data: {_method:"DELETE", _token:"{{ csrf_token() }}"},
                success: function (data) {

                    var datos = JSON.parse('<?php echo json_encode($datos); ?>');

                    var ser = "nombre=" + datos.nombre + "&tipo=" + datos.tipo;
        
                    $fila.parent().parent('tr').fadeOut();

                     $('#mdlEliminar').modal('close');
                    M.toast({ html: "El usuario ha sido eliminado" });

                },
                error : function ( jqXhr, json, errorThrown ) 
                {
                    var errors = jqXhr.responseJSON;
                    var errorsHtml= '';
                    $.each( errors, function( key, value ) {
                        errorsHtml += '<li>' + value[0] + '</li>'; 
                    });

                    M.toast({html:  "Error: " + jqXhr.status +': '+ errorThrown });
                }
            });
        });

        $('.a_destroy').on("click",function(event){
            event.preventDefault();
            $fila = $(this);
            var url = $(this).attr('href');
            $('#txt_url').val(url);
            $('#mdlEliminar').modal('open');
        });
    </script>
@endsection

@section('script')
    <script>
        
    </script>
@endsection