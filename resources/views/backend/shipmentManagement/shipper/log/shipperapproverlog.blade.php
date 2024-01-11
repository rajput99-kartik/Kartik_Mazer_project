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

                    <li class="active"> <a href="{{url('admin/shipper/request/log')}}" data-toggle="tab" aria-expanded="false"> Shipper Approver Log</a>

                    </li>

                    @endcan

                </ul>


                @php
                //    echo "<pre>", print_r($shiper_log) , die();
                  //  dd($ship);



                @endphp
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0" id="carrier_table">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Company Name</th>
                                        <th>Short Name</th>
                                        <th>Broker</th>
                                        <th>Comment</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Pre Pay</th>
                                        <th>Limit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                $i = 0;
                                @endphp
                                    @if(count($ship) > 0)


                                        @foreach($ship as $key => $companies_res)
                                                @php

                                                    $cp_id= $companies_res->companies_id;
                                                    $company_name = App\Models\Company::where('id',$cp_id)->first();
                                                    $user_data = App\Models\User::where('id',$companies_res->receiver_id)->first();
                                                @endphp
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{isset($company_name->company_name) ? $company_name->company_name : Null }}</td>
                                                <td>{{isset($company_name->encode_title) ? $company_name->encode_title : Null }}</td>
                                                <td>{{isset($user_data->name) ? $user_data->name : Null }}</td>
                                                <td>{{isset($companies_res->comment) ? $companies_res->comment : Null }}</td>
                                                <td>{{isset($companies_res->type) ? $companies_res->type : Null }}</td>
                                                <td>{{ date('d M, Y, h:i:m' , strtotime($companies_res->created_at)) }}</td>

                                                <td>{{ $companies_res->pre_pay_limit }}</td>
                                                <td>{{ $companies_res->limit_rquest }}</td>


                                                
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