@extends('backend.layouts.master')
@section('title','Carrier Payment Pending')
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
                <li class="pending_approval active"><a href="javascript:void(0)" data-toggle="tab" aria-expanded="true">Updated Payments</a>
                </li>
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
								<th>Broker</th>
								<th width="50;">Action</th>
							</tr>
						 </thead>
							
							@php 
							$i=0;
							@endphp
							@foreach ($shipment_data as $key => $cac)
                                @php
                                
                                    $shipmentdata = App\Models\Shipment::where('id',$cac->shipment_id)->first();
                                    $shipment_price = App\Models\Shipmentrate::where('shipment_id',$cac->shipment_id)->first();
                                    $carrier_data = App\Models\Carriers::where('id',$cac->carrier_id)->first();
                                    $carrier_account = App\Models\Carrier_account::where('carrier_id',$carrier_data->id)->first();
                                    $did = $cac->user_id;

                                    $userdata = App\Models\User::where('id',$shipmentdata->user_id)->first();

                                   
                                @endphp
							<tr>
								<td>{{ ++$i }}</td>
								<td class="copy-text">{{ isset($cac->shipment_id) ? $cac->shipment_id: Null }}</td>
								<td class="copy-text">{{ isset($carrier_data->c_company_name) ? $carrier_data->c_company_name : Null }}</td>
								<td class="copy-text">{{ isset($carrier_data->mc_no) ? $carrier_data->mc_no : Null }}</td>
								<td class="copy-text">{{ isset($carrier_data->dot_no) ? $carrier_data->dot_no : Null }}</td>
								<td class="copy-text">{{ isset($shipment_price->carrier_total) ? $shipment_price->carrier_total : Null }}</td>
								<td>{{ isset($userdata->name) ? $userdata->name : Null }}</td>								
								<td class="action_tooltip">
								    
                                    <a href="{{url('admin/carrier/pending/payment').'/'.base64_encode($cac->shipment_id) }}" class="btn btn-outline-success btn-sm radius-30 px-4"><span class="tooltip">Edit</span> <i class="bx bx-edit"></i></a>
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
