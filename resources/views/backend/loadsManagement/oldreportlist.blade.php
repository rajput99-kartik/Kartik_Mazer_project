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
            <!--<button class="btn btn-primary">Import Users</button>-->
            <!--<a class="btn btn-success" href="{{ url('export-users') }}">Export Users</a>-->
            <div class="card">
                <!-- //advance search -->
                <div class="row" id="search_row">
                    <div class="col-md-8">
                        <form method="GET" action="">
                            <div class="row">
                                <div class="col-md-3 dsp1">
                                    <!--<label>From Date:</label>-->
                                    <?php
                                    $aname = App\Models\User::get();
                                    ?>

                                    <select id="users_search" name="search" class="form-control selec12" placeholder="Select Broker"
                                        data-style="btn-info">
                                        <option disabled>- Select Type -</option>
                                        <option value="<?php
                                        if (!empty($search)) {
                                            'all';
                                        } else {
                                            echo $search;
                                        }
                                        ?>" selected>
                                            @if (!empty($search))
                                                All
                                            @else
                                                {{ $search }}
                                            @endif
                                        </option>


                                        <option value="<?php
                                        if (empty($search)) {
                                            'all';
                                        } else {
                                            echo $search;
                                        }
                                        ?>" selected>

                                            @if(empty($search))
                                                All
                                            @else
                                                {{ $search }}
                                            @endif
                                        </option>
                                        
                                        <option value="Date-Range"><?php
                                        if ($search == 'Date-Range'):
                                            echo $search;
                                        else:
                                            echo 'Date-Range';
                                        endif;
                                        ?> </option>


                                        @foreach ($aname as $broker)
                                            <option value="{{ $broker->name }}" <?php
                                            if ($broker->name == $search) {
                                                'selected';
                                            }
                                            ?>>{{ $broker->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="col-md-3">

                                    <?php
                                    // $fromDate = '' ;
                                    // $toDate = '' ;
                                    ?>
                                    <!--<label>From Date:</label>-->
                                    <input type="date" name="fromdate" class="form-control min-date" placeholder="From Date"
                                        id="maindate_" value="{{ $fromDate }}">
                                </div>
                                <div class="col-md-3">
                                    <!--<label>To Date:</label>-->
                                    <input type="date" name="todate" class="form-control max-date" placeholder="To Date"
                                        id="maindate_" value="{{ $toDate }}">
                                </div>

                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-md-4">
                        <div class="col-md-8">
    			            <form method="GET" action="">
    			                <div class="row">    
                                    <div class="col-md-8 dsp"  style="display:inline-block; float:left;">
                                        <!--<label>From Date:</label>-->
                                        <input type="text" name="searchref" class="form-control" placeholder="search" value="{{$search}}">
                                    </div>
                                    <div class="col-md-2" style="float: left;display: block;margin-left: 20px;">
                                        <!--<label>To Date:</label>-->
                                        <!-- <input type="text" id="max" name="max" class="form-control" placeholder="To Date"> -->
                                        <input type="submit" class="btn btn-primary" value="search">
                                    </div>
                                    
                                </div>
                            </form> 
    			        </div>
    			        
    			        {{-- <div class="clearfm col-md-2" style="float: left;">
                            <a href="{{url('admin/load/reports/list')}}">
                                <button  type="submit" class="btn btn-info">Reset</button>
                            </a> 
                        </div> --}}
                    </div>

                </div>

                <!-- //Normal search -->


                <!--<table class="table mb-0" id="carrier_table">-->
                <!--<table id="example" class="table mb-0 table-hover" style="width:100%">-->
                {{-- <table id="examplepp" class="table mb-0 table-hover" style="width:100%"> --}}
                    <table id="post" class="table mb-0 table-hover" style="width:100%">
                    
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

                    <tbody id="lodetypeerStatus">
                        <?php 

                            //  dd($user_loads);
						    // echo "<pre>", print_r($user_loads);

                            foreach ($user_loads as $user_load) {?>
                        <tr class="odd">
                            <td class="copy-text">{{ $user_load->ref_no }}</td>
                            <td class="copy-text">{{ $user_load->post_date }}</td>
                            <td class="copy-text">{{ $user_load->load_state_origin }}</td>
                            <td class="copy-text">{{ $user_load->load_city_desti }}</td>
                            <td class="copy-text">{{ $user_load->equipments }}</td>
                            <td class="copy-text">{{ $user_load->full_partial_tl_ltl }}</td>
                            <td class="copy-text">{{ $user_load->agent_name }}</td>
                            <?php
                            
                            $status = $user_load->load_status;
                            $date_pick = explode('T', $user_load->dat_pick_date);

                           // dd($date_pick);

                            $date_pick1 = strtotime($date_pick['0']);
                            $today = strtotime(date('Y-m-d'));

                           // dd($date_pick1);

                            //today // 1692729000
                            //date_pick1 = //1692297000 
                            $lstatus = '';
                            // 2022-11-18T10:29:20.000Z
                            
                            if ($today > $date_pick1) {
                                $lstatus = 'Expire';
                            } else {
                                if ($status == 1) {
                                    $lstatus = 'Delete';
                                } else {
                                    $lstatus = 'Active';
                                }
                            }
                            ?>
                            <td>{{ $lstatus }}</td>
                            <!--<td>{{ date('d M, Y', strtotime($user_load->created_at)) }}</td>-->
                            <td>{{ date('d-m-Y', strtotime($user_load->created_at)) }}</td>
                            <td style="width: 80px;" class="action_tooltip classToInclude">
                                <input type="hidden" value="{{ $user_load->load_dat_id }}" id="load_dat_id">
                                <button type="button" class="btn btn-outline-secondary btn-sm radius-30 px-4"
                                    id="load_update_form_btn"><i class="bx bx-edit"></i><span
                                        class="tooltip">Edit</span></button>
                            </td>
                        </tr>
                        <?php } ?>

                    </tbody>

                </table>
                <center class="mt-5">
                    {!! $user_loads->withQueryString()->links('pagination::bootstrap-5') !!}
                </center>

            </div>
        </div>

    </div>
    </div>

    <!--loads edit model start-->
    <div class="modal" id="LoadUpdateForm">
    </div>
    <!--loads edit model end-->

    <script>
        $(document).ready(function() {

            $("a#LoadRefreshB").click(function() {
                if ($("select#lodetypeerStatus").val() == '' || $("input#from_date").val() == '' || $(
                        "input#to_date").val() == '') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Please Select Load Type, From Date & To Date..'
                    })
                } else {
                    var lodetypeerStatus = $("select#lodetypeerStatus").val();
                    var from_date = $("#from_date").val();
                    var to_date = $("#to_date").val();
                    var userid = $(this).attr('load-data');
                    $.ajax({
                        url: "{{ url('/admin/load/manager/assignuser/loadsfilter') }}",
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            lodetypeerStatus: lodetypeerStatus,
                            from_date: from_date,
                            to_date: to_date,
                            userid: userid,
                        },
                        success: function(response) {
                            $("tbody#lodetypeerStatus").html(response);
                            $("#reset").fadeIn();
                            $("div#carrier_table_paginate").hide();
                        },
                        error: function(response) {
                            console.log(response.responseJSON.errors);
                        }
                    });


                }

            })

            $("#reset").click(function() {
                let timerInterval
                Swal.fire({
                    title: 'Wait..',
                    html: 'I will Reset Filter in <b></b> milliseconds.',
                    timer: 2000,
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
                setTimeout(function() {
                    window.location.reload();
                }, 500)

            })

            $('.search_input input').keyup(function() {
                $('#' + $(this).attr('for')).show();

                var value = $(this).val().toLowerCase();
                $('#' + $(this).attr('for') + ' li').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            })

            $("ul#lane_drop li").click(function() {
                $('input[name="lane_drop"]').val($(this).text());
                $("ul#lane_drop").hide();
            })

            $("ul#lane_origin li").click(function() {
                $('input[name="lane_origin"]').val($(this).text());
                $("ul#lane_origin").hide();
            })

            //-----JS for Price Range slider-----

            $(function() {
                $("#slider-range").slider({
                    range: true,
                    min: 130,
                    max: 500,
                    values: [130, 250],
                    slide: function(event, ui) {
                        $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                    }
                });
                $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                    " - $" + $("#slider-range").slider("values", 1));
            });
        })
    </script>
    <!--end page wrapper -->
    <script>
        /* Admin shipper list filter funcation Start Here*/
        $(document).on('click', '#LoadRefreshB', function() {

            var lodetypeerStatus = $('#lodetypeerStatus').val();
            // var ShipperName = $('#ShipperName').val();
            // var AgentName = $('#AgentName').val();
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();


            if ((lodetypeerStatus != '') || (ShipperName != '') || (AgentName != '')) {


                $.ajax({
                    url: HOSTPATH + 'admin/load/loadFilterAdmin',
                    type: 'get',
                    cache: false,
                    data: {
                        lodetypeerStatus: lodetypeerStatus,
                        ShipperName: ShipperName,
                        AgentName: AgentName
                    },
                    success: function(data) {

                        $('#lodetypeerStatus').html(data);
                        setTimeout(function() {
                            Swal.close();
                        }, 500);

                    }
                });

            } else {

                Swal.fire({
                    position: 'center',
                    icon: 'warning',
                    title: 'Select some details first!',
                    showConfirmButton: false,
                    timer: 1000
                })

            }


        });
        /* Admin shipper list filter funcation End Here*/
    </script>


    <script>
        $(document).ready(function() {
            $('#carrier_table').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ],
                columnDefs: [{
                    // targets: -2,
                    visible: false
                }]
            });
        });
    </script>


    <!--<script>
        -- >
        <
        !--$(document).ready(function() {
            -- >
            <
            !--$('#carrier_table').DataTable({
                -- >
                <
                !--dom: 'Bfrtip',
                -- >
                <
                !--buttons: [-- >
                        <
                        !--'copy', 'csv', 'excel', 'pdf', 'print', -- >

                        <
                        !--
                    ]-- >


                    <
                    !--
            });
            -- >
            <
            !--
        });
        -- >
        <
        !--
    </script>-->


<script>
        $(document).ready(function() {
            $("#users_search").change(function() {
                if ($(this).val() == '') {
                    $(".min-date, .max-date").val('');
                }
            })
        });
</script>

    {{-- fillter start here data & buttom search --}}

    <!--Fillter start here data & buttom search-->
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "ordering": false,
                initComplete: function() {
                    this.api()

                        .columns()
                        .every(function() {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    var val = $.fn.dataTable.util.escapeRegex($(this).val());

                                    column.search(val ? '^' + val + '$' : '', true, false)
                                        .draw();
                                });


                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append('<option value="' + d + '">' + d +
                                        '</option>');
                                });
                        });
                },

                order: [
                    [8, 'desc']
                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    'colvis'
                ],
                columnDefs: [{
                    // targets: -2,
                    visible: false
                }]
            });
        });
    </script>
    <!--Date Fillter Start-->
    
    <script>
        $(document).ready(function() {
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var min = $('#min').datepicker('getDate');
                    var max = $('#max').datepicker('getDate');
                    var startDate = new Date(data[8]);
                    if (min == null && max == null) return true;
                    if (min == null && startDate <= max) return true;
                    if (max == null && startDate >= min) return true;
                    if (startDate <= max && startDate >= min) return true;
                    return false;
                }
            );

            $('#min').datepicker();
            $('#max').datepicker();
            var table = $('#example').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').change(function() {
                table.draw();
            });
        });
    </script>
    <!--Date Fillter End-->

    <!-- //for select search -->
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>



    <script>
        $(document).ready(function () {
            $('#post').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax":{
                        "url": "{{ url('admin/load/reports/allpost') }}",
                        "dataType": "json",
                        "type": "get",
                        "data":{ _token: "{{csrf_token()}}"}
                    },
                "columns": [
                    { "data": "id" },
                    { "data": "ref_no" },
                    { "data": "post_date" },
                    { "data": "load_state_origin" },
                    { "data": "load_city_desti" },
                    { "data": "full_partial_tl_ltl" },
                    { "data": "equipments" },
                    { "data": "agent_name" },
                    { "data": "load_status" },
                    { "data": "created_at" },
                    { "data": "options" }
                ]	 

            });
        });
    </script>


    @include('backend.common.footer')
@endsection
