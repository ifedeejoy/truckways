@extends('layouts.mainApp.app')
@section('title', 'Dashboard')
@section('content')
@inject('user', 'App\Http\Controllers\LoadsController')
    
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options">
                <h6 class="small-text bold"> active loads</h6>
                <h6 class="small-text bold"> trucks available</h6>
                <h6 class="small-text bold"> pending bills</h6>
            </div>
            <div class="noshadow-card">
                <div class="card-box clickable-row" data-href="/users/post-load">
                    <img src="/images/post.png" alt="">
                    <h6>Post a load</h6>
                </div>
                <div class="card-box clickable-row" data-href="/users/check-load">
                    <img src="/images/load-status.png" alt="">
                    <h6>Check load status</h6>
                </div>
                <div class="card-box clickable-row" data-href="/users/view-records">
                    <img src="/images/view-records.png" alt="">
                    <h6>View records</h6>
                </div>
                <div class="card-box clickable-row" data-href="/users/bids">
                    <img src="/images/bids.png" alt="">
                    <h6>Bids</h6>
                </div>
                <div class="card-box clickable-row" data-href="/users/trucks">
                    <img src="/images/explore-trucks.svg" alt="">
                    <h6>Explore trucks</h6>
                </div>
                <div class="card-box clickable-row" data-href="/users/profile">
                    <img src="/images/manage-account.png" alt="">
                    <h6>Manage Account</h6>
                </div>
            </div>
        </div>
    </div>
@endsection
