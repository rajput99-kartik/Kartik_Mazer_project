<div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <!--h4 class="modal-title">Modal Heading</h4-->
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
	  
	  
		<form action="{{url('admin/userprofilesubmit')}}" method="post">
		@csrf
		<div class="modal-body">
					<div class="card card-primary">
						<div class="card-header">
							<h3>User Details</h3>	
							</div>
							<div class="card-body">
								<div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Father Name:</strong>
                                            <input type="text" class="form-control" name="father_name" value="{{ $data->father_name}}">
                                        </div>
                                    </div>
									
									<div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Mother Name:</strong>
                                            <input type="text" class="form-control" name="mother_name" value="{{ $data->mother_name}}">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Gender:</strong>
                                            {{-- <input type="text" class="form-control" name="gender" value="{{ $data->gender}}"> --}}
                                        
                                            <select name="gender" type="text" class="form-control">
                                                <option value="<?php echo $data->gender ?>"><?php echo $data->gender ?></option>
                                                <option value="Female">Female</option>
                                                <option value="Male">Male</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
									
									<div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="marrid">Married</label>
                                            <select name="marrid" class="form-control">
                                                <option value="<?php echo $data->marrid ?>"><?php echo $data->marrid  ?></option>
                                                <option value="marrid ">Married</option>
                                                <option value="Unmarride">Unmarried</option>
                                            </select>
                                            {{-- <strong>Marride:</strong>
                                            <input type="text" class="form-control" name="marrid" value="{{ $data->marrid}}"> --}}
                                        </div>
                                    </div>
									
									<div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>DOB:</strong>
                                            <input type="date" class="form-control" name="dob" value="{{ $data->dob}}">
                                        </div>
                                    </div>
									
									<div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Parmanent Address:</strong>
                                            <input type="text" class="form-control" name="parmanent_address" value="{{ $data->parmanent_address}}">
                                        </div>
                                    </div>
									
								
								</div>
									
							</div>
					</div>
						
			</div>		
		
								
								
	  
	  <!-- Modal footer -->
      <div class="modal-footer">
	  <input type="hidden" name="user_id" value="{{ $data->id}}">
        <button type="submit" class="btn btn-success" id="agency_update_btn">Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
	
	</form>
 
 
    </div>
</div>
  
	  
	  
	  