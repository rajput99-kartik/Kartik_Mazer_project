@extends('backend.layouts.master')
@section('title','Office Management')
@section('content')

	<!--start page wrapper -->
	<div class="page-wrapper">
		<div class="page-content">
            <div class="row">
                <div class="col-md-3 pl-lg">
                    <!-- START widget-->
                    <div class="panel widget bg-gradient-deepblue">
                        <div class="pl-sm pr-sm pb-sm">
                            <strong><a style="font-size: 15px" class="b_status" search-type="unconfirmed" id="unconfirmed" href="#">Inactive
</a>
                                <small class="pull-right " style="padding-top: 2px"> 0                            / 0</small>
                            </strong>
                            <div class="progress progress-striped progress-xs mb-sm">
                                <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                    <!-- END widget-->
                </div>
                <div class="col-md-3">
                    <!-- START widget-->
                    <div class="panel widget bg-gradient-ibiza">
                        <div class="pl-sm pr-sm pb-sm">
                            <strong><a style="font-size: 15px" class="b_status" search-type="confirmed" id="confirmed" href="#">Service
</a>
                                <small class="pull-right " style="padding-top: 2px"> 0                            / 0</small>
                            </strong>
                            <div class="progress progress-striped progress-xs mb-sm">
                                <div class="progress-bar progress-bar-info " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                    <!-- END widget-->
                </div>
                <div class="col-md-3">
                    <!-- START widget-->
                    <div class="panel widget bg-gradient-moonlit">
                        <div class="pl-sm pr-sm pb-sm">
                            <strong><a style="font-size: 15px" class="b_status" search-type="in_progress" id="in_progress" href="#">In Progress</a>
                                <small class="pull-right " style="padding-top: 2px"> 0                            / 0</small>
                            </strong>
                            <div class="progress progress-striped progress-xs mb-sm">
                                <div class="progress-bar progress-bar-warning " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                    <!-- END widget-->
                </div>
        
                <div class="col-md-3">
                    <!-- START widget-->
                    <div class="panel widget bg-gradient-ohhappiness">
                        <div class="pl-sm pr-sm pb-sm">
                            <strong><a style="font-size: 15px" class="b_status" search-type="resolved" id="resolved" href="#">Resolved</a>
                                <small class="pull-right " style="padding-top: 2px"> 0                            / 0</small>
                            </strong>
                            <div class="progress progress-striped progress-xs mb-sm">
                                <div class="progress-bar progress-bar-danger " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                    <!-- END widget-->
                </div>
            </div>
			@if ($message = Session::get('success'))
			<div class="alert alert-success">
			<p>{{ $message }}</p>
			</div>
			@endif
			<ul class="nav nav-tabs">
                <li class="pending_approval active"><a href="{{url('/admin/carrierac')}}" data-toggle="tab" aria-expanded="true">Carrier List</a>
                </li>
    
                <!--<li class="all_leave"><a href="{{url('/admin/carrierac/add')}}" data-toggle="tab" aria-expanded="false">Create New</a></li>-->
            </ul>
			<div class="card">
				<div class="card-body">
					<div class="d-lg-flex align-items-center mb-4 gap-3">
						
						<!-- <div class="ms-auto"><a href="{{ route('users.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New User</a></div> -->
					</div>
					<div class="table-responsive">
						
						<table class="table mb-0" id="carrier_table">
						<thead class="table-light">
						
							<tr>
								<th>No</th>
								<th style="width:300px">Company Name</th>
								<th>Mc No.</th>
								<th>Dot No</th>
								<th>Agent</th>
								<th>Date</th>
								<th width="50;">Action</th>
							</tr>
						 </thead>
							
							@php 
							$i=0;
							@endphp
							@foreach ($data as $key => $cac)
                                @php
                                
                                //dd($cac);
                                    $agency_data = App\Models\Carriers::where('id',$cac->carrier_id)->first();
                                    //dd($agency_data);
                                    
                                    $did = $agency_data->user_id;

                                   // dd($did);
                                    $userdata = App\Models\User::where('id',$did)->first();
                                   // $uname = $userdata->name ;

                                    //dd($uname);
                                @endphp
							<tr>
								<td>{{ ++$i }}</td>
								<td class="copy-text">{{  isset($agency_data->c_company_name) ? $agency_data->c_company_name : Null  }}</td>
								<td class="copy-text">{{isset($agency_data->mc_no ) ? $agency_data->mc_no  : Null }}</td>
								<td class="copy-text">{{ isset($agency_data->dot_no) ?$agency_data->dot_no : Null }}</td>
								<td>{{ isset($userdata->name) ? $userdata->name : Null}}</td>					
								<td>{{ date('d M, Y', strtotime($cac->created_at)) }}</td>
								<td class="action_tooltip">
								    <span class="tooltip">Edit</span>
                                    <a href="{{url('admin/carrierac/edit').'/'.$cac->id}}" class="btn btn-outline-success btn-sm radius-30 px-4"> <i class="bx bx-edit"></i></a>
								</td>
							</tr>
							@endforeach
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
	

@include('backend.common.footer')
@endsection
