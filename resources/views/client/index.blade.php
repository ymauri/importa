@extends('layouts.app', ['activePage' => 'client', 'titlePage' => __('Clientes')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-plain">
          <div class="card-header card-header-primary">
            <h4 class="card-title mt-0">Clientes</h4>
            <p class="card-category">Listado de clientes</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover" id="datatable_client">
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="{{asset('js/client.js')}}" type="text/javascript"></script>
@endpush
