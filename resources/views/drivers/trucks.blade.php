@extends('layouts.drivers.app')
@section('title', 'Loads')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options border-primary justify-content-between">
                <a href="/drivers/add-truck"class="btn btn-md btn-primary"> <span class="plus-icon"><i class="fas fa-plus"></i></span> Add Vehicle</a>
            </div>
            <div class="load-container">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                @if (count($trucks) > 0)
                    @foreach ($trucks as $truck)
                    <div class="load-cards">
                        <h5 class="load-title bold">{{$truck->name}}</h5>
                        <h6 class="smaller-text primary-text">Added {!! htmlspecialchars_decode(date('j<\s\up>S</\s\up> F Y', strtotime($truck->created_at))) !!}</h6>
                        @foreach (json_decode($truck->images) as $image)
                            @if($loop->first)
                                <div class="text-center">
                                    <img src="{{asset($image)}}" class="img-fluid" alt="">
                                </div>
                                @break
                            @endif
                        @endforeach
                        <div class="d-flex justify-content-center text-center mt-3">
                            <a class="btn btn-sm btn-primary" href="/drivers/truck/{{$truck->id}}">View Truck</a>
                        </div>
                    </div>
                    @endforeach
                @else
                    <h5 class="load-title">Nothing to see here</h5>
                @endif
                
            </div>
        </div>
    </div>
@endsection
@section('scripts')
	@parent
@endsection
