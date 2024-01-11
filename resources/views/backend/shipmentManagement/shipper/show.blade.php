<?php 
    if(isset($shipper_details)){
        $title = 'Edit';
        $form_id = 'Shipper';
		$image_text = 'Update Image';
        $action  =  url('/admin/shipper/show/'.$shipper_id);
        $user_id = $shipper_id;

    }else{
        $title = 'Add';
        $form_id = 'Shipper';
		$image_text = 'Update Image';
        $action  =  url('/admin/shipper/add');
        $user_id = 0;
    }
?>

@extends('backend.layouts.master')
@section('title','Create Shipper')
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
                        <li class="breadcrumb-item active" aria-current="page">Create Shipper</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a class="btn btn-primary" href="{{ url('admin/shipper') }}"> Back</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

            @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
            @endif
			
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
			
		
		<div class="card col-xl-8 mx-auto">
		    <div class="card-header">
                <h3 class="card-title">Manage Shipper</h3>
                <!-- <h2 class="">Create Shipment</h2> -->
            </div>
			<div class="card-body">
                <form action="{{ $action }}" method="post" id="{{ $form_id }}" enctype="multipart/form-data" class="">
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Company Name" name="company_name" value="{{ isset($shipper_details['company_name'])? $shipper_details['company_name']: old('company_name') }}">
                                <input type="hidden" name="shipper_id" id="company_name" value="{{ $user_id }}">

                            </div>
                        </div>
                                            
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Address" name="address" value="{{ isset($shipper_details['address'])? $shipper_details['address']: old('address') }}">
                                <input type="hidden" name="shipper_id" id="address" value="{{ $user_id }}">
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="State" name="state" value="{{ isset($shipper_details['shipper_state'])? $shipper_details['shipper_state']: old('shipper_state') }}">
                                <input type="hidden" name="shipper_id" id="state" value="{{ $user_id }}">
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="City" name="city" value="{{ isset($shipper_details['shipper_city'])? $shipper_details['shipper_city']: old('shipper_city') }}">
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Zipcode" name="zipcode" value="{{ isset($shipper_details['shipper_zipcode'])? $shipper_details['shipper_zipcode']: old('shipper_zipcode') }}">
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Contact Name" name="contact_name" value="{{ isset($shipper_details['contact_name'])? $shipper_details['contact_name']: old('contact_name') }}">
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email" name="email" value="{{ isset($shipper_details['email'])? $shipper_details['email']: old('email') }}">
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Phone" name="phone" value="{{ isset($shipper_details['phone_number'])? $shipper_details['phone_number']: old('phone_number') }}">
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Commodity" name="commodity" value="{{ isset($shipper_details['commodity'])? $shipper_details['commodity']: old('commodity') }}">
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Equipments" name="equipments" value="{{ isset($shipper_details['equipments'])? $shipper_details['equipments']: old('equipments') }}">
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Temprature" name="temprature" value="{{ isset($shipper_details['temprature'])? $shipper_details['temprature']: old('temprature') }}">
                            </div>
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Special Instructions" name="special_instructions" value="{{ isset($shipper_details['special_instructions'])? $shipper_details['special_instructions']: old('special_instructions') }}">
                            </div>
                        </div>
                    </div>            		    
                    <!--<button type="submit" id="" class="btn btn-primary">Save Shipper</button>-->
                </form>
			</div>
		</div>
		<!-- End card-->
<!-- start new here  ****************************************-->
</div>
</div>
<!--end page wrapper -->   

@include('backend.common.footer')
@endsection