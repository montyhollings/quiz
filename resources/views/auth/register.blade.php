@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-4 offset-2">
                                <div class="form-group">
                                    <label for="name" class="text-md-right">{{ __('First Name') }} <span class="required">*</span></label>
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="surname" class="text-md-right">{{ __('Surname') }} <span class="required">*</span></label>
                                    <input id="surname" type="text"
                                           class="form-control @error('surname') is-invalid @enderror" name="surname"
                                           value="{{ old('surname') }}" required autocomplete="surname" autofocus>

                                    @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 offset-2">
                                <div class="form-group">
                                    <label for="email" class="text-md-right">{{ __('Email Address') }} <span class="required">*</span></label>
                                    <input id="email" type="text"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4 offset-2">
                                <div class="form-group">
                                    <label for="password" class="text-md-right">{{ __('Password') }} <span class="required">*</span></label>


                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }} <span class="required">*</span></label>


                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                    @error('password-confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>
                            </div>
                        </div>





                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
