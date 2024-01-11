<div class="modal-dialog modal-xl">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Add New Carrier</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          
		  
		  
		  <!--div class="container" -->
			<!--div class="col-md-12" -->
			<div class="container">
				<form action="<?php echo url('/');?>/admin/carrier/add_carrier" id="add-new-carrier" method="post" enctype="multipart/form-data" class="placeholder-form">
				@csrf
				<div class="card-body">
				<div class="row formwrap">
					
					<div class="form-group col-md-2">
						<label>Company Name123</label>
						<input type="text" class="form-control" name="company_name" id="company_name">
						<label id="company_name-error" class="error" for="city"></label>
					</div>
					<div class="form-group col-md-2">
						<label>MC#</label>
						<input type="text" class="form-control" name="mc_no" id="mc_no">
						<label id="mc_no-error" class="error" for="city"></label>
					</div>
					<div class="form-group col-md-2">
						<label>DOT</label>
						<input type="text" class="form-control" name="dot_no" id="dot_no">
						<label id="dot_no-error" class="error" for="city"></label>
					</div>
					<div class="form-group col-md-2">
						<label>Address</label>
						<input type="text" class="form-control" name="carrier_city" id="carrier_city">
						<label id="carrier_city-error" class="error" for="city"></label>
					</div>
					<div class="form-group col-md-2">
						<label>City</label>
						<input type="text" class="form-control" name="carrier_city_main" id="carrier_city_main">
						<label id="carrier_city_main-error" class="error" for="city"></label>
					</div>
					<div class="form-group col-md-2">
						<label>State</label>
						<input type="text" class="form-control" name="carrier_state" id="carrier_state">
						<label id="carrier_state-error" class="error" for="city"></label>
					</div>
					<div class="form-group col-md-2">
						<label>Zip Code</label>
						<input type="text" class="form-control" name="carrier_zip" id="carrier_zip">
						<label id="carrier_zip-error" class="error" for="city"></label>
					</div>
					<div class="form-group col-md-2">
						<label>Phone</label>
						<input type="text" class="form-control" name="phone_no" id="phone_no">
						<label id="phone_no-error" class="error" for="city"></label>
					</div>
					<div class="form-group col-md-2">
						<label>Fax</label>
						<input type="text" class="form-control" name="carrier_fax">
					</div>
					<div class="form-group col-md-2">
						<label>Email</label>
						<input type="text" class="form-control" name="email" id="email">
						<label id="email-error" class="error" for="city"></label>
					</div>
					<div class="form-group col-md-2">
						<label>Dispatcher</label>
						<input type="text" class="form-control" name="dispatcher">
					</div>
					
					<div class="form-group col-md-2">
						<label>Equipment Type</label>
						<select name="equipments" class="form-control">
						<option value=""> Select One</option>
						<?php foreach($Equipments as $equipment_data){ ?>
							
						<option value="<?php echo $equipment_data->equip_name; ?>"> <?php echo $equipment_data->equip_name; ?> </option>
						<?php } ?>
						</select>
					</div>
					
				</div>
				</div>
				
			
					<div class="add-more-carrier-option">
					 <div class="card-body">
						<div class="row formwrap">
							<div class="form-group col-md-2">
								<label>Cargo:</label>
							</div>
							
							<div class="form-group col-md-2">
								<label>Amount USD</label>
								<input type="text" class="form-control" name="cargo_amount" id="cargo_amount">
							</div>
							<div class="form-group col-md-2">
								<label>Expires</label>
								<input type="text" class="form-control" name="cargo_expires" id="cargo_expires">
							</div>
							
							<div class="form-group col-md-2">
								<label>Cargo Deductible:</label>
							</div>
							<div class="form-group col-md-2">
								<label>Amount USD</label>
								<input type="text" class="form-control" name="cargo_deduct_amount" id="cargo_deduct_amount">
							</div>
						</div>	
					 </div>	
					
					 <div class="card-body">
						<div class="row">					
							<div class="form-group col-md-2">
								<label>Liability:</label>
							</div>
							<div class="form-group col-md-2">
								<label>Amount USD</label>
								<input type="text" class="form-control" name="liability_amount" id="liability_amount">
							</div>
							<div class="form-group col-md-2">
								<label>Expires</label>
								<input type="text" class="form-control" name="liability_expires" id="liability_expires">
							</div>
							
							<div class="form-group col-md-2">
								<label>Gen Liability:</label>
							</div>
							<div class="form-group col-md-2">
								<label>Amount USD</label>
								<input type="text" class="form-control" name="gen_liab_amount" id="gen_liab_amount">
							</div>
							<div class="form-group col-md-2">
								<label>Expires</label>
								<input type="text" class="form-control" name="gen_liab_expires" id="gen_liab_expires">
							</div>
							
							<div class="form-group col-md-2">
								<label>Reefer Breakdown</label>
								<select name="reefer_bkdn" id="reefer_bkdn_val" class="form-control">
								  <option selected="" value="Y">Y</option>
								  <option value="N">N</option>
								</select>
							</div>
							<div class="form-group col-md-2">
								<label>Reefer Brk Deduct</label>
								<input type="text" class="form-control" name="reefer_brk_deduct">
							</div>
							<div class="form-group col-md-2">
								<label>Contract Authority</label>
								<input type="text" class="form-control" name="contact_auth">
							</div>
							<div class="form-group col-md-2">
								<label>Common Authority</label>
								<input type="text" class="form-control" name="common_auth">
							</div>
							<div class="form-group col-md-2">
								<label>Safety Rating</label>
								<select name="safety" class="form-control">
								  <option value="NONE" selected="">NONE</option>
								  <option value="CONDITIONAL">CONDITIONAL</option>
								  <option value="SATISFACTORY">SATISFACTORY</option>
								  <option value="UNSATISFACTORY">UNSATISFACTORY</option>
								</select>
							</div>
							
						</div>
					  </div>
					
					<div class="card card-primary">
						<div class="card-header">
						   <h3 class="card-title">Carrier Info</h3>
						 </div>
						<div class="card-body">
							<div class="row">
							 
							 <div class="form-group col-md-3">
							 <label>Carrier Packet</label>
							  <input type="file" name="carrier_packet" id="carrier_packet">
							  <label id="carrier_packet-error" class="error" for="city"></label>
							 </div>
							 
							 <div class="form-group col-md-3">
								<label>Tax Id (W9)</label>
								<input type="text" class="form-control" name="w9_id">
							    <label id="w9_id-error" class="error" for="w9_id"></label>
							 </div>
						   </div>
						</div>
					</div>
			
					 <div class="card card-primary">
						  <div class="card-header">
							<h3 class="card-title">Driver Details:</h3>
						  </div>
					   <div class="card-body">
						  
						 <div class="row">
						  
						  <div class="form-group col-md-6">
							<label>Name</label>
							<input type="text" class="form-control" name="d_name">
						  </div>
						  <div class="form-group col-md-6">
							<label>Phone</label>
							<input type="text" class="form-control" name="d_phone">
						  </div>
						</div>
					  </div>
					 </div>
					
					</div>
					
				
				 <!--div class="card card-primary">
						  <div class="card-header">
							<h3 class="card-title">Carrier Account Information:</h3>
						  </div>
					   <div class="card-body">
						  
						 <div class="row">
						  
							  <div class="form-group col-md-12">
								<label>Pay To Carrier Factoring</label>
								<input type="checkbox" id="pay_factoring" name="pay_factoring" value="" class="fadeIn">
							  </div>
							</div>
						</div>
						
						<div class="card-body">
						 <div class="row">
							 
				
							  
								<div class="form-group col-md-2 col-sm-2 col-xs-12">
								 <label><b>NOA Upload</b></label>
									<input type="file" id="AccountCarrierNOA" class="" value="" name="AccountCarrier_NOA"> 
									<span class="noa_required error-msg"></span>
								</div>								
								<div class="form-group col-md-2 col-sm-2 col-xs-12">
									<label><b>Company Name</b></label>
									<input type="text" id="Factoring_companyName" value="" class="fadeIn form-control" name="factoring_companyName" autocomplete="off"> 
									 <span class="f_companyName error-msg"></span>
									 <div id="CompanyNameList" class="autodroporigin"></div>
								</div>
								
								<div class="form-group col-md-2 col-sm-2 col-xs-12">
									<label><b>Address</b></label>
									<input type="text" id="FacteringAddress" value="" class="fadeIn form-control FacteringAddress" name="factering_address" autocomplete="off"> 
									<span class="f_address error-msg"></span>                
								</div>
								
							   
								 <div class="form-group col-md-2 col-sm-2 col-xs-12">
									<label><b>City</b></label>
									<input type="text" id="FactoringCity" value="" class="fadeIn form-control FactoringCity" name="factoring_city" autocomplete="off"> 
									<span class="f_city error-msg"></span>
								</div>
								 <div class="form-group col-md-1 col-sm-1 col-xs-12">
									<label><b>State</b></label>
									<input type="text" id="FactoringState" value="" class="fadeIn form-control FactoringState" name="factoring_state" autocomplete="off"> 
									<span class="f_state error-msg"></span>								
								</div> 
								<div class="form-group col-md-2 col-sm-2 col-xs-12">
									<label><b>Zip Code</b></label>
									<input type="text" id="FactoringZipCode" value="" class="fadeIn form-control FactoringZipCode" name="factoring_zip" autocomplete="off">
									<span class="f_Zip error-msg"></span>																
								</div>
								<div class="form-group col-md-2 col-sm-2 col-xs-12">
									<label><b>Phone No.</b></label>
									<input type="number" id="FactoringPhone" value="" class="fadeIn form-control" name="factoring_phone" autocomplete="off">
									<span class="f_phon error-msg"></span>
								</div>
								<div class="form-group col-md-2 col-sm-2 col-xs-12">
									<label><b>Fax</b></label>
									<input type="text" id="FactoringFax" value="" class="fadeIn form-control" name="factoring_fax" autocomplete="off">
									
								</div>
								<div class="form-group col-md-2 col-sm-2 col-xs-12">
									<label><b>Email</b></label>
									<input type="text" id="FactoringEmail" value="" class="fadeIn form-control" name="factoring_email" autocomplete="off">
									  <span class="email_required error-msg"></span> 
								</div>
								<div class="form-group col-md-2 col-sm-2 col-xs-12">
									<label><b>Concern Person</b></label>
									<input type="text" id="concernPerson" value="" class="fadeIn form-control" name="factoring_concernPerson" autocomplete="off">
								 </div>	
						</div>
								 
							<div class="card-body">	
							  <div class="row"> 
						  
								<div class="payment-method-section">
									<label><b>Carrier Address</b></label>
									<input type="checkbox" name="new_c_address" id="new_c_address" value="" class="fadeIn" checked="">
								</div>
								
								
								
								    <div class="form-group col-md-2 col-sm-2 col-xs-12">
										<label><b>Company Name</b></label>
										<input type="text" name="c_company_name" id="c_company_name" value="" class="fadeIn form-control"> 
										<span class="c_company_name error-msg"></span>
									</div> 
									
									<div class="form-group col-md-2 col-sm-2 col-xs-12">
										<label><b>Address</b></label>
										<input type="text" name="c_address" id="c_address" value="" class="fadeIn form-control c_address"> 
										<span class="c_address_required error-msg"></span>
									</div>
									
								   
									 <div class="form-group col-md-2 col-sm-2 col-xs-12">
										<label><b>City</b></label>
										<input type="text" name="c_city" id="c_city" value="" class="fadeIn form-control c_city"> 
										<span class="c_city_required error-msg"></span>
									</div>
									 <div class="form-group col-md-2 col-sm-2 col-xs-12">
										<label><b>State</b></label>
										<input type="text" name="c_state" id="c_state" value="" class="fadeIn form-control c_state">       
										<span class="c_state_required error-msg"></span>
									</div> 
									<div class="form-group col-md-2 col-sm-2 col-xs-12">
										<label><b>Zip Code</b></label>
										<input type="text" name="c_zipcode" id="c_zipcode" value="" class="fadeIn form-control c_zipcode">       
										<span class="c_zipcode_required error-msg"></span>
									</div>
									<div class="form-group col-md-2 col-sm-2 col-xs-12">
										<label><b>Phone No.</b></label>
										<input type="text" id="c_phone" value="" class="fadeIn form-control" name="c_phone">
										<span class="c_phone_required error-msg"></span>
									</div>
									<div class="form-group col-md-2 col-sm-2 col-xs-12">
										<label><b>Fax</b></label>
										<input type="text" id="c_fax" value="" class="fadeIn form-control" name="c_fax">
										<span class="c_fax_required error-msg"></span>
									</div>
									<div class="form-group col-md-2 col-sm-2 col-xs-12">
										<label><b>Email</b></label>
										<input type="text" id="c_email" value="" class="fadeIn form-control" name="c_email">
										<span class="c_email_required error-msg"></span>
									</div>
									
							
								</div>
							</div>
							
							<div class="card-body">
							<div class="row">
                                <label><b>Primery Payment Method</b></label><br>
							
							 <input type="radio" id="male" name="primery_method" value="cheque">
							  <label for="cheque">cheque</label><br>
							  <input type="radio" id="female" name="primery_method" value="ACH" checked="">
							  <label for="ACH">ACH</label><br>
							  <input type="radio" id="female" name="primery_method" value="Wire">
							  <label for="ACH">Wire</label><br>
							  <input type="radio" id="Credit_card" name="primery_method" value="credit_card">
							  <label for="Credit_card">Credit Card</label>
							</div>
							</div>
							
						 </div>
					   </div -->
					   
					   
					  <div class="modal-footer">
						  <button type="submit" id="carrier-form-submit" class="btn btn-primary">Save</button>
						  <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
						</div>
					</form> 
				 </div>
			</div>
		  <!--/div -->
		  
        
		
		
        
      </div>
      
    </div>