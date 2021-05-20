@extends('layouts.mails')
@section('title', 'Welcome Email')
@section('content')
    <div class="d-flex justify-content-center text-center bg-primary">
        <div class="col-sm-6 bg-white">
            <strong class="title"><img src="/images/logo-black.png" alt="Truckways" class="logo-img"></strong class="title">
            <h6 class="mt-5">Hello {{$user ?? ''}},</h6>
            <div class="d-flex justify-content-center">
                <div class="col-sm-6 justify-content-center">
                    <p>
                        Thank you for signing up to truckways, we've listed the next steps for you to fully enjoy our amazing service
                        <ul>
                            <li>Go to my manage account</li>
                            <li>Click on the edit icon (looks like a pencil)</li>
                            <li>Update your profile information</li>
                            <li>Click submit</li>
                        </ul>
                        Now you can request for your account to be verified allowing you to get notified & bid on premium loads
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection