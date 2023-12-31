@extends('backend.layouts.master')
@section('title','Create Shipment')
@section('content')
<style>
    input::placeholder {
        opacity: 0.5 !important;
    }
    select {
        color: #000000ad !important;
    }
    h3.card-title {
        font-size: 13px !important;
    }
    div#documents_toggle {
        padding-bottom: 3px;
    }
</style>
<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        
        <ul class="nav nav-tabs">
                    @can('shipment-all')
            <li class="pending_approval"><a href="{{url('/admin/shipment/list')}}" data-toggle="tab" aria-expanded="true">All Shipments</a></li>
            @endcan
            @can('shipment-agentshipment')
            <li class=""><a href="{{url('/admin/shipment/manager/list')}}" data-toggle="tab" aria-expanded="true">Team Shipments</a></li>
            @endcan
            
            <li class="pending_approval"><a href="{{url('/admin/shipment')}}" data-toggle="tab" aria-expanded="true">Shipments</a>
            </li>
            @can('shipment-create')
            <li class="pending_approval active"><a href="{{url('/admin/create-shipment')}}" data-toggle="tab" aria-expanded="true">Create Shipments</a></li>
            @endcan
        </ul>

        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card border-primary shipper_caont" style="padding: 15px;">
                    <div class="card-body p-3 ">
                        <div class="row g-3">
                            <form action="{{url('admin/create-shipment-submit')}}" id="createshipmentsubmit" method="POST" class="placeholder-form">  
                                @csrf
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="shipment-more-details card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Create Shipment</h3>
                                                <!-- <h2 class="">Create Shipment</h2> -->
                                            </div>
        
                                            <div class="row card-body">
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="number" class="form-control form-control-sm mb-3" name="ref_no" placeholder="Ref" value="{{isset($load['ref_no']) ? ($load['ref_no']) : null }}">
                                                    </div>
                                                </div>
                                             
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <select class="form-control form-control-sm mb-3 select2" name="equipment_type" style="width: 100%;" >
                                                            <option selected="">Equipment</option>
                                                            <?php if(isset($load)){ ?> <option value="<?php echo $load['equipments']; ?>" selected><?php echo $load['equipments']; ?></option><?php }else{ ?>
                                                            <?php foreach($Equipments as $equipments_value){  ?>
                                                                <option value="<?php echo $equipments_value->equip_name; ?>"><?php echo $equipments_value->equip_name; ?></option>
                                                            <?php } } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="full_partial" placeholder="Full/Partial" value="{{isset($load['full_partial_tl_ltl']) ? ($load['full_partial_tl_ltl']) : null }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="commodity_laod" placeholder="Commodity" value="{{isset($load['load_commodity']) ? ($load['load_commodity']) : null }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="pieces_laod" placeholder="Pallat" value="{{isset($load['pallets']) ? ($load['pallets']) : null }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="weight_loads" placeholder="Weight" value="{{isset($load['weight_load']) ? ($load['weight_load']) : null }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="declared_loads" placeholder="Declared Value">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <select name="mode" class="form-control form-control-sm mb-3">
                                                            <option value="Enter Mode" selected="">Select Mode</option>
                                                            <option value="OTR">OTR</option>
                                                            <option value="Drayage">Drayage</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="footage_loads" placeholder="Footage" value="{{isset($load['length_load']) ? ($load['length_load']) : null }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <select class="form-control form-control-sm mb-3" name="payment_mode" id="payment_mode">
                                                            <option disabled selected>Payment Mode</option>
                                                            <option value="USD">USD</option>
                                                            <option value="CAD">CAD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="temp_min" placeholder="Temp Min">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
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
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Shipper</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group shipment-more" >
                                                            <select name="shippername" class="form-control" id="shipper_name_testamb">
                                                                <option value="" >Select Name</option>
                                                               
																@foreach ($companies_data as $companies)

																<option value="{{$companies->id}}">{{ $companies->company_name }}</option>

																@endforeach
																
                                                            </select>
															<input type="hidden" id="companies_id" name="companies_id" value="">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control " name="shipperaddress" id="shipperaddress" placeholder="Address" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shippercity" id="shippercity" placeholder="City" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shipperstate" id="shipperstate" placeholder="State" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="shipperzip" id="shipperzip" placeholder="Zip" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="shipperphone" id="shipperphone" placeholder="Phone" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="customer_c_name" id="customer_c_name" placeholder="C Persone" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="card card-primary">
                                            <div class="card-header" data-bs-toggle="collapse" data-bs-target="#bil_to">
                                                <h3 class="card-title">Bill To <i class="bx bx-plus"></i></h3>
                                            </div>
                                            <div class="card-body collapse" id="bil_to"> 
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
                                    <div class="col-md-4">
                                        <div class="card card-success">
                                            <div class="card-header" data-bs-toggle="collapse" data-bs-target="#pic_to">
                                                <h3 class="card-title">Pick Up <i class="bx bx-plus"></i></h3>
                                            </div>
                                            <div class="card-body collapse" id="pic_to"> 
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
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-success">
                                            <div class="card-header" data-bs-toggle="collapse" data-bs-target="#drop">
                                                <h3 class="card-title">Drop <i class="bx bx-plus"></i></h3>
                                            </div>
                                            <div class="card-body collapse" id="drop"> 
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
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-primary  carier_details">
                                                    <div class="card-header" data-bs-toggle="collapse" data-bs-target="#carrrier_d">
                                                        <h3 class="card-title">Carrier Details <i class="bx bx-plus"></i></h3>
                                                    </div>
                                                    <div class="card-body collapse" id="carrrier_d">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                            <span id="carrier_status" class="error"></span>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm mb-3" name="carrier_mc" id="shipment_mc" autocomplete="off" placeholder="MC">
                                                                    <input type="hidden" name="carriers_id" id="carriers_id" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm mb-3" name="carrier_dot" id="carrier_dot" placeholder="DOT">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm mb-3" name="carrier_name" id="carrier_name" placeholder="Carrier Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm mb-3" name="dispatched" id="dispatched" placeholder="Dispatcher">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_phone" id="shipment_c_phone" placeholder="Phone">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
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
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card card-primary">
                                                    <div class="card-header" data-bs-toggle="collapse" data-bs-target="#carrrier_ins">
                                                        <h3 class="card-title">Carrier / Shipper Instruction <i class="bx bx-plus"></i></h3>
                                                    </div>
                                                    <div class="card-body collapse" id="carrrier_ins">
                                                        <div class="form-group">
                                                            <textarea search-data="carrier_instruction" class="form-control form-control-sm mb-3" rows="5" name="carrier_instruction" placeholder="Enter Carrier Instruction ..."></textarea>
                                                            <div class="shipment_instruction" id="carrier_instruction">
                                                                <li value="Driver is responsible for all shortage and damage">Driver is responsible for all shortage and damage</li>
                                                                <li value="Driver is responsible for any damage or mishandling of this load.Handle the load according to rate Conformation">Driver is responsible for any damage or mishandling of this load.Handle the load according to rate Conformation.</li>
                                                                <li value="Driver is responsible for any damage or mishandling of this load. Driver may ask for detention and that would be $30 after 3 hour  TONU $50 fix for same day cancellation">Driver is responsible for any damage or mishandling of this load. driver may ask for detention and that would be $30 after 3 hour  TONU $50 fix for same day cancellation</li>
                                                                <li value="Driver is responsible for any damage or mishandling of this load, damages or rejections load will not be paid.">Driver is responsible for any damage or mishandling of this load.damages or rejections load will not be paid</li>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <textarea search-data="shipper_instruction" class="form-control form-control-sm mb-3" rows="5" name="shipper_instruction" placeholder="Enter Shipper Instruction ..."></textarea>
                                                            <div class="shipment_instruction" id="shipper_instruction">
                                                                <li value="Shipper Instruction 1">Shipper Instruction</li>
                                                                <li value="Two Shipper Instruction 1">Two Shipper Instruction</li>
                                                                <li value="Three Shipper Instruction 1">Three Shipper Instruction</li>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--<div class="card card-primary">-->
                                                <!--    <div class="card-header" data-bs-toggle="collapse" data-bs-target="#shipper_ins">-->
                                                <!--        <h3 class="card-title">Shipper Instruction</h3>-->
                                                <!--    </div>-->
                                                <!--    <div class="card-body collapse" id="shipper_ins">-->
                                                <!--        <div class="form-group">-->
                                                <!--            <textarea class="form-control form-control-sm mb-3" rows="5" name="shipper_instruction" placeholder="Enter Instruction ..."></textarea>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card card-primary shipper_carrier_rates">
                                                    <div class="card-header" data-bs-toggle="collapse" data-bs-target="#Rates">
                                                        <h3 class="card-title">Shipper/Carrier Rates <i class="bx bx-plus"></i></h3>
                                                    </div>
                                                    <div class="card-body collapse" id="Rates">
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
                                                                    <td><input type="text" name="transportation1" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td>
                                                                        <!--<input type="text" name="line_haul1" placeholder="Lumper" value="" class="form-control form-control-sm mb-3">-->
                                                                        <select name="line_haul1" class="form-control form-control-sm mb-3">
                                                                            <option value="FSC">FSC</option>
                                                                        </select>
                                                                    </td>
                                                                    <td><input type="text" name="carrier1" id="carrier1" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td class="checkbox"></td>
                                                                    <td><input type="text" value="" name="customer1" id="customer1" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="transportation2" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td>
                                                                        <!--<input type="text" name="line_haul2" placeholder="Gate Fees" value="" class="form-control form-control-sm mb-3">-->
                                                                        <select name="line_haul1" class="form-control form-control-sm mb-3">                          <option value="Chassis">Chassis</option>
                                                                        </select>    
                                                                    </td>
                                                                    <td><input type="text" name="carrier2" id="carrier2" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td class="checkbox"></td>
                                                                    <td><input type="text" id="customer2" name="customer2" value="" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
                                                                <tr class="repeater" id="repeater">
                                                                    <td><input type="text" name="transportation3" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td>
                                                                        <!--<input type="text" name="line_haul3" value="" class="form-control form-control-sm mb-3">-->
                                                                        <select name="line_haul1" class="form-control form-control-sm mb-3">                              <option value="Split Chassis">Split Chassis</option>
                                                                        </select>    
                                                                    </td>
                                                                    <td><input type="text" name="carrier3" id="carrier3" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td class="checkbox"></td>
                                                                    <td><input type="text" id="customer3" name="customer3" value="" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
                                                                    <!--<table class="table addCusRate carier_rate more_option" style="margin-top:-15px;">-->
                                                                    <tr class="hide_tr" id="repeater">
                                                                        <td><input type="text" name="transportation4" value="" class="form-control form-control-sm mb-3"></td>
                                                                        <td>
                                                                            <!--<input type="text" name="line_haul3" value="" class="form-control form-control-sm mb-3">-->
                                                                            <select name="line_haul1" class="form-control form-control-sm mb-3">                              <option value="Detention">Detention</option>
                                                                            </select>    
                                                                        </td>
                                                                        <td><input type="text" name="carrier4" id="carrier3" value="" class="form-control form-control-sm mb-3"></td>
                                                                        <td class="checkbox"></td>
                                                                        <td><input type="text" id="customer4" name="customer3" value="" class="form-control form-control-sm mb-3"></td>
                                                                    </tr>
                                                                    
                                                                    <tr class="hide_tr" id="repeater">
                                                                        <td><input type="text" name="transportation5" value="" class="form-control form-control-sm mb-3"></td>
                                                                        <td>
                                                                            <!--<input type="text" name="line_haul3" value="" class="form-control form-control-sm mb-3">-->
                                                                            <select name="line_haul1" class="form-control form-control-sm mb-3">                              <option value="Storage">Storage</option>
                                                                            </select>    
                                                                        </td>
                                                                        <td><input type="text" name="carrier5" id="carrier3" value="" class="form-control form-control-sm mb-3"></td>
                                                                        <td class="checkbox"></td>
                                                                        <td><input type="text" id="customer5" name="customer3" value="" class="form-control form-control-sm mb-3"></td>
                                                                    </tr>
                                                                    
                                                                    <tr class="hide_tr" id="repeater">
                                                                        <td><input type="text" name="transportation6" value="" class="form-control form-control-sm mb-3"></td>
                                                                        <td>
                                                                            <!--<input type="text" name="line_haul3" value="" class="form-control form-control-sm mb-3">-->
                                                                            <select name="line_haul1" class="form-control form-control-sm mb-3">                              <option value="Pre-pull">Pre-pull</option>
                                                                            </select>    
                                                                        </td>
                                                                        <td><input type="text" name="carrier6" id="carrier3" value="" class="form-control form-control-sm mb-3"></td>
                                                                        <td class="checkbox"></td>
                                                                        <td><input type="text" id="customer6" name="customer3" value="" class="form-control form-control-sm mb-3"></td>
                                                                    </tr>
                                                                    
                                                                    <tr class="hide_tr" id="repeater">
                                                                        <td><input type="text" name="transportation7" value="" class="form-control form-control-sm mb-3"></td>
                                                                        <td>
                                                                            <!--<input type="text" name="line_haul3" value="" class="form-control form-control-sm mb-3">-->
                                                                            <select name="line_haul1" class="form-control form-control-sm mb-3">                              <option value="Lumper">Lumper</option>
                                                                            </select>    
                                                                        </td>
                                                                        <td><input type="text" name="carrier7" id="carrier3" value="" class="form-control form-control-sm mb-3"></td>
                                                                        <td class="checkbox"></td>
                                                                        <td><input type="text" id="customer7" name="customer3" value="" class="form-control form-control-sm mb-3"></td>
                                                                    </tr>
                                                                    
                                                                    <tr class="hide_tr" id="repeater">
                                                                        <td><input type="text" name="transportation8" value="" class="form-control form-control-sm mb-3"></td>
                                                                        <td>
                                                                            <!--<input type="text" name="line_haul3" value="" class="form-control form-control-sm mb-3">-->
                                                                            <select name="line_haul1" class="form-control form-control-sm mb-3">                              <option value="GateFee">GateFee</option>
                                                                            </select>    
                                                                        </td>
                                                                        <td><input type="text" name="carrier8" id="carrier3" value="" class="form-control form-control-sm mb-3"></td>
                                                                        <td class="checkbox"></td>
                                                                        <td><input type="text" id="customer8" name="customer3" value="" class="form-control form-control-sm mb-3"></td>
                                                                    </tr>
                                                                <tr>
                                                                    <td colspan="5"><span class="moreoption"><span>More</span> <i class="bx bx-plus"></i></span></td>
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
                                            <div class="col-md-12">
                                                <div class="card card-primary documents_upload">
                                                    <div class="card-header" id="documents_toggle">
                                                        <h3 class="card-title plus">Documents <i class="bx bx-plus"></i></h3>
                                                    </div>
                                                    <div class="card-body" id="shipment_documents">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <p><strong>There are no decuments associated with this load. Please Choose file to add a document.</strong></p>
                                                            </div>
                                            <!--                <div class="col-md-6">-->
                                            <!--                    <div class="card card-primary">-->
                                            <!--                        <div class="card-body">-->
                                                                        
                                            <!--                            <div class="form-group">-->
                                            <!--                                <label for="shipper_files">Shipper DOC</label>-->
                                            <!--                                <input type="file" name="shipper_files[]" id="shipper_files" multiple="" accept="application/pdf">-->
                                            <!--                                <img src="https://crmonline.co.in/public/backend/assets/images/doc.png">-->
                                            <!--                            </div>-->
                                            <!--                            <div class="form-group">-->
                                            <!--                                <label>Upload POD</label>-->
                                            <!--                                <input type="file" name="pod_files[]" id="pod_files" multiple="" accept="application/pdf">-->
                                            <!--                                <img src="https://crmonline.co.in/public/backend/assets/images/doc.png">-->
                                            <!--                            </div>-->
                                                                        
                                            <!--                        </div>-->
                                            <!--                    </div>-->
                                            <!--                </div>-->
                                            <!--<div class="col-md-6">-->
                                            <!--    <div class="card card-primary">-->
                                            <!--        <div class="card-body">-->
                                            <!--            <div class="form-group">-->
                                            <!--                <label> Lumper Documents</label>-->
                                            <!--                <input type="file" name="shipper_files[]" id="fUpload" multiple="" accept="application/pdf">-->
                                            <!--                <img src="https://crmonline.co.in/public/backend/assets/images/doc.png">-->
                                            <!--            </div>-->
                                            <!--            <div class="form-group">-->
                                            <!--                <label>Gate Fees</label>-->
                                            <!--                <input type="file" name="carrier_files[]" id="fUpload1" multiple="multiple" accept="application/pdf">-->
                                            <!--                <img src="https://crmonline.co.in/public/backend/assets/images/doc.png">-->
                                            <!--            </div>-->
                                            <!--        </div>-->
                                            <!--    </div>-->
                                            <!--</div>-->
                                            
                                            <div class="col-md-6">
                                                            <div class="card card-primary">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label> Select Option</label>
                                                                        <select class="form-control" style="border: solid 1px #00000036; padding: 7px 10px; border-radius: 3px;" id="ship_doc_select">
                                                                            <option selected disabled>- Select -</option>
                                                                            <option value="shipper_files">Shipper Doc</option>
                                                                            <option value="pod_files">POD</option>
                                                                            <option value="lumper_files">Lumper DOC</option> 
                                                                            <option value="gate_fees">Gate Fees</option> 
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="card card-primary">
                                                                <div class="card-body">
                                                                    <div class="form-group">
                                                                        <label>Documents</label>
                                                                        <input class="form-control" type="file" name="" id="ship_doc_file" multiple="" accept="application/pdf" style="border: solid 1px #00000036 !important; padding: 7px 10px; border-radius: 3px;">	</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                    
                                    
                                        </div>
                                    </div>
                                    
                                    </div>

                                    <div class="row">
                                        
                                    </div>

                                    <button class="btn btn-primary" id="submit">Create Shipment</button>
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
<form id="1">
    <input type="hidden" value="Address 1" id="address">
</form>
<form id="2">
    <input type="hidden" value="Address 2" id="address">
</form>
<script>
    $(document).ready(function(){
        $("textarea").keyup(function(){
            var search_data = $(this).attr('search-data');
            $("#"+search_data).fadeIn();
            
            var value = $(this).val().toLowerCase();
            $("#"+search_data+" li").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        })
        $("div#carrier_instruction li").click(function(){
            $('textarea[search-data="carrier_instruction"]').val($(this).attr('value'));
            $("div#carrier_instruction").fadeOut();
        })
        $("body").click(function(){
            $(".shipment_instruction").fadeOut();
        })
        
    })
    var count_total = 0;
    function add_new(){
        $("tr#repeater").after('<tr class="repeater" id="remove_'+count_total+'"><td><input type="text" name="transportation3" value="" class="form-control form-control-sm mb-3"></td><td><input type="text" name="line_haul3" value="" class="form-control form-control-sm mb-3"></td><td><input type="text" name="carrier3" id="carrier3" value="" class="form-control form-control-sm mb-3"></td><td class="checkbox"><input type="checkbox" class="form-check-input" name=""></td><td><input type="text" id="customer3" name="customer3" value="" class="form-control form-control-sm mb-3" style="width: 74px;"> <button type="button" class="add-new remove" onclick="remove_new('+count_total+')"><i class="bx bx-minus"></i></button></td></tr>');
        count_total++;
    }
    
    function remove_new(removeid){
        $("#remove_"+removeid).remove();
    }
    
    $("#documents_toggle").click(function(){
        $("div#shipment_documents").slideToggle();
    })
    
    $('#shipper_name').select2();
    
    $("select#shippment_name").change(function(){
        var findid = $("#shippment_name option:selected").attr('data-id');
        var data = $("form#"+findid).find("#address").val();
        $("input#shipperaddress").val(data);
    })
    
    $(document).ready(function(){
        $("button#submit").click(function(){
            $("div#pic_to, div#drop, div#carrrier_d").slideDown();
        })
    })
   
</script>

@include('backend.common.footer')
@endsection


