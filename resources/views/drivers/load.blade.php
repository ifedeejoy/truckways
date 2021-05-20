@extends('layouts.drivers.app')
@section('title', 'Dashboard')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary">
                <h4 class="text-white">{{$load->title}}</h6>
            </div>
            <div class="col-sm-12 p-4">
                <div class="row d-flex justify-content-between">
                    <div class="col-sm-6 mb-4 container">
                        @foreach (json_decode($load->images) as $image)
                            @if($loop->first)
                                <img src="{{asset($image)}}" class="img-fluid" alt="">
                                @break
                            @endif
                        @endforeach
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
                    <div class="col-sm-6 mb-4 d-flex flex-column">
                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="bold">{{$load->title}}</h5>
                            <h6 class="smaller-text text-center">{!! htmlspecialchars_decode(date('j<\s\up>S</\s\up> F Y', strtotime($load->created_at))) !!}</h6>
                        </div>
                        <p class="small-text primary-text">{{$load->pickup}} - {{$load->delivery}}</p>
                        <h6 class="load-title mb-5">{{$load->description}}</h6>
                        <form action="{{route('send-bid', $load->id)}}" id="send-bid" method="POST" class="mb-5">
                            @csrf
                            <div class="md-form col">
                                <input type="number" class="form-control" name="amount">
                                <label class="black-text" for="amount">Bid Amount </label>
                            </div>
                            <h6 class="small-text mb-5">We deduct 5% service charge from driver’s pay</h6>
                        </form>
                        @if(is_string($errors))
                        <div class="alert alert-danger">
                            <ul>
                                <li>{{ $errors }}</li>
                            </ul>
                        </div>
                        @elseif ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('success'))
                        <div class="alert alert-success">
                        {{ session('success') }}
                        </div> 
                        @endif
                        <button type="submit" form="send-bid" class="btn btn-lg btn-primary align-self-end mt-5">Send Bid</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
