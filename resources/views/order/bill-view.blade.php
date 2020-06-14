@extends('layouts.app', ['activePage' => 'shipping', 'titlePage' => 'Compra'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

                <input type="hidden" name="order[id]" value="{{ $order->id }}">
                <div class="card ">
                    <div class="card-header card-header-info">
                        <h4 class="card-title">Vista previa - Factura - {{$order->id}} </h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body data-bill">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">{{ __('Ir al listado') }}</a>
                            </div>
                        </div>
                        @isset($view)
                            <form action="{{route("order.saveBill", ['order' => $order->id])}}" method="POST" autocomplete="off">
                            @csrf
                            @method('post')
                        @endisset
                        @include('order.bill')
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-info">Guardar</button>
                            @isset($view) </form> @endisset
                            <form method="get"  target="_blank" style="display:inline;" action="{{ route('order.excel', ['order' => $order->id]) }}" autocomplete="off" class="form-horizontal">
                                @csrf
                                @method('post')
                                <button type="submit" class="btn btn-success" target="_blank">Imprimir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('scripts')
    <script src="{{asset('js/bill.js')}}" type="text/javascript"></script>
@endpush
