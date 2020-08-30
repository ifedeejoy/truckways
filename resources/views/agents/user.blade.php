@extends('layouts.agents.app')
@section('title', 'User Profile')
@section('content')
    
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary">
                <h4 class="text-white">{{$user->name}}'s Profile</h6>
            </div>
            <div class="noshadow-card justify-content-center w-100">
                <div class="shadow-card w-60">
                    <div class="p-2 d-flex justify-content-between">
                        <div class="d-flex justify-content-around">
                            <div class="text-center">
                                <img class="rounded-circle z-depth-1 img-fluid profile-img p-3" src="/images/user-dark.svg" alt="">
                            </div>
                            <div class="mt-5 ml-5">
                                <h6 class="bold">{{$user->name}}</h6>
                                <h6 class="extra-muted small-text">{{$user->email}}</h6>
                                <h6 class="extra-muted small-text">{{$user->phone}}</h6>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-end">
                            <form action="{{route('delete-user', $user->id)}}" method="post">
                                @csrf
                                <button type="submit" class="black-text bg-transparent border-0"><i class="far fa-trash-alt fa-1x"></i></button>
                            </form>
                        </div>
                    </div>
                    <hr class="dark-hr">
                    <div class="d-flex justify-content-between">
                        <div class="text-center">
                            <h6 class="bold">Load Requests</h6>
                            <h6 class="smaller-text">{{$loads}}</h6>
                        </div>
                        <div class="text-center">
                            <h6 class="bold">Open Requests</h6>
                            <h6 class="smaller-text">{{$open}}</h6>
                        </div>
                        <div class="text-center">
                            <h6 class="bold">Active Requests</h6>
                            <h6 class="smaller-text">{{$active}}</h6>
                        </div>
                        <div class="text-center">
                            <h6 class="bold">Closed Requests</h6>
                            <h6 class="smaller-text">{{$closed}}</h6>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-5 pl-4">
                    <table class="table table-striped bg-white black-text table-border text-center" id="all-loads" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Reference</th>
                                <th scope="col">Location</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Budget</th>
                                <th scope="col">Truck Type</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Reference</th>
                                <th scope="col">Location</th>
                                <th scope="col">Destination</th>
                                <th scope="col">Budget</th>
                                <th scope="col">Truck Type</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($requests as $request)
                            <tr class="clickable-row" data-href="/users/request/{{$request->id}}">
                                <td>{{$request->created_at}}</td>
                                <td>{{$request->reference}}</td>
                                <td>{{$request->pickup}}</td>
                                <td>{{$request->delivery}}</td>
                                <td>{{number_format($request->budget)}}</td>
                                <td>{{$request->truck_type}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
	@parent
	<script src="/js/datatables.min.js" defer></script>
	<script src="/js/datatables-select.min.js" defer></script>
	<script type="module">
		$(document).ready(function () {
			$('#all-loads').DataTable();
		});
	</script>
	
@endsection