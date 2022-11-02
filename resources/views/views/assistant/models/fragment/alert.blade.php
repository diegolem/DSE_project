@if(count($errors))
        @foreach($errors->all() as $error)
	    @if($error == "El formato del campo Marca es inválido.")
            <script>
                var alert = '{{ $error }}'
                M.toast({html: alert });
            </script>
        @endif
	    @if($error == "El formato del campo Nombre es inválido.")
            <script>
                var alert = '{{ $error }}'
                M.toast({html: alert });
            </script>
        @endif
        @endforeach
@endif
@if(Session::has('registroM'))
    <script>
        M.toast({html: 'Modelo ingresado correctamente' })
    </script>
@endif
@if(Session::has('registroME'))
    <script>
        M.toast({html: 'Ocurrio un error al ingresar el modelo' })
    </script>
@endif
@if(Session::has('modificarM'))
    <script>
        M.toast({html: 'Modelo modificado correctamente' })
    </script>
@endif
@if(Session::has('modificarME'))
    <script>
        M.toast({html: 'Ocurrio un error al modificar' })
    </script>
@endif