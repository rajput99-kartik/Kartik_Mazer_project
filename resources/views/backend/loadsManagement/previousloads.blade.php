@extends('backend.layouts.master')
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

    .page-wrapper2{
        height: 100%;
    margin-top: 50px;
    margin-bottom: 30px;
    margin-left: 35px;
    }
</style>
   
    {{-- <h2>
        @foreach ($load as $item)
            {{$item->load_state_origin}}
        @endforeach
    </h2> --}}
    <div class="page-wrapper2">
        <div class="page-content">

       <div class="container">
        <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
            <div class="row">
                {{-- <div class="col-sm-12 col-md-6">
                    <div class="dataTables_length" id="example_length">
                        <label>Show 
                            <select name="example_length" aria-controls="example" class="form-select form-select-sm">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select> 
                            entries
                        
                        </label>
                    </div>
                </div> --}}
                {{-- <div class="col-sm-12 col-md-6">
                    <div id="example_filter" class="dataTables_filter">
                        <label>Search:
                            <input type="search" id="search" class="form-control form-control-sm" placeholder="" aria-controls="example" value="{{ $search }}">
                        </label>
                    </div>
                </div> --}}
                
            </div>
        </div>
       </div>

            <table id="example" class="table mb-0 table-hover " style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>Referenc</th>
                        <th>Pick Date</th>
                        <th>Origin</th>
                        <th>Drop</th>
                        <th>Truck</th>
                        <th>Load Type</th>
                        <th>Broker Name</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Spot Rate</th>
                        <th>Contract Rate</th>
                    </tr>
                </thead>

                    <tbody id="lodetypeerStatus">
                   
                        @foreach ($loadData as $loadItem)
                        <tr class="odd">
                            <td class="copy-text">{{ $loadItem['load']->ref_no }}</td>
                            <td class="copy-text">{{ $loadItem['load']->post_date }}</td>
                            <td class="copy-text">{{ $loadItem['load']->load_state_origin }}</td>
                            <td class="copy-text">{{ $loadItem['load']->load_city_desti }}</td>
                            <td class="copy-text">{{ $loadItem['load']->equipments }}</td>
                            <td class="copy-text">{{ $loadItem['load']->full_partial_tl_ltl }}</td>
                            <td class="copy-text">{{ $loadItem['load']->agent_name }}</td>
                    
                            <!-- Calculate and display load status -->
                            <?php
                            $status = $loadItem['load']->load_status;
                            $date_pick = explode('T', $loadItem['load']->dat_pick_date);
                            $date_pick1 = strtotime($date_pick[0]);
                            $today = strtotime(date('Y-m-d'));
                            $lstatus = '';
                    
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
                            <td>{{ date('d-m-Y', strtotime($loadItem['load']->created_at)) }}</td>
                    
                            <!-- Access spotrateUsd and contractrateUsd from the load_reference if available -->
                            @if ($loadItem['load_reference'])
                                <td>{{ $loadItem['load_reference']->spotrateUsd }}</td>
                                <td>{{ $loadItem['load_reference']->contractrateUsd }}</td>
                            @else
                                <td>Not Available</td>
                                <td>Not Available</td>
                            @endif
                        </tr>
                    @endforeach
                    
                        
                    

                    </tbody>

            </table>

            {{-- <div class="row">
                {{-- <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing 1 to 10 of 2 entries</div>
                </div> 
                <div class="col-sm-12 col-md-7">
                    {{-- <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                        <ul class="pagination">
                            <li class="paginate_button page-item previous disabled" id="example_previous">
                                <a href="#" aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link">Prev</a>
                            </li>
                            <li class="paginate_button page-item next" id="example_next"><a href="#" aria-controls="example" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                        </ul>
                    </div> 
                </div>

            </div> --}}

            
        </div>
    </div>   
