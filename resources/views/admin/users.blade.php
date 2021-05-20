@extends('layouts.admin.app')
@section('title', 'Admin Profiles')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card p-3">
            <div class="home-options justify-content-center border-0">
                <ul class="nav nav-tabs users-tab">
                    <li class="tab active p-2 pt-0">
                        <a class="bold small-text black-text" data-toggle="tab" href="#users">Users</a>
                    </li>
                    <li class="tab active p-2 pt-0">
                        <a class="bold small-text black-text" data-toggle="tab" href="#agents">Agents</a>
                    </li>
                    <li class="tab p-2 pt-0">
                        <a class="bold small-text black-text" data-toggle="tab" href="#drivers">Drivers</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="users" class="tab-pane fadeIn active">
                    <div class="table-responsive pl-4">
                        <table class="table table-striped bg-white black-text table-border text-center" id="all-users" cellspacing="0" width="100%">
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
                                @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td>{{$user->phone}}</td>
                                    <td>{{$user->created_at}}</td>
                                    <td><a href="/admin/user/{{$user->id}}" class="btn btn-sm btn-primary btn-rounded">View Profile</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="agents" class="tab-pane fade">
                    <div class="table-responsive pl-4">
                        <table class="table table-striped bg-white black-text table-border text-center" id="all-agents" cellspacing="0" width="100%">
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
                                @foreach ($agents as $agent)
                                <tr>
                                    <td>{{$agent->name}}</td>
                                    <td>{{$agent->email}}</td>
                                    <td>{{$agent->phone}}</td>
                                    <td>{{$agent->created_at}}</td>
                                    <td><a href="/admin/agent/{{$agent->id}}" class="btn btn-sm btn-primary btn-rounded">View Profile</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="drivers" class="tab-pane fade">
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
                                    <td><a href="/admin/driver/{{$driver->id}}" class="btn btn-sm btn-primary btn-rounded">View Profile</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
	@parent
	<script src="/js/datatables.min.js" defer></script>
	<script src="/js/datatables-select.min.js" defer></script>
	<script type="module">
		$(document).ready(function () {
            $('#all-users').DataTable();
            $('#all-drivers').DataTable();
            $('#all-agents').DataTable();
		});
	</script>
	
@endsection
