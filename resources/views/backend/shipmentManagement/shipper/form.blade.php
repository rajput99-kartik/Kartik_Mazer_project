<?php 

    if(isset($shipper_details)){



        //dd($shipper_details);

        $title = 'Edit';

        $form_id = 'Shipper';

		$image_text = 'Update Image';

        $action  =  url('/admin/shipper/edit/'.$shipper_id);

        $user_id = $shipper_id;
        $page= 'Edit Shipper';


    }elseif(isset($shipper_details)){

        $title = 'View';

        $form_id = 'Shipper';

		$image_text = 'Update Image';

        $action  =  url('/admin/shipper/view/'.$shipper_id);

        $user_id = $shipper_id;

        $readonly = "";
        $page= 'Create Shipper';

    }else{

        $readonly = "";

        $title = 'Add';

        $form_id = 'Shipper';

		$image_text = 'Update Image';

        $action  =  url('/admin/shipper/add');

        $user_id = 0;

        $shipper_id ='0';
        $page= 'Create Shipper';

    }



        $readonly = "";

        if (isset($shipper_details->approved) == 1) {

            $readonly = "readonly";

        }else {

            $readonly = "";

        }

?>





@extends('backend.layouts.master')

@section('title','Create Shipper')

@section('content')



<!--start page wrapper -->

