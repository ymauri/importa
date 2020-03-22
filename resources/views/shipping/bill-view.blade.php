@extends('layouts.app', ['activePage' => 'shipping', 'titlePage' => 'Compra'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <form method="get" action="{{ route('shipping.excelBill', ['shipping' => $shipping->id]) }}" autocomplete="off" class="form-horizontal">
                @csrf
                @method('post')
                <input type="hidden" name="shipping[id]" value="{{ $shipping->id }}">
                <div class="card ">
                    <div class="card-header card-header-info">
                        <h4 class="card-title">Vista previa - Factura - {{$shipping->description}} </h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">{{ __('Ir al listado') }}</a>
                            </div>
                        </div>
                        @include('shipping.bill')
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success">Exportar Excel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
