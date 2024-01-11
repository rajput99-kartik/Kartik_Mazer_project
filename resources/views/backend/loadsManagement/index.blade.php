@extends('backend.layouts.master')
@section('title','Loads Management')
@section('content')

<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .price-range-slider {
	width:100%;
  float:left;
    }
	.range-value {
		margin:0;
	}
		input#amount {
			width:100%;
			background:none;
			color: #000;
			font-size: 16px;
			font-weight: initial;
			box-shadow: none;
			border: none;
			margin: 0px 0 10px 0;
		
	}
	
	.range-bar {
		border: none;
		background: #c1292e;
		height: 2px;	
		width: 96%;
		margin-left: 8px;
	}
		
		.ui-slider-range {
			background:#06b9c0;
		}
		
		.ui-slider-handle {
			border:none;
			border-radius:25px;
			background:#fff;
			border:2px solid #06b9c0;
			height:17px;
			width:17px;
			top: -0.52em;
			cursor:pointer;
		}
		.ui-slider-handle + span {
			background:#06b9c0;
		}
		.ui-slider .ui-slider-handle {
            width: 12px;
            height: 12px;
        }
        
        
        div#rateview3 {
            margin: 0px 9px 0px 11px;
        }
        
        div#rateview3 p {
            margin-bottom: 2px;
        }
        
        div#rateview3 {
            border: 1px solid gray;
            margin: 0px;
            padding: 6px 15px;
            font-size: 11px;
            /*position: absolute;*/
            /*width: 89%;*/
            height: 133px;
            overflow: auto;
            display:none;
        }
        

		#alchk {
			display: none;
		}
