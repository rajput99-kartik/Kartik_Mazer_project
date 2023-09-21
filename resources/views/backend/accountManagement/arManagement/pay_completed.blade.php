@extends('backend.layouts.master')
@section('title','Account Receivables')
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
                    <h2 class="card-title">Invoice Generated</h2>
                  </div>
                </div>
                <ul class="nav nav-tabs">
                    <li class="pending_approval active"><a href="{{url('/admin/ar/shipment-list')}}" data-toggle="tab" aria-expanded="true">Pay Completed</a>
                    </li>
                    <!-- <li class="all_leave"><a href="{{url('/admin/ar/all-payment')}}" data-toggle="tab" aria-expanded="false">Payments Recived</a>
                        </li> -->
                </ul>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>S.No</th>
                                        <th>Pro#</th>
                                        <th>Invoice</th>
                                        <th>Shipper Name</th>
                                        <th>Price</th>
                                        <th>Invoice Date</th>
                                        <th>Pay Receive</th>
                                        <th>Pay Type</th>
                                        <th>DaysToPay</th>
                                        <th>Broker Name</th>
    									<!-- <th width="154px">Action</th> -->
									</tr>
								</thead>
								<tbody>
                                    
                                @php
								$i = 1;
								@endphp
                                   
                                    @foreach($pay_data as $invoice)

                                    
								    <tr>
                						<td>{{$i++}}</td>
                						<td>{{ isset($invoice['shipment_id']) ? $invoice['shipment_id'] : null }}</td>
                						<td>{{ isset($invoice['id']) ? $invoice['id'] : null }}</td>

                                        <td>
                                            @foreach($invoice->companyget as $company)
                						        {{ isset($company['company_name']) ? $company['company_name'] : null }}
                                            @endforeach
                                        </td>
                						
                                        <td>
                                            @foreach($invoice->priceget as $price)
                						        {{ isset($price['customer_total']) ? $price['customer_total'] : null }}
                                            @endforeach
                                        </td>
										
										
                						
                                        <td><?php
										 $in_datte = Carbon\Carbon::createFromFormat('m-d-Y', $invoice['start_date'])->format('Y-m-d');
										 
										?>
										{{$in_datte}}
										</td>
                                       

										<?php
											// $today = date('m-d-Y');
                                            // $datetime1 = new DateTime($in_datte);
                                            // $datetime2 = new DateTime($today);
                                            // $difference = $datetime1->diff($datetime2);  
											          
                                        ?>

                                       <td>{{ isset($invoice['date_received']) ? $invoice['date_received'] : null }}</td>
                                       <td>{{ isset($invoice['pay_mode']) ? $invoice['pay_mode'] : null }}</td>
                                       
                                       <td>
                                            @php
                                                $in_datte2 = Carbon\Carbon::createFromFormat('m-d-Y', $invoice['start_date'])->format('Y-m-d');
                                                $datework = new Carbon($invoice['date_received']);
                                                $now = Carbon::now();
                                                $diff = $datework->diffInDays($now);
                                            @endphp

                                            {{ $diff }}
                                       </td>

                                       <td>
                						@foreach($invoice->broker as $agent)
                                        <a href="{{ url('admin/assignuser/view',$agent->id )}}">{{ ucwords($agent['name'])  }} </a>
                                        @endforeach
                                        </td>

                                        <!-- <td style="width: 180px;">
            								<a class="btn btn-outline-info btn-sm radius-30 px-4" data-bs-toggle="modal" data-bs-target="#view_payment"><i class="bx bx-show"></i></a>
            								<a class="btn btn-outline-secondary btn-sm radius-30 px-4" href="#"><i class="bx bx-edit"></i></a>
            								<a class="btn btn-outline-danger btn-sm radius-30 px-4" href="#"><i class="bx bx-trash"></i></a>
            							</td> -->
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