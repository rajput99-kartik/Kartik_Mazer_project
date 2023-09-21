@extends('backend.layouts.master')
@section('title','Shipment Management')
@section('content')
	<!--start page wrapper -->
    <div class="page-wrapper">
		<div class="page-content">
			<!--breadcrumb-->
			<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
				<div class="breadcrumb-title pe-3">Shipment</div>
				<div class="ps-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 p-0">
							<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Shipment Management</li>
						</ol>
					</nav>
				</div>
				<div class="ms-auto">
					<div class="btn-group">
						<!-- @can('shipment-create') -->
						<a class="btn btn-primary" href="{{ url('admin/create-shipment') }}"> Create New Shipment</a>
						<!-- @endcan -->
					</div>
				</div>
			</div>
			<!--end breadcrumb-->
			@if ($message = Session::get('success'))
			<div class="alert alert-success">
			    <p>{{ $message }}</p>
			</div>
			@endif

			<div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">
                                    <div class="dataTables_length" id="example_length">
                                        <label>Show 
                                            <select name="example_length" aria-controls="example" class="form-select form-select-sm">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select> entries</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="example_filter" class="dataTables_filter">
                                            <label>Search:
                                                <input type="search" class="form-control form-control-sm" placeholder="" aria-controls="example">
                                            </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example" class="table table-striped table-bordered dataTable" style="width: 100%;" role="grid" aria-describedby="example_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 164px;">Name</th>
                                                        <th>Load#</th>
                                                        <th>Shipper Name</th>
                                                        <th>Carrier Name</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>		
                                                    @foreach($shipment as $shipmentDate)
                                                    <tr>
                                                        <td><?php echo $shipmentDate->shipment_id; ?></td>
                                                        <td><?php echo $shipmentDate->customer_name; ?></td>
                                                        <td><?php echo $shipmentDate->shipment_c_carrier; ?></td>
                                                        <td><?php echo $shipmentDate->shipment_statue; ?></td>
                                                        <td>
                                                            <a href="shipment/shipment-edit/<?php echo base64_encode($shipmentDate->shipment_id); ?>" target="_blank" class="btn btn-block btn-primary">View</a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 164px;">Name</th>
                                                        <th>Load#</th>
                                                        <th>Shipper Name</th>
                                                        <th>Carrier Name</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-5">
                                    <div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing 1 to 10 of 2 entries</div>
                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
                                        <ul class="pagination">
                                            <li class="paginate_button page-item previous disabled" id="example_previous">
                                                <a href="#" aria-controls="example" data-dt-idx="0" tabindex="0" class="page-link">Prev</a>
                                            </li>
                                            <li class="paginate_button page-item next" id="example_next"><a href="#" aria-controls="example" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
	<!--end page wrapper -->
                

@include('backend.common.footer')
@endsection
