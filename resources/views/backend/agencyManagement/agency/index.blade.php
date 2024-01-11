@extends('backend.layouts.master')
@section('title','Office Management')
@section('content')

	<!--start page wrapper -->
	<div class="page-wrapper">
		<div class="page-content">
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                    <p>{{ $message }}</p>
                    </div>
                    @endif
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                    </div>
                    @endif
			<ul class="nav nav-tabs">
                <li class="pending_approval active"><a href="{{url('/admin/agency')}}" data-toggle="tab" aria-expanded="true">All Office</a>
                </li>
    
                <li class="all_leave"><a href="{{url('/admin/agency/create')}}" data-toggle="tab" aria-expanded="false">Create New</a>
                    </li>
            </ul>
			<div class="card">
				<div class="card-body">
					<div class="d-lg-flex align-items-center mb-4 gap-3">
						
						<!-- <div class="ms-auto"><a href="{{ route('users.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New User</a></div> -->
					</div>
					<div class="table-responsive" >
						
						<table class="table mb-0" id="carrier_table">
						<thead class="table-light">
							<tr>
								<th>No</th>
								<th>Office</th>
								<th>Contact Name</th>
								<th>Email</th>
								<th>Official Email</th>
								<th>Phone</th>
								<th width="154px;">Action</th>
							</tr>
						 </thead>
							
							@php 
							$i=0;
							@endphp
							@if(count($agency_data) > 0)
							@foreach ($agency_data as $key => $agency)
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ $agency->agencies_name }}</td>
								<td>{{ $agency->name }}</td>
								<td>{{ $agency->p_email }}</td>
								<td>{{ $agency->agencies_email }}</td>
								<td>{{ $agency->agencies_phone }}</td>
								
								<td class="action_tooltip">
	                                 @can('agency-view')
	                                 
	                                 @php
                                    	//$roleid = Crypt::encrypt($role->id);
                                    	$nm= 'xuvlogis023';
                                    	$agencyid = base64_encode($nm.$agency->id);
                                    @endphp
                                    
	                                 <a class="btn btn-outline-info btn-sm radius-30 px-4" href="{{url('admin/agency/manage/user/').'/'.$agencyid }}"> <i class="bx bx-show"></i> <span class="tooltip">View</span></a>
									<!--<button type="button" id="" class="btn btn-outline-info btn-sm radius-30 px-4 agency_detail_form" value="{{ $agency->id }}"><i class="bx bx-show"></i><span class="tooltip">View</span></button>-->
								    @endcan
									@can('agency-edit')
									<button type="button" class="btn btn-outline-secondary btn-sm radius-30 px-4 agency_detail_form" value="{{ $agency->id }}"><i class="bx bx-edit"></i><span class="tooltip">Edit</span></button>
									 @endcan
									
								</td>
							</tr>
							@endforeach
							@else
                            <tr style="background-color: #edf3f652;">
                                <td colspan="7">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 not-found">
                                            <img src="{{url('/public/backend/assets/images/message.png')}}">
                                            <h4> No Office created, yet.</h4>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </td>
                            </tr>
                            @endif
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end page wrapper -->



<!-- Agency form modal start -->
<div class="modal" id="agency_detail_edit">
</div>
<!-- Agency form modal end -->
	
<script>
    $(document).ready(function() {
    $('#carrier_table').DataTable( {
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible'
                }
                
            },
            'colvis'
        ],
        columnDefs: [ {
            // targets: +0,
            visible: false
        } ]
    } );
} );
</script>



@include('backend.common.footer')
@endsection
