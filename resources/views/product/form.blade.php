@extends('layouts.app', ['activePage' => 'product', 'titlePage' => 'Prodcuto'])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="@if(isset($edit)) {{ route('product.update') }} @else {{ route('product.create') }} @endif" autocomplete="off" class="form-horizontal">
            @csrf
            @method('post')
            <input type="hidden" name="product[id]" value="{{ $product->id }}">
            <div class="card ">
              <div class="card-header card-header-info">
                <h4 class="card-title">{{ __('Crear producto') }}</h4>
                <p class="card-category"></p>
              </div>
              <div class="card-body ">
                <div class="row">
                  <div class="col-md-12 text-right">
                      <a href="{{ route('product.index') }}" class="btn btn-sm btn-info">{{ __('Ir al listado') }}</a>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">Nombre</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('product[name]') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('product[name]') ? ' is-invalid' : '' }}" name="product[name]" type="text" placeholder="Nombre" value="{{ $product->name }}" required="true" aria-required="true"/>
                      @if ($errors->has('product[name]'))
                        <span id="name-error" class="error text-danger">{{ $errors->first('product[name]') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Modelo</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('product[model]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('product[model]') ? ' is-invalid' : '' }}" name="product[model]" type="text" placeholder="Modelo" value="{{ $product->model }}" required="true" aria-required="true"/>
                        @if ($errors->has('product[model]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('product[model]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Marca</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('product[brand]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('product[brand]') ? ' is-invalid' : '' }}" name="product[brand]" type="text" placeholder="Marca" value="{{ $product->brand }}" required="true" aria-required="true"/>
                        @if ($errors->has('product[brand]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('product[brand]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Peso</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('product[weight]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('product[weight]') ? ' is-invalid' : '' }}" name="product[weight]" type="number" step="any" placeholder="Peso en kilogramos (Kg)" value="{{ $product->weight }}"/>
                        @if ($errors->has('product[weight]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('product[weight]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Volumen</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('product[volumen]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('product[volumen]') ? ' is-invalid' : '' }}" name="product[volumen]"  step="any" type="number" placeholder="Volumen en metros cúbicos (m3)" value="{{ $product->volumen }}" />
                        @if ($errors->has('product[volumen]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('product[volumen]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Precio unitario</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('product[price]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('product[price]') ? ' is-invalid' : '' }}" name="product[price]"  step="any" type="number" placeholder="Precio unitario (USD)" value="{{ $product->price }}"/>
                        @if ($errors->has('product[price]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('product[price]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Puntos aduanales</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('product[customs_points]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('product[customs_points]') ? ' is-invalid' : '' }}" name="product[customs_points]"  step="any" type="number" placeholder="Puntos aduanales" value="{{ $product->customs_points }}"/>
                        @if ($errors->has('product[customs_points]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('product[customs_points]') }}</span>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-2 col-form-label">Proveedor</label>
                    <div class="col-sm-7">
                        <div class="form-group{{ $errors->has('product[provider]') ? ' has-danger' : '' }}">
                        <input class="form-control{{ $errors->has('product[provider]') ? ' is-invalid' : '' }}" name="product[provider]"  step="any" type="text" placeholder="Proveedor del producto" value="{{ $product->provider }}"/>
                        @if ($errors->has('product[provider]'))
                            <span id="name-error" class="error text-danger">{{ $errors->first('product[provider]') }}</span>
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
