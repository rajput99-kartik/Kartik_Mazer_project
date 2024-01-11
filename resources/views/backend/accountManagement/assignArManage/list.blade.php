@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Assign User</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Assign User Page</li>
							</ol>
						</nav>
					</div>

					<!--<div class="ms-auto">-->
					<!--	<div class="btn-group">-->
					<!--		<button type="button" class="btn btn-primary">Settings</button>-->
					<!--		<button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>-->
					<!--		</button>-->
					<!--		<div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>-->
					<!--			<a class="dropdown-item" href="javascript:;">Another action</a>-->
					<!--			<a class="dropdown-item" href="javascript:;">Something else here</a>-->
					<!--			<div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>-->
					<!--		</div>-->
					<!--	</div>-->
					<!--</div>-->
				</div>
				<!--end breadcrumb-->
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif

				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
							{{-- <div class="position-relative">
								<input type="text" class="form-control ps-5 radius-30" placeholder="Search Shipper"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
							</div> --}}

						  {{-- <div class="ms-auto"><a href="{{url('admin/assignuser/add')}}"><button class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i>User</button></a></div> --}}
						  <!--div class="ms-auto"><a href="#" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New Shipper</a></div -->
						</div>

						<div class="table-responsive3">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>No</th>
                                        <th>User Id</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Assign To</th>
                                        <th>Assign By</th>                                       
									</tr>
								</thead>
								<tbody>
								@php
								$i = 0;
								@endphp
                                @foreach($userdata as $udata)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $udata->officerid }}</td>
                                            <td>{{ $udata->name }}</td>
                                            <td>{{ $udata->email }}</td>
                                            <td>
												@php
													$assignto_id = App\Models\User::where('id', $udata->assignto_id)->get('name');

													$assignby_id = App\Models\User::where('id', $udata->assign_id)->get('name');
												@endphp

												@foreach($assignto_id as $bought)
												{{ isset($bought['name']) ? $bought['name'] : Null }}
												@endforeach
											
											</td>
                                            <td>
												@foreach($assignby_id as $bought)
													{{ isset($bought['name']) ? $bought['name'] : Null }}
												@endforeach
											</td>
                                            {{-- <td>
                                                <div class="badge rounded-pill text-success bg-light-info p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i></div>
                                            </td> --}}
                                        </tr>
                                @endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
    </div>
  </div>
</div>



@include('backend.common.footer')

@include('backend.common.notification') 

	
@endsection

