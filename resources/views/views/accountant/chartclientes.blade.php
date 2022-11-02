@extends('layouts.admin')

@section('page-title')
    Graficos
@endsection

@section('contenido')
    <script src="/js/Chart.min.js"></script>

    <div class="col s12">
        <h2 class="header">Clientes frecuentes:</h2>
        <div class="card">
            <div class="card-content" id="cont_pdf">
                    {!! $chr_clientes_historial->container() !!}
                    {!! $chr_clientes_historial->script() !!}
            </div>
            
        </div>
    </div>

    <script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
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