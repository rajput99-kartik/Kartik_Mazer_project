<h4>Pick Up</h4>
<form class="pickform" method="post" action="javascript:void(0)" id="pickup">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm mb-3" name="pickname" autocomplete="off" placeholder="Name" value="{{ $NewPick->p_name }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm mb-3" name="pickaddress" autocomplete="off" placeholder="Address" value="{{ $NewPick->p_address }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm mb-3" name="manageorder" autocomplete="off" placeholder="Manage Order" value="{{ $NewPick->manage_order }}">
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickcity" autocomplete="off" placeholder="City" value="{{ $NewPick->p_city }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickstate" autocomplete="off" placeholder="State" value="{{ $NewPick->p_state }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickzip" autocomplete="off" placeholder="Zip" value="{{ $NewPick->p_zip }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="p_ref" autocomplete="off" placeholder="PO#" value="{{ $NewPick->p_ref }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="p_contact" autocomplete="off" placeholder="Contact" value="{{ $NewPick->p_contact }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickphone" autocomplete="off" placeholder="Phone" value="{{ $NewPick->p_phone }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickemail" autocomplete="off" placeholder="Email" value="{{ $NewPick->p_email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="date" class="form-control form-control-sm mb-3 hasDatepicker" id="pickready" name="pickready" autocomplete="off" placeholder="Pick Date" value="{{ $NewPick->p_ready }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="picktime" autocomplete="off" placeholder="Time" value="{{ $NewPick->p_rtime }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="p_appt_note" autocomplete="off" placeholder="Appt.Note" value="{{ $NewPick->p_appt_note }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-primary" type="submit">Save Pick Up</button>
                                                <button class="btn btn-success addnew" id="AddExtraPick" type="button" onclick="addPick()" value="{{ $NewPick->shipment_id }}">New Pick Up <i class="bx bx-plus"></i></button>
                                            </div>
                                        </div>
            		             </form>