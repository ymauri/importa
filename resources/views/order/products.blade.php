@extends('layouts.app', ['activePage' => 'order', 'titlePage' => 'Compras'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
          <input type="hidden" value="{{ $order->id }}" id="id_order">
              <div class="row">
                    <div class="col-md-12 col-sm-12"><h4>Identificador: <b>#{{ $order->id }}</b></h4> </div>
                </div>
          </div>
          <div class="card-body">
              <div class="row">
                    <div class="col-md-6 col-sm-12">
                            <h5><b>Cliente: </b>{{ $order->client->name.' '.$order->client->last_name }}</h5>
                            <p>CI: {{ $order->client->ci }}</p>
                            {{-- <p>Pasaporte: {{ $order->client->passport }}</p>
                            <p>Teléfono Móvil: {{ $order->client->mobile }}</p>
                            <p>Teléfono Fijo: {{ $order->client->phone }}</p> --}}
                            <p>Dirección: {{ $order->client->address->fullAddress() }}</p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h5><b>Destinatario: </b> {{ $order->name.' '.$order->last_name }}</h5>
                            <p>CI: {{ $order->ci }}</p>
                            {{-- <p>Pasaporte: {{ $order->passport }}</p>
                            <p>Teléfono Móvil: {{ $order->mobile }}</p>
                            <p>Teléfono Fijo: {{ $order->phone }}</p> --}}
                            <p>Dirección: {{ $order->fullAddress() }}</p>
                        </div>
              </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                    <div class="row">
                    <div class="col-md-12 col-sm-12"><h4>Productos: <span class="total-productos">{{ count($products) }}</span></h4> </div>
                      </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-right">

                            <button id="show-modal" type="button" class="btn btn-info" data-toggle="modal" data-target=".product-list-modal"><i class="material-icons">playlist_add</i></button>
                        {{-- <a href="{{ route('order.addProduct', ['order' => $order->id]) }}" class="btn btn-sm btn-info">Añadir productos</a> --}}
                        </div>
                    </div>
                    <table class="table table-hover" style="width:100%" id="datatable_products_order">
                    </table>
                </div>
              </div>
            </div>
          </div>
  </div>
</div>
@include('order.modal-products')
@endsection
@push('scripts')
    <script src="{{asset('js/order.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/modal-products.js')}}" type="text/javascript"></script>
@endpush
