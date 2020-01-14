@extends('layouts.app', ['activePage' => 'client', 'titlePage' => __('Clientes')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('client.create') }}" autocomplete="off" class="form-horizontal">
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
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Nombre') }}" value="{{ old('name') }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Apellidos') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('last_name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Apellidos') }}" value="{{ old('last_name') }}" required="true" aria-required="true"/>
                      @if ($errors->has('last_name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
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