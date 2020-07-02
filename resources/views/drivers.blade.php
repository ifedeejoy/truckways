@extends('layouts.app')
@section('title', 'Explore Drivers')
@section('bg', 'https://res.cloudinary.com/ifedeejoy/image/upload/v1593688511/driver_wldyjt.png')
@section('page-title', 'Explore Drivers')
@section('page-caption', 'Check for the drivers on our platforms. They are verified and reliable.')
@section('content')

<section class="latest-loads animated fadeInUp delay-1s mt-5">
	<div class="container">
        <div class="login-form col-sm-4 mx-auto">
            <p class="text-center"><b>Login</b></p>
            <form method="POST" action="{{ route('drivers.login') }}" class="mt-5">
                @csrf
                <div class="md-form mb-3">
                    <img src="/images/username.svg" class="prefix" alt="Username Icon">
                    <input type="email" class="form-control" name="email" id="email" autocomplete="username">
                    <label for="email">Username Or Email</label>
                </div>
                <div class="md-form mb-5">
                    <img src="/images/password.svg" class="prefix" alt="Password Icon">
                    <input type="password" class="form-control" name="password" id="password" autcomplete="current-password">
                    <label for="password">Password</label>
                </div>
                <div class="text-center mb-5">
                    <button class="long-btn waves-effect waves-dark p-2">Login</button>
                </div>
                <div class="login-liner"></div>
                <h6 class="login-option">or</h6>
                <div class="text-center mb-4">
                    <button class="btn-primary-outline">Login With <i class="fab fa-google"></i></button>
                </div>
                <div class="text-center">
                    <a href="drivers/register" class="btn-primary-outline">Sign Up</a>
                </div>
            </form>
        </div>
	</div>
</section>
@endsection
@section('scripts')
	@parent
@endsection