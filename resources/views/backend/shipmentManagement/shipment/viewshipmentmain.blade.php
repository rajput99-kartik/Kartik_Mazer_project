@extends('backend.layouts.master')
@section('title','View Shipment')
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
    td.greeninput input {
        color: green !important;
    }
    td.redinput input {
        color: red !important;
    }
    .doc img {
        position: unset !important;
        width: 50px !important;
    }
    
</style>

<style>
        
    element.style {
    }
    .card-header:first-child {
        border-radius: var(--bs-card-inner-border-radius) var(--bs-card-inner-border-radius) 0 0;
    }
    .card-header {
        background-color: #e4e5e6;
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

        @if ($message = Session::get('errors'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
        @endif

        <ul class="nav nav-tabs">
            @can('shipment-all')
            <li class="pending_approval"><a href="{{url('/admin/shipment/list')}}" data-toggle="tab" aria-expanded="true">All Shipments</a>
            </li>
            @endcan
            @can('shipment-create')
            <li class="pending_approval"><a href="{{url('/admin/shipment')}}" data-toggle="tab" aria-expanded="true">Shipments</a>
            </li>
            <li class="pending_approval"><a href="{{url('/admin/create-shipment')}}" data-toggle="tab" aria-expanded="true">Create Shipments</a>
            </li>
            @endcan
            <li class="pending_approval active"><a href="#" data-toggle="tab" aria-expanded="true">View Shipments</a>
            </li>
            
        </ul>
        
        <!--pic & deop model-->
        
            {{-- <div class="modal fade" id="PickDropSection" data-bs-keyboard="false" data-bs-backdrop="static">
            </div> --}}
        
        <!--end model-->

        

       @php
        //    dd( $shipmentData);
       @endphp
     
        <div class="row">

                <div class="col-3 mt-5 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-1">Shipment Details</h6>
                                </div>
                            
                            </div>
                        </div>
                        <div class="product-list  mb-3">
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2  ">
                                    <div class="">
                                     
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Reference ID</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0 fw-bold">{{ $shipmentData->ref_loads}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Load Status</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">{{$shipmentData->shipment_statue}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                       
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Equipment Type </h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0 fw-bold">{{$shipmentData->equipment_loads}}</h6>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Load Type</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">{{$shipmentData->full_partial}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                       
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Commodity weight</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">{{$shipmentData->weight_loads}} lbs</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        <img src="assets/images/products/10.png" width="50" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Length</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">{{$shipmentData->footage_loads}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        <img src="assets/images/products/10.png" width="50" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Shipper Name:</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">{{$shipmentData->customer_name}} {{$shipmentData->customer_c_name}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        <img src="assets/images/products/10.png" width="50" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Shipper Address </h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">$49K.00</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        <img src="assets/images/products/10.png" width="50" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Shipper Phone</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">$49K.00</h6>
                                    </div>
                                </div>
                              
                                {{-- <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        <img src="assets/images/products/10.png" width="50" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Light Chair</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">$49K.00</h6>
                                    </div>
                                </div>
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                               --}}
                                
                            </div>                           

                        </div>
                    </div>
                </div>
                <div class="col-3 mt-5 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-1">Billing Details</h6>
                                </div>
                                
                            </div>
                        </div>
                        <div class="product-list  mb-3">
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                     
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Yellow Tshirt</h6>
                                        <p class="mb-0">278 Sales</p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">$24K.00</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                       
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Titan Watch </h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">$35K.00</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Red Sofa</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">$54K.00</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                       
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">iPhone Pro 7</h6>
                                        <p class="mb-0">450 Sales</p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">$86K.00</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2     ">
                                    <div class="">
                                        <img src="assets/images/products/10.png" width="50" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Light Chair</h6>
                                        <p class="mb-0">345 Sales</p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">$49K.00</h6>
                                    </div>
                                </div>
                                
                            </div>                           

                        </div>
                    </div>
                </div>
                {{-- <div class="col mt-5 d-flex">
                    <div class="card radius-10 w-100 overflow-hidden">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-0">Social Leads</h6>
                                </div>
                                <div class="dropdown options ms-auto">
                                    <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                    
                                    </div>
                                    <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                    <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="social-leads">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="widgets-icons-small text-white bg-facebook"><i class='bx bxl-facebook-circle' ></i></div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Facebook</h6>
                                        <p class="mb-0">175</p>
                                    </div>
                                    <div class="">45%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                                </div>
                                <hr>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="widgets-icons-small text-white bg-google"><i class='bx bxl-google' ></i></div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Google</h6>
                                        <p class="mb-0">960</p>
                                    </div>
                                    <div class="">24%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                                </div>
                                <hr>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="widgets-icons-small text-white bg-twitter"><i class='bx bxl-twitter'></i></div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Twitter</h6>
                                        <p class="mb-0">245</p>
                                    </div>
                                    <div class="">53%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                                </div>
                                <hr>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="widgets-icons-small text-white bg-linkedin"><i class='bx bxl-linkedin' ></i></div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Linkedin</h6>
                                        <p class="mb-0">784</p>
                                    </div>
                                    <div class="">10%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                                </div>
                                <hr>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="widgets-icons-small text-white bg-dribbble"><i class='bx bxl-dribbble' ></i></div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Dribbble</h6>
                                        <p class="mb-0">568</p>
                                    </div>
                                    <div class="">15%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                                </div>
                                <hr>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="widgets-icons-small text-white bg-behance"><i class='bx bxl-behance' ></i></div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Behance</h6>
                                        <p class="mb-0">790</p>
                                    </div>
                                    <div class="">22%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div> --}}
            
            {{-- <div class="col-xl-12 mx-auto">
                <div class="card  border-primary shipper_caont">
                    <div class="row">
                    <div class="shipment-status">
                        <div class="load-no">
                            <p>Load No: <span>#{{ $shipmentData->id }}</span></p>
                        </div>
                        <div class="status">
                            <p>Status: <span>{{ $shipmentData->shipment_statue }}</span></p>
                        </div>
                    </div>
                    @php
                    $companie = App\Models\Company::where('id', $shipmentData->companies_id)->first();
                    if($companie->pre_pay == '1'){
                        $value = 'Pre-pay';
                        $Limit = $companie->un_secured_limit;
                    }else{
                        $value = 'Limit';
                        $Limit = $companie->credit_limit;
                    }
                    @endphp
                    @if($companie)
                    <div class="shipment-status limit">
                        <div class="load-no">
                            <p>{{$value}}# <span>{{ isset($Limit) ? $Limit : null }}</span></p>
                        </div>
                        <div class="shipper-limit-use">
                            @php
                            $companie_res = App\Models\Shipment::where('companies_id', $companie->id)->get();
                            $sum_Price = 0;
                             
                            foreach($companie_res as $companie_data){
                                if($companie_data->shipment_statue <> 'Paid'){ 
                                    $companie_data = App\Models\Shipmentrate::where('shipment_id', $companie_data->id)->first();
                                    $sum_Price += $companie_data->customer_total;
                                }
                            }
                            
                            @endphp
                            <p>Used limit: <span> {{ $sum_Price }} </span></p>
                        </div> 
                    </div>
                    @endif
                    
                    <div class="exampleScrollableModal" style="margin-left: 90%; margin-top: -50px;">
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal">Notes </button>
                    </div>
                    <!--Shipment Notes Model Start-->
                        <div class="col">
                            <!-- Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="exampleScrollableModal" tabindex="-1" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h6 class="modal-title">Shipment Notes</h6>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                                @php
                                                   $id =  Auth::id();
                                                @endphp
                                                <form action="{{url('admin/shipment/notes')}}" method="post">
                                                    <div class="col-md-12">
                                                        <div class="form-group shipment-more">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="title_type" placeholder="Title" value="" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group shipment-more">
                                                            <textarea class="form-control" id="inputAddress3" placeholder="Enter Description" rows="3" name="description" required></textarea>
                                                        </div>
                                                    </div>
                                                    
                                                    <input type="hidden" name="user_id" value="{{$id}}">
                                                    <input type="hidden" name="shipment_id" value="{{ $shipmentData->id}}">
                                                  

                                                    <div class="modal-footer">
                                                       

                                                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                    </div>

                                                </form>
                                              
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--end model-->
                </div>
                    <div class="card-body p-3 ">
						<div class="row g-3">
							<form action="{{url('admin/shipment-update')}}" id="sh ipmentupdate" method="POST" enctype="multipart/form-data" class="placeholder-form">  
								@csrf
								<div class="row">
                                    <div class="col-md-6">
                                        <div class="shipment-more-details card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Edit Shipment</h3>
                                                <!-- <h2 class="">Create Shipment</h2> -->
                                            </div>
        
                                            <div class="row card-body">
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="number" class="form-control form-control-sm mb-3" name="ref_no" placeholder="Ref" value="{{ $shipmentData->ref_loads }}" readonly>
                                                    </div>
                                                </div>
                                             
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <select class="form-control form-control-sm mb-3 select2" name="equipment_type" style="width: 100%;" >
                                                        <option selected value="<?php if(!empty($shipmentData->equipment_loads)){ echo $shipmentData->equipment_loads; } ?>"><?php echo $shipmentData->equipment_loads; ?></option>
                                                            <?php foreach($Equipments as $equipments_value){ ?>
                                                                <option value="<?php echo $equipments_value->equip_name; ?>"><?php echo $equipments_value->equip_name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="full_partial" placeholder="Full/Partial" value="{{ $shipmentData->full_partial }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="commodity_laod" placeholder="Commodity" value="{{ $shipmentData->commodity_laod }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="pieces_laod" placeholder="Pallat" value="{{ $shipmentData->pieces_laod }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="weight_loads" placeholder="Weight" value="{{ $shipmentData->weight_loads }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="declared_loads" placeholder="Declared Value" value="{{ $shipmentData->declared_loads }}">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <select name="mode" class="form-control form-control-sm mb-3">
                                                            <option value="Enter Mode" selected="">Select Mode</option>
                                                            <option value="OTR" <?php if($shipmentData->mode == 'OTR'){ echo 'selected'; } ?> >OTR</option>
                                                            <option value="Drayage" <?php if($shipmentData->mode == 'Drayage'){ echo 'selected'; } ?>>Drayage</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="footage_loads" placeholder="Length" value="{{ $shipmentData->footage_loads }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <select class="form-control form-control-sm mb-3" name="payment_mode" id="payment_mode">
                                                            <option disabled selected>Payment Mode</option>
                                                            <option value="USD" <?php if($shipmentData->payment_mode == 'USD'){ echo 'selected'; } ?>>USD</option>
                                                            <option value="CAD" <?php if($shipmentData->payment_mode == 'CAD'){ echo 'selected'; } ?>>CAD</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="temp_min" placeholder="Temp Min" value="{{ $shipmentData->temp_min }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="temp_max" placeholder="Temp Max" value="{{ $shipmentData->temp_max }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="temp_precool" placeholder="Temp Precool" value="{{ $shipmentData->temp_precool }}">
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
                                                               
																<option value="">{{ isset($shipmentComp->company_name) ? $shipmentComp->company_name : Null }}</option>

                                                            </select>
															<input type="hidden" id="shipment_id" name="shipment_id" value="{{ isset($shipmentData->id) ? $shipmentData->id : Null }}">
															<input type="hidden" id="companies_id" name="companies_id" value="{{ isset($shipmentData->companies_id) ? $shipmentData->companies_id : Null }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control " name="shipperaddress" id="shipperaddress" placeholder="Address" value="{{ isset($shipmentComp->address) ? $shipmentComp->address : Null }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shippercity" id="shippercity" placeholder="City"  readonly  value="{{ isset($shipmentComp->shipper_city) ? $shipmentComp->shipper_city : Null }}" >
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="shipperstate" id="shipperstate" placeholder="State" readonly value="{{ isset($shipmentComp->shipper_state) ? $shipmentComp->shipper_state : Null }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="shipperzip" id="shipperzip" placeholder="Zip" readonly value="{{ isset($shipmentComp->shipper_zipcode) ? $shipmentComp->shipper_zipcode : Null }}" >
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="shipperphone" id="shipperphone" placeholder="Phone" readonly value="{{ isset($shipmentComp->phone_number) ? $shipmentComp->phone_number : Null }}" >
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="customer_c_name" id="customer_c_name" placeholder="C Persone" readonly value="{{  isset($shipmentComp->contact_name) ? $shipmentComp->contact_name : Null}}" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Bill To</h3>
                                            </div>
                                            <div class="card-body"> 
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="billname" id="billname" placeholder="Name" value="{{ isset($shipmentData->b_customer_name) ? $shipmentData->b_customer_name : Null }}" >
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="billaddress" id="billaddress" placeholder="Address" value="{{isset( $shipmentData->b_customer_address) ?  $shipmentData->b_customer_address : Null }}" >
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="billcity" id="billcity" placeholder="City" value="{{ isset($shipmentData->b_customer_city) ? $shipmentData->b_customer_city : Null }}" >
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="billstate" id="billstate" placeholder="State" value="{{ isset($shipmentData->b_customer_state) ? $shipmentData->b_customer_state : Null }}" >
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="billzip" id="billzip" placeholder="Zip" value="{{ isset($shipmentData->b_customer_zip) ? $shipmentData->b_customer_zip : Null }}" >
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="billphone" id="billphone" placeholder="Phone" value="{{ isset($shipmentData->b_customer_phone) ? $shipmentData->b_customer_phone : Null }}" >
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="b_customer_c_name" id="b_customer_c_name" placeholder="C Persone" value="{{ isset($shipmentData->b_customer_c_name) ? $shipmentData->b_customer_c_name : Null }}" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Pick Up</h3>
                                            </div>
                                            <div class="card-body"> 
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickname" autocomplete="off" placeholder="Name" value=" <?php if(!empty($shipmentpick->p_name)){ echo $shipmentpick->p_name;} ?> ">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pickaddress" autocomplete="off" placeholder="Address" value="<?php if(!empty($shipmentpick->p_address)){ echo $shipmentpick->p_address; } ?>">
                                                </div>
                                                
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        {{-- <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="pickstate" autocomplete="off" placeholder="State" value="<?php // if(!empty($shipmentpick->p_state)){ echo $shipmentpick->p_state; } ?>">
                                                        </div> 

                                                            <?php 
                                                                $abc = DB::table('dat_states')->get();
                                                            ?>
                                                            <select class="form-control form-control-sm mb-3 select2" name="pickstate" style="width: 100%;" >
                                                                
                                                                <?php foreach($abc as $equipments_value){  ?>
                                                                    <option value="<?php echo $equipments_value->state; ?>" <?php if($shipmentpick->p_state == $equipments_value->state){ echo "selected"; } ?>><?php echo $equipments_value->state; ?></option>
                                                                <?php }  ?>
                                                            </select>
                                                    </div>

                                                    <div class="col-md-6">
                                                         <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="pickcity" autocomplete="off" placeholder="City" value="<?php if(!empty($shipmentpick->p_city)){ echo $shipmentpick->p_city; } ?>">
                                                        </div>



                                                            {{-- <?php 
                                                               // $acities = DB::table('dat_cities')->get();
                                                            ?>
                                                            <select class="form-control form-control-sm mb-3" name="pickcity" style="width: 100%;" >
                                                                
                                                                <?php //foreach($acities as $data){  ?>
                                                                    <option value="<?php //echo $data->city; ?>" 
                                                                        <?php //if($shipmentpick->p_city == $data->city)  { echo "selected"; } ?>
                                                                    >
                                                                    <?php// if(!empty($data->city)){ echo $data->city; } ?>
                                                                    </option>

                                                                <?php // }  ?>
                                                            </select> 


                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="pickzip" autocomplete="off" placeholder="Zip" value="<?php if(!empty($shipmentpick->p_zip)){ echo $shipmentpick->p_zip; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="p_ref" autocomplete="off" placeholder="PO#" value="<?php if(!empty($shipmentpick->p_ref)){ echo $shipmentpick->p_ref; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="p_contact" autocomplete="off" placeholder="Contact" value="<?php if(!empty($shipmentpick->p_contact)){ echo $shipmentpick->p_contact; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                         <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="pickphone" autocomplete="off" placeholder="Phone" value="<?php if(!empty($shipmentpick->p_phone)){ echo $shipmentpick->p_phone; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="pickemail" autocomplete="off" placeholder="Email" value="<?php if(!empty($shipmentpick->p_email)){ echo $shipmentpick->p_email; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" id="pickready" name="pickready" autocomplete="off" placeholder="Pick Date" value="<?php if(!empty($shipmentpick->p_ready)){ echo $shipmentpick->p_ready; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="picktime" autocomplete="off" placeholder="Time" value="<?php if(!empty($shipmentpick->p_rtime)){ echo $shipmentpick->p_rtime; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="p_appt_note" autocomplete="off" placeholder="Appt.Note" value="<?php if(!empty($shipmentpick->p_appt_note)){ echo $shipmentpick->p_appt_note; } ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card card-success">
                                            <div class="card-header">
                                                <h3 class="card-title">Drop</h3>
                                            </div>
                                            <div class="card-body"> 
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="dropname" autocomplete="off" placeholder="Name" value="<?php if(!empty($shipmentdrop->d_name)){ echo $shipmentdrop->d_name; } ?>">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="dropaddress" autocomplete="off" placeholder="Address" value="<?php if(!empty($shipmentdrop->d_address)){ echo $shipmentdrop->d_address; } ?>">
                                                </div>
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropcity" autocomplete="off" placeholder="City" value="<?php if(!empty($shipmentdrop->d_city)){ echo $shipmentdrop->d_city; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropstate" autocomplete="off" placeholder="State" value="<?php if(!empty($shipmentdrop->d_state)){ echo $shipmentdrop->d_state; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropzip" autocomplete="off" placeholder="Zip" value="<?php if(!empty($shipmentdrop->d_zip)){ echo $shipmentdrop->d_zip; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="d_ref" autocomplete="off" placeholder="PO#" value="<?php if(!empty($shipmentdrop->d_ref)){ echo $shipmentdrop->d_ref; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="d_contact" autocomplete="off" placeholder="Contact" value="<?php if(!empty($shipmentdrop->d_contact)){ echo $shipmentdrop->d_contact; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropphone" autocomplete="off" placeholder="Phone" value="<?php if(!empty($shipmentdrop->d_phone)){ echo $shipmentdrop->d_phone; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropemail" autocomplete="off" placeholder="Email" value="<?php if(!empty($shipmentdrop->d_email)){ echo $shipmentdrop->d_email; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="dropready" id="dropready" autocomplete="off" placeholder="Drop Date" value="<?php if(!empty($shipmentdrop->d_ready)){ echo $shipmentdrop->d_ready; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="droptime" autocomplete="off" placeholder="Time" value="<?php if(!empty($shipmentdrop->d_rtime)){ echo $shipmentdrop->d_rtime; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control form-control-sm mb-3" name="d_appt_note" autocomplete="off" placeholder="Appt.Note" value="<?php if(!empty($shipmentdrop->d_appt_note)){ echo $shipmentdrop->d_appt_note; } ?>">
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
                                                    <div class="card-header">
                                                        <h3 class="card-title">Carrier Details</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <span id="carrier_status" class="error"></span>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm mb-3" name="carrier_mc" id="shipment_mc" autocomplete="off" placeholder="MC" value="{{ $shipmentData->shipment_c_mc }}">
                                                                    <input type="hidden" name="carrier_id" id="carriers_id" value="{{ isset($shipmentData->carrier_id ) ? $shipmentData->carrier_id : null }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm mb-3" name="carrier_dot" id="carrier_dot" placeholder="DOT" value="{{ isset($shipmentData->shipment_c_dot) ? $shipmentData->shipment_c_dot : Null }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm mb-3" name="carrier_name" id="carrier_name" placeholder="Carrier Name" value="{{ isset($shipmentData->shipment_c_carrier) ? $shipmentData->shipment_c_carrier : Null }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm mb-3" name="dispatched" id="dispatched" placeholder="Dispatcher" value="{{ isset($shipmentData->shipment_c_dispatcher) ? $shipmentData->shipment_c_dispatcher : Null }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_phone" id="shipment_c_phone" placeholder="Phone" value="{{ isset($shipmentData->shipment_c_phone) ? $shipmentData->shipment_c_phone : Null }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_email" id="shipment_c_email" placeholder="Email" value="{{ isset($shipmentData->shipment_c_email) ? $shipmentData->shipment_c_email : Null }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_driver_n" id="shipment_c_driver_n" placeholder="Driver N" value="{{ isset($shipmentData->shipment_c_driver_n) ? $shipmentData->shipment_c_driver_n : Null }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_driver_p" id="shipment_c_driver_p" placeholder="Phone" value="{{ isset($shipmentData->shipment_c_driver_p) ? $shipmentData->shipment_c_driver_p : Null }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="card card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Carrier Instruction</h3>
                                                    </div>
                                                    <div class="card-body" id="carrrier_ins">
                                                        <div class="form-group">
                                                            <textarea search-data="carrier_instruction" class="form-control form-control-sm mb-3" rows="5" name="carrier_instruction" placeholder="Enter Instruction ..." value="" >{{ isset($shipmentData->shipment_carrier_instruction) ? $shipmentData->shipment_carrier_instruction : Null }}</textarea>
                                                            <div class="shipment_instruction" id="carrier_instruction">
                                                                <li value="Driver is responsible for all shortage and damage">Driver is responsible for all shortage and damage</li>
                                                                <li value="Driver is responsible for any damage or mishandling of this load.Handle the load according to rate Conformation">Driver is responsible for any damage or mishandling of this load.Handle the load according to rate Conformation.</li>
                                                                <li value="Driver is responsible for any damage or mishandling of this load. Driver may ask for detention and that would be $30 after 3 hour  TONU $50 fix for same day cancellation">Driver is responsible for any damage or mishandling of this load. driver may ask for detention and that would be $30 after 3 hour  TONU $50 fix for same day cancellation</li>
                                                                <li value="Driver is responsible for any damage or mishandling of this load, damages or rejections load will not be paid.">Driver is responsible for any damage or mishandling of this load.damages or rejections load will not be paid</li>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Shipper Instruction</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-group">
                                                            <textarea search-data="shipper_instruction" class="form-control form-control-sm mb-3" rows="5" name="shipper_instruction" placeholder="Enter Instruction ..." value="" >{{ isset($shipmentData->shipment_shipper_instruction) ? $shipmentData->shipment_shipper_instruction : Null }}</textarea>
                                                            <div class="shipment_instruction" id="shipper_instruction">
                                                                <li value="Driver is responsible for all shortage and damage">Driver is responsible for all shortage and damage</li>
                                                                <li value="Driver is responsible for any damage or mishandling of this load.Handle the load according to rate Conformation">Driver is responsible for any damage or mishandling of this load.Handle the load according to rate Conformation</li>
                                                                <li value="Driver is responsible for any damage or mishandling of this load. Driver may ask for detention and that would be $30 after 3 hour  TONU $50 fix for same day cancellation">Driver is responsible for any damage or mishandling of this load. Driver may ask for detention and that would be $30 after 3 hour  TONU $50 fix for same day cancellation</li>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
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
                                                                    <td><input type="text" name="unit1_customer" value="<?php if(!empty($shipment_rates->unit1_customer)){ echo $shipment_rates->unit1_customer; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td style="width:10%" class="w75"><strong>Unit2</strong></td>
                                                                    <td style="width:12%"><input type="text" name="unit2_customer" value="<?php if(!empty($shipment_rates->unit2_customer)){ echo $shipment_rates->unit2_customer; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td style="width: 14%;" class="w75" style="width:12%"><strong>LH Rate</strong></td>
                                                                    <td style="width:12%"><input type="text" name="lh_customer" id="lh_customer" value="<?php if(!empty($shipment_rates->lh_customer)){ echo $shipment_rates->lh_customer; } ?>" class="form-control form-control-sm mb-3"></td>
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
                                                                    <td><input type="text" name="rate_unit1_carrier" value="<?php if(!empty($shipment_rates->rate_unit1_carrier)){ echo $shipment_rates->rate_unit1_carrier; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td style="width:10%" class="w75"><strong>Unit2</strong></td>
                                                                    <td style="width:12%"><input type="text" name="rate_unit2_carrier" value="<?php if(!empty($shipment_rates->rate_unit2_carrier)){ echo $shipment_rates->rate_unit2_carrier; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td style="width: 14%;" class="w75" style="width:12%"><strong>LH Rate</strong></td>
                                                                    <td style="width:12%"><input type="text" name="lh_carrier" id="lh_carrier" value="<?php if(!empty($shipment_rates->lh_carrier)){ echo $shipment_rates->lh_carrier; } ?>" class="form-control form-control-sm mb-3">
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
                                                                    <th style="width:20%">Carrier Sr. No</th>
                                                                    <th style="width:20%">Accessorial</th>
                                                                    <th style="width:25%">Carrier Rate</th>
                                                                    <th style="width:15%"></th>
                                                                    <th style="width:20%">Customer Rates</th>
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td><input type="text" name="transportation1" value="<?php if(!empty($shipment_rates->transportation1)){ echo $shipment_rates->transportation1; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td>
                                                                        <!--<input type="text" name="line_haul1" placeholder="Lumper" value="<?php //if(!empty($shipment_rates->line_haul1)){ echo $shipment_rates->line_haul1; } ?>" class="form-control form-control-sm mb-3">-->
                                                                        <select name="line_haul1" class="form-control form-control-sm mb-3">
                                                                            <option value=""></option>    
                                                                            <option value="FSC" <?php if(!empty($shipment_rates->line_haul1)){ echo 'selected'; } ?> > FSC</option>
                                                                            <!-- <option value="Chassis">Chassis</option>
                                                                            <option value="Split Chassis">Split Chassis</option>
                                                                            <option value="Detention">Detention</option>
                                                                            <option value="Storage">Storage</option>
                                                                            <option value="Lumper">Lumper</option> -->
                                                                        </select>    
                                                                    </td>
                                                                    <td class="redinput"><input type="text" name="carrier1" id="carrier1" value="<?php if(!empty($shipment_rates->carrier1)){ echo $shipment_rates->carrier1; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td class="checkbox"></td>
                                                                    <td class="greeninput"><input type="text" value="<?php if(!empty($shipment_rates->customer1)){ echo $shipment_rates->customer1; } ?>" name="customer1" id="customer1" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" name="transportation2" value="<?php if(!empty($shipment_rates->transportation2)){ echo $shipment_rates->transportation2; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td>
                                                                        <!-- <input type="text" name="line_haul2" placeholder="" value="<?php if(!empty($shipment_rates->line_haul2)){ echo $shipment_rates->line_haul2; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                        <select name="line_haul2" class="form-control form-control-sm mb-3">
                                                                            <option value=""></option>
                                                                            <option value="Chassis" <?php if(!empty($shipment_rates->line_haul2)){ echo 'selected'; } ?>>Chassis</option>
                                                                        </select>
                                                                    </td>
                                                                    <td class="redinput"><input type="text" name="carrier2" id="carrier2" value="<?php if(!empty($shipment_rates->carrier2)){ echo $shipment_rates->carrier2; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td class="checkbox"></td>
                                                                    <td class="greeninput"><input type="text" id="customer2" name="customer2" value="<?php if(!empty($shipment_rates->customer2)){ echo $shipment_rates->customer2; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
																<tr>
                                                                    <td><input type="text" name="transportation3" value="<?php if(!empty($shipment_rates->transportation3)){ echo $shipment_rates->transportation3; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td>
                                                                        <!-- <input type="text" name="line_haul3" placeholder="" value="<?php if(!empty($shipment_rates->line_haul3)){ echo $shipment_rates->line_haul3; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                        <select name="line_haul3" class="form-control form-control-sm mb-3">
                                                                            <option value=""></option>
                                                                            <option value="Split Chassis" <?php if(!empty($shipment_rates->line_haul3)){ echo 'selected'; } ?>>Split Chassis</option>
                                                                            
                                                                        </select>    
                                                                    </td>
                                                                    <td class="redinput"><input type="text" name="carrier3" id="carrier3" value="<?php if(!empty($shipment_rates->carrier3)){ echo $shipment_rates->carrier3; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td class="checkbox"></td>
                                                                    <td class="greeninput"><input type="text" id="customer3" name="customer3" value="<?php if(!empty($shipment_rates->customer3)){ echo $shipment_rates->customer3; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
																<tr class="hide_tr">
                                                                    <td><input type="text" name="transportation4" value="<?php if(!empty($shipment_rates->transportation4)){ echo $shipment_rates->transportation4; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td>
                                                                        <!-- <input type="text" name="line_haul4" placeholder="" value="<?php if(!empty($shipment_rates->line_haul4)){ echo $shipment_rates->line_haul4; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                        <select name="line_haul4" class="form-control form-control-sm mb-3">
                                                                            <option value=""></option>
                                                                            <option value="Detention" <?php if(!empty($shipment_rates->line_haul4)){ echo 'selected'; } ?>>Detention</option>
                                                                            
                                                                        </select>
                                                                    </td>
                                                                    <td class="redinput"><input type="text" name="carrier4" id="carrier4" value="<?php if(!empty($shipment_rates->carrier4)){ echo $shipment_rates->carrier4; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td class="checkbox"></td>
                                                                    <td class="greeninput"><input type="text" id="customer4" name="customer4" value="<?php if(!empty($shipment_rates->customer4)){ echo $shipment_rates->customer4; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
																<tr class="hide_tr">
                                                                    <td><input type="text" name="transportation5" value="<?php if(!empty($shipment_rates->transportation5)){ echo $shipment_rates->transportation5; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td>
                                                                        <!-- <input type="text" name="line_haul5" placeholder="" value="<?php if(!empty($shipment_rates->line_haul5)){ echo $shipment_rates->line_haul5; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                        <select name="line_haul5" class="form-control form-control-sm mb-3">
                                                                            <option value=""></option>
                                                                            <option value="Storage" <?php if(!empty($shipment_rates->line_haul5)){ echo 'selected'; } ?>>Storage</option>
                                                                            
                                                                        </select>
                                                                    </td>
                                                                    <td class="redinput"><input type="text" name="carrier5" id="carrier5" value="<?php if(!empty($shipment_rates->carrier5)){ echo $shipment_rates->carrier5; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td class="checkbox"></td>
                                                                    <td class="greeninput"><input type="text" id="customer5" name="customer5" value="<?php if(!empty($shipment_rates->customer5)){ echo $shipment_rates->customer5; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
																<tr class="hide_tr">
                                                                    <td>
                                                                        <input type="text" name="transportation6" value="<?php if(!empty($shipment_rates->transportation6)){ echo $shipment_rates->transportation6; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td>
                                                                        <!-- <input type="text" name="line_haul6" placeholder="" value="<?php if(!empty($shipment_rates->line_haul6)){ echo $shipment_rates->line_haul6; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                        <select name="line_haul6" class="form-control form-control-sm mb-3">
                                                                            <option value=""></option>
                                                                            <option value="Pre-pull" <?php if(!empty($shipment_rates->line_haul6)){ echo 'selected'; } ?>>Pre-pull</option>
                                                                            
                                                                        </select>
                                                                    </td>
                                                                    <td class="redinput"><input type="text" name="carrier6" id="carrier6" value="<?php if(!empty($shipment_rates->carrier6)){ echo $shipment_rates->carrier6; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td class="checkbox"></td>
                                                                    <td class="greeninput"><input type="text" id="customer6" name="customer6" value="<?php if(!empty($shipment_rates->customer6)){ echo $shipment_rates->custome6; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
                                                                <tr class="hide_tr">
                                                                    <td>
                                                                        <input type="text" name="transportation7" value="<?php if(!empty($shipment_rates->transportation7)){ echo $shipment_rates->transportation7; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td>
                                                                        <!-- <input type="text" name="line_haul7" placeholder="" value="<?php if(!empty($shipment_rates->line_haul7)){ echo $shipment_rates->line_haul7; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                        <select name="line_haul7" class="form-control form-control-sm mb-3">
                                                                            <option value=""></option>
                                                                            <option value="Lumper" <?php if(!empty($shipment_rates->line_haul7)){ echo 'selected'; } ?>>Lumper</option>
                                                                            
                                                                        </select>
                                                                    </td>
                                                                    <td class="redinput"><input type="text" name="carrier7" id="carrier7" value="<?php if(!empty($shipment_rates->carrier7)){ echo $shipment_rates->carrier7; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td class="checkbox"></td>
                                                                    <td class="greeninput"><input type="text" id="customer7" name="customer7" value="<?php if(!empty($shipment_rates->customer7)){ echo $shipment_rates->custome7; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                </tr>
                                                                <tr class="hide_tr">
                                                                    <td>
                                                                        <input type="text" name="transportation8" value="<?php if(!empty($shipment_rates->transportation8)){ echo $shipment_rates->transportation8; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td>
                                                                        <!-- <input type="text" name="line_haul8" placeholder="" value="<?php if(!empty($shipment_rates->line_haul8)){ echo $shipment_rates->line_haul8; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                        <select name="line_haul8" class="form-control form-control-sm mb-3">
                                                                            <option value=""></option>
                                                                            <option value="GateFee" <?php if(!empty($shipment_rates->line_haul8)){ echo 'selected'; } ?>>GateFee</option>
                                                                            
                                                                        </select>
                                                                    </td>
                                                                    <td class="redinput"><input type="text" name="carrier8" id="carrier8" value="<?php if(!empty($shipment_rates->carrier6)){ echo $shipment_rates->carrier8; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                    <td class="checkbox"></td>
                                                                    <td class="greeninput"><input type="text" id="customer8" name="customer8" value="<?php if(!empty($shipment_rates->customer8)){ echo $shipment_rates->custome8; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                </tr class="hide_tr">
                                                                <tr>
                                                                    <td colspan="5"><span class="moreoption"><span>More</span> <i class="bx bx-plus"></i></span></td>
                                                                </tr>
                                                                <!--tr class="repeater" id="repeater">
                                                                    <td><input type="text" name="transportation3" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="text" name="line_haul3" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td><input type="text" name="carrier3" id="carrier3" value="" class="form-control form-control-sm mb-3"></td>
                                                                    <td class="checkbox"><input type="checkbox" class="form-check-input" name=""></td>
                                                                    <td><input type="text" id="customer3" name="customer3" value="" class="form-control form-control-sm mb-3" style="width: 74px;"> <button type="button" class="add-new" onclick="add_new()"><i class="bx bx-plus"></i></button></td>
                                                                </tr -->
                                                                <tr>
                                                                    <td><strong>Carrier Total </strong></td>
                                                                    <td><input type="text" name="carrier_total" data="<?php if(!empty($shipment_rates->carrier_total)){ echo $shipment_rates->carrier_total; } ?>" id="carrier_total" value="<?php if(!empty($shipment_rates->carrier_total)){ echo $shipment_rates->carrier_total; } ?>" class="form-control form-control-sm mb-3" readonly=""></td>
                                                                    <td><strong>Customer Total </strong></td>
                                                                    <td colspan="2"><input type="text" id="customer_total" name="customer_total" value="<?php if(!empty($shipment_rates->customer_total)){ echo '$'.$shipment_rates->customer_total; } ?>" class="form-control customer_total" readonly=""></td>
                                                                </tr>
                                                                
                                                                @php
                                                                $CarrierPayment = \App\Models\CarrierPayment::where('shipment_id',$shipmentData->id)->first();
                                                                @endphp

                                                                <tr>
                                                                    <td colspan="2">
                                                                        <label><b>QuickPay Deduction</b></label>
                                                                        <input class="form-control" type="number" name="quickpay_deduction" id="c_minus" value="{{ isset($shipment_rates->quickpay_deduction) ? $shipment_rates->quickpay_deduction : null }}" <?php if(!empty($CarrierPayment->quickpay_amount)){ echo 'readonly';  } ?> >
                                                                    </td>
                                                                    <td colspan="4">
                                                                        <label><b>QuickPay Total</b></label>
                                                                        <input type="number" class="form-control" id="quickpay_amount" name="quickpay_amount" value="{{ isset($shipment_rates->quickpay_amount) ? $shipment_rates->quickpay_amount : null }}" <?php if(!empty($CarrierPayment->quickpay_amount)){ echo 'readonly';  } ?>>
                                                                    </td>
                                                                    <!-- <input type="hidden" id="quickpay_amount" value=""> -->
                                                                </tr>
                                                                
                                                                <tr>
                                                                    <td style="display: none">
                                                                    <?php if(empty($CarrierPayment->quickpay_amount)){ ?>
                                                                    <button type="button" id="quickpay_request" class="btn btn-primary" value="{{isset($shipmentData->id) ? $shipmentData->id : null }}">QuickyPay</button>
                                                                    <?php }else{ echo '<span class="text text-success">QuickPay Sent</span>'; } ?>
                                                                
                                                                </td></tr>
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
                                                <div class="card-header" id="documents_toggle">
                                                    <h3 class="card-title plus">Documents <i class="bx bx-plus"></i></h3>
                                                </div>
                                                <div class="card-body" id="shipment_documents">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <p><strong>There are no decuments associated with this load. Please Choose file to add a document.</strong></p>
                                                        </div>
                                                        
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
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="ship_doc">
                                                                    
                                                                    @foreach($shipment_doc as $shipper_documnet)
                                                                        @if($shipper_documnet->type == 'shipper_doc')
                                                                            <div class="doc shipper_doc_id" value="{{ $shipper_documnet->id}}">
                                                                                <label>Shipper Doc</label>
                                                                                <a href="{{ url(BACKEND_COMMON_DOC.'/') }}{{ $shipper_documnet->document_name}}" target="_blank">
                                                                                    <img src="{{url('/public/backend/assets/images/doc.png')}}">
                                                                                    <a href="javascript:void(0)" id="Carrier_Doc_Del" ><i class="bx bx-trash"></i></a>
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach

                                                                    @foreach($shipment_doc as $shipper_documnet)
                                                                        @if($shipper_documnet->type == 'pod')
                                                                            <div class="doc shipper_doc_id" value="{{ $shipper_documnet->id}}">
                                                                                <label>POD</label>
                                                                                <a href="{{ url(BACKEND_COMMON_DOC.'/') }}{{ $shipper_documnet->document_name}}" target="_blank">
                                                                                    <img src="{{url('/public/backend/assets/images/doc.png')}}">
                                                                                    <a href="javascript:void(0)" id="Carrier_Doc_Del" ><i class="bx bx-trash"></i></a>
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach

                                                                    @foreach($shipment_doc as $shipper_documnet)
                                                                        @if($shipper_documnet->type == 'lumper')
                                                                            <div class="doc shipper_doc_id" value="{{ $shipper_documnet->id}}">
                                                                                <label>Lumper</label>
                                                                                <a href="{{ url(BACKEND_COMMON_DOC.'/') }}{{ $shipper_documnet->document_name}}" target="_blank">
                                                                                    <img src="{{url('/public/backend/assets/images/doc.png')}}">
                                                                                    <a href="javascript:void(0)" id="Carrier_Doc_Del" ><i class="bx bx-trash"></i></a>
                                                                                </a>
                                                                            </div>
                                                                        @endif
                                                                    @endforeach


                                                                    @foreach($shipment_doc as $shipper_documnet)
                                                                        @if($shipper_documnet->type == 'gate_fees')
                                                                            <div class="doc shipper_doc_id" value="{{ $shipper_documnet->id}}">
                                                                                <label>Gate Fees</label>
                                                                                <a href="{{ url(BACKEND_COMMON_DOC.'/') }}{{ $shipper_documnet->document_name}}" target="_blank">
                                                                                    <img src="{{url('/public/backend/assets/images/doc.png')}}">
                                                                                    <a href="javascript:void(0)" id="Carrier_Doc_Del" ><i class="bx bx-trash"></i></a>
                                                                                </a>
                                                                            </div>
                                                                        @endif 
                                                                    @endforeach
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>

                                   

								
							</form>
					
						</div>
					</div>
                    </div>
                </div>
            </div> --}}
        

        
            <div class="col-3 mt-5 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-1">Carrier Details</h6>
                            </div>
                        
                        </div>
                    </div>
                    <div class="product-list  mb-3">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2  ">
                                <div class="">
                                 
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Reference ID</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0 fw-bold">{{ $shipmentData->ref_loads}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Load Status</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->shipment_statue}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                   
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Equipment Type </h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0 fw-bold">{{$shipmentData->equipment_loads}}</h6>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Load Type</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->full_partial}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                   
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Commodity weight</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->weight_loads}} lbs</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Length</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->footage_loads}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Shipper Name:</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->customer_name}} {{$shipmentData->customer_c_name}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Shipper Address </h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$49K.00</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Shipper Phone</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$49K.00</h6>
                                </div>
                            </div>
                            
                        </div>                           

                    </div>
                </div>
            </div>
                <div class="col-3 mt-5 d-flex">
                    <div class="card radius-10 w-100">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h6 class="mb-1">Approver Details</h6>
                                </div>
                            
                            </div>
                        </div>
                        <div class="product-list  mb-3">
                            <div class="d-flex flex-column gap-3">
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2  ">
                                    <div class="">
                                     
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Reference ID</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0 fw-bold">{{ $shipmentData->ref_loads}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Load Status</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">{{$shipmentData->shipment_statue}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                       
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Equipment Type </h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0 fw-bold">{{$shipmentData->equipment_loads}}</h6>
                                    </div>
                                </div>
                                
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Load Type</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">{{$shipmentData->full_partial}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                       
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Commodity weight</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">{{$shipmentData->weight_loads}} lbs</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        <img src="assets/images/products/10.png" width="50" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Length</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">{{$shipmentData->footage_loads}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        <img src="assets/images/products/10.png" width="50" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Shipper Name:</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">{{$shipmentData->customer_name}} {{$shipmentData->customer_c_name}}</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        <img src="assets/images/products/10.png" width="50" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Shipper Address </h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">$49K.00</h6>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        <img src="assets/images/products/10.png" width="50" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Shipper Phone</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">$49K.00</h6>
                                    </div>
                                </div>
                              
                                {{-- <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                    <div class="">
                                        <img src="assets/images/products/10.png" width="50" alt="" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="mb-0">Light Chair</h6>
                                        <p class="mb-0"></p>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-0">$49K.00</h6>
                                    </div>
                                </div>
                              
                              
                              
                              
                              
                              
                              
                              
                              
                              
                               --}}
                                
                            </div>                           

                        </div>
                    </div>
                </div>
        </div>
        <!-- start new here  ****************************************-->
        <div class="row">

            <div class="col-3 mt-5 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-1">Shipment Details</h6>
                            </div>
                        
                        </div>
                    </div>
                    <div class="product-list  mb-3">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2  ">
                                <div class="">
                                 
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Reference ID</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0 fw-bold">{{ $shipmentData->ref_loads}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Load Status</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->shipment_statue}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                   
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Equipment Type </h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0 fw-bold">{{$shipmentData->equipment_loads}}</h6>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Load Type</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->full_partial}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                   
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Commodity weight</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->weight_loads}} lbs</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Length</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->footage_loads}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Shipper Name:</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->customer_name}} {{$shipmentData->customer_c_name}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Shipper Address </h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$49K.00</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Shipper Phone</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$49K.00</h6>
                                </div>
                            </div>
                            
                            {{-- 
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                             --}}
                            
                        </div>                           

                    </div>
                </div>
            </div>
            <div class="col-3 mt-5 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-1">Billing Details</h6>
                            </div>
                            
                        </div>
                    </div>
                    <div class="product-list  mb-3">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                 
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Yellow Tshirt</h6>
                                    <p class="mb-0">278 Sales</p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$24K.00</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                   
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Titan Watch </h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$35K.00</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Red Sofa</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$54K.00</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                   
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">iPhone Pro 7</h6>
                                    <p class="mb-0">450 Sales</p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$86K.00</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2     ">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Light Chair</h6>
                                    <p class="mb-0">345 Sales</p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$49K.00</h6>
                                </div>
                            </div>
                            
                        </div>                           

                    </div>
                </div>
            </div>
            {{-- <div class="col mt-5 d-flex">
                <div class="card radius-10 w-100 overflow-hidden">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Social Leads</h6>
                            </div>
                            <div class="dropdown options ms-auto">
                                <div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                                
                                </div>
                                <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="javascript:;">Action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Another action</a></li>
                                <li><a class="dropdown-item" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="social-leads">
                            <div class="d-flex align-items-center gap-3">
                                <div class="widgets-icons-small text-white bg-facebook"><i class='bx bxl-facebook-circle' ></i></div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Facebook</h6>
                                    <p class="mb-0">175</p>
                                </div>
                                <div class="">45%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widgets-icons-small text-white bg-google"><i class='bx bxl-google' ></i></div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Google</h6>
                                    <p class="mb-0">960</p>
                                </div>
                                <div class="">24%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widgets-icons-small text-white bg-twitter"><i class='bx bxl-twitter'></i></div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Twitter</h6>
                                    <p class="mb-0">245</p>
                                </div>
                                <div class="">53%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widgets-icons-small text-white bg-linkedin"><i class='bx bxl-linkedin' ></i></div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Linkedin</h6>
                                    <p class="mb-0">784</p>
                                </div>
                                <div class="">10%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widgets-icons-small text-white bg-dribbble"><i class='bx bxl-dribbble' ></i></div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Dribbble</h6>
                                    <p class="mb-0">568</p>
                                </div>
                                <div class="">15%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                            </div>
                            <hr>
                            <div class="d-flex align-items-center gap-3">
                                <div class="widgets-icons-small text-white bg-behance"><i class='bx bxl-behance' ></i></div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Behance</h6>
                                    <p class="mb-0">790</p>
                                </div>
                                <div class="">22%<i class='bx bx-up-arrow-alt ms-1'></i></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div> --}}
        
        {{-- <div class="col-xl-12 mx-auto">
            <div class="card  border-primary shipper_caont">
                <div class="row">
                <div class="shipment-status">
                    <div class="load-no">
                        <p>Load No: <span>#{{ $shipmentData->id }}</span></p>
                    </div>
                    <div class="status">
                        <p>Status: <span>{{ $shipmentData->shipment_statue }}</span></p>
                    </div>
                </div>
                @php
                $companie = App\Models\Company::where('id', $shipmentData->companies_id)->first();
                if($companie->pre_pay == '1'){
                    $value = 'Pre-pay';
                    $Limit = $companie->un_secured_limit;
                }else{
                    $value = 'Limit';
                    $Limit = $companie->credit_limit;
                }
                @endphp
                @if($companie)
                <div class="shipment-status limit">
                    <div class="load-no">
                        <p>{{$value}}# <span>{{ isset($Limit) ? $Limit : null }}</span></p>
                    </div>
                    <div class="shipper-limit-use">
                        @php
                        $companie_res = App\Models\Shipment::where('companies_id', $companie->id)->get();
                        $sum_Price = 0;
                         
                        foreach($companie_res as $companie_data){
                            if($companie_data->shipment_statue <> 'Paid'){ 
                                $companie_data = App\Models\Shipmentrate::where('shipment_id', $companie_data->id)->first();
                                $sum_Price += $companie_data->customer_total;
                            }
                        }
                        
                        @endphp
                        <p>Used limit: <span> {{ $sum_Price }} </span></p>
                    </div> 
                </div>
                @endif
                
                <div class="exampleScrollableModal" style="margin-left: 90%; margin-top: -50px;">
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleScrollableModal">Notes </button>
                </div>
                <!--Shipment Notes Model Start-->
                    <div class="col">
                        <!-- Button trigger modal -->
                        <!-- Modal -->
                        <div class="modal fade" id="exampleScrollableModal" tabindex="-1" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h6 class="modal-title">Shipment Notes</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                            @php
                                               $id =  Auth::id();
                                            @endphp
                                            <form action="{{url('admin/shipment/notes')}}" method="post">
                                                <div class="col-md-12">
                                                    <div class="form-group shipment-more">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="title_type" placeholder="Title" value="" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group shipment-more">
                                                        <textarea class="form-control" id="inputAddress3" placeholder="Enter Description" rows="3" name="description" required></textarea>
                                                    </div>
                                                </div>
                                                
                                                <input type="hidden" name="user_id" value="{{$id}}">
                                                <input type="hidden" name="shipment_id" value="{{ $shipmentData->id}}">
                                              

                                                <div class="modal-footer">
                                                   

                                                <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                </div>

                                            </form>
                                          
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                <!--end model-->
            </div>
                <div class="card-body p-3 ">
                    <div class="row g-3">
                        <form action="{{url('admin/shipment-update')}}" id="sh ipmentupdate" method="POST" enctype="multipart/form-data" class="placeholder-form">  
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="shipment-more-details card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Edit Shipment</h3>
                                            <!-- <h2 class="">Create Shipment</h2> -->
                                        </div>
    
                                        <div class="row card-body">
                                            <div class="col-md-4">
                                                <div class="form-group shipment-more">
                                                    <input type="number" class="form-control form-control-sm mb-3" name="ref_no" placeholder="Ref" value="{{ $shipmentData->ref_loads }}" readonly>
                                                </div>
                                            </div>
                                         
                                            <div class="col-md-4">
                                                <div class="form-group shipment-more">
                                                    <select class="form-control form-control-sm mb-3 select2" name="equipment_type" style="width: 100%;" >
                                                    <option selected value="<?php if(!empty($shipmentData->equipment_loads)){ echo $shipmentData->equipment_loads; } ?>"><?php echo $shipmentData->equipment_loads; ?></option>
                                                        <?php foreach($Equipments as $equipments_value){ ?>
                                                            <option value="<?php echo $equipments_value->equip_name; ?>"><?php echo $equipments_value->equip_name; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group shipment-more">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="full_partial" placeholder="Full/Partial" value="{{ $shipmentData->full_partial }}">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group shipment-more">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="commodity_laod" placeholder="Commodity" value="{{ $shipmentData->commodity_laod }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group shipment-more">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="pieces_laod" placeholder="Pallat" value="{{ $shipmentData->pieces_laod }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group shipment-more">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="weight_loads" placeholder="Weight" value="{{ $shipmentData->weight_loads }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group shipment-more">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="declared_loads" placeholder="Declared Value" value="{{ $shipmentData->declared_loads }}">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group shipment-more">
                                                    <select name="mode" class="form-control form-control-sm mb-3">
                                                        <option value="Enter Mode" selected="">Select Mode</option>
                                                        <option value="OTR" <?php if($shipmentData->mode == 'OTR'){ echo 'selected'; } ?> >OTR</option>
                                                        <option value="Drayage" <?php if($shipmentData->mode == 'Drayage'){ echo 'selected'; } ?>>Drayage</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group shipment-more">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="footage_loads" placeholder="Length" value="{{ $shipmentData->footage_loads }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group shipment-more">
                                                    <select class="form-control form-control-sm mb-3" name="payment_mode" id="payment_mode">
                                                        <option disabled selected>Payment Mode</option>
                                                        <option value="USD" <?php if($shipmentData->payment_mode == 'USD'){ echo 'selected'; } ?>>USD</option>
                                                        <option value="CAD" <?php if($shipmentData->payment_mode == 'CAD'){ echo 'selected'; } ?>>CAD</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group shipment-more">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="temp_min" placeholder="Temp Min" value="{{ $shipmentData->temp_min }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group shipment-more">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="temp_max" placeholder="Temp Max" value="{{ $shipmentData->temp_max }}">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group shipment-more">
                                                    <input type="text" class="form-control form-control-sm mb-3" name="temp_precool" placeholder="Temp Precool" value="{{ $shipmentData->temp_precool }}">
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
                                                           
                                                            <option value="">{{ isset($shipmentComp->company_name) ? $shipmentComp->company_name : Null }}</option>

                                                        </select>
                                                        <input type="hidden" id="shipment_id" name="shipment_id" value="{{ isset($shipmentData->id) ? $shipmentData->id : Null }}">
                                                        <input type="hidden" id="companies_id" name="companies_id" value="{{ isset($shipmentData->companies_id) ? $shipmentData->companies_id : Null }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control " name="shipperaddress" id="shipperaddress" placeholder="Address" value="{{ isset($shipmentComp->address) ? $shipmentComp->address : Null }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="shippercity" id="shippercity" placeholder="City"  readonly  value="{{ isset($shipmentComp->shipper_city) ? $shipmentComp->shipper_city : Null }}" >
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="shipperstate" id="shipperstate" placeholder="State" readonly value="{{ isset($shipmentComp->shipper_state) ? $shipmentComp->shipper_state : Null }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="shipperzip" id="shipperzip" placeholder="Zip" readonly value="{{ isset($shipmentComp->shipper_zipcode) ? $shipmentComp->shipper_zipcode : Null }}" >
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="shipperphone" id="shipperphone" placeholder="Phone" readonly value="{{ isset($shipmentComp->phone_number) ? $shipmentComp->phone_number : Null }}" >
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="customer_c_name" id="customer_c_name" placeholder="C Persone" readonly value="{{  isset($shipmentComp->contact_name) ? $shipmentComp->contact_name : Null}}" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h3 class="card-title">Bill To</h3>
                                        </div>
                                        <div class="card-body"> 
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="billname" id="billname" placeholder="Name" value="{{ isset($shipmentData->b_customer_name) ? $shipmentData->b_customer_name : Null }}" >
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="billaddress" id="billaddress" placeholder="Address" value="{{isset( $shipmentData->b_customer_address) ?  $shipmentData->b_customer_address : Null }}" >
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="billcity" id="billcity" placeholder="City" value="{{ isset($shipmentData->b_customer_city) ? $shipmentData->b_customer_city : Null }}" >
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="billstate" id="billstate" placeholder="State" value="{{ isset($shipmentData->b_customer_state) ? $shipmentData->b_customer_state : Null }}" >
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="billzip" id="billzip" placeholder="Zip" value="{{ isset($shipmentData->b_customer_zip) ? $shipmentData->b_customer_zip : Null }}" >
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="billphone" id="billphone" placeholder="Phone" value="{{ isset($shipmentData->b_customer_phone) ? $shipmentData->b_customer_phone : Null }}" >
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="b_customer_c_name" id="b_customer_c_name" placeholder="C Persone" value="{{ isset($shipmentData->b_customer_c_name) ? $shipmentData->b_customer_c_name : Null }}" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Pick Up</h3>
                                        </div>
                                        <div class="card-body"> 
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="pickname" autocomplete="off" placeholder="Name" value=" <?php if(!empty($shipmentpick->p_name)){ echo $shipmentpick->p_name;} ?> ">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="pickaddress" autocomplete="off" placeholder="Address" value="<?php if(!empty($shipmentpick->p_address)){ echo $shipmentpick->p_address; } ?>">
                                            </div>
                                            
                                            <div class="row">

                                                <div class="col-md-6">
                                                    {{-- <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="pickstate" autocomplete="off" placeholder="State" value="<?php // if(!empty($shipmentpick->p_state)){ echo $shipmentpick->p_state; } ?>">
                                                    </div> 

                                                        <?php 
                                                            $abc = DB::table('dat_states')->get();
                                                        ?>
                                                        <select class="form-control form-control-sm mb-3 select2" name="pickstate" style="width: 100%;" >
                                                            
                                                            <?php foreach($abc as $equipments_value){  ?>
                                                                <option value="<?php echo $equipments_value->state; ?>" <?php if($shipmentpick->p_state == $equipments_value->state){ echo "selected"; } ?>><?php echo $equipments_value->state; ?></option>
                                                            <?php }  ?>
                                                        </select>
                                                </div>

                                                <div class="col-md-6">
                                                     <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="pickcity" autocomplete="off" placeholder="City" value="<?php if(!empty($shipmentpick->p_city)){ echo $shipmentpick->p_city; } ?>">
                                                    </div>



                                                        {{-- <?php 
                                                           // $acities = DB::table('dat_cities')->get();
                                                        ?>
                                                        <select class="form-control form-control-sm mb-3" name="pickcity" style="width: 100%;" >
                                                            
                                                            <?php //foreach($acities as $data){  ?>
                                                                <option value="<?php //echo $data->city; ?>" 
                                                                    <?php //if($shipmentpick->p_city == $data->city)  { echo "selected"; } ?>
                                                                >
                                                                <?php// if(!empty($data->city)){ echo $data->city; } ?>
                                                                </option>

                                                            <?php // }  ?>
                                                        </select> 


                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="pickzip" autocomplete="off" placeholder="Zip" value="<?php if(!empty($shipmentpick->p_zip)){ echo $shipmentpick->p_zip; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="p_ref" autocomplete="off" placeholder="PO#" value="<?php if(!empty($shipmentpick->p_ref)){ echo $shipmentpick->p_ref; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="p_contact" autocomplete="off" placeholder="Contact" value="<?php if(!empty($shipmentpick->p_contact)){ echo $shipmentpick->p_contact; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                     <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="pickphone" autocomplete="off" placeholder="Phone" value="<?php if(!empty($shipmentpick->p_phone)){ echo $shipmentpick->p_phone; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="pickemail" autocomplete="off" placeholder="Email" value="<?php if(!empty($shipmentpick->p_email)){ echo $shipmentpick->p_email; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" id="pickready" name="pickready" autocomplete="off" placeholder="Pick Date" value="<?php if(!empty($shipmentpick->p_ready)){ echo $shipmentpick->p_ready; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="picktime" autocomplete="off" placeholder="Time" value="<?php if(!empty($shipmentpick->p_rtime)){ echo $shipmentpick->p_rtime; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="p_appt_note" autocomplete="off" placeholder="Appt.Note" value="<?php if(!empty($shipmentpick->p_appt_note)){ echo $shipmentpick->p_appt_note; } ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Drop</h3>
                                        </div>
                                        <div class="card-body"> 
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="dropname" autocomplete="off" placeholder="Name" value="<?php if(!empty($shipmentdrop->d_name)){ echo $shipmentdrop->d_name; } ?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control form-control-sm mb-3" name="dropaddress" autocomplete="off" placeholder="Address" value="<?php if(!empty($shipmentdrop->d_address)){ echo $shipmentdrop->d_address; } ?>">
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="dropcity" autocomplete="off" placeholder="City" value="<?php if(!empty($shipmentdrop->d_city)){ echo $shipmentdrop->d_city; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="dropstate" autocomplete="off" placeholder="State" value="<?php if(!empty($shipmentdrop->d_state)){ echo $shipmentdrop->d_state; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="dropzip" autocomplete="off" placeholder="Zip" value="<?php if(!empty($shipmentdrop->d_zip)){ echo $shipmentdrop->d_zip; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="d_ref" autocomplete="off" placeholder="PO#" value="<?php if(!empty($shipmentdrop->d_ref)){ echo $shipmentdrop->d_ref; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="d_contact" autocomplete="off" placeholder="Contact" value="<?php if(!empty($shipmentdrop->d_contact)){ echo $shipmentdrop->d_contact; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="dropphone" autocomplete="off" placeholder="Phone" value="<?php if(!empty($shipmentdrop->d_phone)){ echo $shipmentdrop->d_phone; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="dropemail" autocomplete="off" placeholder="Email" value="<?php if(!empty($shipmentdrop->d_email)){ echo $shipmentdrop->d_email; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="dropready" id="dropready" autocomplete="off" placeholder="Drop Date" value="<?php if(!empty($shipmentdrop->d_ready)){ echo $shipmentdrop->d_ready; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="droptime" autocomplete="off" placeholder="Time" value="<?php if(!empty($shipmentdrop->d_rtime)){ echo $shipmentdrop->d_rtime; } ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-sm mb-3" name="d_appt_note" autocomplete="off" placeholder="Appt.Note" value="<?php if(!empty($shipmentdrop->d_appt_note)){ echo $shipmentdrop->d_appt_note; } ?>">
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
                                                <div class="card-header">
                                                    <h3 class="card-title">Carrier Details</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <span id="carrier_status" class="error"></span>
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="carrier_mc" id="shipment_mc" autocomplete="off" placeholder="MC" value="{{ $shipmentData->shipment_c_mc }}">
                                                                <input type="hidden" name="carrier_id" id="carriers_id" value="{{ isset($shipmentData->carrier_id ) ? $shipmentData->carrier_id : null }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="carrier_dot" id="carrier_dot" placeholder="DOT" value="{{ isset($shipmentData->shipment_c_dot) ? $shipmentData->shipment_c_dot : Null }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="carrier_name" id="carrier_name" placeholder="Carrier Name" value="{{ isset($shipmentData->shipment_c_carrier) ? $shipmentData->shipment_c_carrier : Null }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="dispatched" id="dispatched" placeholder="Dispatcher" value="{{ isset($shipmentData->shipment_c_dispatcher) ? $shipmentData->shipment_c_dispatcher : Null }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_phone" id="shipment_c_phone" placeholder="Phone" value="{{ isset($shipmentData->shipment_c_phone) ? $shipmentData->shipment_c_phone : Null }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_email" id="shipment_c_email" placeholder="Email" value="{{ isset($shipmentData->shipment_c_email) ? $shipmentData->shipment_c_email : Null }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_driver_n" id="shipment_c_driver_n" placeholder="Driver N" value="{{ isset($shipmentData->shipment_c_driver_n) ? $shipmentData->shipment_c_driver_n : Null }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="shipment_c_driver_p" id="shipment_c_driver_p" placeholder="Phone" value="{{ isset($shipmentData->shipment_c_driver_p) ? $shipmentData->shipment_c_driver_p : Null }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Carrier Instruction</h3>
                                                </div>
                                                <div class="card-body" id="carrrier_ins">
                                                    <div class="form-group">
                                                        <textarea search-data="carrier_instruction" class="form-control form-control-sm mb-3" rows="5" name="carrier_instruction" placeholder="Enter Instruction ..." value="" >{{ isset($shipmentData->shipment_carrier_instruction) ? $shipmentData->shipment_carrier_instruction : Null }}</textarea>
                                                        <div class="shipment_instruction" id="carrier_instruction">
                                                            <li value="Driver is responsible for all shortage and damage">Driver is responsible for all shortage and damage</li>
                                                            <li value="Driver is responsible for any damage or mishandling of this load.Handle the load according to rate Conformation">Driver is responsible for any damage or mishandling of this load.Handle the load according to rate Conformation.</li>
                                                            <li value="Driver is responsible for any damage or mishandling of this load. Driver may ask for detention and that would be $30 after 3 hour  TONU $50 fix for same day cancellation">Driver is responsible for any damage or mishandling of this load. driver may ask for detention and that would be $30 after 3 hour  TONU $50 fix for same day cancellation</li>
                                                            <li value="Driver is responsible for any damage or mishandling of this load, damages or rejections load will not be paid.">Driver is responsible for any damage or mishandling of this load.damages or rejections load will not be paid</li>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Shipper Instruction</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <textarea search-data="shipper_instruction" class="form-control form-control-sm mb-3" rows="5" name="shipper_instruction" placeholder="Enter Instruction ..." value="" >{{ isset($shipmentData->shipment_shipper_instruction) ? $shipmentData->shipment_shipper_instruction : Null }}</textarea>
                                                        <div class="shipment_instruction" id="shipper_instruction">
                                                            <li value="Driver is responsible for all shortage and damage">Driver is responsible for all shortage and damage</li>
                                                            <li value="Driver is responsible for any damage or mishandling of this load.Handle the load according to rate Conformation">Driver is responsible for any damage or mishandling of this load.Handle the load according to rate Conformation</li>
                                                            <li value="Driver is responsible for any damage or mishandling of this load. Driver may ask for detention and that would be $30 after 3 hour  TONU $50 fix for same day cancellation">Driver is responsible for any damage or mishandling of this load. Driver may ask for detention and that would be $30 after 3 hour  TONU $50 fix for same day cancellation</li>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
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
                                                                <td><input type="text" name="unit1_customer" value="<?php if(!empty($shipment_rates->unit1_customer)){ echo $shipment_rates->unit1_customer; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td style="width:10%" class="w75"><strong>Unit2</strong></td>
                                                                <td style="width:12%"><input type="text" name="unit2_customer" value="<?php if(!empty($shipment_rates->unit2_customer)){ echo $shipment_rates->unit2_customer; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td style="width: 14%;" class="w75" style="width:12%"><strong>LH Rate</strong></td>
                                                                <td style="width:12%"><input type="text" name="lh_customer" id="lh_customer" value="<?php if(!empty($shipment_rates->lh_customer)){ echo $shipment_rates->lh_customer; } ?>" class="form-control form-control-sm mb-3"></td>
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
                                                                <td><input type="text" name="rate_unit1_carrier" value="<?php if(!empty($shipment_rates->rate_unit1_carrier)){ echo $shipment_rates->rate_unit1_carrier; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td style="width:10%" class="w75"><strong>Unit2</strong></td>
                                                                <td style="width:12%"><input type="text" name="rate_unit2_carrier" value="<?php if(!empty($shipment_rates->rate_unit2_carrier)){ echo $shipment_rates->rate_unit2_carrier; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td style="width: 14%;" class="w75" style="width:12%"><strong>LH Rate</strong></td>
                                                                <td style="width:12%"><input type="text" name="lh_carrier" id="lh_carrier" value="<?php if(!empty($shipment_rates->lh_carrier)){ echo $shipment_rates->lh_carrier; } ?>" class="form-control form-control-sm mb-3">
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
                                                                <th style="width:20%">Carrier Sr. No</th>
                                                                <th style="width:20%">Accessorial</th>
                                                                <th style="width:25%">Carrier Rate</th>
                                                                <th style="width:15%"></th>
                                                                <th style="width:20%">Customer Rates</th>
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td><input type="text" name="transportation1" value="<?php if(!empty($shipment_rates->transportation1)){ echo $shipment_rates->transportation1; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td>
                                                                    <!--<input type="text" name="line_haul1" placeholder="Lumper" value="<?php //if(!empty($shipment_rates->line_haul1)){ echo $shipment_rates->line_haul1; } ?>" class="form-control form-control-sm mb-3">-->
                                                                    <select name="line_haul1" class="form-control form-control-sm mb-3">
                                                                        <option value=""></option>    
                                                                        <option value="FSC" <?php if(!empty($shipment_rates->line_haul1)){ echo 'selected'; } ?> > FSC</option>
                                                                        <!-- <option value="Chassis">Chassis</option>
                                                                        <option value="Split Chassis">Split Chassis</option>
                                                                        <option value="Detention">Detention</option>
                                                                        <option value="Storage">Storage</option>
                                                                        <option value="Lumper">Lumper</option> -->
                                                                    </select>    
                                                                </td>
                                                                <td class="redinput"><input type="text" name="carrier1" id="carrier1" value="<?php if(!empty($shipment_rates->carrier1)){ echo $shipment_rates->carrier1; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td class="checkbox"></td>
                                                                <td class="greeninput"><input type="text" value="<?php if(!empty($shipment_rates->customer1)){ echo $shipment_rates->customer1; } ?>" name="customer1" id="customer1" class="form-control form-control-sm mb-3"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" name="transportation2" value="<?php if(!empty($shipment_rates->transportation2)){ echo $shipment_rates->transportation2; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td>
                                                                    <!-- <input type="text" name="line_haul2" placeholder="" value="<?php if(!empty($shipment_rates->line_haul2)){ echo $shipment_rates->line_haul2; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                    <select name="line_haul2" class="form-control form-control-sm mb-3">
                                                                        <option value=""></option>
                                                                        <option value="Chassis" <?php if(!empty($shipment_rates->line_haul2)){ echo 'selected'; } ?>>Chassis</option>
                                                                    </select>
                                                                </td>
                                                                <td class="redinput"><input type="text" name="carrier2" id="carrier2" value="<?php if(!empty($shipment_rates->carrier2)){ echo $shipment_rates->carrier2; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td class="checkbox"></td>
                                                                <td class="greeninput"><input type="text" id="customer2" name="customer2" value="<?php if(!empty($shipment_rates->customer2)){ echo $shipment_rates->customer2; } ?>" class="form-control form-control-sm mb-3"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><input type="text" name="transportation3" value="<?php if(!empty($shipment_rates->transportation3)){ echo $shipment_rates->transportation3; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td>
                                                                    <!-- <input type="text" name="line_haul3" placeholder="" value="<?php if(!empty($shipment_rates->line_haul3)){ echo $shipment_rates->line_haul3; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                    <select name="line_haul3" class="form-control form-control-sm mb-3">
                                                                        <option value=""></option>
                                                                        <option value="Split Chassis" <?php if(!empty($shipment_rates->line_haul3)){ echo 'selected'; } ?>>Split Chassis</option>
                                                                        
                                                                    </select>    
                                                                </td>
                                                                <td class="redinput"><input type="text" name="carrier3" id="carrier3" value="<?php if(!empty($shipment_rates->carrier3)){ echo $shipment_rates->carrier3; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td class="checkbox"></td>
                                                                <td class="greeninput"><input type="text" id="customer3" name="customer3" value="<?php if(!empty($shipment_rates->customer3)){ echo $shipment_rates->customer3; } ?>" class="form-control form-control-sm mb-3"></td>
                                                            </tr>
                                                            <tr class="hide_tr">
                                                                <td><input type="text" name="transportation4" value="<?php if(!empty($shipment_rates->transportation4)){ echo $shipment_rates->transportation4; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td>
                                                                    <!-- <input type="text" name="line_haul4" placeholder="" value="<?php if(!empty($shipment_rates->line_haul4)){ echo $shipment_rates->line_haul4; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                    <select name="line_haul4" class="form-control form-control-sm mb-3">
                                                                        <option value=""></option>
                                                                        <option value="Detention" <?php if(!empty($shipment_rates->line_haul4)){ echo 'selected'; } ?>>Detention</option>
                                                                        
                                                                    </select>
                                                                </td>
                                                                <td class="redinput"><input type="text" name="carrier4" id="carrier4" value="<?php if(!empty($shipment_rates->carrier4)){ echo $shipment_rates->carrier4; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td class="checkbox"></td>
                                                                <td class="greeninput"><input type="text" id="customer4" name="customer4" value="<?php if(!empty($shipment_rates->customer4)){ echo $shipment_rates->customer4; } ?>" class="form-control form-control-sm mb-3"></td>
                                                            </tr>
                                                            <tr class="hide_tr">
                                                                <td><input type="text" name="transportation5" value="<?php if(!empty($shipment_rates->transportation5)){ echo $shipment_rates->transportation5; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td>
                                                                    <!-- <input type="text" name="line_haul5" placeholder="" value="<?php if(!empty($shipment_rates->line_haul5)){ echo $shipment_rates->line_haul5; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                    <select name="line_haul5" class="form-control form-control-sm mb-3">
                                                                        <option value=""></option>
                                                                        <option value="Storage" <?php if(!empty($shipment_rates->line_haul5)){ echo 'selected'; } ?>>Storage</option>
                                                                        
                                                                    </select>
                                                                </td>
                                                                <td class="redinput"><input type="text" name="carrier5" id="carrier5" value="<?php if(!empty($shipment_rates->carrier5)){ echo $shipment_rates->carrier5; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td class="checkbox"></td>
                                                                <td class="greeninput"><input type="text" id="customer5" name="customer5" value="<?php if(!empty($shipment_rates->customer5)){ echo $shipment_rates->customer5; } ?>" class="form-control form-control-sm mb-3"></td>
                                                            </tr>
                                                            <tr class="hide_tr">
                                                                <td>
                                                                    <input type="text" name="transportation6" value="<?php if(!empty($shipment_rates->transportation6)){ echo $shipment_rates->transportation6; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td>
                                                                    <!-- <input type="text" name="line_haul6" placeholder="" value="<?php if(!empty($shipment_rates->line_haul6)){ echo $shipment_rates->line_haul6; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                    <select name="line_haul6" class="form-control form-control-sm mb-3">
                                                                        <option value=""></option>
                                                                        <option value="Pre-pull" <?php if(!empty($shipment_rates->line_haul6)){ echo 'selected'; } ?>>Pre-pull</option>
                                                                        
                                                                    </select>
                                                                </td>
                                                                <td class="redinput"><input type="text" name="carrier6" id="carrier6" value="<?php if(!empty($shipment_rates->carrier6)){ echo $shipment_rates->carrier6; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td class="checkbox"></td>
                                                                <td class="greeninput"><input type="text" id="customer6" name="customer6" value="<?php if(!empty($shipment_rates->customer6)){ echo $shipment_rates->custome6; } ?>" class="form-control form-control-sm mb-3"></td>
                                                            </tr>
                                                            <tr class="hide_tr">
                                                                <td>
                                                                    <input type="text" name="transportation7" value="<?php if(!empty($shipment_rates->transportation7)){ echo $shipment_rates->transportation7; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td>
                                                                    <!-- <input type="text" name="line_haul7" placeholder="" value="<?php if(!empty($shipment_rates->line_haul7)){ echo $shipment_rates->line_haul7; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                    <select name="line_haul7" class="form-control form-control-sm mb-3">
                                                                        <option value=""></option>
                                                                        <option value="Lumper" <?php if(!empty($shipment_rates->line_haul7)){ echo 'selected'; } ?>>Lumper</option>
                                                                        
                                                                    </select>
                                                                </td>
                                                                <td class="redinput"><input type="text" name="carrier7" id="carrier7" value="<?php if(!empty($shipment_rates->carrier7)){ echo $shipment_rates->carrier7; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td class="checkbox"></td>
                                                                <td class="greeninput"><input type="text" id="customer7" name="customer7" value="<?php if(!empty($shipment_rates->customer7)){ echo $shipment_rates->custome7; } ?>" class="form-control form-control-sm mb-3"></td>
                                                            </tr>
                                                            <tr class="hide_tr">
                                                                <td>
                                                                    <input type="text" name="transportation8" value="<?php if(!empty($shipment_rates->transportation8)){ echo $shipment_rates->transportation8; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td>
                                                                    <!-- <input type="text" name="line_haul8" placeholder="" value="<?php if(!empty($shipment_rates->line_haul8)){ echo $shipment_rates->line_haul8; } ?>" class="form-control form-control-sm mb-3"> -->
                                                                    <select name="line_haul8" class="form-control form-control-sm mb-3">
                                                                        <option value=""></option>
                                                                        <option value="GateFee" <?php if(!empty($shipment_rates->line_haul8)){ echo 'selected'; } ?>>GateFee</option>
                                                                        
                                                                    </select>
                                                                </td>
                                                                <td class="redinput"><input type="text" name="carrier8" id="carrier8" value="<?php if(!empty($shipment_rates->carrier6)){ echo $shipment_rates->carrier8; } ?>" class="form-control form-control-sm mb-3"></td>
                                                                <td class="checkbox"></td>
                                                                <td class="greeninput"><input type="text" id="customer8" name="customer8" value="<?php if(!empty($shipment_rates->customer8)){ echo $shipment_rates->custome8; } ?>" class="form-control form-control-sm mb-3"></td>
                                                            </tr class="hide_tr">
                                                            <tr>
                                                                <td colspan="5"><span class="moreoption"><span>More</span> <i class="bx bx-plus"></i></span></td>
                                                            </tr>
                                                            <!--tr class="repeater" id="repeater">
                                                                <td><input type="text" name="transportation3" value="" class="form-control form-control-sm mb-3"></td>
                                                                <td><input type="text" name="line_haul3" value="" class="form-control form-control-sm mb-3"></td>
                                                                <td><input type="text" name="carrier3" id="carrier3" value="" class="form-control form-control-sm mb-3"></td>
                                                                <td class="checkbox"><input type="checkbox" class="form-check-input" name=""></td>
                                                                <td><input type="text" id="customer3" name="customer3" value="" class="form-control form-control-sm mb-3" style="width: 74px;"> <button type="button" class="add-new" onclick="add_new()"><i class="bx bx-plus"></i></button></td>
                                                            </tr -->
                                                            <tr>
                                                                <td><strong>Carrier Total </strong></td>
                                                                <td><input type="text" name="carrier_total" data="<?php if(!empty($shipment_rates->carrier_total)){ echo $shipment_rates->carrier_total; } ?>" id="carrier_total" value="<?php if(!empty($shipment_rates->carrier_total)){ echo $shipment_rates->carrier_total; } ?>" class="form-control form-control-sm mb-3" readonly=""></td>
                                                                <td><strong>Customer Total </strong></td>
                                                                <td colspan="2"><input type="text" id="customer_total" name="customer_total" value="<?php if(!empty($shipment_rates->customer_total)){ echo '$'.$shipment_rates->customer_total; } ?>" class="form-control customer_total" readonly=""></td>
                                                            </tr>
                                                            
                                                            @php
                                                            $CarrierPayment = \App\Models\CarrierPayment::where('shipment_id',$shipmentData->id)->first();
                                                            @endphp

                                                            <tr>
                                                                <td colspan="2">
                                                                    <label><b>QuickPay Deduction</b></label>
                                                                    <input class="form-control" type="number" name="quickpay_deduction" id="c_minus" value="{{ isset($shipment_rates->quickpay_deduction) ? $shipment_rates->quickpay_deduction : null }}" <?php if(!empty($CarrierPayment->quickpay_amount)){ echo 'readonly';  } ?> >
                                                                </td>
                                                                <td colspan="4">
                                                                    <label><b>QuickPay Total</b></label>
                                                                    <input type="number" class="form-control" id="quickpay_amount" name="quickpay_amount" value="{{ isset($shipment_rates->quickpay_amount) ? $shipment_rates->quickpay_amount : null }}" <?php if(!empty($CarrierPayment->quickpay_amount)){ echo 'readonly';  } ?>>
                                                                </td>
                                                                <!-- <input type="hidden" id="quickpay_amount" value=""> -->
                                                            </tr>
                                                            
                                                            <tr>
                                                                <td style="display: none">
                                                                <?php if(empty($CarrierPayment->quickpay_amount)){ ?>
                                                                <button type="button" id="quickpay_request" class="btn btn-primary" value="{{isset($shipmentData->id) ? $shipmentData->id : null }}">QuickyPay</button>
                                                                <?php }else{ echo '<span class="text text-success">QuickPay Sent</span>'; } ?>
                                                            
                                                            </td></tr>
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
                                            <div class="card-header" id="documents_toggle">
                                                <h3 class="card-title plus">Documents <i class="bx bx-plus"></i></h3>
                                            </div>
                                            <div class="card-body" id="shipment_documents">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p><strong>There are no decuments associated with this load. Please Choose file to add a document.</strong></p>
                                                    </div>
                                                    
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
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="ship_doc">
                                                                
                                                                @foreach($shipment_doc as $shipper_documnet)
                                                                    @if($shipper_documnet->type == 'shipper_doc')
                                                                        <div class="doc shipper_doc_id" value="{{ $shipper_documnet->id}}">
                                                                            <label>Shipper Doc</label>
                                                                            <a href="{{ url(BACKEND_COMMON_DOC.'/') }}{{ $shipper_documnet->document_name}}" target="_blank">
                                                                                <img src="{{url('/public/backend/assets/images/doc.png')}}">
                                                                                <a href="javascript:void(0)" id="Carrier_Doc_Del" ><i class="bx bx-trash"></i></a>
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                @endforeach

                                                                @foreach($shipment_doc as $shipper_documnet)
                                                                    @if($shipper_documnet->type == 'pod')
                                                                        <div class="doc shipper_doc_id" value="{{ $shipper_documnet->id}}">
                                                                            <label>POD</label>
                                                                            <a href="{{ url(BACKEND_COMMON_DOC.'/') }}{{ $shipper_documnet->document_name}}" target="_blank">
                                                                                <img src="{{url('/public/backend/assets/images/doc.png')}}">
                                                                                <a href="javascript:void(0)" id="Carrier_Doc_Del" ><i class="bx bx-trash"></i></a>
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                @endforeach

                                                                @foreach($shipment_doc as $shipper_documnet)
                                                                    @if($shipper_documnet->type == 'lumper')
                                                                        <div class="doc shipper_doc_id" value="{{ $shipper_documnet->id}}">
                                                                            <label>Lumper</label>
                                                                            <a href="{{ url(BACKEND_COMMON_DOC.'/') }}{{ $shipper_documnet->document_name}}" target="_blank">
                                                                                <img src="{{url('/public/backend/assets/images/doc.png')}}">
                                                                                <a href="javascript:void(0)" id="Carrier_Doc_Del" ><i class="bx bx-trash"></i></a>
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                @endforeach


                                                                @foreach($shipment_doc as $shipper_documnet)
                                                                    @if($shipper_documnet->type == 'gate_fees')
                                                                        <div class="doc shipper_doc_id" value="{{ $shipper_documnet->id}}">
                                                                            <label>Gate Fees</label>
                                                                            <a href="{{ url(BACKEND_COMMON_DOC.'/') }}{{ $shipper_documnet->document_name}}" target="_blank">
                                                                                <img src="{{url('/public/backend/assets/images/doc.png')}}">
                                                                                <a href="javascript:void(0)" id="Carrier_Doc_Del" ><i class="bx bx-trash"></i></a>
                                                                            </a>
                                                                        </div>
                                                                    @endif 
                                                                @endforeach
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                   
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>

                               

                            
                        </form>
                
                    </div>
                </div>
                </div>
            </div>
        </div> --}}
    

    
        <div class="col-3 mt-5 d-flex">
            <div class="card radius-10 w-100">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div>
                            <h6 class="mb-1">Carrier Details</h6>
                        </div>
                    
                    </div>
                </div>
                <div class="product-list  mb-3">
                    <div class="d-flex flex-column gap-3">
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2  ">
                            <div class="">
                             
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Reference ID</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0 fw-bold">{{ $shipmentData->ref_loads}}</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Load Status</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">{{$shipmentData->shipment_statue}}</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                               
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Equipment Type </h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0 fw-bold">{{$shipmentData->equipment_loads}}</h6>
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Load Type</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">{{$shipmentData->full_partial}}</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                               
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Commodity weight</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">{{$shipmentData->weight_loads}} lbs</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Length</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">{{$shipmentData->footage_loads}}</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Shipper Name:</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">{{$shipmentData->customer_name}} {{$shipmentData->customer_c_name}}</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Shipper Address </h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Shipper Phone</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div>
                        
                        {{-- <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Light Chair</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Light Chair</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Light Chair</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Light Chair</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Light Chair</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Light Chair</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Light Chair</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Light Chair</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Light Chair</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Light Chair</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Light Chair</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                            <div class="">
                                <img src="assets/images/products/10.png" width="50" alt="" />
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">Light Chair</h6>
                                <p class="mb-0"></p>
                            </div>
                            <div class="">
                                <h6 class="mb-0">$49K.00</h6>
                            </div>
                        </div> --}}
                        
                    </div>                           

                </div>
            </div>
        </div>
            <div class="col-3 mt-5 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-1">Approver Details</h6>
                            </div>
                        
                        </div>
                    </div>
                    <div class="product-list  mb-3">
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2  ">
                                <div class="">
                                 
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Reference ID</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0 fw-bold">{{ $shipmentData->ref_loads}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Load Status</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->shipment_statue}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                   
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Equipment Type </h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0 fw-bold">{{$shipmentData->equipment_loads}}</h6>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Load Type</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->full_partial}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                   
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Commodity weight</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->weight_loads}} lbs</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Length</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->footage_loads}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Shipper Name:</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">{{$shipmentData->customer_name}} {{$shipmentData->customer_c_name}}</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Shipper Address </h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$49K.00</h6>
                                </div>
                            </div>
                            <div class="d-flex align-items-center justify-content-between gap-3 p-2 ">
                                <div class="">
                                    <img src="assets/images/products/10.png" width="50" alt="" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-0">Shipper Phone</h6>
                                    <p class="mb-0"></p>
                                </div>
                                <div class="">
                                    <h6 class="mb-0">$49K.00</h6>
                                </div>
                            </div>
                            
                            {{-- 
                            
                            
                            
                            
                            
                            
                            
                            
                            
                            
                             --}}
                            
                        </div>                           

                    </div>
                </div>
            </div>
    </div>
    </div>
</div>
<!--end page wrapper -->



{{-- //add bol start --}}


<script type="text/javascript">
    $(document).ready(function(){      
      var postURL = "<?php echo url('addmore'); ?>";
      var i=1;  


      $('#add').click(function(){  
           i++;  
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><div class=row><div class=col-md-2><span class=error id=carrier_statusdfs324></span><div class=form-group><input type="hidden" name="bol_id[]" value="0"><input class="form-control form-control-sm mb-3"id=ofpieces name=ofpieces[] placeholder="No Of Pieces"autocomplete=off></div></div><div class=col-md-2><div class=form-group><input class="form-control form-control-sm mb-3"id=descriptions name=descriptions[] placeholder=Descriptions></div></div><div class=col-md-1><div class=form-group><input class="form-control form-control-sm mb-3"id=weight name=weight[] placeholder="Weight / LBS"></div></div><div class=col-md-1><div class=form-group><input class="form-control form-control-sm mb-3"id=type name=type[] placeholder=Type></div></div><div class=col-md-1><div class=form-group><input class="form-control form-control-sm mb-3"id=nmfc name=nmfc[] placeholder=NMFC></div></div><div class=col-md-1><div class=form-group><input class="form-control form-control-sm mb-3"id=hazmat name=hazmat[] placeholder=Hazmat></div></div><div class=col-md-2><div class=form-group><input class="form-control form-control-sm mb-3"id=productclass name=productclass[] placeholder=Class></div></div><div class=col-md-2><div class=form-group><input class="form-control form-control-sm mb-3"id=notes name=notes[] placeholder=notes></div></div></div></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
      });  


      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  


      $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });


        // $('#submit').click(function(){            
        //     $.ajax({  
        //             url:postURL,  
        //             method:"POST",  
        //             data:$('#add_name').serialize(),
        //             type:'json',
        //             success:function(data)  
        //             {
        //                 if(data.error){
        //                     printErrorMsg(data.error);
        //                 }else{
        //                     i=1;
        //                     $('.dynamic-added').remove();
        //                     $('#add_name')[0].reset();
        //                     $(".print-success-msg").find("ul").html('');
        //                     $(".print-success-msg").css('display','block');
        //                     $(".print-error-msg").css('display','none');
        //                     $(".print-success-msg").find("ul").append('<li>Record Inserted Successfully.</li>');
        //                 }
        //             }  
        //     });  
        // });  


      function printErrorMsg (msg) {
         $(".print-error-msg").find("ul").html('');
         $(".print-error-msg").css('display','block');
         $(".print-success-msg").css('display','none');
         $.each( msg, function( key, value ) {
            $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
         });
      }
    });  
</script>


{{-- //add bol end  --}}

<form id="1">
    <input type="hidden" value="Address 1" id="address">
</form>
<form id="2">
    <input type="hidden" value="Address 2" id="address">
</form>
<script>
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
    
    $("div#shipper_instruction li").click(function(){
        $('textarea[search-data="shipper_instruction"]').val($(this).attr('value'));
        $("div#shipper_instruction").fadeOut();
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
    
    var plusid = 1;
    function addPick(){
        plusid++;
		//$("form#pickup").append('<form class="pickform newpick" method="post" action="" id="removepick_'+plusid+'"><h4>Pick Up</h4><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="pickname" autocomplete="off" placeholder="Name"></div><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="pickaddress" autocomplete="off" placeholder="Address"></div><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="manageorder" autocomplete="off" placeholder="Manage Order"></div><div class="row"><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="pickcity" autocomplete="off" placeholder="City"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="pickstate" autocomplete="off" placeholder="State"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="pickzip" autocomplete="off" placeholder="Zip"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="p_ref" autocomplete="off" placeholder="PO#"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="p_contact" autocomplete="off" placeholder="Contact"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="pickphone" autocomplete="off" placeholder="Phone"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="pickemail" autocomplete="off" placeholder="Email"></div></div><div class="col-md-6"><div class="form-group"><input type="date" class="form-control form-control-sm mb-3 hasDatepicker" id="pickready" name="pickready" autocomplete="off" placeholder="Pick Date"></div></div><div class="col-md-6"><div class="form-group"><input type="time" class="form-control form-control-sm mb-3" name="picktime" autocomplete="off" placeholder="Time"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="p_appt_note" autocomplete="off" placeholder="Appt.Note"></div></div><div class="col-md-12"><button class="btn btn-primary" type="submit">Save Pick Up</button><button class="btn btn-danger addnew" type="button" onclick="removePick('+plusid+')">Remove <i class="bx bx-minus"></i></button></div></div></form>');
	}
	
	function removePick(id){
	    $("#removepick_"+id).remove();
	}
	
	function addDrop(){
		$("form#dropup").append('<form class="dropform newpick" method="post" action="" id="removedrop_'+plusid+'"><h4>Drop</h4><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="dropkname" autocomplete="off" placeholder="Name"></div><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="dropaddress" autocomplete="off" placeholder="Address"></div><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="manageorder" autocomplete="off" placeholder="Manage Order"></div><div class="row"><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="dropcity" autocomplete="off" placeholder="City"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="pickstate" autocomplete="off" placeholder="State"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="dropzip" autocomplete="off" placeholder="Zip"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="d_ref" autocomplete="off" placeholder="PO#"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="d_contact" autocomplete="off" placeholder="Contact"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="dropphone" autocomplete="off" placeholder="Phone"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="dropemail" autocomplete="off" placeholder="Email"></div></div><div class="col-md-6"><div class="form-group"><input type="date" class="form-control form-control-sm mb-3 hasDatepicker" id="pickready" name="dropready" autocomplete="off" placeholder="Pick Date"></div></div><div class="col-md-6"><div class="form-group"><input type="time" class="form-control form-control-sm mb-3" name="droptime" autocomplete="off" placeholder="Time"></div></div><div class="col-md-6"><div class="form-group"><input type="text" class="form-control form-control-sm mb-3" name="d_appt_note" autocomplete="off" placeholder="Appt.Note"></div></div><div class="col-md-12"><button class="btn btn-primary" type="submit">Save Drop</button><button class="btn btn-danger addnew" type="button" onclick="removeDropk('+plusid+')">Remove <i class="bx bx-minus"></i></button></div></div></form>');
	}
	
	function removeDropk(id){
	    $("#removedrop_"+id).remove();
	}
	
	
	setInterval(function () {
	    var countpick = $('.pickform').length
	    var countdrop = $('.dropform').length
	    $(".countpic").text(countpick);
	    $(".countdrop").text(countdrop);
	}, 100);
	
	$("input#c_plus").change(function(){
	    if($(this).val()==''){
	        $("input#carrier_total").val($("input#carrier_total").attr('data'));
	    }else{
	        const carrier_total = $("input#carrier_total").val(), commission = $(this).val();
            const add = (x, y) => {
               while(y !== 0){
                  let carry = x & y;
                  x = x ^ y;
                  y = carry << 1;
               }
               return x;
            };
            $("input#quickpay_amount").val(add(carrier_total, commission));
	    }
	})
	$("input#c_minus").change(function(){
	    if($(this).val()==''){
	        $("input#carrier_total").val($("input#carrier_total").attr('data'));
	    }else{
	        var carrier_total = $("input#carrier_total").val();
            var commission = $(this).val();
            var total = carrier_total - commission;
            $("input#quickpay_amount").val(total);
	    }
	})
	
	var submitted = false;
    $("form#shipmentupdate").submit(function() {
        submitted = true;
    });
     
      window.onbeforeunload = function () {
        if (!submitted) {
          return 'Do you really want to leave the page?';
        }
      }
	
	$("form#shipmentupdate input, form#shipmentupdate textarea, form#shipmentupdate select").change(function(){
	    $("body").addClass("changes");
	})
</script>

<script>
    function success_noti() {
        Lobibox.notify('success', {
            pauseDelayOnHover: true,
            continueDelayOnInactiveTab: false,
            position: 'top right',
            icon: 'bx bx-check-circle',
            msg: 'Lorem ipsum dolor sit amet hears farmer indemnity inherent.'
        });
    }
    </script>

@include('backend.common.footer')
@endsection