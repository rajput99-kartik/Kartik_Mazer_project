@extends('backend.layouts.master')
@section('title','Carrier Management')
@section('content')
	<!--start page wrapper -->

    <div class="page-wrapper">
		<div class="page-content">
			
			@if ($message = Session::get('success'))
			<div class="alert alert-success">
			    <p>{{ $message }}</p>
			</div>
			@endif
			
			<ul class="nav nav-tabs">
				@can('carrier-all')
				<li> <a href="{{url('admin/carrier/list')}}">All Carriers</a></li>
				@endcan
				<li class=""> <a href="{{url('admin/carrier/manager/list')}}">Team Carriers</a></li>
				<li class="active"><a href="{{url('/admin/carrier')}}" data-toggle="tab" aria-expanded="true">Carrier</a>
				</li>
				@can('carrier-create')
                <li class="all_leave"><a href="{{url('/admin/new/carrier/detail')}}" data-toggle="tab" aria-expanded="false">Create Carrier</a></li>
				@endcan
                    <li class=""><a href="{{url('/admin/carrier/myCarrierPacket')}}" data-toggle="tab" aria-expanded="false">MyCarrierPacket</a>
                </li>
            </ul>
			<div class="card">
				<div class="card-body table-responsive">
				    
					<table class="table" id="carrier_table">
					<thead class="table-light">
					  <tr>
						 <th>No</th>
						 <th>MC Number</th>
						 <th>DOT Number</th>
						 <th>Carrier Name</th>
						 <th>Address</th>
						 <th>State</th>
						 <th>Status</th>
						 <th>Broker</th>
						 <th width="170px">Action</th>
					  </tr>
						</thead>
						@php
							$i = 0;
						@endphp
						@foreach ($carriers_data as $key => $carriers_result)
							<tr>
								<td> {{ ++$i }} </td>
								<td>{{ $carriers_result->mc_no }}</td>
								<td>{{ $carriers_result->dot_no }}</td>
								<td>{{ substr($carriers_result->c_company_name, 0, 15).".." }}</td>
								<td>{{ substr($carriers_result->carrier_city, 0, 15).".." }}</td>
								<td>{{ $carriers_result->carrier_city_main }}</td>
								<td>
									
								    @if($carriers_result->status == '0')
										{{'Pending'}}
									@elseif($carriers_result->status == '1')
										{{'Approve'}}
									@else
										{{'Disapprove'}}
									@endif

								</td>
								@php
									$user =  App\Models\User::where('id',$carriers_result['user_id'])->first();
									$name= isset($user['name']) ? $user['name'] : null;
								@endphp
								<td>{{ucfirst($name)}}</td>
								<td class="action_tooltip">
									<button type="button" id="" class="btn btn-outline-info btn-sm radius-30 px-4 carrier_edit" value="{{ $carriers_result->id }}"> <i class="bx bx-show"></i> <span class="tooltip">View</span></button>
									@can('role-edit')
									<button type="button" id="" class="btn btn-outline-secondary btn-sm radius-30 px-4 carrier_edit" value="{{ $carriers_result->id }}"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></button>
									@endcan
								</td>
							</tr>
						@endforeach

					</table>
		
			</div>
		</div>





		</div>
	</div>
<!--end page wrapper -->

  

<!-- New carrier add form Modal start -->
<div class="modal" id="add_new_carrier_form">
</div>
<!-- New carrier add form Modal end -->

<!-- New carrier add form Modal start -->
<div class="modal" id="edit_carrier_form">
</div>
<!-- New carrier add form Modal end -->





@include('backend.common.footer')

@endsection
