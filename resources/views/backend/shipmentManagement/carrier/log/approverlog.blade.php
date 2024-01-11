@extends('backend.layouts.master')
@section('title', 'Carrier Approver Log Management')
@section('content')


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

                <li class="active"> <a href="{{url('admin/shipper/request/log')}}" data-toggle="tab" aria-expanded="false"> Carrier Approver Log</a>

                </li>
                @endcan
            </ul>
            @php
           

            @endphp
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table mb-0" id="post">
                            <thead class="table-light">
                                <tr>
                                    <th>Id</th>
                                    <th>MC No.</th>
                                    <th>Dot No.</th>
                                    <th>Comment</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#post').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                        "url": "{{ url('admin/carrier/request/log') }}",
                        "dataType": "json",
                        "type": "get",
                        "data":{ _token: "{{csrf_token()}}"},
                        //alert(data);
                    },
                "columns": [
                    { "data": "id" },
                    { "data": "mc_no" },
                    { "data": "dot_no" },
                    { "data": "comment" },
                    { "data": "status" },
                    { "data": "created_at" },
                ]	 
            });
        });
    </script>


    @include('backend.common.footer')
@endsection
