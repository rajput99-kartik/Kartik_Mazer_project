@extends('backend.layouts.master')
@section('title','Search & intellivite')
@section('content')
	<!--start page wrapper -->
    <div class="page-wrapper">
		<div class="page-content">
			<!--breadcrumb-->
			<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
				<div class="breadcrumb-title pe-3">Carrier</div>
				<div class="ps-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 p-0">
							<li class="breadcrumb-item"><a href="javascript:void(0);"><i class="bx bx-home-alt"></i></a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Search & intellivite</li>
						</ol>
					</nav>
				</div>

				<!--<div class="ms-auto">-->
				<!--	<div class="btn-group">-->
				<!--		<a type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#TodayLanesLoads">-->
    <!--                      Create New Loads-->
    <!--                    </a>-->
				<!--	</div>-->
				<!--</div>-->
			</div>

			<!--end breadcrumb-->
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
			
			<div class="card">
				<div class="card-body table-responsive">
				    <div class="row intellivite-search">
                        <div class="col-md-6">
                            <form novalidate="novalidate">
                                <h5>Enter a DOT Number</h5>
                                <div class="form-group">
                                    <label class="sr-only" for="DotNumber">Dot Number</label>
                                    <input class="form-control text-box single-line" data-val="true" data-val-required="Dot Number is required" id="DotNumber" name="DotNumber" placeholder="DOT Number" type="text" value="" aria-required="true" aria-invalid="false" aria-describedby="DotNumber-error">
                                    <span class="text-danger field-validation-valid" data-valmsg-for="DotNumber" data-valmsg-replace="true"></span>
                                </div>
                                <button id="btnSearchDotNumber" class="btn btn-primary">Search</button>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <form novalidate="novalidate">
                                <h5>Enter a Docket Number</h5>
                                <div class="form-group">
                                    <label class="sr-only" for="DocketNumber">Docket Number</label>
                                        <input class="form-control text-box single-line" data-val="true" data-val-required="Docket Number is required" id="DocketNumber" name="DocketNumber" placeholder="Docket Number" type="text" value="">
                                </div>
                                <button id="btnSearchDocketNumber" class="btn btn-primary">Search</button>
                            </form>
                        </div>
                    </div>
					<table class="table mb-0" id="intellivite-search">
    					<thead class="table-light">
    					  <tr>
    						 <th>Carrier</th>
    						 <th>Risk Assessment</th>
    						 <th>Packet Status</th>
    						 <th>Certificate of Insurance</th>
    						 <th>Fraud/Identity Theft</th>
    					  </tr>
    					</thead>
    					<tr>
                            <td>
                                <div class="carrier-card">
                                    <div>
                                        TriumphPay
                                    </div>
                                    <div>
                                        Dallas, NY 75231 US
                                    </div>
                                    <div>
                                        <strong>
                                            DOT Number:
                                        </strong>
                                        123
                                    </div>
                                    <div>
                                        <strong>
                                            Docket Number:
                                        </strong>
                                        MC123123
                                    </div>
                                </div>
                                <div class="block-option mb-2">
                                        <button class="btn btn-success btn-sm act-block-carrier" data-carr-name="TriumphPay" data-dot-number="123" data-docket-number="MC123123"><span class="fas fa-ban"></span> Block Carrier</button>
                                </div>
                                <a href="{{url('admin/carrier-profile')}}" class="btn btn-primary btn-sm">Carrier Profile</a>
        
                                <div class="mt-2" style="max-width: 500px;">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#divCarrierNotesModal_0" data-dot-number="123" data-docket-number="MC123123">
                                        <span>Notes</span>
                                        <span id="notesCount_0" class="badge">0</span>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#divAddCarrierNoteModal_0" data-dot-number="123" data-docket-number="MC123123">Add Note</button>
                                    <p id="latestNote_0" class="mt-1 mb-0" style="white-space: pre-wrap"></p>
                                </div>
                            </td>
                            <td>
                                <div class="mb-3">
                                    
                                    <div class="d-inline-block">
                                        <div class="h4 mb-0 text-nowrap">
        
                                            <span class="text-danger text-nowrap">Unacceptable</span>
                                                <span class="text-danger">(unable to invite)</span>
                                        </div>
                                            <div class="h5 mb-0 d-inline-block">
                                                <span class="text-danger">and missing auto and/or cargo</span>
                                            </div>
                                            <a tabindex="0" role="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-html="true" title="" data-content="<p>Once we obtain and process a certificate, the carrier's risk assessment will be reevaluated using your certificate rules.</p>" data-original-title="Excluding Cert Data"><i class="fas fa-question-circle"></i></a>
                                        <div>
        
                                            <span class="font-weight-bold">4 infractions. </span>
                                            <span class="font-weight-bold">Click <strong><a href="#" data-toggle="modal" data-target="#divRiskAssessmentDetails_0" style="text-decoration: underline">here</a></strong> to review.</span>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="mt-3">
                                    <div class="font-weight-bold">
                                        <span>Report: </span><span style="color: red;">NOACCOUNT</span>
                                        <a tabindex="0" role="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-html="true" title="" data-content="<p>Integration with Watchdog is only available to current TIA Members. Contact TIA at <a href='mailto:Membership@tianet.org'>Membership@tianet.org</a> for more information about the benefits of TIA membership. Their staff can assist you with the application process and help you navigate TIA resources like model contracts, industry-leading education, legislative advocacy and support, and Watchdog Integration provided through MyCarrierPackets.com.</p><p>Contact TIA Membership at <a href='mailto:Membership@tianet.org'>Membership@tianet.org</a> for your integration key (ServiceLogin) available free to TIA Members.</p>" data-original-title="TIA Watchdog"><i class="fas fa-question-circle"></i></a>
                                    </div>
                                </div>
                            </td>
                            <td>
            <a href="#">Not Invited</a>
                            </td>
                            <td style="min-width: 170px;">
                                    Not Available
                            </td>
                            <td>
                                No Reports
                            </td>
                        </tr>
					</table>
			</div>
		</div>

		</div>
	</div>
	
	<!--loads edit model start-->
	<div class="modal" id="LoadUpdateForm">
	</div>
	<!--loads edit model end-->
<!--end page wrapper -->

@include('backend.common.footer')
@endsection
