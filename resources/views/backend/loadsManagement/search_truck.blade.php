@extends('backend.layouts.master')
@section('title','Loads Management')
@section('content')

	<!--start page wrapper -->
    <div class="page-wrapper">
		<div class="page-content">
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
            <ul class="nav nav-tabs">
                <li class="pending_approval"><a href="{{url('/admin/loads')}}" data-toggle="tab" aria-expanded="true">All Loads</a>
                </li>
                
                <li class="pending_approval active"><a href="{{url('/admin/load/search_truck')}}" data-toggle="tab" aria-expanded="true">Search Truck </a>
                </li>
            </ul>
            <div class="card">
				<div class="card-body table-responsive">
                    
						<form action="{{ url('admin/load/TruckSearchDAT') }}" method="post" id="TruckSearchForm">
						<div class="row search">

							<div class="col-md-2">
								<div class="form-group shipment-more">
										<label>Referance No.<span class="text text-danger required">*</span></label>
										<input type="number" class="form-control" id="referance">

								</div>
							</div>
                                <div class="col-md-2">
            						<div class="form-group shipment-more">
                                            <label>Equipment <span class="text text-danger required">*</span></label>
										    <span class="error" id="equipmentcheck" ></span>
            							  <select class="form-control" name="equipment_type" id="equipment_type" style="width: 100%;">
										 
											<option value="">Select Carrier</option>
											@foreach($equipments as $equipment)
											<option value="{{ $equipment->equip_type }}">{{ $equipment->equip_name }}</option>
											@endforeach
										</select>
            						</div>
            					</div>
                                <div class="col-md-2">
            						<div class="form-group search_input_truck">
            							<label>Origin <span class="text text-danger required">*</span></label>
            							  <input style="margin-top: 3px;" type="text" class="form-control" id="lane_origin_trcuk_input" name="lane_origin_truck" for="lane_origin_truck">
                                          <ul class="drop_ul lane_origin_dropdown" id="lane_origin_truck" style="width: 100%;">
										</ul>
                                        <input type="hidden" name="truck_lane_origin_id" value="" id="truck_lane_origin_id">
            						</div>
            					</div>
                                <div class="col-md-2">
            						<div class="form-group search_input_truck">
            							<label>Destination <span class="text text-danger required">*</span></label>
            							  <input style="margin-top: 3px;" type="text" class="form-control" id="lane_drop_trcuk_input" name="lane_drop_truck" for="lane_drop_truck">
                                          <ul class="drop_ul lane_drop_dropdown" id="lane_drop_truck" style="width: 100%;">
										</ul>
                                        <input type="hidden" name="truck_lane_drop_id" value="" id="truck_lane_drop_id">
            						</div>  
            					</div>
                                <div class="col-md-2">
            						<div class="form-group shipment-more">
            							<label>Avil <span class="text text-danger required">*</span></label>
            							  <input type="date" class="form-control hasDatepicker" name="availability" id="datedata">
            						</div>
            					</div>
                                <div class="col-md-2">
            						<div class="form-group shipment-more">
            							<label>DH-O <span class="text text-danger required">*</span></label>
            							  <input type="number" class="form-control" name="maxOriginDead" id="dho">
            						</div>
            					</div>
                                <div class="col-md-2">
            						<div class="form-group shipment-more">
            							<label>DH-D <span class="text text-danger required">*</span></label>
            							  <input type="number" class="form-control" name="maxDestinationDead" id="dhd">
            						</div>
            					</div>
                                <div class="col-md-2">
            						<div class="form-group shipment-more">
            							<label>F/P</label>
                                        <select class="form-control select2" name="full_partial" id="full_partial" style="width: 100%;">
            								<option value="FULL">FULL</option>
            								<option value="PARTIAL">PARTIAL</option>
            							</select>
            						</div>
            					</div>
                                <div class="col-md-2">
            						<div class="form-group shipment-more">
            							<label>Length <span class="text text-danger required">*</span></label>
            							  <input type="number" class="form-control" name="length" id="lane_length">
            						</div>
            					</div>
                                <div class="col-md-2">
            						<div class="form-group shipment-more">
            							<label>Weight <span class="text text-danger required">*</span></label>
            							  <input type="number" class="form-control" name="weight" id="weight">
            						</div>
            					</div>
                                <div class="col-md-2">
            						<div class="form-group shipment-more">
            							<label>Search Back <span class="text text-danger required">*</span></label>
            							  <input type="number" class="form-control" name="maxAgeMinutes" id="searchback">
            						</div>
            					</div>
                                <div class="col-md-12">
            						<div class="form-group shipment-more search-btn">
            							  <input type="submit" class="btn btn-primary" value="Save">
            						</div>
            					</div>

							</div>
						</form>
				<div class="card">
				<div class="card-body table-responsive">	
					<table class="table mb-0" id="carrier_table" style="table-layout:fixed">
    					<thead class="table-light">
    					  <tr>
    						 <th>#</th>
    						 <th>Origin</th>
    						 <th>Destination</th>
    						 <th>Avail</th>
    						 <th>DH-O</th>
    						 <th>DH-D</th>
    						 <th>F/P</th>
    						 <th>Length</th>
    						 <th>Weight</th>
    						 <th>Search Back</th>
    						 <th width="154px">Action</th>
    					  </tr>
    					</thead>
						
						
						@php $i=1;
						@endphp
							@foreach($truck_searchs as $truck_search)
						<tr class="odd" value="{{ $truck_search->queryId }}" open-id="openfirst_{{ $i++ }}">
							
							<td>{{ $i++ }}</td>
							<td>{{ $truck_search->origin_city }}</td>
							<td>{{ $truck_search->destination_city }}</td>
							<td>{{ $truck_search->post_date }}</td>
							<td>{{ $truck_search->max_origin }}</td>
							<td>{{ $truck_search->max_destination }}</td>
							<td>{{ $truck_search->full_partial }}</td>
							<td>{{ $truck_search->length }}</td>
							<td>{{ $truck_search->weight }}</td>
							<td>{{ $truck_search->max_age }}</td>
							<td class="truck_action">
								<button type="button" class="btn btn-primary GetTruckResult" value="{{ $truck_search->queryId }}" > Find </button>	
								<button type="button" class="btn btn-danger" id="TruckSearchDelete" value="{{ $truck_search->queryId }}" >Delete</button>
							</td>
						</tr>
						<tr id="{{ $truck_search->queryId }}" class="hide-row ShowTruckResult" data-matchextend="matchextend">
						    
						</tr>
						
						
						@endforeach
					</table>
				</div>
				</div>
                    
                </div>
			</div>


        </div>
    </div>
