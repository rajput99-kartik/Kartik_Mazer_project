@extends('backend.layouts.master')
@section('title','Account Payables')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif

				@if ($message = Session::get('errors'))
                <div class="alert alert-danger">
                <p>{{ $message }}</p>
                </div>
                @endif
                
                <ul class="nav nav-tabs">
                    <li class="pending_approval active"><a href="javascript:void(0)" data-toggle="tab" aria-expanded="true">Broker Assign</a>
                    </li>
					<li class="pending_approval"><a href="{{url('/admin/carrier/payment/aging')}}" data-toggle="tab" aria-expanded="true">Carrier Aging</a>
                    </li>
                </ul>
				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
							{{-- <div class="position-relative">
								<input type="text" class="form-control ps-5 radius-30" placeholder="Search Shipper"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
							</div> --}}

						  {{-- <div class="ms-auto"><a href="{{url('admin/assignuser/add')}}"><button class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>User</button></a></div> --}}
						  <!--div class="ms-auto"><a href="#" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New Shipper</a></div -->
						</div>

						<div class="table-responsive3">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>No</th>
                                        <th>Assign By </th>
                                        <th>Handle by</th>
                                        <th>Agent (User)</th>
                                        <th>Date</th>
                                        <th style="width: 200px;">Action</th>
									</tr>
								</thead>
								<tbody>
								@php
								$i = 0;
								@endphp
								
								@if(count($userdata)>0)
                                @foreach($userdata as $udata)
											
                                        <tr>
											<td>{{ ++$i ;}}
											@foreach($udata->apassignbyuser as $asdata)
											<td>{{ isset($asdata['name']) ? $asdata['name'] : Null }}</td>
											
											@endforeach

											@foreach($udata->apTeamLeader as $tleader)
											<td>	
												<!--<a href="{{ url('admin/assignuser/view',$tleader->id )}}"> 	</a>-->
												{{ isset($tleader['name']) ? $tleader['name'] : Null }}
											</td>
											@endforeach

											@foreach($udata->apTeamAgent as $agent)
											<!--<a href="{{ url('admin/assignuser/view',$agent->id )}}"></a>-->
											<td>{{ isset($agent['name']) ? $agent['name'] : Null }}</td>
											@endforeach

											@foreach($udata->apassignbyuser as $asdata)
											<td>{{ $joined_on  = date('d M, Y', strtotime($asdata['created_at'])); }}</td>
											@endforeach
    
    
											@foreach($udata->apTeamAgent as $agent)
											
											@php
												$userid = base64_encode($agent->id); 
											@endphp
											<td class="action_tooltip">
                                                <!-- <a href="{{ url('admin/accountap/view',$userid )}}"> 
                                                <button type="button" value="{{ $agent->id }}" class="btn btn-success btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>  -->

                                                <a href="{{ url('admin/accountap/view/apshiplist',$userid )}}"> 
                                                    <button type="button" value="{{ $agent->id }}" class="btn btn-info btn-sm radius-30 px-4"><i class="bx bx-info-circle"></i><span class="tooltip">Details</span></button>
												</a> 

                                            </td>
											@endforeach                                            
                                        </tr>
                                @endforeach
                                @else
                                <tr style="background-color: #edf3f652;">
                                    <td colspan="6">
                                        <div class="row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4 not-found">
                                                <img src="{{url('/public/backend/assets/images/message.png')}}">
                                                <h4>You have no Account Payables, yet.</h4>
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
    </div>
  </div>
</div>
@include('backend.common.footer')
@endsection