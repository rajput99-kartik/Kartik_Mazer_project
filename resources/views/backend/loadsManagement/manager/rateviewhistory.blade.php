

@extends('backend.layouts.master')
@section('title','Load RateView History')
@section('content')


<div class="page-wrapper">
    <div class="page-content">
        <ul class="nav nav-tabs">
            <li><a href="{{ url('admin/loads') }}">All Loads</a></li>
            <li><a href="{{ url('admin/load/search_truck') }}">Search Truck</a></li>
            @can('loads-reports')
                <li class="active"><a href="{{ url('/admin/load/reports/list') }}" aria-expanded="true">Load Report List</a>
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
                <div class="card-body table-responsive">	
                    <table class="table mb-0" id="carrier_table">
                        <thead class="table-light">
                        <tr>
                            <th>Load Id</th>
                            <th>Load Referance</th>
                            <th>Spot Rate</th>
                            <th>Sport Company</th>
                            <th>Sport Mileage</th>
                            <th>Spot HighUsd</th>
                            <th>Spot RateUsd</th>
                            <th>Spot Timeframe</th>
                            <th>Spot Origin</th>
                            <th>Spot Destination</th>
                            <th>Date</th>
                        </tr>
                        </thead>

                        <tbody >
                        
                        @php $i=1;
                        @endphp
                            @foreach($data as $user_load)
                                <tr class="odd">
                                    <td class="copy-text">{{ $user_load->load_refid }}</td>
                                    <td class="copy-text">{{ $user_load->ref_no }}</td>
                                    <td class="copy-text">{{ $user_load->spotreport }}</td>
                                    <td class="copy-text">{{ $user_load->spotcompanies }}</td>
                                    <td class="copy-text">{{ $user_load->spotmileage }}</td>
                                    <td class="copy-text">{{ $user_load->spothighUsd }}</td>
                                    <td class="copy-text">{{ $user_load->spotrateUsd }}</td>
                                    <td class="copy-text">{{ $user_load->spottimeframe }}</td>
                                    <td class="copy-text">{{ $user_load->spotorigin }}</td>
                                    <td class="copy-text">{{ $user_load->spotdestination }}</td>

                                    {{-- <td class="copy-text">{{ $user_load->contractreport }}</td>
                                    <td class="copy-text">{{ $user_load->contractcompanies }}</td>
                                    <td class="copy-text">{{ $user_load->contractmileage }}</td>
                                    <td class="copy-text">{{ $user_load->contracthighUsd }}</td>
                                    <td class="copy-text">{{ $user_load->contractrateUsd }}</td>
                                    <td class="copy-text">{{ $user_load->contracttimeframe }}</td>
                                    <td class="copy-text">{{ $user_load->contractorigin }}</td>
                                    <td class="copy-text">{{ $user_load->contractdestination }}</td> --}}
                                    <td>{{ date('d M, Y', strtotime($user_load->created_at) )}}</td> 
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
            </div>

    </div>
</div>


<script>



</script>




@include('backend.common.footer')
@endsection