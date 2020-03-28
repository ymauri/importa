@extends('layouts.app', ['activePage' => 'city-management', 'titlePage' => __('City Management')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-info">
                <h4 class="card-title ">{{ __('Add City') }}</h4>
                <p class="card-category"> {{ __('Here you can manage cities') }}</p>
              </div>
              <div class="card-body">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <div class="col-12 text-right">
                    <a href="{{ route('city.create') }}" class="btn btn-sm btn-info">{{ __('Add city') }}</a>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12">
                        <input type="hidden" value="{{ $address->id_city }}" id="id_city">
                        <label class="col-sm-6 col-form-label">Compruebe que existe la ciudad</label>
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
                </div>

              </div>
            </div>
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
    <script src="{{asset('js/city.js')}}" type="text/javascript"></script>
@endpush
