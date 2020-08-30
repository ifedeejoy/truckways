@extends('layouts.agents.app')
@section('title', 'Dashboard')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options">
                <h6 class="small-text bold">{{$totalActive ?? ''}} active loads</h6>
                <h6 class="small-text bold">{{$availableTrucks ?? ''}} trucks available</h6>
                <h6 class="small-text bold"> pending bills</h6>
            </div>
            @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
            @elseif(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div> 
            @endif
            <div class="noshadow-card">
                <div class="card-box clickable-row" data-href="/agents/register-driver">
                    <img src="/images/post.png" alt="">
                    <h6>My Drivers</h6>
                </div>
                <div class="card-box clickable-row" data-href="/agents/users">
                    <img src="/images/users.png" alt="">
                    <h6>My Shippers</h6>
                </div>
                <div class="card-box clickable-row" data-href="/agents/admins">
                    <img src="/images/view-records.png" alt="">
                    <h6>My Bids</h6>
                </div>
                <div class="card-box clickable-row" data-href="/agents/analytics">
                    <img src="/images/analytics.png" alt="">
                    <h6>Analytics</h6>
                </div>
                <div class="card-box clickable-row" data-href="/agents/trips">
                    <img src="/images/explore-trucks.svg" alt="">
                    <h6>Trips</h6>
                </div>
                <div class="card-box clickable-row" data-href="/agents/profile">
                    <img src="/images/manage-account.png" alt="">
                    <h6>Manage Account</h6>
                </div>
            </div>
        </div>
    </div>
@endsection
