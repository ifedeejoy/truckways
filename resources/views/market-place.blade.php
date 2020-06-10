@extends('layouts.app')
@section('title', 'Find Truck')
@section('bg', 'home-banner.png')
@section('page-title', 'Market Place')
@section('page-caption', 'Check for latest loads and contact the posters')
@section('content')

<section class="latest-loads animated fadeInUp delay-1s mt-5">
	<div class="market-container">
        <div class="market-card">
            <div class="mcard-top">
                <img src="/images/market.png" class="m-img" alt="Loaded Van">
            </div>
            <div class="light-overlay text-center overlay1">
                <h6 class="small-text mt-3 text-white">Phone Number</h6>
                <h6 class="small-text mt-3">+234 909 332 9909</h6>
                <div class="text-center mt-5">
                    <button class="long-btn waves-effect waves-dark p-2" id="1" onclick="hideNumber(this.id)">Cancel</button>
                </div>
            </div>  
            <div class="mcard-bottom">
                <div class="mbottom-content">
                    <h6 class="muted-small">From</h6>
                    <h6 class="muted-small">To</h6>
                </div>
                <div class="mbottom-content">
                    <h6 class="mbottom-txt">Ikeja (Lagos)</h6>
                    <h6 class="mbottom-txt">Ikorodu (Lagos)</h6>
                </div>
                <div class="mbottom-content mt-3">
                    <h6 class="muted-small">Trucktype</h6>
                    <h6 class="muted-small">Posted</h6>
                </div>
                <div class="mbottom-content mb-4">
                    <h6 class="mbottom-txt">Flatbed Van</h6>
                    <h6 class="mbottom-txt">2-2-2020</h6>
                </div>
                <div class="text-center mb-2">
                    <button class="long-btn waves-effect waves-dark p-2" id="1" onclick="showNumber(this.id)">Call</button>
                </div>
            </div>        
        </div>
        <div class="market-card">
            <div class="mcard-top">
                <img src="/images/market.png" class="m-img" alt="Loaded Van">
            </div>
            <div class="light-overlay text-center overlay2">
                <h6 class="small-text mt-3 text-white">Phone Number</h6>
                <h6 class="small-text mt-3">+234 909 332 9909</h6>
                <div class="text-center mt-5">
                    <button class="long-btn waves-effect waves-dark p-2" id="2" onclick="hideNumber(this.id)">Cancel</button>
                </div>
            </div>  
            <div class="mcard-bottom">
                <div class="mbottom-content">
                    <h6 class="muted-small">From</h6>
                    <h6 class="muted-small">To</h6>
                </div>
                <div class="mbottom-content">
                    <h6 class="mbottom-txt">Ikeja (Lagos)</h6>
                    <h6 class="mbottom-txt">Ikorodu (Lagos)</h6>
                </div>
                <div class="mbottom-content mt-3">
                    <h6 class="muted-small">Trucktype</h6>
                    <h6 class="muted-small">Posted</h6>
                </div>
                <div class="mbottom-content mb-4">
                    <h6 class="mbottom-txt">Flatbed Van</h6>
                    <h6 class="mbottom-txt">2-2-2020</h6>
                </div>
                <div class="text-center mb-2">
                    <button class="long-btn waves-effect waves-dark p-2" id="2" onclick="showNumber(this.id)">Call</button>
                </div>
            </div>        
        </div>
        <div class="market-card">
            <div class="mcard-top">
                <img src="/images/market.png" class="m-img" alt="Loaded Van">
            </div>
            <div class="light-overlay text-center overlay3">
                <h6 class="small-text mt-3 text-white">Phone Number</h6>
                <h6 class="small-text mt-3">+234 909 332 9909</h6>
                <div class="text-center mt-5">
                    <button class="long-btn waves-effect waves-dark p-2" id="3" onclick="hideNumber(this.id)">Cancel</button>
                </div>
            </div>  
            <div class="mcard-bottom">
                <div class="mbottom-content">
                    <h6 class="muted-small">From</h6>
                    <h6 class="muted-small">To</h6>
                </div>
                <div class="mbottom-content">
                    <h6 class="mbottom-txt">Ikeja (Lagos)</h6>
                    <h6 class="mbottom-txt">Ikorodu (Lagos)</h6>
                </div>
                <div class="mbottom-content mt-3">
                    <h6 class="muted-small">Trucktype</h6>
                    <h6 class="muted-small">Posted</h6>
                </div>
                <div class="mbottom-content mb-4">
                    <h6 class="mbottom-txt">Flatbed Van</h6>
                    <h6 class="mbottom-txt">2-2-2020</h6>
                </div>
                <div class="text-center mb-2">
                    <button class="long-btn waves-effect waves-dark p-2" id="3" onclick="showNumber(this.id)">Call</button>
                </div>
            </div>        
        </div>
        <div class="market-card">
            <div class="mcard-top">
                <img src="/images/market.png" class="m-img" alt="Loaded Van">
            </div>
            <div class="light-overlay text-center overlay4">
                <h6 class="small-text mt-3 text-white">Phone Number</h6>
                <h6 class="small-text mt-3">+234 909 332 9909</h6>
                <div class="text-center mt-5">
                    <button class="long-btn waves-effect waves-dark p-2" id="4" onclick="hideNumber(this.id)">Cancel</button>
                </div>
            </div>  
            <div class="mcard-bottom">
                <div class="mbottom-content">
                    <h6 class="muted-small">From</h6>
                    <h6 class="muted-small">To</h6>
                </div>
                <div class="mbottom-content">
                    <h6 class="mbottom-txt">Ikeja (Lagos)</h6>
                    <h6 class="mbottom-txt">Ikorodu (Lagos)</h6>
                </div>
                <div class="mbottom-content mt-3">
                    <h6 class="muted-small">Trucktype</h6>
                    <h6 class="muted-small">Posted</h6>
                </div>
                <div class="mbottom-content mb-4">
                    <h6 class="mbottom-txt">Flatbed Van</h6>
                    <h6 class="mbottom-txt">2-2-2020</h6>
                </div>
                <div class="text-center mb-2">
                    <button class="long-btn waves-effect waves-dark p-2" id="4" onclick="showNumber(this.id)">Call</button>
                </div>
            </div>        
        </div>
        <div class="market-card">
            <div class="mcard-top">
                <img src="/images/market.png" class="m-img" alt="Loaded Van">
            </div>
            <div class="light-overlay text-center overlay5">
                <h6 class="small-text mt-3 text-white">Phone Number</h6>
                <h6 class="small-text mt-3">+234 909 332 9909</h6>
                <div class="text-center mt-5">
                    <button class="long-btn waves-effect waves-dark p-2" id="5" onclick="hideNumber(this.id)">Cancel</button>
                </div>
            </div>  
            <div class="mcard-bottom">
                <div class="mbottom-content">
                    <h6 class="muted-small">From</h6>
                    <h6 class="muted-small">To</h6>
                </div>
                <div class="mbottom-content">
                    <h6 class="mbottom-txt">Ikeja (Lagos)</h6>
                    <h6 class="mbottom-txt">Ikorodu (Lagos)</h6>
                </div>
                <div class="mbottom-content mt-3">
                    <h6 class="muted-small">Trucktype</h6>
                    <h6 class="muted-small">Posted</h6>
                </div>
                <div class="mbottom-content mb-4">
                    <h6 class="mbottom-txt">Flatbed Van</h6>
                    <h6 class="mbottom-txt">2-2-2020</h6>
                </div>
                <div class="text-center mb-2">
                    <button class="long-btn waves-effect waves-dark p-2" id="5" onclick="showNumber(this.id)">Call</button>
                </div>
            </div>        
        </div>
	</div>
</section>
@endsection
@section('scripts')
    @parent
    <script type="module">
        window.showNumber = function(id)
        {
            $('.overlay'+id).addClass('d-flex justify-content-center flex-column')
            $('.overlay'+id).show(500)
        }
        window.hideNumber = function(id) {
            $('.overlay'+id).removeClass('d-flex justify-content-center align-items-end flex-column')
            $('.overlay'+id).hide(500)
        }
    </script>
@endsection