@extends('layouts.app', ['activePage' => 'bill', 'titlePage' => 'Facturación Empresas'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="@if(isset($edit)) {{ route('order.bill.update') }} @else {{ route('order.bill.create') }} @endif" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <input type="hidden" name="bill[id]" value="{{ $bill->id }}" id="bill_id">
            <input type="hidden" name="bill[address_id]" value="{{ $bill->address_id }}" id="bill_id">
            <div class="card ">
              <div class="card-header card-header-info">
                <h4 class="card-title">@if(isset($edit)) Editar @else Crear @endif factura</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('order.bill.index') }}" class="btn btn-sm btn-info">{{ __('Ir al listado') }}</a>
                  </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">{{ __('Nombre de la empresa') }}</label>
                    <div class="col-sm-7">
                      <div class="form-group{{ $errors->has('bill[name]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('bill[name]') ? ' is-invalid' : '' }}" name="bill[name]" type="text" placeholder="{{ __('Nombre de la empresa') }}" value="{{ $bill->name }}" required="required" />
                        @if ($errors->has('bill[name]'))
                          <span id="name-error" class="error text-danger">{{ $errors->first('bill[name]') }}</span>
                        @endif
                      </div>
                    </div>
                  </div>
                  <div class="row">
                      <label class="col-sm-2 col-form-label">Correo Electrónico</label>
                      <div class="col-sm-7">
                          <div class="form-group{{ $errors->has('bill[email]') ? ' has-danger' : '' }}">
                          <input class="form-control{{ $errors->has('bill[email]') ? ' is-invalid' : '' }}" name="bill[email]" type="email" placeholder="Correo Electrónico" value="{{ $bill->email }}" />
                          @if ($errors->has('bill[email]'))
                              <span id="name-error" class="error text-danger">{{ $errors->first('bill[email]') }}</span>
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
                <hr>

                <i class="text-danger">Seleccione los bultos de esta factura</i>
                <div class="row">
                    <input type="hidden" value="" id="id_city">
                    <label class="col-sm-2 col-form-label">Bultos</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('orders[]') ? ' has-danger' : '' }}">
                        <select  class="form-control {{ $errors->has('orders[]') ? ' is-invalid' : '' }}" name="orders[]" type="text" placeholder="Escriba le ID o el nombre del destinatario ..."  required="true" aria-required="true" multiple="multiple" id="select_bulto">
                            @foreach ($bill->orders as $order)
                                <option value='{{ $order->id }}' selected> {{ $order->id }} - {{ $order->client->name  }}  {{ $order->client->last_name  }} </option>
                            @endforeach
                        </select>
                        @if ($errors->has('orders[]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('orders[]') }}</span>
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
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
@endpush
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" integrity="sha256-wfVTTtJ2oeqlexBsfa3MmUoB77wDNRPqT1Q1WA2MMn4=" crossorigin="anonymous"></script>
    <script src="{{asset('js/bill.js')}}" type="text/javascript"></script>
@endpush
