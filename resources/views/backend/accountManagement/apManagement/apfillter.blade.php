@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
<!--start page wrapper -->
<style>
    td.ap-action.action_tooltip button {
        padding: 0px !important;
    }
    .Delivered {
        background-color: #96c93d !important;
    }
    .Covered {
        background-color: #1797be !important;
    }
    .In-transit {
        background-color: #ff6a00 !important;
    }
</style>
<div class="page-wrapper">
    <div class="page-content">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        
        <div class="row">
            <div class="col-md-3 pl-lg">
                <!-- START widget-->
                <div class="panel widget bg-gradient-deepblue">
                    <div class="pl-sm pr-sm pb-sm">
                        <strong><a style="font-size: 15px" class="b_status" search-type="unconfirmed" id="unconfirmed" href="#">Open</a>
                            <small class="pull-right " style="padding-top: 2px">200</small>
                        </strong>
                        <div class="progress progress-striped progress-xs mb-sm">
                            <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>
            <div class="col-md-3">
                <!-- START widget-->
                <div class="panel widget bg-gradient-ibiza">
                    <div class="pl-sm pr-sm pb-sm">
                        <strong><a style="font-size: 15px" class="b_status" search-type="confirmed" id="confirmed" href="#">Covered</a>
                            <small class="pull-right " style="padding-top: 2px">300}</small>
                        </strong>
                        <div class="progress progress-striped progress-xs mb-sm">
                            <div class="progress-bar progress-bar-info " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>
            <div class="col-md-3">
                <!-- START widget-->
                <div class="panel widget bg-gradient-moonlit">
                    <div class="pl-sm pr-sm pb-sm">
                        <strong><a style="font-size: 15px" class="b_status" search-type="in_progress" id="in_progress" href="#">Delivered</a>
                            <small class="pull-right " style="padding-top: 2px"> 6</small>
                        </strong>
                        <div class="progress progress-striped progress-xs mb-sm">
                            <div class="progress-bar progress-bar-warning " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>
            
            <div class="col-md-3">
                <!-- START widget-->
                <div class="panel widget bg-gradient-ohhappiness">
                    <div class="pl-sm pr-sm pb-sm">
                        <strong><a style="font-size: 15px" class="b_status" search-type="resolved" id="resolved" href="#">Paid</a>
                            <small class="pull-right " style="padding-top: 2px"> 10</small>
                        </strong>
                        <div class="progress progress-striped progress-xs mb-sm">
                            <div class="progress-bar progress-bar-danger " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
                <!-- END widget-->
            </div>
        </div>
        <div class="card card-primary ar">
            <div class="card-header">
                <h2 class="card-title">AccountAP List</h2>
            </div>
            <div class="card-body">
                <form action="{{url('admin/accountap/fillter/')}}" method="get">
                    <div class="row">
                        <div class="col-md-5 col-sm-4 col-xs-12">
                            <label>Status</label>
                            <select class="allcust form-control" id="ApStatus" name="ApStatus">
                                <option value="">Choose</option>
                                <option value="Open">Open</option>
                                <option value="Covered">Covered</option>
                                <option value="Intransit">In-transit</option>
                                <option value="Delivered">Delivered</option>
                                
                            </select>
                        </div>
                        <div class="col-md-5 col-sm-4 col-xs-12">
                            <label>Load#</label>
                            {{-- <input type="text" id="LoadNumber" class="form-control allcust" > --}}
                            <input type="text" id="LoadNumber" class="form-control allcust" name="shipmentload" value="">
                        </div>
                        
                        {{-- <div class="col-md-3 col-sm-3 col-xs-12">
                            <label>From</label>
                            <input type="date" id="from_date" class="form-control allcust">
                        </div>
                        <div class="col-md-3 col-sm-3 col-xs-12">
                            <label>To</label>
                            <input type="date" id="to_date" class="form-control allcust">
                        </div> --}}
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <label style="visibility: hidden;display: block;">buttonrefresh</label>
                            <button type="submit" id="ApfillterRefreshB" class="reficon btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i>Refresh</button>
                        </div>
                    
                    </div>
                </form>
            </div>
        </div>
        <ul class="nav nav-tabs">
            <li class="pending_approval active"><a href="{{url('/admin/accountap')}}" data-toggle="tab" aria-expanded="true">All Accountap List</a>
            </li>
            
            {{-- <li class="pending_approval"><a href="{{url('/admin/shipment')}}" data-toggle="tab" aria-expanded="true">Shipments</a>
            </li>
            <li class="pending_approval"><a href="{{url('/admin/create-shipment')}}" data-toggle="tab" aria-expanded="true">Create Shipments</a>
            </li> --}}
        </ul>
        
        <div class="card">
            <div class="card-body">
                <div class="d-lg-flex align-items-center mb-4 gap-3">
                </div>
                
                <div class="table-responsive3">
                    <table class="table mb-0 " id="carrier_table">
                        <thead class="table-light">
                            <tr>
                                <th>No</th>
                                <th>Load</th>
                                <th>Carrier</th>
                                <th>Shipment</th>
                                <th>User Name</th>
                                <th>Ap Date</th>
                                <th>Age Date</th>
                                <th>Action</th>                                       
                            </tr>
                        </thead>
                        <tbody class="apfillterlist">
                            @php
                            $i = 0;
                            @endphp
                            @php
                            $i = 1;
                            
                            // dd($companiesData);
                            @endphp
                            
                            
                            @foreach($companiesData as $udata)
                            @foreach($udata->getAccountPayable as $item)
                            @foreach ( $item->getshipmentdata as $itemdata )
                            
                            <tr class="datacfillter">
                                <td>{{ ++$i }}</td>
                                <td>
                                    {{ isset($itemdata['id'])  ? $itemdata['id'] : Null }}
                                </td>
                                <td>
                                    @foreach ($itemdata->getapcdata as $item)
                                    {{ isset($item['c_company_name'])  ? $item['c_company_name'] : Null }}
                                    @endforeach
                                </td>
                                
                                <td>
                                  <div class="badge rounded-pill text-white bg-info p-2 text-uppercase px-3 {{ isset($itemdata['shipment_statue'])  ? $itemdata['shipment_statue'] : Null }}"><i class="bx bxs-circle me-1"></i>{{ isset($itemdata['shipment_statue'])  ? $itemdata['shipment_statue'] : Null }}</div>
                              </td>
                                <td>
                                    @foreach($udata->apTeamAgent as $asdata)
                                    {{ ucwords($asdata['name'])}}
                                    @endforeach
                                </td>
                                
                                <td>
                                    @foreach($udata->getAccountPayable as $asdata)
                                    {{ ucwords($asdata['ap_date'])}}
                                    @endforeach
                                </td>
                                
                                <td>
                                    @foreach($udata->getAccountPayable as $asdata)
                                    {{ ucwords($asdata['age_day'])}}
                                    @endforeach
                                </td>
                                
                                
                                @foreach($udata->apTeamAgent as $agent)
                                <td class="ap-action action_tooltip">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#Apupload" data-toggle="tab" class="btn btn-outline-info btn-sm radius-30 px-4" aria-expanded="false"><i class="bx bx-upload"></i><span class="tooltip">Upload</span></button>
                                    <a href="{{ url('admin/accountap/view',$agent->id )}}"> 
                                        <button type="button" value="{{ $agent->id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>
                                        <button type="button" data-bs-toggle="modal" data-bs-target="#Apcomment" data-toggle="tab" class="btn btn-outline-info btn-sm radius-30 px-4" aria-expanded="false"><i class="bx bx-comment"></i><span class="tooltip">Comments</span></button>
                                    </td>
                                    @endforeach 
                                </tr>
                                @endforeach
                                @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->
    
    <!--Apupload upload popup-->
    <div class="modal" id="Apupload" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="justify-content: center;padding: 10px;">
                    <h4 class="modal-title">Document Uploadd</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <!-- Modal body -->
                
                
                <div class="modal-body">
                    <div class="container">
                        <form action="#" id="new_ap_doc" method="post" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf						
                            <div class="form-group shipment-more search_input">
                                <label class="select-docu">
                                    <span>Select Document</span>
                                    <i class="bx bx-upload"></i>
                                    <input type="file" class="form-control" name="lane_origin" id="lane_origin_input" for="lane_origin">
                                    <span class="docname"></span>
                                </label>
                                <input type="hidden" name="lane_origin_id" id="ap_id">
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary" id="load_post_btn">Upload Document</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end upload popup-->
    
    <!--Apcomment form-->
    <div class="modal" id="Apcomment" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header" style="justify-content: center;padding: 10px;">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">
                        <form action="#" id="ap_comment" method="post" enctype="multipart/form-data" novalidate="novalidate">
                            @csrf						
                            <div id="live-chat">
                                <header class="clearfix">
                                    <h4>Ap Chat List</h4>
                                    <span class="chat-message-counter">3</span>
                                </header>
                                <div class="chat">
                                    <div class="chat-history">
                                        <div class="chat-message clearfix">
                                            <div class="chat-message-content clearfix">
                                                <a href="#" class="chat-del">x</a>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                <span class="chat-time">
                                                    17/03/2022
                                                    <span>
                                                        13:37</span>
                                                    </span>
                                                </div>
                                                <div class="chat-message-content clearfix">
                                                    <a href="#" class="chat-del">x</a>
                                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                    <span class="chat-time">
                                                        17/03/2022
                                                        <span>
                                                            13:37</span>
                                                        </span>
                                                    </div>
                                                    
                                                    <div class="chat-message-content clearfix">
                                                        <a href="#" class="chat-del">x</a>
                                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                        <span class="chat-time">
                                                            17/03/2022
                                                            <span>
                                                                13:37</span>
                                                            </span>
                                                        </div>
                                                        
                                                        <div class="chat-message-content clearfix">
                                                            <a href="#" class="chat-del">x</a>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                            <span class="chat-time">
                                                                17/03/2022
                                                                <span>
                                                                    13:37</span>
                                                                </span>
                                                            </div>
                                                            <div class="chat-message-content clearfix">
                                                                <a href="#" class="chat-del">x</a>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                                                <span class="chat-time">
                                                                    17/03/2022
                                                                    <span>
                                                                        13:37</span>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div> <!-- end chat-history -->
                                                        <div class="apchat-footer">
                                                            <input type="text" name="message" placeholder="Enter Your Comment..">
                                                            <label class="chat-attach">
                                                                <input type="file" name="attachment">
                                                                <i class="bx bx-paperclip"></i>
                                                            </label>
                                                            <button type="submit"><i class="bx bx-send"></i></button>
                                                        </div>
                                                    </div> <!-- end chat -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end comment popup-->
                    </div>
                </div>
            </div>
            

            <script>                
                /* Admin shipper list filter funcation Start Here*/
                $(document).on('click','#ApfillterRefreshB', function(){
                    var ApStatus = $('#ApStatus').val();
                    if((ApStatus != '') || (ShipperName != '') || (AgentName != '')){
                    $.ajax({
                            url: "{{ url('admin/accountap/fillter/') }}",
                            type: 'get',
                            cache : false,
                            data: {ApStatus:ApStatus},
                            success: function(data){
                                var filterdata = data.find(".datacfillter");
                                $('.apfillterlist').html(filterdata);			
                                setTimeout(function () {
                                        Swal.close();
                                }, 500);
                            }	
                        });
                    }else{
                            Swal.fire({
                                position: 'center',
                                icon: 'warning',
                                title: 'Select some details first!',
                                showConfirmButton: false,
                                timer: 1000
                            })
                        }
                    
                });
                $('input#lane_origin_input').change(function(e){
                    var docname = e.target.files[0].name;
                    $("span.docname").text(docname);
                })
            </script>
            
            @include('backend.common.footer')
            @include('backend.common.notification') 
            
            @endsection
            
