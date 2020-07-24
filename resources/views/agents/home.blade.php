@extends('layouts.admin.app')
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
                <div class="card-box clickable-row" data-href="/admin/applications">
                    <img src="/images/post.png" alt="">
                    <h6>Driver Applications</h6>
                </div>
                <div class="card-box clickable-row" data-href="/admin/users">
                    <img src="/images/users.png" alt="">
                    <h6>User Profiles</h6>
                </div>
                <div class="card-box clickable-row" data-href="/admin/admins">
                    <img src="/images/view-records.png" alt="">
                    <h6>Admin Profiles</h6>
                </div>
                <div class="card-box clickable-row" data-href="/admin/analytics">
                    <img src="/images/analytics.png" alt="">
                    <h6>Analytics</h6>
                </div>
                <div class="card-box clickable-row" data-href="/admin/trips">
                    <img src="/images/explore-trucks.svg" alt="">
                    <h6>Trips</h6>
                </div>
                <div class="card-box clickable-row" data-href="/admin/profile">
                    <img src="/images/manage-account.png" alt="">
                    <h6>Manage Account</h6>
                </div>
            </div>
        </div>
    </div>
@endsection
<div class="modal fade" id="check-load" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Check Load Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form action="{{route('search-load')}}" method="post">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <div class="md-form col-sm-9">
                            <input type="text" name="load" class="form-control">
                            <label class="primary-text">Enter Load Id</label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-md btn-primary rounded-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>