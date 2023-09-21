@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
		
		
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-3 pl-lg">
                        <!-- START widget-->
                        <div class="panel widget bg-gradient-deepblue">
                            <div class="pl-sm pr-sm pb-sm">
                                <strong><a style="font-size: 15px" class="b_status" search-type="unconfirmed" id="unconfirmed" href="#">Open</a>
                                    <small class="pull-right " style="padding-top: 2px"> {{ $shipment_open }} / {{ $total }}</small>
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
                                <strong><a style="font-size: 15px" class="b_status" search-type="confirmed" id="confirmed" href="#">Covered</a>
                                    <small class="pull-right " style="padding-top: 2px"> {{ $shipment_covered }} / {{ $total }}</small>
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
                                <strong><a style="font-size: 15px" class="b_status" search-type="in_progress" id="in_progress" href="#">Delivered</a>
                                    <small class="pull-right " style="padding-top: 2px"> {{ $shipment_delivered }} / {{ $total }}</small>
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
                                <strong><a style="font-size: 15px" class="b_status" search-type="resolved" id="resolved" href="#">Paid</a>
                                    <small class="pull-right " style="padding-top: 2px"> {{ $shipment_paid }} / {{ $total }}</small>
                                </strong>
                                <div class="progress progress-striped progress-xs mb-sm">
                                    <div class="progress-bar progress-bar-danger " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
                                </div>
                            </div>
                        </div>
                        <!-- END widget-->
                    </div>
                </div>
                
                <ul class="nav nav-tabs">
                    @php
						$userid = base64_encode($user_id); 
					@endphp
                    @can('shipment-all')
                    <li class="pending_approval"><a href="{{url('/admin/shipment/list')}}" data-toggle="tab" aria-expanded="true">All Shipments</a></li>
                    @endcan
                    @can('shipment-agentshipment')
					<li class="active"><a href="{{url('/admin/shipment/manager/list')}}" data-toggle="tab" aria-expanded="true">Team Shipments</a></li>
                    @endcan
                    <li class=""><a href="{{url('/admin/shipment')}}" data-toggle="tab" aria-expanded="true">Shipments</a>
                    </li>
                    @can('shipment-create')
                    <li class="pending_approval"><a href="{{url('/admin/create-shipment')}}" data-toggle="tab" aria-expanded="true">Create Shipments</a></li>
                    @endcan
                    
                </ul>
                
				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
						  <!--div class="ms-auto"><a href="#" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New Shipper</a></div -->
						</div>

						<div class="table-responsive">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>No</th>
										<th>Load</th>
                                        <th>Company</th>
                                        <th>Carrier Name</th>
                                        <th>Pick</th>
                                        <th>Drop</th>
                                        <th>Broker</th>
                                        <th>Status</th>
                                        <th width="154px">Action</th>
									</tr>
								</thead>
								
								<tbody>
								@php
								$i = 0;
								@endphp
                                @foreach($shipment as $key => $companies_res)
                                            <?php 
                                                $cid = $companies_res->id;
												$broker =  App\Models\User::where('id',$companies_res['user_id'])->first();
												//   shipper
												$shipper =  App\Models\Company::where('id',$companies_res['companies_id'])->first();
												//   carrier
												$carrier =  App\Models\Carriers::where('id',$companies_res['carrier_id'])->first();
											    //   pick
											     $pickid = $companies_res->id ;
											     $pick_date =  App\Models\Shipmentpick::where('shipment_id',$pickid)->select('p_ready')->first();
                                                //   drop
												$dropid = $companies_res->id ;
											    $drop_date =  App\Models\Shipmentdrop::where('shipment_id',$dropid)->select('d_ready')->first();
                                            ?>
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ isset($companies_res->id) ? $companies_res->id : Null }}</td>
											<td>{{ isset($shipper->company_name) ? $shipper->company_name : Null }}</td>
                                            <td>{{ isset($carrier['c_company_name']) ? $carrier['c_company_name'] : null }}</td>
                                            <td>{{isset($pick_date['p_ready']) ? $pick_date['p_ready'] :Null }}</td>
											<td>{{isset($drop_date['d_ready']) ? $drop_date['d_ready'] : Null }}</td>
											
											@php
											$bname= isset($broker['name']) ? $broker['name'] : null;
											@endphp
											
											<td>{{ucfirst($bname)}}</td>
                                            <td>
                                                <input type="hidden" value="{{ $companies_res->id }}" id="shipment_id">
                                                <select class="form-control select2 {{$companies_res->shipment_statue}}" id="shipment_status_change" style="width: 100%;">
                                                        <option <?php if($companies_res->shipment_statue == 'Open'){ echo 'selected';} ?> value="Open">Open</option>
                                                        <option value="Covered" <?php if($companies_res->shipment_statue == 'Covered'){ echo 'selected';} ?> >Covered</option>
                                                        <option value="In-transit" <?php if($companies_res->shipment_statue == 'In-transit'){ echo 'selected';} ?> >In-transit</option>
                                                        <option value="Delivered" <?php if($companies_res->shipment_statue == 'Delivered'){ echo 'selected';} ?> >Delivered</option>												
                                                    </select>
                                            </td>
                                            <td  class="action_tooltip">
											@php
												$shipment_id = base64_encode($companies_res->id); 
											@endphp
                                                <a href="{{ url('admin/shipment/shipment-edit',$shipment_id )}}"> 
                                                <button type="button" value="{{ $shipment_id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>
                                                <a href="{{ url('admin/shipment/shipment-edit',$shipment_id )}}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a>  
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

