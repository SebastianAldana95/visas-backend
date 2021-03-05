<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/stylepdf.css">

    <title>Ventas</title>
</head>
<body>
    <div>
        <header class="header">
        <img src="https://visascontinental.com/wp-content/uploads/2020/08/LOGOS-VISAS-CONTINENTAL-02-e1597271914384.png" style="height: 80px;"/>
            <p style="text-align: center"><strong>Comprobante de Pago</strong></p>
            <p style="text-align: right">www.visascontinental.com</p>
            <p style="text-align: right">Cra 11B # 99 - 25 Bogotá, Colombia</p>
        </header>
        <table class="table-auto" style="padding-left: 4px">
            @if(array($sales))
                @foreach($sales as $sale)
                    <thead>
                    <tr>
                        <th scope="col">Cliente</th>
                        <th scope="row">{{ $sale->name }}</th>
                    </tr>
                    </thead>
                    <tbody>

                    <tr>
                        <td>C.C </td>
                        <td>{{ $sale->identification }}</td>
                    </tr>

                    <tr>
                        <td>Correo: </td>
                        <td>{{ $sale->email }}</td>
                    </tr>

                    <tr>
                        <td>Fecha: </td>
                        <td>{{ $sale->date }}</td>
                    </tr>

                    <tr>
                        <td>Ciudad:</td>
                        <td>{{ auth()->user()->zone['name'] }}</td>
                    </tr>

                    <tr>
                        <td>Nombre del vendedor:</td>
                        <td>{{ auth()->user()->name }}</td>
                    </tr>

                    <tr>
                        <td>Codigo: </td>
                        <td>{{ $sale->id }}</td>
                    </tr>

                    <tr>
                        <td>Descripcion: </td>
                        <td>{{ $sale->pivot->description }}</td>
                    </tr>

                    <tr>
                        <td>Cantidad: </td>
                        <td>{{ $sale->quantity }}</td>
                    </tr>

                    <tr>
                        <td>Servicio:</td>
                        <td>{{ $sale->service['name']}}</td>
                    </tr>

                    <tr>
                        <td>Total:</td>
                        <td>${{ $sale->pivot->total }}.000</td>
                    </tr>

                    </tbody>
                @endforeach
            @else
                <p>Nada para mostrar</p>
            @endif
        </table>
    </div>
</body>
</html>
