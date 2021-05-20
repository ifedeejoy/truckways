@extends('layouts.app')
@section('title', 'Find Truck')
@section('bg', 'https://res.cloudinary.com/ifedeejoy/image/upload/v1593688512/find-truck_hg1wnx.png')
@section('page-title', 'Find Trucks')
@section('page-caption', 'Search for a specific truck to know more about the details')
@section('content')

<section class="latest-loads animated fadeInUp delay-1s mt-5">
	<div class="market-container">
        @foreach ($trucks as $truck)
            <div class="market-card">
                @foreach (json_decode($truck->images) as $image)
                @if ($loop->first)
                <a class="mcard-top" href="{{asset($image)}}" data-lightbox="{{$truck->id}}">
                    <img src="{{asset($image)}}" class="m-img" alt="Loaded Van">
                </a>
                @else
                <a class="d-none" href="{{asset($image)}}" data-lightbox="{{$truck->id}}">
                    <img src="{{asset($image)}}" class="m-img" alt="Loaded Van">
                </a>
                @endif
                @endforeach
                
                <div class="light-overlay text-center overlay{{$truck->id}}">
                    <h6 class="small-text mt-3 text-white">Phone Number</h6>
                    <h6 class="small-text mt-3">{{Str::limit($truck->phone, 7)}}</h6>
                    <div class="text-center mt-5">
                    <button class="long-btn waves-effect waves-dark p-2" id="{{$truck->id}}" onclick="hideNumber(this.id)">Cancel</button>
                    </div>
                </div>  
                <div class="mcard-bottom">
                    <div class="mbottom-content mt-3">
                        <h6 class="muted-small">Truck Type</h6>
                        <h6 class="muted-small">Driver Name</h6>
                    </div>
                    <div class="mbottom-content mb-4">
                        <h6 class="mbottom-txt">{{$truck->type}}</h6>
                        <h6 class="mbottom-txt">{{$truck->name}}</h6>
                    </div>
                    <div class="text-center mb-2">
                        <button class="long-btn waves-effect waves-dark p-2" id="{{$truck->id}}" onclick="showNumber(this.id)">Call</button>
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