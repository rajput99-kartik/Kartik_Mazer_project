@extends('backend.layouts.master')

@section('title','User Management')

@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--<div class="row">-->
    <!--            <div class="col-md-3 pl-lg">-->
                    <!-- START widget-->
    <!--                <div class="panel widget bg-gradient-deepblue">-->
    <!--                    <div class="pl-sm pr-sm pb-sm">-->
    <!--                        <strong><a style="font-size: 15px" class="b_status" search-type="unconfirmed" id="unconfirmed" href="#">Inactive</a>-->
    <!--                            <small class="pull-right " style="padding-top: 2px"> 0 / 0</small>-->
    <!--                        </strong>-->
    <!--                        <div class="progress progress-striped progress-xs mb-sm">-->
    <!--                            <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
                    <!-- END widget-->
    <!--            </div>-->
    <!--            <div class="col-md-3">-->
                    <!-- START widget-->
    <!--                <div class="panel widget bg-gradient-ibiza">-->
    <!--                    <div class="pl-sm pr-sm pb-sm">-->
    <!--                        <strong><a style="font-size: 15px" class="b_status" search-type="confirmed" id="confirmed" href="#">Active</a>-->
    <!--                            <small class="pull-right " style="padding-top: 2px"> 0  / 0</small>-->
    <!--                        </strong>-->
    <!--                        <div class="progress progress-striped progress-xs mb-sm">-->
    <!--                            <div class="progress-bar progress-bar-info " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
                    <!-- END widget-->
    <!--            </div>-->
    <!--            <div class="col-md-3">-->
                    <!-- START widget-->
    <!--                <div class="panel widget bg-gradient-moonlit">-->
    <!--                    <div class="pl-sm pr-sm pb-sm">-->
    <!--                        <strong><a style="font-size: 15px" class="b_status" search-type="in_progress" id="in_progress" href="#">Agents</a>-->
    <!--                            <small class="pull-right " style="padding-top: 2px"> 0  / 0</small>-->
    <!--                        </strong>-->
    <!--                        <div class="progress progress-striped progress-xs mb-sm">-->
    <!--                            <div class="progress-bar progress-bar-warning " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
                    <!-- END widget-->
    <!--            </div>-->
        
    <!--            <div class="col-md-3">-->
                    <!-- START widget-->
    <!--                <div class="panel widget bg-gradient-ohhappiness">-->
    <!--                    <div class="pl-sm pr-sm pb-sm">-->
    <!--                        <strong><a style="font-size: 15px" class="b_status" search-type="resolved" id="resolved" href="#">Admin/Manager</a>-->
    <!--                            <small class="pull-right " style="padding-top: 2px"> 0 / 0</small>-->
    <!--                        </strong>-->
    <!--                        <div class="progress progress-striped progress-xs mb-sm">-->
    <!--                            <div class="progress-bar progress-bar-danger " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>-->
    <!--                        </div>-->
    <!--                    </div>-->
    <!--                </div>-->
                    <!-- END widget-->
    <!--            </div>-->
    <!--        </div>-->
				
				<ul class="nav nav-tabs">
                    <li class="pending_approval"><a href="{{url('/admin/users')}}" data-toggle="tab" aria-expanded="true">All Users</a>
                    </li>
                    <li class="pending_approval active"><a href="{{url('/admin/trashed-user')}}" data-toggle="tab" aria-expanded="true">Trashed Users</a>
                    </li>
                    <li class="all_leave"><a href="{{url('/admin/users/create')}}" data-toggle="tab" aria-expanded="false">Add New</a>
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
						<div class="table-responsive">
							<table class="table mb-0" id="carrier_table" >
								<thead class="table-light">
									<tr>
                                    <th style="width: 300px;">Name</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    <th>Status</th>
                                   
									<th style="width:134px;">Restore / Delete Permanently</th>
									</tr>
								</thead>
								<tbody>
								    @if(count($data) > 0)
                                @foreach ($data as $key => $user)

								<?php 
								
									//  $encoded_id = base64_encode($user['id']);
									 $encoded_id = base64_encode($user->id);
									//$encoded_id = $user['id'];
									if($user['status'] == '1'){
										$checked = 'checked';
									} else{
										$checked = '';
									}

									$status_content = '<input type="checkbox"  class="stat_check" '.$checked.' data-toggle="toggle" cat='.$encoded_id.'>';
								?>
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>

                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $v)
                                            <div class="badge rounded-pill text-white bg-<?php if($v=='Agent'){echo "danger";}elseif($v=='superadmin'){echo "success"; }else{echo "info";} ?> p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>{{ $v }}</div>
                                            @endforeach
                                            @endif
                                        </td>
										<td class="switch-btn">
											{!! $status_content !!}
											<span class="switch"></span>
										</td>
										
                                        <td class="action">
										<a href="{{url('/admin/restore-user').'/'.$user->id}}" class="btn btn-success btn-sm radius-30 px-4">Restore</a>
										<a href="{{url('/admin/delete-user').'/'.$user->id}}" class="btn btn-danger btn-sm radius-30 px-4" onclick="return confirm('Are Youe Sure Delete This User Permanently? ')">Delete</a>
										</td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr style="background-color: #edf3f652;">
                                        <td colspan="5">
                                            <div class="row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4 not-found">
                                                    <img src="https://crmonline.co.in/public/backend/assets/images/message.png">
                                                    <h4>No user trashed, yet.</h4>
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
@include('backend.common.footer')


{{-- <script>
    $('#carrier_table').DataTable({
        'ajax':{
            'url': "{{ url('admin/changeuserStatus/') }}",
            "error": function(reason) {
                console.log(reason);
            }
        },
        
    });




	'ajax':{
            'url': "{{ url('admin/data/categories') }}",
            "error": function(reason) {
                console.log(reason);
            },
            "complete": function (data) {
                $('.stat_check').bootstrapToggle({
                    on: 'Active',
                    off: 'Inactive'
                });
            }
        },

</script> --}}



{{-- <script>
	$(document).on('click','#check1', function(){
		
		if($(this).is(':checked')){
			var statid = $(this).data-attr(cat);
			alert(statid);
		}
        else{
            alert('unchecked');
		}
		
		//ShowLoaderTimeLine();
			$.ajax({
				url: HOSTPATH+'admin/changeuserStatus',
				type: 'get',
				cache : false,
				data: {agency_id:agency_id},
				success: function(data){
					$('#agency_detail_edit').html(data);
					setTimeout(function () {
							Swal.close();
							$('#agency_detail_edit').modal('show');
					}, 500);
				}
			});
	});
</script> --}}

 <script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
    $(function() {
        $(document).on('change','.stat_check', function() {
            var curr    = $(this).prop('checked');
            var cat     = $(this).attr('cat');
            $.ajax({
                type:"post",
                url:"{{ url('admin/changeuserStatus') }}",
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

{{-- swal({
	title: "User created!",
	text: "Suceess message sent!!",
	icon: "success",
	button: "Ok",
	timer: 2000
}); --}}
@endsection