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
@if(Session::has('registroE'))
    <script>
        M.toast({html: 'La especialidad se ingreso correctamente' })
    </script>
@endif
@if(Session::has('modificarE'))
    <script>
        M.toast({html: 'La especialidad se modifico correctamente' })
    </script>
@endif
@if(Session::has('eliminarE'))
    <script>
        M.toast({html: 'La especialidad se elimino correctamente' })
    </script>
@endif
@if(Session::has('eliminarError'))
    <script>
        M.toast({html: 'La especialidad no se puede eliminar' })
    </script>
@endif