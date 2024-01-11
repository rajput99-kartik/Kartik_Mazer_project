@extends('backend.layouts.master')
@section('title','Carrier Management')
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
                @can('carrier-all')
			    <li class="pending_approval active"><a href="{{url('/admin/carrier/list')}}" data-toggle="tab" aria-expanded="true">All Carrier</a>
                </li>
                @endcan
                <li class="pending_approval "><a href="{{url('/admin/carrier')}}" data-toggle="tab" aria-expanded="true">Carrier</a>
                </li>
                <li class="all_leave"><a href="{{url('/admin/new/carrier/detail')}}" data-toggle="tab" aria-expanded="false">Create Carrier</a>
                    </li>
                    <li class=""><a href="{{url('/admin/carrier/myCarrierPacket')}}" data-toggle="tab" aria-expanded="false">MyCarrierPacket</a>
                </li>

				<li class=""><a href="{{url('/admin/carrier/disputed')}}" data-toggle="tab" aria-expanded="false">Disputed Carrier</a>
                </li>
				
				
            </ul>
			<div class="card">
				<div class="card-body table-responsive">
					<table class="table" id="carrier_table">
					<thead class="table-light">
					  <tr>
						 <th>No</th>
						 <th>MC Number</th>
						 <th>DOT Number</th>
						 <th>Carrier Name</th>
						 <th>Added By</th>
						 <th>Address</th>
						 <th>State</th>
						 <th>Status</th>
						 <th>Block Carrier</th>
						 <th>Date</th>
						 <th width="170px">Action</th>
					  </tr>
					</thead>
						@php
							$i = 0;
						@endphp
						@if(count($carriers_data) > 0)
							@foreach ($carriers_data as $key => $carriers_result)
								@php
								$createdby = App\Models\User::where('id',$carriers_result->user_id)->first();
								@endphp

								@if ($carriers_result->carrier_disputed == 0)

													<?php 
                                                        $encoded_id = $carriers_result->id;
                                                        if($carriers_result->carrier_disputed == 1){
                                                            $checked = 'checked';
                                                        } else{
                                                            $checked = '';
                                                        }
                                                        $status_content = '<input type="checkbox"  class="stat_check" '.$checked.' data-toggle="toggle" cat='.$encoded_id.'>';
                                                        

                                                    ?>
								<tr>
									<td> {{ ++$i }} </td>
									<td class="copy-text">{{ $carriers_result->mc_no }}</td>
									<td class="copy-text">{{ $carriers_result->dot_no }}</td>								
									<td class="copy-text">{{ substr($carriers_result->c_company_name, 0, 15).".." }}</td>
									<td>{{ isset($createdby->name) ?  $createdby->name : Null}}</td>
									
									<td>{{ substr($carriers_result->carrier_city, 0, 15).".." }}</td>
									<td>{{ $carriers_result->carrier_city_main }}</td>
									<td>
										@if($carriers_result->status == '0')
											<div class="badge rounded-pill text-white bg-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Pending</div>
										@elseif($carriers_result->status == '1')
											<div class="badge rounded-pill text-white bg-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Approve</div>
										@else
											<div class="badge rounded-pill text-white bg-warning p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Disapprove</div>
										@endif
									</td>

												
									<td class="switch-btn">
										{!! $status_content !!}
										<span class="switch"></span>
									</td>

									<td>{{ date('d M, Y', strtotime($carriers_result->created_at)) }}</td>
									
									@php
										//$roleid = Crypt::encrypt($role->id);
										$carrierid = base64_encode($carriers_result->id);
									@endphp
									<td class="action_tooltip">
										<!--<button type="button" id="" class="btn btn-outline-info btn-sm radius-30 px-4 carrier_edit" value="{{ $carriers_result->id }}"> <i class="bx bx-show"></i> <span class="tooltip">View</span></button>-->
										@can('role-edit')
										<button type="button" id="" class="btn btn-outline-secondary btn-sm radius-30 px-4 carrier_edit" value="{{ $carriers_result->id }}"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></button>
										@endcan
										<a href="{{url('/admin/carrier/profile',$carrierid)}}" target="_blank">
										<button type="button" id="carrier_profile" class="btn btn-outline-info btn-sm radius-30 px-4" value="{{ $carriers_result->id }}"> <i class="bx bx-show"></i> <span class="tooltip">Profile</span></button></a>
									</td>
								</tr>
								@endif

							@endforeach
						@else
						<tr style="background-color: #edf3f652;">
							<td colspan="9">
								<div class="row">
									<div class="col-md-4"></div>
									<div class="col-md-4 not-found">
										<img src="{{url('/public/backend/assets/images/message.png')}}">
										<h4> No Carrier created, yet.</h4>
									</div>
									<div class="col-md-4"></div>
								</div>
							</td>
						</tr>
						@endif
					</table>
			</div>
		</div>
		</div>
	</div>
<!--end page wrapper -->
<!-- New carrier add form Modal start -->
<div class="modal" id="add_new_carrier_form">
</div>
<!-- New carrier add form Modal end -->
<!-- New carrier add form Modal start -->
<div class="modal" id="edit_carrier_form">
</div>
<!-- New carrier add form Modal end -->



<script>
    $(document).ready(function() {
    $('#carrier_table').DataTable( {
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'csv',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
        columnDefs: [ {
            // targets: -2,
            visible: false
        } ]
    } );
} );
</script>


	<script>
		$(function() {
			$(document).on('change','.stat_check', function() {
				var curr    = $(this).prop('checked');
				var cat     = $(this).attr('cat');
				$.ajax({
					type:"post",
					url:"{{ url('admin/carrier/disputed/status') }}",
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


<!--<script>-->
<!--    $(document).ready(function() {-->
<!--    $('#carrier_table').DataTable( {-->
<!--        dom: 'Bfrtip',-->
<!--        buttons: [-->
<!--        'copy', 'csv', 'excel', 'pdf', 'print',-->
        
<!--        ]-->
        
       
<!--    } );-->
<!--} );-->
<!--</script>-->
@include('backend.common.footer')
@endsection