@extends('backend.layouts.master')
@section('title','Office Management')
@section('content')
        <div class="page-wrapper">
			<div class="page-content">
			    
                <ul class="nav nav-tabs">
                    <li class="pending_approval"><a href="{{url('/admin/agency')}}" data-toggle="tab" aria-expanded="true">All Office</a>
                    </li>
                    <li class="all_leave active"><a href="{{url('/admin/agency/create')}}" data-toggle="tab" aria-expanded="false">Create New</a>
                        </li>
                </ul>
                
                <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <div class="card border-4 border-primary">
                            
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
                            
							<div class="card-body p-3 col-xl-9 mx-auto" style="padding: 40px 30px !important;">
								<div class="card-title d-flex align-items-center pb-2">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary ">Add Office</h5>
								</div>
								<!-- <hr> -->
								<div class="row g-3">
                                {!! Form::open(array('url' => 'admin/agency/add','method'=>'POST')) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Office Name: <span class="text text-danger required">*</span></strong>
                                            {!! Form::text('office', null, array('placeholder' => 'Office','class' => 'form-control', 'min' => '2', 'max' => '40', 'required')) !!}
                                        </div>
                                    </div>
									<div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Contact Name: <span class="text text-danger required">*</span></strong>
                                            {!! Form::text('name', null, array('placeholder' => 'Contact Name','class' => 'form-control',  'max' => '11', 'required')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Email: <span class="text text-danger required">*</span></strong>
                                            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control', 'min' => '2','max' => '40', 'required')) !!}
                                        </div>
                                    </div>
									<div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Office Email: <span class="text text-danger required">*</span></strong>
                                            {!! Form::text('p_email', null, array('placeholder' => 'Email','class' => 'form-control', 'min' => '2', 'max' => '40', 'required')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Phone: <span class="text text-danger required">*</span></strong>
                                            {!! Form::text('phone', null, array('placeholder' => 'Phone','class' => 'form-control', 'min' => '10','max' => '11', 'required')) !!}
                                        </div>
                                    </div>
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

