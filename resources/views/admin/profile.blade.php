@extends('layouts.users.app')
@section('title', 'Dashboard')
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
                                <img class="rounded-circle z-depth-1 img-fluid profile-img p-3" src="/images/user-dark.svg" alt="">
                            </div>
                            <div class="mt-5 ml-5">
                                <h6 class="bold">{{$user->name}}</h6>
                                <h6 class="extra-muted small-text">{{$user->email}}</h6>
                                <h6 class="extra-muted small-text">{{$user->phone}}</h6>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                           <a href="/users/edit-profile" class="black-text"><i class="fas fa-pencil-alt fa-1x"></i></a>
                        </div>
                    </div>
                    <hr class="dark-hr">
                    <div class="d-flex justify-content-between">
                        <div class="text-center">
                            <h6 class="bold">Load Requests</h6>
                            <h6 class="smaller-text">{{$loads}}</h6>
                        </div>
                        <div class="text-center">
                            <h6 class="bold">Open Requests</h6>
                            <h6 class="smaller-text">{{$open}}</h6>
                        </div>
                        <div class="text-center">
                            <h6 class="bold">Active Requests</h6>
                            <h6 class="smaller-text">{{$active}}</h6>
                        </div>
                        <div class="text-center">
                            <h6 class="bold">Closed Requests</h6>
                            <h6 class="smaller-text">{{$closed}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection