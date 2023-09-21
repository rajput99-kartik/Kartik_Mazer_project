@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Assign Ap</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Assign Accoun Payable</li>
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
                                        <th>Assign By User </th>
                                        <th>Team Leader</th>
                                        <th>Agent (User)</th>
                                        <th>Date</th>
                                        <th style="width: 200px;">Action</th>
									</tr>
								</thead>
								<tbody>
								@php
								$i = 0;
								@endphp
                                @foreach($userdata as $udata)
											{{$udata->id}}
                                        <tr>
											<td>{{ ++$i ;}}
											@foreach($udata->apassignbyuser as $asdata)
											<td>{{ isset($asdata['name']) ? $asdata['name'] : Null }}</td>
											@endforeach

											@foreach($udata->apTeamLeader as $tleader)
											<td>	
												<a href="{{ url('admin/assignuser/view',$tleader->id )}}"> 
													{{ isset($tleader['name']) ? $tleader['name'] : Null }}
												</a>
											</td>
											@endforeach

											@foreach($udata->apTeamAgent as $agent)
											<td><a href="{{ url('admin/assignuser/view',$agent->id )}}">{{ ucwords($agent['name'])  }} </a></td>
											@endforeach

											@foreach($udata->apassignbyuser as $asdata)
											<td>{{ $joined_on  = date('d M, Y', strtotime($asdata['created_at'])); }}</td>
											@endforeach

											@foreach($udata->apTeamAgent as $agent)
											<td class="action_tooltip">
                                                <a href="{{ url('admin/assignuser/view',$agent->id )}}"> 
                                                <button type="button" value="{{ $agent->id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a> 
                                            </td>
											@endforeach                                            
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
@endsection

