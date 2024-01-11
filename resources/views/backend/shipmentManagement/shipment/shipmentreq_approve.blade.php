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

                    <li class="pending_approval"><a href="{{url('/admin/shipment/req/list')}}" data-toggle="tab" aria-expanded="true">Req Shipments</a></li>
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

                                //dd($shipment);
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
                                                        
                                                    @if($companies_res->shipment_approved == 0)                                                            
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
                                                        
                                                        <td class="action_tooltip">
                                                            <div class="action_bar">
                                                                <button type="buton" class="action"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                                <div class="action_btn">
                                                                    <a href="{{ url('admin/shipment/shipment-view'.'/'.base64_encode($companies_res->id) )}}" class="primary"><i class="bx bx-show"></i><span class="tooltip">View</span></a>
                                                                    
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

