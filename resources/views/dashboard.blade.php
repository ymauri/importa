@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                <i class="material-icons">assignment_turned_in</i>
              </div>
              <h3 class="card-title"> {{ $shippings }}
               <br> <small>Envíos</small>
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons text-info">insert_link</i>
                <a href="{{ route('shipping.index') }}">Ver</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">attach_money</i>
                </div>
                <h3 class="card-title"> {{ $orders }}
                  <br><small>Bultos</small>
                </h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons text-info">insert_link</i>
                  <a href="{{ route('order.index') }}">Ver</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-primary card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">widgets</i>
                </div>
                <h3 class="card-title"> {{ $products }}
                  <small>Productos</small>
                </h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons text-info">insert_link</i>
                  <a href="{{ route('product.index') }}">Ver</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">accessibility</i>
                </div>
                <h3 class="card-title"> {{ $clients }}
                  <br><small>Clientes</small>
                </h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <i class="material-icons text-info">insert_link</i>
                  <a href="{{ route('client.index') }}">Ver</a>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
@endsection

