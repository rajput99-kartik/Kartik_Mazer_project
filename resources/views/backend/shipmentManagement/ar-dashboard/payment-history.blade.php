@extends('backend.layouts.master')

@section('title','Payment History')

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
                    <h2 class="card-title">Payment History</h2>
                  </div>
        		  <div class="card-body">
        			  <div class="row">
                                <input type="hidden" name="_token" value="RaaxeoxRYh7sHt53XfaypOPBAsOeAqYFu4opG0tM">
                                 <div class="col-md-2 col-sm-2 col-xs-12">
        							<label>Type</label>
        							<select class="allcust form-control" id="ShipmentType">
        								<option value="3">All</option>
        								<option value="0">Adroit</option>
        								<option value="1">OTR</option>
        								   
        							</select>
        						</div>
        					<div class="col-md-2 col-sm-2 col-xs-12">
                                <label>Status</label>
                                <select class="allcust form-control" id="ShipmentStatus">
        						   <option value="">All</option>
                                    <option value="Open">Open</option>
                                    <option value="Consignee">Consignee</option>
                                    <option value="Delivered">Delivered</option>
                                    <option value="Ready To Invoice">Ready To Invoice</option>
                                    <option value="Invoice">Invoice</option>
                                       
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
                    <li class="pending_approval"><a href="{{url('/admin/ar_dashboard')}}" data-toggle="tab" aria-expanded="true">Ar Dashboard</a>
                    </li>
        
                    <li class="all_leave active"><a href="{{url('/admin/ar/payment-history')}}" data-toggle="tab" aria-expanded="false">Invoice Generated</a>
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
                                        <th>Invoice#</th>
                                        <th>Pro#</th>
                                        <th>Shipper Name</th>
                                        <th>Price</th>
                                        <th>Aging</th>
                                        <th>Invoice Date</th>
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
                						<td>09/07/2022</td>
                						<td>Danny</td>
                						<td>Danny</td>
                						<td style="width: 180px;">
            								<a class="btn btn-outline-info btn-sm radius-30 px-4" data-bs-toggle="modal" data-bs-target="#view_payment"><i class="bx bx-show"></i></a>
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

        <!--payment model-->
        
        <div class="modal" id="view_payment" aria-modal="true" role="dialog">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
              
                <!-- Modal Header -->
                <div class="modal-header">
                  <h4 class="modal-title">Payment Update</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <!-- Modal body -->
        		
                <div class="modal-body">
        		 <div class="container">
                   <form action="#" id="new_lanes_post" method="post" enctype="multipart/form-data">
        			    <div class="row">
        					<div class="col-md-6">
        						<div class="form-group">
        							<label>Amount Paid</label>
        							  <input type="text" class="form-control" id="amount_paid" name="amount_paid">
        						</div>
        					</div>
        					<div class="col-md-6" id="pending_amount" style="display:none">
        						<div class="form-group">
        							<label>Balance Due</label>
        							  <input type="text" class="form-control" id="balance_amount" name="balance_amount">
        						</div>
        					</div>
        					<div class="col-md-6">
        						<div class="form-group">
        							<label>Full/Partial</label>
        							  <select class="form-control" id="payment_type" name="payment_type">
        							   <option value="Full" selected="">Full</option>
        							   <option value="Partial">Partial</option>
        							 </select>
        						</div>
        					</div>
        					<div class="col-md-6">
        						<div class="form-group">
        							<label>Check Number</label>
        							  <input type="text" class="form-control" id="check_number" name="check_number" autocomplete="off">
        						</div>
        					</div>
        					<div class="col-md-6">
        						<div class="form-group">
        							<label>Check Date</label>
        							  <input type="date" class="form-control hasDatepicker" id="check_date" name="check_date">
        						</div>
        					</div>
        					<div class="col-md-6">
        						<div class="form-group">
        							<label>Date Received</label>
        							<input type="date" class="form-control hasDatepicker" id="date_received" name="date_received">
        						</div>
        					</div>
        					<div class="col-md-6">
        						<div class="form-group">
        							<label>Pay Mode</label>
        							<select class="form-control" id="pay_mode" name="pay_mode">
        							   <option value="ACH" selected="">ACH</option>
        							   <option value="Check">Check</option>
        							 </select>
        						</div>
        					</div>
        					<div class="col-md-6">
        						<div class="form-group">
        							<label>Deposit Date</label>
        							  <input type="date" class="form-control hasDatepicker" id="deposit_date" date="deposit_date">
        						</div>
        					</div>
        					<div class="col-md-6">
        						<div class="form-group">
        							<label>Comment</label>
        							 <input type="text" class="form-control" id="comment" name="comment">
        						</div>
        					</div>
        				</div>
        				<div class="card-footer">
        					<button type="submit" class="btn btn-primary" id="update_payment">Save</button>
        					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        				</div>
        		   </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

@include('backend.common.footer')

@endsection