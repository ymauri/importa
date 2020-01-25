@extends('layouts.app', ['activePage' => 'client', 'titlePage' => __('Clientes')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="@if(isset($edit)) {{ route('client.update') }} @else {{ route('client.create') }} @endif" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <input type="hidden" name="client[id_client]" value="{{ $client->id }}">
            <input type="hidden" name="client[id_address]" value="{{ $client->id_address }}">
            <div class="card ">
              <div class="card-header card-header-info">
                <h4 class="card-title">{{ __('Crear cliente') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('client.index') }}" class="btn btn-sm btn-info">{{ __('Ir al listado') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nombre') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('client[name]') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('client[name]') ? ' is-invalid' : '' }}" name="client[name]" type="text" placeholder="{{ __('Nombre') }}" value="{{ $client->name }}" required="true" aria-required="true"/>
                      @if ($errors->has('client[name]'))
                        <span id="name-error" class="error text-danger">{{ $errors->first('client[name]') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">Apellidos</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('client[last_name]') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('client[last_name]') ? ' is-invalid' : '' }}" name="client[last_name]" type="text" placeholder="Apellidos" value="{{ $client->last_name }}" required="true" aria-required="true"/>
                      @if ($errors->has('client[last_name]'))
                        <span id="name-error" class="error text-danger">{{ $errors->first('client[last_name]') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Correo Electrónico</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('client[email]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('client[email]') ? ' is-invalid' : '' }}" name="client[email]" type="email" placeholder="Correo Electrónico" value="{{ $client->email }}" required="true" aria-required="true"/>
                        @if ($errors->has('client[email]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('client[email]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Carnet de Identidad</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('client[ci]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('client[ci]') ? ' is-invalid' : '' }}" name="client[ci]" type="text" placeholder="Carnet de Identidad" value="{{ $client->ci }}" required="true" aria-required="true"/>
                        @if ($errors->has('client[ci]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('client[ci]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Pasaporte</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('client[passport]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('client[passport]') ? ' is-invalid' : '' }}" name="client[passport]" type="text" placeholder="Pasaporte" value="{{ $client->passport }}" required="true" aria-required="true"/>
                        @if ($errors->has('client[passport]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('client[passport]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Teléfono Fijo</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('client[phone]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('client[phone]') ? ' is-invalid' : '' }}" name="client[phone]" type="phone" placeholder="Teléfono Fijo" value="{{ $client->phone }}" required="true" aria-required="true"/>
                        @if ($errors->has('client[phone]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('client[phone]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Teléfono Móvil</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('client[mobile]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('client[mobile]') ? ' is-invalid' : '' }}" name="client[mobile]" type="phone" placeholder="Teléfono Movil" value="{{ $client->mobile}}" required="true" aria-required="true"/>
                        @if ($errors->has('client[mobile]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('client[mobile]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-7">
                    <h4 >Dirección</h4>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Calle</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('address[street]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('address[street]') ? ' is-invalid' : '' }}" name="address[street]" type="text" placeholder="Calle" value="{{ $address->street }}" required="true" aria-required="true"/>
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
                            <input class="form-control{{ $errors->has('address[between]') ? ' is-invalid' : '' }}" name="address[between]" type="text" placeholder="Entre" value="{{ $address->between }}" required="true" aria-required="true"/>
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
                        <input class="form-control{{ $errors->has('address[number]') ? ' is-invalid' : '' }}" name="address[number]" type="text" placeholder="Número" value="{{ $address->number }}" required="true" aria-required="true"/>
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
                        <input class="form-control{{ $errors->has('address[apartment]') ? ' is-invalid' : '' }}" name="address[apartment]" type="text" placeholder="Apartamento" value="{{ $address->apartment }}" required="true" aria-required="true"/>
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
      </div>
    </div>
  </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/css/select2.min.css" integrity="sha256-FdatTf20PQr/rWg+cAKfl6j4/IY3oohFAJ7gVC3M34E=" crossorigin="anonymous" />
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.12/js/select2.min.js" integrity="sha256-wfVTTtJ2oeqlexBsfa3MmUoB77wDNRPqT1Q1WA2MMn4=" crossorigin="anonymous"></script>
    <script src="{{asset('js/client.js')}}" type="text/javascript"></script>
@endpush
