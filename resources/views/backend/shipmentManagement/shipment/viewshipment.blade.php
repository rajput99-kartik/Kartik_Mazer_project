@extends('backend.layouts.master')
@section('title','Edit Shipment')
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
            <li class="pending_approval"><a href="{{url('/admin/shipment/list')}}" data-toggle="tab" aria-expanded="true">All Shipments</a>
            </li>
            
            <li class="pending_approval"><a href="{{url('/admin/shipment')}}" data-toggle="tab" aria-expanded="true">Shipments</a>
            </li>
            <li class="pending_approval active"><a href="#" data-toggle="tab" aria-expanded="true">View Shipments</a>
            </li>
        </ul>
        
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card  border-primary shipper_caont">
                    <div class="card-body p-3 ">
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
                            <div class="shipment-status">
                                <div class="load-no">
                                    <p>{{$value}}# <span>{{ isset($Limit) ? $Limit : null }}</span></p>
                                </div>
                                <!-- <div class="status">
                                    <p>Status: <span>{{ $shipmentData->shipment_statue }}</span></p>
                                </div> -->
                            </div>
                            @endif
                        </div>
                        
                        <div class="row">
                            <diiv class="col-md-6">
                                <div class="shipment_view_box">
                                    <h4>Shipment Detail</h4>
                                    <div class="shipment_box_txt">
                                        
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

@include('backend.common.footer')
@endsection