@extends('backend.layouts.master')
@section('title','Loads Management')
@section('content')
	<!--start page wrapper -->

    <div class="page-wrapper">
		<div class="page-content">
			<!--breadcrumb-->
			<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
				<div class="breadcrumb-title pe-3">Loads</div>
				<div class="ps-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 p-0">
							<li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Loads Management</li>
						</ol>
					</nav>
				</div>

				<div class="ms-auto">
					<div class="btn-group">
						<a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TodayLanesLoads">
                          Create New Loads
                        </a>
					</div>
				</div>
			</div>
			
			<!--create loads model-->
			<div class="modal" id="TodayLanesLoads" aria-modal="true" role="dialog">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <img src="https://crmonline.co.in/public/backend/assets/images/1.jpg" alt="logo icon">
                      <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-header" style="justify-content: center;padding: 10px;">
                      <h4 class="modal-title">New Lanes</h4>
                    </div>
                    
                    <!-- Modal body -->
            		
                    <div class="modal-body">
            		 <div class="container">
                       <form action="http://amblogistic.live/new/broker/new-lanes-post" id="new_lanes_post" method="post" enctype="multipart/form-data">
            			<input type="hidden" name="_token" value="o7pgyfcmMQQfrIEPe8GFRvqpCBhvPHFLD1SsMWBv">			
            			    <div class="row">
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Origin</label>
            							<input type="text" class="form-control" name="lane_origin" id="lane_origin" autocomplete="">
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Drop</label>
            							  <input type="text" class="form-control" name="lane_drop">
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Equipment</label>
            							  <select class="form-control select2" name="equipment_type" style="width: 100%;">
											<option value="Auto Carrier">Auto Carrier</option>
											<option value="Auto Carrier">Auto Carrier</option>
											<option value="Container">Container</option>
											<option value="Container">Container</option>
											<option value="Container, Insulated">Container, Insulated</option>
											<option value="Container, Insulated">Container, Insulated</option>
											<option value="Container, Refrigerated">Container, Refrigerated</option>
											<option value="Container, Refrigerated">Container, Refrigerated</option>
											<option value="Double Drop">Double Drop</option>
											<option value="Double Drop">Double Drop</option>
											<option value="Drop Deck, Landoll">Drop Deck, Landoll</option>
											<option value="Drop Deck, Landoll">Drop Deck, Landoll</option>
											<option value="Dump Trailer">Dump Trailer</option>
											<option value="Dump Trailer">Dump Trailer</option>
											<option value="Flatbed">Flatbed</option>
											<option value="Flatbed">Flatbed</option>
											<option value="Flatbed, Air-Ride">Flatbed, Air-Ride</option>
											<option value="Flatbed, Air-Ride">Flatbed, Air-Ride</option>
											<option value="Flatbed, B-Train">Flatbed, B-Train</option>
											<option value="Flatbed, B-Train">Flatbed, B-Train</option>
											<option value="Flatbed, Double">Flatbed, Double</option>
											<option value="Flatbed, Double">Flatbed, Double</option>
											<option value="Flatbed, HazMat">Flatbed, HazMat</option>
											<option value="Flatbed, HazMat">Flatbed, HazMat</option>
											<option value="Flatbed, Hotshot">Flatbed, Hotshot</option>
											<option value="Flatbed, Hotshot">Flatbed, Hotshot</option>
											<option value="Flatbed, Maxi">Flatbed, Maxi</option>
											<option value="Flatbed, Maxi">Flatbed, Maxi</option>
											<option value="Flatbed w/Sides">Flatbed w/Sides</option>
											<option value="Flatbed w/Sides">Flatbed w/Sides</option>
											<option value="Flatbed w/Tarps">Flatbed w/Tarps</option>
											<option value="Flatbed w/Tarps">Flatbed w/Tarps</option>
											<option value="Flatbed w/Team">Flatbed w/Team</option>
											<option value="Flatbed w/Team">Flatbed w/Team</option>
											<option value="Flatbed or Step Deck">Flatbed or Step Deck</option>
											<option value="Flatbed or Step Deck">Flatbed or Step Deck</option>
											<option value="Flatbed/Van/Reefer">Flatbed/Van/Reefer</option>
											<option value="Flatbed/Van/Reefer">Flatbed/Van/Reefer</option>
											<option value="Hopper Bottom">Hopper Bottom</option>
											<option value="Hopper Bottom">Hopper Bottom</option>
											<option value="Lowboy">Lowboy</option>
											<option value="Lowboy">Lowboy</option>
											<option value="Moving Van">Moving Van</option>
											<option value="Moving Van">Moving Van</option>
											<option value="Pneumatic">Pneumatic</option>
											<option value="Pneumatic">Pneumatic</option>
											<option value="Power Only">Power Only</option>
											<option value="Power Only">Power Only</option>
											<option value="Reefer">Reefer</option>
											<option value="Reefer">Reefer</option>
											<option value="Reefer, Air-Ride">Reefer, Air-Ride</option>
											<option value="Reefer, Air-Ride">Reefer, Air-Ride</option>
											<option value="Reefer, Double">Reefer, Double</option>
											<option value="Reefer, Double">Reefer, Double</option>
											<option value="Reefer, HazMat">Reefer, HazMat</option>
											<option value="Reefer, HazMat">Reefer, HazMat</option>
											<option value="Reefer, Intermodal">Reefer, Intermodal</option>
											<option value="Reefer, Intermodal">Reefer, Intermodal</option>
											<option value="Reefer, Logistics">Reefer, Logistics</option>
											<option value="Reefer, Logistics">Reefer, Logistics</option>
											<option value="Reefer w/Team">Reefer w/Team</option>
											<option value="Reefer w/Team">Reefer w/Team</option>
											<option value="Removable Gooseneck">Removable Gooseneck</option>
											<option value="Removable Gooseneck">Removable Gooseneck</option>
											<option value="Step Deck">Step Deck</option>
											<option value="Step Deck">Step Deck</option>
											<option value="Stretch Trailer">Stretch Trailer</option>
											<option value="Stretch Trailer">Stretch Trailer</option>
											<option value="Tanker, Aluminum">Tanker, Aluminum</option>
											<option value="Tanker, Aluminum">Tanker, Aluminum</option>
											<option value="Tanker, Intermodal">Tanker, Intermodal</option>
											<option value="Tanker, Intermodal">Tanker, Intermodal</option>
											<option value="Tanker, Steel">Tanker, Steel</option>
											<option value="Tanker, Steel">Tanker, Steel</option>
											<option value="Truck and Trailer">Truck and Trailer</option>
											<option value="Truck and Trailer">Truck and Trailer</option>
											<option value="Van">Van</option>
											<option value="Van">Van</option>
											<option value="Van, Air-Ride">Van, Air-Ride</option>
											<option value="Van, Air-Ride">Van, Air-Ride</option>
											<option value="Van, Conestoga">Van, Conestoga</option>
											<option value="Van, Conestoga">Van, Conestoga</option>
											<option value="Van, Curtain">Van, Curtain</option>
											<option value="Van, Curtain">Van, Curtain</option>
											<option value="Van, Double">Van, Double</option>
											<option value="Van, Double">Van, Double</option>
											<option value="Van, HazMat">Van, HazMat</option>
											<option value="Van, HazMat">Van, HazMat</option>
											<option value="Van, Hotshot">Van, Hotshot</option>
											<option value="Van, Hotshot">Van, Hotshot</option>
											<option value="Van, Insulated">Van, Insulated</option>
											<option value="Van, Insulated">Van, Insulated</option>
											<option value="Van, Intermodal">Van, Intermodal</option>
											<option value="Van, Intermodal">Van, Intermodal</option>
											<option value="Van, Lift-Gate">Van, Lift-Gate</option>
											<option value="Van, Lift-Gate">Van, Lift-Gate</option>
											<option value="Van, Logistics">Van, Logistics</option>
											<option value="Van, Logistics">Van, Logistics</option>
											<option value="Van, Open-Top">Van, Open-Top</option>
											<option value="Van, Open-Top">Van, Open-Top</option>
											<option value="Van, Roller Bed">Van, Roller Bed</option>
											<option value="Van, Roller Bed">Van, Roller Bed</option>
											<option value="Van, Triple">Van, Triple</option>
											<option value="Van, Triple">Van, Triple</option>
											<option value="Van, Vented">Van, Vented</option>
											<option value="Van, Vented">Van, Vented</option>
											<option value="Van w/Team">Van w/Team</option>
											<option value="Van w/Team">Van w/Team</option>
											<option value="Van or Flatbed w/Tarps">Van or Flatbed w/Tarps</option>
											<option value="Van or Flatbed w/Tarps">Van or Flatbed w/Tarps</option>
											<option value="Van or Flatbed">Van or Flatbed</option>
											<option value="Van or Flatbed">Van or Flatbed</option>
											<option value="Van or Reefer">Van or Reefer</option>
											<option value="Van or Reefer">Van or Reefer</option>
											<option value="Insulated Van or Reefer">Insulated Van or Reefer</option>
											<option value="Insulated Van or Reefer">Insulated Van or Reefer</option>
											<option value="Reefer or Vented Van">Reefer or Vented Van</option>
											<option value="Reefer or Vented Van">Reefer or Vented Van</option>
											<option value="Flatbed, w/Chains">Flatbed, w/Chains</option>
											<option value="Flatbed, w/Chains">Flatbed, w/Chains</option>
											<option value="Reefer, w/Pallet Exchange">Reefer, w/Pallet Exchange</option>
											<option value="Reefer, w/Pallet Exchange">Reefer, w/Pallet Exchange</option>
											<option value="Van, w/Blanket Wrap">Van, w/Blanket Wrap</option>
											<option value="Van, w/Blanket Wrap">Van, w/Blanket Wrap</option>
											<option value="Lowboy or RGN">Lowboy or RGN</option>
											<option value="Lowboy or RGN">Lowboy or RGN</option>
											<option value="Van, w/Pallet Exchange">Van, w/Pallet Exchange</option>
											<option value="Van, w/Pallet Exchange">Van, w/Pallet Exchange</option>
											<option value="Step Deck or RGN">Step Deck or RGN</option>
											<option value="Step Deck or RGN">Step Deck or RGN</option>
											<option value="Conveyor">Conveyor</option>
											<option value="Conveyor">Conveyor</option>
											<option value="Flatbed, Over Dimension">Flatbed, Over Dimension</option>
											<option value="Flatbed, Over Dimension">Flatbed, Over Dimension</option>
											<option value="Lowboy, Over Dimension">Lowboy, Over Dimension</option>
											<option value="Lowboy, Over Dimension">Lowboy, Over Dimension</option>
											<option value="Conestoga">Conestoga</option>
											<option value="Conestoga">Conestoga</option>
											<option value="Flatbed Conestoga">Flatbed Conestoga</option>
											<option value="Flatbed Conestoga">Flatbed Conestoga</option>
											<option value="Stepdeck Conestoga">Stepdeck Conestoga</option>
											<option value="Stepdeck Conestoga">Stepdeck Conestoga</option>
											<option value="Straight Box Truck">Straight Box Truck</option>
											<option value="Straight Box Truck">Straight Box Truck</option>
											<option value="Ocean">Ocean</option>
											<option value="Ocean">Ocean</option>
											<option value="TONU">TONU</option>
											<option value="TONU">TONU</option>
										</select>
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Commodity</label>
            							  <input type="text" class="form-control" name="commodity">
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Full/Partial</label>
            							 <select class="form-control select2" name="full_partial" style="width: 100%;">
            								<option value="Full">Full</option>
            								<option value="Partial">Partial</option>
            							</select>
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Footage</label>
            							  <input type="text" class="form-control" name="footage">
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Temprature</label>
            							  <input type="text" class="form-control" name="lane_temp">
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Temp Max</label>
            							  <input type="text" class="form-control" name="lane_temp_max">
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Weight</label>
            							  <input type="text" class="form-control" name="weight">
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Price Range</label>
            							  <input type="text" class="form-control" name="price_range">
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Pick Date</label>
            							  <input type="date" class="form-control hasDatepicker" name="pick_date" id="lane_pick_date" value="">
            						</div>
            					</div>
            					<div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Drop Date</label>
            							<input type="date" class="form-control hasDatepicker" name="drop_date" id="lane_drop_date" value="">
            							
            							<!--div class="input-group date" id="reservationdate" data-target-input="nearest">
            								<input type="text" class="form-control datetimepicker-input" data-target="#reservationdate"/>
            								<div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
            									<div class="input-group-text"><i class="fa fa-calendar"></i></div>
            								</div>
            							</div -->
            							  
            						</div>
            					</div>
            					<div class="col-md-12">
            						<div class="form-group shipment-more">
            							<label>Special Instructions </label>
            							 <textarea class="form-control" rows="4" name="special_instructions" value="" placeholder="Enter ..."> </textarea>
            						</div>
            					</div>
            				</div>
            				<div class="card-footer">
            					<button type="submit" class="btn btn-primary">Save</button>
            					<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
			
			<div class="card">
				<div class="card-body table-responsive">	
					<table class="table mb-0" id="carrier_table">
    					<thead class="table-light">
    					  <tr>
    						 <th>#</th>
    						 <th>Origin</th>
    						 <th>Drop</th>
    						 <th>Equipment</th>
    						 <th>Price Range</th>
    						 <th>Pick Date</th>
    						 <th>Drop Date</th>
    						 <th>Broker</th>
    						 <th width="154px">Action</th>
    					  </tr>
    					</thead>
    					<tr class="odd">
    						<td>1</td>
    						<td class="sorting_1">Miami</td>
    						<td>Houstan</td>
    						<td>Van</td>
    						<td>1400-1600</td>
    						<td>09-05-2022</td>
    						<td>09-06-2022</td>
    						<td>Danny</td>
    						<td style="width: 180px;">
								<a class="btn btn-outline-info btn-sm radius-30 px-4" data-bs-toggle="modal" data-bs-target="#LanesLoadsComments"><i class="bx bx-show"></i></a>
								<a class="btn btn-outline-secondary btn-sm radius-30 px-4" href="#"><i class="bx bx-edit"></i></a>
								<a class="btn btn-outline-danger btn-sm radius-30 px-4" href="#"><i class="bx bx-trash"></i></a>
							</td>
    					  </tr>
					</table>
			</div>
		</div>

		</div>
	</div>
	
	<!--loads show model-->
	<div class="modal" id="LanesLoadsComments" aria-modal="true" role="dialog"><div class="modal-dialog modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Lanes Comments</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        
        <!-- Modal body -->
		
        <div class="modal-body">
		 <div class="container">
           
			<div class="row">
			 <div class="col-md-7">
    			 <div class="card"> 
    			   <div class="card-body"> 
    			     <div class="row">
    					<div class="col-md-4">
    						<div class="form-group shipment-more">
    							<label>Origin:</label> Miami						
    						</div>
    					</div>
    					<div class="col-md-4">
    						<div class="form-group shipment-more">
    							<label>Drop:</label> Houstan						
    						</div>
    					</div>
    					<div class="col-md-4">
    						<div class="form-group shipment-more">
    							<label>Equipment:</label> Van							 
    						</div>
    					</div>
    					<div class="col-md-4">
    						<div class="shipment-more">
    							<label>Commodity:</label> Dry goods						
    						</div>
    					</div>
    					<div class="col-md-4">
    						<div class="shipment-more">
    							<label>Full/Partial:</label> Full						
    						</div>
    					</div>
    					<div class="col-md-4">
    						<div class="shipment-more">
    							<label>Footage:</label> 53						
    						</div>
    					</div>
    					<div class="col-md-4">
    						<div class="shipment-more">
    							<label>Weight:</label> 38,000						
    						</div>
    					</div>
    					<div class="col-md-4">
    						<div class="shipment-more">
    							<label>Price Range:</label> 1400-1600						
    						</div>
    					</div>
    
    					<div class="col-md-4">
    						<div class="shipment-more">
    							<label>Pick Date:</label> 09-05-2022						
    						</div>
    					</div>
    					<div class="col-md-4">
    						<div class="shipment-more">
    							<label>Drop Date:</label> 09-06-2022						
    						</div>
    					</div>
    					<div class="col-md-4">
    						<div class="shipment-more">
    							<label>Temprature:</label> 						
    						</div>
    					</div>
    					<div class="col-md-4">
    						<div class="shipment-more">
    							<label>Temp Max:</label> 						
    						</div>
    					</div>
    					<div class="col-md-6">
    						<div class="shipment-more">
    							<label>Special Instructions:</label> Need van only						
    						</div>
    					</div>
    					
    			      </div>
    			   </div>
    			   </div>
			  </div>
			  <div class="col-md-5">
    			 <div class="card"> 
    			   <div class="card-body"> 
    				 <div class="col-md-12">
    					<div class="shipment-more">
    						<label>All Comments</label>						
    						<div class="direct-chat-msg">
    							<div class="direct-chat-infos clearfix">
    							  <span class="direct-chat-name float-left">Danny</span>
    							</div>
    							
    							<div class="direct-chat-text">
    							 MC#55435 mike 987604543									
    							</div>
    						</div>
        					<div class="shipment-more">
        						<label>Comment</label>
        						<textarea class="form-control" rows="5" name="load_comment" id="load_comment" value="">  </textarea>
        					</div>
    					</div>
    				</div>
    			   </div>
    			   
    			 </div>
			 </div>
			 <div class="user-info">
			     <li><i class="bx bx-phone"></i> +91 00000-00000</li>
		        <li><i class="bx bx-envelope"></i> useremail@gmail.com</li>
			 </div>
			 </div>
			 <div class="row">
			     <div class="col-md-9">
			         
			     </div>
    			 <div class="col-md-3 card-footer" style="text-align:right">
    	            <input type="hidden" id="add_lanes_comment" value="0">
    				<button type="button" id="land_comment_button" class="btn btn-primary">Save</button>
    				<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
    			</div>
			 </div>
          </div>
        </div>
      </div>
    </div>
</div>
	
	<script>
	    $(document).ready(function(){
	        $('#shipper_name').select2();
	    })
	</script>
<!--end page wrapper -->

@include('backend.common.footer')
@endsection