@extends('layouts.app', ['activePage' => 'shipping', 'titlePage' => 'Compra'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <form method="get" action="{{ route('order.excel', ['order' => $order->id]) }}" autocomplete="off" class="form-horizontal">
                @csrf
                @method('post')
                <input type="hidden" name="order[id]" value="{{ $order->id }}">
                <div class="card ">
                    <div class="card-header card-header-info">
                        <h4 class="card-title">Vista previa - Factura - {{$order->id}} </h4>
                        <p class="card-category"></p>
                    </div>
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <a href="{{ url()->previous() }}" class="btn btn-sm btn-info">{{ __('Ir al listado') }}</a>
                            </div>
                        </div>
                        @include('order.bill')
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

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
@endpush

@push('js')
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/datepicker/0.6.5/i18n/datepicker.es-ES.min.js" integrity="sha256-b46Ei80gSqobQQdLu0dzusIZDr5GfP0QAFx9d6QZs4c=" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/i18n/es.js" integrity="sha256-ICzX9DU11JFCI552rqj4v+yAtzFpjtLCwO8Pptyl8PQ=" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" integrity="sha256-wfVTTtJ2oeqlexBsfa3MmUoB77wDNRPqT1Q1WA2MMn4=" crossorigin="anonymous"></script>
    <script src="{{asset('js/order.js')}}" type="text/javascript"></script>
@endpush
