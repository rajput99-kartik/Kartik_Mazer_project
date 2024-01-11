@extends('backend.layouts.master')
@section('title','Shipment Management')
@section('content')
		
		
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif
                <!--<div class="row">-->
                <!--    <div class="col-md-3 pl-lg">-->
                        <!-- START widget-->
                <!--        <div class="panel widget bg-gradient-deepblue">-->
                <!--            <div class="pl-sm pr-sm pb-sm">-->
                <!--                <strong><a style="font-size: 15px" class="b_status" search-type="unconfirmed" id="unconfirmed" href="#">Open</a>-->
                <!--                    <small class="pull-right " style="padding-top: 2px"> </small>-->
                <!--                </strong>-->
                <!--                <div class="progress progress-striped progress-xs mb-sm">-->
                <!--                    <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                        <!-- END widget-->
                <!--    </div>-->
                <!--    <div class="col-md-3">-->
                        <!-- START widget-->
                <!--        <div class="panel widget bg-gradient-ibiza">-->
                <!--            <div class="pl-sm pr-sm pb-sm">-->
                <!--                <strong><a style="font-size: 15px" class="b_status" search-type="confirmed" id="confirmed" href="#">Covered</a>-->
                <!--                    <small class="pull-right " style="padding-top: 2px"> </small>-->
                <!--                </strong>-->
                <!--                <div class="progress progress-striped progress-xs mb-sm">-->
                <!--                    <div class="progress-bar progress-bar-info " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                        <!-- END widget-->
                <!--    </div>-->
                <!--    <div class="col-md-3">-->
                        <!-- START widget-->
                <!--        <div class="panel widget bg-gradient-moonlit">-->
                <!--            <div class="pl-sm pr-sm pb-sm">-->
                <!--                <strong><a style="font-size: 15px" class="b_status" search-type="in_progress" id="in_progress" href="#">Delivered</a>-->
                <!--                    <small class="pull-right " style="padding-top: 2px"> </small>-->
                <!--                </strong>-->
                <!--                <div class="progress progress-striped progress-xs mb-sm">-->
                <!--                    <div class="progress-bar progress-bar-warning " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                        <!-- END widget-->
                <!--    </div>-->
            
                <!--    <div class="col-md-3">-->
                        <!-- START widget-->
                <!--        <div class="panel widget bg-gradient-ohhappiness">-->
                <!--            <div class="pl-sm pr-sm pb-sm">-->
                <!--                <strong><a style="font-size: 15px" class="b_status" search-type="resolved" id="resolved" href="#">Paid</a>-->
                <!--                    <small class="pull-right " style="padding-top: 2px"></small>-->
                <!--                </strong>-->
                <!--                <div class="progress progress-striped progress-xs mb-sm">-->
                <!--                    <div class="progress-bar progress-bar-danger " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                        <!-- END widget-->
                <!--    </div>-->
                <!--</div>-->
                
                <ul class="nav nav-tabs">
                    @can('shipment-all')
                    <li class="pending_approval"><a href="{{url('/admin/shipment/list')}}" data-toggle="tab" aria-expanded="true">All Shipments</a></li>
                    @endcan
                    @can('shipment-agentshipment')
					<li class="active"><a href="{{url('/admin/shipment/manager/list')}}" data-toggle="tab" aria-expanded="true">Team Shipments</a></li>
                    @endcan
                    <li class="pending_approval"><a href="{{url('/admin/shipment')}}" data-toggle="tab" aria-expanded="true">Shipments</a>
                    </li>
                    @can('shipment-create')
                    <li class="pending_approval"><a href="{{url('/admin/create-shipment')}}" data-toggle="tab" aria-expanded="true">Create Shipments</a></li>@endcan
					
                </ul>
                
				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
						  <!--div class="ms-auto"><a href="#" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New Shipper</a></div -->
						</div>

						<div class="table-responsive">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>No</th>
										<th>Assign By User</th>
                                        <th>Handel By User</th>
                                        <th>Broker</th>
                                        <th width="154px">Action</th>
									</tr>
								</thead>
								
								<tbody>
								@php
								$i = 0;
								@endphp
								@if(count($userdata) > 0)
                                @foreach($userdata as $user_result)
                                            <?php 
                                                
                                            ?>
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            @php
											$user =  App\Models\User::where('id',$user_result['assignby_id'])->first();
											$aname= isset($user['name']) ? $user['name'] : null;
											@endphp
											<td>{{ucfirst($aname)}}</td>
											@php
											$user =  App\Models\User::where('id',$user_result['assignto_id'])->first();
											$hname= isset($user['name']) ? $user['name'] : null;
											@endphp
                                            <td>{{ucfirst($hname)}}</td>
											@php
											$user =  App\Models\User::where('id',$user_result['user_id'])->first();
											$bname= isset($user['name']) ? $user['name'] : null;
											@endphp
                                            <td>{{ucfirst($bname)}}</td>
                                            <td  class="action_tooltip">
											@php
                                                $userid = base64_encode($user_result->user_id); 
                                            @endphp
                                                <a href="{{ url('admin/shipment/manager/assignuser/shipments',$userid )}}"  target="_blank"> 
                                                <button type="button" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>
                                                <!--a href="{{ url('admin/shipment/manager/assignuser/shipments',$user_result->user_id )}}" target="_blank" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a -->  
                                            </td>
                                        </tr>
                                @endforeach
                                @else
                                <tr style="background-color: #edf3f652;">
                                    <td colspan="5">
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
@include('backend.common.footer')
@endsection

