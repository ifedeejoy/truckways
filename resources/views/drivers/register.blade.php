@extends('layouts.drivers.app')
@section('title', 'Driver Signup')
@section('content')
    
<div class="login-banner reg-banner">
    <div class="login-left mt-2">
        <h4 class="welcome-text login-welcome-text reg-text">Pick up loads and get more loads on
            <br> your return trips now!</h4>
        <img src="https://res.cloudinary.com/ifedeejoy/image/upload/v1593688512/illus_upwhlp.png" class="login-banner-img" alt="Delivery Van Being Loaded">
    </div>
    <div class="login-right mt-0">
        <div class="login-form bg-white">
            <p class="text-center"><b>Signup !</b></p>
            <form action="{{ route('register-driver') }}" method="POST" class="mt-5">
                @csrf
                <div class="col mb-3">
                    <label for="name">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control primary-text @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                    
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col mb-3">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input type="email" class="form-control primary-text @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                    
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col mb-3">
                    <label for="phone">{{ __('Phone Number') }}</label>
                    <input type="phone" class="form-control primary-text @error('phone') is-invalid @enderror" name="phone" id="phone" value="{{ old('phone') }}" required autocomplete="off" autofocus>
                    
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col mb-3">
                    <label for="address">{{ __('Address') }}</label>
                    <input type="address" class="form-control primary-text @error('address') is-invalid @enderror" name="address" id="address" value="{{ old('address') }}" required autocomplete="off" autofocus>
                    
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="col mb-3">
                    <label>{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control primary-text @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="col mb-3">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control primary-text" name="password_confirmation" required autocomplete="new-password">
                    
                </div>

                <div class="text-center mb-3">
                    <button type="submit" class="long-btn waves-effect waves-dark p-2">
                        {{ __('Register') }}
                    </button>
                </div>

                <div class="login-liner mt-2"></div>
                <div class="text-center mb-4 mt-4">
                    <a href="/login" class="btn-primary-outline">Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
