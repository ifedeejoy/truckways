@extends('layouts.users.app')
@section('title', 'Dashboard')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary">
                <h4 class="text-white">Load Details</h6>
            </div>
            <div class="col-sm-12 p-4">
                <h6 class="black-text bold">TWY{{$load->reference}}</h6>
                <div class="row d-flex justify-content-around">
                    <div class="mb-4 gray-card col-sm-5">
                        <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                            <h6 class="primary-text small-text bold">Load Details</h6>
                        </div>
                        <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                            <h6 class="black-text small-text bold">Title</h6>
                            <h6 class="gray-text small-text">{{$load->title}}</h6>
                        </div>
                        <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                            <h6 class="black-text small-text bold">Load description</h6>
                            <h6 class="gray-text small-text">{{$load->description}}</h6>
                        </div>
                        <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                            <h6 class="black-text small-text bold">Pickup address</h6>
                            <h6 class="gray-text small-text">{{$load->pickup}}</h6>
                        </div>
                        <div class="d-flex flex-row w-100 mb-4 justify-content-between">
                            <h6 class="black-text small-text bold">Delivery address</h6>
                            <h6 class="gray-text small-text">{{$load->delivery}}</h6>
                        </div>
                        <h6 class="primary-text bold small-text mb-3">Images</h6>
                        <div class="text-center mb-3">
                            
                            <div class="row mt-4">
                                @foreach (json_decode($load->images) as $image)
                                <div class='preview-card'>
                                    <img class='banner-form-preview' src="{{asset($image)}}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="gray-card mb-4">
                        <div class="d-flex justify-content-between">
                            <div class="col-sm-9 mt-5">
                                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                                    <h6 class="primary-text small-text bold">Driver Details</h6>
                                </div>
                                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                                    <h6 class="black-text small-text bold">Name</h6>
                                    <h6 class="gray-text">{{$load->name}}</h6>
                                </div>
                                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                                    <h6 class="black-text small-text bold">Phone Number</h6>
                                    <h6 class="gray-text">{{$load->phone}}</h6>
                                </div>
                                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                                    <h6 class="black-text small-text bold">License Number</h6>
                                    <h6 class="gray-text">{{$load->idNumber}}</h6>
                                </div>
                                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                                    <h6 class="black-text small-text bold">Address</h6>
                                    <h6 class="gray-text">{{$load->address}}</h6>
                                </div>
                                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                                    <h6 class="black-text small-text bold">Registered Trucks</h6>
                                    <h6 class="gray-text">{{$load->trucks}}</h6>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="text-center">
                                    @if (empty($load->image))
                                    <img class="rounded-circle z-depth-1 img-fluid profile-img p-2" src="/images/user-dark.svg" alt="">
                                    @else
                                    <img class="z-depth-1 img-fluid profile-img p-2" src="{{asset($load->image)}}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            @if ($load->load_type > 0)
            <div class="gray-card">
                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                    <h6 class="primary-text small-text bold">Tracking</h6>
                </div>
                <div class="progress" style="height: 30px; border-radius: 18px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary text-right" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                        <h5 class="mt-2 mr-3"><i class="fas fa-check-circle"></i></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="p-3 mb-2 text-center ml-2 mr-5">
                        <h6 class="black-text smaller-text bold">Requested</h6>
                        <h6 class="gray-text smaller-text">{{date("Y-m-d", strtotime($load->created_at))}}</h6>
                        <h6 class="gray-text smaller-text">{{date("H:i", strtotime($load->created_at))}}</h6>
                    </div>
                    <div class="p-3 mb-2 text-center mr-5">
                        <h6 class="black-text smaller-text bold">Bidded</h6>
                        <h6 class="gray-text smaller-text">{{date("Y-m-d", strtotime($load->bid_at))}}</h6>
                        <h6 class="gray-text smaller-text">{{date("H:i", strtotime($load->bid_at))}}</h6>
                    </div>
                    <div class="p-3 mb-2 text-center mr-5">
                        <h6 class="black-text smaller-text bold">Bid Accepted</h6>
                        <h6 class="gray-text smaller-text">{{date("Y-m-d", strtotime($load->accepted_at))}}</h6>
                        <h6 class="gray-text smaller-text">{{date("H:i", strtotime($load->accepted_at))}}</h6>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection