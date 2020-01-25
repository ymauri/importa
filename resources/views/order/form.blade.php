@extends('layouts.app', ['activePage' => 'order', 'titlePage' => 'Compra'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="@if(isset($edit)) {{ route('order.update') }} @else {{ route('order.create') }} @endif" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <input type="hidden" name="order[id]" value="{{ $order->id }}">
            <div class="card ">
              <div class="card-header card-header-info">
                <h4 class="card-title">Crear compra</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12 text-right">
                            <a href="{{ route('order.index') }}" class="btn btn-sm btn-info">{{ __('Ir al listado') }}</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                        <h4 >Seleccione el cliente</h4>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">{{ __('Cliente') }}</label>
                        <input type="hidden" value="{{ $order->id_client }}" id="id_client">
                        <input type="hidden" value="{{ $order->id }}" name="order[id_order]">
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('order[id_client]') ? ' has-danger' : '' }}">
                            <select  class="form-control {{ $errors->has('order[id_client]') ? ' is-invalid' : '' }}" name="order[id_client]" type="text" placeholder="Escriba el nombre del cliente ..."  required="true" aria-required="true" id="select_client">
                                @if( !empty($order->client ) )
                                    <option value='{{ $order->id_client }}'> {{ $order->client->name  }} {{ $order->client->last_name  }}</option>
                                @else
                                    <option value="0"></option>
                                @endif
                            </select>
                            @if ($errors->has('order[id_client]'))
                                <span id="name-error" class="error text-danger">{{ $errors->first('order[id_client]') }}</span>
                            @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-7">
                        <h4 >Datos del destinatario</h4>
                        </div>
                    </div>
                    <div class="row">
                            <label class="col-sm-2 col-form-label">{{ __('Nombre') }}</label>
                            <div class="col-sm-7">
                              <div class="form-group{{ $errors->has('order[name]') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('order[name]') ? ' is-invalid' : '' }}" name="order[name]" type="text" placeholder="{{ __('Nombre') }}" value="{{ $order->name }}" required="true" aria-required="true"/>
                                @if ($errors->has('order[name]'))
                                  <span id="name-error" class="error text-danger">{{ $errors->first('order[name]') }}</span>
                                @endif
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <label class="col-sm-2 col-form-label">Apellidos</label>
                            <div class="col-sm-7">
                              <div class="form-group{{ $errors->has('order[last_name]') ? ' has-danger' : '' }}">
                                <input class="form-control{{ $errors->has('order[last_name]') ? ' is-invalid' : '' }}" name="order[last_name]" type="text" placeholder="Apellidos" value="{{ $order->last_name }}" required="true" aria-required="true"/>
                                @if ($errors->has('order[last_name]'))
                                  <span id="name-error" class="error text-danger">{{ $errors->first('order[last_name]') }}</span>
                                @endif
                              </div>
                            </div>
                          </div>
                          <div class="row">
                              <label class="col-sm-2 col-form-label">Correo Electrónico</label>
                              <div class="col-sm-7">
                                  <div class="form-group{{ $errors->has('order[email]') ? ' has-danger' : '' }}">
                                  <input class="form-control{{ $errors->has('order[email]') ? ' is-invalid' : '' }}" name="order[email]" type="email" placeholder="Correo Electrónico" value="{{ $order->email }}" required="true" aria-required="true"/>
                                  @if ($errors->has('order[email]'))
                                      <span id="name-error" class="error text-danger">{{ $errors->first('order[email]') }}</span>
                                  @endif
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <label class="col-sm-2 col-form-label">Carnet de Identidad</label>
                              <div class="col-sm-7">
                                  <div class="form-group{{ $errors->has('order[ci]') ? ' has-danger' : '' }}">
                                  <input class="form-control{{ $errors->has('order[ci]') ? ' is-invalid' : '' }}" name="order[ci]" type="text" placeholder="Carnet de Identidad" value="{{ $order->ci }}" required="true" aria-required="true"/>
                                  @if ($errors->has('order[ci]'))
                                      <span id="name-error" class="error text-danger">{{ $errors->first('order[ci]') }}</span>
                                  @endif
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <label class="col-sm-2 col-form-label">Pasaporte</label>
                              <div class="col-sm-7">
                                  <div class="form-group{{ $errors->has('order[passport]') ? ' has-danger' : '' }}">
                                  <input class="form-control{{ $errors->has('order[passport]') ? ' is-invalid' : '' }}" name="order[passport]" type="text" placeholder="Pasaporte" value="{{ $order->passport }}" required="true" aria-required="true"/>
                                  @if ($errors->has('order[passport]'))
                                      <span id="name-error" class="error text-danger">{{ $errors->first('order[passport]') }}</span>
                                  @endif
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <label class="col-sm-2 col-form-label">Teléfono Fijo</label>
                              <div class="col-sm-7">
                                  <div class="form-group{{ $errors->has('order[phone]') ? ' has-danger' : '' }}">
                                  <input class="form-control{{ $errors->has('order[phone]') ? ' is-invalid' : '' }}" name="order[phone]" type="phone" placeholder="Teléfono Fijo" value="{{ $order->phone }}" required="true" aria-required="true"/>
                                  @if ($errors->has('order[phone]'))
                                      <span id="name-error" class="error text-danger">{{ $errors->first('order[phone]') }}</span>
                                  @endif
                                  </div>
                              </div>
                          </div>
                          <div class="row">
                              <label class="col-sm-2 col-form-label">Teléfono Móvil</label>
                              <div class="col-sm-7">
                                  <div class="form-group{{ $errors->has('order[mobile]') ? ' has-danger' : '' }}">
                                  <input class="form-control{{ $errors->has('order[mobile]') ? ' is-invalid' : '' }}" name="order[mobile]" type="phone" placeholder="Teléfono Movil" value="{{ $order->mobile}}" required="true" aria-required="true"/>
                                  @if ($errors->has('order[mobile]'))
                                      <span id="name-error" class="error text-danger">{{ $errors->first('order[mobile]') }}</span>
                                  @endif
                                  </div>
                              </div>
                          </div>

                <div class="row">
                    <label class="col-sm-2 col-form-label">Calle</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('order[street]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('order[street]') ? ' is-invalid' : '' }}" name="order[street]" type="text" placeholder="Calle" value="{{ $order->street }}" required="true" aria-required="true"/>
                        @if ($errors->has('order[street]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('order[street]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                        <label class="col-sm-2 col-form-label">Entre</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('order[between]') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('order[between]') ? ' is-invalid' : '' }}" name="order[between]" type="text" placeholder="Entre" value="{{ $order->between }}" required="true" aria-required="true"/>
                            @if ($errors->has('order[between]'))
                                <span id="name-error" class="error text-danger">{{ $errors->first('order[between]') }}</span>
                            @endif
                            </div>
                        </div>
                    </div>

                <div class="row">
                    <label class="col-sm-2 col-form-label">Número</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('order[number]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('order[number]') ? ' is-invalid' : '' }}" name="order[number]" type="text" placeholder="Número" value="{{ $order->number }}" required="true" aria-required="true"/>
                        @if ($errors->has('order[number]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('order[number]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Apartamento</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('order[apartment]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('order[apartment]') ? ' is-invalid' : '' }}" name="order[apartment]" type="text" placeholder="Apartamento" value="{{ $order->apartment }}" required="true" aria-required="true"/>
                        @if ($errors->has('order[apartment]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('order[apartment]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <input type="hidden" value="{{ $order->id_city }}" id="id_city">
                    <label class="col-sm-2 col-form-label">Ciudad</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('order[id_city]') ? ' has-danger' : '' }}">
                        <select class="form-control{{ $errors->has('order[id_city]') ? ' is-invalid' : '' }}" name="order[id_city]" placeholder="Ciudad" aria-required="true" id="order_city">
                            @if( !empty($order->city) )
                                <option value='{{ $order->id_city }}'> {{ $order->city->name  }}, {{ $order->city->state->name  }} - {{ $order->city->state->country->name  }}</option>
                            @else
                                <option value="0"></option>
                            @endif
                        </select>
                        @if ($errors->has('order[id_city]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('order[id_city]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-info">Guardar</button>
                <button type="submit" class="btn btn-success">Configurar productos</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
@endpush

@push('js')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/i18n/es.js" integrity="sha256-ICzX9DU11JFCI552rqj4v+yAtzFpjtLCwO8Pptyl8PQ=" crossorigin="anonymous"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" integrity="sha256-wfVTTtJ2oeqlexBsfa3MmUoB77wDNRPqT1Q1WA2MMn4=" crossorigin="anonymous"></script>
    <script src="{{asset('js/order.js')}}" type="text/javascript"></script>
@endpush
