
@extends('backend.layouts.master')
@section('title','Shipper BOL Item')
@section('content')
<style>
    input::placeholder{opacity:.5!important}select{color:#000000ad!important}h3.card-title{font-size:13px!important}div#documents_toggle{padding-bottom:3px}td.greeninput input{color:green!important}td.redinput input{color:red!important}.doc img{position:unset!important;width:50px!important}form#shipmentupdateBol .row{display:block}form#shipmentupdateBol .col-sm-9{width:100%}form#shipmentupdateBol label{width:100%;padding-top:0;color:#000;font-weight:600;font-size:12px}form#shipmentupdateBol input,form#shipmentupdateBol select,form#shipmentupdateBol textarea{border:1px solid #0003;padding:0 12px;border-radius:3px;border-bottom-color:#1e55bf!important}form#shipmentupdateBol input:hover,form#shipmentupdateBol select:hover,form#shipmentupdateBol textarea:hover{border-bottom-color:#1e55bf!important}.card{border-color:#00416c!important}.text-info{color:#0b7b9c!important}
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
                                    <div class="col-md-3">

                                    </div>
                                    <div class="col-md-6">
                                        
                                        <form action="{{url('admin/shipment-bol/item/edit').'/'.base64_encode($shipmentid)}}" id="shipmentupdateBol" method="POST" enctype="multipart/form-data" class="placeholder-form">  
                                            @csrf
                                            <div class="card border-top border-0 border-4 border-info">
                                                <div class="card-body">
                                                    <div class="border p-4 rounded">
                                                        <div class="card-title d-flex align-items-center">
                                                            <div><i class="bx bxs-user me-1 font-22 text-info"></i>
                                                            </div>
                                                            <h5 class="mb-0 text-info">Shipper BOL Item Update</h5>
                                                        </div>
                                                        <div>
                                                            <a href="{{ url()->previous() }}">
                                                            <span style="float:right !important; margin: -36px 0px 3px 13px; color:#0b7b9c;" > Back</span></a>
                                                         </div>
                                                        <hr>

                                                        <div class="                       row mb-3">
                                                            <label for="inputPhoneNo2" class="col-sm-3 col-form-label">No Of Pieces</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="ofpieces" id="ofpieces" autocomplete="off" placeholder="No Of Pieces" value="{{ $shpitemupdate->ofpieces ?? 'N/A'}}">

                                                                
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="inputEmailAddress2" class="col-sm-3 col-form-label"> NMFC</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="nmfc" id="nmfc" placeholder="NMFC" value="{{ $shpitemupdate->nmfc ?? 'N/A'}}">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="weight" class="col-sm-3 col-form-label">Weight</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="weight" id="weight" placeholder="Weight / LBS" value="{{ $shpitemupdate->weight ?? 'N/A'}}">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="type" class="col-sm-3 col-form-label">Type</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="type" id="type" placeholder="Type" value="{{ $shpitemupdate->type ?? 'N/A'}}">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="type" class="col-sm-3 col-form-label">Hazmat</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="hazmat" id="hazmat" placeholder="Hazmat" value="{{ $shpitemupdate->hazmat ?? 'N/A'}}">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="type" class="col-sm-3 col-form-label">Class</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control form-control-sm mb-3" name="productclass" id="productclass" placeholder="Product Class" value="{{ $shpitemupdate->productclass ?? 'N/A'}}">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="type" class="col-sm-3 col-form-label">Delivery Date</label>
                                                            <div class="col-sm-9">
                                                                <input type="date" class="form-control form-control-sm mb-3" name="delivery_date" id="delivery_date" placeholder="Delivery Class" 
                                                                value="{{ $shpitemupdate->ed ?? 'N/A'}}">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row mb-3">
                                                            <label for="Descriptions" class="col-sm-3 col-form-label">Descriptions</label>
                                                            <div class="col-sm-9">
                                                                <textarea class="form-control" name="descriptions" id="Descriptions" rows="3" placeholder="Descriptions">{{ $shpitemupdate->descriptions ?? 'N/A'}}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="notes" class="col-sm-3 col-form-label">Note's</label>
                                                            <div class="col-sm-9">
                                                                <textarea class="form-control" name="notes" id="notes" rows="3" placeholder="Note's">{{ $shpitemupdate->notes ?? 'N/A'}}</textarea>
                                                            </div>
                                                        </div>
                                                    
                                                        <div class="row">
                                                            <label class="col-sm-3 col-form-label"></label>
                                                            <div class="col-sm-9">
                                                                <button type="submit" class="btn btn-info px-5">Update Bol Item</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    {{-- Add Shipper Bol Here End --}}
                                    <div class="col-md-2">

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