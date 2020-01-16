@extends('layouts.app', ['activePage' => 'order', 'titlePage' => 'Compras'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <p class="card-category">Listado de compras</p>
          </div>
          <div class="card-body">
                <div class="row">
                    <div class="col-12 text-right">
                            {{-- <a href="{{ route('product.create') }}" class="btn btn-sm btn-primary">Nueva compra</a> --}}

                        <a href="#" class="btn btn-sm btn-primary">Nueva compra</a>
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
