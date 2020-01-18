@extends('layouts.app', ['activePage' => 'product', 'titlePage' => 'Productos'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            {{-- <h4 class="card-title mt-0">Clientes</h4> --}}
            <p class="card-category">Listado de productos</p>
          </div>
          <div class="card-body">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('product.create') }}" class="btn btn-sm btn-info">Nuevo producto</a>
                    </div>
                </div>
              <table class="table table-hover" style="width:100%" id="datatable_product">
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('scripts')
    <script src="{{asset('js/product.js')}}" type="text/javascript"></script>
@endpush
