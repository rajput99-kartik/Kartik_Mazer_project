@extends('backend.layouts.master')
@section('title','Api Setting')
@section('content')

<style>
    .agmain li {
        display: none;
    }

    .show_age {
        display: block !important;
    }
</style>
    <div class="page-wrapper">
		<div class="page-content">
		    
		    @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif


            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
			<ul class="nav nav-tabs">
                <li class="pending_approval"><a href="{{url('/admin/dashboard')}}" data-toggle="tab" aria-expanded="true">Dashboard</a>
                </li>

                <li class="all_leave active"><a href="javascript:void(0);" data-toggle="tab" aria-expanded="false">Setting</a>
                    </li>
            </ul>
			
			<div class="card setting_view">
			    <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            @include('backend.settingManagement.nav-sidebar')
                        </div>
                        <div class="col-md-9 usertab_txt">
                            <div class="tab-content">
                              
                              <div class="tab-pane container fade active show" id="api_manage">
                                  <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>Manage Api</strong>
                                    </div>
                                </div>
                                <div class="row panel-body form-horizontal">
                                    <ul class="nav nav-tabs email_tabs">
                                      <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#dat">Dat Api</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#dattoken">Dat Api Token</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#MyCarrierPacket">MyCarrierPacket</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#carriertoken">MyCarrierPacket Token</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#schedule">Schedule Cron Job</a>
                                      </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active show container fade" id="dat">
                                            <form method="post" action="{{url('/admin/setting/api-DatSave')}}" id="dat">
                                                <div class="row form-group">
                                                    <label class="col-lg-3 control-label">Username  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="username" class="form-control" value="{{ $Dat->username }}" required="">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-lg-3 control-label">Password  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="password" class="form-control" value="{{ $Dat->password }}" required="">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <div class="tab-pane  container fade" id="dattoken">
                                            <form method="post" action="{{url('/admin/setting/dottoken')}}" id="dattokendata">
                                                @csrf
                                                <?php 
                                                        $packet_user = DB::table('dat_login')->first();
                                                ?>
                                                <div class="row form-group">
                                                    <div class="col-lg-9">
                                                        <div class="row form-group">
                                                            <label class="col-lg-3 control-label">Token  <span class="text-danger">*</span></label>
                                                            <div class="col-lg-9">
                                                                
                                                                <input type="text" name="token" class="form-control" value="{{$packet_user->token}}">
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-lg-3 control-label">Access Token  <span class="text-danger">*</span></label>
                                                            <div class="col-lg-9">
                                                                 <input type="text" name="accessToken" class="form-control" value="{{$packet_user->accessToken}}" >
                                                                 <input type="hidden" name="password" class="form-control" value="{{$packet_user->password}}" >
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
                                        
                                        <div class="tab-pane container fade" id="MyCarrierPacket">
                                            <form method="post" action="{{url('/admin/setting/api-carrierpacket')}}" id="MyCarrierPacket">
                                                <div class="row form-group">
                                                    <label class="col-lg-3 control-label">Username  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="username" class="form-control" value="{{ $CarrierPacket->user_name }}" required="">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-lg-3 control-label">Password  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="password" class="form-control" value="{{ $CarrierPacket->password }}" required="">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>


                                        <div class="tab-pane  container fade" id="carriertoken">
                                            <form method="post" action="{{url('/admin/setting/carriertoken')}}" id="carriertokendata">
                                                @csrf

                                                <?php 
                                                        $packet_user = DB::table('mycarrier_packets')->first();
                                                ?>
                                                <div class="row form-group">
                                                    <label class="col-lg-3 control-label">Token <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="grant_type" class="form-control" value="{{$packet_user->token}}" >
                                                    </div>
                                                </div>

                                                
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                         <button id="mycarrierpacketbutton" class="btn btn-info">Clear </button>
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
                                                    <label class="col-lg-3 control-label">Token <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="grant_type" class="form-control" value="{{$packet_user->token}}" >
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
	</div>

    <script type="text/javascript">
        CKEDITOR.replaceAll( 'emil_body' );
    </script>
    
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
@include('backend.common.footer')
@endsection