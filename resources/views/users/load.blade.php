@extends('layouts.mainApp.app')
@section('title', 'Dashboard')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary">
                <h4 class="text-white">Load Details</h6>
            </div>
            <div class="col-sm-12 p-4">
                <div class="row d-flex justify-content-between">
                    <div class="gray-card col-sm-6 mb-4">
                        <div class="d-flex flex-row w-100 mb-5 justify-content-between">
                            <h6 class="gray-text bold">TWY{{$load->reference}}</h6>
                        </div>
                        <div class="col mb-4">
                            <label for="title">Title</label>
                            <h6 class="gray-text">{{$load->title}}</h6>
                        </div>
                        <div class="col mb-4">
                            <label for="description">Load description</label>
                            <h6 class="gray-text">{{$load->description}}</h6>
                        </div>
                        <div class="banner-upload text-center mb-3">
                            <h6 class="dark-bold mb-3">Load Images</h6>
                            <div class="row mt-4">
                                @foreach (json_decode($load->images) as $image)
                                <div class='preview-card'>
                                    <img class='banner-form-preview' src="{{asset($image)}}">
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <div class="gray-card col-sm-5 mb-4">
                        <h6 class="primary-text mb-5 bold">Booking Details</h6>
                        <div class="col mb-4">
                            <label for="title">Pickup address</label>
                            <h6 class="gray-text">{{$load->pickup}}</h6>
                        </div>
                        <div class="col mb-4">
                            <label for="title">Delivery address</label>
                            <h6 class="gray-text">{{$load->delivery}}</h6>
                        </div>
                        <div class="col mb-4">
                            <label for="title">Truck type</label>
                            <h6 class="gray-text text-capitalize">{{$load->truck_type}}</h6>
                        </div>
                        <div class="col mb-4">
                            <label for="budget">Your budget</label>
                            <h6 class="gray-text">{{number_format($load->budget)}}</h6>
                        </div>
                        <div class="col mb-4">
                            <h6>Posted As</h6>
                            @if ($load->load_type == 0)
                            <h6 class="gray-text">Basic</h6>
                            @else
                            <h6 class="gray-text">Premium</h6>
                            @endif
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
