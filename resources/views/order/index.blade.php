@extends('layouts.app', ['activePage' => 'order', 'titlePage' => 'Compras'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <p class="card-category">Listado de compras</p>
          </div>
          <div class="card-body">
                <div class="row">
                    <div class="col-6 text-left">
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control search" placeholder="Buscar...">
                            <button type="submit" class="btn btn-white btn-round btn-just-icon search-btn">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('order.bill.index') }}" class="btn btn-sm btn-warning">Facturación Empresas</a>
                        <a href="{{ route('order.create') }}" class="btn btn-sm btn-info">Nueva compra</a>
                    </div>
                </div>
              <table class="table table-hover" style="width:100%" id="datatable_order">
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
    <script src="{{asset('js/order.js')}}" type="text/javascript"></script>
@endpush