<div class="page-wrapper">

    <div class="page-content">

        <!--breadcrumb-->

        <!--<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">-->

        <!--    <div class="breadcrumb-title pe-3">Shipper</div>-->

        <!--    <div class="ps-3">-->

        <!--        <nav aria-label="breadcrumb">-->

        <!--            <ol class="breadcrumb mb-0 p-0">-->

        <!--                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>-->

        <!--                </li>-->

        <!--                <li class="breadcrumb-item active" aria-current="page">Create Shipper</li>-->

        <!--            </ol>-->

        <!--        </nav>-->

        <!--    </div>-->

        <!--    <div class="ms-auto">-->

        <!--        <div class="btn-group">-->

        <!--            <a class="btn btn-primary" href="{{ url('admin/shipper') }}"> Back</a>-->

        <!--        </div>-->

        <!--    </div>-->

        <!--</div>-->

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

			

		<ul class="nav nav-tabs">

		    @can('shipper-all')

            <li class="pending_approval"><a href="{{url('/admin/shipper/list')}}" data-toggle="tab" aria-expanded="true">All Shipper</a>

            </li>

            @endcan
            @can('shipper-agentshipper')
                    <li class="pending_approval"><a href="{{url('/admin/shipper/manager/list')}}" data-toggle="tab" aria-expanded="true">Team Shipper</a></li>
                    @endcan
            <li class="all_leav"><a href="{{url('/admin/shipper')}}" data-toggle="tab" aria-expanded="false">Shipper</a>

                </li>

            <li class="active"><a href="{{url('/admin/shipper/add')}}" data-toggle="tab" aria-expanded="false">{{$page}}</a>

            </li>

            @can('shipper-request')

			<li class=""> <a href="{{url('admin/shipper/request')}}" data-toggle="tab" aria-expanded="false"> Shipper Request</a>

			</li>

			@endcan

        </ul>

		<div class="card col-xl-12 mx-auto" style="padding: 20px 0px;">

		   

			<div class="card-body">

			    <div class="card-body p-3 col-xl-9 mx-auto" style="padding: 40px 30px !important;margin: 20px 0px;">
					<div class="card-title d-flex align-items-center pb-2">
						<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
						</div>
						<h5 class="mb-0 text-primary ">{{$title}} Shipper</h5>
					</div>

                <form action="{{ $action }}" method="post" id="{{ $form_id }}" enctype="multipart/form-data">


                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-4">

                            <div class="form-group">
                                <label>Company Name <span class="text text-danger required">*</span></label>
                                <input required type="text" class="form-control" id="shipper_name" placeholder="Company Name" name="company_name" value="{{ isset($shipper_details['company_name'])? $shipper_details['company_name']: old('company_name') }}" {{ $readonly }}>
                                <input required type="hidden" name="shipper_id" id="company_name" value="{{$user_id}}" >
                            </div>

                        </div>

                                            

                        <div class="col-xs-12 col-sm-12 col-md-4">

                            <div class="form-group">
                                <label>Address <span class="text text-danger required">*</span></label>
                                <input required type="text" class="form-control"  id="shipper_address" placeholder="Address" name="address" value="{{isset($shipper_details['address']) ? $shipper_details['address']: old('address')}}"  {{ $readonly }}>
                                <input required type="hidden" name="shipper_id" id="address" value="{{ $user_id }}">
                            </div>

                        </div>

                        

                        <div class="col-xs-12 col-sm-12 col-md-4">

                            <div class="form-group">
                                <label>State <span class="text text-danger required">*</span></label>
                                <input required type="text" class="form-control" id="shipper_state" placeholder="State" name="state" value="{{ isset($shipper_details['shipper_state'])? $shipper_details['shipper_state']: old('shipper_state') }}" {{ $readonly }}>
                                <input required type="hidden" name="shipper_id" id="state" value="{{ $user_id }}">
                            </div>

                        </div>

                        

                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label>City <span class="text text-danger required">*</span></label>
                                <input required type="text" class="form-control" id="shipper_city" placeholder="City" name="city" value="{{ isset($shipper_details['shipper_city'])? $shipper_details['shipper_city']: old('shipper_city') }}" {{ $readonly }}>
                            </div>
                        </div>

                        

                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label>Zipcode <span class="text text-danger required">*</span></label>
                                <input required type="text" class="form-control" id="shipper_zip" placeholder="Zipcode" name="zipcode" value="{{ isset($shipper_details['shipper_zipcode'])? $shipper_details['shipper_zipcode']: old('shipper_zipcode') }}" {{ $readonly }}>
                            </div>

                        </div>

                        

                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label>Contact Name <span class="text text-danger required">*</span></label>
                                <input required type="text" class="form-control" id="shipper_persone" placeholder="Contact Name" name="contact_name" value="{{ isset($shipper_details['contact_name'])? $shipper_details['contact_name']: old('contact_name') }}" >
                            </div>
                        </div>

                        

                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label>Email <span class="text text-danger required">*</span></label>
                                <input required type="text" class="form-control" id="shipper_email" placeholder="Email" name="email" value="{{ isset($shipper_details['email'])? $shipper_details['email']: old('email') }}" >
                            </div>
                        </div>

                        

                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label>Phone <span class="text text-danger required">*</span></label>
                                <input required type="text" class="form-control" id="shipper_phone" placeholder="Phone" name="phone" value="{{ isset($shipper_details['phone_number'])? $shipper_details['phone_number']: old('phone_number') }}" >
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label>Currency Type<span class="text text-danger required">*</span></label>
                                <select class="form-control" name="currency_type" required>
                                   <option value="">Select Currency</option>
                                   <option <?php if(isset($shipper_details['currency_type']) == 'USD'){ echo 'selected';} ?> value="USD">USD</option>
                                   <option <?php if(isset($shipper_details['currency_type']) == 'CAD'){ echo 'selected';} ?> value="CAD">CAD</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label>Commodity</label>
                                <input type="text" class="form-control" placeholder="Commodity" name="commodity" value="{{ isset($shipper_details['commodity'])? $shipper_details['commodity']: old('commodity') }}">
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-4">
                            <div class="form-group">
                                <label>Special Instructions</label>
                                <input type="text" class="form-control" placeholder="Special Instructions" name="special_instructions" value="{{ isset($shipper_details['special_instructions'])? $shipper_details['special_instructions']: old('special_instructions') }}" >
                            </div>
                        </div>
                        

                    </div>            		    

                    

                        @if (Request::url('/admin/shipper/view/'.$shipper_id) === $action)

                        @csrf

                        <button type="submit" id="" class="btn btn-primary">Save Shipper</button>

                        @else

                        @endif

                </form>

                </div>

			</div>

		</div>

		<!-- End card-->

<!-- start new here  ****************************************-->

</div>

</div>

<!--end page wrapper -->   



@include('backend.common.footer')

@endsection