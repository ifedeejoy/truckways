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
            <p class="text-center"><b>Login!</b></p>
            <form action="{{ route('login-driver') }}" method="POST" class="mt-5">
                @csrf
                <div class="col mb-3">
                    <label for="phone">Phone</label>
                    <input type="number" inputmode="numeric" class="form-control primary-text " name="phone" id="phone" value="{{ old('phone') }}" required autocomplete="off" autofocus>
                    
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
                
                @if(is_string($errors))
                    <div class="alert alert-danger">
                        <ul>
                            <li>{{ $errors }}</li>
                        </ul>
                    </div>
                @elseif ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
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
