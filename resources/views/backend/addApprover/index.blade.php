<?php 
	
// $data  = DB::table('loads')->get();

// $datad1  = App\Models\Load::where('full_partial_tl_ltl','FUll')->count();
// $datad  = App\Models\Load::where('full_partial_tl_ltl','PARTIAL')->count();



    // $report = DB::table('loads')
    //     ->selectRaw('count(load_state_origin) as number_of_loads, load_state_origin')
    //     ->groupBy('load_state_origin')
    //     ->havingRaw('COUNT(*) > 1')
    //     ->get();

    // $stateData = $report->toArray() ;
       // dd($stateData);

       $data1 = App\Models\AddApprover::get();
    //    dd($data1);
    ?>
@extends('backend.layouts.master')
@section('title', 'Shipper Limit Approver')
@section('content')

<style>
    /* Add your existing styles here */

    /* Additional styles for improved layout */
    .form-group {
        margin-bottom: 15px;
    }

    .row.g-3.align-items-center {
        margin-bottom: 20px;
    }

    label.col-form-label {
        font-weight: bold;
    }

    /* Style the table */
    table {
        width: 100%;
        margin-top: 20px;
        border-collapse: collapse;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    /* Date filter row */
    .date-filter {
        margin-top: 20px;
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <!-- Breadcrumb and Alerts -->

        <!-- Nav Tabs -->
        <ul class="nav nav-tabs">
            <li class="pending_approval"><a href="{{url('/admin/dashboard')}}" data-toggle="tab" aria-expanded="true">Dashboard</a></li>
            <li class="all_leave active"><a data-bs-toggle="modal" data-bs-target="#TodayLanesLoads" data-toggle="tab" href="javascript::void(0)" aria-expanded="false">Shipper Limit Approvers</a></li>
        </ul>

        <!-- Form and Table Sections -->
        <div class="row m-3">
            <!-- Form Section -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h2>Create Shipper Limit Approver</h2>
                        <form action="{{ route('approversubmit') }}" method="post">
                            @csrf
                            <div class="mb-3 mt-4">
                                <label for="inputapprovername" class="form-label">Shipper Limit Approver Name</label>
                                <input type="text" name="inputapprovername" id="inputapprovername" class="form-control" aria-describedby="passwordHelpInline">
                            </div>

                            <div class="mb-3">
                                <label for="inputapproveremail" class="form-label">Shipper Limit Approver Email</label>
                                <input type="text" name="inputapproveremail" id="inputapproveremail" class="form-control" aria-describedby="passwordHelpInline">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary" id="approversubmitform" value="1">Add Approver</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Table Section -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body table-responsive loads">
                        <div class="row date-filter">
                            <div class="col-md-12">
                                <h4 class="text text-primary">Search By Date:</h4>
                            </div>
                            <div class="col-md-6">
                                <label>From Date:</label>
                                <input type="text" id="min" name="min" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label>To Date:</label>
                                <input type="text" id="max" name="max" class="form-control">
                            </div>
                        </div>

                        <table class="table mb-0" id="carrier_table">
                            <thead class="table-light">
                                <tr>
                                    <th>No</th>
                                    <th>Approver Name</th>
                                    <th>Approver Email</th>
                                </tr>
                            </thead>

                            <tbody id="shipper_filter">
                                <?php $counter = 1; ?>
                                @foreach ($data1 as $item)
                                    <tr>
                                        <td>{{$counter++}}</td>
                                        <td class="copy-text">{{ $item->name }}</td>
                                        <td class="copy-text">{{ $item->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Include footer -->
        @include('backend.common.footer')
    </div>
</div>
@endsection


<script>

let newVal = document.getElementbyID('inputapproveremail').val()
console.log(newval);

function checknewVal(){
    let valDefined = document.getElementbyID('inputapprovername').innerHTML = "The Limit is changed to ${newval}"
}

checknewVal();

function cutslices(fruit){
    return fruit*3;
}

function totalcount(a,b){
    const c = cutslices(a)
    const d = cutslices(b)

    return console.log(c,d)
}

</script>
