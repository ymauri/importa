@extends('layouts.app', ['activePage' => 'shipping', 'titlePage' => 'Envíos'])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            {{-- <h4 class="card-title mt-0">Clientes</h4> --}}
            <p class="card-category">Listado de envíos</p>
          </div>
          <div class="card-body">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('shipping.create') }}" class="btn btn-sm btn-info">Nuevo envío</a>
                    </div>
                </div>
              <table class="table table-hover" style="width:100%" id="datatable_shipping">
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<audio src=""></audio>
@endsection

@push('scripts')
    <script src="{{asset('js/shipping.js')}}" type="text/javascript"></script>
@endpush
