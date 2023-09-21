<div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Payment Update</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <form action="{{ url('/') }}" method="post" id="ArPaymentForm">
      <div class="modal-body">
                <div class="container">
                    <div class="row">
                            <div class="form-group col-md-4">
                                <label>Pay mode</label>
                                <select name="pay_mode" id="pay_mode" class="form-control">
								  <option value="ACH">ACH</option>
								  <option value="Check">Check</option>
								</select>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Invoice Amount</label>
                                <input type="text" class="form-control" id="invoice_amount">
                                <span class="error" id="invoiceAmountError"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Amount Paid</label>
                                <input type="text" class="form-control" id="amount_paid">
                                <span class="error" id="amountPaidError"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Balance Due</label>
                                <input type="text" class="form-control" id="balance_due">
                                <span class="error" id="balanceDueError"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Check Date</label>
                                <input type="date" class="form-control" id="check_date">
                            </div>
                            <div class="form-group col-md-4">
                                <label>Received Date</label>
                                <input type="date" class="form-control" id="received_date">
                                <span class="error" id="receivedDateError"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Deposit Date</label>
                                <input type="date" class="form-control"  id="deposit_date">
                                <span class="error" id="depositDateError"></span>
                            </div>
                            
                            
                    </div>
                    
                </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <input type="hidden" id="Shipment" value="{{ isset($Invoices['id']) ? $Invoices['id'] : null }}" data-pro="{{ isset($Invoices['shipment_id']) ? $Invoices['shipment_id'] : null }}">
        <button type="button" class="btn btn-primary" id="ArPaymentFormBtn">Save</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
</form>
    </div>
  </div>



<script>
 
</script>