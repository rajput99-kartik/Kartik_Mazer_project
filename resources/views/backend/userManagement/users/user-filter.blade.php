@if(count($data) > 0)
@foreach ($data as $key => $user)



								<?php 

								

									//  $encoded_id = base64_encode($user['id']);

									 $encoded_id = base64_encode($user->id);

									//$encoded_id = $user['id'];

									if($user['status'] == '1'){

										$checked = 'checked';

									} else{

										$checked = '';

									}



									$status_content = '<input type="checkbox"  class="stat_check" '.$checked.' data-toggle="toggle" cat='.$encoded_id.'>';

									if($user->user_type=='super_admin'){

									    

									}else{

								?>

                                    <tr>

                                        

                                        <td class="user-img">

                                            @if(count($user->userDetailsdata))

                                            @foreach($user->userDetailsdata as $userdetails)

                                            @if($userdetails->profile_pic)

                                            <img class="user-mainpic" src="{{url('public/user-pic').'/'.$userdetails->profile_pic}}">

                                            @else

                                            <img class="user-pic" src="{{url('public/backend/assets/images/dummy-user.png')}}">

                                            @endif

                                            @endforeach

                                            @else

                                            <img class="user-pic" src="{{url('public/backend/assets/images/dummy-user.png')}}">

                                            @endif

                                        </td>

                                        <td>{{ $user->name }}</td>

                                        <td>{{ $user->email }}</td>



                                        <td>

                                            @if(!empty($user->getRoleNames()))

                                            @foreach($user->getRoleNames() as $v)

                                            <div class="badge rounded-pill text-white bg-<?php if($v=='Agent'){echo "danger";}elseif($v=='superadmin'){echo "success"; }else{echo "info";} ?> p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i>{{ $v }}</div>

                                            @endforeach

                                            @endif

                                        </td>

										<td class="switch-btn">

											{!! $status_content !!}

											<span class="switch"></span>

										</td>
										

                                        <td class="action action_tooltip">
                                            @php
                                                $userid = base64_encode($user->id); 
                                            @endphp

										    <a href="{{ route('users.show',$userid) }}"> 
										    <button type="button" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>
											<a href="{{ route('users.edit',$userid) }}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a>

											<form method="POST" action="{{route('users.destroy',$user->id )}}" accept-charset="UTF-8" style="display:inline">
												@csrf

												<input name="_method" type="hidden" value="DELETE">
												<button onclick="return confirm('Are You Sure Delete This Record..!')" class="btn btn-outline-danger btn-sm radius-30 px-4" type="submit"><i class="bx bx-trash"></i><span class="tooltip">Delete</span></button>

											</form>
										</td>

                                    </tr>

                                    <?php } ?>
                                @endforeach
                                @else
                                        <tr style="background-color: #edf3f652;">
                                            <td colspan="6">
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-4 not-found">
                                                        <img src="{{url('/public/backend/assets/images/message.png')}}">
                                                        <h4>You User Found.</h4>
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif