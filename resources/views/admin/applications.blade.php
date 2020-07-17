@extends('layouts.admin.app')
@section('title', 'Driver\'s Application')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="load-container">
                @foreach ($requests as $request)
                    <div class="load-cards">
                        <div class="d-flex justify-content-between">
                            <h5 class="load-title bold">{{$request->name}}</h5>
                        </div>
                        <div class="d-flex justify-content-between text-center">
                            <h6 class="smaller-text primary-text">{{$request->address}}</h6>
                        </div>
                        <div class="text-center">
                            <img src="{{asset($request->image)}}" class="driver-prof img-fluid" alt="">
                        </div>
                        <div class="text-center mt-3">
                            <a class="btn btn-sm btn-primary rounded-btn" href="/admin/driver/{{$request->id}}">View Profile</a>
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
