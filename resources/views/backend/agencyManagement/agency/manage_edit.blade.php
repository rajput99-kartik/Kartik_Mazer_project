@extends('backend.layouts.master')

@section('title','Agency Management')

@section('content')





        <div class="page-wrapper">

			<div class="page-content">

			    @if (count($errors) > 0)

                <div class="alert alert-danger">

                    <strong>Whoops!</strong> There were some problems with your input.<br><br>

                    <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                    </ul>

                </div>

                @endif

                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">

					<div class="breadcrumb-title pe-3">AMB</div>

					<div class="ps-3">

						<nav aria-label="breadcrumb">

							<ol class="breadcrumb mb-0 p-0">

								<li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>

								</li>

								<li class="breadcrumb-item active" aria-current="page">Agency Managements</li>

							</ol>

						</nav>

					</div>

					<div class="ms-auto">

						<div class="btn-group">

                            <a class="btn btn-primary" href="{{ url('admin/agency') }}"> Back</a>

						</div>

					</div>

				</div>



                <div class="row">

					<div class="col-xl-8 mx-auto">

						<h6 class="mb-0 text-uppercase"></h6>

						<hr/>

						<div class="card border-top border-0 border-4 border-primary">

							<div class="card-body p-3 ">

								<div class="card-title d-flex align-items-center pb-2">

									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>

									</div>

									<h5 class="mb-0 text-primary ">Add Agency</h5>

								</div>

								<!-- <hr> -->

								<div class="row g-3">

                                {!! Form::open(array('url' => 'admin/agency/manage_submit','method'=>'POST')) !!}

                                <div class="row">

                                    <div class="col-xs-12 col-sm-12 col-md-12">

                                        <div class="form-group">
                                            <strong>Agency Name:</strong>
											<select class="form-control" name="agencies">
												<option value="">Select</option>
												@foreach($agencies as $agencie)
													<option value="<?php echo $agencie->id; ?>"><?php echo $agencie->agencies_name; ?></option>
												@endforeach
											</select>
                                            
                                        </div>

                                    </div>



                                    <div class="col-xs-12 col-sm-12 col-md-12">

                                        <div class="form-group">
                                            <strong>User Name:</strong>
                                            <select class="form-control" name="user">
												<option value="">Select</option>
												@foreach($userRoles as $userRole)
													<option value="<?php echo $userRole->id; ?>"><?php echo $userRole->name; ?></option>
												@endforeach
											</select>
                                        </div>

                                    </div>

                                    <!--div class="col-xs-12 col-sm-12 col-md-12">

                                        <div class="form-group">
                                            <strong>Phone:</strong>
                                            {!! Form::text('phone', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
                                        </div>
                                    </div -->


                                    <div class="col-12 pt-4">
										<button type="submit" class="btn btn-primary ">Submit</button>
									</div>

                                </div>



                                {!! Form::close() !!}



								</div>

							</div>

						</div>

                    </div>

                </div>

            </div>

        </div>





@include('backend.common.footer')

@endsection

