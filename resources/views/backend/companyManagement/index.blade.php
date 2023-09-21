@extends('backend.layouts.master')

@section('title','Shipper Management')

@section('content')



		<!--start page wrapper -->

		<div class="page-wrapper">

			<div class="page-content">

				<!--breadcrumb-->

				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

					<div class="breadcrumb-title pe-3">Shipper</div>
					<div class="ps-3">

						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Shipper Page</li>
							</ol>
						</nav>

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

						<div class="d-lg-flex align-items-center mb-4 gap-3">

							<div class="position-relative">

								<input type="text" class="form-control ps-5 radius-30" placeholder="Search Shipper"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>

							</div>

						  <div class="ms-auto"><a href="{{url('admin/create-shipper')}}"><button class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New Shipper</button></a></div>
						  
						  <!--div class="ms-auto"><a href="#" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New Shipper</a></div -->

						</div>

						<div class="table-responsive">

							<table class="table mb-0">

								<thead class="table-light">

									<tr>

                                    <th>No</th>
                                    <th>Company</th>
                                    <th>Address</th>
                                    <th>State</th>
                                    <th>Zip</th>
									<th>Status</th>
									<th>Action</th>

									</tr>

								</thead>

								<tbody>


								@php
								$i = 0;
								@endphp
                               
							   @foreach($companies_data as $key => $companies_res)

                                    <tr>
									
										<td>{{ ++$i }}</td>
										
                                        <td>{{ $companies_res->company_name }}</td>
                                        <td>{{ $companies_res->address }}</td>
                                        <td>{{ $companies_res->shipper_state }}</td>
                                        <td>{{ $companies_res->shipper_zipcode }}</td>
										

                                        <td>
										
                                            <div class="badge rounded-pill text-success bg-light-info p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>   </div>

                                          <?php // endif ?>

                                        </td>



                                        <td>
											<a href="javascript:void()"> 

                                            <button type="button" value="{{ $companies_res->companies_id }}" class="btn btn-outline-info btn-sm radius-30 px-4">View</button></a> |
											
											<a href="{{ route('users.edit',$user->id) }}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> Edit </a> 

										</td>

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






<!-- Edit Shipper form modal Start -->
<div class="modal" id="edit_shipper_form_model">
</div>
<!-- Edit Shipper form modal end here -->

        

@include('backend.common.footer')

@endsection

