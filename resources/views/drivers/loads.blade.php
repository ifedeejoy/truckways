@extends('layouts.drivers.app')
@section('title', 'Loads')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card">
            <div class="home-options border-primary">
                <h6 class="small-text bold"> active loads</h6>
                <h6 class="small-text bold"> trucks available</h6>
                <h6 class="small-text bold"> pending bills</h6>
            </div>
            <div class="table-responsive mt-5 p-4">
                <table class="table table-striped bg-white black-text table-border text-center" id="all-loads" cellspacing="0" width="100%">
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
                        @foreach ($loads as $load)
                        <tr class="clickable-row" data-href="/drivers/load/{{$load->reference}}">
                            <td>{{$load->created_at}}</td>
                            <td>{{$load->reference}}</td>
                            <td>{{$load->pickup}}</td>
                            <td>{{$load->delivery}}</td>
                            <td>{{number_format($load->budget)}}</td>
                            <td>{{$load->truck_type}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
			$('#all-loads').DataTable({
				// "dom": '<"top"i>rt<"bottom"><"clear">'
			});
		});
	</script>
	
@endsection
