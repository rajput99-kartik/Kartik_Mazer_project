@extends('backend.layouts.master')
@section('title','Setting')
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
		    @if(session()->has('success'))
		    <div class="alert alert-success">
			    <p>{{ session()->get('success') }}</p>
			</div>
		    @endif
		    
		    
		        @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
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
                              <div class="tab-pane container active" id="company_detail">
                                  <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>Manage Ip Address</strong>
                                        <div class="pull-right">
                                            <span data-placement="top" data-toggle="tooltip" title="" data-original-title="">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 20px;">
                                    <ul class="nav nav-tabs email_tabs">
                                      <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#allIp">All Ip</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#addNew">Add New</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#unauthorized ">Unauthorized Ip</a>
                                      </li>
                                    </ul>
                                    
                                    <div class="tab-content">
                                        <div class="tab-pane active show container fade" id="allIp">
                                            <table class="table">
                                                <thead class="table-light">
                                                    
                                                    <tr>
                                                        <!--<th style="">No</th>-->
                                                        <th style="width:auto;">Sr. No.</th>
                                                        <th style="width:auto;">Office</th>
                                                        <th style="width:auto;">Ip Address</th>
                                                        <th style="width:auto;">Status</th>
                                                        <th style="width:180px;">Date</th>
                                                    </tr>
                                                </thead>
                                                
                                                    @php
                                                        $iplists = App\Models\IpChecker::orderBy('id', 'desc')->get();
                                                        //echo $iplist;
                                                        $i = 0;
                                                       // $ip = $this->server->get('REMOTE_ADDR');
                                                    @endphp
                                                    
                                                    @foreach($iplists as $iplist)
                                                    
                                                    <?php 
								
                    									// $encoded_id = base64_encode($user['id']);
                    									 $encoded_id = base64_encode($iplist->id);
                    									//$encoded_id = $user['id'];
                    									if($iplist->whitelisted == '1'){
                    										$checked = 'checked';
                    									} else{
                    										$checked = '';
                    									}
                    
                    									$status_content = '<input type="checkbox"  class="stat_check" '.$checked.' data-toggle="toggle" cat='.$encoded_id.'>';
                    								
                    								?>
                                                    <tr>
                                                       <td>{{ ++$i }}</td>
                                                       <td>{{$iplist->office}}</td>
                                                       <td>{{$iplist->ip_address}}</td>
                                                       
                                                       <td class="switch-btn">
                											{!! $status_content !!}
                											<span class="switch"></span>
                										</td>
                										
                										<td>
                										    {{ date('d M, Y, H:i', strtotime( $iplist->created_at))}}
                										</td>
                                                        
                                                    </tr>
                                                
                                                    @endforeach
                                            </table>
                                        </div>
                                        <div class="tab-pane container fade" id="addNew">
                                            <form method="post" action="{{url('admin/ipchecker/add')}}">
                                                @csrf
                                                <div class="row form-group">
                                                    <label class="col-lg-3 control-label">Office Name <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="office" class="form-control" required>
                                                    </div>
                                                </div>
                                                
                                                <div class="row form-group">
                                                    <label class="col-lg-3 control-label">Ip Address <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="ip_address" class="form-control" required>
                                                        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Save Changes</button>
                                                    </div>
                                                </div>
                                                
                                            </form>
                                        </div>
                                        
                                        <div class="tab-pane container fade" id="unauthorized">
                                            <table class="table">
                                                <thead class="table-light">
                                                    
                                                    <tr>
                                                        <!--<th style="">No</th>-->
                                                        <th style="width:auto;">Sr. No.</th>
                                                        <th style="width:auto;">Email</th>
                                                        <!--<th style="width:auto;">Password</th>-->
                                                        <th style="width:auto;">Ip Address</th>
                                                        <th style="width:auto;">Browser</th>
                                                        <th style="width:100px;">Date</th>
                                                    </tr>
                                                </thead>
                                                    @php
                                                        $authorizeusers = App\Models\AuthorizeIpChecker::orderBy('id', 'desc')->get();
                                                        //echo $iplist;
                                                        $i = 0;
                                                       // $ip = $this->server->get('REMOTE_ADDR');
                                                    @endphp
                                                    @foreach($authorizeusers as $iplist)
                                                    <tr>
                                                        <td>{{ ++$i }}</td>
                                                       <td>{{$iplist->email}}</td>
                                                       <!--<td>{{$iplist->password}}</td>-->
                                                       <td>{{$iplist->ipaddress}}</td>
                                                       <td>{{$iplist->location}}</td>
                                                       <td>
                										    {{ date('d M, Y, H:i', strtotime( $iplist->created_at))}}
                										</td>
                                                    </tr>
                                                    @endforeach
                                            </table>
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
	
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script>
        $(function() {
            $(document).on('change','.stat_check', function() {
                var curr    = $(this).prop('checked');
                var cat     = $(this).attr('cat');
                $.ajax({
                    type:"post",
                    url:"{{ url('admin/ipcheckerstatus') }}",
                    data: {'curr': curr, 'cat':cat},
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
        
        $(document).ready(function () {
			$('.table').DataTable();
		});
    </script>
@include('backend.common.footer')
@endsection