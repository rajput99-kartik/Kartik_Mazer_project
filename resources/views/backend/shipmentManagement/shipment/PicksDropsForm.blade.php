<div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <button style="padding: 10px 20px;" class="btn btn-primary" type="submit">Save Pick & Drop</button>
                      <button type="button" class="btn-close" id="multipickclose"></button>
                    </div>
                    <div class="modal-header" style="justify-content: center;padding: 10px;">
                      <h4 class="modal-title">Pick (<span class="countpic"></span>) & Drop (<span class="countdrop"></span>)</h4>
                    </div>
                    <!-- Modal body -->

                    <div class="modal-body">
            		 <div class="container">
                    
                     
                         <div class="row">
                             <div class="col-md-6 pic_drop">
                                 <div id="pickAddHere">
                                    <button class="btn btn-success addnew" id="AddExtraPick" type="button" onclick="addPick()" value="{{ $Shipment_id }}"><i class="bx bx-plus"></i></button>
                                 @foreach($Picks as $Pick)
            		             <h4 class="box-heading">Pick Up </h4>
            		             <form class="pickform" method="post" action="javascript:void(0)" id="pickup">
                                        
                                        
                                        <div class="row padding-remove">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickname" autocomplete="off" placeholder="Name" value="{{ $Pick->p_name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickaddress" autocomplete="off" placeholder="Address" value="{{ $Pick->p_address }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <!--<input type="text" class="form-control form-control-sm mb-3" name="manageorder" autocomplete="off" placeholder="Manage Order" value="{{ $Pick->manage_order }}">-->
                                                    <select class="form-control form-control-sm mb-3" name="manageorder">
                                                        <option>- Select -</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                 <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickcity" autocomplete="off" placeholder="City" value="{{ $Pick->p_city }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickstate" autocomplete="off" placeholder="State" value="{{ $Pick->p_state }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickzip" autocomplete="off" placeholder="Zip" value="{{ $Pick->p_zip }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="p_ref" autocomplete="off" placeholder="PO#" value="{{ $Pick->p_ref }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="p_contact" autocomplete="off" placeholder="Contact" value="{{ $Pick->p_contact }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                 <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickphone" autocomplete="off" placeholder="Phone" value="{{ $Pick->p_phone }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickemail" autocomplete="off" placeholder="Email" value="{{ $Pick->p_email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="date" class="form-control form-control-sm mb-3 hasDatepicker" id="pickready" name="pickready" autocomplete="off" placeholder="Pick Date" value="{{ $Pick->p_ready }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="picktime" autocomplete="off" placeholder="Time" value="{{ $Pick->p_rtime }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="p_appt_note" autocomplete="off" placeholder="Appt.Note" value="{{ $Pick->p_appt_note }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-primary" type="button"  id="shipment_pick_save" value="{{ $Pick->id }}">Save PickUp</button>
                                                <button class="btn btn-danger" type="button"  id="shipment_pick_delete" data-shipmentId="{{ $Pick->shipment_id }}" value="{{ $Pick->id }}">Delete PickUp</button>
                                            </div>
                                            <div class="col-md-12">
                                                <span class="text text-success" name="pick_msg"></span>
                                            </div>
                                        </div>
            		             </form>
                                 @endforeach
                                </div>
                            </div>
            		         
            		         <div class="col-md-6 pic_drop">
                             <div id="dropAddHere">
                                 <button class="btn btn-success addnew" id="AddExtraDrop" type="button" value="{{ $Shipment_id }}"> <i class="bx bx-plus"></i></button>
                                @foreach($Drops as $Drop)
            		             <h4>Drop </h4>
            		             <form class="dropform" action="javascript:void(0)" id="dropup">
                                        
                                        <div class="row padding-remove">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3 dropname" id="" name="dropname" autocomplete="off" placeholder="Name" value="{{ $Drop->d_name }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3 dropaddress" id="" name="dropaddress" autocomplete="off" placeholder="Address" value="{{ $Drop->d_address }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <!--<input type="text" class="form-control form-control-sm mb-3 manageorder" id="" name="manageorder" autocomplete="off" placeholder="Manage Order" value="{{ $Drop->manage_order }}">-->
                                                    <select class="form-control form-control-sm mb-3" name="manageorder">
                                                        <option value="">- Select -</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                 <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="dropcity" autocomplete="off" placeholder="City" id="dropcity" value="{{ $Drop->d_city }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickstate" autocomplete="off" placeholder="State" id="pickstate" value="{{ $Drop->d_state }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="dropzip" autocomplete="off" placeholder="Zip" id="dropzip" value="{{ $Drop->d_zip }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="d_ref" autocomplete="off" placeholder="PO#" id="d_ref" value="{{ $Drop->d_ref }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="d_contact" autocomplete="off" placeholder="Contact" id="d_contact" value="{{ $Drop->d_contact }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                 <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="dropphone" autocomplete="off" placeholder="Phone" id="dropphone" value="{{ $Drop->d_phone }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="dropemail" autocomplete="off" placeholder="Email" id="dropemail" value="{{ $Drop->d_email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <input type="date" class="form-control form-control-sm mb-3 hasDatepicker" name="dropready" autocomplete="off" placeholder="Pick Date" id="pickready" value="{{ $Drop->d_ready }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="droptime" autocomplete="off" placeholder="Time" id="droptime" value="{{ $Drop->d_rtime }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="d_appt_note" autocomplete="off" placeholder="Appt.Note" id="d_appt_note" value="{{ $Drop->d_appt_note }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-primary" type="button" id="shipment_drop_save" value="{{ $Drop->id }}">Save Drop</button>
                                                <button class="btn btn-danger" type="button" id="shipment_drop_delete" data-shipmentId="{{ $Drop->shipment_id }}" value="{{ $Drop->id }}">Delete Drop</button>
                                            </div>
											<div class="col-md-12">
                                                <span class="text text-success" name="drop_msg"></span>
                                            </div>
                                        </div>
            		             </form>
                                 @endforeach
                                </div>
            		         </div>
            		     </div>
                      </div>
                    </div>
                  </div>
                </div>