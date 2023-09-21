@extends('backend.layouts.master')
@section('title','Assign Account Payable Management')
@section('content')

		<!--start page wrapper -->

		<div class="page-wrapper">
			<div class="page-content">

				<!--breadcrumb-->

				<!--end breadcrumb--> 

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif

                @if ($message = Session::get('danger'))
                <div class="alert alert-danger">
                <p>{{ $message }}</p>
                </div>
                @endif

				<ul class="nav nav-tabs">

                    <li class="pending_approval active"><a href="javascript::void(0);" data-toggle="tab" aria-expanded="true">Ap List</a>
                    </li>
                    <li class="pending_approval"><a href="{{url('admin/assignacp/add')}}" data-toggle="tab" aria-expanded="true">Assign User</a>
                    </li>
                </ul>



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
                                        <th>Handel By User </th>
                                        <th>Agent (User)</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <!-- <th style="width: 200px;">Action</th> -->
									</tr>
								</thead>
								<tbody>

								@php
								$i = 0;
								@endphp
							@if(count($userdata) > 0)
                                @foreach($userdata as $udata)
                                   
                                        <tr>
											<td>{{ ++$i; }}</td>

											<td>
												@php	
												$assignbyuser= \App\Models\User::where('id',$udata->assign_by)->first();
												@endphp
												{{ isset($assignbyuser['name']) ? $assignbyuser['name'] :Null }}
											</td>
											
											<td>
												@php
												$assigntouser= \App\Models\User::where('id',$udata->ap_user)->first();
												@endphp
												{{ isset($assigntouser['name']) ? $assigntouser['name'] :Null }}
											</td>

											<td>
												@php
												$assignuser= \App\Models\User::where('id',$udata->assign_agent_to)->first();
												@endphp
												{{ isset($assignuser['name']) ? $assignuser['name'] : Null }}
											</td>

                                            <td>
												{{ $joined_on  = date('d M, Y', strtotime($udata['created_at'])); }}
											</td>


											
												<?php 	

												// $encoded_id = base64_encode($agent->id);
												$encoded_id = $udata->assign_agent_to;
												$datastatus = App\Models\AssignAcPayable::where('assign_agent_to',$encoded_id)->first('status');
												
												$statusdata = isset($datastatus->status) ? $datastatus->status : Null ;
												if ($statusdata == '1') {
													// $checked = '';
													$checked = 'checked';
												}else {

													$checked = '';
													// $checked = 'checked';
												}

													$status_content = '<input type="checkbox"  satatus='.$datastatus.' class="stat_check" '.$checked.' data-toggle="toggle" cat='.$encoded_id.'>';

												?>

                                            <td class="switch-btn">
                                                {!! $status_content !!}
                                                <span class="switch"></span>
                                            </td>


											@php
												$userid = base64_encode($udata->user_id); 
											@endphp

											<!-- <td class="action_tooltip">

                                                
                                                <a href="{{ url('admin/assignuser/list/details',$userid )}}"> 
                                                    <button type="button" value="{{$udata->user_id}}" class="btn btn-info btn-sm radius-30 px-4"><i class="bx bx-info-circle"></i><span class="tooltip">Details</span></button>

												</a> 
                                            </td> -->
											                                          
                                        </tr>
                                @endforeach
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





    {{-- for status checking start here --}}

    <script>

		$(function() {
		  $(document).on('change','.stat_check', function() {
			  var curr    = $(this).prop('checked');
			  var cat     = $(this).attr('cat');

			  $.ajax({
				  type:"post",
				  url:"{{ url('admin/assignuser/status') }}",
				  data: {'curr': curr, 'cat':cat},
				  success:function(resp){
					  if(resp.status == 'true'){
						  swal(resp.msg,'','success');
					  } else{
						  swal(resp.msg,'','warning');
					  }
				  }

			  })
		  })
		})
		</script>      

@include('backend.common.footer')
@endsection
