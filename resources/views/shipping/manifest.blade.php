@php
    $quantity = $volumen = $pesoKg = $pesoLb = $precioTotal = $valueTotal = $flete = 0;
@endphp
<table @isset($view) class="table custom-table" @endisset style="boder: solid 1px #ddd !important;">
    <tbody>
        <tr>
            <td style="background-color: #f5eded; font-weight:bold;">HBL</td>
            <td style="background-color: #f5eded; font-weight:bold;">Bulto</td>
            <td style="background-color: #f5eded; font-weight:bold;">Remitente</td>
            <td style="background-color: #f5eded; font-weight:bold;">Destinatario</td>
            <td style="background-color: #f5eded; font-weight:bold;">Artículo</td>
            <td style="background-color: #f5eded; font-weight:bold;">Código</td>
            <td style="background-color: #f5eded; font-weight:bold;">Cantidad</td>
            <td style="background-color: #f5eded; font-weight:bold;">Peso</td>
            <td style="background-color: #f5eded; font-weight:bold;">Entrega</td>
        </tr>
        @foreach ($shipping->orders as $sho)
            @php $cantidad = $sho->order->orderProducts->count() @endphp
            @if($cantidad >= 1)
                <tr>
                    <td rowspan="{{ $cantidad }}"> {{$sho->order->barcode}} &nbsp;&nbsp;</td>
                    <td rowspan="{{ $cantidad }}"> {{$sho->order->id}} &nbsp; </td>
                    <td rowspan="{{ $cantidad }}"> {{$sho->order->client->name . ' ' . $sho->order->client->last_name }} </td>
                    <td rowspan="{{ $cantidad }}"> {{$sho->order->name . ' ' . $sho->order->last_name }} </td>
                    @foreach ($sho->order->orderProducts as $op)
                        @if(!$loop->first) <tr> @endif
                        <td> {{ $op->product->name }} </td>
                        <td> {{ $op->product->model }} </td>
                        <td> {{ $op->quantity }} </td>
                        <td> {{$op->product->weigthLb() }} Lbs</td>
                        @if ($loop->first)
                            <td rowspan="{{ $cantidad }}"> Recogida {{ $sho->order->pickup == 0 ? 'A domicilio' : 'Directa' }}</td>
                        @endif
                            </tr>
                    @endforeach
            @endif
        @endforeach
    </tbody>
</table>
