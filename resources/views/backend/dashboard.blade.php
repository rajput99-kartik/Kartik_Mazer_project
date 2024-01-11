@extends('backend.layouts.master')
@section('title','Dashboard')
@section('content')

<link rel="stylesheet" href="{{ url(BACKEND_CSS_PATH.'/dashboardstyle.css') }}" />
<style>
    nav.flex.items-center.justify-between {
    margin-top: -35px;
}

</style>
    <div class="page-wrapper">
        <div class="page-content">
                <?php 
                    $userid = Auth::id();
                    $user_id =app\Models\User::where('id', $userid)->first();
                    $uid = $user_id->status ;
                ?>
                <?php
                if($user_id->user_type=='super_admin'){ ?>
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                    <div class="col">

                        <a href="{{url('admin/load/reports/list')}}">

                            <div class="card radius-10 bg-gradient-deepblue">

                                <div class="card-body">

                                    <div class="d-flex align-items-center">

                                        <h5 class="mb-0 text-white">{{$tloads}}</h5>

                                        <div class="ms-auto">

                                            <i class='bx bx-plus fs-3 text-white'></i>

                                        </div>

                                    </div>

                                    <div class="progress my-2 bg-white-transparent" style="height:4px;">

                                        <div class="progress-bar bg-white" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                    <div class="d-flex align-items-center text-white">

                                        <p class="mb-0">Total Loads</p>

                                        <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>
                    <div class="col">

                        <a href="{{url('admin/users')}}">

                        <div class="card radius-10 bg-gradient-ohhappiness">

                            <div class="card-body">

                                <div class="d-flex align-items-center">

                                    <h5 class="mb-0 text-white">{{$tusers}}</h5>

                                    <div class="ms-auto">

                                        <i class='bx bx-group fs-3 text-white'></i>

                                    </div>

                                </div>

                                <div class="progress my-2 bg-white-transparent" style="height:4px;">

                                    <div class="progress-bar bg-white" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>

                                <div class="d-flex align-items-center text-white">

                                    <p class="mb-0">Total Users</p>

                                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>

                                </div>

                            </div>

                        </div>

                        </a>

                    </div>
                    <div class="col">
                        <div class="card radius-10 bg-gradient-ibiza">
                        <a href="{{url('admin/shipper/list')}}">	

                            <div class="card-body">

                                <div class="d-flex align-items-center" style="padding: 9px 0px;">

                                    <h5 class="mb-0 text-white">{{$tshipper}}</h5>

                                    <div class="ms-auto">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather fs-3 text-white feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>

                                    </div>

                                </div>

                                <div class="progress my-2 bg-white-transparent" style="height:4px;">

                                    <div class="progress-bar bg-white" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>

                                <div class="d-flex align-items-center text-white">

                                    <p class="mb-0">Total Shipper</p>

                                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>

                                </div>

                            </div>

                        </a>
                        </div>
                    </div>
                    <div class="col">

                        <a href="{{url('admin/carrier/list')}}">

                            <div class="card radius-10 bg-gradient-moonlit">

                                <div class="card-body">

                                    <div class="d-flex align-items-center" style="padding: 6px 0px;">

                                        <h5 class="mb-0 text-white">{{$tcarrier}}</h5>

                                        <div class="ms-auto">

                                            <i class='lni lni-graduation fs-3 text-white'></i>

                                        </div>

                                    </div>

                                    <div class="progress my-2 bg-white-transparent" style="height:4px;">

                                        <div class="progress-bar bg-white" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                    <div class="d-flex align-items-center text-white">

                                        <p class="mb-0">Total Carrier</p>

                                        <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>
                </div>
                <?php } ?>

                {{-- end top menu here --}}
                {{-- Dashboard For Normal User Like Agent, Admin, Manager User Start here--}}
                @can('dashboard-normal-user')
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                    <div class="col">
                        <a href="{{url('admin/loads')}}">

                            <div class="card radius-10 bg-gradient-deepblue">

                                <div class="card-body">

                                    <div class="d-flex align-items-center">

                                        <h5 class="mb-0 text-white">{{$tloads}}</h5>

                                        <div class="ms-auto">

                                            <i class='bx bx-plus fs-3 text-white'></i>

                                        </div>

                                    </div>

                                    <div class="progress my-2 bg-white-transparent" style="height:4px;">

                                        <div class="progress-bar bg-white" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                    <div class="d-flex align-items-center text-white">

                                        <p class="mb-0">Total Loads</p>

                                        <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>
                    <div class="col">
                        <a href="{{url('admin/shipment')}}">

                        <div class="card radius-10 bg-gradient-ohhappiness">

                            <div class="card-body">

                                <div class="d-flex align-items-center">

                                    <h5 class="mb-0 text-white"><?php echo $tshipment ?></h5>

                                    <div class="ms-auto">

                                        <i class='bx bx-group fs-3 text-white'></i>

                                    </div>

                                </div>

                                <div class="progress my-2 bg-white-transparent" style="height:4px;">

                                    <div class="progress-bar bg-white" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>

                                <div class="d-flex align-items-center text-white">

                                    <p class="mb-0">Total Shipment</p>

                                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>

                                </div>

                            </div>

                        </div>

                        </a>

                    </div>
                    <div class="col">
                        <div class="card radius-10 bg-gradient-ibiza">
                        <a href="{{url('admin/shipper')}}">	

                            <div class="card-body">

                                <div class="d-flex align-items-center" style="padding: 9px 0px;">

                                    <h5 class="mb-0 text-white">{{$tshipper}}</h5>

                                    <div class="ms-auto">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather fs-3 text-white feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>

                                    </div>

                                </div>

                                <div class="progress my-2 bg-white-transparent" style="height:4px;">

                                    <div class="progress-bar bg-white" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>

                                <div class="d-flex align-items-center text-white">

                                    <p class="mb-0">Total Shipper</p>

                                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>

                                </div>

                            </div>

                        </a>
                        </div>
                    </div>
                    <div class="col">

                        <a href="{{url('admin/carrier')}}">

                            <div class="card radius-10 bg-gradient-moonlit">

                                <div class="card-body">

                                    <div class="d-flex align-items-center" style="padding: 6px 0px;">

                                        <h5 class="mb-0 text-white">{{$tcarrier}}</h5>

                                        <div class="ms-auto">

                                            <i class='lni lni-graduation fs-3 text-white'></i>

                                        </div>

                                    </div>

                                    <div class="progress my-2 bg-white-transparent" style="height:4px;">

                                        <div class="progress-bar bg-white" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                    <div class="d-flex align-items-center text-white">

                                        <p class="mb-0">Total Carrier</p>

                                        <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>
                </div>
                @endcan

                {{-- Dashboard For Ap User Start here--}}
                @can('dashboard-ap-user')
                <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                    <div class="col">

                        <a href="{{url('admin/carrier/urgent/payment')}}">

                            <div class="card radius-10 bg-gradient-deepblue">

                                <div class="card-body">

                                    <div class="d-flex align-items-center">
                                            @php
                                            $apUrgentpayments_total = '';
                                            $i=0;
                                            @endphp
                                            @foreach ($apUrgentpayments as $key => $cac)
                                                 @php
                                                    $apUrgentpayments_total = App\Models\AccountsPayable::where('shipment_id',$cac->shipment_id)->where('aging_status','1')->where('pay_complete','0')->first();
                                                    if(isset($apUrgentpayments_total)){
                                                        @endphp
                                                        <h5 class="mb-0 text-white"><?php ++$i ; ?></h5>
                                                        @php  }
                                                $apUrgentpayments_total = $apUrgentpayments_total;
                                                @endphp
                                            @endforeach
                                            <h5 class="mb-0 text-white">{{ $i }}</h5>
                                        <div class="ms-auto">
                                            
                                            <i class='bx bx-plus fs-3 text-white'></i>

                                        </div>

                                    </div>

                                    <div class="progress my-2 bg-white-transparent" style="height:4px;">

                                        <div class="progress-bar bg-white" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                    <div class="d-flex align-items-center text-white">

                                        <p class="mb-0">Urgent Payments</p>

                                        <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>
                    <div class="col">

                        <a href="{{url('admin/carrier/payment/updates')}}">

                        <div class="card radius-10 bg-gradient-ohhappiness">

                            <div class="card-body">

                                <div class="d-flex align-items-center">

                                    <h5 class="mb-0 text-white">{{$apPaymentpending}}</h5>

                                    <div class="ms-auto">

                                        <i class='bx bx-group fs-3 text-white'></i>

                                    </div>

                                </div>

                                <div class="progress my-2 bg-white-transparent" style="height:4px;">

                                    <div class="progress-bar bg-white" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>

                                <div class="d-flex align-items-center text-white">

                                    <p class="mb-0">Payments Pending</p>

                                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>

                                </div>

                            </div>

                        </div>

                        </a>

                    </div>
                    <div class="col">
                        <div class="card radius-10 bg-gradient-ibiza">
                        <a href="{{url('admin/carrier/payment/aging')}}">	

                            <div class="card-body">

                                <div class="d-flex align-items-center" style="padding: 9px 0px;">

                                    <h5 class="mb-0 text-white">{{$carrierAging}}</h5>

                                    <div class="ms-auto">

                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather fs-3 text-white feather-truck"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg>

                                    </div>

                                </div>

                                <div class="progress my-2 bg-white-transparent" style="height:4px;">

                                    <div class="progress-bar bg-white" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                                </div>

                                <div class="d-flex align-items-center text-white">

                                    <p class="mb-0">Carrier Aging</p>

                                    <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>

                                </div>

                            </div>

                        </a>
                        </div>
                    </div>
                    <div class="col">

                        <a href="{{url('admin/carrierac')}}">

                            <div class="card radius-10 bg-gradient-moonlit">

                                <div class="card-body">

                                    <div class="d-flex align-items-center" style="padding: 6px 0px;">

                                        <h5 class="mb-0 text-white">{{$aptotalCarrier}}</h5>

                                        <div class="ms-auto">

                                            <i class='lni lni-graduation fs-3 text-white'></i>

                                        </div>

                                    </div>

                                    <div class="progress my-2 bg-white-transparent" style="height:4px;">

                                        <div class="progress-bar bg-white" style="width: 100%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>

                                    </div>

                                    <div class="d-flex align-items-center text-white">

                                        <p class="mb-0">Total Carrier</p>

                                        <p class="mb-0 ms-auto"><span><i class='bx bx-up-arrow-alt'></i></span></p>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </div>
                </div>
                @endcan
                {{-- Dashboard For Ap User End here--}}

                @can('dashboard-load-report')
                <div class="row">
                    <div class="col-12 col-lg-8 col-xl-8 d-flex" id="loadchartdata">

                        <div class="card radius-10 w-100">

                            <div class="row" >

                                <div class="col-md-12">
                                    <div id="number_format_chart">
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    {{-- chart start --}}
                    <div class="col-12 col-lg-4 col-xl-4 d-flex">

                        <div class="card radius-10 overflow-hidden w-100">

                            <div class="card-body">

                                <div class="chart-js-container3">

                                    {{-- <canvas id="slider"></canvas> --}}

                                    {{-- <div id="container"></div> --}}

                                    <table class="table mb-0" id="loadfull" style="display:none">

                                        <thead class="table-light">
                                            <tr>
                                                
                                                <th>Load Type</th>
                                            </tr>
                                        </thead>
                                        <tbody id="lodetypeerStatus">

                                        @php $i=1;

                                        @endphp

                                            @foreach($loadfull as $user_load)

                                        <tr class="odd">

                                            <td class="copy-text">{{ $user_load->full_partial_tl_ltl }}</td>
                                            </tr>

                                            @endforeach

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>
                    {{-- chart-end --}}
                </div>
                @endcan



                {{-- //style new --}}



                {{-- <div class="card radius-10 w-100" style="margin-top: 10px; padding-top: 40px;">

                    <div class="card-body">

                        <h2 class="text text-primary postion-heading">Shipment Status</h2>

                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-4 g-3">

                            <div class="col">

                                <div class="p-3 text-center border radius-10">

                                    <?php

                                       function count_shipper($countshiper, $totalshipper) {

                                           if($totalshipper > 0){

                                            $percentage = ($countshiper*100)/$totalshipper;

                                            return number_format($percentage);

                                           }

                                        }

                                    ?>

                                    <div class="progressbar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo count_shipper($tCoverd, $tshipment); ?>">

                                        

                                        <h4>Covered</h4>

                                        <p>{{$tCoverd}} / {{$tshipment}}</p>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="p-3 text-center border radius-10">

                                    <div class="progressbar approve" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo count_shipper($tDelivered, $tshipment); ?>">

                                        <h4>Delivered</h4>

                                        <p>{{$tDelivered}} / {{$tshipment}}</p>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="p-3 text-center border radius-10">

                                    <div class="progressbar disapprove" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo count_shipper($tIntransit, $tshipment); ?>">

                                        <h4>In-transit</h4>

                                        <p>{{$tIntransit}} / {{$tshipment}}</p>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="p-3 text-center border radius-10">

                                    <div class="progressbar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo count_shipper($tOpen, $tshipment); ?>">

                                        <h4>Open</h4>

                                        <p>{{$tOpen}} / {{$tshipment}}</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!--end row-->

                

                    </div>

                </div> --}}

                
                @can('dashboard-shipment-status')				
                <div class="card radius-10 overflow-hidden">

                    <div class="card-body">

                        <h2 class="dashoard-heading" style="margin-bottom:20px;">Shipment Status</h2>

                        <div class="row shipment_status">

                            <div class="col">

                                <div class="p-3 text-center border radius-10">

                                    <?php

                                       function count_shipper($countshiper, $totalshipper) {

                                           if($totalshipper > 0){

                                            $percentage = ($countshiper*100)/$totalshipper;

                                            return number_format($percentage);

                                           }

                                        }

                                    ?>

                                    <div class="progressbar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo count_shipper($tCoverd, $tshipment); ?>">

                                        

                                        <h4>Covered</h4>

                                        <p>{{$tCoverd}} / {{$tshipment}}</p>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="p-3 text-center border radius-10">

                                    <div class="progressbar approve" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo count_shipper($tDelivered, $tshipment); ?>">

                                        <h4>Delivered</h4>

                                        <p>{{$tDelivered}} / {{$tshipment}}</p>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="p-3 text-center border radius-10">

                                    <div class="progressbar disapprove" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo count_shipper($tIntransit, $tshipment); ?>">

                                        <h4>In-transit</h4>

                                        <p>{{$tIntransit}} / {{$tshipment}}</p>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="p-3 text-center border radius-10">

                                    <div class="progressbar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo count_shipper($tOpen, $tshipment); ?>">

                                        <h4>Open</h4>

                                        <p>{{$tOpen}} / {{$tshipment}}</p>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="p-3 text-center border radius-10">

                                    <div class="progressbar disapprove" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo count_shipper($tPaid, $tshipment); ?>">

                                        <h4>Paid</h4>

                                        <p>{{$tPaid}} / {{$tshipment}}</p>

                                    </div>

                                </div>

                            </div>

                            <div class="col">

                                <div class="p-3 text-center border radius-10">

                                    <div class="progressbar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:<?php echo count_shipper($tInvoiced, $tshipment); ?>">

                                        <h4>Invoiced</h4>

                                        <p>{{$tInvoiced}} / {{$tshipment}}</p>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <!--end row-->

                    </div>

                </div>
                @endcan


                <div class="row">
                    @can('dashboard-user-report')

                    <div class="col-12 col-lg-4 col-xl-4 d-flex">

                        <div class="card radius-10 overflow-hidden w-100">

                            <div class="card-body">

                                <table class="table mb-0" id="alluser" style="display:none">

                                    <thead class="table-light">

                                        <tr>

                                            <th>User Type</th>

                                        </tr>

                                    </thead>

            

                                    <tbody id="lodetypeerStatus">

                                        @foreach($alluser as $allusers)

                                        <tr class="odd">

                                            <td class="copy-text">{{ $allusers->user_type }}</td>

                                        </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>
                    @endcan
                    
                    @can('dashboard-shipper-report')
                    <div class="col-12 col-lg-8 col-xl-8 d-flex" id="loadchartdata" style="display: none">

                        <div class="card radius-10 w-100">

                            <table class="table mb-0" id="shipper_table" style="display: none">

                                <div class="date-filter">

                                    <div class="row">

                                        <div class="col-md-12">

                                            <h4 class="text text-primary">Search By Date:</h4>

                                        </div>

                                        <div class="col-md-2">

                                            <label>From Date:</label>

                                            <input type="text" id="min" name="min" class="form-control">

                                        </div>

                                        <div class="col-md-2">

                                            <label>To Date:</label>

                                            <input type="text" id="max" name="max" class="form-control">

                                        </div>

                                    </div>

                                </div>

                                <thead class="table-light">

                                    <tr>

                                        <th>City</th>

                                        <th>State</th>

                                    </tr>

                                </thead>

                                <tbody id="shipper_filter">

                                            @php

                                            $i = 0;

                                            @endphp

                                            @if(count($comp_data) > 0)

                                            @foreach($comp_data as $companies_res)

                                                    @php

                                                        $createdby = App\Models\User::where('id',$companies_res->user_id)->first();

                                                    @endphp

                                                    <tr>

                                                        <td>{{ isset($companies_res->shipper_city) ? $companies_res->shipper_city : Null }}</td>



                                                        <td>{{ isset($companies_res->shipper_state) ? $companies_res->shipper_state : Null }}</td>												

                                                    </tr>

                                            @endforeach

                                            @else

                                            <tr style="background-color: #edf3f652;">

                                                <td colspan="7">

                                                    <div class="row">

                                                        <div class="col-md-4"></div>

                                                        <div class="col-md-4 not-found">

                                                            <img src="{{url('/public/backend/assets/images/message.png')}}">

                                                            <h4> No Shipper created, yet.</h4>

                                                        </div>

                                                        <div class="col-md-4"></div>

                                                    </div>

                                                </td>

                                            </tr>

                                            @endif

                                </tbody>

                            </table>

                        </div>

                    </div>

                    @endcan
                </div>

                {{-- user activity start here --}}

                {{-- //brack --}}
                
                @can('dashboard-activity')
                <div class="row">

                    <div class="col-md-6">

                        <div class="card radius-10">

                            <div class="card-body">

                                <div class="table-responsive">

                                    <h2 class="dashoard-heading">Latest Activity</h2>

                                    <table class="table mb-0"  >

                                        <thead class="table-light">
                                            <tr>
                                                <th>No.</th>
                                                <th style="width:200px">Done By</th>
                                                <th>Log Type</th>
                                                <th>Date</th>                                   
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                
                                                $i =0;
                                            @endphp

                                            @if(count($data) > 0)
                                            @foreach ($data as  $key => $user)
                                                <?php 
                                                    $encoded_id = base64_encode($user->id);
                                                        $cuid = $user->subject_id;
                                                        $uDataName = App\Models\User::where('id', $cuid)->first('name');
                                                        $uDataName = isset($uDataName->name) ? $uDataName->name : Null ;
                                                        $dataV = date('M d, Y - h:i A', strtotime($user->updated_at));
                                                        $ldate = date('Y-m-d H:i:s');
                                                    ?>
                                                <tr>

                                                    <td> {{ ++$i ;}} </td>
                                                    <td style="width:200px">{{ $user->description.' '. $uDataName }}</td>
                                                    <td class="log_type">
                                                        <div class="{{ $user->event }} badge rounded-pill text-white bg-info p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>{{ $user->event }}</div>
                                                    </td>
                                                    <td>{{ $dataV }}</td>
                                                </tr>
                                            @endforeach
                                            @else
                                                <td colspan="5">
                                                    <div class="row">
                                                        <div class="col-md-4"></div>
                                                        <div class="col-md-4 not-found">
                                                            <img src="{{url('/public/backend/assets/images/message.png')}}">
                                                            <h4>No Any Activity, yet.</h4>
                                                        </div>
                                                        <div class="col-md-4"></div>
                                                    </div>
                                                </td>
                                            @endif

                                        </tbody>

                                    </table>

                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="card radius-10">

                            <div class="card-body">
                                    <h2 class="dashoard-heading">Employee Attendance</h2>
                                    <div class="empatt" style="float: right; margin-top: -28px;">
                                        <a href="{{url('admin/clockin/view')}}" style="flot-right; display:block;">View List</a>
                                    </div>
                                    
                                    <table class="table mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>No</th>
                                                {{-- <th>User Id</th> --}}
                                                <th>User Name</th>
                                                <th>Time IN</th>
                                                <th>Time Out</th>
                                                <th>Date</th>
                                                <th>B-Timer</th>
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                        $i = 0;
                                        @endphp
                                        @foreach($clockin as $udata)
                                                    @php
                                                        $id = $udata->user_id;
                                                        $uname = App\Models\User::where('id',$id)->first();
                                                        $name = $uname->name ?? Null ;
                                                        $officerid = $uname->officerid ?? Null ;
        
                                                        $datad = $udata->brackout;
                                                    @endphp
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    {{-- <td>{{ $officerid }}</td> --}}
                                                    <td>{{$name }}</td>
                                                    {{-- <td>{{ substr($udata->timein, 10)  }}</td> --}}
                                                    @php
                                                    
                                                    date_default_timezone_set('America/New_York');
                                                    $datetime = Carbon::now()->toDateTimeString();
                                                    $cur_time = Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('h:i:s A');
                                                    $current_date = Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('Y-m-d');
                                                    
                                                    
                                                         $current_date12 = date("Y-m-d");
                                                        $olddate =  $udata->date_data;
                                                        //dd($current_date);
                                                    @endphp
                                                    
                                                    @if($current_date == $udata->date_data)
                                                        <td style="color:green;">{{ $udata->timein }}</td>
                                                    @else
                                                        <td>{{ $udata->timein }}</td>
                                                    @endif
        
        
                                                    @if(empty($udata->timeout))
                                                    <td> 00:00 </td>
                                                    @else
                                                        <td >{{ isset($udata->timeout) ? $udata->timeout : Null}}</td>
                                                    @endif
                                                    
                                                    <td>{{ $udata->date_data }}</td>
        
                                                    <script>
        
                                                        // Set the date we're counting down to
                                                        // 62d 21h 41m 35s
                                                        <?php  date_default_timezone_set("America/New_York"); ?>
                                                        var countDownDate_{{$i}} = new Date("<?php echo $datad; ?>").getTime();
                                                        // var countDownDate = new Date("Jan 5, 2023 15:37:25").getTime();
                                                        // Update the count down every 1 second
                                                        var x_{{$i}} = setInterval(function() {
            
                                                        // Get today's date and time
                                                        var now_{{$i}} = new Date().getTime();
                                                        
                                                        // let chicago_datetime_str = new Date().toLocaleString("en-US", { timeZone: "America/New_York" });
                                                        // var ltzDate = (new Date(strDate)).toLocaleString();
                                                        // Wed Mar 29 2023 02:13:14 GMT+0530 (India Standard Time)
                                                        // 3/28/2023, 4:50:52 PM
                                                        
                                                        <?php 
                                                            date_default_timezone_set('America/New_York');
                                                            $datetime = Carbon::now()->toDateTimeString();
                                                            $cur_time = Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('h:i:s A');
                                                            $cur_date = Carbon::createFromFormat('Y-m-d H:i:s', $datetime)->format('Y-m-d');
                                                            
                                                            ?>
                                                        
                                                       
                                                        //  var    currentdate_{{$i}} =    d.toLocaleString('en-US', { timeZone: 'America/New_York' });
                                                        //  var    currentdate_{{$i}} = changeTimeZone(new Date(), 'America/New_York'); 
                                                        
                                                         
                                                        
                                                        // alert(ll);
                                                            var currentdate_{{$i}} = new Date();
                                                            var datetime_{{$i}} = currentdate_{{$i}}.getFullYear() + "-"
                                                                        + (currentdate_{{$i}}.getMonth()+1)  + "-" 
                                                                        + currentdate_{{$i}}.getDate() + " "  
                                                                        + currentdate_{{$i}}.getHours() + ":"  
                                                                        + currentdate_{{$i}}.getMinutes() + ":" 
                                                                        + currentdate_{{$i}}.getSeconds();
            
                                                                        // console.log(datetime_{{$i}});
                                                        //document.write(datetime);
                                                        // Find the distance between now and the count down date
                                                        var distance_{{$i}} =  currentdate_{{$i}} - countDownDate_{{$i}}    ;
                                                        
                                                            
                                                        // Find the distance between now and the count down date
                                                        // var distance_{{$i}} = now_{{$i}} - countDownDate_{{$i}} ;
                                                        // Time calculations for days, hours, minutes and seconds
                                                        var days_{{$i}} = Math.floor(distance_{{$i}} / (1000 * 60 * 60 * 24));
                                                        var hours_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                        var minutes_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60 * 60)) / (1000 * 60));
                                                        var seconds_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60)) / 1000);
                                                        if(hours_{{$i}}>=30){
                                                            var class_{{$i}} = "red";
                                                        }else{
                                                            var class_{{$i}} = "red";
                                                        }
                                                        // Output the result in an element with id="demo"
                                                        document.getElementById("demo_{{$i}}").innerHTML = "<span>"+hours_{{$i}} + "h </span>"
                                                        + "<span>"+minutes_{{$i}} + "m </span>" + "<span>"+seconds_{{$i}} + "s </span>";
            
                                                        // If the count down is over, write some text 
                                                        if (distance_{{$i}} < 0) {
                                                            clearInterval(x);
                                                            document.getElementById("demo_{{$i}}").innerHTML = "EXPIRED";
                                                        }
                                                        }, 1000);
                                                        </script>
                                                      
                                                        
                                                    @if(empty($udata->brackout))
                                                        <td> 00:00 </td>
                                                      @else
                                                        <td id="demo_{{$i}}" class="req_date">{{ isset($udata->brackout) ? $udata->brackout : Null}}</td>
                                                    @endif
                                                    <td class="action_tooltip">
                                                        <a href="{{ url('admin/brackin/details',$udata->id )}}"> 
                                                        <button type="button" value="{{ $udata->id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a> 
                                                    </td>
                                                </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>

                </div>
                @endcan

        </div>

    </div>



    



    

