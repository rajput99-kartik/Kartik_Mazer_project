@extends('backend.layouts.master')
@section('title','Carrier Management')
@section('content')
	<!--start page wrapper -->

    <div class="page-wrapper">
		<div class="page-content">
			<!--breadcrumb-->
			<!--<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">-->
			<!--	<div class="breadcrumb-title pe-3">Crriers</div>-->
			<!--	<div class="ps-3">-->
			<!--		<nav aria-label="breadcrumb">-->
			<!--			<ol class="breadcrumb mb-0 p-0">-->
			<!--				<li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>-->
			<!--				</li>-->
			<!--				<li class="breadcrumb-item active" aria-current="page">Carrier Management</li>-->
			<!--			</ol>-->
			<!--		</nav>-->
			<!--	</div>-->

			<!--	<div class="ms-auto">-->
			<!--		<div class="btn-group">-->
			<!--			<a class="btn btn-primary" href="{{ url('admin/new-carrier') }}"> Create New Carrier</a>-->
			<!--		</div>-->
			<!--	</div>-->
			<!--</div>-->

			<!--end breadcrumb-->
			@if ($message = Session::get('success'))
			<div class="alert alert-success">
			    <p>{{ $message }}</p>
			</div>
			@endif
			
			<ul class="nav nav-tabs">
				@can('carrier-all')
				<li> <a href="{{url('admin/carrier/list')}}">All Carriers</a></li>
				@endcan
				<li class="active"><a href="{{url('/admin/carrier')}}" data-toggle="tab" aria-expanded="true">Carrier</a>
				</li>
				@can('carrier-create')
                <li class="all_leave"><a href="{{url('/admin/new/carrier/detail')}}" data-toggle="tab" aria-expanded="false">Create Carrier</a></li>
				@endcan
                <li class=""><a href="{{url('/admin/carrier/myCarrierPacket')}}" data-toggle="tab" aria-expanded="false">MyCarrierPacket</a>
                </li>
				<li class="" ><a href="{{url('/admin/carrier/disputed')}}" data-toggle="tab" aria-expanded="false">Disputed Carrier</a>
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
						 <th width="170px">Action</th>
					  </tr>
						</thead>
						@php
							$i = 0;
						@endphp
						@if(count($carriers_data) > 0)
						@foreach ($carriers_data as $key => $carriers_result)

							@if ($carriers_result->carrier_disputed == 0)
								<tr>
									<td> {{ ++$i }} </td>
									<td class="copy-text">{{ $carriers_result->mc_no }}</td>
									<td class="copy-text">{{ $carriers_result->dot_no }}</td>
									<td class="copy-text">{{ substr($carriers_result->c_company_name, 0, 15).".." }}</td>
									<td>{{ substr($carriers_result->carrier_city, 0, 15).".." }}</td>
									<td>{{ $carriers_result->carrier_city_main }}</td>
									<td>
										
										@if($carriers_result->status == '0')
											<div class="badge rounded-pill text-white bg-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Pending</div>
										@elseif($carriers_result->status == '1')
											<div class="badge rounded-pill text-white bg-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Approve</div>
										@else
											<div class="badge rounded-pill text-white bg-warning p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Disapprove</div>
										@endif

									</td>
									<td class="action_tooltip">


										<button type="button" id="" class="btn btn-outline-info btn-sm radius-30 px-4 carrier_edit" value="{{ $carriers_result->id }}"> <i class="bx bx-show"></i> <span class="tooltip">View</span></button>


										<?php if($carriers_result->status == 2){ ?>



											<form method="POST" action="{{url('admin/carrier/request/resend'.'/'.base64_encode($carriers_result->id) )}}" accept-charset="UTF-8" style="display:inline">

											<input name="_method" type="hidden" value="POST">

											@csrf

											<button onclick="return confirm('Are You Sure Re-send This Requets..!')" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="fadeIn animated bx bx-refresh"></i> <span class="tooltip">Re-send</span></button>

											</form>

											<?php } ?>


										@can('role-edit')
										<button type="button" id="" class="btn btn-outline-secondary btn-sm radius-30 px-4 carrier_edit" value="{{ $carriers_result->id }}"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></button>
										@endcan
									</td>
								</tr>
							@endif
						@endforeach
						    @else
                                <tr style="background-color: #edf3f652;">
                                    <td colspan="9">
                                        <div class="row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4 not-found">
                                                <img src="{{url('/public/backend/assets/images/message.png')}}">
                                                <h4> No Carrier created, yet.</h4>
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
