@extends('backend.layouts.master')

@section('title','Ar Dashboard')

@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
					<p>{{ $message }}</p>
                </div>
                @endif
				
				<div class="card card-primary ar">
                  <div class="card-header">
                    <h2 class="card-title">AR Shipment List</h2>
                  </div>
        		  <div class="card-body">
        			 <div class="row">
                            <input type="hidden" name="_token" value="RaaxeoxRYh7sHt53XfaypOPBAsOeAqYFu4opG0tM">
                             <div class="col-md-2 col-sm-2 col-xs-12">
    							<label>Type</label>
    							<select class="allcust form-control" id="ShipmentType">
    								<option value="3">All</option>
    								<option value="0">Adroit</option>
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
                </div>
                <ul class="nav nav-tabs">
                    <li class="pending_approval active"><a href="{{url('/admin/ar_dashboard')}}" data-toggle="tab" aria-expanded="true">Ar Dashboard</a>
                    </li>
        
                    <li class="all_leave"><a href="{{url('/admin/ar/payment-history')}}" data-toggle="tab" aria-expanded="false">Invoice Generated</a>
                        </li>
                    <li class="all_leave"><a href="{{url('/admin/ar/all-payment')}}" data-toggle="tab" aria-expanded="false">Payments Recived</a>
                        </li>
                </ul>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>Load#</th>
                                        <th>Shipper Name</th>
                                        <th>Price</th>
                                        <th>Delivered</th>
                                        <th>Broker Name</th>
    									<th>Status</th>
    									<th width="154px">Action</th>
									</tr>
								</thead>
								<tbody>
								    <tr>
                						<td class="sorting_1">1</td>
                						<td class="sorting_1">Miami</td>
                						<td>Houstan</td>
                						<td>Van</td>
                						<td>1400-1600</td>
                						<td>Danny</td>
                						<td style="width: 180px;">
            								<a class="btn btn-outline-info btn-sm radius-30 px-4" data-bs-toggle="modal" data-bs-target="#LanesLoadsComments"><i class="bx bx-show"></i></a>
            								<a class="btn btn-outline-secondary btn-sm radius-30 px-4" href="#"><i class="bx bx-edit"></i></a>
            								<a class="btn btn-outline-danger btn-sm radius-30 px-4" href="#"><i class="bx bx-trash"></i></a>
            							</td>
                					  </tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!--end page wrapper -->



@include('backend.common.footer')

@endsection