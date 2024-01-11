
						
						@php $i=1;
						@endphp
						@if(count($user_loads) > 0)
							@foreach($user_loads as $user_load)
    						
    					<tr class="odd">
							
							<td>{{ $i++ }}</td>
							<td class="copy-text">{{ $user_load->ref_no }}</td>
							<td class="copy-text">{{ $user_load->post_date }}</td>
							<td class="copy-text">{{ $user_load->load_state_origin }}</td>
							<td class="copy-text">{{ $user_load->load_city_desti }}</td>
							<td class="copy-text">{{ $user_load->equipments }}</td>
							<td>{{ $user_load->full_partial_tl_ltl }}</td>
							
							
							@php
								$user =  App\Models\User::where('id',$user_load['user_id'])->first();
								$name= isset($user['name']) ? $user['name'] : null;
							@endphp
							<td>{{ucfirst($name)}}</td>
							
							
							<?php
								
								$status= $user_load->load_status;
								
								$date_pick= explode("T",$user_load->dat_pick_date);
								$date_pick1= strtotime($date_pick['0']);
								$today= strtotime(date('Y-m-d'));
								$lstatus= '';
								if($today > $date_pick1){
									$lstatus = 'Expire'; 
								}else{
									if($status == 1){
											$lstatus = 'Delete'; 
									}else{
										$lstatus = 'Active';
									}
								}
							?>
							<td>{{ $lstatus }}</td>
							<!--<td>{{ date('d M, Y', strtotime($user_load->created_at) )}}</td>-->
							<td>{{ date('Y/m/d', strtotime($user_load->created_at) )}}</td>
    						<td style="width: 80px;" class="action_tooltip">
								<input type="hidden" value="{{ $user_load->load_dat_id }}" id="load_dat_id">
								
								<button type="button" class="btn btn-outline-secondary btn-sm radius-30 px-4" id="load_update_form_btn"><i class="bx bx-edit"></i><span class="tooltip">View</span></button>
								
								
							</td> 
    					  </tr>
						  
							@endforeach
							@else
							<tr style="background-color: #edf3f652;">
                                <td colspan="11">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 not-found">
                                            <img src="https://crmonline.co.in/public/backend/assets/images/message.png">
                                            <h4>No Data, yet.</h4>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </td>
                            </tr>
							@endif
