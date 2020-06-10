@extends('layouts.app')
@section('title', 'Find Truck')
@section('bg', 'find-truck.png')
@section('page-title', 'Find Trucks')
@section('page-caption', 'Search for a specific truck to know more about the details')
@section('content')

<section class="latest-loads animated fadeInUp delay-1s mt-5">
	<div class="container">
		<div class="table-responsive mt-5">
			<table class="table" cellspacing="0" id="find-trucks" width="100%">
				<thead>
					<tr>
						<th>Date</th>
						<th>Load Title</th>
						<th>Location</th>
						<th>Destination</th>
						<th>Price</th>
						<th>Truck Type</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>Date</th>
						<th>Load Title</th>
						<th>Location</th>
						<th>Destination</th>
						<th>Price</th>
						<th>Truck Type</th>
					</tr>
				</tfoot>
				<tbody>
					<tr>
						<td>2020-04-19</td>
						<td>Quick House Move</td>
						<td>Ikeja, Lagos</td>
						<td>Admiralty, Lekki</td>
						<td>$100</td>
						<td>Flat Bed Truck</td>
					</tr>
					<tr>
						<td>2020-04-19</td>
						<td>Quick House Move</td>
						<td>Ikeja, Lagos</td>
						<td>Admiralty, Lekki</td>
						<td>$100</td>
						<td>Flat Bed Truck</td>
					</tr>
					<tr>
						<td>2020-04-19</td>
						<td>Quick House Move</td>
						<td>Ikeja, Lagos</td>
						<td>Admiralty, Lekki</td>
						<td>$100</td>
						<td>Flat Bed Truck</td>
					</tr>
					<tr>
						<td>2020-04-19</td>
						<td>Quick House Move</td>
						<td>Ikeja, Lagos</td>
						<td>Admiralty, Lekki</td>
						<td>$100</td>
						<td>Flat Bed Truck</td>
					</tr>
					<tr>
						<td>2020-04-19</td>
						<td>Quick House Move</td>
						<td>Ikeja, Lagos</td>
						<td>Admiralty, Lekki</td>
						<td>$100</td>
						<td>Flat Bed Truck</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</section>
@endsection
@section('scripts')
	@parent
	<script src="/js/datatables.min.js" defer></script>
	<script src="/js/datatables-select.min.js" defer></script>
	<script type="module">
		$(document).ready(function () {
			$('#find-trucks').DataTable({
				// "dom": '<"top"i>rt<"bottom"><"clear">'
			});
		});
	</script>
	<script type="module">
		$('#find-trucks_filter').remove();
	</script>
@endsection