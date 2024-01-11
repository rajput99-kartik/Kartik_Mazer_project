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
		
		
		<div class="card">
		    <div class="card-header">
                <h3 class="card-title">Create New Shipper</h3>
                <!-- <h2 class="">Create Shipment</h2> -->
            </div>
			<div class="card-body">
				<form action="{{ url('shipper/add-new-shipper') }}" method="post" id="add_new_shipper" enctype="multipart/form-data" class="placeholder-form">
            		@csrf
            		<div class="row">
        				<div class="col-xs-12 col-sm-12 col-md-4">
        
        					<div class="form-group">
        						{!! Form::text('company_name', null, array('placeholder' => 'Company Name','class' => 'form-control')) !!}
        					</div>
        
        				</div>				
        				<div class="col-xs-12 col-sm-12 col-md-4">
        
        					<div class="form-group">
        						{!! Form::text('address', null, array('placeholder' => 'Address','class' => 'form-control')) !!}
        					</div>
        				</div>
        				
        				<div class="col-xs-12 col-sm-12 col-md-4">
        
        					<div class="form-group">
        						{!! Form::text('state', null, array('placeholder' => 'State','class' => 'form-control')) !!}
        					</div>
        
        				</div>
        				
        				<div class="col-xs-12 col-sm-12 col-md-4">
        
        					<div class="form-group">
        						{!! Form::text('city', null, array('placeholder' => 'City','class' => 'form-control')) !!}
        					</div>
        
        				</div>
        				
        				<div class="col-xs-12 col-sm-12 col-md-4">
        
        					<div class="form-group">
        						{!! Form::text('zipcode', null, array('placeholder' => 'Zipcode','class' => 'form-control')) !!}
        					</div>
        
        				</div>
        				
        				<div class="col-xs-12 col-sm-12 col-md-4">
        
        					<div class="form-group">
        						{!! Form::text('contact_name', null, array('placeholder' => 'Contact Name','class' => 'form-control')) !!}
        					</div>
        
        				</div>
        				
        				<div class="col-xs-12 col-sm-12 col-md-4">
        
        					<div class="form-group">
        						{!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
        					</div>
        
        				</div>
        				
        				<div class="col-xs-12 col-sm-12 col-md-4">
        
        					<div class="form-group">
        						{!! Form::number('phone', null, array('placeholder' => 'Phone','class' => 'form-control')) !!}
        					</div>
        
        				</div>
        				
        				<div class="col-xs-12 col-sm-12 col-md-4">
        
        					<div class="form-group">
        						{!! Form::text('commodity', null, array('placeholder' => 'Commodity','class' => 'form-control')) !!}
        					</div>
        
        				</div>
        				
        				<div class="col-xs-12 col-sm-12 col-md-4">
        
        					<div class="form-group">
        						{!! Form::text('equipments', null, array('placeholder' => 'Commodity','class' => 'form-control')) !!}
        					</div>
        
        				</div>
        				
        				<div class="col-xs-12 col-sm-12 col-md-4">
        
        					<div class="form-group">
        						{!! Form::text('temprature', null, array('placeholder' => 'Temprature','class' => 'form-control')) !!}
        					</div>
        
        				</div>
        				
        				<div class="col-xs-12 col-sm-12 col-md-4">
        
        					<div class="form-group">
        						{!! Form::text('special_instructions', null, array('placeholder' => 'Special Instructions','class' => 'form-control')) !!}
        					</div>
        
        				</div>
            		</div>
            		<button type="submit" id="" class="btn btn-primary">Save</button>
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