@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
<style>
/* thead.table-light th {
    background-color: #edf3f6;
    padding: 15px 10px;
    color: #687981;
    font-size: 12px;
} */
thead.table-light th{
    --bs-table-color: #000;
    --bs-table-bg: #f8f9fa;
    --bs-table-border-color: #dfe0e1;
    --bs-table-striped-bg: #ecedee;
    --bs-table-striped-color: #000;
    --bs-table-active-bg: #dfe0e1;
    --bs-table-active-color: #000;
    --bs-table-hover-bg: #e5e6e7;
    --bs-table-hover-color: #000;
    color: var(--bs-table-color);
    border-color: var(--bs-table-border-color);
}
body {
    font-size: 14px;
    color: #4c5258;
    letter-spacing: .5px;
    background-color: #f4f4f4;
    overflow-x: hidden;
    font-family: Roboto, sans-serif !important;
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
                        <li class="active"> <a href="{{url('admin/shipper/request/limit')}}" data-toggle="tab" aria-expanded="false"> Shipper Request Limit</a>
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
                                        <th>Address</th>
                                        <th>Broker</th>
                                        <th>Timer</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th width="14px">Action</th>
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
                                                    <td style="width:30px; !important">
                                                        {{ substr($companies_res->address, 0, 40) ? substr($companies_res->address, 0, 40) : Null  }}	
                                                    </td>
                                                    
                                                    @php
                                                        $user_data = App\Models\User::where('id',$companies_res->user_id)->offset(0)
                                                            ->limit(0)->first();
                                                        $datad = $companies_res->company_date;
                                                        // $user_data = ucwords($user_data->name) ? $user_data->name : Null;
                                                    @endphp
                                                  <td>{{isset($user_data->name) ? $user_data->name : Null }}</td>
                                                    
                                                    <td id="demo_{{$i}}" class="req_date">{{ isset($companies_res->company_date) ? $companies_res->company_date : Null}}</td>
                                                    <td>
                                                            
                                                            @if($companies_res->approved == 0)
                                                                <div class="badge rounded-pill text-white bg-warning p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Pending</div>
                                                            @elseif( $companies_res->approved == 1)
                                                            <div class="badge rounded-pill text-white bg-success p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>Approve</div>
                                                            @else
                                                            <div class="badge rounded-pill text-white bg-danger p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>{{ 'DisApprove' }}</div>
                                                            @endif 
                                                        
                                                    </td>
                                                    <td>{{ date('d M, Y', strtotime($companies_res->created_at)) }}</td>
                                                    <td class="action_tooltip">
                                                        <div class="d-flex order-actions">
                                                            <a href="{{ url('admin/shipper/request/edit').'/'.base64_encode($companies_res->id)}}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bxs-edit"></i> <span class="tooltip">Edit</span></a> 												
                                                        </div>
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