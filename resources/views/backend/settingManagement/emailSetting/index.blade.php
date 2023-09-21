@extends('backend.layouts.master')
@section('title','Email Setting')
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
                              <div class="tab-pane container fade active show" id="email_setting">
                                  <div class="panel-heading">
                                        <div class="panel-title">
                                            <strong>Email Settings</strong>
                                        </div>
                                    </div>
                                <div class="row panel-body form-horizontal">
                                    <form method="post" action="{{url('/admin/email-setting-action')}}">
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company Email  <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="company_email" class="form-control" value="{{isset($emailSetting->company_email) ? $emailSetting->company_email:null}}" required="">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Use Postmark</label>
                                            <div class="col-lg-9">
                                                <input type="checkbox" name="postmark" id="postmark" value="1" <?php if(isset($emailSetting->use_postmark) && $emailSetting->use_postmark==true){ echo "checked"; } ?>>
                                            </div>
                                        </div>
                                        <div class="postmark" style="display:none">
                                            <div class="row form-group">
                                                <label class="col-lg-3 control-label">Postmark API Key  <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="text" name="postmarkapi" class="form-control" value="{{isset($emailSetting->postmark_api) ? $emailSetting->postmark_api:null}}">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-lg-3 control-label">Postmark Email  <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input type="email" name="postmarkemail" class="form-control" value="{{isset($emailSetting->postmark_email) ? $emailSetting->postmark_email:null}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Email Protocol <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <select id="protocol" name="protocol" required="" class="form-control">
                                                    <option value="mail">PHP mail</option>
                                                    <option value="smtp">SMTP</option>
                                                    <option value="sendmail">Send Mail</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Smtp Host</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="{{isset($emailSetting->smtp_host) ? $emailSetting->smtp_host:null}}" name="smtp_host">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Smtp User </label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="{{isset($emailSetting->smtp_user) ? $emailSetting->smtp_user:null}}" name="smtp_user">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Smtp Password</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="{{isset($emailSetting->smtp_password) ? $emailSetting->smtp_password:null}}" name="smtp_pass">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Smtp Port</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="{{isset($emailSetting->smtp_port) ? $emailSetting->smtp_port:null}}" name="smtp_port">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Email Encryption</label>
                                            <div class="col-lg-9">
                                                <select id="email_encryption" name="email_encryption" class="form-control">
                                                    <option value="">None</option>
                                                    <option value="ssl">SSL</option>
                                                    <option value="tls">TLS</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label"></label>
                                            <div class="col-lg-9">
                                                <button type="submmit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>Sent Test Email</strong>
                                    </div>
                                </div>
                                <div class="row panel-body form-horizontal">
                                    <form method="post" action="{{ url('admin/setting/SendTestEmail') }}">
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Email Address  <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="email_to" class="form-control" value="" required="">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label"></label>
                                            <div class="col-lg-9">
                                                <button type="submit" class="btn btn-primary">Send</button>
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

    <script type="text/javascript">
        CKEDITOR.replaceAll( 'emil_body' );
        $("#protocol option[value='<?php if(isset($emailSetting->email_protocol)){ echo $emailSetting->email_protocol; } ?>']").prop('selected', true);
        $("#email_encryption option[value='<?php if(isset($emailSetting->email_encryption)){ echo $emailSetting->email_encryption; } ?>']").prop('selected', true);
        function showpostmark(){
            if($("#postmark").prop('checked')==true){
                $(".postmark").slideDown();
            }else{
                $(".postmark").slideUp();
            }
        }
        showpostmark();
        $("#postmark").click(function(){
            showpostmark();
        })
    </script>
@include('backend.common.footer')
@endsection