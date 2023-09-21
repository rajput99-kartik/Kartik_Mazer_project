<td colspan="11" class="padd_none">
						        <table class="table mb-0 no-footer sub_table">
                                    <tr>
            						 
            						 <th>Pickup</th>
            						 <th>Truck</th>
            						 <th>F/P</th>
            						 <th>DH–O</th>
            						 <th>Origin</th>
            						 <th>Trip</th>
            						 <th>Destination</th>
            						 <th>DH–D</th>
            						 <th>Company</th>
            						 <th>Contact</th>
            						 <th>Length</th>
            						 <th>Weight</th>
            						 
            					  </tr>
                                
                                  <?php 
                                        $i=1;
						          
                                         //foreach($results as $result){
                                            foreach($results->matches as $result_data){


												$trucID = explode("+", $result_data->matchId);
												//echo '<pre>'; print_r($result_data);
                                        ?>

                                    <tr class="childtoggle" value="{{ $trucID[1] }}">
                                        
                                        <td><?php if($result_data->availability->earliestWhen){ echo date('m/d', strtotime($result_data->availability->earliestWhen)); } ?> </td>
                                        
                                        <td>{{ $result_data->matchingAssetInfo->equipmentType }}</td>
                                        <td>
                                            <?php if($result_data->matchingAssetInfo->capacity->truck->fullPartial == 'FULL'){ echo 'F'; } if($result_data->matchingAssetInfo->capacity->truck->fullPartial == 'Partial'){ echo 'P'; } ?>
                                        </td>
                                        
                                        <td>{{ $result_data->originDeadheadMiles->miles }}</td>
                                        <td>
                                            {{ $result_data->matchingAssetInfo->origin->city }}, {{ $result_data->matchingAssetInfo->origin->stateProv }}
                                        </td>
                                        <td>
                                            <?php if(isset( $result_data->tripLength)){ echo $result_data->tripLength->miles; } ?>
                                        </td>
                                        <td>
                                            <?php if(isset($result_data->matchingAssetInfo->destination->place)){ echo $result_data->matchingAssetInfo->destination->place->city.', '.$result_data->matchingAssetInfo->destination->place->stateProv; } ?>
                                        </td>
                                        <td>
                                            <?php if(isset( $result_data->destinationDeadheadMiles)){ echo $result_data->destinationDeadheadMiles->miles; } ?>
                                        </td>
                                        <td style="word-wrap:break-word;">{{ $result_data->posterInfo->companyName }}</td>
                                        <td style="word-wrap:break-word;">
                                            <?php if(isset($result_data->posterInfo->contact->phone)){ echo $result_data->posterInfo->contact->phone; } ?>
                                            <?php if(isset($result_data->posterInfo->contact->email)){ echo $result_data->posterInfo->contact->email; } ?>
                                        </td>
                                        <td>{{ $result_data->matchingAssetInfo->capacity->truck->availableLengthFeet }}</td>
                                        <td>{{ $result_data->matchingAssetInfo->capacity->truck->availableWeightPounds }}</td>
                                        
                                    </tr>
                                    
                                    
                               
                                    <tr class="odd hide-row {{ $trucID[1] }}" id="">
            							<td colspan="14">
                                    		<div class="td-flex">
                                    		    <div class="flex-colum">
                                        			<dt>Ref:</dt>
                                        			<dd class="refId"></dd>
                                        			<dt>Commodity:</dt>
                                        			<dd class="commodity" title=""></dd>
                                        		</div>
                                        		<div class="flex-colum">
                                        			<dt>Comments 1:</dt>
                                        			<dd class="comments1" title=""></dd>
                                        
                                        			<dt>Comments 2:</dt>
                                        			<dd class="comments2" title=""></dd>
                                        		</div>
                                        		<div class="flex-colum">
                                        			<dt class="">Docket:{{ isset($result_data->posterDotIds->carrierMcNumber) ? $result_data->posterDotIds->carrierMcNumber : null  }}</dt>
                                        			<dd class="docket ">
                                        				<a href="#" class="trackLink" track-link-category="Company" target="_blank"><?php if(isset($result_data->posterDotIds->dotNumber)){ echo 'DOT'.$result_data->posterDotIds->dotNumber; } ?></a> 
                                        			</dd>
                                        			<dd class="bonding">
                                        				<span class="is-tia-member" title="TIA Member"></span>
                                        				<span class="is-assurable" title="Assure It">
                                                            <a href="urls?Category=Assurance&amp;MatchId=DS343Y4E&amp;RegistryId=S.782078.306596" class="trackLink" track-link-category="Assurable" target="_blank"></a>
                                        				</span>
                                        			</dd>
                                        		</div>
                                        		<div class="flex-colum dat-img">
                                        			<img src="{{url('/public/backend/assets/images/truck-search.jpeg')}}">
                                        		</div>
                                        		
                                    		</div>
                                	    </td>
            						</tr>
                                    

                                    <?php
                                    }
                                  //}
                                ?>

                                
                                </table>
						    </td>
<script>
    $(document).ready(function(){
        $("table.sub_table tr").click(function(){
            $("."+$(this).attr('value')).slideToggle();
        })
    })
</script>