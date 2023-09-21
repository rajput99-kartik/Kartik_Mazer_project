@extends('backend.layouts.master')
@section('title','Create Carrier')
@section('content')

<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
        	<ul>
        		@foreach ($errors->all() as $error)
        			<li>{{ $error }}</li>
        		@endforeach
        	</ul>
        </div>
        @endif		
		<ul class="nav nav-tabs">
            <li class="pending_approval"><a href="{{url('/admin/carrier')}}" data-toggle="tab" aria-expanded="true">All Carrier</a>
            </li>

            <li class="all_leave active"><a href="{{url('/admin/new-carrier')}}" data-toggle="tab" aria-expanded="false">Create Carrier</a>
                </li>
                <li class=""><a href="{{url('/admin/carrier/myCarrierPacket')}}" data-toggle="tab" aria-expanded="false">MyCarrierPacket</a>
            </li>
        </ul>
		<div class="card">
			<div class="card-body">
					
					
				<form action="{{url('admin/carrier/add_carrier')}}" id="add-new-carrier" method="POST" enctype="multipart/form-data" class="placeholder-form">
				@csrf
				
				    <div class="row">
				        <div class="col-md-6">
				            <div class="card card-primary">
    				            <div class="card-header">
            					   <h3 class="card-title">Basic Info</h3>
            					 </div>
            					 
            					 <div class="row formwrap space-row">
                					<div class="form-group col-md-4">
                						<input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name">
                						<label id="company_name-error" class="error" for="city"></label>
                					</div>
                					<div class="form-group col-md-4">
                						<input type="text" class="form-control" name="mc_no" id="mc_no" placeholder="MC#">
                						<label id="mc_no-error" class="error" for="city"></label>
                					</div>
                					<div class="form-group col-md-4">
                						<input type="text" class="form-control" name="dot_no" id="dot_no" placeholder="DOT">
                						<label id="dot_no-error" class="error" for="city"></label>
                					</div>
                					<div class="form-group col-md-4">
                						<input type="text" class="form-control" name="carrier_city" id="carrier_city" placeholder="Address">
                						<label id="carrier_city-error" class="error" for="city"></label>
                					</div>
                					<div class="form-group col-md-4">
                						<input type="text" class="form-control" name="carrier_city_main" id="carrier_city_main" placeholder="City">
                						<label id="carrier_city_main-error" class="error" for="city"></label>
                					</div>
                					<div class="form-group col-md-4">
                						<input type="text" class="form-control" name="carrier_state" id="carrier_state" placeholder="State">
                						<label id="carrier_state-error" class="error" for="city"></label>
                					</div>
                					<div class="form-group col-md-4">
                						<input type="text" class="form-control" name="carrier_zip" id="carrier_zip" placeholder="Zip Code">
                						<label id="carrier_zip-error" class="error" for="city"></label>
                					</div>
                					<div class="form-group col-md-4">
                						<input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Phone">
                						<label id="phone_no-error" class="error" for="city"></label>
                					</div>
                					<div class="form-group col-md-4">
                						<input type="text" class="form-control" name="carrier_fax" placeholder="Fax">
                					</div>
                					<div class="form-group col-md-4">
                						<input type="text" class="form-control" name="email" id="email" placeholder="Email">
                						<label id="email-error" class="error" for="city"></label>
                					</div>
                					<div class="form-group col-md-4">
                						<input type="text" class="form-control" name="dispatcher" placeholder="Dispatcher">
                					</div>
                					
                					<div class="form-group col-md-4">
                						<select name="equipments" class="form-control">
                						<option value=""> Equipment Type</option>
                						<?php foreach($Equipments as $equipment_data){ ?>
                							
                						<option value="<?php echo $equipment_data->equip_name; ?>"> <?php echo $equipment_data->equip_name; ?> </option>
                						<?php } ?>
                						</select>
                					</div>
                					
                				</div>
            				</div>
            				<div class="card card-primary">
                				<div class="card-header">
            					   <h3 class="card-title">Cargo:</h3>
            					</div>
            					<div class="row space-row">
            					    <div class="form-group col-md-6">
        								<input type="text" class="form-control" name="cargo_amount" id="cargo_amount" placeholder="Amount USD">
        							</div>
        							<div class="form-group col-md-6">
        								<input type="text" class="form-control" name="cargo_expires" id="cargo_expires" placeholder="Expires">
        							</div>
            					</div>
            				</div>
        					
        					<div class="card card-primary">
            					<div class="card-header">
            					   <h3 class="card-title">Cargo Deductible:</h3>
            					</div>
            					<div class="row space-row">
    							    <div class="form-group col-md-12">
        								<input type="text" class="form-control" name="cargo_deduct_amount" id="cargo_deduct_amount" placeholder="Amount USD">
        							</div>
									<div class="form-group col-md-12">
        								<input type="text" class="form-control" name="tax_id" id="tax_id" placeholder="W9 Tax Id">
        							</div>
    							</div>
    						</div>
        					 
				        </div>
				        <div class="col-md-6">
				            <div class="card card-primary">
    				            <div class="card-header">
            					   <h3 class="card-title">Liability:</h3>
            					</div>
            					<div class="row space-row">
    							    <div class="form-group col-md-6">
        								<input type="text" class="form-control" name="liability_amount" id="liability_amount" placeholder="Amount USD">
        							</div>
        							<div class="form-group col-md-6">
        								<input type="text" class="form-control" name="liability_expires" id="liability_expires" placeholder="Expires">
        							</div>
    							</div>
							</div>
							<div class="card card-primary">
    							<div class="card-header">
            					   <h3 class="card-title">Gen Liability:</h3>
            					</div>
            					<div class="row space-row">
    							    <div class="form-group col-md-6">
        								<input type="text" class="form-control" name="gen_liab_amount" id="gen_liab_amount" placeholder="Amount USD">
        							</div>
        							<div class="form-group col-md-6">
        								<input type="text" class="form-control" name="gen_liab_expires" id="gen_liab_expires" placeholder="Expires">
        							</div>
        							<div class="form-group col-md-6">
        								<select name="reefer_bkdn" id="reefer_bkdn_val" class="form-control">
        								    <option>Reefer Breakdown</option>
        								  <option selected="" value="Y">Y</option>
        								  <option value="N">N</option>
        								</select>
        							</div>
        							<div class="form-group col-md-6">
        								<input type="text" class="form-control" name="reefer_brk_deduct" placeholder="Reefer Brk Deduct">
        							</div>
        							<div class="form-group col-md-4">
        								<input type="text" class="form-control" name="contact_auth" placeholder="Contract Authority">
        							</div>
        							<div class="form-group col-md-4">
        								<input type="text" class="form-control" name="common_auth" placeholder="Common Authority">
        							</div>
        							<div class="form-group col-md-4">
        								<select name="safety" class="form-control">
        								    <option>Safety Rating</option>
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
        							<h3 class="card-title">Driver Details:</h3>
        						 </div>
        						 <div class="row space-row">
        						  <div class="form-group col-md-6">
        							<input type="text" class="form-control" name="d_name" placeholder="Name">
        						  </div>
        						  <div class="form-group col-md-6">
        							<input type="text" class="form-control" name="d_phone" placeholder="Phone">
        						  </div>
        						</div>
        						
        					</div>
        					<button type="submit" id="carrier-form-submit" class="btn btn-primary">Create Carrier</button>
				        </div>
				    </div>
				
				 
					</form>
					
					
			</div>
		</div>
		<!-- End card-->
		
		
		
<!-- start new here  ****************************************-->

</div>
</div>
<!--end page wrapper -->   


@include('backend.common.footer')
@endsection