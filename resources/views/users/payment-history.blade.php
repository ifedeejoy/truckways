@extends('layouts.users.app')
@section('title', 'Dashboard')
@section('content')
    
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="mt-5 p-2"></div>
        @foreach ($loads as $load)
        <div class="payment-card col-sm-9 mx-auto mt-5">
            <div class="d-flex justify-content-between">
                <div class="col-sm-3 mb-4">
                    @foreach (json_decode($load->images) as $image)
                        @if($loop->first)
                            <img src="{{asset($image)}}" class="img-fluid z-depth-1" alt="">
                            @break
                        @endif
                    @endforeach
                </div>
                <div class="col-sm-8 mb-4">
                    <h5 class="bold">{{$load->title}}</h5>
                    <h6 class="small-text">{{$load->pickup}} - {{$load->delivery}}</h6>
                    <h6 class="small-text">Driver: {{$load->name}}</h6>
                    <h6 class="small-text">Amount Paid: {{number_format($load->price)}}</h6>
                    <h6 class="small-text">Payment Method: {{$load->payment_method}}</h6>
                </div>
            </div>
            
        </div>
        @endforeach
    </div>
@endsection
