@extends('backend.layouts.master')
@section('title','User Management')
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

				<div class="row">

                <div class="col-md-3 pl-lg">

                    <!-- START widget-->

                    <div class="panel widget bg-gradient-deepblue">

                        <div class="pl-sm pr-sm pb-sm">

                            <strong><a style="font-size: 15px" class="b_status" search-type="status" value="0" id="unconfirmed" href="#">Inactive</a>

                                <small class="pull-right " style="padding-top: 2px"> {{$unactive}} / {{$total}}</small>

                            </strong>

                            <div class="progress progress-striped progress-xs mb-sm">
                                <?php
                                    $unactivew = number_format(($unactive/$total*100),0)."%";
                                ?>
                                <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="{{$unactivew}}" style="width:{{$unactivew}}"><span>{{$unactivew}}</span></div>

                            </div>

                        </div>

                    </div>

                    <!-- END widget-->

                </div>

                <div class="col-md-3">

                    <!-- START widget-->

                    <div class="panel widget bg-gradient-ibiza">

                        <div class="pl-sm pr-sm pb-sm">

                            <strong><a style="font-size: 15px" class="b_status" search-type="status" value="1" id="confirmed" href="#">Active</a>

                                <small class="pull-right " style="padding-top: 2px"> {{$active}}  / {{$total}}</small>

                            </strong>

                            <div class="progress progress-striped progress-xs mb-sm">
                                <?php
                                    $activew = number_format(($active/$total*100),0)."%";
                                ?>
                                <div class="progress-bar progress-bar-info " data-toggle="tooltip" data-original-title="{{$activew}}" style="width: {{$activew}}"><span>{{$activew}}</span></div>

                            </div>

                        </div>

                    </div>

                    <!-- END widget-->

                </div>

                <div class="col-md-3">

                    <!-- START widget-->

                    <div class="panel widget bg-gradient-moonlit">

                        <div class="pl-sm pr-sm pb-sm">

                            <strong><a style="font-size: 15px" class="b_status" search-type="user_type" value="agent" id="in_progress" href="#">Agents</a>

                                <small class="pull-right " style="padding-top: 2px"> {{$totalagent}} / {{$total}}</small>

                            </strong>

                            <div class="progress progress-striped progress-xs mb-sm">
                                <?php
                                    $totalagentw = number_format(($totalagent/$total*100),0)."%";
                                ?>
                                <div class="progress-bar progress-bar-warning " data-toggle="tooltip" data-original-title="{{$totalagentw}}" style="width: {{$totalagentw}}"><span>{{$totalagentw}}</span></div>

                            </div>

                        </div>

                    </div>

                    <!-- END widget-->

                </div>

        

                <div class="col-md-3">

                    <!-- START widget-->

                    <div class="panel widget bg-gradient-ohhappiness">

                        <div class="pl-sm pr-sm pb-sm">

                            <strong><a style="font-size: 15px" class="b_status" search-type="user_type" value="admin" id="resolved" href="#">Admin</a>

                                <small class="pull-right " style="padding-top: 2px"> {{$admin}} / {{$total}}</small>

                            </strong>

                            <div class="progress progress-striped progress-xs mb-sm">
                                <?php
                                    $adminw = number_format(($admin/$total*100),0)."%";
                                ?>
                                <div class="progress-bar progress-bar-danger " data-toggle="tooltip" data-original-title="{{$adminw}}" style="width: {{$adminw}}"><span>{{$adminw}}</span></div>

                            </div>

                        </div>

                    </div>

                    <!-- END widget-->

                </div>

            </div>

				

				<ul class="nav nav-tabs">

                    <li class="pending_approval active"><a href="{{url('/admin/users')}}" data-toggle="tab" aria-expanded="true">All Users</a>

                    </li>

                    <li class="pending_approval"><a href="{{url('/admin/trashed-user')}}" data-toggle="tab" aria-expanded="true">Trashed Users</a>

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

                                    <th class="userimg">Photo</th>

                                    <th>Name</th>

                                    <th>Email</th>

                                    <th>Roles</th>

                                    <th>Office</th>
                                    
                                    <th>Status</th>

                                   

									<th style="width:134px;">Actions</th>

									</tr>

								</thead>

								<tbody id="user_data">

                                @foreach ($data as $key => $user)



								<?php 

								

									//  $encoded_id = base64_encode($user['id']);

									 $encoded_id = base64_encode($user->id);
									 $mainiduser = base64_decode($encoded_id); 

									//$encoded_id = $user['id'];

									if($user['status'] == '1'){

										$checked = 'checked';

									} else{

										$checked = '';

									}



									$status_content = '<input type="checkbox"  class="stat_check" '.$checked.' data-toggle="toggle" cat='.$encoded_id.'>';

									if($user->user_type=='super_admin'){

									    

									}else{

								?>

                                    <tr>

                                        

                                        <td class="user-img">

                                            @if(count($user->userDetailsdata))

                                            @foreach($user->userDetailsdata as $userdetails)

                                            @if($userdetails->profile_pic)

                                            <img class="user-mainpic" src="{{url('public/user-pic').'/'.$userdetails->profile_pic}}">

                                            @else

                                            <img class="user-pic" src="{{url('public/backend/assets/images/dummy-user.png')}}">

                                            @endif

                                            @endforeach

                                            @else

                                            <img class="user-pic" src="{{url('public/backend/assets/images/dummy-user.png')}}">

                                            @endif

                                        </td>

                                        <td class="copy-text">{{ $user->name }}</td>

                                        <td class="copy-text">{{ $user->email }}</td>



                                        <td>

                                            @if(!empty($user->getRoleNames()))

                                            @foreach($user->getRoleNames() as $v)

                                            <div class="badge rounded-pill text-white bg-<?php if($v=='Agent'){echo "danger";}elseif($v=='superadmin'){echo "success"; }else{echo "info";} ?> p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>{{ $v }}</div>

                                            @endforeach

                                            @endif

                                        </td>
                                        
                                        <td>
                                            @php

                                            $userid = base64_encode($user->id);
                                           // dd($user);
                                            $userid =Auth::id()  ;

                                            
                                            // $userid = base64_decode($user->id);
                                            $user = App\Models\User::find($mainiduser);
                                            $agncydata = DB::table('agency_details')->where('user_id',$mainiduser)->first();
                                                $agid = '';
                                                if(!empty( $agncydata->agency_id)){
                                                    $agid = $agncydata->agency_id ;
                                                }else {
                                                    $agid = '0' ;
                                                }
                                                $ages = DB::table('agencies')->get();
                                            @endphp
                                            
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

										<td class="switch-btn">

											{!! $status_content !!}

											<span class="switch"></span>

										</td>
										

                                        <td class="action action_tooltip">
                                            @php
                                                $userid = base64_encode($user->id); 
                                            @endphp

										    <a href="{{ route('users.show',$userid) }}"> 
										    <button type="button" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>
											<a href="{{ route('users.edit',$userid) }}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a>

											<form method="POST" action="{{route('users.destroy',$user->id )}}" accept-charset="UTF-8" style="display:inline">
												@csrf

												<input name="_method" type="hidden" value="DELETE">
												<button onclick="return confirm('Are You Sure Delete This Record..!')" class="btn btn-outline-danger btn-sm radius-30 px-4" type="submit"><i class="bx bx-trash"></i><span class="tooltip">Delete</span></button>

											</form>
										</td>

                                    </tr>

                                    <?php } ?>
                                @endforeach

								</tbody>

							</table>

						</div>

						

						

						

						

						

						<!--import or export-->

						<!--<form action="{{ url('admin/import') }}" method="POST" enctype="multipart/form-data">-->

      <!--                      @csrf-->

      <!--                      <div class="form-group mb-4">-->

      <!--                          <div class="custom-file text-left">-->

      <!--                              <input type="file" name="file" class="custom-file-input" id="customFile">-->

      <!--                              <label class="custom-file-label" for="customFile">Choose file</label>-->

      <!--                          </div>-->

      <!--                      </div>-->

      <!--                      <button class="btn btn-primary">Import Users</button>-->

      <!--                      <a class="btn btn-success" href="{{ url('admin/export-users') }}">Export Users</a>-->

      <!--                  </form>-->

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
    
    //user filter req
    $("a.b_status").click(function(e){
        e.preventDefault();
        var filter_type = $(this).attr('search-type');
        var filter_value = $(this).attr('value');
        $("a.b_status").removeClass("active");
        $(this).addClass("active");
        $.ajax({
          url: "{{url('/admin/user-filter')}}",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            filter_type:filter_type,
            filter_value:filter_value,
          },
          success:function(response){
              let timerInterval
                Swal.fire({
                  title: 'Wait..',
                  html: 'I will Filter in <b></b> milliseconds.',
                  timer: 1000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                      b.textContent = Swal.getTimerLeft()
                    }, 500)
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                  }
                })
                setTimeout(function(){
                    $("#user_data").html(response);
                    $("div#carrier_table_paginate, div#carrier_table_info").hide();
                }, 500)
          }
         });
    })

} );

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

{{-- swal({

	title: "User created!",

	text: "Suceess message sent!!",

	icon: "success",

	button: "Ok",

	timer: 2000

}); --}}


<script>
    $(document).ready(function() {
    $('#carrier_table66').DataTable( {
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
            // targets: +0,
            visible: false
        } ]
    } );
} );
</script>

@endsection