@extends('layouts.users.app')
@section('title', 'Dashboard')
@section('content')
    
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary">
                <h4 class="text-white">Post a load</h6>
            </div>
            <div class="col-sm-12 p-4">
            <form action="{{route('create-load')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row d-flex justify-content-between">
                        <div class="gray-card col-sm-6 mb-4">
                            <div class="d-flex flex-row w-100 mb-5 justify-content-between">
                                <h6 class="primary-text bold">Load Details</h6>
                                <h6 class="gray-text bold">{{mt_rand()}}</h6>
                            </div>
                            <div class="col mb-4">
                                <label for="title">Title</label>
                                <input type="text" name="title" class="form-control">
                            </div>
                            <div class="col mb-4">
                                <label for="description">Load description</label>
                                <input type="text" name="description" class="form-control">
                            </div>
                            <div class="col mb-4">
                                <label for="title">Estimated value of goods</label>
                                <input type="number" name="value" class="form-control">
                            </div>
                            <div class="banner-upload text-center mb-3">
                                <h6 class="dark-bold mb-3">Upload images of goods</h6>
                                <div class="d-flex text-center align-self-center">
                                    <input type="file" name="loadImages[]" id="fileUpload" class="file-input truck-file" onChange='getfileInfo(event)' accept="image/*" multiple>
                                </div>
                                <div class="row mt-4" id="previewUploads">

                                </div>
                            </div>
                        </div>
                        <div class="gray-card col-sm-5 mb-4">
                            @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @elseif(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div> 
                            @endif
                            <h6 class="primary-text mb-5 bold">Booking Details</h6>
                            <div class="col mb-4">
                                <label for="title">Pickup address</label>
                                <input type="text" name="pickup" class="form-control">
                            </div>
                            <div class="col mb-4">
                                <label for="title">Delivery address</label>
                                <input type="text" name="delivery" class="form-control">
                            </div>
                            <div class="col mb-4">
                                <select class="custom-select form-control" name="truck_type" id="truck-type" onchange="otherTrucks(this.value)">
                                    <option>Truck type</option>
                                    <option value="15 Tonnes Flatbeds">15 Tonnes Flatbeds</option>
                                    <option value="20 Tonnes Flatbeds">20 Tonnes Flatbeds</option>
                                    <option value="40 Tonnes Flatbeds">40 Tonnes Flatbeds</option>
                                    <option value="15 Tonnes Sided Body Trucks">15 Tonnes Sided Body Trucks</option>
                                    <option value="20 Tonnes Sided Body Trucks">20 Tonnes Sided Body Trucks</option>
                                    <option value="30 Tonnes Sided Body Trucks">30 Tonnes Sided Body Trucks</option>
                                    <option value="40 Tonnes Sided Body Trucks">40 Tonnes Sided Body Trucks</option>
                                    <option value="60 Tonnes Sided Body Trucks">60 Tonnes Sided Body Trucks</option>
                                    <option value="5 Tonnes Covered Body Trucks">5 Tonnes Covered Body Trucks</option>
                                    <option value="10 Tonnes Covered Body Trucks">10 Tonnes Covered Body Trucks</option>
                                    <option value="15 Tonnes Covered Body Trucks">15 Tonnes Covered Body Trucks</option>
                                    <option value="20 Tonnes Covered Body Trucks">20 Tonnes Covered Body Trucks</option>
                                    <option value="30 Tonnes Covered Body Trucks">30 Tonnes Covered Body Trucks</option>
                                    <option value="40 Tonnes Covered Body Trucks">40 Tonnes Covered Body Trucks</option>
                                    <option value="60 Tonnes Covered Body Trucks">60 Tonnes Covered Body Trucks</option>
                                    <option value="vans">Vans</option>
                                    <option value="mini-vans">Mini Vans</option>
                                    <option value="tippers">Tippers</option>
                                    <option value="others">Other (please specify)</option>
                                </select>
                            </div>
                            <div class="col mb-4 d-none" id="other-trucks">
                                <label for="title">Truck type</label>
                                <input type="text" name="truck_type" id="other-truck" class="form-control" disabled>
                            </div>
                            <div class="col mb-4">
                                <label for="budget">Your budget</label>
                                <input type="text" name="budget" class="form-control">
                            </div>
                            <div class="col mb-4">
                                <h6>Post Load As</h6>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-secondary btn-sm btn-rounded active">
                                        Basic 
                                        <input type="radio" name="load_type" value="0" id="load-type" onclick="loadType(this.value)" autocomplete="off" checked>
                                    </label>
                                    <label class="btn btn-secondary btn-sm btn-rounded">
                                        Premium 
                                        <input type="radio" name="load_type" value="1" id="load-type" onclick="loadType(this.value)" autocomplete="off">
                                    </label>
                                </div>
                                <div id="basic" class="mt-3">
                                    <h6 class="small-text">When you post as basic</h6>
                                    <ul>
                                        <li class="smaller-text">Your load is put on the market place</li>
                                        <li class="smaller-text">Drivers may not be verified by truckways</li>
                                        <li class="smaller-text">Your load is not protected by Truckways GIT</li>
                                    </ul>
                                </div>
                                <div id="premium" class="mt-3 d-none">
                                    <h6 class="small-text">When you post as premium</h6>
                                    <ul>
                                        <li class="smaller-text">Your load is put on the market place without your personal details</li>
                                        <li class="smaller-text">Only drivers verified by truckways can bid</li>
                                        <li class="smaller-text">Your load is protected by Truckways GIT</li>
                                        <li class="smaller-text">You automatic notification of bids for your load</li>
                                        <li class="smaller-text">You can track the progress of your load</li>
                                    </ul>
                                    <ul>
                                        <li class="smaller-text">
                                            Insurance Cost
                                            <ul>
                                                <li class="smaller-text">Below 100k - 1%</li>
                                                <li class="smaller-text">Below 500k - 2%</li>
                                                <li class="smaller-text">Below 1M - 3.5%</li>
                                                <li class="smaller-text">Below 5M - 5%</li>
                                                <li class="smaller-text">5M & above - 10%</li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary btn-rounded">Post Load</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        function otherTrucks(val)
        {
            if(val == "others"){
                $("#truck-type").removeAttr("name")
                $("#other-trucks").removeClass("d-none")
                $("#other-truck").attr("disabled", false)
            }else{
                $("#truck-type").attr("name", "truck_type")
                $("#other-trucks").addClass("d-none")
                $("#other-truck").attr("disabled", true)
            }
        }
        function loadType(val)
        {
            if(val == 0){
                $("#premium").addClass("d-none")
                $("#basic").removeClass("d-none")
            }
            else{
                $("#premium").removeClass("d-none")
                $("#basic").addClass("d-none")
            }
        }
    </script>
@endsection
