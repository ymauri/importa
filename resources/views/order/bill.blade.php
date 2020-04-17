@php
    $quantity = $volumen = $pesoKg = $pesoLb = $precioTotal = $valueTotal = $flete = $charterTtotal = 0;
@endphp
@if (!isset($view))
<style>
    @page { size: 210mm 297mm landscape; }
</style>
<style type="text/css">
    body,div,span,p,a,img,ol,ul,li,label,table,tbody,thead,tr,th,td{margin:0;padding:0;outline:0;font-size:100%;vertical-align:top;}
    body{line-height:1; padding:2px;}ol,ul{list-style:none}table{border-collapse:collapse;border-spacing:0}
    table {font-size:12px;font-family:Arial,sans-serif; border: #666666 solid 1px;}
    table th {padding:2px;font-size:12px;}
    table td {padding:2px;font-size:12px; border: #666666 solid 1px;}
</style>
@endif
<table @isset($view) class="table custom-table" @endisset style="boder: solid 1px #ddd !important;">
    <tbody>
        <tr>
            <td rowspan="11" style="font-size: 12px; text-align: center;"><img style="width: 130px;"
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
                $charterTtotal += $op->totalCharter();
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
            <td> {{ number_format($precioTotal, 2) }} <input type="hidden" id="mercancia" value="{{ number_format($precioTotal, 2) }}"></td>
            <td style="background-color: #f5eded"></td>
            <td> {{ number_format($valueTotal, 2) }} </td>
            <td style="background-color: #f5eded"></td>
            <td> {{ number_format($charterTtotal, 2) }} </td>
        </tr>
        <tr>
            <td colspan="10" style="background-color: #f5eded"></td>
            <td><strong>PDTS</strong></td>
            <td colspan="3"></td>
        </tr>
        <tr>
            <td><strong>TRASPASO DE TIENDA</strong></td>
            <td>
                @isset($view)
                <input class="form-control text-right" id="qty-shop_transfer" name="details[qty][shop_transfer]"  step="any" type="number" value="{{ !empty($order->details->qty) ? $order->details->qty->shop_transfer : 0}}" />
                @else
                    {{ !empty($order->details->qty) ? $order->details->qty->shop_transfer : 0}}
                @endisset
            </td>
            <td colspan="10"  style="background-color: #f5eded"></td>
            <td>
                @isset($view)
                    <input class="form-control text-right" id="unit-shop_transfer" name="details[unit_price][shop_transfer]"  step="any" type="number" value="{{ !empty($order->details->unit_price) ? $order->details->unit_price->shop_transfer : 0}}" />
                @else
                    {{ !empty($order->details->unit_price) ? $order->details->unit_price->shop_transfer : 0}}
                @endisset
            </td>
            <td>
                @isset($view)
                    <input class="form-control text-right" id="total-shop_transfer" readonly name="details[total_price][shop_transfer]"  step="any" type="number" value="{{ !empty($order->details->total_price) ? $order->details->total_price->shop_transfer : 0}}" />
                @else
                    {{ !empty($order->details->total_price) ? $order->details->total_price->shop_transfer : 0}}
                @endisset
            </td>
        </tr>
        <tr>
            <td><strong>FORMULARIO DMC ENTRADA ZONA LIBRE</strong></td>
            <td>
                @isset($view)
                <input class="form-control text-right"  id="qty-form_dmc_in" name="details[qty][form_dmc_in]"  step="any" type="number" value="{{ !empty($order->details->qty) ? $order->details->qty->form_dmc_in : 0}}" />
                @else
                    {{ !empty($order->details->qty) ? $order->details->qty->form_dmc_in : 0}}
                @endisset
            </td>
            <td colspan="10"  style="background-color: #f5eded"></td>
            <td>
                @isset($view)
                    <input class="form-control text-right" id="unit-form_dmc_in" name="details[unit_price][form_dmc_in]"  step="any" type="number" value="{{ !empty($order->details->unit_price) ? $order->details->unit_price->form_dmc_in : 0}}" />
                @else
                    {{ !empty($order->details->unit_price) ? $order->details->unit_price->form_dmc_in : 0}}
                @endisset
            </td>
            <td>
                @isset($view)
                    <input class="form-control text-right" id="total-form_dmc_in" readonly name="details[total_price][form_dmc_in]"  step="any" type="number" value="{{ !empty($order->details->total_price) ? $order->details->total_price->form_dmc_in : 0}}" />
                @else
                    {{ !empty($order->details->total_price) ? $order->details->total_price->form_dmc_in : 0}}
                @endisset
            </td>
        </tr>
        <tr>
            <td><strong>ACARREO PANAMÁ- ZONA LIBRE</strong></td>
            <td>
                @isset($view)
                <input class="form-control text-right" id="qty-free_zone" name="details[qty][free_zone]"  step="any" type="number" value="{{ !empty($order->details->qty) ? $order->details->qty->free_zone : 0}}" />
                @else
                    {{ !empty($order->details->qty) ? $order->details->qty->free_zone : 0}}
                @endisset
            </td>
            <td colspan="10"  style="background-color: #f5eded"></td>
            <td>
                @isset($view)
                    <input class="form-control text-right" id="unit-free_zone" name="details[unit_price][free_zone]"  step="any" type="number" value="{{ !empty($order->details->unit_price) ? $order->details->unit_price->free_zone : 0}}" />
                @else
                    {{ !empty($order->details->unit_price) ? $order->details->unit_price->free_zone : 0}}
                @endisset
            </td>
            <td>
                @isset($view)
                    <input class="form-control text-right" id="total-free_zone" readonly name="details[total_price][free_zone]"  step="any" type="number" value="{{ !empty($order->details->total_price) ? $order->details->total_price->free_zone : 0}}" />
                @else
                    {{ !empty($order->details->total_price) ? $order->details->total_price->free_zone : 0}}
                @endisset
            </td>
        </tr>
        <tr>
            <td><strong>FORMULARIO DMC SALIDA ZONA LIBRE</strong></td>
            <td>
                @isset($view)
                <input class="form-control text-right" id="qty-form_dmc_out" name="details[qty][form_dmc_out]"  step="any" type="number" value="{{ !empty($order->details->qty) ? $order->details->qty->form_dmc_out : 0}}" />
                @else
                    {{ !empty($order->details->qty) ? $order->details->qty->form_dmc_out : 0}}
                @endisset
            </td>
            <td colspan="10"  style="background-color: #f5eded"></td>
            <td>
                @isset($view)
                    <input class="form-control text-right"  id="unit-form_dmc_out" name="details[unit_price][form_dmc_out]"  step="any" type="number" value="{{ !empty($order->details->unit_price) ? $order->details->unit_price->form_dmc_out : 0}}" />
                @else
                    {{ !empty($order->details->unit_price) ? $order->details->unit_price->form_dmc_out : 0}}
                @endisset
            </td>
            <td>
                @isset($view)
                    <input class="form-control text-right"  id="total-form_dmc_out" readonly name="details[total_price][form_dmc_out]"  step="any" type="number" value="{{ !empty($order->details->total_price) ? $order->details->total_price->form_dmc_out : 0}}" />
                @else
                    {{ !empty($order->details->total_price) ? $order->details->total_price->form_dmc_out : 0}}
                @endisset
            </td>
        </tr>
        <tr>
            <td colspan="14" style="background-color: #f5eded">&nbsp;</td>
        </tr>
        <tr>
            <td><strong>FLETE</strong></td>
            <td>
                @isset($view)
                <input class="form-control text-right"  id="qty-charter" name="details[qty][charter]"  step="any" type="number" value="{{ !empty($order->details->qty) ? $order->details->qty->charter : 0}}" />
                @else
                    {{ !empty($order->details->qty) ? $order->details->qty->charter : 0}}
                @endisset
            </td>
            <td colspan="10"  style="background-color: #f5eded"></td>
            <td>
                @isset($view)
                    <input class="form-control text-right" id="unit-charter" readonly name="details[unit_price][charter]"  step="any" type="number" value="{{ !empty($order->details->unit_price) ? $order->details->unit_price->charter : $charterTtotal}}" />
                @else
                    {{ !empty($order->details->unit_price) ? $order->details->unit_price->charter : $charterTtotal}}
                @endisset
            </td>
            <td>
                @isset($view)
                    <input class="form-control text-right envio"  id="total-charter" readonly name="details[total_price][charter]"  step="any" type="number" value="{{ !empty($order->details->total_price) ? $order->details->total_price->charter : 0}}" />
                @else
                    {{ !empty($order->details->total_price) ? $order->details->total_price->charter : 0}}
                @endisset
            </td>
        </tr>
        <tr>
            <td><strong>DOCUMENTACIÓN</strong></td>
            <td>
                @isset($view)
                <input class="form-control text-right"  id="qty-docs" name="details[qty][docs]"  step="any" type="number" value="{{ !empty($order->details->qty) ? $order->details->qty->docs : 0}}" />
                @else
                    {{ !empty($order->details->qty) ? $order->details->qty->docs : 0}}
                @endisset
            </td>
            <td colspan="10"  style="background-color: #f5eded"></td>
            <td>
                @isset($view)
                    <input class="form-control text-right" id="unit-docs" name="details[unit_price][docs]"  step="any" type="number" value="{{ !empty($order->details->unit_price) ? $order->details->unit_price->docs : 0}}" />
                @else
                    {{ !empty($order->details->unit_price) ? $order->details->unit_price->docs : 0}}
                @endisset
            </td>
            <td>
                @isset($view)
                    <input class="form-control text-right envio"  id="total-docs" readonly name="details[total_price][docs]"  step="any" type="number" value="{{ !empty($order->details->total_price) ? $order->details->total_price->docs : 0}}" />
                @else
                    {{ !empty($order->details->total_price) ? $order->details->total_price->docs : 0}}
                @endisset
            </td>
        </tr>
        <tr>
            <td><strong>MANEJO EN BODEGA</strong></td>
            <td>
                @isset($view)
                <input class="form-control text-right" id="qty-store_manage" name="details[qty][store_manage]"  step="any" type="number" value="{{ !empty($order->details->qty) ? $order->details->qty->store_manage : 0}}" />
                @else
                    {{ !empty($order->details->qty) ? $order->details->qty->store_manage : 0}}
                @endisset
            </td>
            <td colspan="10"  style="background-color: #f5eded"></td>
            <td>
                @isset($view)
                    <input class="form-control text-right" id="unit-store_manage" name="details[unit_price][store_manage]"  step="any" type="number" value="{{ !empty($order->details->unit_price) ? $order->details->unit_price->store_manage : 0}}" />
                @else
                    {{ !empty($order->details->unit_price) ? $order->details->unit_price->store_manage : 0}}
                @endisset
            </td>
            <td>
                @isset($view)
                    <input class="form-control text-right envio" id="total-store_manage" readonly name="details[total_price][store_manage]"  step="any" type="number" value="{{ !empty($order->details->total_price) ? $order->details->total_price->store_manage : 0}}" />
                @else
                    {{ !empty($order->details->total_price) ? $order->details->total_price->store_manage : 0}}
                @endisset
            </td>
        </tr>
        <tr>
            <td><strong>GESTIÓN COMERCIAL Y COTIZACIÓN</strong></td>
            <td>
                @isset($view)
                <input class="form-control text-right" id="qty-commercial_manage" name="details[qty][commercial_manage]"  step="any" type="number" value="{{ !empty($order->details->qty) ? $order->details->qty->commercial_manage : 0}}" />
                @else
                    {{ !empty($order->details->qty) ? $order->details->qty->commercial_manage : 0}}
                @endisset
            </td>
            <td colspan="10"  style="background-color: #f5eded"></td>
            <td>
                @isset($view)
                    <input class="form-control text-right" id="unit-commercial_manage"  name="details[unit_price][commercial_manage]"  step="any" type="number" value="{{ !empty($order->details->unit_price) ? $order->details->unit_price->commercial_manage : 0}}" />
                @else
                    {{ !empty($order->details->unit_price) ? $order->details->unit_price->commercial_manage : 0}}
                @endisset
            </td>
            <td>
                @isset($view)
                    <input class="form-control text-right envio"  id="total-commercial_manage"  readonly name="details[total_price][commercial_manage]"  step="any" type="number" value="{{ !empty($order->details->total_price) ? $order->details->total_price->commercial_manage : 0}}" />
                @else
                    {{ !empty($order->details->total_price) ? $order->details->total_price->commercial_manage : 0}}
                @endisset
            </td>
        </tr>
        <tr>
            <td><strong>EMABALAJE Y RETRACTILADO</strong></td>
            <td>
                @isset($view)
                <input class="form-control text-right" id="qty-packaging" name="details[qty][packaging]"  step="any" type="number" value="{{ !empty($order->details->qty) ? $order->details->qty->packaging : 0}}" />
                @else
                    {{ !empty($order->details->qty) ? $order->details->qty->packaging : 0}}
                @endisset
            </td>
            <td colspan="10"  style="background-color: #f5eded"></td>
            <td>
                @isset($view)
                    <input class="form-control text-right" id="unit-packaging"  name="details[unit_price][packaging]"  step="any" type="number" value="{{ !empty($order->details->unit_price) ? $order->details->unit_price->packaging : 0}}" />
                @else
                    {{ !empty($order->details->unit_price) ? $order->details->unit_price->packaging : 0}}
                @endisset
            </td>
            <td>
                @isset($view)
                    <input class="form-control text-right envio" id="total-packaging"  readonly name="details[total_price][packaging]"  step="any" type="number" value="{{ !empty($order->details->total_price) ? $order->details->total_price->packaging : 0}}" />
                @else
                    {{ !empty($order->details->total_price) ? $order->details->total_price->packaging : 0}}
                @endisset
            </td>
        </tr>
        <tr>
            <td><strong>TOTAL ENVÍO</strong></td>
            <td colspan="12" style="background-color: #f5eded"></td>
            <td>
                @isset($view)
                    <input class="form-control text-right" id="total-total_shipping"  readonly name="details[total_price][total_shipping]"  step="any" type="number" value="{{ !empty($order->details->total_price) ? $order->details->total_price->total_shipping : 0}}" />
                @else
                    {{ !empty($order->details->total_price) ? $order->details->total_price->total_shipping : 0}}
                @endisset
            </td>
        </tr>
        <tr>
            <td><strong>TOTAL MERCANCÍA + ENVÍO</strong></td>
            <td colspan="12" style="background-color: #f5eded"></td>
            <td>
                @isset($view)
                    <input class="form-control text-right" id="total-total_shipping_ware" readonly name="details[total_price][total_shipping_ware]"  step="any" type="number" value="{{ !empty($order->details->total_price) ? $order->details->total_price->total_shipping_ware :    number_format($precioTotal + $charterTtotal, 2)}}" />
                @else
                    {{ !empty($order->details->total_price) ? $order->details->total_price->total_shipping_ware :  number_format($precioTotal + $charterTtotal, 2)}}
                @endisset
            </td>
        </tr>
    </tbody>
</table>
