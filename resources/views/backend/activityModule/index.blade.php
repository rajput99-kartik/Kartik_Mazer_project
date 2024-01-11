@extends('backend.layouts.master')
@section('title','Activity Management')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
			    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                    <p>{{ $message }}</p>
                    </div>
                @endif
                
                 @if($message = Session::get('error'))
                <div class="alert alert-danger">
                    <h4>{{ $message }}</h4>
                </div>
                @endif

				<ul class="nav nav-tabs">
                    <li class="pending_approval"><a href="{{url('/admin/dashboard')}}" data-toggle="tab" aria-expanded="true">Dashboard</a>
                    </li>
                    <li class="pending_approval active"><a href="javascript:void(0)" data-toggle="tab" aria-expanded="true">All Activity</a>
                    </li>
                </ul>
				
				<!--end breadcrumb-->
				<div class="card">
				    <div class="row" id="search_row" style="margin-top:34px;  margin-left: 2px;">
    			        <div class="col-md-6">
    			            <form method="GET" action="">
    			                <div class="row">
                                    <div class="col-md-4">
    
                                    <?php 
                                        // $fromDate = '' ;
                                        // $toDate = '' ;
                                    ?>
                                        <!--<label>From Date:</label>-->
                                        <input type="date"  name="fromdate" class="form-control" placeholder="From Date" id="maindate_" value="{{$fromDate}}">
                                    </div>
                                    <div class="col-md-4">
                                        <!--<label>To Date:</label>-->
                                        <input type="date" name="todate" class="form-control" placeholder="To Date" id="maindate_" value="{{$toDate}}">
                                    </div>
                                    <div class="col-md-2">
                                        <button  type="submit" class="btn btn-primary" >Submit</button>
                                    </div>
                                </div>
                            </form>
    			        </div>
    			        
    			        <div class="col-md-4">
    			            <form method="GET" action="">
    			                <div class="row">    
                                    <div class="col-md-7 dsp"  style="display:inline-block; float:left;">
                                        <!--<label>From Date:</label>-->
                                        <input type="text" name="search" class="form-control" placeholder="search" value="{{$search}}">
                                    </div>
                                    <div class="col-md-2" style="float: left;display: block;margin-left: 20px;">
                                        <!--<label>To Date:</label>-->
                                        <!-- <input type="text" id="max" name="max" class="form-control" placeholder="To Date"> -->
                                        <input type="submit" class="btn btn-primary" value="Search">
                                    </div>
                                    
                                </div>
                            </form> 
                            
                                    
    			        </div>
    			        
    			        <div class="clearfm col-md-2">
                            <a href="{{url('admin/new-activity')}}">
                                <button  type="submit" class="btn btn-info">Reset</button>
                            </a> 
                        </div>
    			    </div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table mb-0" id="carrier_table44" >
								<thead class="table-light">
									<tr>
                                    <th>No.</th>
                                    <th style="width:200px">Done By</th>
                                    <th>Log Type</th>
                                    <th>Date</th>                                   
									<th style="width:134px;">Actions</th>
									</tr>
								</thead>
								<tbody>
                                    @php
                                         //dd($data);
                                        //$ddNaame = $activity->properties['attributes']['name'];
                                        // $activity->description .' of '. $ddNaame ;
                                        $i =0;
                                    @endphp

                                    @if(count($data) > 0)
                                @foreach ($data as  $key => $user)
								    <?php 
									    $encoded_id = base64_encode($user->id);
                                            $cuid = $user->subject_id;
                                            $uDataName = App\Models\User::where('id', $cuid)->first('name');
                                            $uDataName = isset($uDataName->name) ? $uDataName->name : Null ;
                                            $dataV = date('M d, Y - h:i A', strtotime($user->updated_at));
                                            $ldate = date('Y-m-d H:i:s');
                                          ?>
                                    <tr>
                                        <td> {{ ++$i ;}} </td>
                                        <td style="width:200px">{{ $user->description.' '. $uDataName }}</td>
                                        <td class="log_type"><span class="{{ $user->event }}">{{ $user->event }}</span></td>
                                        <td>{{  $dataV }}</td>
                                        <td class="action action_tooltip">
										<a href="{{url('admin/new-activity/'.$user->id )}}"> 
										    <button type="button" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">Details</span></button>
										</a>
											<form method="POST" action="{{url('/admin/delete-activity')}}" accept-charset="UTF-8" style="display:inline">
												@csrf
												<input name="activity_id" type="hidden" value="{{ $user->id }}">
												<button onclick="return confirm('Are You Sure Delete This Record..!')" class="btn btn-outline-danger btn-sm radius-30 px-4" type="submit"><i class="bx bx-trash"></i><span class="tooltip">Delete</span></button>
											</form>
										</td>
                                    </tr>
                                @endforeach

                                @else
                                <td colspan="5">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 not-found">
                                            <img src="{{url('/public/backend/assets/images/message.png')}}">
                                            <h4>No Any Activity, yet.</h4>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </td>
                                @endif
								</tbody>
							</table>
							
							<center class="mt-5">
                                
                                     {!! $data->withQueryString()->links('pagination::bootstrap-5') !!}
                                
                                
                                <!--{!! $data->appends(['sort' => 'activity'])->links('pagination::bootstrap-5') !!}-->
                            </center>
							<div class="row">
							    <div class="col-md-6"></div>
							    <div class="col-md-6" style="text-align: right;">
							        @php
							        $acti = DB::table('activity_log')->whereRaw('DATEDIFF(NOW(), created_at) >= 7')->get();
							        @endphp
							        @if(count($acti) > 0)
							        <p>
							            <form method="post" action="{{url('/admin/delete-activity-all')}}">
							                <span class="text text-primary"><span class="text text-success">{{count($acti)}} Activity older than 7 days, </span> Delete Activity older than 7 days<span>
							                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
							            </form>
							        </p>
							        @endif
							    </div>
							</div>
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