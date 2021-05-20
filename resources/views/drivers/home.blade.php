@extends('layouts.drivers.app')
@section('title', 'Dashboard')
@section('content')
    
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options">
                <h6 class="small-text bold"> available loads</h6>
                <h6 class="small-text bold"> trucks available</h6>
                <h6 class="small-text bold"> pending bills</h6>
            </div>
            <div class="noshadow-card">
                <div class="card-box clickable-row" data-href="/drivers/loads">
                    <img src="/images/post.png" alt="">
                    <h6>Available Loads</h6>
                </div>
                <div class="card-box clickable-row" data-href="/drivers/my-bids">
                    <img src="/images/load-status.png" alt="">
                    <h6>My Bids</h6>
                </div>
                <div class="card-box clickable-row" data-href="/drivers/trucks">
                    <img src="/images/explore-trucks.svg" alt="">
                    <h6>My Vehicles</h6>
                </div>
                <div class="card-box clickable-row" data-href="/drivers/journey-history">
                    <img src="/images/view-records.png" alt="">
                    <h6>Journey History</h6>
                </div>
                <div class="card-box clickable-row" data-href="/drivers/earnings">
                    <img src="/images/bids.png" alt="">
                    <h6>Earnings</h6>
                </div>
                <div class="card-box clickable-row" data-href="/drivers/profile">
                    <img src="/images/manage-account.png" alt="">
                    <h6>Manage Account</h6>
                </div>
            </div>
        </div>
    </div>
@endsection
