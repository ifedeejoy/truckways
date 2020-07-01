@extends('layouts.drivers.app')
@section('title', 'Loads')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary white-text justify-content-between">
                Add New Vehicle
            </div>
            <form class="load-container p-4" id="adds-vehicle" action="{{route('adds-vehicle')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="truck-card truck-form">
                    <h6 class="small-text primary-text">Truck details</h6>
                    <div class="d-flex justify-content-between mt-4">
                        <h6 class="bold small-text">Truck Name</h6>
                        <div class="md-form mt-n3 ml-n10">
                            <input type="text" class="form-control" name="name">
                            <label for="tname" class="small-text text-black">Enter Name</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="bold small-text">Truck Model</h6>
                        <div class="md-form mt-n3 ml-n10">
                            <input type="text" class="form-control" name="model">
                            <label for="tname" class="small-text text-black">Enter Model</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="bold small-text">Truck Type</h6>
                        <div class="md-form mt-n3 ml-n10">
                            <input type="text" class="form-control" name="type">
                            <label for="tname" class="small-text text-black">Enter Type</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="bold small-text">Plate Number</h6>
                        <div class="md-form mt-n3 ml-n10">
                            <input type="text" class="form-control" name="plate_number">
                            <label for="tname" class="small-text text-black">Enter Plate Number</label>
                        </div>
                    </div>
                </div>
                <div class="truck-card transparent-truck">
                    <div class="gray-card mb-3">
                        <h6 class="small-text primary-text">Images</h6>
                        <div class="banner-upload text-center mb-3">
                            <h6 class="dark-bold mb-3">Upload Truck Image</h6>
                            <div class="d-flex justify-content-center">
                                <input type="file" name="truckImages[]" id="fileUpload" class="file-input truck-file" onChange='getfileInfo(event)' accept="image/*" multiple>
                            </div>
                            <div class="row mt-4" id="previewUploads">

                            </div>
                        </div>
                    </div>
                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @elseif(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div> 
                    @endif
                    <div class="gray-card w-100 text-center p-3 mt-5">
                        <button class="btn btn-md btn-primary" form="adds-vehicle" type="submit">Save Truck</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('scripts')
	@parent
@endsection