<!--end page wrapper -->
<script>
        $(document).ready(function(){
			
            $('.search_input_truck input').keyup(function(){
                var d = $('#'+$(this).attr('for')).show();

                var value = $(this).val().toLowerCase();
                $('#'+$(this).attr('for')+' li').filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            })
            
            $("ul#lane_drop_truck li").click(function(){
                $('input[name="lane_drop_name"]').val($(this).text());
                $("ul#lane_drop_truck").hide();
            })
            
            $("ul#lane_origin_truck li").click(function(){
                $('input[name="lane_origin_name"]').val($(this).text());
                $("ul#lane_origin_truck").hide();
            })
            
            $("#carrier_table tr").click(function(){
                $("#"+$(this).attr('value')).slideToggle();
            })

			

			//for search advance with referance no.

			$('#referance').on('keyup',function(e){
					e.preventDefault();

					let referance = $(this).val();
				
					$.ajax({
					url: "{{url('admin/search/truck/referance')}}",
					type:"POST",
					data:{
						"_token": "{{ csrf_token() }}",
						referance:referance,
					},
					success:function(data){
						//alert(response.length_load);
						// $('#lane_drop_trcuk_input').val(data.lane_drop_truck);
						// 	$('#full_partial').val(data.full_partial);
						// 	$('#lane_length').val(data.length_load);
						
						
						var fullDate = new Date();
                        var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
                        // var currentDate = fullDate.getDate() + "/" + twoDigitMonth + "/" + fullDate.getFullYear();
                        var currentDate = twoDigitMonth + "/" +fullDate.getDate() + "/" + fullDate.getFullYear();
                        // alert(currentDate);

						$.each(data, function(index, element) {
						    
						    $('#dhd').val('70');
						    $('#dho').val('70');
							$('#searchback').val('6');
							$('#datedata').val(currentDate);
							$('#lane_length').val(element.length_load);
				// 			$('input#lane_origin_trcuk_input').val(element.load_state_origin);
							$('input#weight').val(element.weight_load);
				// 			$('input#lane_drop_trcuk_input').val(element.load_city_desti);
							$('select#full_partial option[value='+element.full_partial_tl_ltl+']').prop('selected', true);
							$('select#equipment_type option[value='+element.equipments+']').prop('selected', true)
						});
					}

					});
					});

        })

</script>

@include('backend.common.footer')
@endsection