<script src="https://code.highcharts.com/highcharts-3d.js"></script>

<script src="https://code.highcharts.com/modules/exporting.js"></script>

<script src="https://code.highcharts.com/modules/export-data.js"></script>

<script src="https://code.highcharts.com/modules/accessibility.js"></script>	

    {{-- //for laravel load data graph--}}

    <script src="https://code.highcharts.com/highcharts.js"></script>

   

    {{-- // bar chart --}}

    <script>

            $(document).ready(function () {
            // Create DataTable
            var table = $('#loadfull').DataTable({
                dom: 'Pfrtip',
            });

            // Create the chart with initial data
            var container = $('<div/>').insertBefore(table.table().container());
            var chart = Highcharts.chart(container[0], {
                chart: {
                    type: 'column',
                    options3d: {
                        enabled: true,
                        alpha: 25,
                        beta: 0,
                        depth: 70,
                        viewDistance: 45
                    }
                },

                title: {
                    text: 'Loads Report By Full & Partial',
                },
                series: [
                    {
                        name:'Load',
                        data: chartData(table),
                        colorByPoint: true,
                    },
                ],
            });

            // On each draw, update the data in the chart
            table.on('draw', function () {
                chart.series[0].setData(chartData(table));

            });

            function chartData(table) {
            var counts = {};
            // Count the number of entries for each position
            table
                .column(0, { search: 'applied' })
                .data()
                .each(function (val) {
                    if (counts[val]) {
                        counts[val] += 1;
                    } else {
                        counts[val] = 1;
                    }
                });

            // And map it to the format highcharts uses
            return $.map(counts, function (val, key) {
                return {
                    name: key,
                    y: val,
                };
            });
        }

        

        

        //user type chart

        // Create DataTable

            var table = $('#alluser').DataTable({

                dom: 'Pfrtip',

            });

            // Create the chart with initial data

            var container = $('<div/>').insertBefore(table.table().container());

            var chart = Highcharts.chart(container[0], {

                chart: {

                    type: 'column',

                    options3d: {

                        enabled: true,

                        alpha: 25,

                        beta: 0,

                        depth: 70,

                        viewDistance: 45

                    }

                },

                title: {

                    text: 'User Report By User Type',

                },

                series: [

                    {

                        name:'User',

                        data: chartData(table),

                        colorByPoint: true,

                    },

                ],

            });

        

            // On each draw, update the data in the chart

            table.on('draw', function () {

                chart.series[0].setData(chartData(table));

            });



            function chartData(table) {

            var counts = {};

            // Count the number of entries for each position

            table

                .column(0, { search: 'applied' })

                .data()

                .each(function (val) {

                    if (counts[val]) {

                        counts[val] += 1;

                    } else {

                        counts[val] = 1;

                    }

                });

        

            // And map it to the format highcharts uses

            return $.map(counts, function (val, key) {

                return {

                    name: key,

                    y: val,

                };

            });

        }

        

        });

        

    </script>

    <!-- Start chart pie for shipper Start-->	

    <script>

        $(document).ready(function () {

            $("span.s_b_d").click(function(){

                $(".date-filter").slideToggle();

            })

                $.fn.dataTable.ext.search.push(

                    function (settings, data, dataIndex) {

                        var min = $('#min').datepicker('getDate');

                        var max = $('#max').datepicker('getDate');

                        var startDate = new Date(data[9]);

                        if (min == null && max == null) return true;

                        if (min == null && startDate <= max) return true;

                        if (max == null && startDate >= min) return true;

                        if (startDate <= max && startDate >= min) return true;

                        return false;

                    }

                );

            

                $('#min').datepicker();

                $('#max').datepicker();

                var table = $('#shipper_table').DataTable();

            

                // Event listener to the two range filtering inputs to redraw on input

                $('#min, #max').change(function () {

                    table.draw();

                });

                

                var container = $('<div/>').insertBefore(table.table().container());

                    var chart = Highcharts.chart(container[0], {

                        chart: {

                            type: 'pie',

                        },

                        title: {

                            text: 'Shipper Report By City',

                        },

                        series: [

                            {   

                                name:'Shipper',

                                data: chartData(table),

                            },

                        ],

                    });

                    // On each draw, update the data in the chart

                    table.on('draw', function () {

                        chart.series[0].setData(chartData(table));

                    });

                    

                    function chartData(table) {

            var counts = {};

            // Count the number of entries for each position

            table

                .column(0, { search: 'applied' })

                .data()

                .each(function (val) {

                    if (counts[val]) {

                        counts[val] += 1;

                    } else {

                        counts[val] = 1;

                    }

                });

            // And map it to the format highcharts uses

            return $.map(counts, function (val, key) {

                return {

                name: key,

                    y: val,

                };

            });

        }

            });

    </script>

    <!-- Start chart pie for shipper End -->
    
        @include('backend.common.graph')

      @include('backend.common.footer')

@endsection