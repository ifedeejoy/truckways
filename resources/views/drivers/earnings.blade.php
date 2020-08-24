@extends('layouts.drivers.app')
@section('title', 'Earnings')
@section('content')
    
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="d-flex justify-content-center mt-5">
                <div class="earning-box">
                    <div class="earning-inner">
                        <h5 class="earning-bold">Total earnings</h5>
                        <h4 class="earning-header">{{number_format($earnings)}}</h4>
                    </div>
                </div>
            </div>
            <div class="trips mt-5">
                @foreach ($loads as $load)
                    <div class="trip">
                        <div class="trip-left">
                            <h6 class="trip-text">{{$load->title}}</h6>
                            <h6 class="trip-text">{{$load->pickup}} - {{$load->delivery}}</h6>
                            <h6 class="trip-text">{{$load->truck_type}}</h6>
                            <h6 class="trip-text">{{$load->updated_at}}</h6>
                        </div>
                        <div class="trip-right">
                            <h4 class="trip-heading">N{{number_format($load->price)}}</h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
