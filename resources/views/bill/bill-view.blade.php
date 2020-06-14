@extends('layouts.app', ['activePage' => 'order', 'titlePage' => 'Facturación'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
                <input type="hidden" name="bill[id]" value="{{ $bill->id }}">
                <div class="card ">
                    <div class="card-header card-header-info">
                        <h4 class="card-title">Vista previa - Factura - {{$bill->name}} </h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body data-bill">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">{{ __('Ir al listado') }}</a>
                            </div>
                        </div>
                        @isset($view)
                            <form action="{{route("order.bill.saveBill", ['bill' => $bill->id])}}" method="POST" autocomplete="off">
                            @csrf
                            @method('post')
                        @endisset
                            @include('bill.bill')
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-info">Guardar</button>
                            @isset($view) </form> @endisset
                            <form method="get"  target="_blank" style="display:inline;" action="{{ route('order.bill.excelBill', ['bill' => $bill->id]) }}" autocomplete="off" class="form-horizontal">
                                @csrf
                                @method('post')
                                <button type="submit" class="btn btn-success">Imprimir</button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
    <script src="{{asset('js/bill.js')}}" type="text/javascript"></script>
@endpush
