<div class="modal-dialog modal-md">
<div class="modal-content">
                  
                  <!-- Modal Header -->
                  <div class="modal-header">
                    <img src="https://crmonline.co.in/public/backend/assets/images/1.jpg" alt="logo icon">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-header" style="justify-content: center;padding: 10px;">
                    <h4 class="modal-title">Update Lanes</h4>
                  </div>
                  
                  <!-- Modal body -->
                  
                  <div class="modal-body">
                   <div class="container">
                     <form action="<?php echo url('/'); ?>/admin/load/LodePostUpdate" id="load_lane_update_form" method="post" enctype="multipart/form-data">
                      @csrf
                      <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group shipment-more search_input_update">
                                      <label>Origin <span class="text text-danger required">*</span></label>
                                      <input type="text" class="form-control" name="lane_origin_update" id="lane_origin_input_update" for="lane_origin_update" value="{{ $load_data->load_state_origin }},{{ $load_data->load_state_code }}" readonly>
                                      <span class="error" id="origincheck" ></span>
                                      <!--ul class="drop_ul lane_origin_dropdown_update" id="lane_origin_update" style="width: 100%;">
                                      </ul -->
                                      <input type="hidden" name="lane_origin_id" value="{{ $load_data->load_state_origin_id }}" id="origin_place_value_update">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group shipment-more search_input_update">
                                      <label>Drop <span class="text text-danger required">*</span></label>
                                      <input type="text" class="form-control" name="lane_drop_update" id="lane_drop_input_update" for="lane_drop_update" value="{{ $load_data->load_city_desti }},{{ $load_data->drop_state_code }}" readonly>
                                      <span class="error" id="dropcheck" ></span>
                                      <!--ul class="drop_ul lane_origin_dropdown_update" id="lane_drop_update" style="width: 100%;">
                                      </ul -->
                                      <input type="hidden" name="lane_drop_id" value="{{ $load_data->load_city_desti_id }}" id="drop_place_value_update">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group shipment-more">
                                      <label>Equipment</label>
                                      <span class="error" id="equipmentcheck" ></span>
                                        <select class="form-control" name="equipment_type" id="equipment_type_update" style="width: 100%;">
                                        <option value="{{ $load_data->equipments }}" >{{ $load_data->equipments }}</option> 
                                      </select>
                                  </div>
                              </div>
                              
                              <div class="col-md-6">
                                  <div class="form-group shipment-more">
                                      <label>Full/Partial</label>
                                       <select class="form-control select2" name="full_partial" style="width: 100%;">
                                          <option <?php if($load_data->full_partial_tl_ltl == 'FULL'){ echo 'selected'; } ?> value="FULL">FULL</option>
                                          <option <?php if($load_data->full_partial_tl_ltl == 'PARTIAL'){ echo 'selected'; } ?> value="PARTIAL">PARTIAL</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group shipment-more">
                                      <label>Length <span class="text text-danger required">*</span></label>
                                        <input type="number" class="form-control" name="lengthFeet" value="{{ $load_data->length_load }}">
                                  </div>
                              </div>
                              
                              <div class="col-md-6">
                                  <div class="form-group shipment-more">
                                      <label>Weight <span class="text text-danger required">*</span></label>
                                        <input type="number" class="form-control" name="weightPounds" value="{{ $load_data->weight_load }}">
                                  </div>
                              </div>
                              <div class="col-md-6">
            						<div class="form-group shipment-more">
            							<label>Contact Methode </label>
            							 <select class="form-control select2" name="primary_contact" id="primary_contact" style="width: 100%;">
            								<option value="EMAIL">EMAIL</option>
            								<option value="PRIMARY_PHONE">PHONE</option>
            							</select>
            						</div>
            					</div>
                              <div class="col-md-6">
                                  <div class="form-group shipment-more">
                                      <label>Pick Date <span class="text text-danger required">*</span></label>
                                        <input type="date" class="form-control hasDatepicker" name="pick_date" id="lane_pick_date" value="{{ $load_data->post_date }}">
                                  </div>
                              </div>
                               
                              <div class="col-md-6">
                                  <div class="form-group shipment-more">
                                      <label>Offer Rate</label>
                                        <input type="number" class="form-control" name="offer_rate" value="{{ $load_data->load_offer_rate }}">
                                  </div>
                                  <div class="form-group shipment-more">
                                      <label>Commodity <span class="text text-danger required">*</span></label>
                                        <input type="text" class="form-control" name="commodity" value="{{ $load_data->load_commodity }}">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group shipment-more comment_shipment">
                                      <label>Comment1 <span class="text text-danger required">*</span></label>
                                       <input type="text" class="form-control" name="comment1" placeholder="Enter ..." value="{{ $load_data->special_requirement }}" style="padding: 10px 10px 30px 10px;" readonly>
                                  </div>
                              </div>

                              <!--div class="col-md-12">
            						<div class="form-group shipment-more">
										<div class="card card-primary">
										  	<div class="card-header">	
												<h3>BROKER-TO-CARRIER</h3>
										  	</div>
												<div class="card-body" style="border: 1px solid;">
												
													<span>(incl.fuel: this week)</span>
                                                    <div class="default">
													    <h3>$2.01</h3>
													    <span>($1.60-$2.30)</span>
                                                    </div>
                                                    
                                                    <div class="row loads_box" style="margin-bottom: 20px;">
                                                        
                                                        <div class="col-md-6">
                                                            <div class="">
                                                                <h4>BROKER-TO-CARRIER CONTRACT</h4>
                                                                <span id="up_companies">per trip</span>
                                                    		    <h3 id="up_cont_price">$2.01</h3>
                                                                <span id="up_cont_mileage"></span>
                                                                <span id="up_reports"></span>
                                                                
                                                                <div class="inline">
                                                                    <span class="time_frame"></span>
                                                                    <span class="market_type_origin"></span>
    															    <span class="market_type_drop"></span>
    															</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 border-left">
                                                            <div class="">
                                                                <h4>BROKER-TO-CARRIER SPOT</h4>
                                                                <span id="up_spot_companies">per trip</span>
                                                    			<h3 id="up_spot_price">$2.01</h3>
                                                                <span id="up_spot_mileage"></span>
                                                                <span id="up_spot_reports"></span>
                                                                <div class="inline">
                                                                    <span class="market_type_origin"></span>
															        <span class="market_type_drop"></span>
															    </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
													<h4><button type="button" class="btn btn-success" id="LoadPostRateUpdateBtn">Shipper-To-Carrier</button></h4>
												
												</div>
										</div>
            						</div>
            					</div -->
                              
                          </div>
                          <div class="card-footer">
                            <input type="hidden" value="{{ $load_data->load_dat_id }}" name="dat_id">
                            <button type="submit" class="btn btn-primary" id="load_post_btn">Save</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                          </div>
                     </form>
                    </div>
                  </div>
                </div>
    	</div>
        <script>
        $(document).ready(function(){
            $('.search_input_update input').keyup(function(){
               var d = $('#'+$(this).attr('for')).show();
                //console.log(d);
                var value = $(this).val().toLowerCase();
                $('#'+$(this).attr('for')+' li').filter(function() {
                  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                }); 
            })
            
            $("ul#lane_drop_update li").click(function(){
                $('input[name="lane_drop_update"]').val($(this).text());
                $("ul#lane_drop_update").hide();
            })
            
            $("ul#lane_origin_update li").click(function(){
                $('input[name="lane_origin_update"]').val($(this).text());
                $("ul#lane_origin_update").hide();
            })
        })
    </script>
