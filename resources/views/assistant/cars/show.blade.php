@extends('layouts.assistant')

@section('page-title')
    Detalle Vehículo
@endsection

@section('contenido')
    <div class="row">
        <h4 class="center-align">Representantes</h4>
        <table class="striped centered">
            <thead>
                <th>DUI</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>ROL</th>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $car->owner->dui  }}</td>
                    <td>{{ $car->owner->name }} {{ $car->owner->lastname }}</td>
                    <td>{{ $car->owner->email }}</td>
                    <td>{{ $car->owner->phone }}</td>
                    <td>Dueño</td>
                </tr>
                @foreach($car->clients as $client)
                    <tr>
                        <td>{{ $client->dui  }}</td>
                        <td>{{ $client->name }} {{ $client->lastname }}</td>
                        <td>{{ $client->email }}</td>
                        <td>{{ $client->phone }}</td>
                        <td>Representante</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @if(count($car->images) > 0)
            <h4 class="center-align">Imágenes</h4>
            <div class="carousel">
                @foreach($car->images as $image)
                    <a href="javascript:void(0)" class="carousel-item"> <img src="{{ Storage::disk('local')->url($image->name) }}"></a>
                @endforeach
            </div>
        @endif
    </div>
    <script>
        $(document).ready(function(){
            $('.carousel').carousel();
        });
    </script>
@endsection