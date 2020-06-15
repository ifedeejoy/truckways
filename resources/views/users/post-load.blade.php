@extends('layouts.mainApp.app')
@section('title', 'Dashboard')
@section('content')
@inject('user', 'App\Http\Controllers\LoadsController')
    
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary">
                <h4 class="text-white">Post a load</h6>
            </div>
            <div class="col-sm-12 p-4">
                <form action="">
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
                            <div class="banner-upload text-center mb-3">
                                <h6 class="dark-bold mb-3">Upload images of goods</h6>
                                <div class="d-flex text-center align-self-center">
                                    <input type="file" name="productImages[]" id="fileUpload" class="file-input" onChange='getfileInfo(event)' accept="image/*" multiple>
                                </div>
                                <div class="row mt-4" id="previewUploads">

                                </div>
                            </div>
                        </div>
                        <div class="gray-card col-sm-5 mb-4">
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
                                <select class="custom-select form-control">
                                    <option>Truck type</option>
                                </select>
                            </div>
                            <div class="col mb-4">
                                <select class="custom-select form-control">
                                    <option>Post Load As</option>
                                </select>
                            </div>
                        </div>
                    
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
