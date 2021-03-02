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
                        <td>Vendedor: </td>
                        <td>{{ $sale->amount }}</td>
                    </tr>
                    <tr>
                        <td>Servicio:</td>
                        <td>{{ $sale->service }}</td>
                    </tr>
                    <tr>
                        <td>Zona:</td>
                        <td>{{ $sale->zone }}</td>
                    </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</body>
</html>