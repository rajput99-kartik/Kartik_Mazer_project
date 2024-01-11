@extends('backend.layouts.master')
@section('title','Search & intellivite')
@section('content')
	<!--start page wrapper -->
    <div class="page-wrapper">
		<div class="page-content">
			
			@if ($message = Session::get('success'))
			<div class="alert alert-success">
			    <p>{{ $message }}</p>
			</div>
			@endif
			@if ($message = Session::get('error'))
			<div class="alert alert-danger">
			    <p>{{ $message }}</p>
			</div>
			@endif
            
            <ul class="nav nav-tabs">
            @can('carrier-all')
            <li> <a href="{{url('admin/carrier/list')}}">All Carriers</a></li>
            @endcan
            
            @can('carrier-view')
            <li class="pending_approval"><a href="{{url('/admin/carrier')}}" data-toggle="tab" aria-expanded="true">Carrier</a>
            </li>
            @endcan
            
            @can('carrier-create')
            <li class="all_leave"><a href="{{url('/admin/new/carrier/detail')}}" data-toggle="tab" aria-expanded="false">Create Carrier</a>
                </li>
                @endcan
                <li class="active"><a href="{{url('/admin/carrier/myCarrierPacket')}}" data-toggle="tab" aria-expanded="false">MyCarrierPacket</a>
            </li>
            </ul>
            <div class="card">
				<div class="card-body searchintellivite">
				    <div class="row intellivite-search">
                        <div class="col-md-5">
                                <h5>Enter a DOT Number <span class="text text-danger required">*</span></h5>
                                <div class="form-group">
                                    <input class="form-control" id="DotNumber" name="DotNumber" placeholder="DOT Number" type="text" value="">
                                    <span id="DotNumberError" class="error"></span>
                                </div>
                                <button id="btnSearchDotNumber" class="btn btn-primary">Search</button>
                        </div>
                        <div class="col-md-2 search-or">
                            <span>OR</span>
                        </div>
                        <div class="col-md-5">
                                <h5>Enter a Docket Number <span class="text text-danger required">*</span></h5>
                                <div class="form-group">
                                        <input class="form-control" id="DocketNumber" name="DocketNumber" placeholder="Docket Number" type="text" value="">
                                        <span id="DocketNumberError" class="error"></span>
                                </div>
                                <button id="btnSearchDocketNumber" class="btn btn-primary">Search</button>
                        </div>
                    </div>
					
                    <div id="carrier-preview-section">
                    </div>
			</div>
		</div>

		</div>
	</div>
	
	
<!--end page wrapper -->

<!-- New carrier add form Modal start -->
<div class="modal" id="CarrierEmailInvite">
</div>
<!-- New carrier add form Modal end -->
<script>
    $(document).ready(function () { 
        $('#DocketNumber').on('input', function(e) {
          $(this).val(function(i, v) {
            return v.replace(/[^\d]/gi, '');
          });
        });


    }); 
</script>
@include('backend.common.footer')
@endsection