@extends('backend.layouts.master')
@section('title','Payment Update')
@section('content')
<style>
    tr.urgent a {
        border-color: #000 !important;
        color: #000;
    }
    tr.urgent a.btn:hover {
        background-color: #000 !important;
    }
</style>
	<!--start page wrapper -->
	<div class="page-wrapper">
		<div class="page-content">
            <div class="row">
                <div class="col-md-3 pl-lg">
                    <!-- START widget-->
                    <div class="panel widget bg-gradient-deepblue">
                        <div class="pl-sm pr-sm pb-sm">
                            <strong><a style="font-size: 15px" class="b_status" search-type="unconfirmed" id="unconfirmed" href="#">Inactive</a>
                                <small class="pull-right " style="padding-top: 2px"> 0/ 0</small>
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
                            <strong><a style="font-size: 15px" class="b_status" search-type="confirmed" id="confirmed" href="#">Service</a>
                                <small class="pull-right " style="padding-top: 2px"> 0/ 0</small>
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
			@if ($message = Session::get('success'))
			<div class="alert alert-success">
			<p>{{ $message }}</p>
			</div>
			@endif
			<ul class="nav nav-tabs">
                <li class="pending_approval"><a href="{{url('/admin/carrier/payment/updates')}}" data-toggle="tab" aria-expanded="true">Payments Pending</a>
                </li>
                <li class="pending_approval active"><a href="{{url('/admin/carrier/urgent/payment')}}" data-toggle="tab" aria-expanded="true">Urgent Payments</a>
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
								<th>Load No.</th>
								<th style="width:300px">Carrier Name</th>
								<th>Mc No.</th>
								<th>Dot No</th>
								<th>Amount</th>
                                <th>Status</th>
								<th>Broker</th>
								<th width="50;">Action</th>
							</tr>
						 </thead>
							
							@php 
							$i=0;
							@endphp
							@foreach ($shipment_data as $key => $cac)
                            
                            @php

                            $accounts_paydata = App\Models\AccountsPayable::where('shipment_id',$cac->shipment_id)->where('aging_status','1')->where('pay_complete','0')->first();
                            
                            if(isset($accounts_paydata)){
                                
                                    $shipmentdata = App\Models\Shipment::where('id',$cac->shipment_id)->first();
                                    $shipment_price = App\Models\Shipmentrate::where('shipment_id',$cac->shipment_id)->first();
                                    $carrier_data = App\Models\Carriers::where('id',$cac->carrier_id)->first();
                                    $carrier_account = App\Models\Carrier_account::where('carrier_id',$carrier_data->id)->first();
                                    

                                    $userdata = App\Models\User::where('id',$shipmentdata->user_id)->first();
                                    
                                   
                                @endphp
							<tr class="urgent" style="background-color: #ff00004a !important;">
								<td>{{ ++$i }}</td>
								<td class="copy-text">{{ isset($cac->shipment_id) ? $cac->shipment_id: Null }}</td>
								<td class="copy-text">{{ isset($carrier_data->c_company_name) ? $carrier_data->c_company_name : Null }}</td>
								<td class="copy-text">{{ isset($carrier_data->mc_no) ? $carrier_data->mc_no : Null }}</td>
								<td class="copy-text">{{ isset($carrier_data->dot_no) ? $carrier_data->dot_no : Null }}</td>
								<td class="copy-text">{{ isset($shipment_price->carrier_total) ? $shipment_price->carrier_total : Null }}</td>
                                <td>
                                    <?php 
                                        if($cac->quickpay_status == 1){
                                            $status = 'QuickPay';
                                        }elseif($cac->highlight_status == 1){
                                            $status = 'High Priority';
                                        }
                                    ?>
                                    {{ $status }}
                                </td>
								<td>{{ isset($userdata->name) ? $userdata->name : Null }}</td>								
								<td class="action_tooltip">
								    
                                    <a href="{{url('admin/carrier/account/details').'/'.base64_encode($cac->shipment_id) }}" class="btn btn-outline-success btn-sm radius-30 px-4"><span class="tooltip">Edit</span> <i class="bx bx-edit"></i></a>
								</td>
							</tr>
                            
                            @php
                                    }
                                @endphp


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
