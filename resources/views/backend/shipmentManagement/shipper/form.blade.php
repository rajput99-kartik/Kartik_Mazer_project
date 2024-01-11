<style>
    div#shiper-tab ul {
    border: none;
    background-color: #edf3f6;
    padding: 0px;
    display: block;
    width: fit-content;
    margin: auto;
    border-radius: 5px;
    overflow: hidden;
}
div#shiper-tab li {
    display: inline-block;
}
div#shiper-tab ul a {
    margin: 0px !important;
    border: none;
    border-radius: 0px !important;
    padding: 12px 30px;
    display: block;
    font-size: 15px;
    font-weight: 500;
}
div#shiper-tab {
    padding: 20px 50px;
}
.tab-pane {
    box-shadow: 0px 0px 15px -10px;
    margin-top: 30px;
    padding: 30px;
    border-radius: 4px;
    border-top: solid 1px #1e55bf;
}
form#Shipper button {
    border-radius: 3px;
    padding: 14px 20px;
    margin: 20px 0px 0px 30px;
}
form#Shipper label {
    display: block;
}
div#shiper-tab input, div#shiper-tab select, div#shiper-tab textarea {
    width: 100%;
    outline: none;
    padding: 8px;
    border: solid 1px #0000002b;
}
div#shiper-tab input:focus, div#shiper-tab select:focus, div#shiper-tab textarea:focus {
    border-color: #1e55bf;
}
.tab-pane {
    padding: 40px;
}

