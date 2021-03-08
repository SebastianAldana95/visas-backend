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
<<<<<<< HEAD
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
=======
        <header class="header">
        <img src="https://visascontinental.com/wp-content/uploads/2020/08/LOGOS-VISAS-CONTINENTAL-02-e1597271914384.png" style="height: 80px;"/>
            <p style="text-align: center"><strong>Comprobante de Pago</strong></p>
            <p style="text-align: right">www.visascontinental.com</p>
            <p style="text-align: right">Cra 11B # 99 - 25 Bogotá, Colombia</p>
        </header>
        <table class="table-auto" style="padding-left: 4px">
            @if(array($sales))
                @foreach($sales as $sale)
                    @foreach($user as $usr)
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

<<<<<<< HEAD
>>>>>>> 9f3e16c98338a0c1af57e06e8d465df408a18082
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
=======
                            <tr>
                                <td>Correo: </td>
                                <td>{{ $sale->email }}</td>
                            </tr>

                            <tr>
                                <td>Fecha: </td>
                                <td>{{ $sale->date }}</td>
                            </tr>
>>>>>>> b00e1be2872bac7240826bbfe7ec036aec01a796

                            <tr>
                                <td>Ciudad:</td>
                                <td>{{ $usr->zone->name }}</td>
                            </tr>

                            <tr>
                                <td>Nombre del vendedor:</td>
                                <td>{{ $usr->name }}</td>
                            </tr>

<<<<<<< HEAD
                    <tr>
<<<<<<< HEAD
                        <td>Vendedor: </td>
                        <td></td>
                        <td></td><td></td>
                        <td>{{ $sale->amount }}</td>
=======
                        <td>Nombre del vendedor:</td>
                        <td>{{ auth()->user()->name }}</td>
>>>>>>> 9f3e16c98338a0c1af57e06e8d465df408a18082
                    </tr>
=======
                            <tr>
                                <td>Codigo: </td>
                                <td>{{ str_pad($sale->id, 7, 0, STR_PAD_LEFT) }}</td>
                            </tr>
>>>>>>> b00e1be2872bac7240826bbfe7ec036aec01a796

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
                                <td>{{ $sale->service->name}}</td>
                            </tr>

<<<<<<< HEAD
                    <tr>
                        <td>Servicio:</td>
<<<<<<< HEAD
                        <td></td>
                        <td></td><td></td>
                        <td>{{ $sale->service }}</td>
=======
                        <td>{{ $sale->service['name']}}</td>
>>>>>>> 9f3e16c98338a0c1af57e06e8d465df408a18082
                    </tr>

                    <tr>
<<<<<<< HEAD
                        <td>Zona:</td>
                        <td></td>
                        <td></td><td></td>
                        <td>{{ $sale->zone }}</td>
=======
                        <td>Total:</td>
                        <td>${{ $sale->pivot->total }}.000</td>
>>>>>>> 9f3e16c98338a0c1af57e06e8d465df408a18082
                    </tr>

                    </tbody>
=======
                            <tr>
                                <td>Total:</td>
                                <td>${{ number_format($sale->pivot->total, 3) }}</td>
                            </tr>
                        </tbody>
                    @endforeach
>>>>>>> b00e1be2872bac7240826bbfe7ec036aec01a796
                @endforeach
            @else
                <p>Nada para mostrar</p>
            @endif
        </table>
    </div>
</body>
</html>
