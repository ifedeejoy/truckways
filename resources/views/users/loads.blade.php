@extends('layouts.users.app')
@section('title', 'Loads')
@section('content')
    <div class="col-sm-12 p-3 pr-5 pl-5">
        <div class="custom-card p-3">
            <div class="row pl-4 pt-3">
                <a href="/users/post-load"class="btn btn-md btn-primary rounded-btn"> <span class="plus-icon"><i class="fas fa-plus"></i></span> New Load</a>
                <a href="#" data-toggle="modal" data-target="#check-load" class="btn btn-md btn-gray rounded-btn">Check Load Status</a>
            </div>
            <div class="table-responsive mt-5 pl-4">
                <table class="table table-striped bg-white black-text table-border text-center" id="all-loads" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Reference</th>
                            <th scope="col">Location</th>
                            <th scope="col">Destination</th>
                            <th scope="col">Budget</th>
                            <th scope="col">Truck Type</th>
                            <th scope="col">Bids</th>
                            <th scope="col">View</th>
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
                            <th scope="col">Bids</th>
                            <th scope="col">View</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($loads as $load)
                        <tr>
                            <td>{{$load->created_at}}</td>
                            <td>{{$load->reference}}</td>
                            <td>{{$load->pickup}}</td>
                            <td>{{$load->delivery}}</td>
                            <td>{{number_format($load->budget)}}</td>
                            <td>{{$load->truck_type}}</td>
                            <td>{{$load->bids}}</td>
                            <td><a href="/users/load/{{$load->id}}}" class="btn btn-primary btn-sm">View</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<!-- Modal -->
<div class="modal fade" id="check-load" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Check Load Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <form action="{{route('search-load')}}" method="post">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <div class="md-form col-sm-9">
                            <input type="text" name="load" class="form-control">
                            <label class="primary-text">Enter Load Id</label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-md btn-primary rounded-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
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
			$('#all-loads').DataTable({
				// "dom": '<"top"i>rt<"bottom"><"clear">'
			});
		});
	</script>
	
@endsection
