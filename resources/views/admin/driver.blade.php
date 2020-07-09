@extends('layouts.users.app')
@section('title', 'Dashboard')
@section('content')
@inject('user', 'App\Http\Controllers\LoadsController')
    
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary">
                <h4 class="text-white">Driver Profile</h6>
                <a href="javascript:history.back()" class="text-white">Go Back</a>
            </div>
            <div class="noshadow-card justify-content-center w-100">
                <div class="shadow-card w-60">
                    <div class="p-2 d-flex justify-content-center">
                        <div class="d-flex justify-content-around">
                            <div class="text-center">
                                @if (empty($driver->image))
                                <img class="rounded-circle z-depth-1 img-fluid profile-img p-3" src="/images/user-dark.svg" alt="">
                                @else
                                <img class="rounded-circle z-depth-1 img-fluid profile-img p-3" src="{{asset($driver->image)}}" alt="">
                                @endif
                            </div>
                            <div class="mt-5 ml-5">
                                <h6 class="bold">{{$driver->name}}</h6>
                                <h6 class="extra-muted small-text">{{$driver->email}}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5 d-flex justify-content-between">
                        <h6 class="small-text">{{$driver->address}}</h6>
                        <h6 class="small-text">{{$driver->phone}}</h6>
                    </div>
                    <hr class="dark-hr">
                    <div class="d-flex justify-content-between">
                        <div class="text-center">
                            <h6 class="bold">Drivers License</h6>
                            <h6 class="smaller-text">{{$driver->idNumber}}</h6>
                        </div>
                        <div class="text-center">
                            <h6 class="bold">Bids Won</h6>
                            <h6 class="smaller-text">{{$bids}}</h6>
                        </div>
                        <div class="text-center">
                            <h6 class="bold">Trucks Registered</h6>
                            <h6 class="smaller-text">{{$driver->trucks}}</h6>
                        </div>
                    </div>
                    <div class="shadow-card mt-3 p-3 mb-3">
                        <div class="text-center">
                            <h6 class="bold">Trucks</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            @foreach ($trucks as $truck)
                            <div class="text-center">
                                @foreach (json_decode($truck->images) as $image)
                                <div class="text-center">
                                    <img class="rounded-circle z-depth-1 img-fluid profile-img p-3" src="{{asset($image)}}" alt="">
                                </div>
                                @endforeach
                                <h6 class="smaller-text mt-2 bold">{{$truck->name}}</h6>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection