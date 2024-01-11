@extends('backend.layouts.master')
@section('title', 'Loads Management')
@section('content')


    <style>
        button#reset {
            position: absolute;
            right: 20px;
            background: none;
            top: 13px;
            width: fit-content !important;
            border: none;
            color: red;
            display: none;
        }

        .date-filter12 {
            background-color: #fff;
            padding: 20px 20px 0px;
            position: relative;
            z-index: 9;
        }

        .date-filter12 h4 {
            font-size: 16px;
        }

        .date-filter12 input {
            padding: 6px 10px;
        }

        .date-filter12 .row {
            align-items: center;
        }

        .date-filter12 button {
            border-radius: 2px;
        }

        span.advance_filter {
            position: absolute;
            top: 0;
            right: 0;
            background-color: #1e55bf;
            color: #fff;
            padding: 3px 10px 5px;
            font-size: 12px;
            cursor: pointer;
        }

        tfoot select {
            border: solid 1px #1e55bf;
            outline: none;
            box-shadow: 0px 0px 20px -10px;
        }

        div#example_length {
            display: none;
        }

        .card-body.table-responsive {
            margin-top: -71px;
        }

        div#example_filter {
            position: relative;
        }

        #example_filter label {
            position: relative;
            z-index: 99;
        }

        .card-body.table-responsive {
            margin-top: 0px;
        }

        #search_row {
            padding: 20px 20px 0px;
            margin-top: 20px;
        }
    </style>


    <!--start page wrapper -->
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
                <!-- //advance search -->        
                {{-- <table id="examplepp" class="table mb-0 table-hover" style="width:100%"> --}}
                {{-- <table class="table mb-0 table-hover" id="carrier_table" style="width:100%">
                    <thead class="table-light">
                        <tr>
                            <th>Referenc</th>
                            <th>Pick Date</th>
                            <th>Origin</th>
                            <th>Drop</th>
                            <th>Truck</th>
                            <th>Load Type</th>
                            <th>Broker</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table> --}}

                <div class="table-responsive">
                    <table id="example"  class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Referance No</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                    <tbody id="loadpostinfo">
                    </tbody>
                </div>
                
            </div>
        </div>
    </div>
    </div>

    <!--loads edit model start-->
    <div class="modal" id="LoadUpdateForm">
    </div>
    <!--loads edit model end-->

    
    <script>

        new DataTable('#example', {
            ajax: "{{ url('admin/data/cuisines') }}",
            columns: [
                { data: 'ref_no' },
                { data: 'name' },
                { data: 'action', name: 'action', orderable: false, searchable: false}
            
            ]
        });

        // $('#example').DataTable({
        //     "order": [[ 0, "desc" ]],
        //     'processing': true,
        //     'serverSide': true,
        //     'serverMethod': 'post',
        //     'ajax':{
        //         'url': "{{ url('admin/data/cuisines') }}",
        //         'type':'post',
        //         'cache' : false,
		// 	    'data':{data:aaData},
        //         success:function(data){
		// 		   //console.log(data);
		// 		   $('#loadpostinfo').html(data);
		// 	   }
        //         // "error": function(reason) {
        //         //     console.log(reason);
        //         // }
        //     },
        //     "columns" : [
        //         { data: 'ref_no' },
        //         { data: 'name' },
        //         { data: 'action', name: 'action', orderable: false, searchable: false}
        //     ]
        // });



        
    </script>


   


    @include('backend.common.footer')
@endsection
