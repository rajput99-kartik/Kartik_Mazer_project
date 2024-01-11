
@extends('backend.layouts.master')
@section('title','Shipper BOL Item')
@section('content')
<style>
    input::placeholder{opacity:.5!important}select{color:#000000ad!important}h3.card-title{font-size:13px!important}div#documents_toggle{padding-bottom:3px}td.greeninput input{color:green!important}td.redinput input{color:red!important}.doc img{position:unset!important;width:50px!important}form#shipmentupdateBol .row{display:block}form#shipmentupdateBol .col-sm-9{width:100%}form#shipmentupdateBol label{width:100%;padding-top:0;color:#000;font-weight:600;font-size:12px}form#shipmentupdateBol input,form#shipmentupdateBol select,form#shipmentupdateBol textarea{border:1px solid #0003;padding:0 12px;border-radius:3px;border-bottom-color:#1e55bf!important}form#shipmentupdateBol input:hover,form#shipmentupdateBol select:hover,form#shipmentupdateBol textarea:hover{border-bottom-color:#1e55bf!important}.card{border-color:#00416c!important}.text-info{color:#091416!important}
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
            <li class="pending_approval active"><a href="#" data-toggle="tab" aria-expanded="true">Edit Shipments</a>
            </li>
        </ul>
        
        <!--pic & deop model-->
            <div class="modal fade" id="PickDropSection" data-bs-keyboard="false" data-bs-backdrop="static">
            </div>
        <!--end model-->
        <div class="row">
            <div class="abc">
                <div class="card">
                    <div class="row">
                            {{-- <div class="col-md-4">
                                <div class="shipment-status pick_drop">
                                    <button id="btnPickDropFrom" class="btn btn-primary" data-toggle="tab" aria-expanded="false" value="{{ $shipmentid }}">Pick (2) & Drop (1)</button>  <br>
                                 </div>
                            </div>

                            <div class="col-md-4">
                                <div style="margin-top:23px;">
                                    <a href="<?php //echo url('/admin/carrier-bol').'/'.($shipmentid); ?>" target="_blank" class="btn btn-success">
                                       Multipal Carrier BOL
                                    </a>
                                </div>
                            </div> --}}

                            <div class="col-md-4">
                            </div>
                    </div>
                </div>
                </div>
                    <div class="col-xl-12 mx-auto">
                        <div class="card  border-primary shipper_caont"></div>                
                        <div class="card-body p-3 ">
                            <div class="row g-3">
                                <div class="row">
                                    {{-- Add Shipper Bol Here Start --}}
                                    <div class="col-md-4">
                                        <form action="{{url('admin/shipment-bol-update')}}" id="shipmentupdateBol" method="POST" enctype="multipart/form-data" class="placeholder-form">  
                                            @csrf
                                            <div class="card border-top border-0 border-4 border-info">
                                                <div class="card-body">
                                                    <div class="border p-4 rounded">
                                                        <div class="card-title d-flex align-items-center">
                                                            <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                                            </div>
                                                            <h5 class="mb-0 text-info">Shipper BOL Item</h5>
                                                        </div>
                                                        <hr>

                                                        <div class="row mb-3">
                                                            <label for="inputPhoneNo2" class="col-sm-3 col-form-label">No Of Pieces</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="ofpieces" id="ofpieces" autocomplete="off" placeholder="No Of Pieces" value="">

                                                                <input type="hidden" class="form-control form-control-sm mb-3" name="shipid"  value="{{ $shipmentid }}">
                                                                @php
                                                                    $shipboldatas =  App\Models\ShipmentBol::where('id',$shipmentid)->select('shipment_id','shipdrop_address')->first(); 

                                                                   // dd($shipboldatas);
                                                                @endphp
                                                                <input type="hidden" class="form-control form-control-sm mb-3" name="shipmentbolid"  value="{{ $shipboldatas->shipment_id }}">

                                                                <input type="hidden" name="shipmentDropid" value="{{ $shipboldatas->shipdrop_address}}" >
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="inputEmailAddress2" class="col-sm-3 col-form-label"> NMFC</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="nmfc" id="nmfc" placeholder="NMFC" value="">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="weight" class="col-sm-3 col-form-label">Weight</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="weight" id="weight" placeholder="Weight / LBS" value="">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="type" class="col-sm-3 col-form-label">Type</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="type" id="type" placeholder="Type" value="">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="type" class="col-sm-3 col-form-label">Hazmat</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="hazmat" id="hazmat" placeholder="Hazmat" value="">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="type" class="col-sm-3 col-form-label">Class</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="productclass" id="productclass" placeholder="Product Class" value="">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="type" class="col-sm-3 col-form-label">Delivery Date</label>
                                                            <div class="col-sm-9">
                                                                <input type="date" class="form-control form-control-sm mb-3" name="delivery_date" id="delivery_date" placeholder="Delivery Date" value="">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row mb-3">
                                                            <label for="Descriptions" class="col-sm-3 col-form-label">Descriptions</label>
                                                            <div class="col-sm-9">
                                                                <textarea class="form-control" name="descriptions" id="Descriptions" rows="3" placeholder="Descriptions"></textarea>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="notes" class="col-sm-3 col-form-label">Note's</label>
                                                            <div class="col-sm-9">
                                                                <textarea class="form-control" name="notes" id="notes" rows="3" placeholder="Note's"></textarea>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="row">
                                                            <label class="col-sm-3 col-form-label"></label>
                                                            <div class="col-sm-9">
                                                                <button type="submit" class="btn btn-info px-5">Add Bol Item</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- Add Shipper Bol Here End --}}
                                    <div class="col-md-8">  
                                        <div class="card card-primary">
                                            <div class="card border-top border-0 border-4 border-info">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-center">
                                                        <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                                        </div>
                                                        <h5 class="mb-0 text-info">Shipper BOL Item</h5>
                                                    </div>
                                                    <div>
                                                        <a href="{{ url('admin/shipment-bol').'/'.base64_encode($shipboldatas->shipment_id) }}">
                                                        <span style="float:right !important; margin: -36px 0px 3px 13px; color:#0b7b9c;" > Back</span></a>
                                                     </div>

                                                    <div class="card-body">
                                                        <div class="table-responsive" style="overflow: auto;">
                                                            <table id="example2" class="table table-striped table-bordered">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>No Of Pieces</th>
                                                                        <th>NMFC</th>
                                                                        <th>Weight</th>
                                                                        <th>Type</th>
                                                                        <th>Hazmat</th>
                                                                        <th>Class</th>
                                                                        <th>Desc</th>
                                                                        <th>Note</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="shipment_filter">
                                                                    @php
                                                                        $i = 0;

                                                                        $shipboldatas =  App\Models\ShipmentBolItem::where('shipment_bolid',$shipmentid)->get(); 
                                                                        // $post->category->name ?? 'No category'
                                                                    @endphp 
                                                                    
                                                                    

                                                                    @foreach ( $shipboldatas as  $shipboldata)
                                                                        @php
                                                                           
                                                                        @endphp                                                     
                                                                        <tr>
                                                                            <td>{{ ++$i }}</td>
                                                                            <td class="copy-text">{{ isset($shipboldata['ofpieces']) ? $shipboldata['ofpieces'] :Null  }}</td>
                                                                            <td class="copy-text">{{isset($shipboldata['nmfc']) ? $shipboldata['nmfc'] :Null }}</td>
                                                                            <td class="copy-text">{{ isset($shipboldata['weight']) ? $shipboldata['weight'] :Null }}</td>
                                                                            <td class="copy-text">{{ isset($shipboldata['type']) ? $shipboldata['type'] :Null }}</td>
                                                                            <td class="copy-text">{{ isset($shipboldata['hazmat']) ? $shipboldata['hazmat'] :Null }}</td>
                                                                            <td class="copy-text">{{ isset($shipboldata['productclass']) ? $shipboldata['productclass'] :Null }}</td>
                                                                            <td class="copy-text">{{ isset($shipboldata['descriptions']) ? $shipboldata['descriptions'] :Null }}</td>
                                                                            <td class="copy-text">{{ isset($shipboldata['notes']) ? $shipboldata['notes'] :Null }}</td>  

                                                                            
                                                                                <td>
                                                                                    {{-- <a href="{{url('admin/shipment-bol/item/update').'/'.$shipboldata->id}}"><i class="lni lni-download"></i>
                                                                                    </a> | --}}

                                                                                    <a href="{{url('admin/shipment-bol/item/edit').'/'.base64_encode($shipboldata->id)}}"><i class="fadeIn animated bx bx-edit"></i></a>
                                                                                    {{-- <a href="{{url('admin/shipment-bol/item/edit').'/'.base64_encode($shipboldata->id)}}"><i class="fadeIn animated bx bx-edit"></i></a> --}}
                                                                                </td>
                                                                            
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
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
                </div>
            </div>
        </div>
<!-- start new here  ****************************************-->

</div>
</div>
<!--end page wrapper -->



{{-- //add bol start --}}



@include('backend.common.footer')
@endsection