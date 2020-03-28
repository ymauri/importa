@extends('layouts.app', ['activePage' => 'order', 'titlePage' => 'Facturación Empresas'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <p class="card-category">Listado de Facturaciones de Empresas</p>
          </div>
          <div class="card-body">
                <div class="row">
                    <div class="col-12 text-right">
                    <a href="{{ route('order.bill.create') }}" class="btn btn-sm btn-info">Nueva Factura</a>
                    </div>
                </div>
              <table class="table table-hover" style="width:100%" id="datatable_bills">
              </table>
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
