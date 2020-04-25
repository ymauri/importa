@extends('layouts.app', ['activePage' => 'client', 'titlePage' => __('Clientes')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            {{-- <h4 class="card-title mt-0">Clientes</h4> --}}
            <p class="card-category">Listado de clientes</p>
          </div>
          <div class="card-body">
                <div class="row">
                    <div class='col-4'>
                        <div class="input-group no-border">
                            <input type="text" value="" class="form-control search" id="order-global-search" placeholder="Buscar...">
                            <button type="submit" class="btn btn-white btn-round btn-just-icon search-btn">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>
                        </div>
                    </div>
                    <div class="col-8 text-right">
                        <a href="{{ route('client.create') }}" class="btn btn-sm btn-info">Nuevo cliente</a>
                    </div>
                </div>
              <table class="table table-hover" style="width:100%" id="datatable_client">
              </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
    <script src="{{asset('js/client.js')}}" type="text/javascript"></script>
@endpush
