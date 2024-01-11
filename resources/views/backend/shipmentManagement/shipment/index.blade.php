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
                <!--<div class="row">-->
                <!--    <div class="col-md-3 pl-lg">-->
                        <!-- START widget-->
                <!--        <div class="panel widget bg-gradient-deepblue">-->
                <!--            <div class="pl-sm pr-sm pb-sm">-->
                <!--                <strong><a style="font-size: 15px" class="b_status" search-type="unconfirmed" id="unconfirmed" href="#">Open</a>-->
                <!--                    <small class="pull-right " style="padding-top: 2px"> {{ $shipment_open }} / {{ $total }}</small>-->
                <!--                </strong>-->
                <!--                <div class="progress progress-striped progress-xs mb-sm">-->
                <!--                    <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                        <!-- END widget-->
                <!--    </div>-->
                <!--    <div class="col-md-3">-->
                        <!-- START widget-->
                <!--        <div class="panel widget bg-gradient-ibiza">-->
                <!--            <div class="pl-sm pr-sm pb-sm">-->
                <!--                <strong><a style="font-size: 15px" class="b_status" search-type="confirmed" id="confirmed" href="#">Covered</a>-->
                <!--                    <small class="pull-right " style="padding-top: 2px"> {{ $shipment_covered }} / {{ $total }}</small>-->
                <!--                </strong>-->
                <!--                <div class="progress progress-striped progress-xs mb-sm">-->
                <!--                    <div class="progress-bar progress-bar-info " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                        <!-- END widget-->
                <!--    </div>-->
                <!--    <div class="col-md-3">-->
                        <!-- START widget-->
                <!--        <div class="panel widget bg-gradient-moonlit">-->
                <!--            <div class="pl-sm pr-sm pb-sm">-->
                <!--                <strong><a style="font-size: 15px" class="b_status" search-type="in_progress" id="in_progress" href="#">Delivered</a>-->
                <!--                    <small class="pull-right " style="padding-top: 2px"> {{ $shipment_delivered }} / {{ $total }}</small>-->
                <!--                </strong>-->
                <!--                <div class="progress progress-striped progress-xs mb-sm">-->
                <!--                    <div class="progress-bar progress-bar-warning " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                        <!-- END widget-->
                <!--    </div>-->
            
                <!--    <div class="col-md-3">-->
                        <!-- START widget-->
                <!--        <div class="panel widget bg-gradient-ohhappiness">-->
                <!--            <div class="pl-sm pr-sm pb-sm">-->
                <!--                <strong><a style="font-size: 15px" class="b_status" search-type="resolved" id="resolved" href="#">Paid</a>-->
                <!--                    <small class="pull-right " style="padding-top: 2px"> {{ $shipment_paid }} / {{ $total }}</small>-->
                <!--                </strong>-->
                <!--                <div class="progress progress-striped progress-xs mb-sm">-->
                <!--                    <div class="progress-bar progress-bar-danger " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                        <!-- END widget-->
                <!--    </div>-->
                <!--</div>-->
                <!--div class="card card-primary ar">
                  <div class="card-header">
                    <h2 class="card-title">Shipment List</h2>
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
                    @can('shipment-all')
                    <li class="pending_approval"><a href="{{url('/admin/shipment/list')}}" data-toggle="tab" aria-expanded="true">All Shipments</a></li>
                    @endcan
                    @can('shipment-agentshipment')
					<li class=""><a href="{{url('/admin/shipment/manager/list')}}" data-toggle="tab" aria-expanded="true">Team Shipments</a></li>
                    @endcan
                    <li class="pending_approval active"><a href="{{url('/admin/shipment')}}" data-toggle="tab" aria-expanded="true">Shipments</a>
                    </li>
                    @can('shipment-create')
                    <li class="pending_approval"><a href="{{url('/admin/create-shipment')}}" data-toggle="tab" aria-expanded="true">Create Shipments</a></li>
                    @endcan


                    @can('shipments-approver')
                    <li class="pending_approval"><a href="{{url('/admin/shipment/req/list')}}" data-toggle="tab" aria-expanded="true">Req Shipments</a></li>
                    @endcan
                </ul>
                
				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
						  <!--div class="ms-auto"><a href="#" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New Shipper</a></div -->
						</div>

						<div class="table-responsive" style="overflow: hidden;">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>No</th>
										<th>Load</th>
                                        <th>Company</th>
                                        <th>Carrier Name</th>
                                        <th>Pick</th>
                                        <th>Drop</th>
                                        <th>Status</th>
                                        <th width="60px">Action</th>
									</tr>
								</thead>
								
								<tbody>
								@php
								$i = 0;
								@endphp
								@if(count($shipment)>0)
                                            @foreach($shipment as $key => $companies_res)
                                                        <?php 
                                                        // dd($companies_res);
                                                            $cid = $companies_res->id ;
                                                            $pickid = $companies_res->id ;
                                                            $pick_date =  App\Models\Shipmentpick::where('shipment_id',$pickid)->select('p_ready')->first();
                                                            $dropid = $companies_res->id ;
                                                            $drop_date =  App\Models\Shipmentdrop::where('shipment_id',$dropid)->select('d_ready')->first();
                                                        ?>
                                                        
                                                    @if($companies_res->shipment_approved == 1)                                                            
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                        <td class="copy-text">{{ isset($companies_res->id) ? $companies_res->id : Null }}</td>
                                                        <td class="copy-text">{{ isset($companies_res->company_name) ? $companies_res->company_name : Null }}</td>
                                                        <td class="copy-text">{{ $companies_res->c_company_name }}</td>
                                                        <td>{{isset($pick_date['p_ready']) ? $pick_date['p_ready'] :Null }}</td>
                                                        <td>{{isset($drop_date['d_ready']) ? $drop_date['d_ready'] : Null }}</td>
                                                        
                                                        <td>
                                                            <input type="hidden" value="{{ $companies_res->id }}" id="shipment_id">
                                                            <select class="form-control select2 {{$companies_res->shipment_statue}}" id="shipment_status_change" style="width: 100%;">
                                                                    <option <?php if($companies_res->shipment_statue == 'Open'){ echo 'selected';} ?> value="Open">Open</option>
                                                                    <option value="Covered" <?php if($companies_res->shipment_statue == 'Covered'){ echo 'selected';} ?> >Covered</option>
                                                                    <option value="In-transit" <?php if($companies_res->shipment_statue == 'In-transit'){ echo 'selected';} ?> >In-transit</option>
                                                                    <option value="Delivered" <?php if($companies_res->shipment_statue == 'Delivered'){ echo 'selected';} ?> >Delivered</option>												
                                                                </select>
                                                        </td>
                                                        <!--<td  class="action_tooltip">-->
                                                        <!--    <a href="{{ url('admin/shipment/shipment-edit',base64_encode($companies_res->id) )}}"> -->
                                                        <!--    <button type="button" value="{{$companies_res->id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>-->
                                                        <!--    <a href="{{ url('admin/shipment/shipment-edit',base64_encode($companies_res->id) )}}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a>  -->
                                                        <!--</td>-->
                                                        
                                                        <td class="action_tooltip">
                                                            <div class="action_bar">
                                                                <button type="buton" class="action"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                                <div class="action_btn">
                                                                    <!--<a href="{{ url('admin/shipment/shipment-edit',base64_encode($companies_res->id) )}}"><button type="button" value="{{ $companies_res->id }}" class=""><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>-->
                                                                    <a href="{{ url('admin/shipment/shipment-edit'.'/'.base64_encode($companies_res->id) )}}" class="primary"><i class="bx bx-show"></i><span class="tooltip">View</span></a>
                                                                    <a href="{{ url('admin/shipment/shipment-edit'.'/'.base64_encode($companies_res->id) )}}" class="success"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a> 
                                                                    
                                                                    @can('loads-activity')
                                                                    <a href="{{url('/admin/load-activity').'/'.base64_encode($companies_res->id)}}" class="scandry" popup="report_{{$companies_res->id}}"><i class="bx bx-file"></i><span class="tooltip">Load Activity</span></a>
                                                                    @endcan
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endif
                                            @endforeach
                                @else
                                        <tr style="background-color: #edf3f652;">
                                            <td colspan="8">
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4 not-found">
                                                        <img src="{{url('/public/backend/assets/images/message.png')}}">
                                                        <h4>You have no Shipment, yet.</h4>
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

<script>
    
$(document).ready(function() {
    $('#carrier_table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );

</script>
@include('backend.common.footer')
@endsection

