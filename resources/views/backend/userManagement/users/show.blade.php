@extends('backend.layouts.master')
@section('title','Dashboard')
@section('content')

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

    <div class="page-wrapper">
		<div class="page-content">
			<?php
			    $userdetail = DB::table('userdetails')->where('userid', $user->id)->first();
			?>
			<ul class="nav nav-tabs">
                <li class="pending_approval"><a href="{{url('/admin/users')}}" data-toggle="tab" aria-expanded="true">All Users</a>
                </li>

                <li class="all_leave active"><a href="javascript:void(0);" data-toggle="tab" aria-expanded="false">User View</a>
                    </li>
            </ul>
			
			<div class="card">
			    <div class="card-body">
			        
			            <div class="unwrap">

                        <div class="cover-photo bg-cover">
                            <div class="row p-xl text-white">
                    
                                <div class="row col-sm-4">
                                    <div class="row pull-left col-sm-6">
                                        <div class=" row-table row-flush">
                                            <div class="pull-left text-white ">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">1                                </h4>
                                                    <p class="mb0 text-muted">Open Projects</p>
                                                    <small><a href="#" class="mt0 mb0">More info <i class="fa fa-arrow-circle-right"></i></a></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-lg row-flush" style="margin-top: -30px;">
                    
                                            <div class="pull-left">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">0                                </h4>
                                                    <p class="mb0 text-muted">Complete Projects</p>
                                                    <small><a href="#" class="mt0 mb0">More info <i class="fa fa-arrow-circle-right"></i></a></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pull-right col-sm-6">
                                        <div class=" row-table row-flush">
                    
                                            <div class="pull-left text-white ">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">5                                </h4>
                                                    <p class="mb0 text-muted">Open Tasks</p>
                                                    <small><a href="#" class="mt0 mb0">More info <i class="fa fa-arrow-circle-right"></i></a></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-lg row-table row-flush">
                    
                                            <div class="pull-left">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">0                                </h4>
                                                    <p class="mb0 text-muted">Complete Tasks</p>
                                                    <small><a href="#" class="mt0 mb0">More info<i class="fa fa-arrow-circle-right"></i></a></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="text-center ">
                                        @if($userdetail)
                                            @if($userdetail->profile_pic!=null)
                                                <img style="width: 100px; height: 100px;" src="{{url('/public/user-pic').'/'.$userdetail->profile_pic}}" class="img-thumbnail img-circle thumb128 ">
                                            @else
                                                <img src="{{url('/public/backend/assets/images/dummy-user.png')}}" class="img-thumbnail img-circle thumb128 ">
                                            @endif
                                        @else
                                            <img src="{{url('/public/backend/assets/images/dummy-user.png')}}" class="img-thumbnail img-circle thumb128 ">
                                        @endif
                                    </div>
                    
                                    <h3 class="m0 text-center">{{ $user->name }}                 </h3>
                                    <p class="text-center">	Extension No: {{ $user->ext }}</p>
                                    <p class="text-center">Agency Name  ⇒ 
                                    @php
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
                                    </p>
                                </div>
                                <div class="row col-sm-5">
                                    <div class="pull-left col-sm-6">
                                        <div class=" row-table row-flush">
                                            <div class="pull-left text-white ">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">0 / 22                                </h4>
                                                    <p class="mb0 text-muted">Monthly Attendance</p>
                                                    <small><a href="#" class="mt0 mb0">More info <i class="fa fa-arrow-circle-right"></i></a></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-lg row-table row-flush">
                    
                                            <div class="pull-left">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">0                                </h4>
                                                    <p class="mb0 text-muted">Monthly Leave</p>
                                                    <small><a href="#" class="mt0 mb0">More info <i class="fa fa-arrow-circle-right"></i></a></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pull-right col-sm-6">
                                        <div class=" row-table row-flush">
                    
                                            <div class="pull-left text-white ">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">0                                </h4>
                                                    <p class="mb0 text-muted">Monthly Absent</p>
                                                    <small><a href="#" class="mt0 mb0">More info <i class="fa fa-arrow-circle-right"></i></a></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-lg row-table row-flush">
                    
                                            <div class="pull-left">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">0                                </h4>
                                                    <p class="mb0 text-muted">Total Award</p>
                                                    <small><a href="#" class="mt0 mb0">More info <i class="fa fa-arrow-circle-right"></i></a></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                        <div class="text-center bg-gray-dark p-lg mb-xl">
                            <div class="row row-table">
                                <div class="col-md-3 br user-timer">
                                    <h3 class="m0"><ul class="timer"><li>0<span> Hours</span></li><li class="dots">:</li><li>0<span> Minutes</span></li><li class="dots">:</li><li>0<span>Seconds</span></li></ul></h3>
                                    <p class="m0">
                                        <span class="hidden-xs">Projects  Hours</span>
                                    </p>
                                </div>
                                <div class="col-md-3 br user-timer">
                                    <h3 class="m0"><ul class="timer"><li>114<span> Hours</span></li><li class="dots">:</li><li>6<span> Minutes</span></li><li class="dots">:</li><li>56<span>Seconds</span></li></ul></h3>
                                    <span class="hidden-xs">Tasks  Hours</span>
                                </div>
                                <div class="col-md-3 br user-timer">
                                    <h3 class="m0">0 : 0 m</h3>
                                    <span class="hidden-xs">This month Working  Hours</span>
                                </div>
                                <div class="col-md-3 user-timer">
                                    <h3 class="m0">526550 : 42 M</h3>
                                    <span class="hidden-xs">Working  Hours</span>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="nav nav-tabs user_tab">
                              <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home">Basic Details</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu1">Bank Details</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu2">Documents Details</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#salery">Salary Details</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#timecard">Timecard Details</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#leave">Leave Details</a>
                              </li>
                            </ul>
                        </div>
                        <div class="col-md-9 usertab_txt">
                            <div class="tab-content">
                              <div class="tab-pane container active" id="home">
                                  <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>{{ $user->name }}</strong>
                                     
                                        <div class="pull-right">
                                            {{-- <span data-placement="top" data-toggle="tooltip" title="" data-original-title="">Edit --}}
                                            </span>

                                            <button type="button" id="userprofileid" class="btn btn-outline-info btn-sm radius-30 px-4 uprofile_detail_form" value="{{ $user->id }}"><i class="bx bx-pen"></i><span class="tooltip">Edit</span></button>

                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row panel-body form-horizontal">
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="control-label col-sm-5"><strong>EMP ID :</strong></label>
                                        <div class="col-sm-7 ">
                                            <p class="form-control-static">{{ $user->officerid }}</p>
            
                                        </div>
                                    </div>
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="control-label col-sm-5"><strong>Full Name                                    :</strong></label>
                                        <div class="col-sm-7 ">
                                            <p class="form-control-static">{{ $user->name }}</p>
            
                                        </div>
                                    </div>
                                        <div class="form-group mb0  col-sm-6">
                                            <label class="control-label col-sm-5"><strong>Username                                        :</strong></label>
                                            <div class="col-sm-7 ">
                                                <p class="form-control-static">{{ $user->name }}</p>
            
                                            </div>
                                        </div>
                                        <div class="form-group mb0  col-sm-6">
                                            <label class="control-label col-sm-5"><strong>Password                                        :</strong></label>
                                            <div class="col-sm-7 ">
                                                <p class="form-control-static"><a data-toggle="modal" data-target="#myModal" href="#">Reset Password</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group mb0  col-sm-6">
                                            <label class="col-sm-5 control-label"> <strong>Joining Date:</strong>   </label>
                                            <div class="col-sm-7">
                                                {{date('d.M.Y', strtotime($user->created_at)) }}
                                            </div>
                                        </div>
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label"> <strong>Gender:</strong> </label>
                                        <div class="col-sm-7">  {{ $user->gender }}
                                    </div>
                                    </div>
                                    <div class="form-group mb0  col-sm-6">
            
                                        <label class="col-sm-5 control-label"><strong>Date Of Birth:</strong>  </label>
                                        <div class="col-sm-7"> {{ $user->dob }}
                                                                        </div>
                                    </div>
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label"><strong>Marital Status:</strong> </label>
                                        <div class="col-sm-7"> {{ $user->marrid }}
                                                                        </div>
                                    </div>
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label"><strong>Fathers Name:</strong>  </label>
                                        <div class="col-sm-7">{{ $user->father_name }}
                                                                        </div>
                                    </div>
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label"><strong>Mothers Name:</strong>  </label>
                                        <div class="col-sm-7"> {{ $user->mother_name }}
                                                                        </div>
                                    </div>
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label"><strong> Email : </strong></label>
                                        <div class="col-sm-7">
                                            <p class="form-control-static">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label"><strong>Phone : </strong> </label>
                                        <div class="col-sm-7">
                                            <p class="form-control-static">{{ $user->phone }}</p>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label"><strong>Mobile :</strong>  </label>
                                        <div class="col-sm-7">
                                            <p class="form-control-static">phone 8580632443</p>
                                        </div>
                                    </div> -->
                                    {{-- <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label">Skype id : </label>
                                        <div class="col-sm-7">
                                            <p class="form-control-static">8580632443</p>
                                        </div>
                                    </div> --}}
                                                            <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label"><strong>Present Address:</strong>  </label>
                                        <div class="col-sm-7">{{ $user->parmanent_address }}
                                            <p class="form-control-static"></p>
                                        </div>
                                    </div>
                                    
                                </div>
                              </div>
                              <div class="tab-pane container fade" id="menu1">
                                  <div class="panel-heading">
                                        <div class="panel-title">
                                            <strong>Bank Details</strong>
                                            <div class="pull-right">
                                                <span data-placement="top" data-toggle="tooltip" title="" data-original-title="">
                                                    <a type="button" class="" data-bs-toggle="modal" data-bs-target="#add_bank">
                          Update
                        </a>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                <div class="row panel-body form-horizontal">
                                    <!--form popup-->
                                    
                                    <div class="modal" id="add_bank" aria-modal="true" role="dialog"><div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                                          
                                              <!-- Modal Header -->
                                              <div class="modal-header">
                                                <h4 class="modal-title">New Bank</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                              </div>
                                              
                                              <!-- Modal body -->
                                              
                                              <div class="modal-body">
                                               <div class="container">
                                                 <form action="#" id="" method="post" enctype="multipart/form-data">
                                                  <input type="hidden" name="_token" value="2t1CBz7nEwAyZUE6Zar7r6lHJ6zod9GELjNuuebv">                      
                                                    <div class="form-group shipment-more search_input">
                            							<label>Bank Name</label>
                            							<input type="text" class="form-control" name="bank_name">
                            						</div>
                            						<div class="form-group shipment-more search_input">
                            							<label>Routing Number</label>
                            							<input type="text" class="form-control" name="routing_no">
                            						</div>
                            						<div class="form-group shipment-more search_input">
                            							<label>Name of Account</label>
                            							<input type="text" class="form-control" name="acc_name">
                            						</div>
                            						<div class="form-group shipment-more search_input">
                            							<label>Account Number</label>
                            							<input type="text" class="form-control" name="acc_no">
                            						</div>
                                                      <div class="card-footer">
                                                        <input type="hidden" value="XS01eyMz" name="dat_id">
                                                          <button type="submit" class="btn btn-primary" id="load_post_btn">Save</button>
                                                          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                      </div>
                                                 </form>
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!--end popup-->
                                    
                                    <div class="table-responsive">
            							<table class="table align-middle mb-0">
            								<thead class="table-light">
            									<tr>
            										<th>Bank</th>
            										<th>Name of Account</th>
            										<th>Routing Number</th>
            										<th>Account Number</th>
            										<th>Action</th>
            									</tr>
            								</thead>
            								<tbody>
            									<tr>
            										
            									</tr>
            								</tbody>
            							</table>
            						</div>
                                </div>
                              </div>
                              <div class="tab-pane container fade" id="menu2">...</div>
                            </div>
                        </div>
                    </div>
			        
			    </div>
			</div>
		</div>
	</div>



    
<!-- Agency form modal start -->
<div class="modal" id="agency_detail_edit">
</div>
<!-- Agency form modal end -->


    

    <script>
        
        /* Agency details form funcation Start here*/
        $(document).on('click','.uprofile_detail_form', function(){
            
            var userprofileid = $(this).val();
            
            //ShowLoaderTimeLine();
            
                $.ajax({
                    url: HOSTPATH+'admin/userprofiledata',
                    type: 'get',
                    cache : false,
                    data: {userprofileid:userprofileid},
                    success: function(data){
                        
                        $('#agency_detail_edit').html(data);
                        
                        setTimeout(function () {
                                //Swal.close();
                                $('#agency_detail_edit').modal('show');
                        }, 500);
                        
                    }
                    
                });
            
        });
        /* Agency details form funcation End here*/
    </script>





@include('backend.common.footer')
@endsection