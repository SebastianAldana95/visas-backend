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

    <title>COMPROBANTE DE PAGO V- 0289_2021</title>
</head>
<body>
    <div>
            <div class="flex flex-row">
                <div>
                    <img src="https://visascontinental.com/wp-content/uploads/2020/08/LOGOS-VISAS-CONTINENTAL-02-e1597271914384.png" style="height: 80px; width: 250px;"/>
                </p>  
                </div>
                <div >
                    
                </div>
                              
                <div >
                    <p>www.visascontinental.com
                    <br>Telefono: 302 2155592 
                    <br>Cra 11B # 99 - 25 Bogotá, Colombia
                    <br>Email: asesorias@visascontinental.com</p>
                </div>

            </div>

        <h4 style="text-align: center; color: darkblue; font-weight: bold;">Comprobante de pago</h4>

        <table class="table-auto w-full" style="margin: 30px;">
        @foreach($sales as $sale)
            <thead>
            <tr>
                <th class="px-4 py-2">Cliente:</th>
                <th class="px-4 py-2"></th>
                <th class="px-4 py-2"></th>
                <th class="px-4 py-2"></th>
                <th class="px-4 py-2">{{ $sale->name }}</th>
            </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>C.C </td>
                        <td></td>
                        <td></td><td></td>
                        <td>{{ $sale->identification }}</td>
                        
                    </tr>
                    <tr>
                        <td>Correo: </td>
                        <td></td>
                        <td></td><td></td>
                        <td>{{ $sale->email }}</td>
                    </tr>
                    <tr>
                        <td>Vendedor: </td>
                        <td></td>
                        <td></td><td></td>
                        <td>{{ $sale->amount }}</td>
                    </tr>
                    <tr>
                        <td>Servicio:</td>
                        <td></td>
                        <td></td><td></td>
                        <td>{{ $sale->service }}</td>
                    </tr>
                    <tr>
                        <td>Zona:</td>
                        <td></td>
                        <td></td><td></td>
                        <td>{{ $sale->zone }}</td>
                    </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</body>
</html>