<table class="table mb-0" id="intellivite-search">
    					<thead class="table-light">
    					  <tr>
    						 <th>Carrier</th>
    						 <th>Risk Assessment</th>
    						 <th>Packet Status</th>
    						 <th>Certificate of Insurance</th>
    						 <th>Fraud/Identity Theft</th>
                             <th>ACR / My Rating</th>
    					  </tr>
    					</thead>
    					<tr>
                            <td>
                                <div class="carrier-card">
                                
                                @foreach($results as $result)
                                    <div>
                                    {{ $result->CompanyName }}
                                    </div>
                                    <div>
                                    {{ $result->Street }}
                                    </div>
                                    <div>
                                        <strong>
                                            DOT Number:
                                        </strong>
                                        {{ $result->DotNumber }}
                                    </div>
                                    <div>
                                        <strong>
                                            Docket Number:
                                        </strong>
                                        {{ $result->DocketNumber }}
                                    </div>
                                </div>
                                <div class="block-option mb-2">
                                        <button class="btn btn-success btn-sm act-block-carrier" ><span class="fas fa-ban"></span> Block Carrier</button>
                                </div> 
                                <a href="{{url('admin/carrier/PreviewCarrierProfile/')}}/{{ $carrier_id }}" class="btn btn-primary btn-sm">Carrier Profile</a>
                                @if($result->Status == 'Not Invited')
                                <button type="button" id="EmailInvite" class="btn btn-primary" data-dot-number="{{ $result->DotNumber }}" data-docket-number="{{ $result->DocketNumber }}" >Intellivite</button>
                                @endif
                                <div class="mt-2" style="max-width: 500px;">
                                    <button type="button" class="btn btn-primary btn-sm">
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
        
                                            <span class="text-warning">{{ $result->RiskAssessment->Safety }}</span>
                                        </div>
                                            
                                            
                                        <div>
        
                                            <span class="font-weight-bold">{{ $result->Source }} infractions. </span>
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
            <a href="#">{{ $result->Status }}</a>
                            </td>
                            <td style="min-width: 170px;">
                                        @foreach($result->CertData->Certificates as $Certificate)
                                        @foreach($Certificate->Coverages as $Coverage )
                                        @if($Coverage->Type == 'General')
                                        <div>
                                            {{ $Coverage->Type }} / {{ $Coverage->CoverageLimit }}  
                                        </div>
                                        @endif
                                        @if($Coverage->Type == 'Auto')
                                        <div>
                                                {{ $Coverage->Type }} / {{ $Coverage->CoverageLimit }}  
                                        </div>
                                        @endif
                                        @if($Coverage->Type == 'WorkersCompensation')
                                        <div>
                                                {{ $Coverage->Type }} / {{ $Coverage->CoverageLimit }}  
                                        </div>
                                        @endif
                                        @if($Coverage->Type == 'Cargo Liability w/ Refer Breakdown')
                                        <div>
                                                {{ $Coverage->Type }} / {{ $Coverage->CoverageLimit }}  
                                        </div>
                                        @endif
                                        @endforeach
                                        @endforeach
                            </td>
                            <td>
                            {{ $result->PossibleFraud }}
                            </td>
                            <td>
                            <div class="carrierRatingContainer">
                                <div class="carrier-rating-box">
                                    <div class="text-nowrap">
                                        <div class="rating">
                                            <div style="width: 99%"></div>
                                        </div>
                                        <span>{{ $result->CarrierRating->AvgRatingText }}</span>
                                    </div>
                                    <div class="mt-1">{{ $result->CarrierRating->AvgRatingBasisText }}</div>
                                </div>

                            </div>
                            </td>
                            @endforeach
                        </tr>
					</table>