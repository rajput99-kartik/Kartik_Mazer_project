
<!-- EditCarrier Modal start here-->
  
    <div class="modal-dialog modal-xl">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Carrier</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          
		  
		  
		  <!--div class="container" -->
			<!--div class="col-md-12" -->
			<div class="container">
				<form action="{{ url('admin/carrier/update_carriers') }}" id="update_carrier_detail" method="post" enctype="multipart/form-data">
				@csrf
				<div class="card-body">
				<div class="row box_c_edit">
					<div class="form-group heading col-md-12">
						<label>Carrier Details:</label>
					</div>
					<div class="form-group col-md-4">
						<label>Company Name</label>
						<input type="text" class="form-control" name="company_name" value="{{$CarrierData['c_company_name']}}" <?php if($CarrierData['status'] == 1){ echo 'readonly'; } ?> >
					</div>
					<input type="hidden" name="carriers_id" value="{{$CarrierData['id']}}">
					<div class="form-group col-md-4">
						<label>MC#</label>
						<input type="text" class="form-control" value="{{$CarrierData['mc_no']}}" name="mc_no" <?php if($CarrierData['status'] == 1){ echo 'readonly'; } ?>>
					</div>
					<div class="form-group col-md-4">
						<label>DOT</label>
						<input type="text" class="form-control" value="{{$CarrierData['dot_no']}}" name="dot_no" <?php if($CarrierData['status'] == 1){ echo 'readonly'; } ?>>
					</div>
					<div class="form-group col-md-4">
						<label>Address</label>
						<input type="text" class="form-control" value="{{$CarrierData['carrier_city']}}" name="carrier_city" <?php if($CarrierData['status'] == 1){ echo 'readonly'; } ?>>
					</div>
					<div class="form-group col-md-4">
						<label>City</label>
						<input type="text" class="form-control" value="{{$CarrierData['carrier_city_main']}}" name="carrier_city_main" <?php if($CarrierData['status'] == 1){ echo 'readonly'; } ?>>
					</div>
					<div class="form-group col-md-4">
						<label>State</label>
						<input type="text" class="form-control" value="{{$CarrierData['carrier_state']}}" name="carrier_state" <?php if($CarrierData['status'] == 1){ echo 'readonly'; } ?>>
					</div>
					<div class="form-group col-md-4">
						<label>Zip Code</label>
						<input type="text" class="form-control" value="{{$CarrierData['carrier_zip']}}" name="carrier_zip" <?php if($CarrierData['status'] == 1){ echo 'readonly'; } ?>>
					</div>
					<div class="form-group col-md-4">
						<label>Phone</label>
						<input type="text" class="form-control" value="{{$CarrierData['phone_no']}}" name="phone_no" <?php if($CarrierData['status'] == 1){ echo 'readonly'; } ?>>
					</div>
					<div class="form-group col-md-4">
						<label>Fax</label>
						<input type="text" class="form-control" value="{{$CarrierData['carrier_fax']}}" name="carrier_fax" <?php if($CarrierData['status'] == 1){ echo 'readonly'; } ?>>
					</div>
					<div class="form-group col-md-4">
						<label>Email</label>
						<input type="text" class="form-control" value="{{$CarrierData['email']}}<?php //echo $CarrierData->email; ?>" name="email">
					</div>
					<div class="form-group col-md-4">
						<label>Dispatcher</label>
						<input type="text" class="form-control" value="{{$CarrierData['dispatcher']}}<?php //echo $CarrierData->dispatcher; ?>" name="dispatcher">
					</div>
					<div class="form-group col-md-4">
						<label>Equipment Type</label>
						<select name="equipments" class="form-control">
						<option value="<?php echo $CarrierData->equipments; ?>"> <?php echo $CarrierData->equipments; ?></option>
						<?php foreach($Equipments as $equipment_data){ ?>
							
						<option value="{{ $equipment_data->equip_name }}"> {{ $equipment_data->equip_name }} </option>
						<?php } ?>
						</select>
					</div>
					
				</div>
				</div>
					
					<div class="add-more-carrier-option">
					 <div class="card-body">
						<div class="row formwrap box_c_edit">
						    
						    <div class="col-md-6">
						        <div class="form-group heading col-md-12">
    								<label>Cargo:</label>
    							</div>
    							<div class="row">
    							    <div class="form-group col-md-6">
        								<label>Amount USD</label>
        								<input type="text" class="form-control" name="cargo_amount" value="{{$CarrierData['cargo_amount']}}<?php //echo $CarrierData->cargo_amount; ?>">
        							</div>
        							<div class="form-group col-md-6">
        								<label>Expires</label>
        								<input type="text" class="form-control cargo_expires" id="cargo_expires_date" name="cargo_expires" value="{{$CarrierData['cargo_expires']}}<?php //echo $CarrierData->cargo_expires; ?>" > 
        							</div>
    							</div>
						    </div>
						    
						    <div class="col-md-6 row" style="padding-right: 0px;">
						        <div class="form-group heading col-md-12">
    								<label>Cargo Deductible:</label>
    							</div>
    							<div class="form-group col-md-6">
    								<label>Amount USD</label>
    								<input type="text" class="form-control" name="cargo_deduct_amount" value="{{$CarrierData['cargo_deduct_amount']}}" >
    							</div>
								<div class="form-group col-md-6" style="padding-right: 0px;">
								    <label>W9 Tax Id</label>
    								<input type="text" class="form-control" name="tax_id" id="tax_id" placeholder="W9 Tax Id" value="{{$CarrierData['tax_id']}}">
    							</div>
						    </div>
						</div>	
					 </div>	
					
					 <div class="card-body">
						<div class="row box_c_edit">
						    
						    <div class="col-md-12">
						        <div class="form-group heading col-md-12">
    								<label>Liability:</label>
    							</div>
    							<div class="row">
    							    <div class="form-group col-md-6">
        								<label>Amount USD</label>
        								<input type="text" class="form-control" name="liability_amount" value="{{$CarrierData['liability_amount']}}<?php //echo $CarrierData->liability_amount; ?>" >
        							</div>
        							<div class="form-group col-md-6">
        								<label>Expires</label>
        								<input type="text" class="form-control" name="liability_expires" value="{{$CarrierData['liability_expires']}}<?php //echo $CarrierData->liability_expires; ?>" >
        							</div>
    							</div>
						    </div>
						</div>
						<div class="row box_c_edit">
						    <div class="col-md-12">
						        <div class="form-group heading col-md-12">
    								<label>Gen Liability:</label>
    							</div>
    							<div class="row">
    							    <div class="form-group col-md-6">
        								<label>Amount USD</label>
        								<input type="text" class="form-control" name="gen_liab_amount" value="{{$CarrierData['gen_liab_amount']}}<?php //echo $CarrierData->gen_liab_amount; ?>" >
        							</div>
        							<div class="form-group col-md-6">
        								<label>Expires</label>
        								<input type="text" class="form-control" id="gen_liab_expires" name="gen_liab_expires" >
        							</div>
    							</div>
						    </div>
							
							<div class="form-group col-md-3">
								<label>Reefer Breakdown</label>
								<select name="reefer_bkdn" id="reefer_bkdn_val" class="form-control">
								  <option <?php if($CarrierData['reefer_bkdn'] == 'Y'){ echo ' selected="selected"'; } ?> value="Y">Y</option>
								  <option <?php if($CarrierData['reefer_bkdn'] == 'N'){ echo ' selected="selected"'; } ?> value="N">N</option>
								</select>
							</div>
							<div class="form-group col-md-3">
								<label>Reefer Brk Deduct</label>
								<input type="text" class="form-control" name="reefer_brk_deduct" value="{{$CarrierData['reefer_brk_deduct']}}<?php //echo $CarrierData->reefer_brk_deduct; ?>" >
							</div>
							<div class="form-group col-md-3">
								<label>Contract Authority</label>
								<input type="text" class="form-control" name="contact_auth" value="{{$CarrierData['contact_auth']}}<?php //echo $CarrierData->contact_auth; ?>" >
							</div>
							<div class="form-group col-md-3">
								<label>Common Authority</label>
								<input type="text" class="form-control" name="common_auth" value="{{$CarrierData['common_auth']}}<?php //echo $CarrierData->common_auth; ?>" >
							</div>
						</div>
					  </div>
					   <div class="row box_c_edit">
						  <div class="form-group heading col-md-12">
								<label>Driver Details:</label>
							</div>
						  <div class="form-group col-md-6">
							<label>Name</label>
							<input type="text" class="form-control" name="d_name" value="{{$CarrierData['d_name']}}<?php //echo $CarrierData->d_name; ?>" >
						  </div>
						  <div class="form-group col-md-6">
							<label>Phone</label>
							<input type="text" class="form-control" name="d_phone" value="{{$CarrierData['d_phone']}}<?php //echo $CarrierData->d_phone; ?>" >
						  </div>
						</div>
					
					</div>
					
					
				
				
				
				 
					   
					   <div class="modal-footer">
						<input type="submit" class="btn btn-primary" value="Save">
						<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
					</div>
				
		</form>
				 </div>
			</div>
		  <!--/div -->
		  
        
		
		
			
				
      </div>
      
    </div>

<!-- EditCarrier Modal end here-->