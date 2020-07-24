@extends('layouts.admin.app')
@section('title', 'Trips')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card p-3">
            <div class="home-options justify-content-center border-0">
                <ul class="nav nav-tabs users-tab">
                    <li class="tab active p-2 pt-0">
                        <a class="bold small-text black-text" data-toggle="tab" href="#open">Open Requests</a>
                    </li>
                    <li class="tab p-2 pt-0">
                        <a class="bold small-text black-text" data-toggle="tab" href="#active">Active Trips</a>
                    </li>
                    <li class="tab p-2 pt-0">
                        <a class="bold small-text black-text" data-toggle="tab" href="#closed">Closed Requests</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <div id="open" class="tab-pane fadeIn active">
                    <div class="table-responsive pl-4">
                        <div class="table-responsive mt-5 pl-4">
                            <table class="table table-striped bg-white black-text table-border text-center" id="open-loads" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Reference</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Destination</th>
                                        <th scope="col">Budget</th>
                                        <th scope="col">Truck Type</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">Reference</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Destination</th>
                                        <th scope="col">Budget</th>
                                        <th scope="col">Truck Type</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($openTrips as $open)
                                    <tr class="clickable-row" data-href="/admin/load/{{$open->id}}">
                                        <td>{{$open->created_at}}</td>
                                        <td>{{$open->reference}}</td>
                                        <td>{{$open->pickup}}</td>
                                        <td>{{$open->delivery}}</td>
                                        <td>{{number_format($open->budget)}}</td>
                                        <td>{{$open->truck_type}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="active" class="tab-pane fade">
                    <div class="table-responsive pl-4">
                        <table class="table table-striped bg-white black-text table-border text-center" id="active-loads" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Reference</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Budget</th>
                                    <th scope="col">Truck Type</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Reference</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Budget</th>
                                    <th scope="col">Truck Type</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($activeTrips as $active)
                                <tr class="clickable-row" data-href="/admin/active/{{$active->id}}">
                                    <td>{{$active->created_at}}</td>
                                    <td>{{$active->reference}}</td>
                                    <td>{{$active->pickup}}</td>
                                    <td>{{$active->delivery}}</td>
                                    <td>{{number_format($active->budget)}}</td>
                                    <td>{{$active->truck_type}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="closed" class="tab-pane fade">
                    <div class="table-responsive pl-4">
                        <table class="table table-striped bg-white black-text table-border text-center" id="closed-loads" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Reference</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Budget</th>
                                    <th scope="col">Truck Type</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Reference</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Destination</th>
                                    <th scope="col">Budget</th>
                                    <th scope="col">Truck Type</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($closedTrips as $closed)
                                <tr class="clickable-row" data-href="/admin/load/{{$closed->id}}">
                                    <td>{{$closed->created_at}}</td>
                                    <td>{{$closed->reference}}</td>
                                    <td>{{$closed->pickup}}</td>
                                    <td>{{$closed->delivery}}</td>
                                    <td>{{number_format($closed->budget)}}</td>
                                    <td>{{$closed->truck_type}}</td>
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
            $('#open-loads').DataTable();
            $('#active-loads').DataTable();
		});
	</script>
	
@endsection
