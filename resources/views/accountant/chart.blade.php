<<<<<<< HEAD
@extends('layouts.admin')

@section('page-title')
    Graficos
@endsection

@section('contenido')
    <script src="/js/Chart.min.js"></script>

    <div class="col s12 m7">
        <h2 class="header">Usuarios registrados:</h2>
        <div class="card horizontal">
            <div class="card-image" id="cont_client">
                    
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <div class="input-field col s12">
                        <select>
                            <option value="" disabled selected>Seleccione algun año:</option>
                        </select>
                        <label>Año actual {{ date('Y') }}</label>
                    </div>

                    <div class="input-field col s12">
                        <button class="btn btn-primary teal darken-3">Buscar</button>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#"><i class="material-icons">autorenew</i></a>
                    <a href="#"><i class="material-icons">picture_as_pdf</i></a>
                </div>
            </div>
        </div>
    </div>

    {{-- 
    
    <div class="col s12 m7">
        <h2 class="header">Ingresos mensuales</h2>
        <div class="card horizontal">
            <div class="card-image">
                    {!! $chr_dinero_mensual->container() !!}
                    {!! $chr_dinero_mensual->script() !!}
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <div class="input-field col s12">
                        <select>
                            <option value="" disabled selected>Seleccione algun año:</option>
                        </select>
                        <label>Año actual {{ date('Y') }}</label>
                    </div>

                    <div class="input-field col s12">
                        <button class="btn btn-primary">Buscar</button>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#"><i class="material-icons">autorenew</i></a>
                    <a href="#"><i class="material-icons">picture_as_pdf</i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12 m7">
        <h2 class="header">Automoviles registrados para reparaciones</h2>
        <div class="card horizontal">
            <div class="card-image">
                    {!! $chr_clientes->container() !!}
                    {!! $chr_clientes->script() !!}
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <div class="input-field col s12">
                        <select>
                            <option value="" disabled selected>Seleccione algun año:</option>
                        </select>
                        <label>Año actual {{ date('Y') }}</label>
                    </div>

                    <div class="input-field col s12">
                        <button class="btn btn-primary">Buscar</button>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#"><i class="material-icons">autorenew</i></a>
                    <a href="#"><i class="material-icons">picture_as_pdf</i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <h2 class="header">Los mecanicos mas activos</h2>
        <div class="card">
            <div class="card-content">
                {!! $chr_mecanicos->container() !!}
                {!! $chr_mecanicos->script() !!}
            </div>
            <div class="card-action">
                <a href="#"><i class="material-icons">autorenew</i></a>
                <a href="#"><i class="material-icons">picture_as_pdf</i></a>
            </div>
        </div>
    </div>

    <div class="col s12">
        <h2 class="header">Los clientes mas activos</h2>
        <div class="card">
            <div class="card-content">
                    {!! $chr_clientes_historial->container() !!}
                    {!! $chr_clientes_historial->script() !!}
            </div>
            <div class="card-action">
                <a href="#"><i class="material-icons">autorenew</i></a>
                <a href="#"><i class="material-icons">picture_as_pdf</i></a>
            </div>
        </div>
    </div>

    <div class="col s12">
        <h2 class="header">Cantidad de reparaciones por categorias</h2>
        <div class="card">
            <div class="card-content">
                    {!! $chr_categorias->container() !!}
                    {!! $chr_categorias->script() !!}
            </div>
            <div class="card-action">
                <a href="#"><i class="material-icons">autorenew</i></a>
                <a href="#"><i class="material-icons">picture_as_pdf</i></a>
            </div>
        </div>
    </div>
    --}}
=======
@extends('layouts.admin')

@section('page-title')
    Graficos
@endsection

@section('contenido')
    <script src="/js/Chart.min.js"></script>

    <div class="col s12 m7">
        <h2 class="header">Usuarios registrados:</h2>
        <div class="card horizontal">
            <div class="card-image" id="cont_client">
                    
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <div class="input-field col s12">
                        <select>
                            <option value="" disabled selected>Seleccione algun año:</option>
                        </select>
                        <label>Año actual {{ date('Y') }}</label>
                    </div>

                    <div class="input-field col s12">
                        <button class="btn btn-primary teal darken-3">Buscar</button>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#"><i class="material-icons">autorenew</i></a>
                    <a href="#"><i class="material-icons">picture_as_pdf</i></a>
                </div>
            </div>
        </div>
    </div>

    {{-- 
    
    <div class="col s12 m7">
        <h2 class="header">Ingresos mensuales</h2>
        <div class="card horizontal">
            <div class="card-image">
                    {!! $chr_dinero_mensual->container() !!}
                    {!! $chr_dinero_mensual->script() !!}
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <div class="input-field col s12">
                        <select>
                            <option value="" disabled selected>Seleccione algun año:</option>
                        </select>
                        <label>Año actual {{ date('Y') }}</label>
                    </div>

                    <div class="input-field col s12">
                        <button class="btn btn-primary">Buscar</button>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#"><i class="material-icons">autorenew</i></a>
                    <a href="#"><i class="material-icons">picture_as_pdf</i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12 m7">
        <h2 class="header">Automoviles registrados para reparaciones</h2>
        <div class="card horizontal">
            <div class="card-image">
                    {!! $chr_clientes->container() !!}
                    {!! $chr_clientes->script() !!}
            </div>
            <div class="card-stacked">
                <div class="card-content">
                    <div class="input-field col s12">
                        <select>
                            <option value="" disabled selected>Seleccione algun año:</option>
                        </select>
                        <label>Año actual {{ date('Y') }}</label>
                    </div>

                    <div class="input-field col s12">
                        <button class="btn btn-primary">Buscar</button>
                    </div>
                </div>
                <div class="card-action">
                    <a href="#"><i class="material-icons">autorenew</i></a>
                    <a href="#"><i class="material-icons">picture_as_pdf</i></a>
                </div>
            </div>
        </div>
    </div>

    <div class="col s12">
        <h2 class="header">Los mecanicos mas activos</h2>
        <div class="card">
            <div class="card-content">
                {!! $chr_mecanicos->container() !!}
                {!! $chr_mecanicos->script() !!}
            </div>
            <div class="card-action">
                <a href="#"><i class="material-icons">autorenew</i></a>
                <a href="#"><i class="material-icons">picture_as_pdf</i></a>
            </div>
        </div>
    </div>

    <div class="col s12">
        <h2 class="header">Los clientes mas activos</h2>
        <div class="card">
            <div class="card-content">
                    {!! $chr_clientes_historial->container() !!}
                    {!! $chr_clientes_historial->script() !!}
            </div>
            <div class="card-action">
                <a href="#"><i class="material-icons">autorenew</i></a>
                <a href="#"><i class="material-icons">picture_as_pdf</i></a>
            </div>
        </div>
    </div>

    <div class="col s12">
        <h2 class="header">Cantidad de reparaciones por categorias</h2>
        <div class="card">
            <div class="card-content">
                    {!! $chr_categorias->container() !!}
                    {!! $chr_categorias->script() !!}
            </div>
            <div class="card-action">
                <a href="#"><i class="material-icons">autorenew</i></a>
                <a href="#"><i class="material-icons">picture_as_pdf</i></a>
            </div>
        </div>
    </div>
    --}}
>>>>>>> 3e8cc14fbebf9bcb4bba222a09d2a3adc37e9cc1
@endsection