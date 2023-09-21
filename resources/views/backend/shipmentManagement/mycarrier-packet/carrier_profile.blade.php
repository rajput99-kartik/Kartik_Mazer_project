@extends('backend.layouts.master')
@section('title','Create Carrier')
@section('content')

<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
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
            <li class="pending_approval"><a href="{{url('/admin/carrier')}}" data-toggle="tab" aria-expanded="true">Carrier</a>
            </li>
            <li class="all_leave"><a href="{{url('/admin/new/carrier/detail')}}" data-toggle="tab" aria-expanded="false">Create Carrier</a>
                </li>
                <li class="active"><a href="{{url('/admin/carrier/myCarrierPacket')}}" data-toggle="tab" aria-expanded="false">MyCarrierPacket</a>
            </li>
        </ul>
		
                    
                            @foreach($results->AssureAdvantage as $result)	

                            
                            
			<div class="card mb-4">
                <div class="card-body carrier-profile">
                    <div class="row">
                        <div class="col-12 col-md-4 col-xl-3 mb-4">
                            <h4 class="font-weight-bold text-large mb-1">
                            {{ $result->CarrierDetails->Identity->legalName }}
                            </h4>
                            <h4 class="font-weight-normal text-large mb-3">
            
                            DOT{{$result->CarrierDetails->dotNumber->Value}}/{{$result->CarrierDetails->docketNumber}}
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
                                        <a tabindex="0" role="button" data-toggle="popover" data-placement="right" data-trigger="focus" data-html="true" title="" data-content="<p>Integration with Watchdog is only available to current TIA Members. Contact TIA at <a href='javascript:void(0)'>Membership@tianet.org</a> for more information about the benefits of TIA membership. Their staff can assist you with the application process and help you navigate TIA resources like model contracts, industry-leading education, legislative advocacy and support, and Watchdog Integration provided through MyCarrierPackets.com.</p><p>Contact TIA Membership at <a href='javascript:void(0)'>Membership@tianet.org</a> for your integration key (ServiceLogin) available free to TIA Members.</p>" data-original-title="TIA Watchdog"><i class="fas fa-question-circle"></i></a>
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
                            <span class="text-danger font-weight-bold">{{ $result->CarrierDetails->Operation->operatingStatus }}</span>
                        </dd>
                        <dt class="col-12 col-md-3">
                            Entity Type
                        </dt>
                        <dd class="col-12 col-md-3">
                                @if($result->CarrierDetails->Operation->entityCarrier == 'Yes')
                                    Carrier 
                                @endif
                                @if($result->CarrierDetails->Operation->entityShipper == 'Yes')
                                    Shipper 
                                @endif
                                @if($result->CarrierDetails->Operation->entityBroker == 'Yes')
                                    Broker 
                                @endif
                                @if($result->CarrierDetails->Operation->entityCargoTank == 'Yes')
                                    CargoTank 
                                @endif
                        </dd>
                        <dt class="col-12 col-md-3">
                            DOT Status
                        </dt>
                        <dd class="col-12 col-md-3">
                        {{ $result->CarrierDetails->dotNumber->status }}
                        </dd>
                        <dt class="col-12 col-md-3">
                            Active Since
                        </dt>
                        <dd class="col-12 col-md-3">
                        {{ $result->CarrierDetails->Operation->dotAddDate }}
                        </dd>
                        <dt class="col-12 col-md-3">
                            DOT Number
                        </dt>
                        <dd class="col-12 col-md-3">
                        {{ $result->CarrierDetails->dotNumber->Value }}
                        </dd>
                        <dt class="col-12 col-md-3">
                            Docket Number
                        </dt>
                        <dd class="col-12 col-md-3">
                        {{ $result->CarrierDetails->docketNumber }}
                        </dd>
                        <dt class="col-12 col-md-3">
                            Legal Name
                        </dt>
                        <dd class="col-12 col-md-3">
                        {{ $result->CarrierDetails->Identity->legalName }}
                        </dd>
                        <dt class="col-12 col-md-3">
                            DBA Name
                        </dt>
                        <dd class="col-12 col-md-3">
                        {{ $result->CarrierDetails->Identity->dbaName }}
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
                            {{$result->CarrierDetails->Identity->companyRep1}}
                        </dd>
                        <dt class="col-12 col-md-3">
                            Main Phone Number
                        </dt>
                        <dd class="col-12 col-md-3">
                        {{ $result->CarrierDetails->Identity->businessPhone }}
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
                        {{ $result->CarrierDetails->Identity->mailingPhone }}
                        </dd>
                        <dt class="col-12 col-md-3">
                            Company Main Email
                        </dt>
                        <dd class="col-12 col-md-3">
                            {{ $result->CarrierDetails->Identity->mailingPhone }}  
                        </dd>
                        <dt class="col-12 col-md-3">
                            Website
                        </dt>
                        <dd class="col-12 col-md-3">
                            
                        </dd>
                        <dt class="col-12 col-md-3">Address</dt>
                        <dd class="col-12 col-md-3">
                        {{ $result->CarrierDetails->Identity->businessStreet }}<br>
                            
                        {{ $result->CarrierDetails->Identity->businessCity }}, 
                        {{ $result->CarrierDetails->Identity->businessState }} 
                        {{ $result->CarrierDetails->Identity->businessZipCode }}
                                <br>
                                <a class="font-italic" target="_blank" href="#">(View on map)</a>
                        </dd>
                        <dt class="col-12 col-md-3">Mailing Address</dt>
                        <dd class="col-12 col-md-3">
                        {{ $result->CarrierDetails->Identity->businessStreet }}<br>
                            
                            {{ $result->CarrierDetails->Identity->businessCity }}, 
                            {{ $result->CarrierDetails->Identity->businessState }} 
                            {{ $result->CarrierDetails->Identity->businessZipCode }}
                                <br>
                                <a class="font-italic" target="_blank" href="#">(View on map)</a>
                        </dd>
                    </dl>
                    
                    <div id="profile_accordion" class="carrer-accor">
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
                                                    <span class="text-danger font-weight-bold">{{ $result->CarrierDetails->Authority->commonAuthority }}</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Common Authority Application Pending:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">{{ $result->CarrierDetails->Authority->commonAuthorityPending }}</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Common Authority Pending Revocation:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">{{ $result->CarrierDetails->Authority->commonAuthorityRevocation }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Contract Authority:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">{{ $result->CarrierDetails->Authority->contractAuthority }}</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Contract Authority Application Pending:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">{{ $result->CarrierDetails->Authority->contractAuthorityPending }}</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Contract Authority Pending  Revocation:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">{{ $result->CarrierDetails->Authority->contractAuthorityPending }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-6 col-md-4 mb-2">
                                            <div class="row">
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Broker Authority:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">{{ $result->CarrierDetails->Authority->brokerAuthority }}</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Broker Authority Application Pending:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">{{ $result->CarrierDetails->Authority->brokerAuthorityPending }}</span>
                                                </div>
                                                <div class="col-12">
                                                    <span class="font-weight-bold">Broker Authority Pending  Revocation:</span>&nbsp;
                                                    <span class="text-danger font-weight-bold">{{ $result->CarrierDetails->Authority->brokerAuthorityRevocation }}</span>
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
                                                <span class="text-danger font-weight-bold">{{ $result->CarrierDetails->Cargo->cargoGenFreight }}</span>
                                            </div>
                                            <div>
                                                <span class="font-weight-bold">Passenger:</span>&nbsp;
                                                <span class="text-danger font-weight-bold">{{ $result->CarrierDetails->Cargo->cargoPassengers }}</span>
                                            </div>
                                            <div>
                                                <span class="font-weight-bold">Household Goods:</span>&nbsp;
                                                <span class="text-danger font-weight-bold">{{ $result->CarrierDetails->Cargo->cargoHousehold }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 mb-3">
                                    <div class="card border-secondary">
                                        <div class="card-body">
                                            <div>
                                                <span class="font-weight-bold">Authority Granted On:</span><br>
                                                {{ $result->CarrierDetails->Authority->authGrantDate }}
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
        
                                            <div class="clearfix">
                                                <h4 class="mb-4">
                                                    <div class="d-flex align-items-center" style="height: 60px;">
                                                        <span class="ml-2">Carrier Insurance on File with MyCarrierPackets</span>
                                                    </div>
                                                </h4>
                                            </div>

                                    @foreach($result->CarrierDetails->CertData->Certificate as $Certificate )
                                        
                                            <div class="row">
                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                    <div class="card border-secondary">
                                                        <div class="card-body career_box">
                                                        
                                                        <!-- <form method="POST" action="{{url('admin/carrier/getDocument')}}" accept-charset="UTF-8" style="display:inline">
                                                        @csrf
                                                        <input name="file" type="hidden" value="{{ $Certificate->BlobName}}">
                                                        <button class="btn btn-outline-danger btn-sm radius-30 px-4" type="submit"><i class="bx bx-trash"></i><span class="tooltip">File</span></button>
                                                    </form> -->
                                                            <a href="javascript:void(0)" class="view_cart">View Cert <i class="bx bx-file"></i></a>
                                                            <h5>General Liability</h5>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Agent:</strong></span>&nbsp;
                                                                {{ $Certificate->producerName }}
                                                            </div>
                                                            @foreach($Certificate->Coverage as $coverage )
                                                            @if($coverage->type == 'General')
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Underwriter:</strong></span>&nbsp;
                                                                {{ $coverage->insurerName }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>A.M. Best Rating:</strong></span>&nbsp;
                                                                {{ $coverage->insurerAMBestRating }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Policy Number:</strong></span>&nbsp;
                                                                {{ $coverage->policyNumber }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Expiration Date:</strong></span>&nbsp;
                                                                {{ $coverage->expirationDate }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Coverage Limit:</strong></span>&nbsp;
                                                                {{ $coverage->coverageLimit }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Deductible:</strong></span>&nbsp;
                                                                {{ $coverage->deductable }}
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                    <div class="card border-secondary">
                                                        <div class="card-body career_box">
                                                            <a href="javascript:void(0)" class="view_cart">View Cert <i class="bx bx-file"></i></a>
                                                            <h5>Auto Liability</h5>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Agent:</strong></span>&nbsp;
                                                                {{ $Certificate->producerName }}
                                                            </div>
                                                            @foreach($Certificate->Coverage as $coverage )
                                                            @if($coverage->type == 'Auto')
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Underwriter:</strong></span>&nbsp;
                                                                {{ $coverage->insurerName }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>A.M. Best Rating:</strong></span>&nbsp;
                                                                {{ $coverage->insurerAMBestRating }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Policy Number:</strong></span>&nbsp;
                                                                {{ $coverage->policyNumber }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Expiration Date:</strong></span>&nbsp;
                                                                {{ $coverage->expirationDate }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Coverage Limit:</strong></span>&nbsp;
                                                                {{ $coverage->coverageLimit }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Deductible:</strong></span>&nbsp;
                                                                {{ $coverage->deductable }}
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                    <div class="card border-secondary">
                                                        <div class="card-body career_box">
                                                            <a href="javascript:void(0)" class="view_cart">View Cert <i class="bx bx-file"></i></a>
                                                            <h5>Workers Comp</h5>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Agent:</strong></span>&nbsp;
                                                                {{ $Certificate->producerName }}
                                                            </div>
                                                            @foreach($Certificate->Coverage as $coverage )
                                                            @if($coverage->type == 'WorkersCompensation')
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Underwriter:</strong></span>&nbsp;
                                                                {{ $coverage->insurerName }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>A.M. Best Rating:</strong></span>&nbsp;
                                                                {{ $coverage->insurerAMBestRating }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Policy Number:</strong></span>&nbsp;
                                                                {{ $coverage->policyNumber }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Expiration Date:</strong></span>&nbsp;
                                                                {{ $coverage->expirationDate }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Coverage Limit:</strong></span>&nbsp;
                                                                {{ $coverage->coverageLimit }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Deductible:</strong></span>&nbsp;
                                                                {{ $coverage->deductable }}
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                    <div class="card border-secondary">
                                                        <div class="card-body career_box">
                                                            <a href="javascript:void(0)" class="view_cart">View Cert <i class="bx bx-file"></i></a>
                                                            <h5>Cargo Liability w/ Refer Breakdown</h5>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Agent:</strong></span>&nbsp;
                                                                {{ $Certificate->producerName }}
                                                            </div>
                                                            @foreach($Certificate->Coverage as $coverage )
                                                            @if($coverage->type == 'Cargo Liability w/ Refer Breakdown')
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Underwriter:</strong></span>&nbsp;
                                                                {{ $coverage->insurerName }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>A.M. Best Rating:</strong></span>&nbsp;
                                                                {{ $coverage->insurerAMBestRating }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Policy Number:</strong></span>&nbsp;
                                                                {{ $coverage->policyNumber }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Expiration Date:</strong></span>&nbsp;
                                                                {{ $coverage->expirationDate }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Coverage Limit:</strong></span>&nbsp;
                                                                {{ $coverage->coverageLimit }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Deductible / Reefer Ded.:</strong></span>&nbsp;
                                                                {{ $coverage->deductable }}
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        @endforeach
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
                                ${{ $result->CarrierDetails->FMCSAInsurance->bipdRequired }}
                            </div>
                            <div>
                                <span class="font-weight-bold">BIPD On File:</span>&nbsp;
                                ${{ $result->CarrierDetails->FMCSAInsurance->bipdOnFile }}
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
                                {{ $result->CarrierDetails->FMCSAInsurance->cargoRequired }}
                            </div>
                            <div>
                                <span class="font-weight-bold">Cargo On File:</span>&nbsp;
                                {{ $result->CarrierDetails->FMCSAInsurance->cargoOnFile }}
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
                                {{ $result->CarrierDetails->FMCSAInsurance->bondSuretyRequired }}
                            </div>
                            <div>
                                <span class="font-weight-bold">Bond Surety On File:</span>&nbsp;
                                {{ $result->CarrierDetails->FMCSAInsurance->bondSuretyOnFile }}
                            </div>
                        </div>
                    </div>
                </div>

            @foreach($result->CarrierDetails->FMCSAInsurance->PolicyList as $policy_list)    
                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                    <div class="card border-secondary">
                        <div class="card-body">
                            <h5>BIPD/Primary</h5>
                            <div>
                                <span class="font-weight-bold">Underwriter:</span>&nbsp;
                                {{ $policy_list->companyName }}
                            </div>
                            <div>
                                <span class="font-weight-bold">Policy Number:</span>&nbsp;
                                {{ $policy_list->policyNumber }}
                            </div>
                            <div>
                                <span class="font-weight-bold">Posted Date:</span>&nbsp;
                                {{ $policy_list->postedDate }}
                            </div>
                            <div>
                                <span class="font-weight-bold">Effective Date:</span>&nbsp;
                                {{ $policy_list->effectiveDate }}
                            </div>
                            <div>
                                <span class="font-weight-bold">Cancel Date:</span>&nbsp;
                                @if($policy_list->cancelationDate != '0000-00-00')
                                {{ $policy_list->cancelationDate }}
                                @endif
                                
                            </div>
                            <div>
                                <span class="font-weight-bold">Coverage Amount:</span>&nbsp;
                                {{ $policy_list->coverageTo }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
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
                          <div class="row">
                            <div class="col-12 col-sm-6 col-lg-4 mb-4">
                                <div class="card border-secondary">
                                    <div class="card-body">
                                        <h5>Safety</h5>
                                        <div>
                                            <span class="font-weight-bold">Safety Rating:</span>&nbsp;
                                            {{ $result->CarrierDetails->Safety->rating }}
                                        </div>
                                        <div>
                                            <span class="font-weight-bold">Rating Date:</span>&nbsp;
                                            {{ $result->CarrierDetails->FMCSAInsurance->bipdOnFile }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4 mb-4">
                                <div class="card border-secondary">
                                    <div class="card-body">
                                        <h5>MCS-150 Most Recent</h5>
                                        <div>
                                            <span class="font-weight-bold">Date:</span>&nbsp;
                                          {{ $result->CarrierDetails->Review->mcs150Date}}
                                        </div>
                                        <div>
                                            <span class="font-weight-bold">MCS-150 Year:</span>&nbsp;
                                            No
                                        </div>
                                        <div>
                                            <span class="font-weight-bold">MCS-150 Miles:</span>&nbsp;
                                            No
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4 mb-4">
                                <div class="card border-secondary">
                                    <div class="card-body">
                                        <h5>Latest Review</h5>
                                        <div>
                                            <span class="font-weight-bold">Review Type:</span>&nbsp;
                                            No Testing
                                        </div>
                                        <div>
                                            <span class="font-weight-bold">Review Date:</span>&nbsp;
                                            No
                                        </div>
                                        <div>
                                            <span class="font-weight-bold">Review Date:</span>&nbsp;
                                            No
                                        </div>
                                        <div>
                                            <span class="font-weight-bold">Review Date:</span>&nbsp;
                                            No
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
                          <a class="collapsed btn" data-bs-toggle="collapse" href="#Inspections">
                            Crash & Inspections
                            <i class="bx bx-plus"></i>
                          </a>
                        </div>
                        <div id="Inspections" class="collapse" data-bs-parent="#profile_accordion">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                        <div class="card border-secondary">
                                            <div class="card-body">
                                                <h5>U.S. Inspection Results</h5>
                                                <div>
                                                    <span class="font-weight-bold">BIPD Required:</span>&nbsp;
                                                    $750,000
                                                </div>
                                                <div>
                                                    <span class="font-weight-bold">BIPD On File:</span>&nbsp;
                                                    $1,000,000
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                        <div class="card border-secondary">
                                            <div class="card-body">
                                                <h5>Canadian Inspection Results</h5>
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
                                </div>
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
                          
                          <div class="row">
                                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                                    <div class="card border-secondary">
                                        <div class="card-body">
                                            <div>
                                                <span class="font-weight-bold">Entity Type:</span>&nbsp;
                                                $750,000
                                            </div>
                                            <div>
                                                <span class="font-weight-bold">DOT Status:</span>&nbsp;
                                                $1,000,000
                                            </div>
                                            <div>
                                                <span class="font-weight-bold">DOT Date:</span>&nbsp;
                                                
                                                @if($result->CarrierDetails->Operation->dotAddDate != '0000-00-00')
                                                    {{ $result->CarrierDetails->Operation->dotAddDate }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-8 mb-8">
                                    <div class="card border-secondary">
                                        <div class="card-body">
                                            <div>
                                                <span class="font-weight-bold">Operating Status:</span>&nbsp;
                                                {{ $result->CarrierDetails->Operation->operatingStatus }}
                                            </div>
                                            <div>
                                                <span class="font-weight-bold">Out Of Service:</span>&nbsp;
                                                {{ $result->CarrierDetails->Operation->outOfService }}
                                            </div>
                                            <div>
                                                <span class="font-weight-bold">Out Of Service Date:</span>&nbsp;
                                                {{ $result->CarrierDetails->Operation->outOfServiceDate }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                                    <div class="card border-secondary">
                                        <div class="card-body">
                                            <h5>Operations</h5>
                                            <div>
                                                <span class="font-weight-bold">Carrier Operation:</span>&nbsp;
                                                {{ $result->CarrierDetails->Operation->carrierOperation }}
                                            </div>
                                            <div>
                                                <span class="font-weight-bold">Shipper Operation:</span>&nbsp;
                                                {{ $result->CarrierDetails->Operation->shipperOperation }}
                                            </div>
                                            <div>
                                                <span class="font-weight-bold">Hazmat Indicator:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Cargo->hazmatIndicator }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-lg-8 mb-8">
                                    <div class="card border-secondary">
                                        <div class="card-body">
                                        <h5>Classification</h5>
                                        <div class="row">
                                                <div class="col-md-6">
                                                    <div>
                                                        <span class="font-weight-bold">(A) Authorized for Hire: </span>&nbsp;
                                                        {{ $result->CarrierDetails->Operation->classAuthForHire }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">(B) Exempt for Hire:</span>&nbsp;
                                                        {{ $result->CarrierDetails->Operation->classExemptForHire }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">(C) Private(Property):</span>&nbsp;
                                                        {{ $result->CarrierDetails->Operation->classPrivateProperty }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">(D) Private Pass (Business):</span>&nbsp;
                                                        {{ $result->CarrierDetails->Operation->classPrivPassBusiness }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">(E) Private Pass (Non-Business):</span>&nbsp;
                                                        {{ $result->CarrierDetails->Operation->classPrivPassNonBusiness }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">(F) Migrant:</span>&nbsp;
                                                        {{ $result->CarrierDetails->Operation->classMigrant }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">Other Description:</span>&nbsp;
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-6">
                                                    <div>
                                                        <span class="font-weight-bold">(G) U.S. Mail:</span>&nbsp;
                                                        {{ $result->CarrierDetails->Operation->classUSMail }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">(H) Federal Government:</span>&nbsp;
                                                        {{ $result->CarrierDetails->Operation->classFederalGovernment }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">(I) State Government:</span>&nbsp;
                                                        {{ $result->CarrierDetails->Operation->classStateGovernment }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">(J) Local Government:</span>&nbsp;
                                                        {{ $result->CarrierDetails->Operation->classLocalGovernment }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">(K) Indian Tribe:</span>&nbsp;
                                                        {{ $result->CarrierDetails->Operation->classIndianNation }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-sm-12 col-lg-12 mb-12">
                                    <div class="card border-secondary">
                                        <div class="card-body">
                                            <h5>Cargo Type(s)</h5>
                                            <div class="row">
                                                    <div class="col-md-3">
                                                        <div>
                                                            <span class="font-weight-bold">
                                                                @if($result->CarrierDetails->Cargo->cargoBeverages == 'No' )
                                                                    Beverages
                                                                @endif
                                                                @if($result->CarrierDetails->Cargo->cargoBeverages == 'Yes' )
                                                                    <strong>Beverages</strong>
                                                                @endif
                                                            </span>&nbsp;
                                                        </div>
                                                        <div>
                                                            <span class="font-weight-bold">
                                                            @if($result->CarrierDetails->Cargo->cargoDryBulk == 'No' )
                                                                        Commodities Dry Bulk
                                                                @endif
                                                                @if($result->CarrierDetails->Cargo->cargoDryBulk == 'Yes' )
                                                                    <strong>Commodities Dry Bulk</strong>
                                                                @endif
                                                            </span>&nbsp;
                                                        </div>
                                                        <div>
                                                            <span class="font-weight-bold">
                                                            @if($result->CarrierDetails->Cargo->cargoProduce == 'No' )
                                                                    Fresh Produce
                                                                @endif
                                                                @if($result->CarrierDetails->Cargo->cargoProduce == 'Yes' )
                                                                    <strong>Fresh Produce</strong>
                                                                @endif
                                                            </span>&nbsp;
                                                        </div>
                                                        <div>
                                                            <span class="font-weight-bold">
                                                            @if($result->CarrierDetails->Cargo->cargoGenFreight == 'No' )
                                                                        General Freight
                                                                @endif
                                                                @if($result->CarrierDetails->Cargo->cargoGenFreight == 'Yes' )
                                                                    <strong>General Freight</strong>
                                                                @endif
                                                            </span>&nbsp;
                                                        </div>
                                                    </div>
                                                
                                                
                                                </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-12 col-sm-12 col-lg-12 mb-12">
                                    <div class="card border-secondary">
                                        <div class="card-body">
                                            <h5>Drivers</h5>
                                            <div class="row">
                                            <div class="col-md-3">
                                                <div>
                                                    <span class="font-weight-bold">Total Drivers:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Drivers->driversTotal }}
                                                </div>
                                                <div>
                                                    <span class="font-weight-bold">CDL Employed Drivers:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Drivers->driversCDL }}
                                                </div>
                                                <div>
                                                    <span class="font-weight-bold">Monthly Average Leased Drivers:</span>&nbsp;
                                                        {{ $result->CarrierDetails->Drivers->driversAvgLeased }}
                                                </div>
                                            </div>
                                                <div class="col-md-3">
                                                    <div>
                                                        <span class="font-weight-bold">Interstate Drivers:</span>&nbsp;
                                                        {{ $result->CarrierDetails->Drivers->driversInter }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">Interstate < 100 Miles:</span>&nbsp;
                                                            {{ $result->CarrierDetails->Drivers->driversInterLT100 }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">Interstate > 100 Miles:</span>&nbsp;
                                                        {{ $result->CarrierDetails->Drivers->driversInterGT100 }}
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div>
                                                        <span class="font-weight-bold">Intrastate Drivers:</span>&nbsp;
                                                            {{ $result->CarrierDetails->Drivers->driversIntra }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">Intrastate < 100 Miles:</span>&nbsp;
                                                        {{ $result->CarrierDetails->Drivers->driversIntraLT100 }}
                                                    </div>
                                                    <div>
                                                        <span class="font-weight-bold">Intrastate > 100 Miles:</span>&nbsp;
                                                            {{ $result->CarrierDetails->Drivers->driversIntraGT100 }}
                                                    </div>
                                                </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-12 col-sm-12 col-lg-12 mb-12">
                                    <div class="card border-secondary">
                                        <div class="card-body">
                                            <h5>Equipment</h5>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div>
                                                    <span class="font-weight-bold">Fleet Size:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Equipment->fleetsize }}
                                                </div>
                                                <div>
                                                    <span class="font-weight-bold">Total Power Units:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Equipment->totalPower }}
                                                </div>
                                                <div>
                                                    <span class="font-weight-bold">Total Trucks:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Equipment->trucksTotal }}
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div>
                                                    <span class="font-weight-bold">Tractors Owned:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Equipment->tractorsOwned }}
                                                </div>
                                                <div>
                                                    <span class="font-weight-bold">Trucks Owned:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Equipment->trucksOwned }}
                                                </div>
                                                <div>
                                                    <span class="font-weight-bold">Trailers Owned:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Equipment->trailersOwned }}
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div>
                                                    <span class="font-weight-bold">Tractors Term Leased:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Equipment->tractorsTerm }}
                                                </div>
                                                <div>
                                                    <span class="font-weight-bold">Trucks Term Leased:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Equipment->trucksTerm }}
                                                </div>
                                                <div>
                                                    <span class="font-weight-bold">Trailers Term Leased:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Equipment->trailersTerm }}
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div>
                                                    <span class="font-weight-bold">Tractors Trip Leased:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Equipment->tractorsTrip }}
                                                </div>
                                                <div>
                                                    <span class="font-weight-bold">Trucks Trip Leased:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Equipment->trucksTrip }}
                                                </div>
                                                <div>
                                                    <span class="font-weight-bold">Trailers Trip Leased:</span>&nbsp;
                                                    {{ $result->CarrierDetails->Equipment->trailersTrip }}
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
                    @endforeach

                            <div class="card">
                                <div class="card-header">
                                <a class="btn" data-bs-toggle="collapse" href="#CarrierPacket" aria-expanded="true">
                                    Carrier Packet
                                    <i class="bx bx-plus"></i>
                                </a>
                                </div>
                                <div id="CarrierPacket" class="collapse" data-bs-parent="#profile_accordion" style="">
                                    <div class="card-body">
                                        <div class="row">
                                    
                                        @if(isset($results->CarrierCustomerAgreements))
                                        @foreach($results->CarrierCustomerAgreements as $Agreement)
                                        
                                            <h3>To Download/Print Carrier Packet Click <a href="#">here</a></h3>
                                            <h3>Agreement Click <a href="#">here</a> to view.</h3>
                                            
                                            
                                            
                                            <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                <div class="card border-secondary">
                                                    <div class="card-body">
                                                        <div>
                                                            <span class="font-weight-bold"><strong>Agreed to by</strong></span>&nbsp;
                                                                {{ $Agreement->SignaturePerson }}
                                                        </div>
                                                        <div>
                                                            <span class="font-weight-bold"><strong>Email</strong></span>&nbsp;
                                                                {{ $Agreement->SignaturePersonEmail }}
                                                        </div>
                                                        <div>
                                                            <span class="font-weight-bold"><strong>Date of Agreement</strong></span>&nbsp;
                                                                {{ $Agreement->SignatureDate }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                <div class="card border-secondary">
                                                    <div class="card-body">
                                                        <div>
                                                            <span class="font-weight-bold"><strong>Title</strong></span>&nbsp;
                                                            {{ $Agreement->SignaturePersonTitle }}
                                                        </div>
                                                        <div>
                                                            <span class="font-weight-bold"><strong>Phone Number</strong></span>&nbsp;
                                                            {{ $Agreement->SignaturePersonPhoneNumber }}
                                                        </div>
                                                        <div>
                                                            <span class="font-weight-bold"><strong>Agreement Version</strong></span>&nbsp;
                                                            {{ $Agreement->CustomerAgreement->AgreementName }}
                                                         
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            <h3>W9 Form  Click<a href="#">here</a>to view.</h3>
                                            <div class="mt-3">
                                                <h4>TIN Matching Status</h4>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>TIN</th>
                                                            <th>Legal Name</th>
                                                            <th>Result</th>
                                                        </tr>
                                                        <tr>
                                                            @foreach($results->CarrierW9Forms as $W9_forms)
                                                            <td>{{ $W9_forms->EIN }}</td>
                                                            <td>{{ $W9_forms->FullName }}</td>
                                                            <td></td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        <div class="divCarrierAfterHoursSupport">
                                            <h3>After Hours Support</h3>
                                            <h4>Weekday After Hours Support</h4>
                                            <div class="row">
                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                    <div class="card border-secondary">
                                                        <div class="card-body">
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Support Name</strong></span>&nbsp;
                                                                {{ $results->AfterHrsWkDaySupportName }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Support Fax</strong></span>&nbsp;
                                                                {{ $results->AfterHrsWkDaySupportFax }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Support Time To</strong></span>&nbsp;
                                                                {{ $results->AfterHrsWkDaySupportTo }}
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                    <div class="card border-secondary">
                                                        <div class="card-body">
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Support Phone</strong></span>&nbsp;
                                                                {{ $results->AfterHrsWkDaySupportPhone }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Support Time From</strong></span>&nbsp;
                                                                {{ $results->AfterHrsWkDaySupportTo }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Weekend After Hours Support</h4>
                                            <div class="row">
                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                    <div class="card border-secondary">
                                                        <div class="card-body">
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Support Name</strong></span>&nbsp;
                                                                {{ $results->AfterHrsWkEndSupportName }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Support Fax</strong></span>&nbsp;
                                                                {{ $results->AfterHrsWkEndSupportFax }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Support Time To</strong></span>&nbsp;
                                                                {{ $results->AfterHrsWkEndSupportTo }}
                                                            
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                    <div class="card border-secondary">
                                                        <div class="card-body">
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Support Phone</strong></span>&nbsp;
                                                                {{ $results->AfterHrsWkEndSupportPhone }}
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Support Time From</strong></span>&nbsp;
                                                                {{ $results->AfterHrsWkEndSupportTo }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Contact Information</h4>
                                            <div class="row">
                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                    <div class="card border-secondary">
                                                        <div class="card-body">
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Do you use a Dispatcher Service?</strong></span>&nbsp;
                                                                @if($results->DispatchServiceUsed == false)
                                                                    NO
                                                                @endif
                                                            </div>
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Dispatcher Service Phone</strong></span>&nbsp;
                                                                @if($results->DispatchServicePhone == null)
                                                                    ''
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                    <div class="card border-secondary">
                                                        <div class="card-body">
                                                            <div>
                                                                <span class="font-weight-bold"><strong>Dispatcher Service Name</strong></span>&nbsp;
                                                                @if($results->DispatchServiceName == null)
                                                                    ''
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                           
                                            <div class="mt-3">
                                                <h3>Dispatchers</h3>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Dispatcher Name	</th>
                                                            <th>Phone Number</th>
                                                            <th>Email</th>
                                                        </tr>
                                                        <tr>
                                                            
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="mt-3">
                                                <h3>Drivers</h3>
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <th>Driver Name	</th>
                                                            <th>Cell Phone</th>
                                                        </tr>
                                                        <tr>
                                                        @foreach($results->CarrierDrivers as $carrier_driver)
                                                            <td>{{ $carrier_driver->DriverName }}</td>
                                                            <td>{{ $carrier_driver->CellPhone }}</td>
                                                            @endforeach
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>

                                        <div class="divCarrierLanes">
                                            <h3>Lanes Serviced</h3>
                                        </div>
                                        <div class="divCarrierELDProvider">
                                            <h3>ELD Provider Information</h3>
                                        </div>
                                        <div class="divCarrierCertifications">
                                            <h3>Certifications</h3>
                                        </div>
                                        <div class="divCarrierTruckClasses">
                                            <h3>Truck Classes</h3>
                                        </div>
                                        <div class="divCarrierTruckTypes">
                                            <h3>Trailer Types</h3>
                                        </div>
                                        <div class="divCarrierCargoHauled">
                                            <h3>Cargo Hauled</h3>
                                        </div>
                                        <div class="divCarrierModes">
                                            <h3>Modes</h3>
                                        </div>


                                        </div>


                                        @endforeach
                                        @endif
				   
		<!-- End card-->
		
		
		
<!-- start new here  ****************************************-->

</div>
</div>
<!--end page wrapper -->   


@include('backend.common.footer')
@endsection