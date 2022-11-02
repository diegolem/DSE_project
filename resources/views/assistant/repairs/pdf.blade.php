<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF - Reparación</title>
    <style>

        body {
	        font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Oxygen-Sans,Ubuntu,Cantarell,"Helvetica Neue",sans-serif;
        }

        .PDF_header .logo{
            width: 15%;
            float: left;
            position: relative;
        }

        .PDF_header .logo img{
            width: 100%;
            height: 100%;
        }

        .PDF_header .info .title{
            text-align: center;
            font-size: 30px;
            margin-left: -15%;
        }

        table {
            border-collapse: collapse;
            vertical-align: middle;
            width: 100%;
        }

        th, .tfoot {
            font-weight: bold; 
            vertical-align: center;
            text-align: center;
            font-size: 14px;
            padding: 5px;
            vertical-align: middle;
            background: #ff8f00;
            color: #fff;
        }

        td{
            font-size: 1em;
            text-align: center;
            vertical-align: middle;
            padding: 4px;
        }

        ul{ 
            padding: 0px;
        }

        ul li{ 
            padding-bottom: 5px; 
            padding-left: 25px;
        }
        ul li.li-title{ 
            list-style: none; 
            font-weight: bold;
            font-size: 18px;
            padding-left: 0px;
        }

        li span{ font-weight: bold; }

        h3{ text-align: center; }

        hr {
            border: 0;
            height: 0;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }

        .code-bar{ text-align: center; }

        .code-bar .code{
            width: 50%;
            margin-left: 30%;
        }
    </style>
</head>
<body>
    <div class='PDF_header'> <!-- Encabezado -->
		<div class='logo'>
		    <img src="{{ public_path('favicon.png') }}"/>
		</div>
		<div class='info'>
		    <h4 class='title'> Ignite [Factura de Reparación]</h4>
		</div>
	</div>
    <hr>
    <div><!-- Datos del vehículo -->
        <ul class=""> 
            <li class="li-title">Vehículo</li>
            <li class=""><span>Matrícula:</span> {{ $repair->car->license }}</li>
            <li class=""><span>Modelo:</span> {{ $repair->car->model->name }}</li>
            <li class=""><span>Marca:</span> {{ $repair->car->model->brand->name }}</li>
            <li class=""><span>Año:</span> {{ $repair->car->year }}</li>
        </ul>
    </div>

    <h3>Representante</h3>
    <table>
        <thead>
            <tr>
                <th>DUI</th>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $repair->car->owner->dui  }}</td>
                <td>{{ $repair->car->owner->name }} {{ $repair->car->owner->lastname }}</td>
                <td>{{ $repair->car->owner->email }}</td>
            </tr>  
        </tbody>
    </table>

    <h3>Reparación</h3>
    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Fecha Inicial</th>
                <th>Fecha Final</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $repair->code }}</td>
                <td>{{ $repair->admissionDate }}</td>
                <td>{{ ( ($repair->departureDate == '') ? 'No Asignada' :  $repair->departureDate) }}</td>
                <td>{{ ( ($repair->status == 0) ? 'En Reparación' : 'Reparado' ) }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Detalles</h3>
    <table>
        <thead>
            <tr>
                <th>Detalle</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Categoría</th>
                <th>Monto ($)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repair->details as $detail)
                <tr>
                    <td>{{ $detail->detail }}</td>
                    <td>{{ $detail->description}}</td>
                    <td>{{ $detail->date}}</td>
                    <td>{{ $detail->category->name }}</td>
                    <td>{{ $detail->amount }}</td>
                </tr>
            @endforeach
        </tbody>
        <tr>
            <td colspan="4" class="tfoot">Total</td>
            <td>{{ $repair->details()->sum('amount') }}</td>
        </tr>
    </table>
    <br>
    <br>
    <br>

    <div class="code-bar">
        <div class="code">
            {!! DNS1D::getBarcodeHTML($repair->code, "C128"); !!}
        </div>
        <div class="title">
            {{ $repair->code }}
        </div>
    </div>
</body>
</html>