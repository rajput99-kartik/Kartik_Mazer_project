@extends('backend.layouts.master')
@section('title','Create Shipment')
@section('content')

<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Shipment</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Create Shipment</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a class="btn btn-primary" href="{{ url('admin/shipment') }}"> Back</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        <div class="form-multi-step">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-head">
                        <li class="step-head active" id="create_shipment">
                            <span>Create Shipment</span>
                        </li>
                        <li class="step-head" id="shipper">
                            <span>Shipper</span>
                        </li>
                        <li class="step-head" id="bill_To">
                            <span>Bill To</span>
                        </li>
                        <li class="step-head" id="pick_up">
                            <span>Pick Up</span>
                        </li>
                        <li class="step-head" id="drop">
                            <span>Drop</span>
                        </li>
                        <li class="step-head" id="carrier_details">
                            <span>Carrier Details</span>
                        </li>
                        <li class="step-head" id="rates">
                            <span>Shipper/Carrier Rates</span>
                        </li>
                        <li class="step-head" id="instruction">
                            <span>Instruction</span>
                        </li>
                        <li class="step-head" id="documents">
                            <span>Documents</span>
                        </li>
                    </div>
                </div>
                <div class="col-md-9">
                    <form action="{{url('admin/create-shipment-submit')}}" id="createshipmentsubmit" method="POST" class="placeholder-form">  
                        @csrf
                        <div class="step-box" open-data="create_shipment" next-data="shipper" style="display:block">
                            <h4>Create Shipment</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group shipment-more">
                                        <input type="number" class="form-control form-control-sm mb-3" name="ref_no" placeholder="Ref">
                                    </div>
                                </div>
                             
                                <div class="col-md-6">
                                    <div class="form-group shipment-more">
                                        <select class="form-control form-control-sm mb-3 select2" name="equipment_type" style="width: 100%;">
                                            <option selected="">Equipment</option>
                                                                                                    </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group shipment-more">
                                        <input type="text" class="form-control form-control-sm mb-3" name="full_partial" placeholder="Full/Partial">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group shipment-more">
                                        <input type="text" class="form-control form-control-sm mb-3" name="commodity_laod" placeholder="Commodity">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group shipment-more">
                                        <input type="text" class="form-control form-control-sm mb-3" name="pieces_laod" placeholder="Pallat">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group shipment-more">
                                        <input type="text" class="form-control form-control-sm mb-3" name="weight_loads" placeholder="Weight">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group shipment-more">
                                        <input type="text" class="form-control form-control-sm mb-3" name="declared_loads" placeholder="Declared Value">
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group shipment-more">
                                        <select name="mode" class="form-control form-control-sm mb-3">
                                            <option value="Enter Mode" selected="">Select Mode</option>
                                            <option value="OTR">OTR</option>
                                            <option value="Drayage">Drayage</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group shipment-more">
                                        <input type="text" class="form-control form-control-sm mb-3" name="footage_loads" placeholder="Footage">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group shipment-more">
                                        <select class="form-control form-control-sm mb-3" name="payment_mode">
                                            <option disabled="" selected="">Payment Mode</option>
                                            <option value="USD">USD</option>
                                            <option value="CAD">CAD</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group shipment-more">
                                        <input type="text" class="form-control form-control-sm mb-3" name="temp_min" placeholder="Temp Min">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group shipment-more">
                                        <input type="text" class="form-control form-control-sm mb-3" name="temp_max" placeholder="Temp Max">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group shipment-more">
                                        <input type="text" class="form-control form-control-sm mb-3" name="temp_precool" placeholder="Temp Precool">
                                    </div>
                                </div>	
                            </div>
                            <div class="buttons text-right">
                                <button type="button" class="next">Next <i class="bx bx-right-arrow-alt"></i></button>
                            </div>
                        </div>
                        <div class="step-box" open-data="shipper" next-data="bill_To">
                            <h4>Shipper</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group shipment-more">
                                        <select id="shippment_name" name="shippername" class="form-control form-control-sm mb-3 valid" aria-invalid="false">
                                            <option value="Enter Mode" selected="" disabled="">Name</option>
                                            <option value="OTR" data-id="1">OTR</option>
                                            <option value="Drayage" data-id="2">Drayage</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="shipperaddress" id="shipperaddress" placeholder="Address" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="shippercity" id="shippercity" placeholder="City" readonly="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="shipperstate" id="shipperstate" placeholder="State" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm mb-3" name="shipperzip" id="shipperzip" placeholder="Zip" readonly="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm mb-3" name="shipperphone" id="shipperphone" placeholder="Phone" readonly="">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm mb-3" name="customer_c_name" id="customer_c_name" placeholder="C Persone" readonly="">
                            </div>
                            <div class="buttons text-right">
                                <button type="button" class="prve"><i class="bx bx-left-arrow-alt"></i> previous</button>
                                <button type="button" class="next">Next <i class="bx bx-right-arrow-alt"></i></button>
                            </div>
                        </div>
                        <div class="step-box" open-data="bill_To" next-data="pick_up">
                            <h4>Bill To</h4>
                            <div class=""> 
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm mb-3" name="billname" id="billname" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm mb-3" name="billaddress" id="billaddress" placeholder="Address">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm mb-3" name="billcity" id="billcity" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm mb-3" name="billstate" id="billstate" placeholder="State">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm mb-3" name="billzip" id="billzip" placeholder="Zip">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm mb-3" name="billphone" id="billphone" placeholder="Phone">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm mb-3" name="b_customer_c_name" id="b_customer_c_name" placeholder="C Persone">
                                </div>
                            </div>
                            <div class="buttons text-right">
                                <button type="button" class="prve"><i class="bx bx-left-arrow-alt"></i> previous</button>
                                <button type="button" class="next">Next <i class="bx bx-right-arrow-alt"></i></button>
                            </div>
                        </div>
                        
                        <div class="step-box" open-data="pick_up" next-data="drop">
                            <h4>Pick Up</h4>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm mb-3" name="pickname" autocomplete="off" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm mb-3" name="pickaddress" autocomplete="off" placeholder="Address">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="pickcity" autocomplete="off" placeholder="City">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="pickstate" autocomplete="off" placeholder="State">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="pickzip" autocomplete="off" placeholder="Zip">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="p_ref" autocomplete="off" placeholder="PO#">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="p_contact" autocomplete="off" placeholder="Contact">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="pickphone" autocomplete="off" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="pickemail" autocomplete="off" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" id="pickready" name="pickready" autocomplete="off" placeholder="Pick Date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="picktime" autocomplete="off" placeholder="Time">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="p_appt_note" autocomplete="off" placeholder="Appt.Note">
                                    </div>
                                </div>
                            </div>
                            <div class="buttons text-right">
                                <button type="button" class="prve"><i class="bx bx-left-arrow-alt"></i> previous</button>
                                <button type="button" class="next">Next <i class="bx bx-right-arrow-alt"></i></button>
                            </div>
                        </div>
                        
                        <div class="step-box" open-data="drop" next-data="carrier_details">
                            <h4>Drop Up</h4>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm mb-3" name="dropname" autocomplete="off" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-sm mb-3" name="dropaddress" autocomplete="off" placeholder="Address">
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="dropcity" autocomplete="off" placeholder="City">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="dropstate" autocomplete="off" placeholder="State">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="dropzip" autocomplete="off" placeholder="Zip">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="d_ref" autocomplete="off" placeholder="PO#">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="d_contact" autocomplete="off" placeholder="Contact">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="dropphone" autocomplete="off" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="dropemail" autocomplete="off" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="dropready" id="dropready" autocomplete="off" placeholder="Drop Date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="droptime" autocomplete="off" placeholder="Time">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="d_appt_note" autocomplete="off" placeholder="Appt. Note">
                                    </div>
                                </div>
                            </div>
                                
                            <div class="buttons text-right">
                                <button type="button" class="prve"><i class="bx bx-left-arrow-alt"></i> previous</button>
                                <button type="button" class="next">Next <i class="bx bx-right-arrow-alt"></i></button>
                            </div>
                        </div>
                        
                        <div class="step-box" open-data="carrier_details" next-data="rates">
                            <h4>Carrier Details</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="carrier_mc" id="shipment_mc" autocomplete="off" placeholder="MC">
                                        <input type="hidden" name="carriers_id" id="carriers_id" value="">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="carrier_dot" id="carrier_dot" placeholder="DOT">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="carrier_name" id="carrier_name" placeholder="Carrier Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="dispatched" id="dispatched" placeholder="Dispatcher">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_phone" id="shipment_c_phone" placeholder="Phone">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_email" id="shipment_c_email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_driver_n" id="shipment_c_driver_n" placeholder="Driver N">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_driver_p" id="shipment_c_driver_p" placeholder="Phone">
                                    </div>
                                </div>
                            </div>
                            <div class="buttons text-right">
                                <button type="button" class="prve"><i class="bx bx-left-arrow-alt"></i> previous</button>
                                <button type="button" class="next">Next <i class="bx bx-right-arrow-alt"></i></button>
                            </div>
                        </div>
                        
                        <div class="step-box" open-data="rates" next-data="instruction">
                            <h4>Shipper/Carrier Rates</h4>
                            <div class="card-body">
                                <table class="table addCusRate">
                                    <tbody>
                                        <tr>
                                            <td style="width: 11%;"><strong>Customer</strong></td>
                                            <td style="width:17%">
                                                <select id="CustomerRateDropdown" name="customer_rate_dropdown" class="form-control form-control-sm mb-3">
                                                    <option value="Flat" selected="selected">Flat Rate</option>
                                                    <option value="All">All In</option>
                                                    <option value="CWT">CWT</option>
                                                </select>
                                            </td>
                                            <td style="width: 12%;" class="w75"><strong>Unit1</strong></td>
                                            <td><input type="text" name="rate_unit1_carrier" value="" class="form-control form-control-sm mb-3"></td>
                                            <td style="width:10%" class="w75"><strong>Unit2</strong></td>
                                            <td style="width:12%"><input type="text" name="rate_unit2_carrier" value="" class="form-control form-control-sm mb-3"></td>
                                            <td style="width: 14%;" class="w75"><strong>LH Rate</strong></td>
                                            <td style="width:12%"><input type="text" name="lh_customer" id="lh_customer" value="" class="form-control form-control-sm mb-3"></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 11%;"><strong>Carrier</strong></td>
                                            <td style="width:17%">
                                                <select id="CarrierRateDropdown" name="carrier_rate_dropdown" class="form-control form-control-sm mb-3">
                                                    <option value="Flat" selected="selected">Flat Rate</option>
                                                    <option value="All">All In</option>
                                                    <option value="CWT">CWT</option>
                                                </select>
                                            </td>
                                            <td style="width: 12%;" class="w75"><strong>Unit1</strong></td>
                                            <td><input type="text" name="rate_unit1_carrier" value="" class="form-control form-control-sm mb-3"></td>
                                            <td style="width:10%" class="w75"><strong>Unit2</strong></td>
                                            <td style="width:12%"><input type="text" name="rate_unit2_carrier" value="" class="form-control form-control-sm mb-3"></td>
                                            <td style="width: 14%;" class="w75"><strong>LH Rate</strong></td>
                                            <td style="width:12%"><input type="text" name="lh_carrier" id="lh_carrier" value="" class="form-control form-control-sm mb-3">
                                                <input type="hidden" name="lh_carrier_hiden" id="lh_carrier_hiden" value="">
                                            </td>
                                        </tr><!-- <tr>
                                        <td class="w75"><strong>fdgfg</strong></td>
                                        <td><input type="text" name="fsc_miles" value="" class="form-control form-control-sm mb-3"></td>
                                        <td class="w75"><strong>fgfg</strong></td>
                                        <td><input type="text" name="max_rate" value="" class="form-control form-control-sm mb-3"></td>
                                    </tr> -->
                                    </tbody>
                                </table>
                                <table class="table addCusRate carier_rate">
                                    <tbody>
                                        <tr>
                                            <th style="width:20%">Carrier</th>
                                            <th style="width:20%">Accessorial</th>
                                            <th style="width:25%">Carrier/Release</th>
                                            <th style="width:15%"></th>
                                            <th style="width:20%">Cutomer</th>
                                        </tr>
                                        <tr>
                                            <td class="w200"><strong class="ShipCCarrierTxt"> </strong></td>
                                            <td><strong>Line Haul</strong></td>
                                            <td><input type="text" name="carrier_rate_haul" id="carrier_rate_haul" value="" class="form-control form-control-sm mb-3"></td>
                                            <td class="checkbox"><input type="checkbox" class="form-check-input" name=""></td>
                                            <td><input type="text" value="" name="customer_rate_haul" id="customer_rate_haul" class="form-control form-control-sm mb-3">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="transportation1" value="" class="form-control form-control-sm mb-3"></td>
                                            <td><input type="text" name="line_haul1" placeholder="Lumper" value="" class="form-control form-control-sm mb-3"></td>
                                            <td><input type="text" name="carrier1" id="carrier1" value="" class="form-control form-control-sm mb-3"></td>
                                            <td class="checkbox"><input type="checkbox" class="form-check-input" name=""></td>
                                            <td><input type="text" value="" name="customer1" id="customer1" class="form-control form-control-sm mb-3"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" name="transportation2" value="" class="form-control form-control-sm mb-3"></td>
                                            <td><input type="text" name="line_haul2" placeholder="Gate Fees" value="" class="form-control form-control-sm mb-3"></td>
                                            <td><input type="text" name="carrier2" id="carrier2" value="" class="form-control form-control-sm mb-3"></td>
                                            <td class="checkbox"><input type="checkbox" class="form-check-input" name=""></td>
                                            <td><input type="text" id="customer2" name="customer2" value="" class="form-control form-control-sm mb-3"></td>
                                        </tr>
                                        <tr class="repeater" id="repeater">
                                            <td><input type="text" name="transportation3" value="" class="form-control form-control-sm mb-3"></td>
                                            <td><input type="text" name="line_haul3" value="" class="form-control form-control-sm mb-3"></td>
                                            <td><input type="text" name="carrier3" id="carrier3" value="" class="form-control form-control-sm mb-3"></td>
                                            <td class="checkbox"><input type="checkbox" class="form-check-input" name=""></td>
                                            <td><input type="text" id="customer3" name="customer3" value="" class="form-control form-control-sm mb-3" style="width: 114px;"> <button type="button" class="add-new" onclick="add_new()"><i class="bx bx-plus"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td><strong>Total <b>USD</b></strong></td>
                                            <td><input type="text" name="carrier_total" id="carrier_total" value="" class="form-control form-control-sm mb-3" readonly=""></td>
                                            <td></td>
                                            <td><input type="text" id="customer_total" name="customer_total" value="" class="form-control customer_total" readonly=""></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="buttons text-right">
                                <button type="button" class="prve"><i class="bx bx-left-arrow-alt"></i> previous</button>
                                <button type="button" class="next">Next <i class="bx bx-right-arrow-alt"></i></button>
                            </div>
                        </div>
                        
                        <div class="step-box" open-data="instruction" next-data="documents">
                            <h4>Instruction</h4>
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Carrier Instruction</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <textarea class="form-control form-control-sm mb-3" rows="5" name="carrier_instruction" placeholder="Enter Instruction ..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Shipper Instruction</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <textarea class="form-control form-control-sm mb-3" rows="5" name="shipper_instruction" placeholder="Enter Instruction ..."></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="buttons text-right">
                                <button type="button" class="prve"><i class="bx bx-left-arrow-alt"></i> previous</button>
                                <button type="button" class="next">Next <i class="bx bx-right-arrow-alt"></i></button>
                            </div>
                        </div>
                        
                        <div class="step-box" open-data="documents">
                            <h4>Documents</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>There are no decuments associated with this load. Please Choose file to add a document.</strong></p>
                                </div>
                                <div class="col-md-6">
                                    <div class="card card-primary">
                                        <div class="card-body">
                                            
                                            <div class="form-group">
                                                <label for="shipper_files">Shipper DOC</label>
                                                <input type="file" name="shipper_files[]" id="shipper_files" multiple="" accept="application/pdf">
                                            </div>
                                            <div class="form-group">
                                                <label>Upload POD</label>
                                                <input type="file" name="pod_files[]" id="pod_files" multiple="" accept="application/pdf">
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                <!--div class="col-md-4">
                <div class="card card-primary">
                <div class="card-body">
                <div class="form-group">
                <label>Invoice number</label>
                <input type="text" name="" id="" placeholder="Invoice number">
                </div>
                <div class="form-group">
                <label>Invoice date</label>
                <input type="date" name="" id="" placeholder="Invoice number">
                </div>
                </div>
                </div>
            </div -->
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <label> Lumper Documents</label>
                                <input type="file" name="shipper_files[]" id="fUpload" multiple="" accept="application/pdf">
                            </div>
                            <div class="form-group">
                                <label>Gate Fees</label>
                                <input type="file" name="carrier_files[]" id="fUpload1" multiple="multiple" accept="application/pdf">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                            <div class="buttons text-right">
                                <button type="button" class="prve"><i class="bx bx-left-arrow-alt"></i> previous</button>
                                <button type="submit" class="submit" id="submit">Create Shipment <i class="bx bx-right-arrow-alt"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>

