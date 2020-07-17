@if(request()->is('/'))
<!--Carousel Wrapper-->
<div class="col-md-12 p-0 m-0 d-flex flex-column justify-content-center">
    <div id="carousel-example-2" class="carousel slide carousel-fade banner-carousel" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <div class="view">
                    <img class="d-block w-100" src="https://res.cloudinary.com/ifedeejoy/image/upload/v1593688514/home-banner_rskkgy.png" alt="First slide">
                    <div class="mask rgba-black-strong"></div>
                </div>
            </div>
            <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                    <img class="d-block w-100" src="https://res.cloudinary.com/ifedeejoy/image/upload/v1593688511/banner-2_pgdpdq.jpg" alt="Second slide">
                    <div class="mask rgba-black-strong"></div>
                </div>
            </div>
            <div class="carousel-item">
                <!--Mask color-->
                <div class="view">
                    <img class="d-block w-100" src="https://res.cloudinary.com/ifedeejoy/image/upload/v1593688512/banner-3_u6nndf.jpg" alt="Third slide">
                    <div class="mask rgba-black-strong"></div>
                </div>
            </div>
        </div>
        <!--/.Slides-->
    </div>
    <div class="container banner-content">
        <div class="row animated fadeIn">
            <div class="col-md-8 mb-4 white-text text-center text-md-left">
                <div class="mt-40">
                    <h4 class="welcome-text">Hire Trucks with ease, <br> Move Your Products Quick!</h4>
                    <p><strong>With Truckways, hiring trucks have never been easier!</strong></p>
                    <a href="#" onclick="focusElement()" class="btn btn-rounded btn-primary btn-md waves-effect waves-dark banner-cta">Get Started</a>
                </div>
            </div>
            <div class="col-md-4 col-xl-4 mt-5 mb-4">
                <div class="banner-form">
                    <h6 class="banner-txt mb-4">Hire A Driver Now</h6>
                    <form action="{{route('post-load')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><img src="/images/user.svg" class="img-fluid form-icons" alt="User Icon"></span>
                            </div>
                            <input type="text" name="name" id="user-name" class="form-control banner-input" placeholder="Full Name" aria-label="Full Name" aria-describedby="basic-addon1">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><img src="/images/telephone.svg" class="img-fluid form-icons" alt="Phone Icon"></span>
                            </div>
                            <input type="text" name="phone" class="form-control banner-input" placeholder="Phone Number" aria-label="Phone Number" aria-describedby="basic-addon2">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3"><img src="/images/location.svg" class="img-fluid form-icons" alt="Location Icon"></span>
                            </div>
                            <input type="text" name="pickup" class="form-control banner-input" placeholder="Enter Pickup Location" aria-label="Enter Pickup Location" aria-describedby="basic-addon3">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon4"><img src="/images/location.svg" class="img-fluid form-icons" alt="Location Icon"></span>
                            </div>
                            <input type="text" name="destination" class="form-control banner-input" placeholder="Enter Destination" aria-label="Enter Destination" aria-describedby="basic-addon4">
                        </div>
                        <div class="banner-upload text-center mb-3">
                            <h6 class="dark-bold mb-2 small-text">Upload images of goods</h6>
                            <div class="align-self-center">
                                <input type="file" name="loadImages[]" id="fileUpload" class="file-input banner-file" onChange='getfileInfo(event)' accept="image/*" multiple>
                            </div>
                            <div class="row" id="previewUploads">
    
                            </div>
                        </div>
                        @if (session('error'))
                        <div class="alert alert-danger mt-3">
                            {{ session('error') }}
                        </div>
                        @elseif(session('success'))
                        <div class="alert alert-success mt-3">
                            {{ session('success') }}
                        </div> 
                        @endif
                        <div class="text-center mb-5">
                            <button class="long-btn waves-effect waves-dark p-2" type="submit">Continue</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!--/.Carousel Wrapper-->
@elseif(request()->is('login'))
<div class="login-banner">
    <div class="login-left">
        <h4 class="welcome-text login-welcome-text">Get trucks, Move stuffs, <br> Live Simple.</h4>
        <img src="https://res.cloudinary.com/ifedeejoy/image/upload/v1593688512/illus_upwhlp.png" class="login-banner-img" alt="Delivery Van Being Loaded">
    </div>
    <div class="login-right">
        <div class="login-form">
            <p class="text-center"><b>Login</b></p>
            <form action="{{ route('login') }}" method="POST" class="mt-5">
                @csrf

                <div class="md-form login-input mb-3">
                    <img src="/images/username.svg" class="prefix" alt="Username Icon">
                    <input type="email" class="form-control primary-text @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form login-input mb-5">
                    <img src="/images/password.svg" class="prefix" alt="Password Icon">
                    <input id="password" type="password" class="form-control primary-text @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <label for="password">Password</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <div class="col text-center">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>
                <div class="text-center mb-5">
                    <button type="submit" class="long-btn waves-effect waves-dark p-2">
                        {{ __('Login') }}
                    </button>
                </div>

                <div class="login-liner"></div>
                <h6 class="login-option">or</h6>
                <div class="text-center mb-4">
                    <a href="/register" class="btn-primary-outline">Sign Up</a>
                    @if (Route::has('password.request'))
                        <a class="btn btn-none mt-4" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@elseif(request()->is('register'))
<div class="login-banner">
    <div class="login-left">
        <h4 class="welcome-text login-welcome-text">Get trucks, Move stuffs, <br> Live Simple.</h4>
        <img src="https://res.cloudinary.com/ifedeejoy/image/upload/v1593688512/illus_upwhlp.png" class="login-banner-img" alt="Delivery Van Being Loaded">
    </div>
    <div class="login-right">
        <div class="login-form">
            <p class="text-center"><b>Signup !</b></p>
            <form action="{{ route('register') }}" method="POST" class="mt-5">
                @csrf
                <div class="md-form login-input mb-3">
                    <img src="/images/username.svg" class="prefix" alt="Username Icon">
                    <input id="name" type="text" class="form-control primary-text @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" autofocus>
                    <label for="name">{{ __('Name') }}</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="md-form login-input mb-3">
                    <img src="/images/username.svg" class="prefix" alt="Username Icon">
                    <input type="email" class="form-control primary-text @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="off" autofocus>
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md-form login-input mb-3">
                    <img src="/images/password.svg" class="prefix" alt="Password Icon">
                    <input id="password" type="password" class="form-control primary-text @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <label>{{ __('Password') }}</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="md-form login-input mb-3">
                    <img src="/images/password.svg" class="prefix" alt="Password Icon">
                    <input id="password-confirm" type="password" class="form-control primary-text" name="password_confirmation" required autocomplete="new-password">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                </div>

                <div class="text-center mb-5">
                    <button type="submit" class="long-btn waves-effect waves-dark p-2">
                        {{ __('Register') }}
                    </button>
                </div>

                <div class="login-liner"></div>
                <div class="text-center mb-4 mt-5">
                    <a href="/login" class="btn-primary-outline">Login</a>
                </div>
            </form>
        </div>
    </div>
</div>
@else
<div class="quarter-page-intro mt-5" style="background: url(@yield('bg'))">
    <div class="quarter-mask">
        <h4 class="page-title">@yield('page-title')</h4>
        <p class="page-caption">@yield('page-caption')</p>
    </div>
</div>
@endif