@extends('backend.layouts.master')
@section('title','Load Management')
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
                    <li><a href="{{url('admin/loads')}}">All Loads</a></li>
                    <li><a href="{{url('admin/load/search_truck')}}">Search Truck</a></li>
					@can('loads-reports')
                    <li><a href="{{url('/admin/load/reports/list')}}" aria-expanded="false">Load Report List</a>
                    </li>
				    <li class="active"><a href="{{url('/admin/load/reports')}}" data-toggle="tab" aria-expanded="true">Load Report</a></li>
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
                                        <th>User</th>
                                        <th>Email</th>
										<th style="width: 180px;">Office</th>
                                        <th style="width: 180px;">Date</th>
                                        <th style="width: 190px;">Total Load</th>
                                        <th width="154px">Action</th>
									</tr>
								</thead>
								
								<tbody>
								@php
								$i = 1;
								@endphp
                                @foreach($userdata as $user_result)
                                            <?php 
                                                $agency_detail = App\Models\Agency_detail::where('user_id',$user_result['id'])->first();
                                                //dd($agency_detail);
                                                $agency= '';
                                                if($agency_detail){
                                                    $agency = App\Models\Agency::where('id',$agency_detail['agency_id'])->first();
                                                }
                                            ?>

                                        @php
                                        $loads =  App\Models\Load::where('user_id',$user_result['id'])->count();

                                        // dd($loads);
                                        @endphp

                                        @if($loads > 0)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            @php
											$user =  App\Models\User::where('id',$user_result['id'])->first();
											$bname= isset($user['name']) ? $user['name'] : null;
											@endphp
                                            <td>{{ucfirst(isset($user_result['name']) ? $user_result['name'] : null)}}</td>
                                            <td>{{ucfirst(isset($user_result['email']) ? $user_result['email'] : null)}}</td>
                                            <td><span id="load_agency_{{$i}}">{{isset($agency['agencies_name']) ? $agency['agencies_name']: null}}</span></td>
                                        

											@php
											$loads =  App\Models\Load::where('user_id',$user_result['id'])->count();

                                            // dd($loads);
											@endphp
                                            <td>{{date('M-d-y',strtotime($user_result['created_at'])) ? date('M-d-y',strtotime($user_result['created_at'])) : null}}</td>
                                            <td class="load_no"><span>{{isset($loads) ? $loads : null}}</span></td>
											

                                            {{-- date('M-d-y',strtotime($user_result['created_at'])) --}}

                                            <td  class="action_tooltip">
											@php
                                                $userid = base64_encode($user_result->id); 
                                            @endphp
                                                <a href="{{ url('admin/load/manager/assignuser/loads').'/'.$userid }}"  target="_blank"> 
                                                <button type="button" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>
                                                <!--a href="{{ url('admin/shipment/manager/assignuser/shipments',$user_result->user_id )}}" target="_blank" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a -->  
                                            </td>
                                        </tr>
                                        @php
                                        $i++;
                                        @endphp
                                        @endif
                                        
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
@endsection

