<h4>Drop</h4>
            		             <form class="dropform" method="post" action="javascript:void(0)" id="dropup">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm mb-3" name="dropkname" autocomplete="off" placeholder="Name" value="{{ $NewDrop->d_name }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm mb-3" name="dropaddress" autocomplete="off" placeholder="Address" value="{{ $NewDrop->d_address }}">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-sm mb-3" name="manageorder" autocomplete="off" placeholder="Manage Order" value="{{ $NewDrop->manage_order }}">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="dropcity" autocomplete="off" placeholder="City" value="{{ $NewDrop->d_city }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickstate" autocomplete="off" placeholder="State" value="{{ $NewDrop->d_state }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="dropzip" autocomplete="off" placeholder="Zip" value="{{ $NewDrop->d_zip }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="d_ref" autocomplete="off" placeholder="PO#" value="{{ $NewDrop->d_ref }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="d_contact" autocomplete="off" placeholder="Contact" value="{{ $NewDrop->d_contact }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                 <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="dropphone" autocomplete="off" placeholder="Phone" value="{{ $NewDrop->d_phone }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="dropemail" autocomplete="off" placeholder="Email" value="{{ $NewDrop->d_email }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="date" class="form-control form-control-sm mb-3 hasDatepicker" id="pickready" name="dropready" autocomplete="off" placeholder="Pick Date" value="{{ $NewDrop->d_ready }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="droptime" autocomplete="off" placeholder="Time" value="{{ $NewDrop->d_rtime }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="d_appt_note" autocomplete="off" placeholder="Appt.Note" value="{{ $NewDrop->d_appt_note }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button class="btn btn-primary" type="submit">Save Drop</button>
                                                <button class="btn btn-success addnew" id="AddExtraDrop" type="button" value="{{ $NewDrop->shipment_id }}">New Drop <i class="bx bx-plus"></i></button>
                                            </div>
                                        </div>
            		             </form>