<!-- start new here  ****************************************-->

</div>
</div>
<!--end page wrapper -->
<form id="1">
    <input type="hidden" value="Address 1" id="address">
</form>
<form id="2">
    <input type="hidden" value="Address 2" id="address">
</form>
<script>
    var count_total = 0;
    function add_new(){
        $("tr#repeater").after('<tr class="repeater" id="remove_'+count_total+'"><td><input type="text" name="transportation3" value="" class="form-control form-control-sm mb-3"></td><td><input type="text" name="line_haul3" value="" class="form-control form-control-sm mb-3"></td><td><input type="text" name="carrier3" id="carrier3" value="" class="form-control form-control-sm mb-3"></td><td class="checkbox"><input type="checkbox" class="form-check-input" name=""></td><td><input type="text" id="customer3" name="customer3" value="" class="form-control form-control-sm mb-3" style="width: 114px;"> <button type="button" class="add-new remove" onclick="remove_new('+count_total+')"><i class="bx bx-minus"></i></button></td></tr>');
        count_total++;
    }
    
    function remove_new(removeid){
        $("#remove_"+removeid).remove();
    }
    
    $("#documents_toggle").click(function(){
        $("div#shipment_documents").slideToggle();
    })
    
    $('#shippment_name').select2();
    
    $("select#shippment_name").change(function(){
        var findid = $("#shippment_name option:selected").attr('data-id');
        var data = $("form#"+findid).find("#address").val();
        $("input#shipperaddress").val(data);
    })
    
    $("button.next").click(function(){
        var data = $(this).parent().parent().attr('open-data');
        var next = $(this).parent().parent().attr('next-data');
        $(".step-box").hide();
        $(this).parent().parent().next().fadeIn();
        $(".form-head li").removeClass("active");
        $("li#"+next).addClass("active");
        $("li#"+data).addClass("complete");
    })
    
    $("button.prve").click(function(){
        $(".step-box").hide();
        $(this).parent().parent().prev().fadeIn();
    })
</script>

@include('backend.common.footer')
@endsection


