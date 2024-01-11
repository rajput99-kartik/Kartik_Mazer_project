@extends('backend.layouts.master')
@section('title','Loads Management')
@section('content')
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
        
</style>
	<!--start page wrapper -->
    <div class="page-wrapper">
		<div class="page-content">
			<ul class="nav nav-tabs">
                <li class=""><a href="{{url('/admin/loads')}}" data-toggle="tab" aria-expanded="true">All Loads </a>
                </li>
                
                <li class="pending_approval"><a href="{{url('/admin/load/search_truck')}}" data-toggle="tab" aria-expanded="true">Search Truck </a>
                </li>
				@can('loads-create')
                <!--<li class="all_leave"><a data-bs-toggle="modal" data-bs-target="#TodayLanesLoads" data-toggle="tab" href="#" aria-expanded="false">Create New Loads</a>-->
                <!--    </li>-->
				@endcan
				<li class="active"><a href="{{url('/admin/old/loads')}}" data-toggle="tab" aria-expanded="true">Old Loads</a>
                </li>
            </ul>
			
			<!--create loads model-->
			<div class="modal" id="TodayLanesLoads" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-lg">
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
            							  <input type="number" class="form-control" name="lengthFeet">
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
            							<label>Contact Methode <span class="text text-danger required">*</span></label>
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
            					<div class="col-md-6">
									@php
									$user_id = auth()->user()->id;
									$user = \App\Models\User::where([ ['id', '=', $user_id], ])->first();
									@endphp
            						<div class="form-group shipment-more">
            							<label>Comment1 <span class="text text-danger required">*</span></label>
            							 <input type="text" style="height: 60px;" class="form-control" name="comment1" placeholder="Enter ..." value="{{$user['email']}}, Call {{$user['name']}} {{$user['phone']}}">
            						</div>
            					</div>
								
            				</div>
            				<div class="card-footer">
            					<button type="submit" class="btn btn-primary" id="load_post_btn">Save</button>
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
					<table class="table mb-0" id="carrier_table">
    					<thead class="table-light">
    					  <tr>
    						 <th>#</th>
    						 <th>Age</th>
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
    						 <th>Date</th>
    						 <th>Action</th>
    					  </tr>
    					</thead>
						
						@php $i=1;
						@endphp
						
						    @if(count($user_loads) > 0)
								@foreach($user_loads as $user_load)
									@php
									$createdby = App\Models\User::where('id',$user_load->user_id)->first();
									@endphp
								
									<tr class="odd">
										<td>{{ $i++ }}</td>
										<td><input type="checkbox"></td>
										<td>{{ $user_load->ref_no }}</td>
										<td>{{ $user_load->post_date }}</td>
										<td>{{ $user_load->load_state_origin }}</td>
										<td>{{ $user_load->load_city_desti }}</td>
										<td>{{ $user_load->equipments }}</td>
										<td>{{ $user_load->full_partial_tl_ltl }}</td>
										<td>{{ $user_load->length_load }}</td>
										<td>{{ $user_load->weight_load }}</td>
										<td>
											<!--div class="price-range-slider">
			
											<p class="range-value">
												<input type="text" id="amount" readonly>
											</p>
											<div id="slider-range" class="range-bar"></div>
											
											</div -->
											{{ $user_load->load_offer_rate }}
										</td>
										<td>{{ $createdby->name }}</td>
										<td>{{  date('d M, Y', strtotime($user_load->created_at)) }}</td>
										<td style="width: 50px;" class="action_tooltip" id="load_action">
											<input type="hidden" value="{{ $user_load->load_dat_id }}" id="load_dat_id">
											<a href="{{url('admin/ratehistory').'/'.$user_load->id}}" type="button" class="btn btn-outline-info btn-sm radius-30 px-4" ><i class="lni lni-eye"></i><span class="tooltip">RateView</span></a> 
											<button type="button" class="btn btn-outline-info btn-sm radius-30 px-4" id="load_repost_btn"><i class="fadeIn animated bx bx-refresh"></i><span class="tooltip">Re-post</span></button>
											|
											@can('convert-shipment')
												<form method="POST" action="{{url('/admin/load/NewShipmentCreate')}}" accept-charset="UTF-8" style="display:inline">
												<input type="hidden" value="{{ $user_load->load_dat_id }}" name="load_id">
												<input type="hidden" value="{{ $user_load->id }}" name="new_load_id">
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
<!--end page wrapper -->
<script>
    $(document).ready(function() {
    $('#carrier_table').DataTable( {
        dom: 'Bfrtip',
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