.nav-link {
  height: fit-content !important;
}
</style>
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

            <div id="shiper-tab">
    		   <ul class="nav nav-tabs">
                  <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#home">Company Details</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu1">Shipping Manager Details</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu2">Billing Details</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu3">Payment Details</a>
                  </li>
                  
                  <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#menu4">Commodities</a>
                  </li>
                </ul>
                
                <!-- Tab panes -->
                <form action="{{ $action }}" method="post" id="{{ $form_id }}" enctype="multipart/form-data">
                    <div class="tab-content">
                        
                        <div class="tab-pane container active" id="home">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4">
  
                                      <div class="form-group">
                                          <label>Company Name <span class="text text-danger required">*</span></label>
                                          <input required type="text" class="form-control" id="company_name" placeholder="Company Name" name="company_name" value="{{ isset($shipper_details['company_name'])? $shipper_details['company_name']: old('company_name') }}" {{ $readonly }}>
                                      </div>
          
                                  </div>
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
          
                                      <div class="form-group">
                                          <label>Business Name <span class="text text-danger required">*</span></label>
                                          <input required type="text" class="form-control" id="business_name" placeholder="Business Name" name="business_name" value="{{ isset($shipper_details['business_name'])? $shipper_details['business_name']: old('business_name') }}" {{ $readonly }}>
                                          
                                      </div>
          
                                  </div>
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
          
                                      <div class="form-group">
                                          <label>Type of Business <span class="text text-danger required">*</span></label>
                                          <input required type="text" class="form-control" id="business_type_info" placeholder="Type of Business" name="business_type_info" value="{{ isset($shipper_details['business_type_info'])? $shipper_details['business_type_info']: old('business_type_info') }}" {{ $readonly }}>
                                      </div>
          
                                  </div>
          
                                                      
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
          
                                      <div class="form-group">
                                          <label>Address <span class="text text-danger required">*</span></label>
                                          <input required type="text" class="form-control"  id="address" placeholder="Address" name="address" value="{{isset($shipper_details['address']) ? $shipper_details['address']: old('address')}}"  {{ $readonly }}>
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
                                          <label>State <span class="text text-danger required">*</span></label>
                                          <input required type="text" class="form-control" id="shipper_state" placeholder="State" name="state" value="{{ isset($shipper_details['shipper_state'])? $shipper_details['shipper_state']: old('shipper_state') }}" {{ $readonly }}>
                                      </div>
          
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
          
                                      <div class="form-group">
                                          <label>Country <span class="text text-danger required">*</span></label>
                                          <input required type="text" class="form-control" id="shipper_country" placeholder="State" name="shipper_country" value="{{ isset($shipper_details['shipper_country'])? $shipper_details['shipper_country']: old('shipper_country') }}" {{ $readonly }}>
                                      </div>
          
                                  </div>
                                  
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Zipcode <span class="text text-danger required">*</span></label>
                                          <input required type="text" class="form-control" id="shipper_zipcode" placeholder="Zipcode" name="zipcode" value="{{ isset($shipper_details['shipper_zipcode'])? $shipper_details['shipper_zipcode']: old('shipper_zipcode') }}" {{ $readonly }}>
                                      </div>
          
                                  </div>
          
                                  
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Contact Name <span class="text text-danger required">*</span></label>
                                          <input required type="text" class="form-control" id="contact_name" placeholder="Contact Name" name="contact_name" value="{{ isset($shipper_details['contact_name'])? $shipper_details['contact_name']: old('contact_name') }}" >
                                      </div>
                                  </div>
          
                                  
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Email <span class="text text-danger required">*</span></label>
                                          <input required type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{ isset($shipper_details['email'])? $shipper_details['email']: old('email') }}" >
                                      </div>
                                  </div>
          
                                  
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Phone <span class="text text-danger required">*</span></label>
                                          <input required type="text" class="form-control" id="phone_number" placeholder="Phone" name="phone" value="{{ isset($shipper_details['phone_number'])? $shipper_details['phone_number']: old('phone_number') }}" >
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
                                          <label>Fax</label>
                                          <input type="text" class="form-control" placeholder="fax" name="fax" value="{{ isset($shipper_details['fax'])? $shipper_details['fax']: old('fax') }}">
                                      </div>
                                  </div>
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Website</label>
                                          <input type="text" class="form-control" placeholder="website" name="website" value="{{ isset($shipper_details['website'])? $shipper_details['website']: old('website') }}">
                                      </div>
                                  </div>
          
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Type of Business</label>
                                          <input type="text" class="form-control" placeholder="Business Type" name="business_type" value="{{ isset($shipper_details['business_type'])? $shipper_details['business_type']: old('business_type') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Years In_Business</label>
                                          <input type="text" class="form-control" placeholder="year in business" name="years_in_business" value="{{ isset($shipper_details['years_in_business'])? $shipper_details['years_in_business']: old('years_in_business') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Location</label>
                                          <input type="text" class="form-control" placeholder="location" name="location" value="{{ isset($shipper_details['location'])? $shipper_details['location']: old('location') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Incorporation State</label>
                                          <input type="text" class="form-control" placeholder="incorporation state" name="incorporation_state" value="{{ isset($shipper_details['incorporation_state'])? $shipper_details['incorporation_state']: old('incorporation_state') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Fed Tax Id</label>
                                          <input type="text" class="form-control" placeholder="fed tax id" name="fed_tax_id" value="{{ isset($shipper_details['fed_tax_id'])? $shipper_details['fed_tax_id']: old('fed_tax_id') }}">
                                      </div>
                                  </div>
                                  
          
                                  {{-- <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Commodity</label>
                                          <input type="text" class="form-control" placeholder="Commodity" name="commodity" value="{{ isset($shipper_details['commodity'])? $shipper_details['commodity']: old('commodity') }}">
                                      </div>
                                  </div> --}}
          
                                  {{-- <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Special Instructions</label>
                                          <input type="text" class="form-control" placeholder="Special Instructions" name="special_instructions" value="{{ isset($shipper_details['special_instructions'])? $shipper_details['special_instructions']: old('special_instructions') }}" >
                                      </div>
                                  </div> --}}
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu1">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>First Name</label>
                                          <input type="text" class="form-control" placeholder="Shipper firstname" name="ship_firstname" value="{{ isset($shipper_details['ship_firstname'])? $shipper_details['ship_firstname']: old('ship_firstname') }}">
                                      </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Last Name</label>
                                          <input type="text" class="form-control" placeholder="Shipper lastname" name="ship_lastname" value="{{ isset($shipper_details['ship_lastname'])? $shipper_details['ship_lastname']: old('ship_lastname') }}">
                                      </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Ship Phone</label>
                                          <input type="text" class="form-control" placeholder="Shipper phone" name="ship_phone" value="{{ isset($shipper_details['ship_phone'])? $shipper_details['ship_phone']: old('ship_phone') }}">
                                      </div>
                                  </div>
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Ship Email</label>
                                          <input type="text" class="form-control" placeholder="Shipper email" name="ship_email" value="{{ isset($shipper_details['ship_email'])? $shipper_details['ship_email']: old('ship_email') }}">
                                      </div>
                                  </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu2">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Company Name</label>
                                          <input type="text" class="form-control" placeholder="billing company name" name="bill_company_name" value="{{ isset($shipper_details['bill_company_name'])? $shipper_details['bill_company_name']: old('bill_company_name') }}">
                                      </div>
                                  </div>
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>First Name</label>
                                          <input type="text" class="form-control" placeholder="billing firstname" name="bill_firstname" value="{{ isset($shipper_details['bill_firstname'])? $shipper_details['bill_firstname']: old('bill_firstname') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Last Name</label>
                                          <input type="text" class="form-control" placeholder="billing lastname" name="bill_lastname" value="{{ isset($shipper_details['bill_lastname'])? $shipper_details['bill_lastname']: old('bill_lastname') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Phone</label>
                                          <input type="text" class="form-control" placeholder="billing phone" name="bill_phone" value="{{ isset($shipper_details['bill_phone'])? $shipper_details['bill_phone']: old('bill_phone') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Email</label>
                                          <input type="text" class="form-control" placeholder="billing email" name="bill_email" value="{{ isset($shipper_details['bill_email'])? $shipper_details['bill_email']: old('bill_email') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Fax</label>
                                          <input type="text" class="form-control" placeholder="billing fax" name="bill_fax" value="{{ isset($shipper_details['bill_fax'])? $shipper_details['bill_fax']: old('bill_fax') }}">
                                      </div>
                                  </div><div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Secondary Mail</label>
                                          <input type="text" class="form-control" placeholder="billing email" name="billing_email" value="{{ isset($shipper_details['billing_email'])? $shipper_details['billing_email']: old('billing_email') }}">
                                      </div>
                                  </div>
          
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Address</label>
                                          <input type="text" class="form-control" placeholder="billing address" name="bill_address" value="{{ isset($shipper_details['bill_address'])? $shipper_details['bill_address']: old('bill_address') }}">
                                      </div>
                                  </div>
          
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>City</label>
                                          <input type="text" class="form-control" placeholder="billing city" name="bill_city" value="{{ isset($shipper_details['bill_city'])? $shipper_details['bill_city']: old('bill_city') }}">
                                      </div>
                                  </div>
          
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>State</label>
                                          <input type="text" class="form-control" placeholder="billing state" name="bill_state" value="{{ isset($shipper_details['bill_state'])? $shipper_details['bill_state']: old('bill_state') }}">
                                      </div>
                                  </div>
          
          
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Country</label>
                                          <input type="text" class="form-control" placeholder="billing country" name="bill_country" value="{{ isset($shipper_details['bill_country'])? $shipper_details['bill_country']: old('bill_country') }}">
                                      </div>
                                  </div>
          
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Zip Code</label>
                                          <input type="text" class="form-control" placeholder="billing zipcode" name="bill_zipcode" value="{{ isset($shipper_details['bill_zipcode'])? $shipper_details['bill_zipcode']: old('bill_zipcode') }}">
                                      </div>
                                  </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu3">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Prepaid:</label>
                                          <div class="col-md-12">
                                              <select class="form-control" name="shipper_prepaid">
                                                  <option value="1"  readonly <?php if(@$shipper_details['shipper_prepaid'] == '1'){ echo 'selected'; } ?> >Prepaid</option>
                                                  <option value="0" <?php if(@$shipper_details['shipper_prepaid'] == '0'){ echo 'selected'; } ?> readonly >Inactive</option>
                                              </select>
          
                                          </div>
                                      </div>
                                  </div>
          
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Payment Terms</label>
                                          <input type="text" class="form-control" placeholder="payment terms" name="payment_terms" value="{{ isset($shipper_details['payment_terms'])? $shipper_details['payment_terms']: old('payment_terms') }}">
                                      </div>
                                  </div>
          
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Payment Method</label>
                                          <input type="text" class="form-control" placeholder="payment method" name="payment_method" value="{{ isset($shipper_details['payment_method'])? $shipper_details['payment_method']: old('payment_method') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Invoice Method</label>
                                          <input type="text" class="form-control" placeholder="invoice method" name="invoice_method" value="{{ isset($shipper_details['invoice_method'])? $shipper_details['invoice_method']: old('invoice_method') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Credit Limit Req</label>
                                          <input type="text" class="form-control" placeholder="credit limit req" name="credit_limit_req" value="{{ isset($shipper_details['credit_limit_req'])? $shipper_details['credit_limit_req']: old('credit_limit_req') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Payment Document</label>
                                          <input type="text" class="form-control" placeholder="payment document" name="payment_document" value="{{ isset($shipper_details['payment_document'])? $shipper_details['payment_document']: old('payment_document') }}">
                                      </div>
                                  </div>
                            </div>
                        </div>
                        <div class="tab-pane container fade" id="menu4">
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Instructions</label>
                                          <textarea name="instructions" id="instructions" cols="30" rows="10">
                                              {{ isset($shipper_details['instructions'])? $shipper_details['instructions']: old('instructions') }}
                                          </textarea>
                                      </div>
                                  </div>
                                  
                                  <div class="col-xs-12 col-sm-12 col-md-8">
                                      <div class="row">
                                          
                                          <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Equipment Type</label>
                                          <input type="text" class="form-control" placeholder="equipment type" name="equipment_type" value="{{ isset($shipper_details['equipment_type'])? $shipper_details['equipment_type']: old('equipment_type') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Mode Type</label>
                                          <input type="text" class="form-control" placeholder="equipment mode" name="equipment_mode" value="{{ isset($shipper_details['equipment_mode'])? $shipper_details['equipment_mode']: old('equipment_mode') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Commodities</label>
                                          <input type="text" class="form-control" placeholder="commodities" name="commodities" value="{{ isset($shipper_details['commodities'])? $shipper_details['commodities']: old('commodities') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Type of Commodities</label>
                                          <input type="text" class="form-control" placeholder="commodities type" name="commodities_type" value="{{ isset($shipper_details['commodities_type'])? $shipper_details['commodities_type']: old('commodities_type') }}">
                                      </div>
                                  </div>
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Packaging Type </label>
                                          <input type="text" class="form-control" placeholder="co packagetype" name="co_package_type" value="{{ isset($shipper_details['co_package_type'])? $shipper_details['co_package_type']: old('co_package_type') }}">
                                      </div>
                                  </div>
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Dimensions </label>
                                          <input type="text" class="form-control" placeholder="dimensions" name="dimensions" value="{{ isset($shipper_details['dimensions'])? $shipper_details['dimensions']: old('dimensions') }}">
                                      </div>
                                  </div>
          
          
          
                                  <div class="col-xs-12 col-sm-12 col-md-4">
                                      <div class="form-group">
                                          <label>Save As<span class="text text-danger required">*</span></label>
                                          <select class="form-control" name="consignee" required>
                                             <option value="">Save As</option>
                                             <option <?php if(isset($shipper_details['consignee']) == 'consignee'){ echo 'selected';} ?> value="consignee">Consignee</option>
                                             <option <?php if(isset($shipper_details['consignee']) == 'consignor'){ echo 'selected';} ?> value="consignor">Consignor</option>
                                          </select>
                                      </div>
                                  </div>
                                      </div>
                                  </div>
          
          
          
                                  
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

		<!-- End card-->

<!-- start new here  ****************************************-->

</div>

</div>

<!--end page wrapper -->   



@include('backend.common.footer')

@endsection