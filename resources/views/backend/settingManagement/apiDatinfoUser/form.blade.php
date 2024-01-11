@extends('backend.layouts.master')
@section('title', 'DAT User Management')
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
        
        .nav.nav-tabs.email_tabs {
          display: block;
        }
        .nav.nav-tabs.email_tabs a {
          margin-top: 16px;
          padding: 12px !important;
        }
        #setting_nav {
            margin-top: 23px;
        }
    </style>
    <!--start page wrapper -->

    <div class="page-wrapper">

        <div class="page-content">




            <ul class="nav nav-tabs">

                <li class="pending_approval active"><a href="{{ url('/admin/setting/dat/user/api') }}" data-toggle="tab"
                        aria-expanded="true">All Dat Users</a>

                </li>

               
            </ul>



            <!--end breadcrumb-->

            @if ($message = Session::get('success'))
                <div class="alert alert-success">

                    <p>{{ $message }}</p>

                </div>
            @endif
            
            @if ($message = Session::get('error'))
                <div class="alert alert-danger">

                    <p>{{ $message }}</p>

                </div>
            @endif

            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card radius-10 w-100">
                                
                                <ul class="nav nav-tabs user_tab" id="setting_nav">
                                    <li class="nav-item" role="presentation">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#dattoken" aria-selected="false" tabindex="-1" role="tab"><i class="fadeIn animated bx bx-code"></i> Dat Api Token</a>
                                  </li>
                                     @can('manager-user')
                                      
                                  <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#dat" aria-selected="true" role="tab"><i class="fadeIn animated bx bx-code"></i> Dat Api</a>
                                  </li>
                                  @endcan
                                  
                                  @can('manager-user')
                                  <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#MyCarrierPacket" aria-selected="false" tabindex="-1" role="tab"><i class="fadeIn animated bx bx-code"></i> MyCarrierPacket</a>
                                  </li>
                                  <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#carriertoken" aria-selected="false" tabindex="-1" role="tab"><i class="fadeIn animated bx bx-code"></i> MyCarrierPacket Token</a>
                                  </li>
                                  <li class="nav-item" role="presentation">
                                    <a class="nav-link" data-bs-toggle="tab" href="#schedule" aria-selected="false" tabindex="-1" role="tab"><i class="fadeIn animated bx bx-code"></i> Schedule Cron Job</a>
                                  </li>
                                  @endcan
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            
                            <div class="card radius-10 w-100">
                                <div class="card-header border-bottom bg-transparent">
    								<div class="d-flex align-items-center">
    									<div>
    										<h5 class="mb-0">DAT</h5>
    									</div>
    									<div class="dropdown options ms-auto">
    										<div class="dropdown-toggle dropdown-toggle-nocaret" data-bs-toggle="dropdown">
    										  <i class="bx bx-dots-horizontal-rounded"></i>
    										</div>
    										<ul class="dropdown-menu">
    										  <!--<li><a class="dropdown-item" href="javascript:;">Action</a></li>-->
    										  <!--<li><a class="dropdown-item" href="javascript:;">Another action</a></li>-->
    										  <!--<li><a class="dropdown-item" href="javascript:;">Something else here</a></li>-->
    										</ul>
    									  </div>
    								</div>
							    </div>
                                <div class="row panel-body form-horizontal">
                                    <div class="tab-content">
                                        <div class="tab-pane container fade" id="dat" role="tabpanel">
                                            <form method="post" action="{{ url('/admin/setting/user/dat/api').'/'.$id }}" id="dat">
                                                @csrf
                                                <?php
                                                    $adminAccesToken = App\Models\DAT::where('user_id', 1)->first();
                                                ?>
                                                <div class="row form-group">
                                                    <!--<label class="col-lg-3 control-label">Username  <span class="text-danger">*</span></label>-->
                                                    <div class="col-lg-9">
                                                        <input type="hidden" name="username" class="form-control" value="{{ isset($adminAccesToken->username) ? $adminAccesToken->username : null }}" required="">
                                                        <input type="hidden" value="{{ $id }}" name="uid">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <!--<label class="col-lg-3 control-label">Password  <span class="text-danger">*</span></label>-->
                                                    <div class="col-lg-9">
                                                        <input type="hidden" name="password" class="form-control" value="{{ isset($adminAccesToken->password) ? $adminAccesToken->password : null }}" required="">
                                                    </div>
                                                </div>
                                                
                                                
                                                
                                                <div class="row form-group">
                                                    <!--<label class="col-lg-3 control-label">Admin Access-Token  <span class="text-danger">*</span></label>-->
                                                    <div class="col-lg-9">
                                                    <input type="hidden" name="accessToken" class="form-control" value="{{ isset($adminAccesToken->accessToken) ? $adminAccesToken->accessToken : null }}"
                                            required="">
                                                    </div>
                                                </div>
                                                
                                                <div class="row form-group">
                                                    <label class="col-lg-3 control-label">Dat Username  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                    <input type="text" name="username_dat" class="form-control" value="{{ isset($Dat->username_dat) ? $Dat->username_dat : null }}"
                                            required="">
                                                            <input type="hidden" value="1" name="datathid">
                                                    </div>
                                                </div>
                                                
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane active show container fade" id="dattoken" role="tabpanel">
                                            <form method="post" action="{{url('admin/setting/userdattoken/info')}}"
                                                    id="dattokendata">
                                                    @csrf
                                                    <?php
                                                    $uid = Auth::id();
                                                    $packet_user = DB::table('dat_login')->where('user_id',$id)->first();
                                                    ?>
                                                    <div class="row form-group">

                                                        <div class="col-lg-12">
                                                            <div class="row form-group">
                                                                <label class="col-lg-2 control-label">Token <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="col-lg-8" class="copy-text">


                                                                    <input type="hidden" name="token"
                                                                        class="form-control"
                                                                        value="{{ isset($packet_user->token) ? $packet_user->token : Null }} ">
                                                                        
                                                                        <input type="hidden" id="uidi" value="{{$id}}" name="usertokenid">
                                                                </div>

                                                            </div>
                                                            <div class="row form-group">
                                                                <!--<label class="col-lg-2 control-label">Access Token <span-->
                                                                <!--        class="text-danger">*</span></label>-->
                                                                <div class="col-lg-8" class="copy-text">
                                                                    <input type="hidden" name="accessToken"
                                                                        class="form-control"
                                                                        value="{{ isset($packet_user->accessToken) ? $packet_user->accessToken : Null }}">
                                                                    <input type="hidden" name="password"
                                                                        class="form-control"
                                                                        value="{{ isset($packet_user->password) ? $packet_user->password : Null}}">
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row form-group">
                                                        <div class="col-lg-12">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            <button id="tbutton" class="btn btn-info">Clear </button>
                                                        </div>
                                                    </div>
                                                </form>
                                        </div>
                                        
                                        <div class="tab-pane container fade" id="MyCarrierPacket" role="tabpanel">
                                                <form method="post"
                                                    action="{{ url('/admin/setting/api-carrierpacket') }}"
                                                    id="MyCarrierPacket">
                                                    @csrf
                                                    <div class="row form-group">
                                                        <!--<label class="col-lg-3 control-label">Username <span-->
                                                        <!--        class="text-danger">*</span></label>-->
                                                        <div class="col-lg-9">
                                                            <input type="hidden" name="username" class="form-control"
                                                                value="{{ $CarrierPacket->user_name }}" required="">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <!--<label class="col-lg-3 control-label">Password <span-->
                                                        <!--        class="text-danger">*</span></label>-->
                                                        <div class="col-lg-9">
                                                            <input type="hidden" name="password" class="form-control"
                                                                value="{{ $CarrierPacket->password }}" required="">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-lg-12">
                                                            <button type="submit" class="btn btn-primary">Save
                                                                Changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                        </div>


                                        <div class="tab-pane  container fade" id="carriertoken" role="tabpanel">
                                            <form method="post" action="{{ url('/admin/setting/carriertoken') }}"
                                                    id="carriertokendata">
                                                    @csrf

                                                    <?php
                                                    $packet_user = DB::table('mycarrier_packets')->first();
                                                    ?>
                                                    <div class="row form-group">
                                                        <!--<label class="col-lg-3 control-label">Token <span-->
                                                        <!--        class="text-danger">*</span></label>-->
                                                        <div class="col-lg-9">
                                                            <input type="hidden" name="grant_type" class="form-control"
                                                                value="{{ isset($packet_user->token) ? $packet_user->token : Null }}">
                                                        </div>
                                                    </div>


                                                    <div class="row form-group">
                                                        <div class="col-lg-12">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
                                                            <button id="mycarrierpacketbutton" class="btn btn-info">Clear
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                        </div>
                                        
                                        
                                        <div class="tab-pane  container fade" id="schedule">
                                            <form method="post" action="{{url('/admin/schedule')}}" id="schedule">
                                                @csrf

                                                 <?php 
                                                        $packet_user = DB::table('dat_login')->first();
                                                ?>
                                                <div class="row form-group">
                                                    <!--<label class="col-lg-3 control-label">Token <span class="text-danger">*</span></label>-->
                                                    <div class="col-lg-9">
                                                        <input type="hidden" name="grant_type" class="form-control" value="{{$packet_user->token}}" >
                                                    </div>
                                                </div>

                                                
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                       
                                                    </div>
                                                </div>
                                            </form>
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
    
    <script>
        
         <script>
        $(document).ready(function(){
            $('#tbutton').click(function(){				
                if(confirm("Want to clear & update DAT token")){
                    /*Clear all input type="text" box*/
                    $('#dattokendata input[type="text"]').val('');
                
                }					
            });
        });
    </script>


    <script>
        $(document).ready(function(){
            $('#mycarrierpacketbutton').click(function(){
                if(confirm("Want to clear & update MyCarrierPacket token")){
                    /*Clear all input type="text" box*/
                    $('#carriertokendata input[type="text"]').val('');
                }					
            });
        });
    </script>
    </script>
    <!--end page wrapper -->
    @include('backend.common.footer')

@endsection
