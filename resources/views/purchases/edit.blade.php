@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit an instrument') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('purchase.update', $purchase) }}">
                        {{ method_field('PATCH') }}
                        @csrf

                        <div class="form-group row">
                            <label for="company_name" class="col-md-4 col-form-label text-md-right">{{ __('Commpany Name') }}</label>

                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name', $purchase->company_name) }}" autofocus>

                                @if ($errors->has('company_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="share_instrument_name" class="col-md-4 col-form-label text-md-right">{{ __('Share Instrument Name') }}</label>

                            <div class="col-md-6">
                                <input id="share_instrument_name" type="text" class="form-control{{ $errors->has('share_instrument_name') ? ' is-invalid' : '' }}" name="share_instrument_name" value="{{ old('share_instrument_name', $purchase->share_instrument_name) }}" autofocus>

                                @if ($errors->has('share_instrument_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('share_instrument_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="quantity" class="col-md-4 col-form-label text-md-right">{{ __('Quantity') }}</label>

                            <div class="col-md-6">
                                <input id="quantity" type="text" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}" name="quantity" value="{{ old('quantity', $purchase->quantity) }}" autofocus>

                                @if ($errors->has('quantity'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('quantity') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price" value="{{ old('price', $purchase->price) }}" autofocus>

                                @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('price') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="total_investment" class="col-md-4 col-form-label text-md-right">{{ __('Total Investment') }}</label>

                            <div class="col-md-6">
                                <div  id="total_investment" class="form-control"></div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="certificate_number" class="col-md-4 col-form-label text-md-right">{{ __('Certificate Number') }}</label>

                            <div class="col-md-6">
                                <input id="certificate_number" type="text" class="form-control{{ $errors->has('certificate_number') ? ' is-invalid' : '' }}" name="certificate_number" value="{{ old('certificate_number', $purchase->certificate_number) }}" autofocus>

                                @if ($errors->has('certificate_number'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('certificate_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update instrument') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
