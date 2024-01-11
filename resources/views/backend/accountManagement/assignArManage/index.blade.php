@extends('backend.layouts.master')
@section('title','Assign Account Reveivable Management')
@section('content')

		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<ul class="nav nav-tabs">
                    <li class="pending_approval active"><a href="javascript::void(0);" data-toggle="tab" aria-expanded="true">Manage Shipments</a>
                    </li>
                </ul>

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
                                        <th>Handel By User </th>
                                        <th>Agent (User)</th>
                                        <th>Date</th>
                                        <th style="width: 200px;">Action</th>
									</tr>
								</thead>
								<tbody>
								@php
								$i = 0;
								@endphp

								@if(count($userdata) > 0)
                                @foreach($userdata as $udata)

                                        <tr>
											<td>{{ ++$i; }}

											<td>
												@php	
												$assignbyuser= \App\Models\User::where('id',$udata->assignby_id)->first();
												@endphp
                                                {{ isset($assignbyuser['name']) ? $assignbyuser['name'] : Null }}
											</td>
											
											<td>
												@php
												$assigntouser= \App\Models\User::where('id',$udata->assignto_id)->first();
												@endphp
												{{ isset($assigntouser['name']) ? $assigntouser['name'] : Null }}
											</td>





											<td>
												@php
												$assignuser= \App\Models\User::where('id',$udata->user_id)->first();
												@endphp
												{{ isset($assignuser['name']) ? $assignuser['name'] : Null }}
											</td>

                                            <td>
												{{ $joined_on  = date('d M, Y', strtotime($udata['created_at'])); }}
											</td>

											<?php 	

												$encoded_id = $udata->id;

												//$datastatus = App\Models\AssignAcReceivable::where('assign_agent_to',$encoded_id)->first('status');
												//dd($datastatus);

												$statusdata = isset($udata->ar_access_status) ? $udata->ar_access_status : Null ;

												if ($statusdata == '1') {

													// $checked = '';
													$checked = 'checked';
												}else{
													$checked = '';
													// $checked = 'checked';
												}
													$status_content = '<input type="checkbox"  satatus='.$statusdata.' class="stat_check" '.$checked.' data-toggle="toggle" cat='.$udata->id.'>';

												?>

												



											<td class="action_tooltip">

                                                <!--<a href="{{ url('admin/assignuser/view',$udata->id )}}"> -->

                                                <!--<button type="button" value="{{ $udata->id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a> -->



												<a href="{{ url('admin/ar/assign/user/list',base64_encode($udata->user_id) )}}" target="_blank"> 

													<button type="button" value="{{isset( $udata->user_id) ? $udata->user_id : Null }}" class="btn btn-success btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">User List</span></button></a>

                                            </td>
											                                     
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
				  url:"{{ url('admin/ar/assignuser/status') }}",
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
