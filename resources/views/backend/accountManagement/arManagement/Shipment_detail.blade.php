@extends('backend.layouts.master')
@section('title','Account Receivables')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Account Receivables</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Shipment List</li>
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
				@if ($message = Session::get('errors'))
                <div class="alert alert-danger">
                <p>{{ $message }}</p>
                </div>
                @endif

				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
							{{-- <div class="position-relative">
								<input type="text" class="form-control ps-5 radius-30" placeholder="Search Shipper"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
							</div> --}}

						  {{-- <div class="ms-auto"><a href="{{url('admin/assignuser/add')}}"><button class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>User</button></a></div> --}}
						  <!--div class="ms-auto"><a href="#" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New Shipper</a></div -->
						</div>

						<div class="table-responsive3">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>No</th>
                                        <th>#Load</th>
                                        <th>Customer Name</th>
                                        <th>Agent (User)</th>
                                        <th>Pick</th>
                                        <th>Drop</th>
                                        <th>Price</th>
                                        <th>Assign Date</th>
                                        <th>Days</th>
                                        <th style="width: 200px;">Action</th>
									</tr>
								</thead>
								<tbody>
								@php
								$i = 0;
								@endphp

								@foreach($shipdataResult as $shipmentdata)
								
									
										<tr>
										<td>{{ ++$i }}</td>
										<td class="loadid">
												{{ isset($shipmentdata['id'])  ? $shipmentdata['id'] : Null }}
										</td>
										<td>
												@php
													$company = App\Models\Company::where('id',$shipmentdata->companies_id)->first();
												@endphp
												{{ isset($company['company_name'])  ? $company['company_name'] : Null }}
										</td>
										
										<td>
											@php
												$usern = App\Models\User::where('id',$shipmentdata->user_id)->first();
											@endphp
												{{ ucwords($usern['name'])  }}
										</td>
										
										<?php
											//   pick
											$pickid = $shipmentdata->id ;
											//dd($pickid);
											$pick_date =  App\Models\Shipmentpick::where('shipment_id',$pickid)->select('p_ready')->orderBy('manage_order','desc')->first();


											//   drop

											$dropid = $shipmentdata->id ;
											$drop_date =  App\Models\Shipmentdrop::where('shipment_id',$dropid)->select('d_ready')->orderBy('manage_order','desc')->first();
										?>
										
										<td>
											{{ isset($pick_date['p_ready']) ? $pick_date['p_ready'] : null }}
										</td>

										<td>
											{{ isset($drop_date['d_ready']) ? $pick_date['p_ready'] : null }}
										</td>
										
										<td>
											@php
												$shipmentrate = App\Models\Shipmentrate::where('shipment_id',$shipmentdata->id)->first();
											@endphp
												{{ isset($shipmentrate['customer_total']) ? $shipmentrate['customer_total'] : null }}
											
										</td>

										<td>
										{{ isset($shipmentdata['ar_access_date']) ? $shipmentdata['ar_access_date'] : null }}
										</td>
										
										<td>
											<?php
												$in_datte2 = Carbon\Carbon::createFromFormat('Y-m-d', $shipmentdata['ar_access_date'])->format('Y-m-d');
												$datework = new Carbon($in_datte2);
												$now = Carbon::now();
												$diff = $datework->diffInDays($now);
                                            ?>

                                            {{ $diff }}
										</td>

										<td class="ap-action action_tooltip">
											<input type="hidden" id="shipment_id" value="{{$shipmentdata['id']}}">
                                            <button type="button" value="" id="PaymentUpdate" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip big">Payment Update</span></button>
											<a href="{{ url('admin/ar/customer/InvoiceGenerate',$shipmentdata['id'] ) }}" target="_blank"><button type="button" class="btn btn-outline-info btn-sm radius-30 px-4" ><i class="bx bx-upload"></i><span class="tooltip big">Invoice Generate</span></button></a>
											<button id="ArCommentForm" type="button" user_id="{{$userid}}" shipment_id="{{ $shipmentdata->id }}" class="btn btn-outline-info btn-sm radius-30 px-4" aria-expanded="false"><i class="bx bx-comment"></i><span class="tooltip">Comments</span></button>
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

<!-- Ar payment update Modal start here -->
<div class="modal" id="ArPaymentUpt">
</div>
<!-- Ar payment update Modal end here -->

<div class="modal" id="ArCommentShow">	
</div>

@include('backend.common.footer')
@endsection

