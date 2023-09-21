@extends('backend.layouts.master')

@section('title','Shipper Management')

@section('content')

        <!--start page wrapper -->

        <div class="page-wrapper">

            <div class="page-content">

                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <ul class="nav nav-tabs">
                    @can('shipper-all')
                    <li class="pending_approval"><a href="{{url('/admin/shipper/list')}}" data-toggle="tab" aria-expanded="true">All Shipper</a>
                    </li>

                    @endcan
                    @can('shipper-agentshipper')
                    <li class="pending_approval"><a href="{{url('/admin/shipper/manager/list')}}" data-toggle="tab" aria-expanded="true">Team Shipper</a></li>
                    @endcan
                    
                    @can('shipper-create')
                    <li class="all_leav"><a href="{{url('/admin/shipper')}}" data-toggle="tab" aria-expanded="false">Shipper</a>
                        </li>
                    <li class=""><a href="{{url('/admin/shipper/add')}}" data-toggle="tab" aria-expanded="false">Create Shipper</a>
                    </li>
                    @endcan

                    @can('shipper-request')

                    <li class="active"> <a href="{{url('admin/shipper/request')}}" data-toggle="tab" aria-expanded="false"> Shipper Request</a>

                    </li>

                    @endcan

                </ul>

                <div class="card">

                    <div class="card-body">

                        <div class="table-responsive">

                            <table class="table mb-0" id="carrier_table">

                                <thead class="table-light">

                                    <tr>

                                    <th>No</th>

                                    <th>Company</th>

                                    <th style="width:30px; !important">Address</th>

                                    <th>Broker</th>

                                    <th>Timer</th>

                                    <th>Status</th>

                                    <th>Date</th>
                                    <th width="154px">Action</th>

                                    </tr>

                                </thead>

                                <tbody>

                                @php

                                $i = 0;

                                @endphp

                               @if(count($comp_data) > 0)

                                @foreach($comp_data as $key => $companies_res)

                                    <tr>

                                        <td>{{ ++$i }}</td>

                                        <td>{{isset($companies_res->company_name) ? $companies_res->company_name : Null }}</td>

                                        

                                        <td style="width:30px; !important">{{ isset($companies_res->address) ? $companies_res->address : Null  }}	</td>

                                        

                                       

                                        @php

                                        $user_data = App\Models\User::where('id',$companies_res->user_id)->first();



                                        $datad = $companies_res->company_date;

                                        @endphp

                                        <script>

                                            // Set the date we're counting down to

                                            // 62d 21h 41m 35s

                                            var countDownDate_{{$i}} = new Date("<?php echo $datad; ?>").getTime();

                                            // var countDownDate = new Date("Jan 5, 2023 15:37:25").getTime();

                                            

                                            // Update the count down every 1 second

                                            var x_{{$i}} = setInterval(function() {

                                            

                                            // Get today's date and time

                                            var now_{{$i}} = new Date().getTime();

                                            

                                            var currentdate_{{$i}} = new Date(); 

                                                var datetime_{{$i}} = currentdate_{{$i}}.getFullYear() + "-"

                                                            + (currentdate_{{$i}}.getMonth()+1)  + "-" 

                                                            + currentdate_{{$i}}.getDate() + " "  

                                                            + currentdate_{{$i}}.getHours() + ":"  

                                                            + currentdate_{{$i}}.getMinutes() + ":" 

                                                            + currentdate_{{$i}}.getSeconds();



                                            //document.write(datetime);

                                                

                                            // Find the distance between now and the count down date

                                            var distance_{{$i}} =  currentdate_{{$i}} - countDownDate_{{$i}}   ;

                                            

                                            // Find the distance between now and the count down date

                                            // var distance_{{$i}} = now_{{$i}} - countDownDate_{{$i}} ;

                                                

                                            // Time calculations for days, hours, minutes and seconds

                                            var days_{{$i}} = Math.floor(distance_{{$i}} / (1000 * 60 * 60 * 24));

                                            var hours_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

                                            var minutes_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60 * 60)) / (1000 * 60));

                                            var seconds_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60)) / 1000);

                                                

                                            // Output the result in an element with id="demo"

                                            document.getElementById("demo_{{$i}}").innerHTML = "<span>"+days_{{$i}} + "d </span>" + "<span>"+hours_{{$i}} + "h </span>"

                                            + "<span>"+minutes_{{$i}} + "m </span>" + "<span>"+seconds_{{$i}} + "s </span>";

                                                

                                            // If the count down is over, write some text 

                                            if (distance_{{$i}} < 0) {

                                                clearInterval(x);

                                                document.getElementById("demo_{{$i}}").innerHTML = "EXPIRED";

                                            }

                                            }, 1000);

                                            </script>

                                            

                                         <td>{{ isset($user_data->name) ? $user_data->name : Null}}</td>

                                        <td id="demo_{{$i}}" class="req_date">{{ isset($companies_res->company_date) ? $companies_res->company_date : Null}}</td>



                                        <td>
                                            <div class="badge rounded-pill text-success bg-light-info p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>  @if($companies_res->approved == 0) Pending @endif </div>
                                          <?php // endif ?>
                                        </td>

                                        <td>{{ date('d M, Y', strtotime($companies_res->created_at)) }}</td>

                                        <td class="action_tooltip">

                                            <a href="{{ url('admin/shipper/request/edit').'/'.base64_encode($companies_res->id)}}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a> 

                                        </td>

                                    </tr>

                              @endforeach

                                    @else

                                        <tr style="background-color: #edf3f652;">

                                            <td colspan="7">

                                                <div class="row">

                                                    <div class="col-md-4"></div>

                                                    <div class="col-md-4 not-found">
                                                        <img src="{{url('/public/backend/assets/images/message.png')}}">
                                                        <h4> No Shipper Request, yet.</h4>
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







        

            





        



@include('backend.common.footer')



@endsection