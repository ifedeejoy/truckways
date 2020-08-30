@extends('layouts.agents.app')
@section('title', 'Users')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card p-3">
            <div class="home-options justify-content-center border-0">
                <div class="row d-flex justify-content-between">
                    <a data-toggle="modal" data-target="#create-driver" class="btn btn-md btn-primary rounded-btn"> <span class="plus-icon"><i class="fas fa-plus"></i></span> New Driver</a>
                </div>
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
            <div class="table-responsive pl-4">
                <table class="table table-striped bg-white black-text table-border text-center" id="all-drivers" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Profile Created</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Profile Created</th>
                            <th scope="col">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($drivers as $driver)
                        <tr>
                            <td>{{$driver->name}}</td>
                            <td>{{$driver->email}}</td>
                            <td>{{$driver->phone}}</td>
                            <td>{{$driver->created_at}}</td>
                            <td><a href="/agents/driver/{{$driver->id}}" class="btn btn-sm btn-primary btn-rounded">View Profile</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<div class="modal fade" id="create-driver" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Register Drivers</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form action="{{route('create-driver')}}" method="POST" class="mt-5" enctype="multipart/form-data">
                    @csrf
                    <div class="md-form">
                        <input id="name" type="text" class="form-control primary-text" required autocomplete="off" name="name">
                        <label for="name">Name</label>
                    </div>

                    <div class="md-form">
                        <input type="email" class="form-control primary-text" required autocomplete="off" name="email">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                    </div>

                    <div class="md-form">
                        <input id="phone" type="text" class="form-control primary-text" required autocomplete="off" name="phone">
                        <label for="phone">Phone Number</label>
                    </div>

                    <div class="md-form">
                        <input id="adress" type="text" class="form-control primary-text" required autocomplete="off" name="adress">
                        <label for="adress">Address</label>
                    </div>

                    <div class="md-form">
                        <input id="password" type="password" class="form-control primary-text" name="password" required autocomplete="new-password">
                        <label>{{ __('Password') }}</label>
                    </div>

                    <div class="md-form">
                        <input id="password-confirm" type="password" class="form-control primary-text" name="password_confirmation" required autocomplete="new-password">
                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    </div>

                    <div class="md-form">
                        <input type="text" name="license" id="license" class="form-control" required>
                        <label for="">Drivers License</label>
                    </div>

                    <div class="md-form">
                        <input type="text" name="account_number" id="account_number" class="form-control" required>
                        <label for="">Account Number</label>
                    </div>

                    <div class="md-form">
                        <input type="text" name="bank" id="bank" class="form-control" required>
                        <label for="">Bank</label>
                    </div>

                    <div class="md-form mt-3">
                        <div class="d-flex justify-content-around">
                            <h6 class="small-text mt-3">Profile Picture</h6>
                            <input type="file" name="profilePicture" class="file-input truck-file w-60" required accept="image/*">
                        </div>
                    </div>

                    <div class="md-form mt-3">
                        <div class="d-flex justify-content-around">
                            <h6 class="small-text mt-3">License Image <br><span class="smaller-text">Upload multiple images of your license</span></h6>
                            <input type="file" name="licenseImages[]" class="file-input truck-file w-60" accept="image/*" required multiple>
                        </div>
                    </div>

                    <input type="hidden" name="createdBy" value="{{auth()->user()->name}}">
    
                    <div class="text-center mb-5">
                        <button type="submit" class="long-btn waves-effect waves-dark p-2">
                            {{ __('Register') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('scripts')
	@parent
	<script src="/js/datatables.min.js" defer></script>
	<script src="/js/datatables-select.min.js" defer></script>
	<script type="module">
		$(document).ready(function () {
            $('#all-drivers').DataTable();
		});
	</script>
	
@endsection
