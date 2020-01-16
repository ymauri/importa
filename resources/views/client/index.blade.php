@extends('layouts.app', ['activePage' => 'client', 'titlePage' => __('Clientes')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            {{-- <h4 class="card-title mt-0">Clientes</h4> --}}
            <p class="card-category">Listado de clientes</p>
          </div>
          <div class="card-body">
                <div class="row">
                    <div class="col-12 text-right">
                        <a href="{{ route('client.create') }}" class="btn btn-sm btn-primary">Nuevo cliente</a>
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

@push('styles')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/material-design-lite/1.1.0/material.min.css" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.20/css/dataTables.material.min.css" type="text/javascript"></script>
@endpush
@push('scripts')
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.material.min.js" type="text/javascript"></script>
    <script src="{{asset('js/client.js')}}" type="text/javascript"></script>
@endpush
