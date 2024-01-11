@extends('backend.layouts.master')
@section('title', 'DAT Management')
@section('content')
    <style>
        h2#swal2-title {
            font-size: 20px;
            margin: 0px;
        }

        div#swal2-html-container {
            font-size: 14px;
            margin: 10px 0px 0px;
        }

        .swal2-popup.swal2-modal.swal2-loading.swal2-show {
            width: 270px;
            padding-top: 10px;
        }

        .swal2-loader {
            border-color: #80c427 rgba(0, 0, 0, 0) #80c427 rgba(0, 0, 0, 0);
        }
    </style>


    <style>
        .agmain li {
            display: none;
        }

        .show_age {
            display: block !important;
        }

        div#agency_detail_edit .card-header {
            background: none;
            border: none;
        }

        div#agency_detail_edit .card-header h3 {
            color: #1e55bf !important;
            font-weight: 600;
        }
    </style>
    <!--start page wrapper -->

    <div class="page-wrapper">

        <div class="page-content">

           



            <ul class="nav nav-tabs">

                <li class="pending_approval "><a href="{{ url('/admin/setting/dat/user/api') }}" data-toggle="tab"
                        aria-expanded="true">All Dat Users</a>
                </li>


                <li class="pending_approval"><a href="{{ url('/admin/setting/dat/show/admin') }}" data-toggle="tab"
                        aria-expanded="true">Deactivated DAT User</a>
                </li>

                <li class="pending_approval active"><a href="{{ url('/admin/setting/dat/show/self') }}" data-toggle="tab" aria-expanded="false">Activated DAT User</a>
                </li>

            </ul>



            <!--end breadcrumb-->

            @if ($message = Session::get('success'))
                <div class="alert alert-success">

                    <p>{{ $message }}</p>

                </div>
            @endif

            <div class="card">

                <div class="card-body">

                    <div class="table-responsive">
                        <form method="post" action="{{ url('admin/multipleusersdelete') }}" id="deleteuser">
                            {{ csrf_field() }}
                            <input style="display:none;" class="btn btn-primary delete_user btn-sm" type="submit"
                                name="submit" value="Delete All Users" />
                            <table class="table mb-0" id="carrier_table">

                                <thead class="table-light">
                                    <tr>

                                        <th>Name</th>
                                        <th>Email</th>
                                        
                                        <th>DAT User</th>
                                        <?php
                                            $activeuser = DB::table('users')->where('dat_user_auth_status', '1')->first();
                                        ?>
                                        <th style="width:200px;" class="switch-btn">
           <!--                                 <input type="checkbox" class="stat_check dat_u_status" <?php //if(isset($activeuser->dat_user_auth_status)==1){ echo "checked"; } ?> id="0" data-toggle="toggle">-->
											<!--<span class="switch"></span>-->
											Dat Status
										</th>
                                        <th style="width:134px;">Actions</th>
                                    </tr>
                                </thead>

                                <tbody id="user_data">

                                    @foreach ($Userdata as $key => $user)
                                    <tr>
                                        <td class="copy-text">{{ $user->name }}</td>
                                        <td class="copy-text">{{ $user->email }}</td>
                                        @php
                                            $userid = $user->id;
                                            $data = App\Models\DAT::where('user_id', $userid)->first();
                                            // dd($data);
                                            $abc = '';
                                            if ($data) {
                                                $abc = $data->username_dat;
                                            } else {
                                                $abc = 'No User Name';
                                            }
                                            
                                        @endphp
                                        
                                        
                                        <td class="copy-text">{{ $abc }}</td>
                                        <td class="switch-btn">
											<input type="checkbox" class="stat_check dat_u_status" <?php if($user->dat_user_auth_status==1){ echo "checked"; } ?> data-toggle="toggle" id="{{$userid}}">
											<span class="switch"></span>
										</td>

                                    @php

                                        $encoded_id = base64_encode($userid);
									    $mainiduser = base64_decode($encoded_id);
									    
									     //$encoded_id = $userid;
									@endphp
                                        <td class="action action_tooltip">

                                            <!--<a href="{{ route('users.show', $userid) }}">-->
                                            <!--    <button type="button" class="btn btn-outline-info btn-sm radius-30 px-4"><i-->
                                            <!--            class="bx bx-show"></i><span-->
                                            <!--            class="tooltip">View</span></button></a>-->
                                            <a href="{{ url('admin/setting/user/dat/api') . '/' . $encoded_id }}"
                                                class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i
                                                    class="bx bx-edit"></i> <span class="tooltip">Edit</span></a>

                                            <a href="{{url('/admin/setting/dat/delete').'/'.$encoded_id}}" class="btn btn-danger btn-sm radius-30 px-4" onclick="return confirm('Are You Sure Delete This Record..! ')">
                                                        <i class="bx bx-trash"></i><span class="tooltip">Delete</span></a>

                                        </td>
                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>

                    </div>

                </div>

            </div>

        </div>



    </div>

    <!--end page wrapper -->
            
            
            <script>

                $(function() {
                    $(document).on('change','.dat_u_status', function() {
                        var curr    = $(this).prop('checked');
                        var id     = $(this).attr('id');
                        $.ajax({
                            type:"post",
                            url:"{{ url('admin/setting/dat/user/status/api') }}",
                            data: {'curr':curr, 'id':id},
                            success:function(resp){
                                if(resp.status == 'true'){
                                    swal(resp.msg,'','success');
                                } else{
                                    swal(resp.msg,'','warning');
                                }
                            }
                        })
            
                    })
            
                })
        
            </script>
    @include('backend.common.footer')
@endsection
