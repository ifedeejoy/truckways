@extends('layouts.drivers.app')
@section('title', 'Loads')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options border-primary justify-content-center">
                <h6 class="bold">Recently Posted Loads</h6>
            </div>
            <div class="load-container">
                @foreach ($loads as $load)
                <div class="load-cards">
                    <div class="d-flex justify-content-between">
                        <h5 class="load-title bold">{{$load->title}}</h5>
                        <h6 class="smaller-text text-center">{!! htmlspecialchars_decode(date('j<\s\up>S</\s\up> F Y', strtotime($load->created_at))) !!}</h6>
                    </div>
                    <div class="d-flex justify-content-between text-center">
                        <h6 class="smaller-text primary-text">{{$load->pickup}}</h6>
                        <h6 class="smaller-text primary-text">{{$load->delivery}}</h6>
                    </div>
                    @foreach (json_decode($load->images) as $image)
                        @if($loop->first)
                            <img src="{{asset($image)}}" class="img-fluid" alt="">
                            @break
                        @endif
                    @endforeach
                    <div class="d-flex justify-content-between text-center mt-3">
                        <h5 class="load-title bold mt-2">{{number_format($load->budget)}}</h5>
                        <a class="btn btn-sm btn-primary btn-rounded" href="/drivers/load/{{$load->id}}">Bid</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('scripts')
	@parent
@endsection
