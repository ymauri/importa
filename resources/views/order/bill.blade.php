@php
    $quantity = $volumen = $pesoKg = $pesoLb = $precioTotal = $valueTotal = $flete = 0;
@endphp
<table @isset($view) class="table custom-table" @endisset style="boder: solid 1px #ddd !important;">
    <tbody>
        <tr>
            <td rowspan="11" style="font-size: 12px; text-align: center;"><img style="width: 250px;"
                @isset($view)
                    src="/img/gbi.jpg"
                @else
                    src="{{ public_path(). '/img/gbi.jpg'}}"
                @endisset><br/>
                <i>MADRID - CAPITAN HAYA #16 <br/> PANAMÁ- FRANCE FIELD </i>
            </td>
            <td colspan="2"><strong>TIPO</strong></td>
            <td colspan="11">{{ App\Enums\OrderType::getName($order->type) }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>NOMBRE</strong></td>
            <td colspan="11">{{ $order->name }} {{ $order->last_name }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>CI</strong></td>
            <td colspan="11">{{ $order->ci }} &nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><strong>PASAPORTE</strong></td>
            <td colspan="11">{{ $order->passport }} &nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><strong>DIRECCIÓN</strong></td>
            <td colspan="11">{{ $order->fullAddress() }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>TELÉFONO FIJO</strong></td>
            <td colspan="11">{{ $order->phone }} &nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><strong>TELÉFONO MÓVIL</strong></td>
            <td colspan="11">{{ $order->mobile }} &nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><strong>CORREO ELECTRÓNICO</strong></td>
            <td colspan="11">{{ $order->email }}</td>
        </tr>
        <tr>
            <td colspan="2"><strong>FECHA SALIDA</strong></td>
            <td colspan="11">{{ $order->departure }}</td>
        </tr>
        <tr>
            <td colspan="14">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="9"><strong>MERCANCÍA</strong></td>
            <td colspan="2"><strong>VALOR ADUANAL</strong></td>
            <td colspan="2"><strong>FLETE</strong></td>
        </tr>
        <tr>
            <td><strong>ARTÍCULO</strong></td>
            <td><strong>CANTIDAD</strong></td>
            <td><strong>MARCA</strong></td>
            <td><strong>MODELO</strong></td>
            <td><strong>TIENDA</strong></td>
            <td><strong>VOLUMEN CBM</strong></td>
            <td><strong>PESO KG</strong></td>
            <td><strong>PESO LB</strong></td>
            <td><strong>PRECIO UNITARIO</strong></td>
            <td><strong>PRECIO TOTAL</strong></td>
            <td><strong>VALOR UNITARIO</strong></td>
            <td><strong>VALOR TOTAL</strong></td>
            <td><strong>PRECIO UNITARIO</strong></td>
            <td><strong>PRECIO TOTAL</strong></td>
        </tr>
        @foreach ($order->orderProducts as $op)
            <tr>
                <td>{{ $op->product->name }}</td>
                <td>{{ $op->quantity }}</td>
                <td>{{ $op->product->brand }}</td>
                <td>{{ $op->product->model }} &nbsp;</td>
                <td>{{ $op->product->provider }}</td>
                <td>{{ $op->product->volumen }}</td>
                <td>{{ $op->product->weight }}</td>
                <td>{{ $op->product->weigthLb() }}</td>
                <td>{{ $op->product->price }}</td>
                <td>{{ $op->totalPrice()  }}</td>
                <td>{{ $op->product->customs_points }}</td>
                <td>{{ $op->totalCustomsPoints() }}</td>
                <td>{{ $op->charter }}</td>
                <td>{{ $op->totalCharter() }}</td>
            </tr>
            @php
                $quantity += $op->quantity;
                $volumen += $op->product->volumen;
                $pesoKg += $op->product->weight;
                $pesoLb += $op->product->weigthLb();
                $precioTotal += $op->product->price;
                $valueTotal += ($op->product->customs_points * $op->quantity);
                $flete += ($op->product->price * $op->charter);
            @endphp
        @endforeach
        <tr>
            <td><strong>TOTALES</strong></td>
            <td> {{ $quantity }} </td>
            <td style="background-color: #f5eded"></td>
            <td style="background-color: #f5eded"></td>
            <td style="background-color: #f5eded"></td>
            <td> {{ number_format($volumen, 2) }} </td>
            <td> {{ number_format($pesoKg, 2) }} </td>
            <td> {{ number_format($pesoLb, 2) }} </td>
            <td style="background-color: #f5eded"></td>
            <td> {{ number_format($precioTotal, 2) }} </td>
            <td style="background-color: #f5eded"></td>
            <td> {{ number_format($valueTotal, 2) }} </td>
            <td style="background-color: #f5eded"></td>
            <td> {{ number_format($flete, 2) }} </td>
        </tr>
        <tr>
            <td colspan="10" style="background-color: #f5eded"></td>
            <td><strong>PDTS</strong></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td><strong>TRASPASO DE TIENDA</strong></td>
            <td colspan="7"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>FORMULARIO DMC ENTRADA ZONA LIBRE</strong></td>
            <td colspan="7"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>ACARREO PANAMÁ- ZONA LIBRE</strong></td>
            <td colspan="7"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>FORMULARIO DMC SALIDA ZONA LIBRE</strong></td>
            <td colspan="7"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="14" style="background-color: #f5eded">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>FLETE</strong></td>
            <td colspan="7" style="background-color: #f5eded"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td> {{ number_format($flete, 2) }} </td>
        </tr>
        <tr>
            <td><strong>DOCUMENTACIÓN</strong></td>
            <td colspan="7" style="background-color: #f5eded"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>MANEJO EN BODEGA</strong></td>
            <td colspan="7" style="background-color: #f5eded"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>GESTIÓN COMERCIAL Y COTIZACIÓN</strong></td>
            <td colspan="7" style="background-color: #f5eded"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>EMABALAJE Y RETRACTILADO</strong></td>
            <td colspan="7" style="background-color: #f5eded"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td><strong>TOTAL ENVÍO</strong></td>
            <td colspan="7" style="background-color: #f5eded"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td> {{ number_format($flete + 70, 2) }} </td>
        </tr>
        <tr>
            <td><strong>TOTAL MERCANCÍA + ENVÍO</strong></td>
            <td colspan="7" style="background-color: #f5eded"></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td> {{ number_format($flete + 70 + $flete, 2) }} </td>
        </tr>
    </tbody>
</table>
