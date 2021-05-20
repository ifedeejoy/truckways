<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ config('app.name') }} - @yield('title')</title>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
        <link rel="stylesheet" href="/css/app.css">
        <link rel="stylesheet" href="/css/main.css">
    </head>
    <body>
        <main>
    
            <div class="login-banner">
                <div class="login-left mt-2">
                    <h4 class="welcome-text login-welcome-text">You're almost there!
                        <br> Let's Go!</h4>
                    <img src="/images/illus.png" class="login-banner-img" alt="Delivery Van Being Loaded">
                </div>
                <div class="login-right mt-0">
                    <div class="login-form bg-white">
                        <p class="text-center"><b>Continue Registration!</b></p>
                        <form action="{{ route('finish-post') }}" method="POST" class="mt-5">
                            @csrf
                            <div class="col mb-3">
                                <label for="title">Load Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="col mb-3">
                                <label for="description">Load description</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                            <div class="col mb-4">
                                <label for="title">Estimated value of goods</label>
                                <input type="number" name="value" class="form-control">
                            </div>
                            <div class="col mb-4">
                                <select class="custom-select form-control" name="truck_type" id="truck-type" onchange="otherTrucks(this.value)">
                                    <option>Truck type</option>
                                    <option value="15 Tonnes Flatbeds">15 Tonnes Flatbeds</option>
                                    <option value="20 Tonnes Flatbeds">20 Tonnes Flatbeds</option>
                                    <option value="40 Tonnes Flatbeds">40 Tonnes Flatbeds</option>
                                    <option value="15 Tonnes Sided Body Trucks">15 Tonnes Sided Body Trucks</option>
                                    <option value="20 Tonnes Sided Body Trucks">20 Tonnes Sided Body Trucks</option>
                                    <option value="30 Tonnes Sided Body Trucks">30 Tonnes Sided Body Trucks</option>
                                    <option value="40 Tonnes Sided Body Trucks">40 Tonnes Sided Body Trucks</option>
                                    <option value="60 Tonnes Sided Body Trucks">60 Tonnes Sided Body Trucks</option>
                                    <option value="5 Tonnes Covered Body Trucks">5 Tonnes Covered Body Trucks</option>
                                    <option value="10 Tonnes Covered Body Trucks">10 Tonnes Covered Body Trucks</option>
                                    <option value="15 Tonnes Covered Body Trucks">15 Tonnes Covered Body Trucks</option>
                                    <option value="20 Tonnes Covered Body Trucks">20 Tonnes Covered Body Trucks</option>
                                    <option value="30 Tonnes Covered Body Trucks">30 Tonnes Covered Body Trucks</option>
                                    <option value="40 Tonnes Covered Body Trucks">40 Tonnes Covered Body Trucks</option>
                                    <option value="60 Tonnes Covered Body Trucks">60 Tonnes Covered Body Trucks</option>
                                    <option value="vans">Vans</option>
                                    <option value="mini-vans">Mini Vans</option>
                                    <option value="tippers">Tippers</option>
                                    <option value="others">Other (please specify)</option>
                                </select>
                            </div>
                            <div class="col mb- d-none" id="other-trucks">
                                <label for="title">Truck type</label>
                                <input type="text" name="truck_type" id="other-truck" class="form-control" disabled>
                            </div>
                            <div class="col mb-3">
                                <label for="budget">Your budget</label>
                                <input type="text" name="budget" class="form-control">
                            </div>
                            <div class="col mb-3">
                                <label for="title">Your email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="col mb-3">
                                <label>Choose a password (min of 8 characters)</label>
                                <input id="password" type="password" class="form-control primary-text @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col mb-3">
                                <label for="password-confirm">Confirm your password</label>
                                <input id="password-confirm" type="password" class="form-control primary-text" name="password_confirmation" required autocomplete="new-password">
                                
                            </div>
                            <div class="col mb-4">
                                <h6>Post Load As</h6>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-secondary btn-sm btn-rounded active">
                                        Basic 
                                        <input type="radio" name="load_type" value="0" id="load-type" onclick="loadType(this.value)" autocomplete="off" checked>
                                    </label>
                                    <label class="btn btn-secondary btn-sm btn-rounded">
                                        Premium 
                                        <input type="radio" name="load_type" value="1" id="load-type" onclick="loadType(this.value)" autocomplete="off">
                                    </label>
                                </div>
                                <div id="basic" class="mt-3">
                                    <h6 class="small-text">When you post as basic</h6>
                                    <ul>
                                        <li class="smaller-text">Your load is put on the market place</li>
                                        <li class="smaller-text">Drivers may not be verified by truckways</li>
                                        <li class="smaller-text">Your load is not protected by Truckways GIT</li>
                                    </ul>
                                </div>
                                <div id="premium" class="mt-3 d-none">
                                    <h6 class="small-text">When you post as premium</h6>
                                    <ul>
                                        <li class="smaller-text">Your load is put on the market place without your personal details</li>
                                        <li class="smaller-text">Only drivers verified by truckways can bid</li>
                                        <li class="smaller-text">Your load is protected by Truckways GIT</li>
                                        <li class="smaller-text">You automatic notification of bids for your load</li>
                                        <li class="smaller-text">You can track the progress of your load</li>
                                    </ul>
                                    <ul>
                                        <li class="smaller-text">
                                            Insurance Cost
                                            <ul>
                                                <li class="smaller-text">Below 100k - 1%</li>
                                                <li class="smaller-text">Below 500k - 2%</li>
                                                <li class="smaller-text">Below 1M - 3.5%</li>
                                                <li class="smaller-text">Below 5M - 5%</li>
                                                <li class="smaller-text">5M & above - 10%</li>
                                            </ul>
                                        </li>
                                    </ul>
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
                            <div class="text-center mb-3">
                                <button type="submit" class="long-btn waves-effect waves-dark p-2">Post Load</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </body>
    <script src="/js/app.js" defer></script>
    <script src="/js/mdb.min.js" defer></script>
    <script>
        function otherTrucks(val)
        {
            if(val == "others"){
                $("#truck-type").removeAttr("name")
                $("#other-trucks").removeClass("d-none")
                $("#other-truck").attr("disabled", false)
            }else{
                $("#truck-type").attr("name", "truck_type")
                $("#other-trucks").addClass("d-none")
                $("#other-truck").attr("disabled", true)
            }
        }
        function loadType(val)
        {
            if(val == 0){
                $("#premium").addClass("d-none")
                $("#basic").removeClass("d-none")
            }
            else{
                $("#premium").removeClass("d-none")
                $("#basic").addClass("d-none")
            }
        }
    </script>
</html>
