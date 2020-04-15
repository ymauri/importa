<!DOCTYPE html>
<html>
<head>
<title>{{ $order->id }}</title>
<style>
    @page { size: 210mm 297mm vertical; }

</style>
<style type="text/css">
    body,div,span,p,a,img,ol,ul,li,label,table,tbody,thead,tr,th,td{margin:0;padding:0;border:0;outline:0;font-size:100%;vertical-align:top;}
    body{line-height:1}ol,ul{list-style:none}table{border-collapse:collapse;border-spacing:0}
    body, table {font-size:10pt;font-family:Arial,sans-serif}
    p {line-height:1.2em;}
    table th {padding:2px 6px;font-size:11pt;}
    table td {padding:2px 6px;font-size:10pt;}
    table.products {border-bottom:1pt solid #000000;}
    table.products td {padding:4px 6px;font-size:10pt;border-top:1pt solid #dddddd;}
    table.products tr.header td {padding:4px 6px;background-color:#f0f0f0;border-top:1pt solid #000000;}
</style>
</head>
<body style="font-family: Arial, Helvetica, sans-serif !important; line-height: 10px">
    <div>
        <table width="100%">
            <tr>
                <td><img src="{{ public_path(). '/img/gbi.jpg'}}" alt="GoldBlack Investments"></td>
                <td style="text-align:right;">
                    <p style="font-size:14pt;font-weight:bold;">Envío: {{ $shipping->shipping->id + 99 }} </p>
                    <p style="font-size:14pt;font-weight:bold;">Bulto: {{ $order->id }} </p>
                    <p style="font-size:11pt;">Fecha: {{ date_format($order->updated_at, 'd-m-Y') }}</p>
                </td>
            </tr>
        </table>
        <table width="100%" style="margin-top:30px;">
            <tr>
                <th style="width:49%;text-align:left;">Comprador</th>
                <th style="width:2%;">&nbsp;</th>
                <th style="width:49%;text-align:left;">Destinatario</th>
            </tr>
            <tr>
                <td>
                    <p> {{ $order->client->name .' '. $order->client->last_name }} </p>
                    <p> {{  !empty($order->client->address) ? $order->client->address->fullAddress() : "-" }} </p>
                </td>
                <td>&nbsp;</td>
                <td>
                    <p>{{ $order->name .' '. $order->last_name }}</p>
                    <p> {{ !empty($order->id_city) ? $order->fullAddress() : "-" }} </p>

                </td>
            </tr>
        </table>
        <table class="products" style="margin-top:30px;" width="100%" cellspacing="0">
            <tr>
                <th colspan="2" style="text-align:left;border-bottom:1px solid black;">Productos</th>
            </tr>
            <tr class="header">
                <td nowrap="nowrap" width="5%" style="border-bottom:1px solid black;">Cant.</td>
                <td style="text-align:left;padding-left:12px;border-bottom:1px solid black;">Descripcion</td>
                <td style="text-align:left;padding-left:12px;border-bottom:1px solid black;">Valor</td>
                <td style="text-align:left;padding-left:12px;border-bottom:1px solid black;">Peso</td>
            </tr>
            @php
                $count = $order->orderProducts->count();
                $aduana = 0;
            @endphp
            @foreach($order->orderProducts as $key=>$item)
                <tr>
                    <td style="text-align:center;"> {{ $count }}</td>
                    <td style="padding-left:12px;">{{ $item->product->name }}</td>
                    <td style="padding-left:12px;">{{ $item->product->customs_points }}</td>
                    <td style="padding-left:12px;">{{ $item->product->weigthLb() }} Lbs</td>
                </tr>
                {{ $aduana += $item->product->customs_points }}
            @endforeach
        </table>

        <div style="margin:40px 0;border-top:1px dashed black; padding: 10px"></div>
        <table width="100%" style="margin-top:10px;">
            <tr style="vertical-align:top;">
                <td style="width:100%">
                    <p>COMPRADOR: {{ $order->client->name .' '. $order->client->last_name }} </p>
                    <p>DESTINATARIO: {{ $order->name .' '. $order->last_name }} </p>
                    <p>DIRECCIÓN: {{ $order->fullAddress() }}</p>
                    <p>CI: {{ $order->ci }}</p>
                    <p>TELÉFONO: {{ $order->phone }}</p>
                    <p>CANTIDAD DE PIEZAS: {{$count}}</p>
                    <p>PESO TOTAL: {{ $order->weigthLb() }} Lbs</p>
                    <p>VALOR TOTAL:  {{ $aduana }}</p>
                </td>
                <td style="width:2%">&nbsp;</td>

            </tr>
            <tr>
                <td style="width:40%;">
                    <!--<p style="font-weight:bold;">ORDEN: {$order->ID_ORDER}</p>-->
                    <p style="font-weight:bold;">PAQUETE: {{ $order->id }}</p>
                    <p>FECHA: {{ date_format($order->updated_at, 'd-m-Y') }}</p>
                    <p><img src="{{ storage_path('app/public/barcode/'.$order->barcode.'.png') }}"></p>
                </td>
            </tr>
        </table>

        <table width="100%" style="margin-top:20px;">
            <tr>
                <th style="text-align:left;">Recibido por</th>
                <th style="text-align:left;">Entregado por</th>
            </tr>
            <tr>
                <td style="width:50%" >
                    <p>Nombre:___________________________</p>
                    <p>Carnet No.:________________________</p>
                    <p>Firma:________________________</p>
                </td>
                <td style="width:50%">
                    <p>Nombre:___________________________</p>
                    <p>Fecha:________________________</p>
                    <p>Firma:________________________</p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
