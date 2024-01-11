@extends('backend.layouts.master')
@section('title','Carrier Management')
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
			
			<ul class="nav nav-tabs">
			@can('carrier-all')
			<li class="pending_approval"><a href="{{url('/admin/carrier/list')}}" data-toggle="tab" aria-expanded="true">All Carrier</a>
			</li>
			@endcan
                <li class="pending_approval "><a href="{{url('/admin/carrier')}}" data-toggle="tab" aria-expanded="true">Carrier</a>
                </li>

                <li class="all_leave"><a href="{{url('/admin/new/carrier/detail')}}" data-toggle="tab" aria-expanded="false">Create Carrier</a>
                    </li>
				<li class=""><a href="{{url('/admin/carrier/myCarrierPacket')}}" data-toggle="tab" aria-expanded="false">MyCarrierPacket</a>
            	</li>
                    <li class="active"><a href="{{url('/admin/carrier/requests')}}" data-toggle="tab" aria-expanded="false">Carrier Requests</a>
                </li>
            </ul>
			<div class="card">
				<div class="card-body">
				    
					<table class="table" id="carrier_table">
					<thead class="table-light">
					  <tr>
						 <th>No</th>
						 <th>MC Number</th>
						 <th>DOT Number</th>
						 <th>Carrier Name</th>
						 <th>Address</th>
						 <th>Broker</th>
						 <th>Timer</th>
						 <th>Status</th>
						 <th width="100px">Action</th>
					  </tr>
						</thead>
						@php
							$i = 0;
						@endphp
						@if(count($carriers_data) > 0)
						@foreach ($carriers_data as $key => $carriers_result)
							<tr>
								<td> {{ ++$i }} </td>
								<td>{{ $carriers_result->mc_no }}</td>
								<td>{{ $carriers_result->dot_no }}</td>
								<td>{{ $carriers_result->c_company_name }}</td>
								<td style="width:300px;">{{ $carriers_result->carrier_city }}</td>
								<td>
									@php
									$user_data = \App\Models\User::where('id',$carriers_result->user_id)->first();
									@endphp
									
									
									 {{ isset($user_data->name) ? $user_data->name :Null }}
								</td>

										@php
                                        	// $user_data = App\Models\User::where('id',$companies_res->user_id)->first();
                                        $datad = $carriers_result->carrier_requestdate;
                                        @endphp

								<script>

									// Set the date we're counting down to

									// 62d 21h 41m 35s

									var countDownDate_{{$i}} = new Date("<?php echo $datad; ?>").getTime();

									// var countDownDate = new Date("Jan 5, 2023 15:37:25").getTime();

									

									// Update the count down every 1 second

									var x_{{$i}} = setInterval(function() {

									

									// Get today's date and time

									var now_{{$i}} = new Date().getTime();

									

									var currentdate_{{$i}} = new Date(); 

										var datetime_{{$i}} = currentdate_{{$i}}.getFullYear() + "-"

													+ (currentdate_{{$i}}.getMonth()+1)  + "-" 

													+ currentdate_{{$i}}.getDate() + " "  

													+ currentdate_{{$i}}.getHours() + ":"  

													+ currentdate_{{$i}}.getMinutes() + ":" 

													+ currentdate_{{$i}}.getSeconds();



									//document.write(datetime);

										

									// Find the distance between now and the count down date

									var distance_{{$i}} =  currentdate_{{$i}} - countDownDate_{{$i}}   ;

									

									// Find the distance between now and the count down date

									// var distance_{{$i}} = now_{{$i}} - countDownDate_{{$i}} ;

										

									// Time calculations for days, hours, minutes and seconds

									var days_{{$i}} = Math.floor(distance_{{$i}} / (1000 * 60 * 60 * 24));

									var hours_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

									var minutes_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60 * 60)) / (1000 * 60));

									var seconds_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60)) / 1000);

										

									// Output the result in an element with id="demo"

									document.getElementById("demo_{{$i}}").innerHTML = "<span>"+days_{{$i}} + "d </span>" + "<span>"+hours_{{$i}} + "h </span>"

									+ "<span>"+minutes_{{$i}} + "m </span>" + "<span>"+seconds_{{$i}} + "s </span>";

										

									// If the count down is over, write some text 

									if (distance_{{$i}} < 0) {

										clearInterval(x);

										document.getElementById("demo_{{$i}}").innerHTML = "EXPIRED";

									}

									}, 1000);

									</script>

									
									@if($carriers_result->carrier_requestdate == '')
									<td> 00:00 </td>
									@else
									<td id="demo_{{$i}}" class="req_date">{{ isset($carriers_result->carrier_requestdate) ? $carriers_result->carrier_requestdate : Null}}</td>

									@endif

								<td>
									
									@if($carriers_result->status == '0')
										{{'Pending'}}
									@else($carriers_result->status == '1')
										{{'Approve'}}
									@endif

								</td>

                               
                                
								<td class="action_tooltip">
									<input type="hidden" id="carrier_id" value="{{ base64_encode($carriers_result->id) }}">
									<!--<button type="button" id="CarrierRequestBtn" class="btn btn-outline-info btn-sm radius-30 px-4" > <i class="bx bx-show"></i> </button>-->
									
									<a href="{{url('/admin/carrier/request/edit'.'/'.base64_encode($carriers_result->id))}}" class="btn btn-outline-info btn-sm radius-30 px-4" > <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></button>
									
								</td> 
							</tr>
						@endforeach
                            @else
                                <tr style="background-color: #edf3f652;">
                                    <td colspan="8">
                                        <div class="row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4 not-found">
                                                <img src="{{url('/public/backend/assets/images/message.png')}}">
                                                <h4> No Carrier Requests, yet.</h4>
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

<!-- New carrier request form Modal start -->
<div class="modal" id="CarrierRequestForm">
</div>
<!-- New carrier request form Modal End -->


{{-- for status checking start here --}}
    <!-- <script>
		$(function() {
		  $(document).on('change','.stat_check', function() {
			  var curr    = $(this).prop('checked');
			  var cat     = $(this).attr('cat');
			  $.ajax({
				  type:"post",
				  url:"{{ url('admin/carrier/StatusUpdate') }}",
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
    </script>     -->


@include('backend.common.footer')
@endsection
