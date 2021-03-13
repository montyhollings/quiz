@extends('layouts.app')

@section('content')
    <form method="POST" action="{{$formurl}}">
        @csrf
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">@if($type == "edit") Edit @else Create @endif User</div>
                    @if($type == "edit")
                        <input type="hidden" id="userid" name="userid" value="{{$user->id}}">
                    @endif

                    <div class="card-body">

                            <div class="row">
                                <div class="col-4 offset-2">
                                    <div class="form-group">
                                        <label for="first_name" class="text-md-right">{{ __('First Name') }} <span class="required">*</span></label>
                                        <input id="first_name" type="text"
                                               class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                               value="{{ $user->first_name ?? old('first_name') }}" required autocomplete="first_name" autofocus>

                                        @error('first_name')
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
                                               value="{{ $user->surname ?? old('surname') }}" required autocomplete="surname" autofocus>

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
                                               value="{{ $user->email ?? old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-4 ">
                                    <div class="form-group">
                                        <label for="role_select" class="text-md-right">{{ __('Role') }} <span class="required">*</span></label>
                                        <select name="role_select" id="role_select" class=" form-control @error('role') is-invalid @enderror">
                                            @foreach($roles as $role)
                                                <option @if($role == strtolower($user->user_roles)) selected @endif value="{{$role}}">{{$role}}</option>
                                            @endforeach
                                        </select>

                                        @error('role')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                            @if($type == "add")
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
                            @endif

                    </div>
                    <div class="card-footer">
                        <button  class="btn btn-success float-right" type="submit">@if($type == "edit") Save @else Create @endif</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
@endsection
