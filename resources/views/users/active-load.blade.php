@extends('layouts.admin.app')
@section('title', 'Dashboard')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary">
                <h4 class="text-white">Load Details</h6>
                <a class="text-white" data-target="#update-journey" data-toggle="modal"><i class="fas fa-plus"></i> Update Journey</a>
            </div>
            <div class="col-sm-12 p-4">
                @if(session('success'))
                <div class="alert alert-success">
                {{ session('success') }}
                </div> 
                @endif
                <h6 class="black-text bold">TWY{{$load->reference}}</h6>
                <div class="row d-flex justify-content-around">
                    <div class="mb-4 gray-card col-sm-5">
                        <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                            <h6 class="primary-text small-text bold">Load Details</h6>
                        </div>
                        <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                            <h6 class="black-text small-text bold">Title</h6>
                            <h6 class="gray-text small-text">{{$load->title}}</h6>
                        </div>
                        <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                            <h6 class="black-text small-text bold">Load description</h6>
                            <h6 class="gray-text small-text">{{$load->description}}</h6>
                        </div>
                        <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                            <h6 class="black-text small-text bold">Pickup address</h6>
                            <h6 class="gray-text small-text">{{$load->pickup}}</h6>
                        </div>
                        <div class="d-flex flex-row w-100 mb-4 justify-content-between">
                            <h6 class="black-text small-text bold">Delivery address</h6>
                            <h6 class="gray-text small-text">{{$load->delivery}}</h6>
                        </div>
                        <h6 class="primary-text bold small-text mb-3">Images</h6>
                        <div class="text-center mb-3">
                            
                            <div class="row mt-4">
                                @foreach (json_decode($load->images) as $image)
                                <div class='preview-card'>
                                    <img class='banner-form-preview' src="{{asset($image)}}">
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="gray-card mb-4">
                        <div class="d-flex justify-content-between">
                            <div class="col-sm-9 mt-5">
                                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                                    <h6 class="primary-text small-text bold">Driver Details</h6>
                                </div>
                                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                                    <h6 class="black-text small-text bold">Name</h6>
                                    <h6 class="gray-text">{{$load->name}}</h6>
                                </div>
                                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                                    <h6 class="black-text small-text bold">Phone Number</h6>
                                    <h6 class="gray-text">{{$load->phone}}</h6>
                                </div>
                                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                                    <h6 class="black-text small-text bold">License Number</h6>
                                    <h6 class="gray-text">{{$load->idNumber}}</h6>
                                </div>
                                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                                    <h6 class="black-text small-text bold">Address</h6>
                                    <h6 class="gray-text">{{$load->address}}</h6>
                                </div>
                                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                                    <h6 class="black-text small-text bold">Registered Trucks</h6>
                                    <h6 class="gray-text">{{$load->trucks}}</h6>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="text-center">
                                    @if (empty($load->image))
                                    <img class="rounded-circle z-depth-1 img-fluid profile-img p-2" src="/images/user-dark.svg" alt="">
                                    @else
                                    <img class="z-depth-1 img-fluid profile-img p-2" src="{{asset($load->image)}}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            @if ($load->load_type > 0)
            <div class="gray-card">
                <div class="d-flex flex-row w-100 mb-2 justify-content-between">
                    <h6 class="primary-text small-text bold">Tracking</h6>
                </div>
                @if (count($journeys) < 1)
                <div class="progress" style="height: 30px; border-radius: 18px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary text-right" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
                        <h5 class="mt-2 mr-3"><i class="fas fa-check-circle"></i></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="p-3 mb-2 text-center ml-2 mr-5">
                        <h6 class="black-text smaller-text bold">Requested</h6>
                        <h6 class="gray-text smaller-text">{{date("Y-m-d", strtotime($load->created_at))}}</h6>
                        <h6 class="gray-text smaller-text">{{date("H:i", strtotime($load->created_at))}}</h6>
                    </div>
                    <div class="p-3 mb-2 text-center mr-5">
                        <h6 class="black-text smaller-text bold">Bidded</h6>
                        <h6 class="gray-text smaller-text">{{date("Y-m-d", strtotime($load->bid_at))}}</h6>
                        <h6 class="gray-text smaller-text">{{date("H:i", strtotime($load->bid_at))}}</h6>
                    </div>
                    <div class="p-3 mb-2 text-center mr-5">
                        <h6 class="black-text smaller-text bold">Bid Accepted</h6>
                        <h6 class="gray-text smaller-text">{{date("Y-m-d", strtotime($load->accepted_at))}}</h6>
                        <h6 class="gray-text smaller-text">{{date("H:i", strtotime($load->accepted_at))}}</h6>
                    </div>
                </div>
                @else
                    @foreach ($journeys as $journey) 
                        @if ($loop->iteration == 1 && $loop->last)
                        <div class="progress" style="height: 30px; border-radius: 18px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary text-right" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%">
                                <h5 class="mt-2 mr-3"><i class="fas fa-check-circle"></i></h5>
                            </div>
                        </div>
                        @elseif($loop->iteration == 2 && $loop->last)
                        <div class="progress" style="height: 30px; border-radius: 18px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary text-right" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%">
                                <h5 class="mt-2 mr-3"><i class="fas fa-check-circle"></i></h5>
                            </div>
                        </div>
                        @elseif($loop->last)
                            @if($load->status == 'closed')
                            <div class="progress" style="height: 30px; border-radius: 18px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary text-right" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                                    <h5 class="mt-2 mr-3"><i class="fas fa-check-circle"></i></h5>
                                </div>
                            </div>
                            @else
                            <div class="progress" style="height: 30px; border-radius: 18px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary text-right" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="90" style="width:90%">
                                    <h5 class="mt-2 mr-3"><i class="fas fa-check-circle"></i></h5>
                                </div>
                            </div>
                            @endif
                        @endif
                    @endforeach
                    <div class="row">
                        <div class="p-3 mb-2 text-center ml-2 mr-3">
                            <h6 class="black-text smaller-text bold">Requested</h6>
                            <h6 class="gray-text smaller-text">{{date("Y-m-d", strtotime($load->created_at))}}</h6>
                            <h6 class="gray-text smaller-text">{{date("H:i", strtotime($load->created_at))}}</h6>
                        </div>
                        <div class="p-3 mb-2 text-center mr-3">
                            <h6 class="black-text smaller-text bold">Bidded</h6>
                            <h6 class="gray-text smaller-text">{{date("Y-m-d", strtotime($load->bid_at))}}</h6>
                            <h6 class="gray-text smaller-text">{{date("H:i", strtotime($load->bid_at))}}</h6>
                        </div>
                        <div class="p-3 mb-2 text-center mr-3">
                            <h6 class="black-text smaller-text bold">Bid Accepted</h6>
                            <h6 class="gray-text smaller-text">{{date("Y-m-d", strtotime($load->accepted_at))}}</h6>
                            <h6 class="gray-text smaller-text">{{date("H:i", strtotime($load->accepted_at))}}</h6>
                        </div>
                        @foreach ($journeys as $journey)
                        @if ($loop->iteration == 1 || $loop->iteration == 2 || $loop->iteration == 3)
                        <div class="p-3 mb-2 text-center mr-3">
                            <h6 class="black-text smaller-text bold text-capitalize">{{$journey->event}}</h6>
                            <h6 class="gray-text smaller-text">{{date("Y-m-d", strtotime($journey->updated_at))}}</h6>
                            <h6 class="gray-text smaller-text">{{date("H:i", strtotime($journey->updated_at))}}</h6>
                        </div>
                        @elseif ($loop->last)
                        <div class="p-3 mb-2 text-center mr-3">
                            <h6 class="black-text smaller-text bold text-capitalize">{{$journey->event}}</h6>
                            <h6 class="gray-text smaller-text">{{date("Y-m-d", strtotime($journey->updated_at))}}</h6>
                            <h6 class="gray-text smaller-text">{{date("H:i", strtotime($journey->updated_at))}}</h6>
                        </div>
                        @endif
                        @endforeach 
                    </div>
                @endif
                
                <div class="d-flex flex-row w-100 mt-5 mb-2 justify-content-between">
                    <h6 class="primary-text small-text bold">Updates</h6>
                </div>
                <div class="table-resposnive">
                    <table class="table event-table">
                        <thead>
                            <th scope="col">Date</th>
                            <th scope="col">Location</th>
                            <th scope="col">Event</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="col" class="smaller-text text-capitalize">{{date("Y-m-d", strtotime($load->updated_at))}} <br> {{date("H:i", strtotime($load->updated_at))}}</td>
                                <td colspan="col" class="smaller-text text-capitalize"></td>
                                <td colspan="col" class="smaller-text text-capitalize">Requested</td>
                            </tr>
                            <tr>
                                <td colspan="col" class="smaller-text text-capitalize">{{date("Y-m-d", strtotime($load->bid_at))}} <br> {{date("H:i", strtotime($load->bid_at))}}</td>
                                <td colspan="col" class="smaller-text text-capitalize"></td>
                                <td colspan="col" class="smaller-text text-capitalize">Bidded</td>
                            </tr>
                            <tr>
                                <td colspan="col" class="smaller-text text-capitalize">{{date("Y-m-d", strtotime($load->accepted_at))}} <br> {{date("H:i", strtotime($load->accepted_at))}}</td>
                                <td colspan="col" class="smaller-text text-capitalize"></td>
                                <td colspan="col" class="smaller-text text-capitalize">Bid Accepted</td>
                            </tr>
                            @foreach ($journeys as $journey)
                            <tr>
                                <td colspan="col" class="smaller-text text-capitalize">{{date("Y-m-d", strtotime($journey->updated_at))}} <br> {{date("H:i", strtotime($journey->updated_at))}}</td>
                                <td colspan="col" class="smaller-text text-capitalize">{{$journey->location}}</td>
                                <td colspan="col" class="smaller-text text-capitalize">{{$journey->event}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="modal fade" id="update-journey" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Update Journey</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div class="col-sm-12">
                        <div class="text-center mt-3">
                            @if ($load->load_type > 0 && $load->status == 'active')
                            <form action="{{route('update-journey')}}" method="post">
                                @csrf
                                <input type="hidden" name="load" value="{{$load->load_id}}">
                                <input type="hidden" name="event" value="heading to pickup">
                                <input type="hidden" name="location" value="null">
                                <input type="hidden" name="updatedBy" value="{{auth()->guard()->user()->name}}">
                                <button class="btn btn-sm btn-primary" type="submit">Start Journey</button>
                            </form>
                            @elseif($load->load_type > 0 && $load->status == 'started-journey')
                            <form action="{{route('update-journey')}}" method="post">
                                @csrf
                                <input type="hidden" name="load" value="{{$load->load_id}}">
                                <input type="hidden" name="event" value="items picked up">
                                <input type="hidden" name="location" value="null">
                                <input type="hidden" name="updatedBy" value="{{auth()->guard()->user()->name}}">
                                <button class="btn btn-sm btn-primary" type="submit">Pick Up Items</button>
                            </form>
                            @elseif($load->load_type > 0 && ($load->status == 'picked up' || $load->status == 'in-progress'))
                            <form action="{{route('update-journey')}}" method="post" id="update-location">
                                @csrf
                                <input type="hidden" name="load" value="{{$load->load_id}}">
                                <input type="hidden" name="event" value="updated location">
                                <input type="hidden" name="updatedBy" value="{{auth()->guard()->user()->name}}">
                                <input type="text" class="form-control" name="location" placeholder="Your current location">
                                <button class="btn btn-sm btn-primary" form="update-location" type="submit">Update Location</button>
                            </form>
                            <form action="{{route('update-journey')}}" method="POST" id="close-trip">
                                @csrf
                                <input type="hidden" name="load" value="{{$load->load_id}}">
                                <input type="hidden" name="event" value="completed">
                                <input type="hidden" name="updatedBy" value="{{auth()->guard()->user()->name}}">
                                <input type="hidden" name="location" value="null">
                                <button class="btn btn-sm btn-primary" form="close-trip" type="submit">End Trip</button>
                            </form>
                            @else
                            <a class="btn btn-sm btn-primary" href="/admin/load/{{$load->load_id}}">View Load</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection