@extends('layouts.agents.app')
@section('title', 'Dashboard')
@section('content')
    
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary">
                <h4 class="text-white">Update Profile</h6>
            </div>
            <div class="noshadow-card justify-content-center w-100">
                <div class="shadow-card w-60">
                    <div class="p-2 d-flex justify-content-center">
                        <div class="d-flex justify-content-center">
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
                    </div>
                    <div class="mt-5 d-flex justify-content-between">
                        <h6 class="small-text">{{$agent->address}}</h6>
                        <h6 class="small-text">{{$agent->phone}}</h6>
                    </div>
                    <hr class="dark-hr">
                    <form action="{{route('agent-edit', $agent->id)}}" method="post" class="mt-5" enctype="multipart/form-data">
                        @csrf
                        <div class="col mb-4">
                            <div class="md-form mt-0">
                                <input type="text" name="account_number" id="account_number" class="form-control">
                                <label for="">Account Number</label>
                            </div>
                        </div>
                        <div class="col mb-4">
                            <div class="md-form mt-0">
                                <input type="text" name="bank" id="bank" class="form-control">
                                <label for="">Bank</label>
                            </div>
                        </div>
                        <div class="col mb-4">
                            <div class="md-form mt-5">
                                <div class="d-flex justify-content-around">
                                    <h6 class="small-text mt-3">Profile Picture</h6>
                                    <input type="file" name="profilePicture" class="file-input truck-file w-60" accept="image/*">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-md btn-rounded">Update</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
@endsection