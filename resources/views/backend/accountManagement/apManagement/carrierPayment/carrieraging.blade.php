@extends('backend.layouts.master')
@section('title','Carrier Aging')
@section('content')



<!--start page wrapper -->
<div class="page-wrapper">
		<div class="page-content">
            <div class="row">


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
                    <li class="pending_approval "><a href="{{url('/admin/accountap')}}" data-toggle="tab" aria-expanded="true">Broker Assign</a>
                    </li>
					<li class="pending_approval active"><a href="{{url('/admin/carrier/payment/aging')}}" data-toggle="tab" aria-expanded="true">Carrier Aging</a>
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
								<th>Load No. test</th>
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
							@foreach ($userdata as $user_data)
                                @php
                                    $accounts_payables = App\Models\AccountsPayable::where('user_id',$user_data->assign_agent_to)->where('aging_status','1')->get();
                                @endphp
                                @foreach ($accounts_payables as $acc_payables)
                                @php
                                    $shipment_price = App\Models\Shipmentrate::where('shipment_id',$acc_payables->shipment_id)->first();
                                    $carrier_data = App\Models\Carriers::where('id',$acc_payables->carrier_id)->first();
                                    $carrier_account = App\Models\Carrier_account::where('carrier_id',$carrier_data->id)->first();
                                    $did = $acc_payables->user_id;

                                    $userdata = App\Models\User::where('id',$did)->first();
                                    
                                    $uname = " ";
                                    if(empty($userdata->name)){
                                        $uname = "";
                                    }else{
                                        $uname = $userdata->name;
                                    }
                                @endphp
							<tr>
								<td>{{ ++$i }}</td>
								<td>{{ isset($acc_payables->shipment_id) ? $acc_payables->shipment_id: Null }}</td>
								<td>{{ isset($carrier_data->c_company_name) ? $carrier_data->c_company_name : Null }}</td>
								<td>{{ isset($carrier_data->mc_no) ? $carrier_data->mc_no : Null }}</td>
								<td>{{ isset($carrier_data->dot_no) ? $carrier_data->dot_no : Null }}</td>
								<td>{{ isset($shipment_price->carrier_total) ? $shipment_price->carrier_total : Null }}</td>
								<td>{{ isset($uname) ? $uname : Null }}</td>	
								<td class="action_tooltip">
								    
                                    <a href="{{url('admin/carrier/payment/highlight').'/'.base64_encode($acc_payables->shipment_id) }}" class="btn btn-outline-success btn-sm radius-30 px-4"><span class="tooltip">Highlight</span><i class="bx bx-edit"></i></a>
								</td>
							</tr>
							    @endforeach
                            
                            @endforeach
						</table>
					</div>
				</div>
			</div>


            </div>
		</div>
	</div>
	<!--end page wrapper -->


@include('backend.common.footer')
@endsection