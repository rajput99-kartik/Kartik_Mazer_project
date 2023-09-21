@extends('backend.layouts.master')
@section('title','Assignuser')
@section('content')
<style>
    h2#swal2-title {
        font-size: 20px;
        margin: 0px;
    }
    div#swal2-html-container {
        font-size: 14px;
        margin: 10px 0px 0px;
    }
    .swal2-popup.swal2-modal.swal2-loading.swal2-show {
        width: 270px;
        padding-top: 10px;
    }
    .swal2-loader {
        border-color: #80c427 rgba(0,0,0,0) #80c427 rgba(0,0,0,0);
    }
</style>


<style>
    .agmain li {
            display: none;
            }

        .show_age {
        display: block !important;
        }
        div#agency_detail_edit .card-header {
            background: none;
            border: none;
        }
        div#agency_detail_edit .card-header h3 {
            color: #1e55bf !important;
            font-weight: 600;
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
					@can('uagent-all')
                    <li class="pending_approval active"><a href="{{url('/admin/assignuser/list')}}" data-toggle="tab" aria-expanded="true">All Agent</a>
					@endcan
                    </li>
                    <li class="pending_approval"><a href="{{url('/admin/assignuser')}}" data-toggle="tab" aria-expanded="true">User Agent</a>
                    </li>
                    <li class="all_leave"><a href="{{url('/admin/assignuser/add')}}" data-toggle="tab" aria-expanded="false">Create New</a>
                        </li>
                </ul>
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
                                        <th>User Id</th>
                                        <th>User Name</th>
                                        <th>Office</th>
                                        <th>Email</th>
                                        <th>Assign To</th>
                                        <th>Assign By</th>  
                                        <th>Action</th>    
									</tr>
								</thead>
								<tbody>
								@php
								$i = 0;
								
								@endphp
                                @foreach($userdata as $udata)
								
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $udata->officerid }}</td>
                                            
                                            <td>{{ $udata->name }}</td>
                                            <td>
													<?php 
															$uid = $udata->id ;
															$agncydata = App\Models\Agency_detail::where('user_id', $uid)->first();

															$agid = '';
															if(!empty( $agncydata->agency_id)){
																$agid = $agncydata->agency_id ;
															}else {
																$agid = '0' ;
															}
															$ages = DB::table('agencies')->get();
															// dd($agncydata);
														?>
													<div class="agmain">
														@foreach ($ages as $agesall)
															@php
																$matchid = $agesall->id;
															@endphp
															<li style="text-align:center" value="{{$agesall->id}}" @if($agid==$matchid) class="show_age" @endif> {{$agesall->agencies_name}}  
															</li>
														@endforeach
													</div>
											
											</td>
                                            <td>
                                                <div style="width: fit-content;" class="badge rounded-pill text-white bg-info p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>{{ $udata->email }}</div>
                                            </td>
                                            <td>
												@php
													$assignto_id = App\Models\User::where('id', $udata->assignto_id)->get('name');
													$assignby_id = App\Models\User::where('id', $udata->assign_id)->get('name');
												@endphp
												@foreach($assignto_id as $bought)
													{{ $bought['name'] }}
												@endforeach
											</td>
                                            <td>
												@foreach($assignby_id as $bought)
													{{ $bought['name'] }}
												@endforeach
											</td>
                                            <td class="action_tooltip">
                                                <a href="{{ url('admin/assignuser/view',$udata->id )}}"> 
                                                <button type="button" value="{{ $udata->companies_id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a> |
                                                <a href="{{ url('admin/assignuser/edit',$udata->id )}}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a>  
                                                
                                                @can('uagent-delete')
                                                | 
                                                <a href="{{ url('admin/assignuser/delete',$udata->id )}}"> 
                                                <button type="button" value="{{ url('admin/assignuser/delete',$udata->delete )}}" class="btn btn-outline-danger btn-sm radius-30 px-4" onclick="return confirm('Are You Sure Delete This Record..!')"><i class="bx bx-trash"></i><span class="tooltip">Delete</span></button></a>
                                                @endcan
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



@include('backend.common.footer')

@include('backend.common.notification') 

	
@endsection

