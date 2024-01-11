@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
                
                <div class="row">
                    <div class="col-md-3 pl-lg">
                        <!-- START widget-->
                        <div class="panel widget bg-gradient-deepblue">
                            <div class="pl-sm pr-sm pb-sm">
                                <strong><a style="font-size: 15px" class="b_status" search-type="unconfirmed" id="unconfirmed" href="#">Inactive </a>
                                    <small class="pull-right " style="padding-top: 2px"> 0 / 0</small>
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
                                <strong><a style="font-size: 15px" class="b_status" search-type="confirmed" id="confirmed" href="#">Service </a>
                                    <small class="pull-right " style="padding-top: 2px"> 0 / 0</small>
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
                                    <small class="pull-right " style="padding-top: 2px"> 0 / 0</small>
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
                                    <small class="pull-right " style="padding-top: 2px"> 0 / 0</small>
                                </strong>
                                <div class="progress progress-striped progress-xs mb-sm">
                                    <div class="progress-bar progress-bar-danger " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                        <!-- END widget-->
                    </div>
                </div>
				<!--div class="card card-primary ar">
                  <div class="card-header">
                    <h2 class="card-title">Shipper List</h2>
                  </div>
        		  <div class="card-body">
        			 <div class="row">
                            <input type="hidden" name="_token" value="RaaxeoxRYh7sHt53XfaypOPBAsOeAqYFu4opG0tM">
                             <div class="col-md-2 col-sm-2 col-xs-12">
    							<label>Type</label>
    							<select class="allcust form-control" id="ShipmentType">
    								<option value="3">All</option>
    								<option value="0">AMB</option>
    								<option value="1">Factory</option>
    								   
    							</select>
    						</div>
        					<div class="col-md-2 col-sm-2 col-xs-12">
                                <label>Status</label>
                                <select class="allcust form-control" id="ShipmentStatus">
        						   <option value="">All</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Covered">To Be Pick Up</option>
                                    <option value="Consignee">Consignee</option>
                                    <option value="Open">Open</option>
                                       
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label>Load#</label>
                                <input type="text" id="ProNumber" class="form-control allcust">
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <label>Agent Name</label>
                                <select class="allcust form-control" id="AgentName">
        						   <option value="">All</option>
                                    <option value="Delivered">Gary</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                            <label style="visibility: hidden;display: block;">buttonrefresh</label>
                                <a href="javascript:void(0);" id="ShipmentRefreshB" class="reficon btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i>Refresh</a>
                            </div>
                        </div>
                      </div>
                </div -->
				<ul class="nav nav-tabs">
                    @can('shipper-view')
                    <li class="pending_approval"><a href="{{url('/admin/shipper/list')}}" data-toggle="tab" aria-expanded="true">All Shipper</a></li>
                    @endcan
                    @can('shipper-agentshipper')
						<li class="active"> <a href="{{url('admin/shipper/manager/list')}}">Team Shipper</a></li>
						@endcan
                    <li class=""><a href="{{url('/admin/shipper')}}" data-toggle="tab" aria-expanded="false">Shipper</a>
                        </li>
                    @can('shipper-create')
                    <li class=""><a href="{{url('/admin/shipper/add')}}" data-toggle="tab" aria-expanded="false">Create Shipper</a>
                    </li>
                    @endcan
					
                </ul>
				<!--end breadcrumb-->
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif

				<div class="card" id="shipper_tbl">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">

						  
						  <!--div class="ms-auto"><a href="#" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New Shipper</a></div -->
						</div>

						<div class="">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>No</th>
                                        <th>Company</th>
                                        <th>Secret Code</th>
                                        <th>Address</th>
                                        <th>State</th>
                                        <th>Zip</th>
                                        <th>Status</th>
										<th>Broker</th>
                                        <th style="width: 200px;">Action</th>
									</tr>
								</thead>
								
								<tbody>
								@php
								$i = 0;
								@endphp
                                @foreach($comp_data as $companies_res)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ isset($companies_res->company_name) ? $companies_res->company_name : Null }}</td>
                                            <td style="width:120px">{{ strtoupper($companies_res->encode_title) }}</td>
                                            <td>{{ substr($companies_res->address, 0, 15).".." }}</td>
                                            <td>{{ isset($companies_res->shipper_state) ? $companies_res->shipper_state : Null }}</td>
                                            <td>{{ isset($companies_res->shipper_zipcode) ? $companies_res->shipper_zipcode : Null }}</td>
                                            <td>
                                                <div class="badge rounded-pill text-white bg-<?php if($companies_res->approved == 0){echo "danger"; }elseif($companies_res->approved == 1){ echo 'success'; } ?> p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i><?php if($companies_res->approved == 0){echo "Pending"; }elseif($companies_res->approved == 1){ echo 'Approve'; } ?></div>
                                            </td>
											@php
											$user =  App\Models\User::where('id',$companies_res['user_id'])->first();
											$name= isset($user['name']) ? $user['name'] : null;
											@endphp
											<td>{{ucfirst($name)}}</td>
											
                                            <td class="action_tooltip" style="width:230px">
                                                <!-- <a href="{{ url('admin/shipper/view',base64_encode($companies_res->id) )}}"> 
                                                <button type="button" value="{{ $companies_res->companies_id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a> -->
                                                <a href="{{ url('admin/shipper/edit',base64_encode($companies_res->id) )}}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a>
                                                <a href="{{ url('admin/shipper/delete',$companies_res->id )}}"> 
                                                <button type="button" value="{{ url('admin/shipper/delete',$companies_res->delete )}}" class="btn btn-outline-danger btn-sm radius-30 px-4" onclick="return confirm('Are You Sure Delete This Record..!')"><i class="bx bx-trash"></i><span class="tooltip">Delete</span></button></a>
                                            </td>
											
                                        </tr>
                                @endforeach
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

