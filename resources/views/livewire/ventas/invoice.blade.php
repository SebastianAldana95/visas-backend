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
        <header>
        <span style="display: inline-flex;">
            <img src="https://visascontinental.com/wp-content/uploads/2020/08/LOGOS-VISAS-CONTINENTAL-02-e1597271914384.png" style="height: 80px;"/>
            <p style="text-align: right; font-size: 14px;">www.visascontinental.com <br>Telefono: 302 2155592
            <br>Email: asesorias@visascontinental.com
            <br> Cra 11B # 99 - 25 Bogotá, Colombia
            <br>
            </p>
        </span>
        
        </header>

        <table width="100%" style="font-size: 14px;">
        <caption style="text-align: center; color: darkblue;"><strong>COMPROBANTE DE PAGO</strong></caption>
            @if(array($sales))
                @foreach($sales as $sale)
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <td></td>
                            <td>{{ $sale->name }}</td>
                        </tr>

                        <tr>
                            <th>C.C. </th>
                            <td></td>
                            <td>{{ $sale->identification }}</td>
                        </tr>

                        <tr>
                            <th>Correo: </th>
                            <td></td>
                            <td>{{ $sale->email }}</td>
                        </tr>

                        <tr>
                            <th>Fecha: </th>
                            <td></td>
                            <td>{{ $sale->date }}</td>
                        </tr>

                        <tr>
                            <th>Zona:</th>
                            <td></td>
                            <td>{{ auth()->user()->zone['name'] }}</td>
                        </tr>

                        <tr>
                            <th>Vendedor:</th>
                            <td></td>
                            <td>{{ auth()->user()->name }}</td>
                        </tr>

                        <tr>
                            <th>&nbsp;</th>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>

                        <tr>
                            <th>&nbsp;</th>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        
                    </thead>
                <center>
                    <table width="100%" style="font-size: 14px;">
                            <thead>
                                <tr >
                                    <th scope="col" style="background: #3482CC; color: white;">Codigo</th>
                                    <th scope="col" style="background: #3482CC; color: white;">Descripcion</th>
                                    <th scope="col" style="background: #3482CC; color: white;">Cantidad</th>
                                    <th scope="col" style="background: #3482CC; color: white;">Servicio</th>
                                    <th scope="col" style="background: #3482CC; color: white;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="text-align: left;">
                                    <td>{{ $sale->id }}</td>
                                    <td>{{ $sale->pivot->description }}</td>
                                    <td>{{ $sale->quantity }}</td>
                                    <td>{{ $sale->service['name']}}</td>
                                    <td>${{ $sale->pivot->total }}.000</td>
                                </tr>
                            </tbody>
                        </table>
                    </center>
                @endforeach
            @else
                <p>Nada para mostrar</p>
            @endif

            <table align="right"  width="50%" style="font-size: 14px;">
                <thead>
                    <tr>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <th>&nbsp;</th>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr >
                        <th scope="col" style="background: #3482CC; color: white;">Subtotal:</th>
                        <th scope="col" style="background: #3482CC; color: white;">${{ $sale->pivot->total }}.000</th>
                    </tr>
                    <tr>
                        <td>IVA</td>
                        <td>$0</td>
                    </tr>
                    <tr>
                        <td>Valor Neto a Pagar</td>
                        <td>${{ $sale->pivot->total }}.000</td>
                    </tr>
                </thead>
            </table>
        </table>
        <footer>
            <p>
                *El presente comprobante de pago se asimila en todos sus efectos a una letra de cambio, según el artículo 774 del Código de Comercio. <br>
                *El presente comprobante de pago devengará intereses de mora a la máxima tasa legal vigente después de su vencimiento. <br>
                *Nota: Pago a través de Consignación o transferencia a uenta de ahorros Davivienda 005170154362 y/o cuenta de ahorros Bancolombia
C211- 000002- 95 a nombre de Andres Ayure.
            </p>
        </footer>
    </div>
</body>
</html>

<style type="text/css">
        thead:before, thead:after { display: none; }
        tbody:before, tbody:after { display: none; }
    footer {  position: absolute;
        bottom: 0;
        width: 100%;
        height: auto;
        font-size: 13px;
        }
</style>