@extends('backend.layouts.master')
@section('title','Search & intellivite')
@section('content')
	<!--start page wrapper -->
    <div class="page-wrapper">
		<div class="page-content">
			
			<!--end breadcrumb-->
			@if ($message = Session::get('success'))
			<div class="alert alert-success">
			    <p>{{ $message }}</p>
			</div>
			@endif
			@if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <ul class="nav nav-tabs">
                @can('carrier-all')
                <li> <a href="{{url('admin/carrier/list')}}">All Carriers</a></li>
                @endcan
                <li class=""><a href="{{url('/admin/carrier')}}" data-toggle="tab" aria-expanded="true">Carrier</a>
                </li>
    
                <li class="active"><a href="{{url('/admin/new/carrier/detail')}}" data-toggle="tab" aria-expanded="false">Create Carrier</a>
                    </li>
                    <li class=""><a href="{{url('/admin/carrier/myCarrierPacket')}}" data-toggle="tab" aria-expanded="false">MyCarrierPacket</a>
                </li>
            </ul>
            <div class="card">
				<div class="card-body searchintellivite">
				    <div class="row intellivite-search">
                        <div class="col-md-5">
                            <form action="{{url('/admin/carrier/NewCarrierAdd')}}" method="post">
                                <h5>Enter a DOT Number <span class="text text-danger required">*</span></h5>
                                <div class="form-group">
                                    <input class="form-control" id="DotNumber" name="DotNumber" placeholder="DOT Number" type="text" value="" required>
                                    <span id="DotNumberError" class="error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
                        </div>
                        <div class="col-md-2 search-or">
                            <span>OR</span>
                        </div>
                        <div class="col-md-5">
                            <form action="{{url('/admin/carrier/NewCarrierAdd')}}" method="post">
                                <h5>Enter a Docket Number <span class="text text-danger required">*</span></h5>
                                <div class="form-group">
                                        <input class="form-control" id="DocketNumber" name="DocketNumber" placeholder="Docket Number" type="text" value="" required>
                                        <span id="DocketNumberError" class="error"></span>
                                </div>
                                <button type="submit" class="btn btn-primary">Search</button>
                            </form>
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
        $('#DotNumber').on('input', function(e) {
          $(this).val(function(i, v) {
            return v.replace(/[^\d]/gi, '');
          });
        });


    }); 
</script>

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