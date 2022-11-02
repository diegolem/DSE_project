<<<<<<< HEAD
@extends('layouts.admin')

@section('page-title')
    Graficos
@endsection

@section('contenido')
    <script src="/js/Chart.min.js"></script>

    <div class="input-field col s12">
        <select id="select_year">
            <option value="-1" disabled {{ ($now == date('Y'))? 'selected' : '' }} >Seleccione algun año:</option>
            @foreach ($fechas as $fecha)
                @if ($now != date('Y') && $fecha == $now)
                    <option value="{{ $fecha->fecha }}" selected>Año {{ $fecha->fecha }}</option>
                @else
                    <option value="{{ $fecha->fecha }}">Año {{ $fecha->fecha }}</option>
                @endif
            @endforeach
        </select>
        <label>Año actual {{ date('Y') }}</label>
    </div>

    <div class="input-field col s12">
        <button class="btn btn-primary teal darken-3" id="btn_buscar">Buscar</button>
    </div>

    <div class="col s12">
        <h2 class="header">Usuarios registrados:</h2>
        <div class="card">
            <div class="card-content" id="cont_pdf">
                    {!! $chr_usuarios_actual->container() !!}
                    {!! $chr_usuarios_actual->script() !!}
            </div>
           
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rasterizehtml/1.2.4/rasterizeHTML.allinone.js"></script>
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

        $('#btn_buscar').on('click', function () {
            var year = $('#select_year').val();

            if (year != null) {
                location.replace("{{ route('accountant.chart_newclient') }}/"+year);
            } else {
                location.replace("{{ route('accountant.chart_newclient') }}");
            }

            return false;
        });
    </script>

=======
@extends('layouts.admin')

@section('page-title')
    Graficos
@endsection

@section('contenido')
    <script src="/js/Chart.min.js"></script>

    <div class="input-field col s12">
        <select id="select_year">
            <option value="-1" disabled {{ ($now == date('Y'))? 'selected' : '' }} >Seleccione algun año:</option>
            @foreach ($fechas as $fecha)
                @if ($now != date('Y') && $fecha == $now)
                    <option value="{{ $fecha->fecha }}" selected>Año {{ $fecha->fecha }}</option>
                @else
                    <option value="{{ $fecha->fecha }}">Año {{ $fecha->fecha }}</option>
                @endif
            @endforeach
        </select>
        <label>Año actual {{ date('Y') }}</label>
    </div>

    <div class="input-field col s12">
        <button class="btn btn-primary teal darken-3" id="btn_buscar">Buscar</button>
    </div>

    <div class="col s12">
        <h2 class="header">Usuarios registrados:</h2>
        <div class="card">
            <div class="card-content" id="cont_pdf">
                    {!! $chr_usuarios_actual->container() !!}
                    {!! $chr_usuarios_actual->script() !!}
            </div>
           
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.2.61/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rasterizehtml/1.2.4/rasterizeHTML.allinone.js"></script>
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

        $('#btn_buscar').on('click', function () {
            var year = $('#select_year').val();

            if (year != null) {
                location.replace("{{ route('accountant.chart_newclient') }}/"+year);
            } else {
                location.replace("{{ route('accountant.chart_newclient') }}");
            }

            return false;
        });
    </script>

>>>>>>> 3e8cc14fbebf9bcb4bba222a09d2a3adc37e9cc1
@endsection