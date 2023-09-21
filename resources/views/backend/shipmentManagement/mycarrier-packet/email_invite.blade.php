<div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Send Carrier Invite</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
        @foreach($results as $result)
        <div class="modal-body">
            <div class="form-group">
                <lable>Where are we sending the carrier package?</lable>
                <select name="verify_emails" id="verify_emails" class="form-control">
					<option selected="" value="">Select Email</option>
					@foreach($result->Emails as $email_data)
                        <option value="{{ $email_data->Email }}">{{ $email_data->Email }}  <span class="text-success"> (identity confirmed)</span> </option>
                    @endforeach
				</select>
                    
                    <div class="form-group">
                            <lable>Who wants to know when the carrier is done?</lable>
                            <em>Separate multiple email addresses with a comma</em>
                    </div>
                    <input type="text" class="form-control" id="emails_sent_by" value="">

            </div>
        </div>
        @endforeach

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" id="EmailInviteSent" class="btn btn-success">Send</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>