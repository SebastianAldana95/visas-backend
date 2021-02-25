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
            <p style="text-align: center"><strong>REPORTE VENTAS</strong></p>
        </header>
        <table class="table table-striped text-center" style="padding-left: 4px">
            <thead>
            <tr>
                <th scope="col">Id.</th>
                <th scope="col">Fecha</th>
                <th scope="col">Nombre</th>
                <th scope="col">Identificacion</th>
                <th scope="col">Correo</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Servicio</th>
                <th scope="col">Zona</th>

            </tr>
            </thead>
            <tbody>
            @foreach($sales as $sale)
                    <tr>
                        <td scope="row">{{ $sale->id }}</td>
                        <td>{{ $sale->date }}</td>
                        <td>{{ $sale->name }}</td>
                        <td>{{ $sale->identification }}</td>
                        <td>{{ $sale->email }}</td>
                        <td>{{ $sale->amount }}</td>
                        <td>{{ $sale->service }}</td>
                        <td>{{ $sale->zone }}</td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
