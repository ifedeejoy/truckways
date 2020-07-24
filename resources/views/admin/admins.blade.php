@extends('layouts.admin.app')
@section('title', 'Admin Profiles')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card p-3">
            <div class="row pl-4 pt-3">
                <a href="#" data-target="#new-admin" data-toggle="modal" class="btn btn-md btn-primary rounded-btn"> <span class="plus-icon"><i class="fas fa-plus"></i></span> New Admin</a>
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
            <div class="table-responsive mt-5 pl-4">
                <table class="table table-striped bg-white black-text table-border text-center" id="all-admins" cellspacing="0" width="100%">
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
                            <th scope="col">Reference</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Profile Created</th>
                            <th scope="col">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($admins as $admin)
                        <tr>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->email}}</td>
                            <td>{{$admin->phone}}</td>
                            <td>{{$admin->created_at}}</td>
                            <td>
                                <form action="{{route('delete-admin', $admin->id)}}" method="post">
                                    @csrf
                                    <button class="btn btn-sm btn-rounded btn-primary">Delete Profile</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<div class="modal fade" id="new-admin" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Check Load Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form action="{{route('create-admin')}}" method="post">
                    @csrf
                    <div class="md-form">
                        <input type="text" name="name" class="form-control">
                        <label>Full Name</label>
                    </div>
                    <div class="md-form">
                        <input type="email" name="email" class="form-control">
                        <label>Email</label>
                    </div>
                    <div class="md-form">
                        <input type="text" name="phone" class="form-control">
                        <label>Phone</label>
                    </div>
                    <div class="md-form">
                        <input type="password" name="password" class="form-control">
                        <label>Password</label>
                    </div>
                    <button type="submit" class="btn btn-md btn-primary rounded-btn">Submit</button>
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
			$('#all-admins').DataTable();
		});
	</script>
	
@endsection
