<!DOCTYPE html>
<html>
<head>
<title>{{ $order->id }}</title>
<style>
    @page { size: 14cm 20cm landscape; }
  </style>
</head>
<body style="font-family: Arial, Helvetica, sans-serif !important; line-height: 10px">
	<h2>ENVÍO No.{{ $shipping->shipping->id }} / PAQUETE: {{ $order->id }} </h2>
	<p><b>REMITENTE:</b> {{ $order->client->name.' '. $order->client->last_name  }}</p>
    <p><b>DESTINATARIO:</b> {{ $order->name .' '. $order->last_name  }}</p>
	<p><b>DIRECCIÓN:</b> {{ $order->fullAddress() }} </p>
	<p><b>CI:</b> {{ $order->ci }}</p>
	<p><b>TELÉFONO:</b> {{ $order->mobile }}</p>
	<p><b>DESCRIPCIÓN:</b> {{ $order->description() }}</p>
    <p><b>CANTIDAD DE PIEZAS:</b> {{ $order->orderProducts->count() }} </p>
    <p><b>PIEZAS:</b>
        @foreach ($order->orderProducts as $key=>$item)
            {{ $item->product->name }} ({{ $key+1 }}/{{ $order->orderProducts->count() }})@if (!$loop->last), @endif
        @endforeach</p>
	<p><b>TIPO DE ARTÍCULOS:</b> {{ $order->type }} </p>
    <p><b>FECHA:</b> {{ date('d-m-Y', strtotime($order->created_at)) }}</p>
    <br>
    <img src="{{ storage_path('app/public/barcode/'.$order->barcode.'.png') }}">
</body>
</html>