</style>
	<!--start page wrapper -->
    <div class="page-wrapper">
		<div class="page-content">
			<ul class="nav nav-tabs">
                <li class="pending_approval active"><a href="{{url('/admin/loads')}}" data-toggle="tab" aria-expanded="true">All Loads </a>
                </li>
                
                <li class="pending_approval"><a href="{{url('/admin/load/search_truck')}}" data-toggle="tab" aria-expanded="true">Search Truck </a>
                </li>

				@can('loads-create')
                <li class="all_leave"><a data-bs-toggle="modal" data-bs-target="#TodayLanesLoads" data-toggle="tab" href="#" aria-expanded="false">Create New Loads</a>
                </li>
				@endcan	

				
                {{-- <li class="all_leave"><a data-bs-toggle="modal" data-bs-target="#TodayLanesLoads" data-toggle="tab" href="#" aria-expanded="false">Loads Rate Details</a>
                    </li> --}}
			

            </ul>
			
			<!--create loads model-->
			<div class="modal" id="TodayLanesLoads" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <img src="{{BACKEND_COMMON_PATH.'/images/1.jpg'}}" alt="logo icon">
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-header" style="justify-content: center;padding: 10px;">
                      <h4 class="modal-title">New Lanes</h4>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body"> 
            		 <div class="container">
                       <form action="<?php echo url('/'); ?>/admin/broker/new-lanes-post" id="new_lanes_post" method="post" enctype="multipart/form-data">
						@csrf
						<div class="row">
            					<div class="col-md-6">
            						<div class="form-group shipment-more search_input">
            							<label>Origin <span class="text text-danger required">*</span></label>
            							<input type="text" class="form-control" name="lane_origin" id="lane_origin_input" for="lane_origin">
            							<span class="error" id="origincheck" ></span>
										<ul class="drop_ul lane_origin_dropdown" id="lane_origin" style="width: 100%;">
										</ul>
										<input type="hidden" name="lane_origin_id" value="" id="origin_place_value">
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more search_input">
            							<label>Drop <span class="text text-danger required">*</span></label>
            							<input type="text" class="form-control" name="lane_drop" id="lane_drop_input" for="lane_drop">
										<span class="error" id="dropcheck" ></span>
            							<ul class="drop_ul lane_origin_dropdown" id="lane_drop" style="width: 100%;">
											@foreach($equipments as $equipment)
											<li value="{{ $equipment->equip_type }}">{{ $equipment->equip_name }}</li>
											@endforeach
										</ul>
										<input type="hidden" name="lane_drop_id" value="" id="drop_place_value">
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more"> 
            							<label>Equipment</label>
										<span class="error" id="equipmentcheck" ></span>
            							  <select class="form-control" name="equipment_type" id="equipment_type" style="width: 100%;">
										 
											<option value="">Select Carrier</option>
											@foreach($equipments as $equipment)
											<option value="{{ $equipment->equip_type }}">{{ $equipment->equip_name }}</option>
											@endforeach
										</select>

										{{-- @foreach($equipments as $equipment)

											<option value="">{{ $equipment->equip_type }}  == {{ strtoupper($equipment->equip_name) }}</option>

										@endforeach --}}
            						</div>
            					</div>
            					
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Full/Partial</label>
            							 <select class="form-control select2" name="full_partial" id="full_partial" style="width: 100%;">
            								<option value="FULL">FULL</option>
            								<option value="PARTIAL">PARTIAL</option>
            							</select>
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Length <span class="text text-danger required">*</span></label>
            							  <input type="number" class="form-control" name="lengthFeet" maxlength="2">
            						</div>
            					</div>
            					
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Weight <span class="text text-danger required">*</span></label>
            							  <input type="number" class="form-control" name="weightPounds">
            						</div>
            					</div>
								<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Contact Method <span class="text text-danger required">*</span></label>
            							 <select class="form-control select2" name="primary_contact" id="primary_contact" style="width: 100%;">
            								<option value="EMAIL">EMAIL</option>
            								<option value="PRIMARY_PHONE">PHONE</option>
            							</select>
            						</div>
            					</div>
            					
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Pick Date <span class="text text-danger required">*</span></label>
            							  <input type="date" class="form-control hasDatepicker" name="pick_date" id="lane_pick_date" value="">
            						</div>
            					</div>
            					
            							  
            						
								<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Offer Rate <span class="text text-danger"></span></label>
            							  <input type="number" class="form-control" name="offer_rate">
            						</div>
            					</div>
								<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Commodity <span class="text text-danger required">*</span></label>
            							  <input type="text" class="form-control" name="commodity">
            						</div>
            					</div>
            					<div class="col-md-12">
									@php
									$user_id = auth()->user()->id;
									$user = \App\Models\User::where([ ['id', '=', $user_id], ])->first();
									@endphp
            						<div class="form-group shipment-more">
            							<label>Comment1 <span class="text text-danger required">*</span></label>
            							 <input type="text" style="height: 60px;" class="form-control" name="comment1" placeholder="Enter ..." value="{{ $user['email'] }}  CONTACT EMAIL" readonly>
            							 <!--,{{ $user['phone'] }}-->
            						</div>
            					</div>
								
								<div class="col-md-12">
            					    <div id="rateview3">
            					        <div class="row">
                					        <div class="col-md-6">
                					            <strong style="color:red; font-size:14px; border-bottom:1px solid gray;">Contract</strong>
                					            <p id="reports"></p>
                					            <p id="companies"></p>
                					            <p id="cont_price" style="color:green"></p>
                					            <p id="avg_price" style="color:blue"></p>
                					            <p id="cont_mileage"></p>
                					            <p class="market_type_origin"></p>
                					            <p class="market_type_drop"></p>
                					        </div>
                					        <div class="col-md-6">
                					        <strong style="color:red; font-size:14px; border-bottom:1px solid gray;">Spot</strong>
                					            <p id="spot_reports"></p>
                					            <p id="spot_companies"></p>
                					            <p id="spot_price" style="color:green"></p>
                					            <p id="spot_avg_price" style="color:blue"></p>
                					            <p id="spot_mileage"></p>
                					       </div>
                					           
                					    </div>
            					    </div>
            					    <!--<input type="text" id="cont_price">-->
            					    <!--<input type="text" id="spot_price">-->
            					</div>
            					@csrf
								
            				</div>
            					
            				<div class="card-footer">
            					<button type="submit" class="btn btn-primary" id="load_post_btn">Save</button>
            					<button type="button" class="btn btn-primary" id="LoadPostRateBtn">Rate View</button>
            					<button type="button" id="LoadPostRateBtn" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            				</div>
            		   </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

			<!--end breadcrumb-->
			@if ($message = Session::get('success'))
			<div class="alert alert-success">
			    <p>{{ $message }}</p>
			</div>
			@endif
			@if ($message = Session::get('error'))
			<div class="alert alert-danger">
			    <p>{{ $message }}</p>
			</div>
			@endif
			
			<div class="card">
				<div class="card-body table-responsive loads">	
					<div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5">
						<!-- <table class="table mb-0" id="carrier_table"> -->
						{{-- <button class="btn btn-primary btn-xs removeAll mb-3">Remove All Data</button> --}}
						<form method="post" action="{{url('admin/load/loadpost-multipal-delete')}}">
						{{ csrf_field() }}
							<input class="btn btn-primary btn-xs mb-3"  type="submit" id="alchk" name="submit" value="Remove All Data"/>
						</form>
						<table id="example2" class="table table-striped table-bordered dataTable" role="grid" aria-describedby="example2_info">	
							<thead class="table-light">
								<tr>
									{{-- <th>#</th> --}}
									{{-- <th><input type="checkbox" id="checkboxesMain"></th> --}}
									<th><input type="checkbox" id="checkAll"></th>
									<th>Referenc</th>
									<th>Pick Date</th>
									<th>Origin</th>
									<th>Drop</th>
									<th>Truck</th>
									<th>Load Type</th>
									<th>Length</th>
									<th>Weight</th>
									<th>Price Range</th>
									<th>Added By</th>
									<th>Refresh-Timer</th>
									<th width="154px">Action</th>
								</tr>
							</thead>.
							@php $j=0;
							@endphp

						    @if(count($user_loads) > 0)
								@foreach($user_loads as $user_load)
									@php
									$createdby = App\Models\User::where('id',$user_load->user_id)->first();
									@endphp
									<tr class="odd" id="tr_{{$user_load->load_dat_id}}">
										{{-- <td>{{ ++$j }}</td> --}}
										   
										<td><input name='datId[]' type="checkbox" id="checkItem" 
											value="<?php echo $user_load->load_dat_id; ?>"></td>
											
											
										{{-- <td><input type="checkbox" class="checkbox" name="datId[]" value="{{$user_load->load_dat_id}}"></td> --}}
										{{-- <td><input type="checkbox" class="checkbox" datId="{{$user_load->load_dat_id}}"></td> --}}
										<td class="copy-text">{{ $user_load->ref_no }}</td>
										<td class="copy-text">{{ $user_load->post_date }}</td>
										<td class="copy-text">{{ $user_load->load_state_origin }}</td>
										<td class="copy-text">{{ $user_load->load_city_desti }}</t d>
										<td class="copy-text">{{ $user_load->equipments }}</td>
										<td class="copy-text">{{ $user_load->full_partial_tl_ltl }}</td>
										<td>{{ $user_load->length_load }}</td>
										<td>{{ $user_load->weight_load }}</td>
										<td>
											{{ $user_load->load_offer_rate }}
										</td>
										<td>{{ $createdby->name }}</td>
											<?php ++$j; ?>
											<script>
												// Set the date we're counting down to
												// 62d 21h 41m 35s
												var countDownDate_{{ $j }} = new Date("<?php echo $user_load->timerreferesh; ?>").getTime();
												// var countDownDate = new Date("Jan 5, 2023 15:37:25").getTime();
												// Update the count down every 1 second
												var x_{{ $j }} = setInterval(function() {
													// Get today's date and time
													var now_{{ $j }} = new Date().getTime();
													//alert(now_{{ $j }});
													var currentdate_{{ $j }} = new Date();
													//alert(currentdate_{{ $j }});
													var datetime_{{ $j }} = currentdate_{{ $j }}.getFullYear() + "-" +
														(currentdate_{{ $j }}.getMonth() + 1) +
														"-" +
														currentdate_{{ $j }}.getDate() + " " +
														currentdate_{{ $j }}.getHours() + ":" +
														currentdate_{{ $j }}.getMinutes() + ":" +
														currentdate_{{ $j }}.getSeconds();

													// console.log(datetime_{{ $j }});
													//document.write(datetime);

													//alert(countDownDate_{{ $j }});
													// Find the distance between now and the count down date
													var distance_{{ $j }} = currentdate_{{ $j }} -
														countDownDate_{{ $j }};
													// Find the distance between now and the count down date
													var distance_{{ $j }} = now_{{ $j }} - countDownDate_{{ $j }} ;
													// Time calculations for days, hours, minutes and seconds
													var days_{{ $j }} = Math.floor(distance_{{ $j }} / (1000 * 60 * 60 * 24));
													var hours_{{ $j }} = Math.floor((distance_{{ $j }} % (1000 * 60 * 60 * 24)) / (
														1000 * 60 * 60));
													var minutes_{{ $j }} = Math.floor((distance_{{ $j }} % (1000 * 60 * 60)) / (
														1000 * 60));
													var seconds_{{ $j }} = Math.floor((distance_{{ $j }} % (1000 * 60)) / 1000);
													
													// Output the result in an element with id="demo"
													document.getElementById("timerinfo_{{ $j }}").innerHTML = "<span>" + hours_{{ $j }} + "h </span>" + "<span>" + minutes_{{ $j }} + "m </span>" + "<span>" + seconds_{{ $j }} +	"s </span>";

													// If the count down is over, write some text 
													if (distance_{{ $j }} < 0) {
														clearInterval(x);
														document.getElementById("timerinfo_{{ $j }}").innerHTML = "EXPIRED";
													}
												}, 1000);

												
												window.onload = function () {
													whatis();
													}
											</script>
										
										@if(!empty($user_load->timerreferesh ))
											<td id="timerinfo_{{ $j }}" class="req_date">
												{{ isset($user_load->timerreferesh) ? $user_load->timerreferesh : null }}
											</td>								
										@else
										<td>{{'00:00'}}</td>
										@endif
										<td style="width: 180px;" class="action_tooltip" id="load_action">
											<input type="hidden" value="{{ $user_load->load_dat_id }}" id="load_dat_id">
											<a href="{{url('admin/ratehistory').'/'.$user_load->id}}" type="button" class="btn btn-outline-info btn-sm radius-30 px-4" ><i class="lni lni-dollar"></i><span class="tooltip">RateView</span></a>
											<button type="button" class="btn btn-outline-info btn-sm radius-30 px-4" id="load_refresh_btn"><i class="fadeIn animated bx bx-refresh"></i><span class="tooltip">Refresh</span></button>
											<button type="button" class="btn btn-outline-secondary btn-sm radius-30 px-4" id="load_update_form_btn"><i class="bx bx-edit"></i><span class="tooltip">Edit</span></button>
											
											<button type="button" class="btn btn-outline-danger btn-sm radius-30 px-4" id="load_delete_btn" ><i class="bx bx-trash"></i><span class="tooltip">Delete</span></button>

											@can('convert-shipment')
												<form method="POST" action="{{url('/admin/load/NewShipmentCreate')}}" accept-charset="UTF-8" style="display:inline">
												<input type="hidden" value="{{ $user_load->load_dat_id }}" name="load_id">
												<button type="submit" id="NewShipmentCreate" class="btn btn-outline-success btn-sm radius-30 px-4" id="load_delete_btn" ><i class="bx bx-car"></i><span class="tooltip">Shipment</span></button>
												</form>
											@endcan                                
										</td> 
									</tr>
								@endforeach
							@else
                                <tr style="background-color: #edf3f652;">
                                    <td colspan="13">
                                        <div class="row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4 not-found">
                                                <img src="{{url('/public/backend/assets/images/message.png')}}">
                                                <h4>You have no any Loads, yet.</h4>
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

		</div>
	</div>
	
	<!--loads edit model start-->
	<div class="modal" id="LoadUpdateForm">
	</div>
	<!--loads edit model end-->
	
	<script>
        $(document).ready(function(){
            $('.search_input input').keyup(function(){
                $('#'+$(this).attr('for')).show();
                var value = $(this).val().toLowerCase();
                $('#'+$(this).attr('for')+' li').filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            })
            
            $("ul#lane_drop li").click(function(){
                $('input[name="lane_drop"]').val($(this).text());
                $("ul#lane_drop").hide();
            })
            
            $("ul#lane_origin li").click(function(){
                $('input[name="lane_origin"]').val($(this).text());
                $("ul#lane_origin").hide();
            })
            
            //-----JS for Price Range slider-----

		$(function() {
			$( "#slider-range" ).slider({
			range: true,
			min: 130,
			max: 500,
			values: [ 130, 250 ],
			slide: function( event, ui ) {
				$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
			}
			});
			$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
			" - $" + $( "#slider-range" ).slider( "values", 1 ) );
		});
				})
    </script>


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script language="javascript">
			$("#checkAll").click(function () {
				$('input:submit').show();
				$('input:checkbox').not(this).prop('checked', this.checked);
			});

			$(function () {
				$("#checkAll").click(function () {
					if ($(this).is(":checked")) {
						// $("#alchk").show();
						$('input:submit').show();

					} else {
						// $("#alchk").hide();
						$('input:submit').hide();

					}
				});
			});

			$(function () {
				$("#checkItem").click(function () {
					if ($(this).is(":checked")) {
						// $("#alchk").show();
						$('input:submit').show();

					} else {
						// $("#alchk").hide();
						$('input:submit').hide();

					}
				});
			});

		</script>

		<script>
			$(function() {
				$(document).on('click','#NewShipmentCreateINfo', function() {
					// var curr    = $(this).prop('checked');
					// var cat     = $(this).attr('cat');

					var load_id = $('#load_id').val();
					var new_load_id = $('#new_load_id').val();

					$.ajax({
						type: "POST",
        				cache: false,
						url:"{{ url('admin/load/NewShipmentCreate') }}",
						data: {'load_id': load_id, 'new_load_id':new_load_id},
						// success:function(resp){
						// 	if(resp.status == 'true'){
						// 		swal(resp.msg,'','success');
						// 	} else{
						// 		swal(resp.msg,'','warning');
						// 	}
						// }
					})
				})
			})
		</script>

		<script>
			$(document).on('click','#NewShipmentCreateINfo2', function(){
					var load_id = $('#load_id').val();
					var new_load_id = $('#new_load_id').val();
					$.ajax({
						url: HOSTPATH+'admin/load/NewShipmentCreate',
						type: 'post',
						// cache : false,
						data: { load_id:load_id,new_load_id:new_load_id},
						success: function(data){

						}
					})
					
				});
		</script>

<!--end page wrapper -->

@include('backend.common.footer')
@endsection
