@php
								$i = 0;
								@endphp
								@if(count($shipment) > 0)
                                @foreach($shipment as $key => $companies_res)
                                        <tr>
                                            <?php 
                                              $cid = $companies_res->companies_id ;
                                              $dc =  App\Models\Company::where('id',$cid)->select('company_name')->first();

											  
											  $carrier_name = $companies_res->carrier_id ;

											  $carrier_name =  App\Models\Carriers::where('id',$carrier_name)->select('c_company_name')->first();


											  $uidi = $companies_res->user_id ;
											  $agent_name =  App\Models\User::where('id',$uidi)->select('name')->first();
                                              



											//   pick
											  $pickid = $companies_res->id ;

											  $pick_date =  App\Models\Shipmentpick::where('shipment_id',$pickid)->select('p_ready')->first();


											//   drop

												$dropid = $companies_res->id ;

											  $drop_date =  App\Models\Shipmentdrop::where('shipment_id',$dropid)->select('d_ready')->first();

                                            ?>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $companies_res->id }}</td>
                                            <td>{{ isset($dc['company_name']) ? $dc['company_name'] : null }}</td>
                                            {{-- <td>{{ $carrier_name['c_company_name'] }}</td> --}}
                                            <td>{{ isset($carrier_name['c_company_name']) ? $carrier_name['c_company_name'] : Null }}</td>
                                            <td>{{ isset($agent_name['name']) ? $agent_name['name'] : Null }}</td>
                                            <td>{{ isset($pick_date['p_ready']) ? $pick_date['p_ready']: null}}</td>
											<td>{{isset($drop_date['d_ready']) ? $drop_date['d_ready'] : Null}}</td>
                                            <td>
											<input type="hidden" value="{{ $companies_res->id }}" id="shipment_id">
											
												<select class="form-control select2 {{$companies_res->shipment_statue}}" id="shipment_status_change" style="width: 100%;">
														<option <?php if($companies_res->shipment_statue == 'Open'){ echo 'selected';} ?> value="Open">Open</option>
														<option value="Covered" <?php if($companies_res->shipment_statue == 'Covered'){ echo 'selected';} ?> >Covered</option>
														<option value="In-transit" <?php if($companies_res->shipment_statue == 'In-transit'){ echo 'selected';} ?> >In-transit</option>
														<option value="Delivered" <?php if($companies_res->shipment_statue == 'Delivered'){ echo 'selected';} ?> >Delivered</option>												
												</select>
                                            </td>
                                            <td class="action_tooltip">
                                                <a href="{{ url('admin/shipment/shipment-edit',base64_encode($companies_res->id) )}}"> 
                                                <button type="button" value="{{ $companies_res->id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>
                                                <a href="{{ url('admin/shipment/shipment-edit',base64_encode($companies_res->id) )}}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a>  
                                                
                                            </td>
                                        </tr>
                                @endforeach
                                        @else
                                        <tr style="background-color: #edf3f652;">
                                            <td colspan="9">
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4 not-found">
                                                        <img src="{{url('/public/backend/assets/images/message.png')}}">
                                                        <h4>You have no Shipment, yet.</h4>
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif