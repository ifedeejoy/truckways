@extends('layouts.agents.app')
@section('title', 'Analytics')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card bg-transparent d-flex flex-row flex-wrap">
            <div class="stat-card dark-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/white-box.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Loads Posted</h6>
                    <h5 class="bold">{{$loads}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card orange-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/box.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Active Trips</h6>
                    <h5 class="bold">{{$active}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card green-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/white-box.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Completed Trips</h6>
                    <h5 class="bold">{{$completed}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card orange-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/box.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Open Requests</h6>
                    <h5 class="bold">{{$open}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card green-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/white-box.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Completed Requests</h6>
                    <h5 class="bold">{{$delivered}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card red-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/white-box.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Expired Requests</h6>
                    <h5 class="bold">{{$expired}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card dark-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/user.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Registered Users</h6>
                    <h5 class="bold">{{$users}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card orange-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/user-dark.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Registered Drivers</h6>
                    <h5 class="bold">{{$drivers}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card green-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/truck.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Registered Trucks</h6>
                    <h5 class="bold">{{$trucks}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card orange-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/box.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Open Bids</h6>
                    <h5 class="bold">{{$pending}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card green-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/white-box.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Accepted Bids</h6>
                    <h5 class="bold">{{$accepted}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card red-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/white-box.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Declined Bids</h6>
                    <h5 class="bold">{{$declined}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card dark-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/white-box.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Total Bids</h6>
                    <h5 class="bold">{{$bids}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card orange-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/box.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Total Earnings</h6>
                    <h5 class="bold">{{number_format($earnings)}}</h5>
                </div>
                <div></div>
            </div>
            <div class="stat-card green-stat clickable-row" data-href="/admin/applications">
                <div class="img-container">
                    <img src="/images/white-box.svg" alt="">
                </div>
                <div class="stat-text">
                    <h6 class="smaller-text">Total Commission %</h6>
                    <h5 class="bold">{{number_format($commission)}}</h5>
                </div>
                <div></div>
            </div>
        </div>
    </div>
@endsection