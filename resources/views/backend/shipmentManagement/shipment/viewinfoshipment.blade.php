@extends('backend.layouts.master')
@section('title','View Shipment')
@section('content')
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
	  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

   
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script src="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js"></script>
    <link href="https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css" rel="stylesheet" />

<style>
    .distance-line {
        color: #ff0000; /* Line color (red in this case) */
        weight: 3; /* Line weight */
    }
</style>

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
        background-color: #e3e3e3;
    }


    .card-header h3 {
        margin: 0px;
        color: #000;
        font-size: 20px;
    }
</style>

{{-- //for new desing don't delete --}}
<style>
    a {
        text-decoration: none !important;
    }
    .stocks h2 {
        font-size: 28px;
        font-weight: 500;
        border-bottom: solid 1px #00000014;
        padding-bottom: 16px;
    }
    body {
        font-family: sans-serif;
    }
    .stock-box {
        margin-top: 30px;
        border-radius: 10px;
    }
    .stock-box table {
        border: solid 1px #0000001a;
        border-radius: 10px !important;
        box-shadow: 0px 0px 14px -10px;
        border-radius: 5px;
        overflow: hidden;
    }
    .stock-box table th {
        border-bottom: dashed 1px #00000036;
        font-size: 13px;
        color: ##000000b3;
        text-transform: uppercase;
        padding: 10px 10px;
        font-weight: 900;
    }
    .stock-box td {color: #000000f0;padding: 10px 10px; font-size: 13px}
    .stock-box i {
        display: inline-block;
        width: 30px;
        height: 30px;
        /* background-color: #09b50933;
        color: #15b88b; */
        text-align: center;
        border-radius: 50%;
        padding-top: 6px;
        margin-right: 9px;
    }

    .green-icon {
        background-color: #09b50933;
        color: #15b88b;
    }

    .red-icon {
        background-color: #ff000033;
        color: #ff0000;
    }

    .stock-box h4 {
        font-size: 18px;
        margin-bottom: 20px;
    }
    .btn {
        padding: 2px 12px !important;
        border-radius: 2px;
        text-align: center;
        width: 80px;
    }
    button.btn.btn-success {
        background-color: #15b88b;
        border-color: #15b88b;
    }
    .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
        max-width: 1150px;
    }
    .stocks-sidebar {
        padding-top: 40px;
        padding-left: 40px;
    }
    .side-head-box {
        border-radius: 10px !important;
        box-shadow: 0px 0px 14px -10px;
        padding: 12px 20px;
    }
    .side-head-box p span {
        font-weight: 600;
        width: 80px;
        display: inline-block;
    }
    .side-head-box p {
        margin: 10px 0px;
        color: #000000a8;
    }
    .bid-req {
        position: relative;
        margin-top: 50px;
    }
    .bid-req:before {
        content: "";
        position: absolute;
        left: 9px;
        width: 2px;
        height: 87%;
        background-color: #0000000f;
        z-index: -1;
    }
    .bid-req-box {
        display: flex;
        column-gap: 14px;
        margin: 14px 0px;
    }
    .bid-req-box i {
        width: 20px;
        height: 20px;
        background-color: #15b88b;
        border-radius: 50%;
        color: #fff;
        font-size: 12px;
        text-align: center;
        padding-top: 5px;
    }
    .bid-req-box p span {
        display: block;
        font-size: 14px;
        color: #000000a6;
    }
    .bid-req-box p {
        font-size: 17px;
        color: #000000e0;
    }
    .bid-req-box.current i:before {opacity: 0;}
    .bid-req-box.current i {
        box-shadow: inset 0px 0px 0px 4px;
        border: solid 1px #15b88b;
    }
    .bid-req-box.pending i {
        background-color: red;
    }
</style>

{{-- new desing end  --}}
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
            <div class="modal fade" id="PickDropSection" data-bs-keyboard="false" data-bs-backdrop="static">
            </div>
        <!--end model-->

        
            <div class="container mt-3 stocks">
                <h2>Load Details</h2>
                <div class="row">
                    <div class="col-md-8">
                        <div class="stocks">

                            <div class="stock-box">
                                <h4>Overall Load Status</h4>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Load_Status</th>
                                        <th>Payment Status</th>
                                        <th>Load Approver</th>
                                        <th>Prepaid Load</th>
                                        {{-- <th>Commodity Weight</th> --}}
                                        {{-- <th>Lenghth</th> --}}

                                      </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="background-color:transparent"><i class="fa fa-truck" aria-hidden="true"></i>
                                            </td>
                                           <td>{{ $shipmentData->shipment_statue }}</td>
                                           <td>Not Received</td>
                                           <td>Super Admin</td>
                                           <td>NO</td>
                                           {{-- <td>{{ $shipmentData->weight_loads }}</td> --}}
                                           {{-- <td>{{ $shipmentData->footage_loads }}</td> --}}
                                          
                                        </tr>
                                        {{-- <tr>
                                            <td>
                                                <i class="fa fa-lock"></i>
                                                NSDL
                                            </td>
                                            <td>12 Sep - 15 Sep 2023</td>
                                            <td>160.00</td>
                                            <td>90</td>
                                            {{-- <td><button class="btn btn-success">Apply</button></td> 
                                        </tr> --}}
                                    </tbody>
                                  </table>
                            </div>

                            <div class="stock-box">
                                <h4>Carrier Details</h4>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Carrier Name</th>
                                        <th>Carrier MC</th>
                                        <th>Carrier DOT</th>
                                        <th>Carrier Address</th>
                                        <th>Carrier Approver</th>
                                        <th>Carrier Approved Date</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            {{-- <td>
                                                <i class="fa fa-lock"></i>
                                                Happiest Minds
                                            </td> --}}
                                            <td>{{$shipmentData->shipment_c_carrier}}</td>
                                            <td>{{$shipmentData->shipment_c_mc}}</td>
                                            <td>{{$shipmentData->shipment_c_dot}}</td>
                                            <td>{{ $shipmentData->customer_address }} TX</td>
                                            <td>Super Admin</td>
                                            <td>15 Sep 2023</td>
                                            {{-- <td><button class="btn btn-success">Status</button></td> --}}
                                        </tr>
                                        {{-- <tr>
                                            <td>
                                                <i class="fa fa-lock"></i>
                                                NSDL
                                            </td>
                                            <td>12 Sep - 15 Sep 2023</td>
                                            <td>160.00</td>
                                            <td>90</td>
                                            <td>90</td>
                                            <td>90</td>
                                            {{-- <td><button class="btn btn-success">Apply</button></td> 
                                        </tr> --}}
                                    </tbody>
                                  </table>
                            </div>

                            <div class="stock-box">
                                <h4>Shipper Details</h4>
                                <table class="table">
                                    <thead>
                                        <tr>
                                         
                                          <th>Shipper Name</th>
                                        <th>Shipper Address </th>
                                        <th>Shipper Limit</th>
                                        <th>Shipper Approver </th>
                                        <th>Shipper Approved Date</th>
                                      

                                      </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                           <td>{{ $shipmentData->customer_name }}</td>
                                           <td>{{ $shipmentData->customer_address }} {{$shipmentData->customer_city}} {{$shipmentData->customer_state}}</td>
                                           <td>{{$shipmentComp->credit_limit}}</td>
                                           <td>Super Admin</td>
                                           <td>15 Sep 2023</td>
                                           {{-- <td>{{ $shipmentData->footage_loads }}</td> --}}
                                          
                                        </tr>
                                        {{-- <tr>
                                            <td>
                                                <i class="fa fa-lock"></i>
                                                NSDL
                                            </td>
                                            <td>12 Sep - 15 Sep 2023</td>
                                            <td>160.00</td>
                                            <td>90</td>
                                            <td>NA</td>
                                        </tr> --}}
                                    </tbody>
                                  </table>
                            </div>


                            
                            <div class="stock-box">
                                <h4>Broker Details</h4>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Broker Name</th>
                                        <th>Broker </th>
                                        <th>Equipment Type</th>
                                        <th>Load Type</th>
                                        {{-- <th>Commodity Weight</th> --}}
                                        <th>Lenghth</th>
                                        <th></th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                           <td> Anon </td>
                                           <td>{{ $shipmentData->shipment_statue }}</td>
                                           <td><?php echo $shipmentData->equipment_loads; ?></td>
                                           <td>{{ $shipmentData->full_partial }}</td>
                                           {{-- <td>{{ $shipmentData->weight_loads }}</td> --}}
                                           <td>{{ $shipmentData->footage_loads }}</td>
                                           <td></td>
                                        </tr>
                                        {{-- <tr>
                                            <td>
                                                <i class="fa fa-lock"></i>
                                                NSDL
                                            </td>
                                            <td>12 Sep - 15 Sep 2023</td>
                                            <td>160.00</td>
                                            <td>90</td> --}}
                                            {{-- <td><button class="btn btn-success">Apply</button></td> --}}
                                        {{-- </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                            
                           
                            
                            <div class="stock-box">
                                <h4>Consignor Details</h4>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Consignor Name</th>
                                        <th>Address</th>
                                        <th>Pickup Date</th>
                                        <th>PO#</th>
                                        <th>Appointment Details</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                          
                                            {{-- <td>
                                                <i class="fa fa-lock"></i>

                                                
                                               
                                            </td> --}}
                                            <td>{{$shipmentpick->p_name}}</td>
                                            <td>  {{$shipmentpick->p_address}} {{$shipmentpick->p_city}}  {{$shipmentpick->p_state}}</td>
                                            <td>{{$shipmentpick->p_ready}}</td>
                                            <td>{{$shipmentpick->p_ref}}</td>
                                            <td>{{$shipmentpick->p_atime}} {{$shipmentpick->p_appt_note}}</td>
                                            {{-- <td><button class="btn btn-success">Status</button></td> --}}
                                        </tr>
                                        {{-- <tr>
                                            <td>
                                                <i class="fa fa-lock"></i>
                                                NSDL
                                            </td>
                                            <td>12 Sep - 15 Sep 2023</td>
                                            <td>160.00</td>
                                            <td>90</td>
                                            {{-- <td><button class="btn btn-success">Apply</button></td>
                                        </tr> --}}
                                    </tbody>
                                  </table>
                            </div>

                            <div id="map" style="height: 200px; width:700px"></div>




                            <div class="stock-box">
                                <h4>Consignee Details</h4>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Consignee Name</th>
                                        <th>Address</th>
                                        <th>Delivery Date</th>
                                        <th>PO#</th>
                                        <th>Appointment Details</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            {{-- <td>
                                                <i class="fa fa-lock"></i>
                                                Happiest Minds
                                            </td> --}}
                                            <td>{{$shipmentdrop->d_name}}</td>
                                            <td>{{$shipmentdrop->d_address}} {{$shipmentdrop->d_city}} {{$shipmentdrop->d_state}}</td>
                                            <td>{{$shipmentdrop->d_ready}}</td>
                                            <td>{{$shipmentdrop->d_ref}}</td>
                                            <td>{{$shipmentdrop->d_atime}} {{$shipmentdrop->d_appt_note}}</td>
                                            {{-- <td><button class="btn btn-success">Status</button></td> --}}
                                        </tr>
                                        {{-- <tr>
                                            <td>
                                                <i class="fa fa-lock"></i>
                                                NSDL
                                            </td>
                                            <td>12 Sep - 15 Sep 2023</td>
                                            <td>160.00</td>
                                            <td>90</td>
                                            {{-- <td><button class="btn btn-success">Apply</button></td> 
                                        </tr> --}}
                                    </tbody>
                                  </table>
                            </div>

                            <div class="stock-box">
                                <h4>Driver Details</h4>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        {{-- <th>S.No</th> --}}
                                        <th>Dispatcher Name</th>
                                        <th>Dispatcher Phone</th>
                                        <th>Dispatcher Email</th>
                                        <th>Driver Name</th>
                                        <th>Driver Phone</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            {{-- <td>
                                                <i class="fa fa-lock"></i>
                                                Happiest Minds
                                            </td> --}}
                                          
                                            <td>{{$shipmentData->shipment_c_dispatcher}}</td>
                                            <td>{{$shipmentData->shipment_c_phone}}</td>
                                            <td>{{$shipmentData->shipment_c_email}}</td>
                                            <td>{{$shipmentData->shipment_c_driver_n}}</td>
                                            <td>{{$shipmentData->shipment_c_driver_p}}</td>
                                        
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                            </div>
                            
                            <div class="stock-box">
                                <h4>Rates</h4>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>S.NO</th>
                                        <th>Shipper Rate</th>
                                        <th>Carrier Rate</th>
                                        <th>DAT Spot Rate</th>
                                        <th>DAT Contract Rate</th>
                                        {{-- <th>COI</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            {{-- <td>
                                                <i class="fa fa-lock"></i>
                                                Happiest Minds
                                            </td> --}}
                                            <td>{{$shipment_rates->customer_total}}</td>
                                            <td>{{$shipment_rates->carrier_total}}</td>
                                            <td>90</td>
                                            <td>NA</td>
                                            <td>NA</td>
                                            
                                        </tr>
                                        
                                    </tbody>
                                  </table>
                            </div>
                            
                            <div class="stock-box">
                                <h4>Approver Details</h4>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Shipper Approver</th>
                                        <th>Shipper Limit</th>
                                        <th>Carrier Approver</th>
                                        <th>Carrier Limit</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            {{-- <td>
                                                <i class="fa fa-lock"></i>
                                                Happiest Minds
                                            </td> --}}
                                            <td>1</td>
                                            <td>Super Admin</td>
                                            <td>{{$shipmentComp->credit_limit}}</td>
                                            <td>Super Admin</td>
                                            <td>NA</td>
                                            {{-- <td><button class="btn btn-success">Status</button></td> --}}
                                        </tr>
                                        {{-- <tr>
                                            <td>
                                                <i class="fa fa-lock"></i>
                                                NSDL
                                            </td>
                                            <td>12 Sep - 15 Sep 2023</td>
                                            <td>160.00</td>
                                            <td>90</td>
                                            {{-- <td><button class="btn btn-success">Apply</button></td>
                                        </tr> --}}
                                    </tbody>
                                  </table>
                            </div>
                            
                            <div class="stock-box">
                                <h4>Load Documents</h4>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>RC</th>
                                        <th>BOL</th>
                                        <th>POD</th>
                                        <th>MC</th>
                                        <th>COI</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{-- <i class="fa fa-lock"></i> --}}
                                               1
                                            </td>
                                            
                                            <td>
                                                <a href="<?php echo url('/admin/carrier-rate-pdf').'/'.($shipmentData->id); ?>" target="_blank" >
                                                    <i class="fa fa-download"></i>
                                                </a>
                                            </td>

                                            @foreach ($shipment_doc as $item)
                                                
                                         

                                               <td><a href="" ><i class="fa fa-download"></i></a></td>
                                               <td>
                                                <a href="{{ url('/admin/carrier-bol').'/'.$shipmentData->id }}" target="_blank">
                                                    <i class="fa {{ $item->pod ? 'fa-download  green-icon' : 'fa-times-circle  red-icon' }}"></i>
                                                </a>
                                               </td>
                                                <td>
                                                    <a href="#" target="_blank">
                                                        <i class="fa {{ $item->document_name ? 'fa-download  green-icon' : 'fa-times-circle  red-icon' }}"></i>
                                                    </a>
                                                    </td>
                                                    <td>
                                                        <a href="#" target="_blank">
                                                            <i class="fa {{ $item->document_name ? 'fa-download  green-icon' : 'fa-times-circle  red-icon' }}"></i>
                                                        </a>
                                                        </td>
                                                        
                                                
                                            
                                              
                                            @endforeach
                                            {{-- <td><button class="btn btn-success">Status</button></td> --}}
                                        </tr>
                                       
                                    </tbody>
                                  </table>
                            </div>





                            <div class="stock-box">
                                <h4>Instructions</h4>
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Shipper Instructions</th>
                                        <th>Carrier Instructions</th>
                                        <th>Pickup Appointment Notes</th>
                                        <th>Drop Appointment Notes</th>
                                        {{-- <th>COI</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <i class="fa fa-lock"></i>
                                                
                                            </td>
                                            <td>{{$shipmentData->shipment_shipper_instruction}}</td>
                                            <td>{{$shipmentData->shipment_shipper_instruction}}</td>
                                            <td>{{$shipmentpick->p_appt_note}}</td>
                                            <td>{{$shipmentdrop->d_appt_note}}</td>
                                            {{-- <td><button class="btn btn-success">Status</button></td> --}}
                                        </tr>
                                      
                                    </tbody>
                                  </table>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="stocks-sidebar">
                            <p><strong>Ref. No</strong> {{ $shipmentData->ref_loads }}</p>
                            <div class="bid-req">
                                <div class="bid-req-box success">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Load Created
                                        <span>{{$shipmentData->created_at}}</span>
                                    </p>
                                </div>
                                
                                <div class="bid-req-box success">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Load Picked
                                        <span>{{$shipmentpick->p_ready}}</span>
                                       
                                    </p>
                                </div>
                                
                                <div class="bid-req-box current">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Load In-transit
                                        <span>2023-21-09</span>
                                    </p>
                                </div>
                                <div class="bid-req-box current">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Load Delivered
                                        <span>{{$shipmentdrop->d_ready}}</span>
                                    </p>
                                </div>
                                <div class="bid-req-box pending">
                                    <i class="fa fa-times"></i>                                    <p>
                                        Payment Received
                                        <span>No</span>
                                    </p>
                                </div>
                            </div>

                            <div class="bid-req">
                                <div class="bid-req-box success">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Origin
                                        <span>
                                            
                                            {{$shipmentpick->p_address}},     {{$shipmentpick->p_city}}  {{$shipmentpick->p_state}}
                                           
                                        </span>
                                    </p>
                                </div>
                                
                                <div class="bid-req-box success">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Destination
                                        <span>
                                            {{-- <td>{{$shipmentdrop->d_name}}</td> --}}
                                            <td>{{$shipmentdrop->d_address}} {{$shipmentdrop->d_city}} {{$shipmentdrop->d_state}}</td>
                                            {{-- <td>{{$shipmentdrop->d_ready}}</td> --}}

                                        </span>
                                    </p>
                                </div>
                                
                                <div class="bid-req-box success">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Shipper Charges
                                        <span>{{$shipment_rates->customer_total}}</span>
                                    </p>
                                </div>
                                
                                <div class="bid-req-box current">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Carrier Charges
                                        <span>{{$shipment_rates->carrier_total}}</span>
                                    </p>
                                </div>
                                
                                <div class="bid-req-box pending">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Disputed Load
                                        <span>No</span>
                                    </p>
                                </div>
                                <div class="bid-req-box pending">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        AR Payment
                                        <span>No</span>
                                    </p>
                                </div>
                                
                                <div class="bid-req-box pending">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        AP Payment 
                                        <span>No</span>
                                    </p>
                                </div>
                            </div>
                            
                            {{-- <div class="bid-req">
                                <div class="bid-req-box success">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Bid Requested
                                        <span>15 Sep 2023</span>
                                    </p>
                                </div>
                                
                                <div class="bid-req-box success">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Payment Successful
                                        <span>17 Sep 2023</span>
                                    </p>
                                </div>
                                
                                <div class="bid-req-box success">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Bid Accepted
                                        <span>20 Sep 2023</span>
                                    </p>
                                </div>
                                
                                <div class="bid-req-box current">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        IPOS Closed
                                        <span>15 Sep 2023</span>
                                    </p>
                                </div>
                                
                                <div class="bid-req-box pending">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Allotment Finalisation
                                        <span>15 Sep 2023</span>
                                    </p>
                                </div>
                                <div class="bid-req-box pending">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Allotment Finalisation
                                        <span>15 Sep 2023</span>
                                    </p>
                                </div>
                                
                                <div class="bid-req-box pending">
                                    <i class="fa fa-check"></i>
                                    <p>
                                        Allotment Finalisation
                                        <span>15 Sep 2023</span>
                                    </p>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
        </div>


      
<!-- start new here  ****************************************-->

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


<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

{{-- <script>
    var map = L.map('map').setView([39.0997, -94.5786], 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker = L.marker([39.0997, -94.5786]).addTo(map);
    marker.bindPopup("<b>FInally Implemented!</b><br>Congrats buddy!").openPopup();
</script> --}}

<script>
    
</script>

<script>
    var map = L.map('map').setView([30.0, -95.0], 5); // Center the map to a default location (e.g., near the center of the United States).

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

    var markerTX = L.marker([31.0, -100.0]).addTo(map);

    var markerFL = L.marker([27.9944024, -81.7602549]).addTo(map); // Coordinates for central Florida.
    // markerFL.bindPopup("<b>Florida</b>");

    var polyline = L.polyline([
        [31.0, -100.0], // Texas
        [27.9944024, -81.7602549] // Florida
    ], { className: 'distance-line' }).addTo(map);

    var newloc = [39.0, -100.12]
    // var newloc2= [44.90]


    // L.marker(newloc).addTo(map);

    
    map.fitBounds(markers.getBounds().extend(polyline.getBounds()));

</script>





@include('backend.common.footer')
@endsection