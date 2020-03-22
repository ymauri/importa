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
            <input type="hidden" name="shipping[id_address]" value="{{ $shipping->id_address }}" id="shipping_id">
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
                      <textarea class="form-control{{ $errors->has('shipping[description]') ? ' is-invalid' : '' }}" name="shipping[description]" placeholder="{{ __('Descripción') }}"  required="true" aria-required="true">{{ $shipping->description }}</textarea>
                      @if ($errors->has('shipping[description]'))
                        <span id="name-error" class="error text-danger">{{ $errors->first('shipping[description]') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <i class="text-danger">Solo llenar en caso de Empresas</i>
                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Nombre') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group{{ $errors->has('shipping[name]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('shipping[name]') ? ' is-invalid' : '' }}" name="shipping[name]" type="text" placeholder="{{ __('Nombre') }}" value="{{ $shipping->name }}" />
                        @if ($errors->has('shipping[name]'))
                          <span id="name-error" class="error text-danger">{{ $errors->first('shipping[name]') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <label class="col-sm-2 col-form-label">Correo Electrónico</label>
                      <div class="col-sm-7">
                          <div class="form-group{{ $errors->has('shipping[email]') ? ' has-danger' : '' }}">
                          <input class="form-control{{ $errors->has('shipping[email]') ? ' is-invalid' : '' }}" name="shipping[email]" type="email" placeholder="Correo Electrónico" value="{{ $shipping->email }}" />
                          @if ($errors->has('shipping[email]'))
                              <span id="name-error" class="error text-danger">{{ $errors->first('shipping[email]') }}</span>
                          @endif
                          </div>
                      </div>
                  </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Calle</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('address[street]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('address[street]') ? ' is-invalid' : '' }}" name="address[street]" type="text" placeholder="Calle" value="{{ $address->street }}"/>
                        @if ($errors->has('address[street]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('address[street]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                        <label class="col-sm-2 col-form-label">Entre</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('address[between]') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('address[between]') ? ' is-invalid' : '' }}" name="address[between]" type="text" placeholder="Entre" value="{{ $address->between }}" />
                            @if ($errors->has('address[between]'))
                                <span id="name-error" class="error text-danger">{{ $errors->first('address[between]') }}</span>
                            @endif
                            </div>
                        </div>
                    </div>

                <div class="row">
                    <label class="col-sm-2 col-form-label">Número</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('address[number]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('address[number]') ? ' is-invalid' : '' }}" name="address[number]" type="text" placeholder="Número" value="{{ $address->number }}"/>
                        @if ($errors->has('address[number]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('address[number]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Apartamento</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('address[apartment]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('address[apartment]') ? ' is-invalid' : '' }}" name="address[apartment]" type="text" placeholder="Apartamento" value="{{ $address->apartment }}" />
                        @if ($errors->has('address[apartment]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('address[apartment]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" value="{{ $address->id_city }}" id="id_city">
                    <label class="col-sm-2 col-form-label">Ciudad</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('address[id_city]') ? ' has-danger' : '' }}">
                        <select  class="form-control {{ $errors->has('address[id_city]') ? ' is-invalid' : '' }}" name="address[id_city]" type="text" placeholder="Escriba la ciudad ..."  required="true" aria-required="true" id="select_city">
                            @if( !empty($address->city) )
                                <option value='{{ $address->id_city }}'> {{ $address->city->name  }}, {{ $address->city->state->name  }} - {{ $address->city->state->country->name  }}</option>
                            @else
                                <option value="0"></option>
                            @endif

                        </select>
                        @if ($errors->has('address[id_city]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('address[id_city]') }}</span>
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
        @if(!is_null($shipping->id))
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-info">
                            <p class="card-category">Listado de bultos</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class='col-md-4 col-sm-12'>
                                <div class="input-group no-border">
                                    <input type="text" value="" class="form-control search" id="order-global-search" placeholder="Buscar...">
                                    <button type="submit" class="btn btn-white btn-round btn-just-icon search-btn">
                                        <i class="material-icons">search</i>
                                        <div class="ripple-container"></div>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-12 text-right">
                                    <a href="{{ route('shipping.bill', ['shipping'=>  $shipping->id]) }}" class="btn btn-sm btn-success" ><i class="material-icons">list_alt</i></a>
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
        @endif

    </div>
</div>
@include('shipping.modal-orders')
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" integrity="sha256-wfVTTtJ2oeqlexBsfa3MmUoB77wDNRPqT1Q1WA2MMn4=" crossorigin="anonymous"></script>
    <script src="{{asset('js/shipping.js')}}" type="text/javascript"></script>
@endpush
