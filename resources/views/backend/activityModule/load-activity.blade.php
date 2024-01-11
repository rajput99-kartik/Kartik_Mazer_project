@extends('backend.layouts.master')
@section('title','Activity Management')
@section('content')
<style>
    .load-acti-data {
        display: flex;
        /* column-gap: 10px; */
        flex-wrap: wrap;
    }
    .load-acti-data .data-box {
        width: 16.5%;
        border-bottom: solid 1px #00000014;
        padding: 5px 0px;
    }
    .load-acti-data .data-box p {
        margin: 0px;
        font-size: 12px;
        min-height: 12px;
    }
    .data-box b {
        font-size: 12px;
    }
</style>

		<!--start page wrapper -->

		<div class="page-wrapper">

			<div class="page-content">

			    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                    <p>{{ $message }}</p>
                    </div>

                @endif

				<ul class="nav nav-tabs">

                    <li class="pending_approval"><a href="{{url()->previous()}}" data-toggle="tab" aria-expanded="true">Back to Shipment</a>

                    </li>

                    <li class="pending_approval active"><a href="javascript:void(0)" data-toggle="tab" aria-expanded="true">Load Activity</a>

                    </li>

                </ul>

				

				<!--end breadcrumb-->

				<div class="card">

					<div class="card-body">

						<div class="table-responsive">

							<table class="table mb-0" id="carrier_table" >

								<thead class="table-light">

									<tr>

                                        <th>Load No</th>

                                        <th>Carrier Rate</th>

                                        <th>Quickpay Amount</th>

                                        <th>Carrier Total</th>

                                        <th>Customer Total</th>

                                        <th>Edit By</th>

                                        <th>Date</th>
                                        <th>Action</th>

									</tr>

								</thead>

								<tbody>

								    @if(count($LoadActivity)>0)

								    @foreach($LoadActivity as $loaddata)

								    @php

								        $user = DB::table('users')->where('id', $loaddata->user_id)->first()

								    @endphp

								    <tr>

								        <td>{{$loaddata->shipment_id_load}}</td>

								        <td>{{$loaddata->carrier_rate_dropdown}}</td>

								        <td>{{$loaddata->quickpay_amount}}</td>

								        <td>{{$loaddata->carrier_total}}</td>

								        <td>{{$loaddata->customer_total}}</td>

								        <td>

								            <div class="badge rounded-pill text-white bg-info p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>{{$user->name}}</div>

								        </td>

								        <td>{{date("d-m-Y", strtotime($loaddata->created_at))." ". date("h:i A", strtotime($loaddata->created_at))}}</td>
										<td>
											 <button style="padding: 2px 10px;" type="button" id="ship_activity_detail" class="btn btn-success btn-sm" value="{{$loaddata->id}}">view</button>
										 </td>
								    </tr>

								    @endforeach

								    @else

                                    <td colspan="7">

                                        <div class="row">

                                            <div class="col-md-4"></div>

                                            <div class="col-md-4 not-found">

                                                <img src="{{url('/public/backend/assets/images/message.png')}}">

                                                <h4>No Any Activity, yet.</h4>

                                            </div>

                                            <div class="col-md-4"></div>

                                        </div>

                                    </td>

                                    @endif

								</tbody>

							</table>

						</div>

					</div>

				</div>

			</div>



		</div>

<!-- Modal -->
<div class="modal fade" id="loadactivityshipment" role="dialog">
</div>



		<!--end page wrapper -->

@include('backend.common.footer')



@endsection