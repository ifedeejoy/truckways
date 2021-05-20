@extends('layouts.agents.app')
@section('title', 'My Profile')
@section('content')
    
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary">
                <h4 class="text-white">My Profile</h6>
            </div>
            <div class="noshadow-card justify-content-center w-100">
                <div class="shadow-card w-60">
                    <div class="p-2 d-flex justify-content-between">
                        <div class="d-flex justify-content-around">
                            <div class="text-center">
                                @if (empty($agent->image))
                                <img class="rounded-circle z-depth-1 img-fluid profile-img p-3" src="/images/user-dark.svg" alt="">
                                @else
                                <img class="rounded-circle z-depth-1 img-fluid profile-img p-3" src="{{asset($agent->image)}}" alt="">
                                @endif
                            </div>
                            <div class="mt-5 ml-5">
                                <h6 class="bold">{{$agent->name}}</h6>
                                <h6 class="extra-muted small-text">{{$agent->email}}</h6>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                           <a href="/agents/edit-profile" class="black-text"><i class="fas fa-pencil-alt fa-1x"></i></a>
                        </div>
                    </div>
                    <div class="mt-5 d-flex justify-content-between">
                        <h6 class="small-text">{{$agent->address}}</h6>
                        <h6 class="small-text">{{$agent->phone}}</h6>
                    </div>
                    <hr class="dark-hr">
                    <div class="d-flex justify-content-between">
                        <div class="text-center">
                            <h6 class="bold">Users Registered</h6>
                            <h6 class="smaller-text">{{$users}}</h6>
                        </div>
                        <div class="text-center">
                            <h6 class="bold">Drivers Registered</h6>
                            <h6 class="smaller-text">{{$drivers}}</h6>
                        </div>
                        <div class="text-center">
                            <h6 class="bold">Bank</h6>
                            <h6 class="smaller-text">{{$agent->bank}}</h6>
                        </div>
                        <div class="text-center">
                            <h6 class="bold">Account Number</h6>
                            <h6 class="smaller-text">{{$agent->account_number}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection