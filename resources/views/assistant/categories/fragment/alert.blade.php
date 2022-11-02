@if(count($errors))
        @foreach($errors->all() as $error)
	    @if($error == "El formato del campo Descripción es inválido.")
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
@if(Session::has('registroC'))
    <script>
        M.toast({html: 'La categoria se ingreso correctamente' })
    </script>
@endif
@if(Session::has('registroCE'))
    <script>
        M.toast({html: 'Ocurrio un error al ingresar la categoria' })
    </script>
@endif
@if(Session::has('modificarC'))
    <script>
        M.toast({html: 'La categoria se modifico correctamente' })
    </script>
@endif
@if(Session::has('modificarCE'))
    <script>
        M.toast({html: 'Ocurrio un error al modificar la categoria' })
    </script>
@endif
@if(Session::has('eliminarC'))
    <script>
        M.toast({html: 'La categoria se elimino correctamente' })
    </script>
@endif
@if(Session::has('eliminarError'))
    <script>
        M.toast({html: 'La categoria no se puede eliminar' })
    </script>
@endif