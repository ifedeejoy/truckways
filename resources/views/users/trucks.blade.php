@extends('layouts.users.app')
@section('title', 'Dashboard')
@section('content')
    
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="market-container">
                @foreach ($trucks as $truck)
                    <div class="market-card user-truck">
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
                            <h6 class="small-text mt-3">Truck Model</h6>
                            <h6 class="smaller-text black-text">{{$truck->model}}</h6>
                            <h6 class="small-text mt-3">Phone Number</h6>
                            <h6 class="smaller-text black-text">{{$truck->phone}}</h6>
                            <h6 class="small-text mt-3">Plate Number</h6>
                            <h6 class="smaller-text black-text">{{$truck->plate_number}}</h6>
                            <div class="text-center mt-5">
                            <button class="long-btn waves-effect waves-dark p-2" id="{{$truck->id}}" onclick="hideNumber(this.id)">Cancel</button>
                            </div>
                        </div>  
                        <div class="mcard-bottom">
                            <div class="mbottom-content mt-3">
                                <h6 class="small-text black-text">Truck Type</h6>
                                <h6 class="small-text black-text">Driver Name</h6>
                            </div>
                            <div class="mbottom-content mb-4">
                                <h6 class="smaller-text black-text">{{$truck->type}}</h6>
                                <h6 class="smaller-text black-text">{{$truck->name}}</h6>
                            </div>
                            <div class="text-center mb-2">
                                <button class="long-btn waves-effect waves-dark p-2" id="{{$truck->id}}" onclick="showNumber(this.id)">View Details</button>
                            </div>
                        </div>        
                    </div>
                @endforeach
            </div>
        </div>
    </div>
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