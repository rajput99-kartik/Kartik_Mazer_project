

@extends('backend.layouts.master')
@section('title','Load RateView History')
@section('content')

{{-- //Only for style card this page only --}}
@include('backend.common.card.style');

<div class="page-wrapper">
        <div class="page-content">
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('admin/loads') }}">All Loads</a></li>
                    <li><a href="{{ url('admin/load/search_truck') }}">Search Truck</a></li>
                    @can('loads-reports')
                        <li class="active"><a href="{{ url('/admin/loads/') }}" aria-expanded="true">Rate History</a>
                        </li>
                        <li><a href="{{ url('/admin/load/reports') }}" data-toggle="tab" aria-expanded="false">Load Report</a></li>
                    @endcan
                </ul>

                <!--end breadcrumb-->
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p>{{ $message }}</p>
                    </div>
                @endif
      
            <div class="card">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-box">
                                <div class="box-head">
                                    <span>Contract $ </span>
                                    <h4>Contract Report</h4>
                                    <a href="{{url('admin/loads')}}">
                                    <button class="btn btn-danger btn-sm">All Loads</button>
                                    </a>
                                    {{-- <button class="btn btn-primary btn-sm">Logs</button> --}}
                                </div>
                                <div class="box-body">
                                        @php $i=1;
                                        @endphp
                                        @foreach($data as $user_load)
                                            <p class="copy-text"> <span>Load Id : </span>{{ $user_load->load_refid }}</p>
                                            <p class="copy-text"><span>Load Referance : </span>{{ $user_load->ref_no }}</p>
                                            <p class="copy-text"><span>Contract Rate : </span>{{ $user_load->contractreport }}</p>
                                            <p class="copy-text"><span>Contract Company : </span>{{ $user_load->contractcompanies }}</p>
                                            <p class="copy-text"><span>Contract Mileage : </span>{{ $user_load->contractmileage }}</p>
                                            <p class="copy-text"> <span style="color:green;">Contract Max Rate : </span>{{ $user_load->contracthighUsd }}</p>
                                            <p class="copy-text"><span style="color:blue;">Contract Final-Rate : </span>{{ $user_load->contractrateUsd }}</p>
                                            <p class="copy-text"><span>Contract Timeframe : </span>{{ $user_load->contracttimeframe }}</p>
                                            <p class="copy-text"><span>Contract Origin : </span>{{ $user_load->contractorigin }}</p>
                                            <p class="copy-text"><span>Contract Destination : </span>{{ $user_load->contractdestination }}</p>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card-box">
                                <div class="box-head">
                                    <span>Spot $</span>
                                    <h4>Spot Report</h4>
                                    <a href="{{url('admin/loads')}}">
                                        <button class="btn btn-danger btn-sm">All Loads</button>
                                        </a>
                                    {{-- <button class="btn btn-primary btn-sm">Logs</button> --}}
                                </div>
                                <div class="box-body">
                                  
                                    @php $i=1;
                                    @endphp
                                    @foreach($data as $user_load)
                                    <p class="copy-text"> <span>Load Id : </span>{{ $user_load->load_refid }}</p>
                                    <p class="copy-text"><span>Load Referance : </span>{{ $user_load->ref_no }}</p>
                                    <p class="copy-text"><span>Spot Rate : </span>{{ $user_load->spotreport }}</p>
                                    <p class="copy-text"><span>Spot Company : </span>{{ $user_load->spotcompanies }}</p>
                                    <p class="copy-text"><span>Spot Mileage : </span>{{ $user_load->spotmileage }}</p>
                                    <p class="copy-text"> <span style="color:green;">Spot Max-Rate : </span>{{ $user_load->spothighUsd }}</p>
                                    <p class="copy-text"><span style="color:blue;">Spot Final-Rate : </span>{{ $user_load->spotrateUsd }}</p>
                                    <p class="copy-text"><span>Spot Timeframe : </span>{{ $user_load->spottimeframe }}</p>
                                    <p class="copy-text"><span>Spot Origin : </span>{{ $user_load->spotorigin }}</p>
                                    <p class="copy-text"><span>Spot Destination : </span>{{ $user_load->spotdestination }}</p>
                                    @endforeach


                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>

        </div>
</div>




@include('backend.common.footer')
@endsection