@extends('layouts.admin.app')
@section('title', 'Driver Profile')
@section('content')
    
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary">
                <h4 class="text-white">{{$driver->name}}'s Profile</h6>
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
                                <h6 class="bold">{{$driver->name}} @if ($verification != null && $verification->status != 'pending')<i class="fas fa-check-circle primary-text"></i>@endif</h6>
                                <h6 class="extra-muted small-text">{{$driver->email}}</h6>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <form action="{{route('delete-driver', $driver->id)}}" method="post">
                                @csrf
                                <button type="submit" class="black-text bg-transparent border-0"><i class="far fa-trash-alt fa-1x"></i></button>
                            </form>
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
                            <h6 class="bold">Bank</h6>
                            <h6 class="smaller-text">{{$driver->bank}}</h6>
                        </div>
                        <div class="text-center">
                            <h6 class="bold">Account Number</h6>
                            <h6 class="smaller-text">{{$driver->account_number}}</h6>
                        </div>
                    </div>
                    <hr class="dark-hr">
                    <div class="d-flex justify-content-between">
                        <div class="text-center">
                            <h6 class="bold">Bids Won</h6>
                            <h6 class="smaller-text">{{$bidCount}}</h6>
                        </div>
                        <div class="text-center">
                            <h6 class="bold">Trucks Registered</h6>
                            <h6 class="smaller-text">{{$driver->trucks}}</h6>
                        </div>
                    </div>
                    <hr class="dark-hr">
                    <div class="p-3 mb-3">
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
                    <hr class="dark-hr">
                    @if ($verification != null && $verification->status == 'pending')
                    <div class="d-flex justify-content-between">
                        <form method="post" action="{{route('verify-driver', $driver->id)}}" id="approve-request">
                            @csrf
                            <input type="hidden" name="decision" value="approved">
                            <button class="btn btn-lg btn-success" type="submit" form="approve-request">Accept Request</button>
                        </form>
                        <form method="post" action="{{route('verify-driver', $driver->id)}}" id="decline-request">
                            @csrf
                            <input type="hidden" name="decision" value="approved">
                            <button class="btn btn-lg btn-danger" type="submit" form="decline-request">Decline Request</button>
                        </form>
                    </div> 
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection