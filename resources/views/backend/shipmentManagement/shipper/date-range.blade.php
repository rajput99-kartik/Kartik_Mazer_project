@php
								$i = 0;
								@endphp
								@if(count($comp_data) > 0)
                                @foreach($comp_data as $companies_res)
                                
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ isset($companies_res->company_name) ? $companies_res->company_name : Null }}</td>
                                            <td style="width:120px">{{ strtoupper($companies_res->encode_title) }}</td>
                                            <td>{{ substr($companies_res->address, 0, 15).".." }}</td>
                                            <td>{{ isset($companies_res->shipper_state) ? $companies_res->shipper_state : Null }}</td>
                                            <td>{{ isset($companies_res->shipper_zipcode) ? $companies_res->shipper_zipcode : Null }}</td>
                                            <td>
                                                <div class="badge rounded-pill text-white bg-<?php if($companies_res->approved == 0){echo "danger"; }elseif($companies_res->approved == 2){echo "danger"; }elseif($companies_res->approved == 1){ echo 'success'; } ?> p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i><?php if($companies_res->approved == 0){echo "Pending"; }elseif($companies_res->approved == 1){ echo 'Approve'; }elseif($companies_res->approved == 2){ echo 'Dispprove'; } ?></div>
                                            </td>

                                            <td>
                                                {{-- 18/06/2022 3:40 AM --}}
                                                {{ date('m/d/Y', strtotime($companies_res->created_at))}}
                                                {{-- {{ date('Y-m-d', strtotime($companies_res->created_at))}} --}}
                                                {{-- {{ date('m-d-y', strtotime($companies_res->created_at))}} --}}
                                            </td>

                                            <td class="action_tooltip" style="<?php if($companies_res->approved == 2){ ?>width:180px<?php }else{ ?>width:100px<?php } ?>">
                                                {{-- <a href="{{ url('admin/shipper/view',$companies_res->id )}}"> 
                                                <button type="button" value="{{ $companies_res->companies_id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a> --}}
                                                <?php if($companies_res->approved == 2){ ?>

                                                <form method="POST" action="{{url('admin/shipper/requset/resend',base64_encode($companies_res->id) )}}" accept-charset="UTF-8" style="display:inline">
                                                <input name="_method" type="hidden" value="POST">
												@csrf
                                                <button onclick="return confirm('Are You Sure Re-send This Requets..!')" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="fadeIn animated bx bx-refresh"></i> <span class="tooltip">Re-send</span></button>
                                                </form>
                                                <?php } ?>
                                                <a href="{{ url('admin/shipper/edit',base64_encode($companies_res->id) )}}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a>
                                                <a href="{{ url('admin/shipper/delete',$companies_res->id )}}"> 
                                                <button type="button" value="{{ url('admin/shipper/delete',$companies_res->delete )}}" class="btn btn-outline-danger btn-sm radius-30 px-4" onclick="return confirm('Are You Sure Delete This Record..!')"><i class="bx bx-trash"></i><span class="tooltip">Delete</span></button></a>
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
                                                        <h4> No Shipper created, yet.</h4>
                                                    </div>
                                                    <div class="col-md-4"></div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endif