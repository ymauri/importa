@extends('layouts.app', ['activePage' => 'client', 'titlePage' => __('Clientes')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('client.update', ['id' => $client->id]) }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Crear cliente') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('client.index') }}" class="btn btn-sm btn-primary">{{ __('Ir al listado') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Nombre') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('client[name]') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('client[name]') ? ' is-invalid' : '' }}" name="client[name]" id="input-name" type="text" placeholder="{{ __('Nombre') }}" value="{{ $client->name }}" required="true" aria-required="true"/>
                      @if ($errors->has('client[name]'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('client[name]') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">Apellidos</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('client[last_name]') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('client[last_name]') ? ' is-invalid' : '' }}" name="client[last_name]" id="input-name" type="text" placeholder="Apellidos" value="{{ $client->last_name }}" required="true" aria-required="true"/>
                      @if ($errors->has('client[last_name]'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('client[last_name]') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Correo Electrónico</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('client[email]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('client[email]') ? ' is-invalid' : '' }}" name="client[email]" id="input-name" type="email" placeholder="Correo Electrónico" value="{{ $client->email }}" required="true" aria-required="true"/>
                        @if ($errors->has('client[email]'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('client[email]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Carnet de Identidad</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('client[ci]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('client[ci]') ? ' is-invalid' : '' }}" name="client[ci]" id="input-name" type="text" placeholder="Carnet de Identidad" value="{{ $client->ci }}" required="true" aria-required="true"/>
                        @if ($errors->has('client[ci]'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('client[ci]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Pasaporte</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('client[passport]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('client[passport]') ? ' is-invalid' : '' }}" name="client[passport]" id="input-name" type="text" placeholder="Pasaporte" value="{{ $client->passport }}" required="true" aria-required="true"/>
                        @if ($errors->has('client[passport]'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('client[passport]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Teléfono Fijo</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('client[phone]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('client[phone]') ? ' is-invalid' : '' }}" name="client[phone]" id="input-name" type="phone" placeholder="Teléfono Fijo" value="{{ $client->phone }}" required="true" aria-required="true"/>
                        @if ($errors->has('client[phone]'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('client[phone]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Teléfono Móvil</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('client[mobile]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('client[mobile]') ? ' is-invalid' : '' }}" name="client[mobile]" id="input-name" type="phone" placeholder="Teléfono Movil" value="{{ $client->mobile}}" required="true" aria-required="true"/>
                        @if ($errors->has('client[mobile]'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('client[mobile]') }}</span>
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
                        <input class="form-control{{ $errors->has('address[street]') ? ' is-invalid' : '' }}" name="address[street]" id="input-name" type="text" placeholder="Calle" value="{{ $address->street }}" required="true" aria-required="true"/>
                        @if ($errors->has('address[street]'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('address[street]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                        <label class="col-sm-2 col-form-label">Entre</label>
                        <div class="col-sm-7">
                            <div class="form-group{{ $errors->has('address[between]') ? ' has-danger' : '' }}">
                            <input class="form-control{{ $errors->has('address[between]') ? ' is-invalid' : '' }}" name="address[between]" id="input-name" type="text" placeholder="Entre" value="{{ $address->between }}" required="true" aria-required="true"/>
                            @if ($errors->has('address[between]'))
                                <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('address[between]') }}</span>
                            @endif
                            </div>
                        </div>
                    </div>

                <div class="row">
                    <label class="col-sm-2 col-form-label">Número</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('address[number]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('address[number]') ? ' is-invalid' : '' }}" name="address[number]" id="input-name" type="text" placeholder="Número" value="{{ $address->number }}" required="true" aria-required="true"/>
                        @if ($errors->has('address[number]'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('address[number]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Apartamento</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('address[apartment]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('address[apartment]') ? ' is-invalid' : '' }}" name="address[apartment]" id="input-name" type="text" placeholder="Apartamento" value="{{ $address->apartment }}" required="true" aria-required="true"/>
                        @if ($errors->has('address[apartment]'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('address[apartment]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Ciudad</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('address[id_city]') ? ' has-danger' : '' }}">
                        <select class="form-control{{ $errors->has('address[id_city]') ? ' is-invalid' : '' }}" name="address[apartment]" id="input-name" placeholder="Ciudad" aria-required="true">

                        </select>
                        @if ($errors->has('address[id_city]'))
                            <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('address[id_city]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                {{--<div class="row">--}}
                  {{--<label class="col-sm-2 col-form-label">{{ __('Email') }}</label>--}}
                  {{--<div class="col-sm-7">--}}
                    {{--<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">--}}
                      {{--<input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required />--}}
                      {{--@if ($errors->has('email'))--}}
                        {{--<span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>--}}
                      {{--@endif--}}
                    {{--</div>--}}
                  {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                  {{--<label class="col-sm-2 col-form-label" for="input-password">{{ __(' Password') }}</label>--}}
                  {{--<div class="col-sm-7">--}}
                    {{--<div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">--}}
                      {{--<input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" input type="password" name="password" id="input-password" placeholder="{{ __('Password') }}" value="" required />--}}
                      {{--@if ($errors->has('password'))--}}
                        {{--<span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('password') }}</span>--}}
                      {{--@endif--}}
                    {{--</div>--}}
                  {{--</div>--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                  {{--<label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirm Password') }}</label>--}}
                  {{--<div class="col-sm-7">--}}
                    {{--<div class="form-group">--}}
                      {{--<input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirm Password') }}" value="" required />--}}
                    {{--</div>--}}
                  {{--</div>--}}
                {{--</div>--}}
              {{--</div>--}}
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
