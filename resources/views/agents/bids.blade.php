@extends('layouts.agents.app')
@section('title', 'Bids')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options justify-content-center border-0">
                <ul class="nav nav-tabs">
                    <li class="p-4 pt-0 active">
                        <a class="bold small-text black-text" data-toggle="tab" href="#bids-won">Bids Won</a>
                    </li>
                    <li class="p-4 pt-0">
                        <a class="bold small-text black-text" data-toggle="tab" href="#pending-bids">Pending Bids</a>
                    </li>
                    <li class="p-4 pt-0">
                        <a class="bold small-text black-text" data-toggle="tab" href="#declined-bids">Declined Bids</a>
                    </li>
                    <li class="p-4 pt-0">
                        <a class="bold small-text black-text" data-toggle="tab" href="#">Archived Bids</a>
                    </li>
                </ul>
            </div>
            @if(session('success'))
            <div class="alert alert-success">
            {{ session('success') }}
            </div> 
            @endif
            <div class="tab-content">
                <div id="bids-won" class="tab-pane fadeIn active">
                    <div class="load-container">
                        @foreach ($bids as $bid)
                            @if ($bid->bid_status == 'accepted')
                            <div class="load-cards">
                                <div class="d-flex justify-content-between">
                                    <h5 class="load-title bold">{{$bid->title}}</h5>
                                    <h6 class="smaller-text text-center">{!! htmlspecialchars_decode(date('j<\s\up>S</\s\up> F Y', strtotime($bid->created_at))) !!}</h6>
                                </div>
                                <div class="d-flex justify-content-between text-center">
                                    <h6 class="smaller-text primary-text">{{$bid->pickup}}</h6>
                                    <h6 class="smaller-text primary-text">{{$bid->delivery}}</h6>
                                </div>
                                @foreach (json_decode($bid->images) as $image)
                                    @if($loop->first)
                                    <div class="text-center">
                                        <img src="{{asset($image)}}" class="w-75 h-75 img-fluid" alt="">
                                    </div>
                                        @break
                                    @endif
                                @endforeach
                                <div class="text-center mt-3">
                                    <h5 class="load-title bold mt-2">{{number_format($bid->budget)}}</h5>
                                    <p>{{Str::limit($bid->description,100)}}</p>
                                    @if ($bid->load_type > 0 && $bid->status == 'active')
                                    <form action="{{route('update-journey')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="load" value="{{$bid->load}}">
                                        <input type="hidden" name="event" value="heading to pickup">
                                        <input type="hidden" name="location" value="null">
                                        <input type="hidden" name="updatedBy" value="{{auth()->guard('truck_drivers')->user()->id}}">
                                        <button class="btn btn-sm btn-primary" type="submit">Start Journey</button>
                                    </form>
                                    @elseif($bid->load_type > 0 && $bid->status == 'started-journey')
                                    <form action="{{route('update-journey')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="load" value="{{$bid->load}}">
                                        <input type="hidden" name="event" value="items picked up">
                                        <input type="hidden" name="location" value="null">
                                        <input type="hidden" name="updatedBy" value="{{auth()->guard('truck_drivers')->user()->id}}">
                                        <button class="btn btn-sm btn-primary" type="submit">Pick Up Items</button>
                                    </form>
                                    @elseif($bid->load_type > 0 && ($bid->status == 'picked up' || $bid->status == 'in-progress'))
                                    <form action="{{route('update-journey')}}" method="post" id="update-location">
                                        @csrf
                                        <input type="hidden" name="load" value="{{$bid->load}}">
                                        <input type="hidden" name="event" value="updated location">
                                        <input type="hidden" name="updatedBy" value="{{auth()->guard('truck_drivers')->user()->id}}">
                                        <input type="text" class="form-control" name="location" placeholder="Your current location">
                                        <button class="btn btn-sm btn-primary" form="update-location" type="submit">Update Location</button>
                                    </form>
                                    <form action="{{route('update-journey')}}" method="POST" id="close-trip">
                                        @csrf
                                        <input type="hidden" name="load" value="{{$bid->load}}">
                                        <input type="hidden" name="event" value="completed">
                                        <input type="hidden" name="updatedBy" value="{{auth()->guard('truck_drivers')->user()->id}}">
                                        <input type="hidden" name="location" value="null">
                                        <button class="btn btn-sm btn-primary" form="close-trip" type="submit">End Trip</button>
                                    </form>
                                    @else
                                    <a class="btn btn-sm btn-primary" href="/drivers/load/{{$bid->id}}">View Load</a>
                                    @endif
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div id="pending-bids" class="tab-pane fade">
                    <div class="load-container">
                        @foreach ($bids as $bid)
                            @if ($bid->bid_status == 'pending')
                            <div class="load-cards">
                                <div class="d-flex justify-content-between">
                                    <h5 class="load-title bold">{{$bid->title}}</h5>
                                    <h6 class="smaller-text text-center">{!! htmlspecialchars_decode(date('j<\s\up>S</\s\up> F Y', strtotime($bid->created_at))) !!}</h6>
                                </div>
                                <div class="d-flex justify-content-between text-center">
                                    <h6 class="smaller-text primary-text">{{$bid->pickup}}</h6>
                                    <h6 class="smaller-text primary-text">{{$bid->delivery}}</h6>
                                </div>
                                @foreach (json_decode($bid->images) as $image)
                                    @if($loop->first)
                                    <div class="text-center">
                                        <img src="{{asset($image)}}" class="w-75 h-75 img-fluid" alt="">
                                    </div>
                                        @break
                                    @endif
                                @endforeach
                                <div class="text-center mt-3">
                                    <h5 class="load-title bold mt-2">{{number_format($bid->amount)}}</h5>
                                    <a class="btn btn-sm btn-primary" href="/agents/load/{{$bid->load}}">View Load</a>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div id="declined-bids" class="tab-pane fade">
                    <div class="load-container">
                        @foreach ($bids as $bid)
                            @if ($bid->bid_status == 'declined')
                            <div class="load-cards">
                                <div class="d-flex justify-content-between">
                                    <h5 class="load-title bold">{{$bid->title}}</h5>
                                    <h6 class="smaller-text text-center">{!! htmlspecialchars_decode(date('j<\s\up>S</\s\up> F Y', strtotime($bid->created_at))) !!}</h6>
                                </div>
                                <div class="d-flex justify-content-between text-center">
                                    <h6 class="smaller-text primary-text">{{$bid->pickup}}</h6>
                                    <h6 class="smaller-text primary-text">{{$bid->delivery}}</h6>
                                </div>
                                @foreach (json_decode($bid->images) as $image)
                                    @if($loop->first)
                                    <div class="text-center">
                                        <img src="{{asset($image)}}" class="w-75 h-75 img-fluid" alt="">
                                    </div>
                                        @break
                                    @endif
                                @endforeach
                                <div class="text-center mt-3">
                                    <h5 class="load-title bold mt-2">{{number_format($bid->budget)}}</h5>
                                    <p>{{Str::limit($bid->description,100)}}</p>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
	@parent
@endsection
