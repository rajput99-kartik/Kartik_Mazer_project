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
							<li class="breadcrumb-item active" aria-current="page">Carrier Profile</li>
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
			@if ($message = Session::get('error'))
			<div class="alert alert-danger">
			    <p>{{ $message }}</p>
			</div>
			@endif
			
			<div class="card mb-4">
                <div class="card-body carrier-profile">
                    <div class="row">
                        <div class="col-12 col-md-4 col-xl-3 mb-4">
                            <h4 class="font-weight-bold text-large mb-1">
                                TriumphPay
                            </h4>
                            <h4 class="font-weight-normal text-large mb-3">
            
                                DOT123/MC123123
                            </h4>
                                <div class="block-option mb-2">
                                    <button class="btn btn-success btn-sm act-block-carrier"><span class="fas fa-ban"></span> Block Carrier</button>
                                </div>
                                <div class="monitoring-option mb-3">
                                    <button class="btn btn-success btn-sm act-monitor-carrier"><span class="far fa-eye"></span> Start Monitoring</button>
                                </div>
                                <div class="mb-3">
                                    <div class="d-inline-block">
                                        <div class="h4 mb-0">
            
                                            <span class="text-danger text-nowrap">Unacceptable</span>
                                                <span class="text-danger">(unable to invite)</span>
                                        </div>
                                            <div class="h5 mb-0 d-inline-block">
                                                <span class="text-danger">and missing auto and/or cargo</span>
                                            </div>
                                            <a tabindex="0" role="button" data-toggle="popover" data-placement="top" data-trigger="focus" data-html="true" title="" data-content="<p>Once we obtain and process a certificate, the carrier's risk assessment will be reevaluated using your certificate rules.</p>" data-original-title="Excluding Cert Data"><i class="fas fa-question-circle"></i></a>
                                        <div>
            
                                            <span class="font-weight-bold">4 infractions. </span>
                                            <span class="font-weight-bold">Click <a href="#" data-toggle="modal" data-target="#divRiskAssessmentDetails_0" style="text-decoration: underline">here</a> to review.</span>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="mt-3">Packet Status: Not Invited</h5>
                                <div class="mt-3">
                                    <div class="font-weight-bold">
                                        <span>Report: </span>
                                        <span style="color: red;">NOACCOUNT</span>
                                        <a tabindex="0" role="button" data-toggle="popover" data-placement="right" data-trigger="focus" data-html="true" title="" data-content="<p>Integration with Watchdog is only available to current TIA Members. Contact TIA at <a href='mailto:Membership@tianet.org'>Membership@tianet.org</a> for more information about the benefits of TIA membership. Their staff can assist you with the application process and help you navigate TIA resources like model contracts, industry-leading education, legislative advocacy and support, and Watchdog Integration provided through MyCarrierPackets.com.</p><p>Contact TIA Membership at <a href='mailto:Membership@tianet.org'>Membership@tianet.org</a> for your integration key (ServiceLogin) available free to TIA Members.</p>" data-original-title="TIA Watchdog"><i class="fas fa-question-circle"></i></a>
                                    </div>
                                </div>
            
            
                                <div class="mt-3">
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#divCarrierNotesModal_0" data-dot-number="123" data-docket-number="MC123123">
                                        <span>Notes</span>
                                        <span id="notesCount_0" class="badge">0</span>
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#divAddCarrierNoteModal_0" data-dot-number="123" data-docket-number="MC123123">Add Note</button>
                                    <p id="latestNote_0" class="mt-1 mb-0" style="white-space: pre-wrap"></p>
                                </div>
                        </div>
                            <div class="carrierRatingContainer col-12 col-md-4 col-xl-3 mb-4">
                                <h4>Carrier Rating</h4>
            
            
                                <div class="carrierRatingContainer">
                                    <div class="mb-2">Average Carrier Rating (ACR) will generate after the carrier has 2 ratings</div>
                            
                                </div>
                            </div>
                            <div class="carrierFraudIdentityTheftContainer col-12 col-md-4 col-xl-3 mb-4">
                                <h4>Fraud/Identity Theft</h4>
                                <div>
                                    <div>
                                        No Reports
                                    </div>
                                </div>
                            </div>
                        <div class="col-12 col-md-4 col-xl-3">
                            <div class="card border-secondary bg-light">
                                <div class="card-body">
                                    <div>
                                        <div><span class="font-weight-bold">FMCSA Links:</span></div>
                                        <div><a target="_blank" href="#">License and Insurance</a></div>
                                        <div><a target="_blank" href="#">Company Snapshot</a></div>
                                        <div><a target="_blank" href="#">Safety Measurement System</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <dl class="row mb-4">
                        <dt class="col-12 col-md-3">
                            Operating Status
                        </dt>
                        <dd class="col-12 col-md-3">
                            <span class="text-danger font-weight-bold"></span>
                        </dd>
                        <dt class="col-12 col-md-3">
                            Entity Type
                        </dt>
                        <dd class="col-12 col-md-3">
                            
                        </dd>
                        <dt class="col-12 col-md-3">
                            DOT Status
                        </dt>
                        <dd class="col-12 col-md-3">
                        </dd>
                        <dt class="col-12 col-md-3">
                            Active Since
                        </dt>
                        <dd class="col-12 col-md-3">
                            
                        </dd>
                        <dt class="col-12 col-md-3">
                            DOT Number
                        </dt>
                        <dd class="col-12 col-md-3">
                            123
                        </dd>
                        <dt class="col-12 col-md-3">
                            Docket Number
                        </dt>
                        <dd class="col-12 col-md-3">
                            MC123123
                        </dd>
                        <dt class="col-12 col-md-3">
                            Legal Name
                        </dt>
                        <dd class="col-12 col-md-3">
                            TriumphPay
                        </dd>
                        <dt class="col-12 col-md-3">
                            DBA Name
                        </dt>
                        <dd class="col-12 col-md-3">
                            
                        </dd>
                        <dt class="col-12 col-md-3">
                            SCAC (Standard Carrier Alpha Code)
                        </dt>
                        <dd class="col-12 col-md-3">
                            
                        </dd>
                        <dt class="col-12 col-md-3">
                            Contact
                        </dt>
                        <dd class="col-12 col-md-3">
                            
                        </dd>
                        <dt class="col-12 col-md-3">
                            Main Phone Number
                        </dt>
                        <dd class="col-12 col-md-3">
                            (580) 275-9034
                        </dd>
                        <dt class="col-12 col-md-3">
                            Cell Phone Number
                        </dt>
                        <dd class="col-12 col-md-3">
                            
                        </dd>
                        <dt class="col-12 col-md-3">
                            Emergency Number
                        </dt>
                        <dd class="col-12 col-md-3">
                            
                        </dd>
                        <dt class="col-12 col-md-3">
                            Fax Number
                        </dt>
                        <dd class="col-12 col-md-3">
                            
                        </dd>
                        <dt class="col-12 col-md-3">
                            Company Main Email
                        </dt>
                        <dd class="col-12 col-md-3">
                            jgraft@triumphpay.com
                        </dd>
                        <dt class="col-12 col-md-3">
                            Website
                        </dt>
                        <dd class="col-12 col-md-3">
                            
                        </dd>
                        <dt class="col-12 col-md-3">Address</dt>
                        <dd class="col-12 col-md-3">
                            Apartment 2C 88 Charles Street<br>
                            
                            Dallas, 
                            NY 
                            75231
                                <br>
                                <a class="font-italic" target="_blank" href="#">(View on map)</a>
                        </dd>
                        <dt class="col-12 col-md-3">Mailing Address</dt>
                        <dd class="col-12 col-md-3">
                            Apartment 2C 88 Charles Street<br>
                            
                            New York City, 
                            NY 
                            10014
                                <br>
                                <a class="font-italic" target="_blank" href="#">(View on map)</a>
                        </dd>
                    </dl>
                    
                    <div id="profile_accordion">
                      <div class="card">
                        <div class="card-header">
                          <a class="btn" data-bs-toggle="collapse" href="#Authority">
                            Authority
                            <i class="bx bx-plus"></i>
                          </a>
                        </div>
                        <div id="Authority" class="collapse show" data-bs-parent="#profile_accordion">
                          <div class="card-body">
                            <div class="card border-secondary mb-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 col-sm-6 col-md-4 mb-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Common Authority:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">None</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Common Authority Application Pending:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">No</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Common Authority Pending Revocation:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">No</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Contract Authority:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">None</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Contract Authority Application Pending:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">No</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Contract Authority Pending  Revocation:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">No</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Broker Authority:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">None</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Broker Authority Application Pending:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">No</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Broker Authority Pending  Revocation:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">No</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <div class="card border-secondary">
                                        <div class="card-body">
                                            <h5>Cargo Authorization</h5>
                                            <div>
                                                <span class="font-weight-bold">Freight:</span>&nbsp;
                                                <span class="text-danger font-weight-bold">No</span>
                                            </div>
                                            <div>
                                                <span class="font-weight-bold">Passenger:</span>&nbsp;
                                                <span class="text-danger font-weight-bold">No</span>
                                            </div>
                                            <div>
                                                <span class="font-weight-bold">Household Goods:</span>&nbsp;
                                                <span class="text-danger font-weight-bold">No</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <div class="card border-secondary">
                                        <div class="card-body">
                                            <div>
                                                <span class="font-weight-bold">Authority Granted On:</span><br>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div>
                        </div>
                      </div>
                    
                      <div class="card">
                        <div class="card-header">
                          <a class="collapsed btn" data-bs-toggle="collapse" href="#Insurance">
                            Insurance
                            <i class="bx bx-plus"></i>
                          </a>
                        </div>
                        <div id="Insurance" class="collapse" data-bs-parent="#profile_accordion">
                          <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                        <div id="divCarrierMCPInsurance">
        
        <input class="producer-id" data-val="true" data-val-number="The field ProducerID must be a number." id="ProducerID" name="ProducerID" type="hidden" value="">
        <input class="force-insurance-request" data-val="true" data-val-required="The ForceInsuranceRequest field is required." id="ForceInsuranceRequest" name="ForceInsuranceRequest" type="hidden" value="True">
        <input class="request-insurance" data-val="true" data-val-required="The RequestInsurance field is required." id="RequestInsurance" name="RequestInsurance" type="hidden" value="True">
        <input class="missing-insurance" data-val="true" data-val-required="The MissingInsurance field is required." id="MissingInsurance" name="MissingInsurance" type="hidden" value="True">
        
        <div class="clearfix">
            <h4 class="mb-4">
                <div class="d-flex align-items-center" style="height: 60px;">
                    <span class="ml-2">Carrier Insurance on File with MyCarrierPackets</span>
                </div>
            </h4>
        </div>
        
            <div class="text-danger mb-4">There are currently no insurance certificates on file with MyCarrierPackets.</div>
        
            <div class="mb-4 text-danger">Carrier is not qualified for CertData. Carriers must have an active DOT Number to qualify for CertData certificate.</div>
        
        
        </div>
                                    </div>
                                    <div class="col-12 mt-2">
                                        <div class="clearfix">
            <h4 class="mb-4">
                <div class="float-left">
                    <img src="/Images/fmcsa.png" style="width: 60px;">
                </div>
                <div class="d-flex align-items-center" style="height: 60px;">
                    <span class="ml-2">Carrier Insurance on File with the FMCSA</span>
                </div>
            </h4>
        </div>
        
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5>BIPD Insurance</h5>
                            <div>
                                <span class="font-weight-bold">BIPD Required:</span>&nbsp;
                                $0
                            </div>
                            <div>
                                <span class="font-weight-bold">BIPD On File:</span>&nbsp;
                                $0
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5>HHG Cargo Insurance</h5>
                            <div>
                                <span class="font-weight-bold">Cargo Required:</span>&nbsp;
                                No
                            </div>
                            <div>
                                <span class="font-weight-bold">Cargo On File:</span>&nbsp;
                                No
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5>Bond Insurance</h5>
                            <div>
                                <span class="font-weight-bold">Bond Surety Required:</span>&nbsp;
                                No
                            </div>
                            <div>
                                <span class="font-weight-bold">Bond Surety On File:</span>&nbsp;
                                No
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div>
                    
                      <div class="card">
                        <div class="card-header">
                          <a class="collapsed btn" data-bs-toggle="collapse" href="#Safety">
                            Safety
                            <i class="bx bx-plus"></i>
                          </a>
                        </div>
                        <div id="Safety" class="collapse" data-bs-parent="#profile_accordion">
                          <div class="card-body">
                            Lorem ipsum..
                          </div>
                        </div>
                      </div>
                      
                      <div class="card">
                        <div class="card-header">
                          <a class="collapsed btn" data-bs-toggle="collapse" href="#Inspections">
                            Crash & Inspections
                            <i class="bx bx-plus"></i>
                          </a>
                        </div>
                        <div id="Inspections" class="collapse" data-bs-parent="#profile_accordion">
                          <div class="card-body">
                            Lorem ipsum..
                          </div>
                        </div>
                      </div>
                      
                      <div class="card">
                        <div class="card-header">
                          <a class="collapsed btn" data-bs-toggle="collapse" href="#Operations">
                            Operations
                            <i class="bx bx-plus"></i>
                          </a>
                        </div>
                        <div id="Operations" class="collapse" data-bs-parent="#profile_accordion">
                          <div class="card-body">
                            Lorem ipsum..
                          </div>
                        </div>
                      </div>
                    
                    </div>
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
