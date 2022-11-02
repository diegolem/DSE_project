@extends('layouts.admin')

@section('page-title')
    Graficos
@endsection

@section('contenido')
    <script src="/js/Chart.min.js"></script>

    <div class="col s12">
        <h2 class="header">Reparaciones por categorias:</h2>
        <div class="card">
            <div class="card-content" id="cont_pdf">
                    {!! $chr_categorias->container() !!}
                    {!! $chr_categorias->script() !!}
            </div>
            
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>
    <script>
        $('canvas').css( "max-height", "400px" );

        $('#pdf').on('click', function(evt){
            evt.preventDefault();
            
            var pdf = new jsPDF('l', 'mm', [197, 98]);
            pdf.addHTML($('#cont_pdf').get(0),function() {
                pdf.save('registros_automoviles.pdf');
            });
            return false;
        });
    </script>

@endsection