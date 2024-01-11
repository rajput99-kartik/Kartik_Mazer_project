@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
		<style>
    h2#swal2-title {
        font-size: 20px;
        margin: 0px;
    }
    div#swal2-html-container {
        font-size: 14px;
        margin: 10px 0px 0px;
    }
    .swal2-popup.swal2-modal.swal2-loading.swal2-show {
        width: 270px;
        padding-top: 10px;
    }
    .swal2-loader {
        border-color: #80c427 rgba(0,0,0,0) #80c427 rgba(0,0,0,0);
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
                <div class="row">
                     <div class="col-md-2 pl-lg">
                        <!-- START widget-->
                        <div class="panel widget bg-gradient-deepblue">
                            <a href="{{url('admin/shipment/list')}}">
                            <div class="pl-sm pr-sm pb-sm">
                                <strong><a style="font-size: 15px" class="b_status1" search-type="shipment_statue" value="All" id="unconfirmed" href="{{url('admin/shipment/list')}}">All Shipment</a>
                                    <small class="pull-right " style="padding-top: 2px">{{ $total }}</small>
                                </strong>
                                <div class="progress progress-striped progress-xs mb-sm">
                                    <?php
                                        $shipment_openw = number_format(($total/$total*100),0)."%";
                                    ?>
                                    <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="{{$shipment_openw}}" style="width: {{$shipment_openw}}"><span>{{$shipment_openw}}</span></div>
                                </div>
                            </div>
                             </a>
                        </div>
                        <!-- END widget-->
                    </div>
                    <div class="col-md-2 pl-lg">
                        <!-- START widget-->
                        <div class="panel widget bg-gradient-deepblue">
                            <div class="pl-sm pr-sm pb-sm">
                                <strong><a style="font-size: 15px" class="b_status" search-type="shipment_statue" value="Open" id="unconfirmed" href="#">Open</a>
                                    <small class="pull-right " style="padding-top: 2px"> {{ $shipment_open }} / {{ $total }}</small>
                                </strong>
                                <div class="progress progress-striped progress-xs mb-sm">
                                    <?php
                                        $shipment_openw = number_format(($shipment_open/$total*100),0)."%";
                                    ?>
                                    <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="{{$shipment_openw}}" style="width: {{$shipment_openw}}"><span>{{$shipment_openw}}</span></div>
                                </div>
                            </div>
                        </div>
                        <!-- END widget-->
                    </div>
                    <div class="col-md-2">
                        <!-- START widget-->
                        <div class="panel widget bg-gradient-ibiza">
                            <div class="pl-sm pr-sm pb-sm">
                                <strong><a style="font-size: 15px" class="b_status" search-type="shipment_statue" value="Covered" id="confirmed" href="#">Covered</a>
                                    <small class="pull-right " style="padding-top: 2px"> {{ $shipment_covered }} / {{ $total }}</small>
                                </strong>
                                <div class="progress progress-striped progress-xs mb-sm">
                                    <?php
                                        $shipment_coveredw = number_format(($shipment_covered/$total*100),0)."%";
                                    ?>
                                    <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="{{$shipment_coveredw}}" style="width: {{$shipment_coveredw}}"><span>{{$shipment_coveredw}}</span></div>
                                </div>
                            </div>
                        </div>
                        <!-- END widget-->
                    </div>
                    <div class="col-md-2 pl-lg">
                        <!-- START widget-->
                        <div class="panel widget bg-gradient-deepblue">
                            <div class="pl-sm pr-sm pb-sm">
                                <strong><a style="font-size: 15px" class="b_status" search-type="shipment_statue" value="In-transit" id="unconfirmed" href="#">IN-transit</a>
                                    <small class="pull-right " style="padding-top: 2px"> {{ $shipment_transit }} / {{ $total }}</small>
                                </strong>
                                <div class="progress progress-striped progress-xs mb-sm">
                                    <?php
                                        $shipment_transitw = number_format(($shipment_transit/$total*100),0)."%";
                                    ?>
                                    <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="{{$shipment_transitw}}" style="width: {{$shipment_transitw}}"><span>{{$shipment_transitw}}</span></div>
                                </div>
                            </div>
                        </div>
                        <!-- END widget-->
                    </div>
                    <div class="col-md-2">
                        <!-- START widget-->
                        <div class="panel widget bg-gradient-moonlit">
                            <div class="pl-sm pr-sm pb-sm">
                                <strong><a style="font-size: 15px" class="b_status" search-type="shipment_statue" value="Delivered" id="in_progress" href="#">Delivered</a>
                                    <small class="pull-right " style="padding-top: 2px"> {{ $shipment_delivered }} / {{ $total }}</small>
                                </strong>
                                <div class="progress progress-striped progress-xs mb-sm">
                                    <?php
                                        $shipment_deliveredw = number_format(($shipment_delivered/$total*100),0)."%";
                                    ?>
                                    <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="{{$shipment_deliveredw}}" style="width: {{$shipment_deliveredw}}"><span>{{$shipment_deliveredw}}</span></div>
                                </div>
                            </div>
                        </div>
                        <!-- END widget-->
                    </div>
            
                    <!--<div class="col-md-2">-->
                        <!-- START widget-->
                        <!--<div class="panel widget bg-gradient-ohhappiness">-->
                        <!--    <div class="pl-sm pr-sm pb-sm">-->
                        <!--        <strong><a style="font-size: 15px" class="b_status" search-type="shipment_statue" value="Paid" id="resolved" href="#">Invoice</a>-->
                        <!--            <small class="pull-right " style="padding-top: 2px"> {{ $shipment_invoice }} / {{ $total }}</small>-->
                        <!--        </strong>-->
                        <!--        <div class="progress progress-striped progress-xs mb-sm">-->
                                    <?php
                                        // $shipment_invoice = number_format(($shipment_invoice/$total*100),0)."%";
                                    ?>
                        <!--            <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="{{$shipment_invoice}}" style="width: {{$shipment_invoice}}"><span>{{$shipment_invoice}}</span></div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!-- END widget-->
                    <!--</div>-->
                    <div class="col-md-2 pl-lg">
                        <!-- START widget-->
                        <div class="panel widget bg-gradient-deepblue">
                            <div class="pl-sm pr-sm pb-sm">
                                <strong><a style="font-size: 15px" class="b_status" search-type="shipment_statue" value="Invoiced" id="unconfirmed" href="#">Paid</a>
                                    <small class="pull-right " style="padding-top: 2px"> {{ $shipment_paid }} / {{ $total }}</small>
                                </strong>
                                <div class="progress progress-striped progress-xs mb-sm">
                                    <?php
                                        $shipment_paidw = number_format(($shipment_paid/$total*100),0)."%";
                                    ?>
                                    <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="{{$shipment_paidw}}" style="width: {{$shipment_paidw}}"><span>{{$shipment_paidw}}</span></div>
                                </div>
                            </div>
                        </div>
                        <!-- END widget-->
                    </div>
                </div>
                <div class="card card-primary ar">
                  <div class="card-header">
                    <h2 class="card-title">Shipment List</h2>
                  </div>
        		  <div class="card-body">
        			 <div class="row">
                             
        					<div class="col-md-2 col-sm-2 col-xs-12">
                                <label>Status</label>
                                <select class="allcust form-control" id="ShipmentStatus">
        						   <option value="">All</option>
                                   <option value="Open">Open</option>
                                   <option value="Covered">Covered</option>
                                   <option value="Intransit">In-transit</option>
                                   <option value="Delivered">Delivered</option>
                                       
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-3 col-xs-12">
                                <label>Load#</label>
                                <input type="text" id="LoadNumber" class="form-control allcust">
                            </div>
                            <div class="col-md-2 col-sm-3 col-xs-12">
                                <label>Agent Name</label>
                                <select class="allcust form-control" id="AgentName">
                                    <option value="">All</option>
                                    @foreach($GetUser as $User)
                                    <option value="{{ $User->id }}">{{ $User->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <label>From</label>
                                <input type="date" id="from_date" class="form-control allcust">
    						</div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <label>To</label>
                                <input type="date" id="to_date" class="form-control allcust">
    						</div>
                            <div class="col-md-2 col-sm-2 col-xs-12">
                            <label style="visibility: hidden;display: block;">buttonrefresh</label>
                                <button type="button" id="ShipmentRefreshAdmin" class="reficon btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i>Refresh</button>
                            </div>
                        </div>
                      </div>
                </div>
                <ul class="nav nav-tabs">
                    @can('shipment-all')
                    <li class="pending_approval active"><a href="{{url('/admin/shipment/list')}}" data-toggle="tab" aria-expanded="true">All Shipments</a>
                    </li>
                    @endcan
                    
                    @can('shipment-create')
                    <li class="pending_approval"><a href="{{url('/admin/shipment')}}" data-toggle="tab" aria-expanded="true">Shipments</a>
                    </li>
                    <li class="pending_approval"><a href="{{url('/admin/create-shipment')}}" data-toggle="tab" aria-expanded="true">Create Shipments</a>
                    </li>
                    @endcan
                </ul>
                
				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
						  <!--div class="ms-auto"><a href="#" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New Shipper</a></div -->
						</div>
                        
						<div class="table-responsive" style="overflow: hidden;">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
                                    
									<tr>
                                        <th>No</th>
										<th>Load</th>
                                        <th>Company</th>
                                        <th>Carrier Name</th>
                                        <th>Added By</th>
                                        <th>Pick</th>
                                        <th>Drop</th>
                                        <th>Status</th>
                                        <th width="60px">Action</th>
									</tr>
								</thead>
								
								<tbody id="shipment_filter">
								@php
								$i = 0;
								@endphp
								@if(count($shipment) > 0)
                                @foreach($shipment as $key => $companies_res)
                                        <tr>
                                            <?php 
                                              $cid = $companies_res->companies_id ;
                                              $dc =  App\Models\Company::where('id',$cid)->select('company_name')->first();
											  
											  $carrier_name = $companies_res->carrier_id ;
											  $carrier_name =  App\Models\Carriers::where('id',$carrier_name)->select('c_company_name')->first();
											  $uidi = $companies_res->user_id ;
											  $agent_name =  App\Models\User::where('id',$uidi)->select('name')->first();
                                              
											//   pick
											  $pickid = $companies_res->id ;
											  $pick_date =  App\Models\Shipmentpick::where('shipment_id',$pickid)->select('p_ready')->first();
											//   drop
												$dropid = $companies_res->id ;
											  $drop_date =  App\Models\Shipmentdrop::where('shipment_id',$dropid)->select('d_ready')->first();
                                            ?>
                                            <td>{{ ++$i }}</td>
                                            <td class="copy-text">{{ $companies_res->id }}</td>
                                            <td class="copy-text">{{ isset($dc['company_name']) ? $dc['company_name'] : null }}</td>
                                            {{-- <td>{{ $carrier_name['c_company_name'] }}</td> --}}
                                            <td class="copy-text">{{ isset($carrier_name['c_company_name']) ? $carrier_name['c_company_name'] : Null }}</td>
                                            <td>{{ isset($agent_name['name']) ? $agent_name['name'] : Null }}</td>
                                            <td>{{ isset($pick_date['p_ready']) ? $pick_date['p_ready']: null}}</td>
											<td>{{isset($drop_date['d_ready']) ? $drop_date['d_ready'] : Null}}</td>
                                            <td>
											<input type="hidden" value="{{ $companies_res->id }}" id="shipment_id">
											
												<select class="form-control select2 {{$companies_res->shipment_statue}}" id="<?php if(($companies_res->shipment_statue == 'Paid') || ($companies_res->shipment_statue == 'Invoiced') ){echo '';}else{ echo 'shipment_status_change'; } ?>" style="width: 100%;">
														<option <?php if($companies_res->shipment_statue == 'Open'){ echo 'selected';} ?> value="Open">Open</option>
														<option value="Covered" <?php if($companies_res->shipment_statue == 'Covered'){ echo 'selected';} ?> >Covered</option>
														<option value="In-transit" <?php if($companies_res->shipment_statue == 'In-transit'){ echo 'selected';} ?> >In-transit</option>
														<option value="Delivered" <?php if($companies_res->shipment_statue == 'Delivered'){ echo 'selected';} ?> >Delivered</option>
                                                        <?php if($companies_res->shipment_statue == 'Invoiced'){ ?>
                                                        <option value="Invoiced" <?php if($companies_res->shipment_statue == 'Invoiced'){ echo 'selected';} ?> >Invoiced</option>
                                                        <?php } ?>
                                                        <?php if($companies_res->shipment_statue == 'Paid'){ ?>
                                                        <option value="Paid" <?php if($companies_res->shipment_statue == 'Paid'){ echo 'selected';} ?> >Paid</option>
                                                        <?php } ?>											
												</select>
                                            </td>
                                            <td class="action_tooltip">
                                                <div class="action_bar">
                                                    <button type="buton" class="action"><i class="bx bx-dots-vertical-rounded"></i></button>
                                                    <div class="action_btn">
                                                        <!--<a href="{{ url('admin/shipment/shipment-edit',base64_encode($companies_res->id) )}}"><button type="button" value="{{ $companies_res->id }}" class=""><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>-->
                                                        <!-- <a href="{{ url('admin/shipment/shipment-edit',base64_encode($companies_res->id) )}}" class="primary"><i class="bx bx-show"></i><span class="tooltip">View</span></a> -->
                                                        <a href="{{ url('admin/shipment/shipment-edit'.'/'.base64_encode($companies_res->id) )}}" class="success"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a>  
                                                        @can('loads-activity')
                                                        <a href="{{url('/admin/load-activity').'/'.base64_encode($companies_res->id)}}" class="scandry" popup="report_{{$companies_res->id}}"><i class="bx bx-file"></i><span class="tooltip">Load Activity</span></a>
                                                        @endcan
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                            $i++;
                                        ?>
                                @endforeach
                                        @else
                                        <tr style="background-color: #edf3f652;">
                                            <td colspan="9">
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4 not-found">
                                                        <img src="{{url('/public/backend/assets/images/message.png')}}">
                                                        <h4>You have no Shipment, yet.</h4>
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
				</div>
			</div>
		</div>
		<!--end page wrapper -->
    </div>
  </div>
</div>
<script>
        
    $(document).ready(function(){   
    //shipment filter req
    $("a.b_status").click(function(e){
        e.preventDefault();
        var filter_type = $(this).attr('search-type');
        var filter_value = $(this).attr('value');
        $("a.b_status").removeClass("active");
        $(this).addClass("active");
        $.ajax({
          url: "{{url('/admin/shipment/filter')}}",
          type:"POST",
          data:{
            "_token": "{{ csrf_token() }}",
            filter_type:filter_type,
            filter_value:filter_value,
          },
          success:function(response){
              let timerInterval
                Swal.fire({
                  title: 'Wait..',
                  html: 'I will Filter in <b></b> milliseconds.',
                  timer: 1000,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                      b.textContent = Swal.getTimerLeft()
                    }, 500)
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                  }
                })
                setTimeout(function(){
                    $("#shipment_filter").html(response);
                    $("div#carrier_table_paginate, div#carrier_table_info").hide();
                }, 500)
          }
         });
    })
    } );
</script>
<!--<script>-->
<!--    $(document).ready(function() {-->
<!--    $('#carrier_table').DataTable( {-->
<!--        dom: 'Bfrtip',-->
<!--        buttons: [-->
<!--        'copy', 'csv', 'excel', 'pdf', 'print',-->
        
<!--        ]-->
        
       
<!--    } );-->
<!--} );-->
<!--</script>-->
<script>
    $(document).ready(function() {
        $('#carrier_table').DataTable( {
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: ':visible'
                    }
                },
                'colvis'
            ],
            columnDefs: [ {
                // targets: -2,
                visible: false
            } ]
        } )});
</script>
@include('backend.common.footer')
@endsection
