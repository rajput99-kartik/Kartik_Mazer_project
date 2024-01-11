<div class="modal-dialog modal-md">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Agency Details</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
	  
	  
		<form action="{{url('admin/agency/agency_update')}}" method="post">
		@csrf
		<div class="modal-body" style="padding: 0px;">
		

					<div class="card card-primary">
							<div class="card-body" style="padding-bottom: 0px;">
							
								<div class="row">
								
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Office: <span class="text text-danger required">*</span></strong>
                                            <input type="text" class="form-control" name="office" value="{{ $data->agencies_name}}" min="2" max="40" required>
                                        </div>
                                    </div>
									
									<div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Contact Name: <span class="text text-danger required">*</span></strong>
                                            <input type="text" class="form-control" name="name" value="{{ $data->name}}" min="2" max="11"  required>
                                        </div>
                                    </div>
									
									<div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Email: <span class="text text-danger required">*</span></strong>
                                            <input type="text" class="form-control" name="p_email" value="{{ $data->p_email}}" min="2" max="40"  required>
                                        </div>
                                    </div>
									
									<div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Offical Email: <span class="text text-danger required">*</span></strong>
                                            <input type="text" class="form-control" name="email" value="{{ $data->agencies_email}}" min="2" max="40"  required>
                                        </div>
                                    </div>
									
									<div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Phone: <span class="text text-danger required">*</span></strong>
                                            <input type="text" class="form-control" name="phone" value="{{ $data->agencies_phone}}" min="2" max="11" required>
                                        </div>
                                    </div>
								</div>
									
							</div>
					</div>
						
			</div>	
	  <!-- Modal footer -->
      <div class="modal-footer">
	  <input type="hidden" name="agency_id" value="{{ $data->id}}">
        <button type="submit" class="btn btn-primary" id="agency_update_btn">Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
	
	</form>
 
 
    </div>
</div>
  
	  
	  
	  