@extends('layouts.app', ['activePage' => 'shipping', 'titlePage' => 'Envíos'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="@if(isset($edit)) {{ route('shipping.update') }} @else {{ route('shipping.create') }} @endif" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <input type="hidden" name="shipping[id]" value="{{ $shipping->id }}" id="shipping_id">
            <div class="card ">
              <div class="card-header card-header-info">
                <h4 class="card-title">@if(isset($edit)) Editar @else Crear @endif envío</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('shipping.index') }}" class="btn btn-sm btn-info">{{ __('Ir al listado') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">Descripción</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('shipping[description]') ? ' has-danger' : '' }}">
                      <textarea class="form-control{{ $errors->has('shipping[description]') ? ' is-invalid' : '' }}" name="shipping[description]" type="text" placeholder="{{ __('Descripción') }}"  required="true" aria-required="true">
                        {{ $shipping->description }}
                        </textarea>
                      @if ($errors->has('shipping[description]'))
                        <span id="name-error" class="error text-danger">{{ $errors->first('shipping[description]') }}</span>
                      @endif
                    </div>
                  </div>
                </div>

              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-info">Guardar</button>
              </div>
            </div>
          </form>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-info">
                        <p class="card-category">Listado de bultos</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="#" class="btn btn-sm btn-success disabled" ><i class="material-icons">list_alt</i></a>
                                <a href="{{ route('shipping.txt', ['shipping'=>  $shipping->id]) }}" class="btn btn-sm btn-success" ><i class="material-icons">text_fields</i></a>
                                <a href="#" class="btn btn-sm btn-info" id="show-modal"><i class="material-icons">playlist_add</i></a>
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
@include('shipping.modal-orders')
@endsection

@push('js')
    <script src="{{asset('js/shipping.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/modal-orders.js')}}" type="text/javascript"></script>
@endpush
