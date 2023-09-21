@extends('backend.layouts.master')
@section('title','AR Invoice Generate')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Ar Invoice Generate</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Invoice & Email</li>
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
						</div>
                                
                                <div class="row form-group">
                                    <label class="col-lg-12 control-label">Invoice</label>
                                    <div class="col-lg-12">
                                        <iframe src="{{ url('public/invoice_generate/'.$InvoiceName) }}" width="100%" height="450px"></iframe> 
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-12 control-label">To<span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="email_to" id="email_to" value="@foreach($shipments as $ship_data) {{ $ship_data->companyDetail['email'] }} @endforeach"> 
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-12 control-label">Subject<span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <input type="text" class="form-control" name="subject" id="subject"> 
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-lg-12 control-label">Email Body  <span class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <textarea class="invoice_email_body" name="email_body" id="email_body">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <input type="hidden" id="company_id" value="{{ $uid }}">
                                    <button type="button" class="btn btn-primary" id="EmailSubmitBtn" value="{{ $id }}">Sent Email</button>    
                                    </div>
                                </div>
                        
			        </div>
		        </div>

                


    <!--end page wrapper -->
    </div>
  </div>





  <script type="text/javascript">
        CKEDITOR.replaceAll( 'invoice_email_body' );
    </script>
@include('backend.common.footer')
@include('backend.common.notification') 
@endsection