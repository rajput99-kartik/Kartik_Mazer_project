@php
								$i = 0;
								@endphp
                                @foreach($comp_data as $companies_res)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $companies_res->company_name }}</td>
                                            <td>{{ $companies_res->encode_title }}</td>
                                            <td>{{ $companies_res->address }}</td>
                                            <td>{{ $companies_res->shipper_state }}</td>
                                            <td>{{ $companies_res->shipper_zipcode }}</td>
                                            <td>
                                                <div class="badge rounded-pill text-white bg-<?php if($companies_res->approved == 0){echo "danger"; }elseif($companies_res->approved == 1){ echo 'success'; } ?> p-2 text-uppercase px-3"><i class='bx bxs-circle me-1'></i><?php if($companies_res->approved == 0){echo "Pending"; }elseif($companies_res->approved == 1){ echo 'Approve'; } ?></div>
                                            </td>
                                            <td class="action_tooltip">
                                                <a href="{{ url('admin/shipper/view',$companies_res->id )}}"> 
                                                <button type="button" value="{{ $companies_res->id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>
                                                <a href="{{ url('admin/shipper/edit',$companies_res->id )}}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> <span class="tooltip">Edit</span></a>
                                                <a href="{{ url('admin/shipper/delete',$companies_res->id )}}"> 
                                                <button type="button" value="{{ url('admin/shipper/delete',$companies_res->id )}}" class="btn btn-outline-danger btn-sm radius-30 px-4" onclick="return confirm('Are You Sure Delete This Record..!')"><i class="bx bx-trash"></i><span class="tooltip">Delete</span></button></a>
                                            </td>
                                        </tr>
                                @endforeach