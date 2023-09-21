@extends('backend.layouts.master')

@section('title','Shipper Management')

@section('content')

		<!--start page wrapper -->

		<div class="page-wrapper">

			<div class="page-content">

                

                <div class="row">



                    <div class="col-md-4 pl-lg">



                        <!-- START widget-->



                        <div class="panel widget bg-gradient-deepblue">

                            <div class="pl-sm pr-sm pb-sm">



                                <strong><a style="font-size: 15px" class="b_status" search-type="unconfirmed" id="unconfirmed" href="#">Total Shipper</a>



                                            <?php 

                                            // $total = '' ;

                                            ?>

                                    <small class="pull-right " style="padding-top: 2px">  {{ $total }} </small>

                                </strong>



                                <div class="progress progress-striped progress-xs mb-sm">

                                    <?php

                                        if($total == 0){

                                            // $totalw = '1';

                                        }else{

                                            $total = $total ;

                                            $totalw = number_format(($total/$total*100),0)."%";

                                    ?>

                                            <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="{{$totalw}}" style="width:{{$totalw}}"><span>{{$totalw}}</span></div>

                                    <?php }?>





                                </div>

                            </div>

                        </div>

                        <!-- END widget-->

                    </div>



                    <div class="col-md-4">

                        <!-- START widget-->

                        <div class="panel widget bg-gradient-ibiza">

                            <div class="pl-sm pr-sm pb-sm">

                                <strong><a style="font-size: 15px" class="b_status" search-type="confirmed" id="confirmed" href="#">Pending</a>

                                    <small class="pull-right " style="padding-top: 2px"> {{ $shipper_pending }} / {{ $total }}</small>

                                </strong>

                                <div class="progress progress-striped progress-xs mb-sm">

                                    <?php

                                        //$shipper_pendingw = number_format(($shipper_pending/$total*100),0)."%";

                                    ?>

                                    

                                    <?php

                                        if($total == 0){

                                            // $totalw = '1';

                                        }else{

                                            $total = $total ;

                                            $shipper_pendingw = number_format(($shipper_pending/$total*100),0)."%";

                                    ?>

                                            

                                            <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="{{$shipper_pendingw}}" style="width:{{$shipper_pendingw}}"><span>{{$shipper_pendingw}}</span></div>



                                    <?php }?>



                                </div>

                            </div>

                        </div>

                        <!-- END widget-->

                    </div>



                    



            



                    <div class="col-md-4">

                        <!-- START widget-->

                        <div class="panel widget bg-gradient-ohhappiness">

                            <div class="pl-sm pr-sm pb-sm">

                                <strong><a style="font-size: 15px" class="b_status" search-type="resolved" id="resolved" href="#">Approved</a>

                                    <small class="pull-right " style="padding-top: 2px"> {{ $shipper_approve }} / {{ $total }}</small>

                                </strong>



                                <div class="progress progress-striped progress-xs mb-sm">

                                        <?php

                                        if($total == 0){

                                            // $totalw = '1';

                                        }else{

                                            $total = $total ;

                                           $shipper_approvew = number_format(($shipper_approve/$total*100),0)."%";

                                        ?>

                                            <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="{{$shipper_approvew}}" style="width:{{$shipper_approvew}}"><span>{{$shipper_approvew}}</span></div>

                                    <?php }?>

                                </div>

                            </div>

                        </div>



                        <!-- END widget-->



                    </div>



                </div>

				<!--div class="card card-primary ar">

                  <div class="card-header">

                    <h2 class="card-title">Shipper List</h2>

                  </div>

        		  <div class="card-body">

        			 <div class="row">

                            <input type="hidden" name="_token" value="RaaxeoxRYh7sHt53XfaypOPBAsOeAqYFu4opG0tM">

                             <div class="col-md-2 col-sm-2 col-xs-12">

    							<label>Type</label>

    							<select class="allcust form-control" id="ShipmentType">

    								<option value="3">All</option>

    								<option value="0">AMB</option>

    								<option value="1">Factory</option>

    								   

    							</select>

    						</div>

        					<div class="col-md-2 col-sm-2 col-xs-12">

                                <label>Status</label>

                                <select class="allcust form-control" id="ShipmentStatus">

        						   <option value="">All</option>

                                    <option value="Delivered">Delivered</option>

                                    <option value="Covered">To Be Pick Up</option>

                                    <option value="Consignee">Consignee</option>

                                    <option value="Open">Open</option>

                                       

                                </select>

                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">

                                <label>Load#</label>

                                <input type="text" id="ProNumber" class="form-control allcust">

                            </div>

                            <div class="col-md-3 col-sm-3 col-xs-12">

                                <label>Agent Name</label>

                                <select class="allcust form-control" id="AgentName">

        						   <option value="">All</option>

                                    <option value="Delivered">Gary</option>

                                </select>

                            </div>

                            <div class="col-md-2 col-sm-2 col-xs-12">

                            <label style="visibility: hidden;display: block;">buttonrefresh</label>

                                <a href="javascript:void(0);" id="ShipmentRefreshB" class="reficon btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i>Refresh</a>

                            </div>

                        </div>

                      </div>

                </div -->

				<ul class="nav nav-tabs">

                    @can('shipper-all')

                    <li class="pending_approval"><a href="{{url('/admin/shipper/list')}}" data-toggle="tab" aria-expanded="true">All Shipper</a></li>

                    @endcan

                    @can('shipper-agentshipper')

                    <li class="pending_approval"><a href="{{url('/admin/shipper/manager/list')}}" data-toggle="tab" aria-expanded="true">Team Shipper</a></li>

                    @endcan

                    <li class="all_leave active"><a href="{{url('/admin/shipper')}}" data-toggle="tab" aria-expanded="false">Shipper</a>

                        </li>

                    @can('shipper-create')

                    <li class=""><a href="{{url('/admin/shipper/add')}}" data-toggle="tab" aria-expanded="false">Create Shipper</a>

                    </li>

                    @endcan

                    @can('shipper-request')

			        <li class=""> <a href="{{url('admin/shipper/request')}}" data-toggle="tab" aria-expanded="false"> Shipper Request</a>

			        </li>

			        @endcan



                </ul>

				<!--end breadcrumb-->

                @if ($message = Session::get('success'))

                <div class="alert alert-success">

                <p>{{ $message }}</p>

                </div>

                @endif



				<div class="card" id="shipper_tbl">

					<div class="card-body">

						<div class="d-lg-flex align-items-center mb-4 gap-3">

						  <!--div class="ms-auto"><a href="#" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New Shipper</a></div -->

						</div>



						<div class="">

                            <div class="row date-filter">

                                <div class="col-md-2">

                                    <h4 class="text text-primary">Search By Date:</h4>

                                </div>

                                <div class="col-md-3">

                                    <label>From Date:</label>

                                    <input type="text" id="min" name="min" class="form-control">

                                </div>

                                <div class="col-md-3">

                                    <label>To Date:</label>

                                    <input type="text" id="max" name="max" class="form-control">

                                </div>

                            </div>

							<table class="table mb-0" id="carrier_table">

								<thead class="table-light">

									<tr>

                                        <th>No</th>

                                        <th>Company</th>

                                        <th>Secret Code</th>

                                        <th>Address</th>

                                        <th>State</th>

                                        <th>Zip</th>

                                        <th>Status</th>

                                        <th>Date</th>										

                                        <th style="width: 140px;">Action</th>

									</tr>

								</thead>

								

								<tbody id="filter_data">

								@php

								$i = 0;

								@endphp

								@if(count($comp_data) > 0)

                                @foreach($comp_data as $companies_res)

                                

                                        <tr>

                                            <td>{{ ++$i }}</td>

                                            <td class="copy-text">{{ isset($companies_res->company_name) ? $companies_res->company_name : Null }}</td>
                                            <td class="copy-text" style="width:120px">{{ strtoupper($companies_res->encode_title) }}</td>
                                            <td>{{ substr($companies_res->address, 0, 15).".." }}</td>
                                            <td>{{ isset($companies_res->shipper_state) ? $companies_res->shipper_state : Null }}</td>
                                            <td class="copy-text">{{ isset($companies_res->shipper_zipcode) ? $companies_res->shipper_zipcode : Null }}</td>
                                            <td>
                                                <div class="badge rounded-pill text-white bg-<?php if($companies_res->approved == 0){echo "danger"; }elseif($companies_res->approved == 2){echo "danger"; }elseif($companies_res->approved == 1){ echo 'success'; } ?> p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i><?php if($companies_res->approved == 0){echo "Pending"; }elseif($companies_res->approved == 1){ echo 'Approve'; }elseif($companies_res->approved == 2){ echo 'Dispprove'; } ?></div>

                                            </td>



                                            <td>

                                                {{-- 18/06/2022 3:40 AM --}}

                                                {{ date('m/d/Y', strtotime($companies_res->created_at))}}

                                                {{-- {{ date('Y-m-d', strtotime($companies_res->created_at))}} --}}

                                                {{-- {{ date('m-d-y', strtotime($companies_res->created_at))}} --}}

                                            </td>



                                            <td class="action_tooltip" style="<?php if($companies_res->approved == 2){ ?>width:180px<?php }else{ ?>width:100px<?php } ?>">

                                                {{-- <a href="{{ url('admin/shipper/view',$companies_res->id )}}"> 
                                                <button type="button" value="{{ $companies_res->companies_id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a> --}}

                                                <?php if($companies_res->approved == 2){ ?>



                                                <form method="POST" action="{{url('admin/shipper/requset/resend',base64_encode($companies_res->id) )}}" accept-charset="UTF-8" style="display:inline">

                                                <input name="_method" type="hidden" value="POST">

												@csrf

                                                <button onclick="return confirm('Are You Sure Re-send This Requets..!')" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="fadeIn animated bx bx-refresh"></i> <span class="tooltip">Re-send</span></button>

                                                </form>

                                                <?php } ?>

                                                <a href="{{ url('admin/shipper/edit').'/'.base64_encode($companies_res->id)}}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a>

                                                <a href="{{ url('admin/shipper/delete',$companies_res->id )}}"> 

                                                <button type="button" value="{{ url('admin/shipper/delete',$companies_res->delete )}}" class="btn btn-outline-danger btn-sm radius-30 px-4" onclick="return confirm('Are You Sure Delete This Record..!')"><i class="bx bx-trash"></i><span class="tooltip">Delete</span></button></a>

                                            </td>

											

                                        </tr>

                                @endforeach

                                        @else

                                        <tr style="background-color: #edf3f652;">

                                            <td colspan="8">

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

				</div>

			</div>

		</div>

		<!--end page wrapper -->

    </div>

  </div>

</div>



{{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.2.0/css/dataTables.dateTime.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>

<script src="https://cdn.datatables.net/datetime/1.2.0/js/dataTables.dateTime.min.js"></script> --}}





{{-- working --}}



<script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js" type="text/javascript"></script>  



    <script type="text/javascript"> 

        $(document).ready(function() {

            // $("#datefilter").click(function(){

            //     var min = $("#min").val();

            //     var max = $("#max").val();

            //     if(min && max!=''){

            //         $.ajax({

            //       url: "{{url('/admin/shipper/date-filter')}}",

            //       type:"POST",

            //       data:{

            //         "_token": "{{ csrf_token() }}",

            //         min:min,

            //         max:max,

            //       },

            //       success:function(response){

            //         $("#filter_data").html(response);

            //       }

            //      });

            //     }else{

            //         alert("Please Select From & To Date..");

            //     }

                

            // })

        } );

        

        $(document).ready(function () {

            $.fn.dataTable.ext.search.push(

                function (settings, data, dataIndex) {

                    var min = $('#min').datepicker('getDate');

                    var max = $('#max').datepicker('getDate');

                    var startDate = new Date(data[7]);

                    if (min == null && max == null) return true;

                    if (min == null && startDate <= max) return true;

                    if (max == null && startDate >= min) return true;

                    if (startDate <= max && startDate >= min) return true;

                    return false;

                }

            );

        

            $('#min').datepicker();

            $('#max').datepicker();

            var table = $('#carrier_table').DataTable();

        

            // Event listener to the two range filtering inputs to redraw on input

            $('#min, #max').change(function () {

                table.draw();

            });

        });

        

    </script>

@include('backend.common.footer')

@endsection



