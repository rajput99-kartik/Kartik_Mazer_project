@extends('backend.layouts.master')
@section('title','Create Carrier')
@section('content')

<style>

.cargo_color{
        color:#02BC77
    }
    
    .cargo_not_present{
        color: rgb(245, 24, 24);
    }

    .card-body.carrier-profile .card-header a.btn {
        padding: 0px !important;
    }
    div#profile_accordion .card-header a.btn {
        padding: 5px 10px;
        font-size: 12px;
        border-radius: 0px !important;
    }
    div#profile_accordion .card-header a.btn i {
        font-size: 14px;
        margin-top: 0px;
    }
    div#profile_accordion .card-header {border-radius: 0px !important;}
    .card-body.carrier-profile h4 {
        font-size: 12px;
    }
    .card-body.carrier-profile .btn {
        font-size: 10px;
    }
    .card-body.carrier-profile .mt-3 {
        margin-top: 0px !important;
    }
    .card-body.carrier-profile h5 {
        font-size: 12px;
    }
    .card-body.padding-none dd, .card-body.padding-none dt {
        font-size: 10px;
    }
    .card.col-md-6 {
        display: block;
        height: fit-content;
    }
    select#RiskAssessmentID {
        color: #99a599;
        font-family: ui-monospace;
    }

    h4#RiskAssessmentLabel_0 {
    color: white;
}
</style>
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
            <li class="pending_approval"><a href="{{url('/admin/carrier')}}" data-toggle="tab" aria-expanded="true">All Carrier</a>
            </li>
            
            <li class="all_leave active"><a href="{{url('/admin/new/carrier/detail')}}" data-toggle="tab" aria-expanded="false">Create Carrier</a>
            </li>
            <li class=""><a href="{{url('/admin/carrier/myCarrierPacket')}}" data-toggle="tab" aria-expanded="false">MyCarrierPacket</a>
            </li>
        </ul>
        <div class="card">
            <div class="card-body">
                <div class="row">                       
                        <?php  if($results->Message == "An error has occurred."){  ?>  
                            <script>window.location = "/admin/new/carrier/detail";</script>
                            
                            <?php 
                            return redirect('admin/new/carrier/detail')->withErrors(['Check Docket or Dot number']) ;
                            
                        }else{ ?>

                                <div class="col-md-6">
                                @foreach($results->AssureAdvantage as $result)	
                                    <form action="{{url('/admin/carrier/add_carrier')}}" id="add-new-carrier" method="post" enctype="multipart/form-data" class="placeholder-form">
                                        @csrf
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                <h3 class="card-title">Basic Info</h3>
                                            </div>
                                            
                                            <div class="row formwrap space-row">
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" name="company_name" id="company_name" placeholder="Company Name" value="{{ $result->CarrierDetails->Identity->legalName }}">
                                                    <label id="company_name-error" class="error" for="city"></label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" name="mc_no" id="mc_no" placeholder="MC#" value="{{$result->CarrierDetails->docketNumber}}">
                                                    <label id="mc_no-error" class="error" for="city"></label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" name="dot_no" id="dot_no" placeholder="DOT" value="{{$result->CarrierDetails->dotNumber->Value}}">
                                                    <label id="dot_no-error" class="error" for="city"></label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" name="carrier_city" id="carrier_city" placeholder="Address" value="{{ $result->CarrierDetails->Identity->businessStreet }}">
                                                    <label id="carrier_city-error" class="error" for="city"></label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" name="carrier_city_main" id="carrier_city_main" placeholder="City" value="{{ $result->CarrierDetails->Identity->businessCity }}">
                                                    <label id="carrier_city_main-error" class="error" for="city"></label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" name="carrier_state" id="carrier_state" placeholder="State" value="{{ $result->CarrierDetails->Identity->businessState }}">
                                                    <label id="carrier_state-error" class="error" for="city"></label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" name="carrier_zip" id="carrier_zip" placeholder="Zip Code" value="{{ $result->CarrierDetails->Identity->businessZipCode }}">
                                                    <label id="carrier_zip-error" class="error" for="city"></label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Phone" value="{{ $result->CarrierDetails->Identity->businessPhone }}">
                                                    <label id="phone_no-error" class="error" for="city"></label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" name="carrier_fax" placeholder="Fax" value="">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                                    <label id="email-error" class="error" for="city"></label>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <input type="text" class="form-control" name="dispatcher" placeholder="Dispatcher">
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                            
                                        <div class="card card-primary" style="box-shadow:unset !important">
                                            @foreach($result->CarrierDetails->CertData->Certificate as $Certificate )
                                                @foreach($Certificate->Coverage as $coverage )
                                                    @if($coverage->type == 'General')
                                                        <div class="card-header">
                                                            <h3 class="card-title">Cargo:</h3>
                                                        </div>
                                                        <div class="row space-row">
                                                            <div class="form-group col-md-6">
                                                                
                                                                <input type="text" class="form-control" name="cargo_amount" id="cargo_amount" placeholder="Amount USD" value="{{ $coverage->coverageLimit }}">
                                                            </div>
                                                            <div class="form-group col-md-6">
                                                                <input type="text" class="form-control" name="cargo_expires" id="cargo_expires" placeholder="Expires" value="{{ $coverage->expirationDate }}">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            
                                            
                                            
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Cargo Deductible:</h3>
                                                </div>
                                                <div class="row space-row">
                                                    <div class="form-group col-md-12">
                                                        <input type="text" class="form-control" name="cargo_deduct_amount" id="cargo_deduct_amount" placeholder="Amount USD">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Liability:</h3>
                                                </div>
                                                <div class="row space-row">
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" name="liability_amount" id="liability_amount" placeholder="Amount USD" value="{{ isset($coverage->coverageLimit) ? $coverage->coverageLimit : null  }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" name="liability_expires" id="liability_expires" placeholder="Expires" value="{{ isset($coverage->expirationDate) ? $coverage->expirationDate : null }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Gen Liability:</h3>
                                                </div>
                                                <div class="row space-row">
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" name="gen_liab_amount" id="gen_liab_amount" placeholder="Amount USD" value="{{ isset($coverage->coverageLimit) ? $coverage->coverageLimit : null }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" name="gen_liab_expires" id="gen_liab_expires" placeholder="Expires" value="{{ isset($coverage->expirationDate) ? $coverage->expirationDate : null }}">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <select name="reefer_bkdn" id="reefer_bkdn_val" class="form-control">
                                                            <option>Reefer Breakdown</option>
                                                            <option selected="" value="Y">Y</option>
                                                            <option value="N">N</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" name="reefer_brk_deduct" placeholder="Reefer Brk Deduct">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input type="text" class="form-control" name="contact_auth" placeholder="Contract Authority" value="{{ $result->CarrierDetails->Authority->contractAuthority }}">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <input type="text" class="form-control" name="common_auth" placeholder="Common Authority" value="{{ $result->CarrierDetails->Authority->commonAuthority }}">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <select name="safety" class="form-control">
                                                            <option>Safety Rating</option>
                                                            <option value="NONE" selected="">NONE</option>
                                                            <option value="CONDITIONAL">CONDITIONAL</option>
                                                            <option value="SATISFACTORY">SATISFACTORY</option>
                                                            <option value="UNSATISFACTORY">UNSATISFACTORY</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="card card-primary">
                                                <div class="card-header">
                                                    <h3 class="card-title">Driver Details:</h3>
                                                </div>
                                                <div class="row space-row">
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" name="d_name" placeholder="Name">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <input type="text" class="form-control" name="d_phone" placeholder="Phone">
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <button type="submit" id="carrier-form-submi-testt" class="btn btn-primary">Create Carrier</button>
                                        </div>
                                    </form>
                                @endforeach
                                </div>

                                <div class="col-md-6">
                                <div class="card">
                                    @foreach($results->AssureAdvantage as $result)	
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
                                                
                                                <h5 class="mt-3">Packet Status: Not Invited</h5>
                                                <div class="mt-3">
                                                    <div class="font-weight-bold">
                                                        <span>Report: </span>
                                                        <span style="color: red;">NOACCOUNT</span>
                                                        <a tabindex="0" role="button" data-toggle="popover" data-placement="right" data-trigger="focus" data-html="true" title="" data-content="<p>Integration with Watchdog is only available to current TIA Members. Contact TIA at <a href='javascript:void(0)'>Membership@tianet.org</a> for more information about the benefits of TIA membership. Their staff can assist you with the application process and help you navigate TIA resources like model contracts, industry-leading education, legislative advocacy and support, and Watchdog Integration provided through MyCarrierPackets.com.</p><p>Contact TIA Membership at <a href='javascript:void(0)'>Membership@tianet.org</a> for your integration key (ServiceLogin) available free to TIA Members.</p>" data-original-title="TIA Watchdog"><i class="fas fa-question-circle"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="carrierRatingContainer col-12 col-md-4 col-xl-3 mb-4">
                                                <h4>Carrier Rating</h4>
                                                
                                                
                                                <div class="carrierRatingContainer">
                                                    <div class="mb-2"> Average Rating: <b>{{ $result->CarrierDetails->CarrierRatings->avgRating }} </b></div>
                                                    <div class="mb-2"> Average Rating based on <b>{{ $result->CarrierDetails->CarrierRatings->totalRatings }} </b> customers</div>
                                                    
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
                                                <div class="">
                                                    <div class="">
                                                        <div>
                                                            <div><span class="font-weight-bold">FMCSA Links:</span></div>
                                                            <div><a target="_blank" href="#">License and Insurance</a></div>
                                                            <div><a target="_blank" href="#">Company Snapshot</a></div>
                                                            <div><a target="_blank" href="#">Safety Measurement System</a></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mt-3">
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#divCarrierNotesModal_0" data-dot-number="123" data-docket-number="MC123123">
                                                        <span>Notes</span>
                                                        <span id="notesCount_0" class="badge">0</span>
                                                    </button>
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#divAddCarrierNoteModal_0" data-dot-number="123" data-docket-number="MC123123">Add Note</button>
                                                    <p id="latestNote_0" class="mt-1 mb-0" style="white-space: pre-wrap"></p>
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
                                                            
                                                           
                                                            <span class="font-weight-bold">Check infractions 
                                                                {{-- <span class="font-weight-bold">Click <a href="#" data-toggle="modal" data-target="#divRiskAssessmentDetails_0" style="text-decoration: underline">here</a> to review.</span> --}}
                                                                <button type="button" class="btn btn-primary btn-sm" id="btn1" data-toggle="modal" data-target="#exampleModal">
                                                                    Infractions
                                                                </button>
                                                                </span>
                                                                
                                                                <!-- Modal -->
                                                                <div class="modal fade" id="goalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-xl" role="document">
                                                                        <div class="modal-content">
                                                                            
                                                                            <div class="modal-header bg-primary text-white py-2">
                                                                                <h4 class="modal-title" id="RiskAssessmentLabel_0">Risk Assessment</h4>
                                                                                <button type="button" id="closeModal" class="close font-weight-bold text" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="text-large">&times;</span></button>
                                                                            </div>
                                                                            
                                                                            
                                                                            <div class="modal-body ">
                                                                                <div class="ra-container">
                                                                                        <div class="card" style="min-height: 700px;">
                                                                                            <div class="card-body bg-light">
                                                                                                <div class="ra-det-container">
                                                                                                    <input class="ra-dot-number" type="hidden" value="3491874">
                                                                                                    <input class="ra-docket-number" type="hidden" value="MC1149527">
                                                                                                    <input class="ra-enforce-certdata-rules" type="hidden" value="false">
                                                                                                    <div class="row">
                                                                                                        <div class="col-12 col-lg-6 mb-4 order-2 order-lg-1">
                                                                                                            <h4 class="font-weight-bold text-large mb-1">
                                                                                                                {{ $result->CarrierDetails->Identity->legalName }}
                                                                                                            </h4>
                                                                                                            <h4 class="font-weight-normal text-large mb-0">
                                                                                                                
                                                                                                                DOT{{$result->CarrierDetails->dotNumber->Value}}/{{$result->CarrierDetails->docketNumber}}
                                                                                                            </h4>
                                                                                                        </div>
                                                                                                        {{-- <div class="col-12 col-lg-6 clearfix order-1 order-lg-2 mb-4">
                                                                                                            <img src="/Images/assure-advantage-dark.svg" class="img-fluid float-lg-right" style="max-height: 50px;" />
                                                                                                        </div> --}}
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <div class="col">
                                                                                                            <div class="mb-3">
                                                                                                                <button class="btn btn-sm btn-primary toggle-aa-ra-help">
                                                                                                                    <i class="fas fa-question-circle"></i> View Rating System
                                                                                                                </button>
                                                                                                            </div>
                                                                                                            <h5 class="mb-2">Overall assessment using <select class="custom-select custom-select-sm ml-lg-2 mt-1 mt-lg-0 d-inline-block risk-assessments" data-val="true" data-val-number="The field RiskAssessmentID must be a number." data-val-required="The RiskAssessmentID field is required." id="RiskAssessmentID" name="RiskAssessmentID" style="width: 300px;"><option selected="selected" value="1525">Industry Standard</option>
                                                                                                            </select></h5>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="mb-4">
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                                                                                                <h4 class="text-danger mb-1 d-inline-block">
                                                                                                                    <span class="text-wrap">{{$result->CarrierDetails->RiskAssessment->Overall}}</span>
                                                                                                                    {{-- <span class="text-nowrap">Unacceptable</span>
                                                                                                                    <span class="text-nowrap">(unable to invite)</span> --}}
                                                                                                                </h4>
                                                                                                            </div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span class="float-right font-weight-bold">Total Points</span></div></div>
                                                                                                        </div>
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7"></div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5">
                                                                                                                <div style="max-width: 120px;">
                                                                                                                    <span class="float-right">{{$result->CarrierDetails->RiskAssessmentDetails->TotalPoints}}</span>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    
                                                                                                    {{-- Infraction Authority Start --}}
                                                                                                    
                                                                                                    @if($result->CarrierDetails->RiskAssessmentDetails->Authority->OverallRating == 'Acceptable' )    
                                                                                                    <div class="mb-4">
                                                                                                        <div class="row mb-2 font-weight-bold">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                                                                                                <h5 class="mb-0 d-inline-block mr-2">Authority</h5>
                                                                                                                
                                                                                                                
                                                                                                                <h4 class="mb-0 d-inline-block">
                                                                                                                    <span class="text-success">{{$result->CarrierDetails->RiskAssessmentDetails->Authority->OverallRating}}</span>
                                                                                                                    
                                                                                                                </h4>
                                                                                                            </div>
                                                                                                            {{-- <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span>Risk Level</span><span class="float-right">Points</span></div></div> --}}
                                                                                                        </div>
                                                                                                        <hr class="my-2" />
                                                                                                        <div class="mb-1">All rules passed</div>
                                                                                                        
                                                                                                        <br><br>
                                                                                                        
                                                                                                        @else 
                                                                                                        <div class="row mb-2 font-weight-bold">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                                                                                                <h5 class="mb-0 d-inline-block mr-2">Authority</h5>
                                                                                                                
                                                                                                                
                                                                                                                <h4 class="mb-0 d-inline-block">
                                                                                                                    <span class="text-danger">{{$result->CarrierDetails->RiskAssessmentDetails->Authority->OverallRating}}</span>
                                                                                                                    
                                                                                                                </h4>
                                                                                                            </div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span>Risk Level</span><span class="float-right">Points</span></div></div>
                                                                                                        </div>
                                                                                                    
                                                                                                        
                                                                                                        @php
                                                                                                        $total_value = 0;
                                                                                                        foreach($result->CarrierDetails->RiskAssessmentDetails->Authority->Infractions as $Infraction){
                                                                                                            if (isset($Infraction->Points)) {
                                                                                                                $total_value += $Infraction->Points;
                                                                                                            }
                                                                                                        }
                                                                                                        
                                                                                                        // dd($total_value);
                                                                                                        
                                                                                                        @endphp
                                                                                                        <hr class="my-2" />
                                                                                                        @foreach($result->CarrierDetails->RiskAssessmentDetails->Authority->Infractions as $Infraction)                
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1">{{$Infraction->RuleText}}</div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5 mb-1"><div style="max-width: 120px;"><span>{{$Infraction->RiskLevel}}</span><span class="float-right">{{$Infraction->Points}}</span></div></div>
                                                                                                        </div> 
                                                                                                        @endforeach
                                                                                                        
                                                                                                        
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1"></div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><hr style="margin: 0 -3px 0 0; width: 53px;  border-top: 1px solid #4E5155;" /></div></div>
                                                                                                        </div>
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1"></div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span class="float-right"> {{$total_value}}</span></div></div>
                                                                                                        </div>
                                                                                                        <br><br>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                    
                                                                                                    {{-- Infraction Authority End --}}
                                                                                                    
                                                                                                    {{-- Infraction Insurance Start --}}
                                                                                                    @if($result->CarrierDetails->RiskAssessmentDetails->Insurance->OverallRating == 'Acceptable' )    
                                                                                                    <div class="mb-4">
                                                                                                        <div class="row mb-2 font-weight-bold">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                                                                                                <h5 class="mb-0 d-inline-block mr-2">Insurance</h5>
                                                                                                                
                                                                                                                
                                                                                                                <h4 class="mb-0 d-inline-block">
                                                                                                                    <span class="text-success">{{$result->CarrierDetails->RiskAssessmentDetails->Insurance->OverallRating}}</span>
                                                                                                                    
                                                                                                                </h4>
                                                                                                            </div>
                                                                                                            {{-- <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span>Risk Level</span><span class="float-right">Points</span></div></div> --}}
                                                                                                        </div>
                                                                                                        <hr class="my-2" />
                                                                                                        <div class="mb-1">All rules passed</div>
                                                                                                        
                                                                                                        <br><br>
                                                                                                        
                                                                                                        @else 
                                                                                                        <div class="row mb-2 font-weight-bold">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                                                                                                <h5 class="mb-0 d-inline-block mr-2">Insurance</h5>
                                                                                                                
                                                                                                                
                                                                                                                <h4 class="mb-0 d-inline-block">
                                                                                                                    <span class="text-danger">{{$result->CarrierDetails->RiskAssessmentDetails->Insurance->OverallRating}}</span>
                                                                                                                    
                                                                                                                </h4>
                                                                                                            </div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span>Risk Level</span><span class="float-right">Points</span></div></div>
                                                                                                        </div>
                                                                                                    
                                                                                                        
                                                                                                        @php
                                                                                                        $total_value = 0;
                                                                                                        foreach($result->CarrierDetails->RiskAssessmentDetails->Insurance->Infractions as $Infraction){
                                                                                                            if (isset($Infraction->Points)) {
                                                                                                                $total_value += $Infraction->Points;
                                                                                                            }
                                                                                                        }
                                                                                                        
                                                                                                        // dd($total_value);
                                                                                                        
                                                                                                        @endphp
                                                                                                        <hr class="my-2" />
                                                                                                        @foreach($result->CarrierDetails->RiskAssessmentDetails->Insurance->Infractions as $Infraction)                
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1">{{$Infraction->RuleText}}</div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5 mb-1"><div style="max-width: 120px;"><span>{{$Infraction->RiskLevel}}</span><span class="float-right">{{$Infraction->Points}}</span></div></div>
                                                                                                        </div> 
                                                                                                        @endforeach
                                                                                                        
                                                                                                        
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1"></div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><hr style="margin: 0 -3px 0 0;  width: 53px; border-top: 1px solid #4E5155;" /></div></div>
                                                                                                        </div>
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1"></div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span class="float-right"> {{$total_value}}</span></div></div>
                                                                                                        </div>
                                                                                                        <br><br>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                    
                                                                                                    {{-- Infraction Insurance End --}}
                                                                                                    
                                                                                                    
                                                                                                    
                                                                                                    
                                                                                                    
                                                                                                    {{-- Infraction Operations Start --}}
                                                                                                    
                                                                                                    @if($result->CarrierDetails->RiskAssessmentDetails->Operation->OverallRating == 'Acceptable' )    
                                                                                                    <div class="mb-4">
                                                                                                        <div class="row mb-2 font-weight-bold">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                                                                                                <h5 class="mb-0 d-inline-block mr-2">Operation</h5>
                                                                                                                
                                                                                                                
                                                                                                                <h4 class="mb-0 d-inline-block">
                                                                                                                    <span class="text-success">{{$result->CarrierDetails->RiskAssessmentDetails->Operation->OverallRating}}</span>
                                                                                                                    
                                                                                                                </h4>
                                                                                                            </div>
                                                                                                            {{-- <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span>Risk Level</span><span class="float-right">Points</span></div></div> --}}
                                                                                                        </div>
                                                                                                        <hr class="my-2" />
                                                                                                        <div class="mb-1">All rules passed</div>
                                                                                                        
                                                                                                        <br><br>
                                                                                                        
                                                                                                        @else 
                                                                                                        <div class="row mb-2 font-weight-bold">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                                                                                                <h5 class="mb-0 d-inline-block mr-2">Operation</h5>
                                                                                                                
                                                                                                                
                                                                                                                <h4 class="mb-0 d-inline-block">
                                                                                                                    <span class="text-danger">{{$result->CarrierDetails->RiskAssessmentDetails->Operation->OverallRating}}</span>
                                                                                                                    
                                                                                                                </h4>
                                                                                                            </div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span>Risk Level</span><span class="float-right">Points</span></div></div>
                                                                                                        </div>
                                                                                                    
                                                                                                        
                                                                                                        @php
                                                                                                        $total_value = 0;
                                                                                                        foreach($result->CarrierDetails->RiskAssessmentDetails->Operation->Infractions as $Infraction){
                                                                                                            if (isset($Infraction->Points)) {
                                                                                                                $total_value += $Infraction->Points;
                                                                                                            }
                                                                                                        }
                                                                                                        
                                                                                                        // dd($total_value);
                                                                                                        
                                                                                                        @endphp
                                                                                                        <hr class="my-2" />
                                                                                                        @foreach($result->CarrierDetails->RiskAssessmentDetails->Operation->Infractions as $Infraction)                
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1">{{$Infraction->RuleText}}</div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5 mb-1"><div style="max-width: 120px;"><span>{{$Infraction->RiskLevel}}</span><span class="float-right">{{$Infraction->Points}}</span></div></div>
                                                                                                        </div> 
                                                                                                        @endforeach
                                                                                                        
                                                                                                        
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1"></div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><hr style="margin: 0 -3px 0 0;  width: 53px; border-top: 1px solid #4E5155;" /></div></div>
                                                                                                        </div>
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1"></div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span class="float-right"> {{$total_value}}</span></div></div>
                                                                                                        </div>
                                                                                                        <br><br>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                    
                                                                                                    {{-- Infraction Operations End --}}
                                                                                                    
                                                                                                    {{-- Infraction Safety Start --}}
                                                                                                    
                                                                                                    @if($result->CarrierDetails->RiskAssessmentDetails->Safety->OverallRating == 'Acceptable' )    
                                                                                                    <div class="mb-4">
                                                                                                        <div class="row mb-2 font-weight-bold">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                                                                                                <h5 class="mb-0 d-inline-block mr-2">Safety</h5>
                                                                                                                
                                                                                                                
                                                                                                                <h4 class="mb-0 d-inline-block">
                                                                                                                    <span class="text-success">{{$result->CarrierDetails->RiskAssessmentDetails->Safety->OverallRating}}</span>
                                                                                                                    
                                                                                                                </h4>
                                                                                                            </div>
                                                                                                            {{-- <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span>Risk Level</span><span class="float-right">Points</span></div></div> --}}
                                                                                                        </div>
                                                                                                        <hr class="my-2" />
                                                                                                        <div class="mb-1">All rules passed</div>
                                                                                                        
                                                                                                        <br><br>
                                                                                                        
                                                                                                        @else 
                                                                                                        <div class="row mb-2 font-weight-bold">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                                                                                                <h5 class="mb-0 d-inline-block mr-2">Safety</h5>
                                                                                                                
                                                                                                                
                                                                                                                <h4 class="mb-0 d-inline-block">
                                                                                                                    <span class="text-danger">{{$result->CarrierDetails->RiskAssessmentDetails->Safety->OverallRating}}</span>
                                                                                                                    
                                                                                                                </h4>
                                                                                                            </div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span>Risk Level</span><span class="float-right">Points</span></div></div>
                                                                                                        </div>
                                                                                                        
                                                                                                        
                                                                                                        @php
                                                                                                        $total_value = 0;
                                                                                                        foreach($result->CarrierDetails->RiskAssessmentDetails->Safety->Infractions as $Infraction){
                                                                                                            if (isset($Infraction->Points)) {
                                                                                                                $total_value += $Infraction->Points;
                                                                                                            }
                                                                                                        }
                                                                                                        
                                                                                                        // dd($total_value);
                                                                                                        
                                                                                                        @endphp
                                                                                                        <hr class="my-2" />
                                                                                                        @foreach($result->CarrierDetails->RiskAssessmentDetails->Safety->Infractions as $Infraction)                
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1">{{$Infraction->RuleText}}</div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5 mb-1"><div style="max-width: 120px;"><span>{{$Infraction->RiskLevel}}</span><span class="float-right">{{$Infraction->Points}}</span></div></div>
                                                                                                        </div> 
                                                                                                        @endforeach
                                                                                                        
                                                                                                        
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1"></div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><hr style="margin: 0 -3px 0 0;  width: 53px; border-top: 1px solid #4E5155;" /></div></div>
                                                                                                        </div>
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1"></div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span class="float-right"> {{$total_value}}</span></div></div>
                                                                                                        </div>
                                                                                                        <br><br>
                                                                                                    </div>
                                                                                                    @endif
                                                                                                    
                                                                                                    {{-- Infraction Safety End --}}
                                                                                                    
                                                                                                    {{-- Infraction Other Start --}}
                                                                                                    
                                                                                                    @if($result->CarrierDetails->RiskAssessmentDetails->Other->OverallRating == 'Acceptable' )    
                                                                                                    <div class="mb-4">
                                                                                                        <div class="row mb-2 font-weight-bold">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                                                                                                <h5 class="mb-0 d-inline-block mr-2">Other</h5>
                                                                                                                
                                                                                                                
                                                                                                                <h4 class="mb-0 d-inline-block">
                                                                                                                    <span class="text-success">{{$result->CarrierDetails->RiskAssessmentDetails->Other->OverallRating}}</span>
                                                                                                                    
                                                                                                                </h4>
                                                                                                            </div>
                                                                                                            {{-- <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span>Risk Level</span><span class="float-right">Points</span></div></div> --}}
                                                                                                        </div>
                                                                                                        <hr class="my-2" />
                                                                                                        <div class="mb-1">All rules passed</div>
                                                                                                        
                                                                                                        <br><br>
                                                                                                        
                                                                                                        @else 
                                                                                                        <div class="row mb-2 font-weight-bold">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                                                                                                <h5 class="mb-0 d-inline-block mr-2">Other</h5>
                                                                                                                
                                                                                                                
                                                                                                                <h4 class="mb-0 d-inline-block">
                                                                                                                    <span class="text-danger">{{$result->CarrierDetails->RiskAssessmentDetails->Other->OverallRating}}</span>
                                                                                                                    
                                                                                                                </h4>
                                                                                                            </div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span>Risk Level</span><span class="float-right">Points</span></div></div>
                                                                                                        </div>
                                                                                                        
                                                                                                        
                                                                                                        @php
                                                                                                        $total_value = 0;
                                                                                                        foreach($result->CarrierDetails->RiskAssessmentDetails->Other->Infractions as $Infraction){
                                                                                                            if (isset($Infraction->Points)) {
                                                                                                                $total_value += $Infraction->Points;
                                                                                                            }
                                                                                                        }
                                                                                                        
                                                                                                        // dd($total_value);
                                                                                                        
                                                                                                        @endphp
                                                                                                        <hr class="my-2" />
                                                                                                        @foreach($result->CarrierDetails->RiskAssessmentDetails->Other->Infractions as $Infraction)                
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1">{{$Infraction->RuleText}}</div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5 mb-1"><div style="max-width: 120px;"><span>{{$Infraction->RiskLevel}}</span><span class="float-right">{{$Infraction->Points}}</span></div></div>
                                                                                                        </div> 
                                                                                                        @endforeach
                                                                                                        
                                                                                                        
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1"></div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><hr style="margin: 0 -3px 0 0;  width: 53px; border-top: 1px solid #4E5155;" /></div></div>
                                                                                                        </div>
                                                                                                        <div class="row">
                                                                                                            <div class="col-7 col-sm-8 col-md-8 col-lg-9 col-xl-7 mb-1"></div>
                                                                                                            <div class="col-5 col-sm-4 col-md-4 col-lg-3 col-xl-5"><div style="max-width: 120px;"><span class="float-right"> {{$total_value}}</span></div></div>
                                                                                                        </div>
                                                                                                        <br><br>
                                                                                                    </div>
                                                                                                    @endif  
                                                                                                    
                                                                                                    {{-- Infraction Other End --}}
                                                                                                    
                                                                                                    <script type="text/javascript">
                                                                                                        $('#btn1').on('click', function(){
                                                                                                            $('#goalModal').modal('show');
                                                                                                        })
                                                                                                        
                                                                                                        $('#btn2').on('click', function(){
                                                                                                            $('#goalModal').modal('hide');
                                                                                                        })
                                                                                                        $('#closeModal').on('click', function(){
                                                                                                            $('#goalModal').modal('hide');
                                                                                                        })
                                                                                                        
                                                                                                    </script>
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
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card custom-card">
                                        <div class="card-body padding-none">
                                            <dl class="row mb-4">
                                                <dt class="col-12 col-md-3">
                                                    Operating Status
                                                </dt>
                                                <dd class="col-12 col-md-3">
                                                    <span class="font-weight-bold">{{ $result->CarrierDetails->Operation->operatingStatus }}</span>
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
                                                {{-- <div class="card">
                                                    <div class="card-header">
                                                        <a class="btn" data-bs-toggle="collapse" href="#Authority">
                                                            Authority
                                                            <i class="bx bx-plus"></i>
                                                        </a>
                                                    </div>
                                                    <div id="Authority" class="collapse" data-bs-parent="#profile_accordion">
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
                                                                                    <span class="text-danger font-weight-bold"></span>
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
                                                                                        <a href="{{url('admin/carrier/getDocument?name=',$Certificate->BlobName)}}" class="view_cart">View Cert <i class="bx bx-file"></i></a>
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
                                                                                        <a href="#" class="view_cart">View Cert <i class="bx bx-file"></i></a>
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
                                                                                        <a href="#" class="view_cart">View Cert <i class="bx bx-file"></i></a>
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
                                                                                        <a href="#" class="view_cart">View Cert <i class="bx bx-file"></i></a>
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
                                                                <div class="col-12 col-sm-6 col-lg-4 mb-4">
                                                                    <div class="card border-secondary">
                                                                        <div class="card-body">
                                                                            <h5>MCS-150 Most Recent</h5>
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
                                                                            <h5>Latest Review</h5>
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
                                                @endforeach --}}
                                                
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
                                                                                {{ $result->CarrierDetails->Safety->ratingDate }}
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
                                                                                {{ $result->CarrierDetails->Review->mcs150MileYear}}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">MCS-150 Miles:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Review->mcs150Miles}}
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
                                                                                {{ $result->CarrierDetails->Review->reviewType}}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Review Date:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Review->reviewDate}}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Document:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Review->reviewDocNum}}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Reported Miles:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Review->reviewMiles}}
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
                                                                <h4>U.S. Inspection Results</h4>
                                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                                    
                                                                    <div class="card border-secondary">
                                                                        <div class="card-body">
                                                                            <h5>U.S. Inspection Results</h5>
                                                                            <div>
                                                                                <span class="font-weight-bold">Total Inspections:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectTotalUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Total IEP Inspections:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectTotalUS }}
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                                    <div class="card border-secondary">
                                                                        <div class="card-body">
                                                                            <h5>Crash Results</h5>
                                                                            <div>
                                                                                <span class="font-weight-bold">Fatal:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Crash->crashFatalUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Injury:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Crash->crashInjuryUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Tow:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Crash->crashTowUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Total:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Crash->crashTotalUS }}
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                                    <div class="card border-secondary">
                                                                        <div class="card-body">
                                                                            <h5>Inspections</h5>
                                                                            <div>
                                                                                <span class="font-weight-bold">Vehicle:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectVehUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Driver:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectDrvUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Hazmat:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectHazUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">IEP:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectIEPUS }}
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                                    <div class="card border-secondary">
                                                                        <div class="card-body">
                                                                            <h5>Out of Service</h5>
                                                                            <div>
                                                                                <span class="font-weight-bold">Vehicle:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectVehOOSUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Driver:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectDrvOOSUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Hazmat:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectHazOOSUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">IEP:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectIEPOOSUS }}
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                                    <div class="card border-secondary">
                                                                        <div class="card-body">
                                                                            <h5>Out of Service %</h5>
                                                                            <div>
                                                                                <span class="font-weight-bold">Vehicle:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectVehOOSPctUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Driver:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectDrvOOSPctUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Hazmat:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectHazOOSPctUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">IEP:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectIEPOOSPctUS }}
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                                    <div class="card border-secondary">
                                                                        <div class="card-body">
                                                                            <h5>National Average</h5>
                                                                            <div>
                                                                                <span class="font-weight-bold">Vehicle:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectTotalUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Driver:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectTotalUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Hazmat:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectTotalUS }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">IEP:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectTotalUS }}
                                                                            </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="col-12 col-sm-6 col-lg-6 mb-6">
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
                                                                </div> --}}
                                                                
                                                                
                                                            </div>
                                                            <h4>Canada Inspection Loads</h4>
                                                            <div class="row">
                                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                                    <div class="card border-secondary">
                                                                        <div class="card-body">
                                                                            <h5>Canadian Inspection Results</h5>
                                                                            <div>
                                                                                <span class="font-weight-bold">Total Inspections:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectTotalCAN }}
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                                    <div class="card border-secondary">
                                                                        <div class="card-body">
                                                                            <h5>Crash Results</h5>
                                                                            <div>
                                                                                <span class="font-weight-bold">Fatal:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Crash->crashFatalCAN }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Injury:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Crash->crashInjuryCAN }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Tow:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Crash->crashTowCAN }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Total:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Crash->crashTotalCAN }}
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                                    <div class="card border-secondary">
                                                                        <div class="card-body">
                                                                            <h5>Inspections</h5>
                                                                            <div>
                                                                                <span class="font-weight-bold">Vehicle:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectVehCAN }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Driver:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectDrvCAN }}
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                                    <div class="card border-secondary">
                                                                        <div class="card-body">
                                                                            <h5>Out of Service</h5>
                                                                            <div>
                                                                                <span class="font-weight-bold">Vehicle:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectVehOOSCAN }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Driver:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectDrvOOSCAN }}
                                                                            </div>
                                                                            
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-sm-6 col-lg-6 mb-6">
                                                                    <div class="card border-secondary">
                                                                        <div class="card-body">
                                                                            <h5>Out of Service %</h5>
                                                                            <div>
                                                                                <span class="font-weight-bold">Vehicle:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectVehOOSPctCAN }}
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">Driver:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->Inspection->inspectDrvOOSPctCAN }}
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
                                                                                Carrier
                                                                            </div>
                                                                            <div>
                                                                                <span class="font-weight-bold">DOT Status:</span>&nbsp;
                                                                                {{ $result->CarrierDetails->dotNumber->status }}
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
                                                                                            <span class="cargo_not_present">Beverages</span> 
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoBeverages == 'Yes' )
                                                                                            <strong class="cargo_color">Beverages</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoDryBulk == 'No' )
                                                                                            <span class="cargo_not_present">Commodities Dry Bulk</span>  
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoDryBulk == 'Yes' )
                                                                                            <strong class="cargo_color">Commodities Dry Bulk</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->hazmatIndicator == 'No' )
                                                                                            <span class="cargo_not_present">Hazmat Indicator</span>  
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->hazmatIndicator == 'Yes' )
                                                                                            <strong class="cargo_color">Hazmat Indicator</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoGenFreight == 'No' )
                                                                                            <span class="cargo_not_present">General Freight</span>
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoGenFreight == 'Yes' )
                                                                                            <strong class="cargo_color">General Freight</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoHousehold == 'No' )
                                                                                            <span class="cargo_not_present">Household</span>
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoHousehold == 'Yes' )
                                                                                            <strong class="cargo_color">Household</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoMetal == 'No' )
                                                                                            <span class="cargo_not_present">Metal</span> 
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoMetal == 'Yes' )
                                                                                            <strong class="cargo_color">Metal</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoMotorVeh == 'No' )
                                                                                            <span class="cargo_not_present">Motor Vehicles</span>  
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoMotorVeh == 'Yes' )
                                                                                            <strong class="cargo_color">Motor Vehicles</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoDriveTow == 'No' )
                                                                                            <span class="cargo_not_present">Driveway/Towaway</span>  
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoDriveTow == 'Yes' )
                                                                                            <strong class="cargo_color">Driveway/Towaway</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoLogPole == 'No' )
                                                                                            <span class="cargo_not_present">Logs, Poles, Beams, Lumber</span>
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoLogPole == 'Yes' )
                                                                                            <strong class="cargo_color">Logs, Poles, Beams, Lumber</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoBldgMaterial == 'No' )
                                                                                            <span class="cargo_not_present">Building Materials</span>
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoBldgMaterial == 'Yes' )
                                                                                            <strong class="cargo_color">Building Materials</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoMobileHome == 'No' )
                                                                                            <span class="cargo_not_present">Mobile Homes</span> 
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoMobileHome == 'Yes' )
                                                                                            <strong class="cargo_color">Mobile Homes</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoMachLarge == 'No' )
                                                                                            <span class="cargo_not_present">Machinery, Large Objects</span>  
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoMachLarge == 'Yes' )
                                                                                            <strong class="cargo_color">Machinery, Large Objects</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoProduce == 'No' )
                                                                                            <span class="cargo_not_present">Fresh Produce</span>  
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoProduce == 'Yes' )
                                                                                            <strong class="cargo_color">Fresh Produce</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoLiqGas == 'No' )
                                                                                            <span class="cargo_not_present">Liquids, Gas</span>
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoLiqGas == 'Yes' )
                                                                                            <strong class="cargo_color">Liquids, Gas</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoIntermodal == 'No' )
                                                                                            <span class="cargo_not_present">Intermodal Containers</span>
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoIntermodal == 'Yes' )
                                                                                            <strong class="cargo_color">Intermodal Containers</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoPassengers == 'No' )
                                                                                            <span class="cargo_not_present">Passengers</span> 
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoPassengers == 'Yes' )
                                                                                            <strong class="cargo_color">Passengers</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoOilfield == 'No' )
                                                                                            <span class="cargo_not_present">Oilfield Equipment</span>  
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoOilfield == 'Yes' )
                                                                                            <strong class="cargo_color">Oilfield Equipment</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoLivestock == 'No' )
                                                                                            <span class="cargo_not_present">Livestock Containers</span>  
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoLivestock == 'Yes' )
                                                                                            <strong class="cargo_color">Livestock Containers</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoGrainfeed == 'No' )
                                                                                            <span class="cargo_not_present">Grain, Feed, Hay</span>
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoGrainfeed == 'Yes' )
                                                                                            <strong class="cargo_color">Grain, Feed, Hay</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoCoalcoke == 'No' )
                                                                                            <span class="cargo_not_present">Coal/Coke</span>
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoCoalcoke == 'Yes' )
                                                                                            <strong class="cargo_color">Coal/Coke</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <hr>
                                                                                <div class="col-md-3">
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoMeat == 'No' )
                                                                                            <span class="cargo_not_present">Meat</span> 
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoMeat == 'Yes' )
                                                                                            <strong class="cargo_color">Meat</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoGarbage == 'No' )
                                                                                            <span class="cargo_not_present">Garbage, Refuse, Trash</span>  
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoGarbage == 'Yes' )
                                                                                            <strong class="cargo_color">Garbage, Refuse, Trash</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoUSMail == 'No' )
                                                                                            <span class="cargo_not_present">US Mail</span>  
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoUSMail == 'Yes' )
                                                                                            <strong class="cargo_color">US Mail</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoChemicals == 'No' )
                                                                                            <span class="cargo_not_present">Chemicals</span>
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoChemicals == 'Yes' )
                                                                                            <strong class="cargo_color">Chemicals</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoUtilities == 'No' )
                                                                                            <span class="cargo_not_present">Utility</span>
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoUtilities == 'Yes' )
                                                                                            <strong class="cargo_color">Utility</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoRefrigerated == 'No' )
                                                                                            <span class="cargo_not_present">Refrigerated Food</span> 
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoRefrigerated == 'Yes' )
                                                                                            <strong class="cargo_color">Refrigerated Food</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoPaperProd == 'No' )
                                                                                            <span class="cargo_not_present">Paper Products</span>  
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoPaperProd == 'Yes' )
                                                                                            <strong class="cargo_color">Paper Products</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoFarmSupplies == 'No' )
                                                                                            <span class="cargo_not_present">Farm Supplies</span>  
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoFarmSupplies == 'Yes' )
                                                                                            <strong class="cargo_color">Farm Supplies</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoConstruction == 'No' )
                                                                                            <span class="cargo_not_present">Construction</span>
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoConstruction == 'Yes' )
                                                                                            <strong class="cargo_color">Construction</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoWaterwell == 'No' )
                                                                                            <span class="cargo_not_present">Water Well</span>
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoWaterwell == 'Yes' )
                                                                                            <strong class="cargo_color">Water Well</strong>
                                                                                            @endif
                                                                                        </span>&nbsp;
                                                                                    </div>
                                                                                    
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <div>
                                                                                        <span class="font-weight-bold">
                                                                                            @if($result->CarrierDetails->Cargo->cargoOther == 'No' )
                                                                                            <span class="cargo_not_present">Other</span> 
                                                                                            @endif
                                                                                            @if($result->CarrierDetails->Cargo->cargoOther == 'Yes' )
                                                                                            <strong class="cargo_color">Other</strong>
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
                                                            
                                                            
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End card-->
                                                
                                                
                                                
                                                <!-- start new here  ****************************************-->
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                        <?php } ?> 
                       
                </div>
            </div>
        </div>    
                            
                            <!--end page wrapper -->   
                            
                            
                            @include('backend.common.footer')
                            @endsection