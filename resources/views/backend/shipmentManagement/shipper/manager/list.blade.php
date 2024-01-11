@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
		
		
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif
                
                
                <ul class="nav nav-tabs">
					
						@can('shipper-all')
						<li> <a href="{{url('admin/shipper/list')}}">All Shipper</a></li>
						@endcan
						@can('shipper-agentshipper')
						<li class="active"> <a href="{{url('admin/shipper/manager/list')}}">Team Shipper</a></li>
						@endcan
						<li> <a href="{{url('admin/shipper')}}">Shipper</a></li>
						@can('shipper-create')
						<li> <a href="{{url('admin/shipper/add')}}">Create Shipper</a></li>
						@endcan
						@can('shipper-request')
        				<li> <a href="{{url('admin/shipper/request')}}"> Shipper Request</a></li>
        				@endcan
					
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
                                                <a href="{{ url('admin/shipper/manager/assignuser/shipper').'/'.$userid}}"  target="_blank"> 
                                                <button type="button" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>
                                                <!--a href="{{ url('admin/shipment/manager/assignuser/shipments',$user_result->user_id )}}" target="_blank" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a -->  
                                            </td>
                                        </tr>
                                @endforeach
                                @else
                                        <tr style="background-color: #edf3f652;">
                                            <td colspan="8">
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4 not-found">
                                                        <img src="{{url('/public/backend/assets/images/message.png')}}">
                                                        <h4> No Team Shipper created, yet.</h4>
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

