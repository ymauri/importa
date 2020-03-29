@extends('layouts.app', ['activePage' => 'city-management', 'titlePage' => __('User Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="get" action="{{ route('store_city') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('get')

            <div class="card ">
              <div class="card-header card-header-info">
                <h4 class="card-title">Añadir ciudad</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">

                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">Elige el país</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('address[id_city]') ? ' has-danger' : '' }}">
                    <select  class="form-control {{ $errors->has('address[id_city]') ? ' is-invalid' : '' }}" name="id_country" type="text" placeholder="Escriba la ciudad ..."  required="required" aria-required="true" id="select_country">
                        @if( !empty($address->city->state->nam) )
                            <option value='{{ $address->city->state->id_state }}'> {{ $address->city->state->country->name  }}</option>
                        @else
                            <option value=""></option>
                        @endif

                    </select>
                    @if ($errors->has('address[id_city]'))
                        <span id="name-error" class="error text-danger">{{ $errors->first('address[id_city]') }}</span>
                    @endif
                    </div>
                </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label" for="input-password-confirmation">Elige el estado</label>
                    <div class="col-sm-7">
                      <div class="form-group">
                        <select  class="form-control " name="id_state" type="text" required="required" aria-required="true" id="select_state" disabled = "disabled">
                        </select>
                      </div>
                  </div>
                  </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Ciudad</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('address[street]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('address[street]') ? ' is-invalid' : '' }}" name="name_city" type="text" value="" required = 'required'/>
                        @if ($errors->has('address[street]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('address[street]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-info">Aceptar</button>
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
    <script src="{{asset('js/country.js')}}" type="text/javascript"></script>
@endpush
