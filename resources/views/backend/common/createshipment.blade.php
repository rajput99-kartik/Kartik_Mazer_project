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


        <div class="row">
            <div class="col-xl-12 mx-auto">
                <h6 class="mb-0 text-uppercase"></h6>
                <hr/>
                <div class="card border-top border-0 border-4 border-primary">
                    <div class="card-body p-3 ">
                        <div class="card-title d-flex align-items-center pb-2">
                            <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                            </div>
                            <h5 class="mb-0 text-primary ">Shipment Management</h5>
                        </div>
                        <!-- <hr> -->
                        <div class="row g-3">
                            <form action="{{url('create-shipment-submit')}}" id="createshipmentsubmit" method="POST" >  
                                @csrf
                                <div class="shipment-more-details card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Create Shipment</h3>
                                        <!-- <h2 class="">Create Shipment</h2> -->
                                    </div>

                                    <div class="row card-body">
                                        <div class="col-md-3">
                                            <div class="form-group shipment-more">
                                                <input type="number" class="form-control form-control-sm mb-3" name="ref_no" placeholder="Ref">
                                            </div>
                                        </div>
                                     
                                        <div class="col-md-3">
                                            <div class="form-group shipment-more">
                                                <select class="form-control form-control-sm mb-3 select2" name="equipment_type" style="width: 100%;" >
                                                    <option selected="">Equipment</option>
                                                    <?php foreach($Equipments as $equipments_value){ ?>
                                                        <option value="<?php echo $equipments_value->equip_name; ?>"><?php echo $equipments_value->equip_name; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group shipment-more">
                                                <input type="text" class="form-control form-control-sm mb-3" name="full_partial" placeholder="Full/Partial">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group shipment-more">
                                                <input type="text" class="form-control form-control-sm mb-3" name="commodity_laod" placeholder="Commodity">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group shipment-more">
                                                <input type="text" class="form-control form-control-sm mb-3" name="pieces_laod" placeholder="Pallat">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group shipment-more">
                                                <input type="text" class="form-control form-control-sm mb-3" name="weight_loads" placeholder="Weight">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group shipment-more">
                                                <input type="text" class="form-control form-control-sm mb-3" name="declared_loads" placeholder="Declared Value">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="form-group shipment-more">
                                                <select name="mode" class="form-control form-control-sm mb-3">
                                                    <option value="Enter Mode" selected="">Select Mode</option>
                                                    <option value="OTR">OTR</option>
                                                    <option value="Drayage">Drayage</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group shipment-more">
                                                <input type="text" class="form-control form-control-sm mb-3" name="footage_loads" placeholder="Footage">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group shipment-more">
                                                <select class="form-control form-control-sm mb-3" name="payment_mode">
                                                    <option disabled selected>Payment Mode</option>
                                                    <option value="USD">USD</option>
                                                    <option value="CAD">CAD</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group shipment-more">
                                                <input type="text" class="form-control form-control-sm mb-3" name="temp_min" placeholder="Temp Min">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group shipment-more">
                                                <input type="text" class="form-control form-control-sm mb-3" name="temp_max" placeholder="Temp Max">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group shipment-more">
                                                <input type="text" class="form-control form-control-sm mb-3" name="temp_precool" placeholder="Temp Precool">
                                            </div>
                                        </div>	
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Shipper</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shippername" id="ShipperName" autocomplete="off" placeholder="Name">
                                                            <input type="hidden" name="companies_id" id="companies_id" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shipperaddress" id="shipperaddress" placeholder="Address">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shippercity" id="shippercity" placeholder="City">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shipperstate" id="shipperstate" placeholder="State">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shipperzip" id="shipperzip" placeholder="Zip">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shipperphone" id="shipperphone" placeholder="Phone">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="customer_c_name" id="customer_c_name" placeholder="C Persone">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Bill To</h3>
                                                    </div>
                                                    <div class="card-body"> 
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
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card card-primary  carier_details">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Carrier Details</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="carrier_mc" id="shipment_mc" autocomplete="off" placeholder="MC">
                                                            <input type="hidden" name="carriers_id" id="carriers_id" value="">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="carrier_dot" id="carrier_dot" placeholder="DOT">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="carrier_name" id="carrier_name" placeholder="Carrier Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dispatched" id="dispatched" placeholder="Dispatcher">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_phone" id="shipment_c_phone" placeholder="Phone">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_email" id="shipment_c_email" placeholder="Email">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_driver_n" id="shipment_c_driver_n" placeholder="Driver N">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_driver_p" id="shipment_c_driver_p" placeholder="Phone">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
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
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card card-success">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Pick Up</h3>
                                                    </div>
                                                    <div class="card-body"> 
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="pickname" autocomplete="off" placeholder="Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="pickaddress" autocomplete="off" placeholder="Address">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="pickcity" autocomplete="off" placeholder="City">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="pickstate" autocomplete="off" placeholder="State">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="pickzip" autocomplete="off" placeholder="Zip">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="p_ref" autocomplete="off" placeholder="PO#">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="p_contact" autocomplete="off" placeholder="Contact">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="pickphone" autocomplete="off" placeholder="Phone">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="pickemail" autocomplete="off" placeholder="Email">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" id="pickready" name="pickready" autocomplete="off" placeholder="Pick Date">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="picktime" autocomplete="off" placeholder="Time">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="p_appt_note" autocomplete="off" placeholder="Appt.Note">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card card-success">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Drop</h3>
                                                    </div>
                                                    <div class="card-body"> 
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropname" autocomplete="off" placeholder="Name">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropaddress" autocomplete="off" placeholder="Address">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropcity" autocomplete="off" placeholder="City">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropstate" autocomplete="off" placeholder="State">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropzip" autocomplete="off" placeholder="Zip">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="d_ref" autocomplete="off" placeholder="PO#">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="d_contact" autocomplete="off" placeholder="Contact">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropphone" autocomplete="off" placeholder="Phone">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropemail" autocomplete="off" placeholder="Email">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropready" id="dropready" autocomplete="off" placeholder="Drop Date">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="droptime" autocomplete="off" placeholder="Time">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="d_appt_note" autocomplete="off" placeholder="Appt. Note">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card card-primary shipper_carrier_rates">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Shipper/Carrier Rates</h3>
                                                    </div>
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
                                                                    <td style="width: 14%;" class="w75" style="width:12%"><strong>LH Rate</strong></td>
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
                                                                    <td style="width: 14%;" class="w75" style="width:12%"><strong>LH Rate</strong></td>
                                                                    <td style="width:12%"><input type="text" name="lh_carrier" id="lh_carrier" value="" class="form-control form-control-sm mb-3">
                                                                        <input type="hidden" name="lh_carrier_hiden" id="lh_carrier_hiden" value="">
                                                                    </td>
                                                                </tr>
                                                                
                                            `                <!-- <tr>
                                                                <td class="w75"><strong>fdgfg</strong></td>
                                                                <td><input type="text" name="fsc_miles" value="" class="form-control form-control-sm mb-3"></td>
                                                                <td class="w75"><strong>fgfg</strong></td>
                                                                <td><input type="text" name="max_rate" value="" class="form-control form-control-sm mb-3"></td>
                                                            </tr> -->
                                                            </tbody>
                                                        </table>`
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
                                                                    <td><input type="checkbox" class="form-check-input" name=""></td>
                                                                    <td><input type="text" value="" name="customer_rate_haul" id="customer_rate_haul" class="form-control form-control-sm mb-3">
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="transportation1" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="text" name="line_haul1" placeholder="Lumper" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="text" name="carrier1" id="carrier1" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="checkbox" class="form-check-input" name=""></td>
                                                                    <td><input type="text" value="" name="customer1" id="customer1" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="transportation2" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="text" name="line_haul2" placeholder="Gate Fees" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="text" name="carrier2" id="carrier2" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="checkbox" class="form-check-input" name=""></td>
                                                                    <td><input type="text" id="customer2" name="customer2" value="" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="transportation3" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="text" name="line_haul3" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="text" name="carrier3" id="carrier3" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="checkbox" class="form-check-input" name=""></td>
                                                                    <td><input type="text" id="customer3" name="customer3" value="" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="transportation4" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="text" name="line_haul4" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="text" name="carrier4" id="carrier4" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="checkbox" class="form-check-input" name=""></td>
                                                                    <td><input type="text" id="customer4" name="customer4" value="" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="transportation5" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="text" name="line_haul5" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="text" name="carrier5" id="carrier5" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="checkbox" class="form-check-input" name=""></td>
                                                                    <td><input type="text" id="customer5" name="customer5" value="" class="form-control form-control-sm mb-3"></td>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card card-primary documents_upload">
                                                <div class="card-header">
                                                    <h3 class="card-title">Documents</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p><strong>There are no decuments associated with this load. Please Choose file to add a document.</strong></p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card card-primary">
                                                                <div class="card-body">
                                                                    
                                                                    <div class="form-group">
                                                                        <label>Shipper DOC</label>
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
                                    </div>
                                    </div>
                                    </div>
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!-- start new here  ****************************************-->

</div>
</div>
<!--end page wrapper -->   


@include('backend.common.footer')
@endsection


