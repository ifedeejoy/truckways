@extends('layouts.app')
@section('title', 'Find Truck')
@section('bg', 'https://res.cloudinary.com/ifedeejoy/image/upload/v1593688514/home-banner_rskkgy.png')
@section('page-title', 'Market Place')
@section('page-caption', 'Check for latest loads and contact the posters')
@section('content')

<section class="latest-loads animated fadeInUp delay-1s mt-5">
	<div class="market-container">
        @foreach ($loads as $load)
            <div class="market-card">
                @foreach (json_decode($load->images) as $image)
                    @if ($loop->first)
                    <a class="mcard-top" href="{{asset($image)}}" data-lightbox="{{$load->id}}">
                        <img src="{{asset($image)}}" class="m-img" alt="Loaded Van">
                    </a>
                    @else
                    <a class="d-none" href="{{asset($image)}}" data-lightbox="{{$load->id}}">
                        <img src="{{asset($image)}}" class="m-img" alt="Loaded Van">
                    </a>
                    @endif
                @endforeach
                
                <div class="light-overlay text-center overlay{{$load->id}}">
                    <h6 class="small-text mt-3 text-white">Phone Number</h6>
                    <h6 class="small-text mt-3">{{$load->phone}}</h6>
                    <h6 class="text-white mt-3">Pickup & Delivery</h6>
                    <h6 class="small-text mt-3">{{$load->pickup}}</h6>
                    <h6 class="small-text mt-3">{{$load->delivery}}</h6>
                    <div class="text-center mt-5">
                    <button class="long-btn waves-effect waves-dark p-2" id="{{$load->id}}" onclick="hideNumber(this.id)">Cancel</button>
                    </div>
                </div>  
                <div class="mcard-bottom">
                    <div class="mbottom-content">
                        <h6 class="muted-small">From</h6>
                        <h6 class="muted-small">To</h6>
                    </div>
                    <div class="mbottom-content">
                        <h6 class="mbottom-txt">{{Str::limit($load->pickup,15)}}</h6>
                        <h6 class="mbottom-txt">{{Str::limit($load->delivery,15)}}</h6>
                    </div>
                    <div class="mbottom-content mt-3">
                        <h6 class="muted-small">Trucktype</h6>
                        <h6 class="muted-small">Posted</h6>
                    </div>
                    <div class="mbottom-content mb-4">
                        <h6 class="mbottom-txt">{{$load->truck_type}}</h6>
                        <h6 class="mbottom-txt">{!! htmlspecialchars_decode(date('j<\s\up>S</\s\up> F Y', strtotime($load->created_at))) !!}</h6>
                    </div>
                    <div class="text-center mb-2">
                    @if ($load->load_type == 0)
                        <button class="long-btn waves-effect waves-dark p-2" id="{{$load->id}}" onclick="showNumber(this.id)">Call</button>
                    @else
                        <a class="long-btn waves-effect waves-dark p-2" href="drivers/load/{{$load->id}}">Bid</a>
                    @endif
                    </div>
                </div>        
            </div>
        @endforeach
	</div>
</section>
@endsection
@section('scripts')
    @parent
    <script type="module">
        window.showNumber = function(id)
        {
            $('.overlay'+id).addClass('d-flex justify-content-center flex-column')
            $('.overlay'+id).show(500)
        }
        window.hideNumber = function(id) {
            $('.overlay'+id).removeClass('d-flex justify-content-center align-items-end flex-column')
            $('.overlay'+id).hide(500)
        }
    </script>
@endsection