@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Assign User</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Assign User Page</li>
							</ol>
						</nav>
					</div>

					
				</div>
				<!--end breadcrumb-->
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif

				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
						</div>

						<div class="table-responsive3">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>No</th>
                                        <th>User Name</th>
                                        <th>Carrier</th>
                                        <th>Shipment</th>
                                        <th>Ap Date</th>
                                        <th>Age Date</th>
                                        <th>Status</th>                                       
									</tr>
								</thead>
								<tbody>
								@php
								$i = 0;
								@endphp
                                @foreach($userdata as $udata)
                                @php
								//dd($udata);
									$assignto_id = App\Models\AccountsPayable::where('user_id', $udata->assign_to)->get();
									//dd($assignto_id);
									$carrier_id = $assignto_id['0']['carrier_id'];
									$date = $assignto_id['0']['carrier_id'];
									$ap_date = $assignto_id['0']['ap_date'];
									$age_day = $assignto_id['0']['age_day'];
									$status = $assignto_id['0']['status'];

									$assignby_id = App\Models\Carriers::where('id', $carrier_id)->get('c_company_name');
									$carr_name =$assignby_id['0']['c_company_name'];

									$shpment_id = $assignto_id['0']['shippment_id'];
									$assignby_id = App\Models\Shipment::where('id', $shpment_id)->get('shipment_statue');
									$shipment_status =$assignby_id['0']['shipment_statue'];

									
								@endphp
                                        <tr>
                                            <td>{{ ++$i }}</td>
											@foreach($udata->apTeamAgent as $asdata)
											<td>	{{ ucwords($asdata['name'])}}</td>
											@endforeach
											<td>{{isset($carr_name) ? $carr_name : Null}}</td>
                                            <td>{{isset($shipment_status) ? $shipment_status : Null}}</td>
                                            <td>{{isset($ap_date) ? $ap_date : Null}}</td>
                                            <td>{{isset($age_day) ? $age_day : Null}}</td>
                                            <td>{{isset($status) ? $status : Null}}</td>
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

@include('backend.common.notification') 

	
@endsection

