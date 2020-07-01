@extends('layouts.drivers.app')
@section('title', 'Loads')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options bg-primary white-text justify-content-between">
                Add New Vehicle
            </div>
            <div class="load-container p-4">
                <div class="truck-card truck-form">
                    <h6 class="small-text primary-text">Truck details</h6>
                    <form action="{{route('edit-truck', $truck->id)}}" method="POST" id="truck-edit">
                        @csrf
                        <div class="d-flex justify-content-between mt-4">
                            <h6 class="bold small-text">Truck Name</h6>
                            <div class="md-form mt-n3 ml-n10">
                                <input type="text" class="form-control" name="name" value="{{$truck->name}}" readonly>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="bold small-text">Truck Model</h6>
                            <div class="md-form mt-n3 ml-n10">
                                <input type="text" class="form-control" name="model" value="{{$truck->model}}" readonly>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="bold small-text">Truck Type</h6>
                            <div class="md-form mt-n3 ml-n10">
                                <input type="text" class="form-control" name="type" value="{{$truck->type}}" readonly>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="bold small-text">Plate Number</h6>
                            <div class="md-form mt-n3 ml-n10">
                                <input type="text" class="form-control" name="plate_number" value="{{$truck->plate_number}}" readonly>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="truck-card transparent-truck">
                    <div class="gray-card mb-3">
                        <h6 class="small-text primary-text">Images</h6>
                        @foreach (json_decode($truck->images) as $image)
                            @if($loop->first)
                            <div class="text-center">
                                <img src="{{asset($image)}}" class="img-fluid" alt="" style="height: 150px;">
                            </div>
                                @break
                            @endif
                        @endforeach
                        @foreach (json_decode($truck->images) as $image)
                        <div class="text-center">
                            <div class='preview-card mt-5'>
                                <img class='banner-form-preview' src="{{asset($image)}}">
                            </div>
                        </div>
                        @endforeach
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
                    <div class="gray-card w-100 d-flex flex-row text-center p-3 mt-5">
                        <div id="edit-section">
                            <button class="btn btn-md btn-primary" id="edit-truck" onclick="editTruck()" type="button">Edit Truck</button>
                        </div>
                        <form action="{{route('delete-truck', $truck->id)}}" id="delete-truck" method="POST">
                            @csrf
                            <button class="btn btn-md btn-danger" form="delete-truck" type="submit">Delete Truck</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        function editTruck()
        {
            let type = $("#edit-truck").prop('type')
            if(type == 'button'){
                $(".form-control").prop('readonly', false)
                $("#edit-truck").remove()
                $("#edit-section").append(
                    '<button class="btn btn-md btn-primary" type="submit" form="truck-edit">Submit Edit</button>'
                )
            }
        }
    </script>
@endsection
