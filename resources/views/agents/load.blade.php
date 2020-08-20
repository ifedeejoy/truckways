@extends('layouts.agents.app')
@section('title', 'Load')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary">
                <h4 class="text-white">Load Details</h4>
                @if (auth()->user()->name != $load->createdBy)
                    <a class="text-white" data-target="#driver-bid" data-toggle="modal"><i class="fas fa-plus"></i> New Bid</a>
                @endif
            </div>
            <div class="col-sm-12 p-4">
                @if(session('success'))
                <div class="alert alert-success">
                {{ session('success') }}
                </div> 
                @endif
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
            @if (auth()->user()->name == $load->createdBy)
                @if ($load->status == 'open')
                    @if (count($bids) > 0)
                    <div class="home-options bg-primary">
                        <h4 class="text-white">Bids</h6>
                    </div>
                    <div class="load-container">
                        @foreach ($bids as $bid)
                            <div class="load-cards">
                                <div class="d-flex justify-content-between">
                                    <h6 class="smaller-text text-center">{!! htmlspecialchars_decode(date('j<\s\up>S</\s\up> F Y', strtotime($bid->created_at))) !!}</h6>
                                </div>
                                <div class="d-flex justify-content-between text-center">
                                    <h6 class="smaller-text primary-text">{{$load->pickup}}</h6>
                                    <h6 class="smaller-text primary-text">{{$load->delivery}}</h6>
                                </div>
                                <div class="text-center mt-3">
                                    <h5 class="load-title bold">{{$bid->name}}</h5>
                                    <h5 class="load-title bold">{{$bid->phone}}</h5>
                                    <h5 class="load-title bold mt-2">{{number_format($bid->amount)}}</h5>
                                </div>
                                <div class="row">
                                    <form action="{{route('accept-bid', $bid->bid_id)}}" method="post">
                                        @csrf
                                        <input type="hidden" name="createdBy" value="{{auth()->user()->name}}">
                                        <button class="btn btn-success btn-sm">Accept Bid</button>
                                    </form>
                                    <a href="/agents/driver/{{$bid->driver}}" class="btn btn-primary btn-sm">View Driver</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endif
                @endif
            @endif
        </div>
    </div>
    <div class="modal fade" id="driver-bid" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Bid on behalf of driver</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <form action="{{route('agent-bid', $load->id)}}" method="post">
                        @csrf
                        <input type="hidden" name="createdBy" value="{{auth()->user()->name}}">
                        <div class="col-sm-12">
                            <select class="selectpicker" name="driver" data-live-search="true">
                                <option selected disabled>Select Driver</option>
                                @foreach ($drivers as $driver)
                                <option value="{{$driver->id}}" data-tokens="{{$driver->name}}">{{$driver->name}}</option>
                                @endforeach
                            </select>
                            <div class="md-form">
                                <input type="number" name="amount" id="bid">
                                <label for="bid">Bid Amount</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-md btn-primary rounded-btn">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
