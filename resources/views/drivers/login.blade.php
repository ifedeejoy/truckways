@extends('layouts.drivers.app')
@section('title', 'Driver Signup')
@section('content')
    
<div class="login-banner">
    <div class="login-left mt-2">
        <h4 class="welcome-text login-welcome-text">Get trucks, Move stuffs, <br> Live Simple.</h4>
        <img src="/images/illus.png" class="login-banner-img" alt="Delivery Van Being Loaded">
    </div>
    <div class="login-right mt-0">
        <div class="login-form bg-white">
            <p class="text-center"><b>Signup !</b></p>
            <form action="{{ route('login-driver') }}" method="POST" class="mt-5">
                @csrf
                <div class="col mb-3">
                    <label for="email">E-Mail Address'</label>
                    <input type="email" class="form-control primary-text " name="email" id="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                    
                </div>
                <div class="col mb-3">
                    <label>{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control primary-text" name="password" required autocomplete="new-password">
                    
                </div>

                <div class="text-center mb-3">
                    <button type="submit" class="long-btn waves-effect waves-dark p-2">
                        {{ __('login') }}
                    </button>
                </div>

                @if (count($errors))
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                @endif
                <div class="login-liner mt-2"></div>
                <div class="text-center mb-4 mt-4">
                    <a href="/drivers/register" class="btn-primary-outline">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
