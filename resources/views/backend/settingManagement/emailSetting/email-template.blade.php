@extends('backend.layouts.master')
@section('title','Email Template Setting')
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
                              <div class="tab-pane container fade active show" id="email_template">
                                  <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>Email Templates</strong>
                                    </div>
                                </div>
                                <div class="row panel-body form-horizontal">
                                    <ul class="nav nav-tabs email_tabs">
                                      <li class="nav-item">
                                        <a class="nav-link active" data-bs-toggle="tab" href="#activate_acc">Activate Account</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#change_email">Change Email</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#forgot_email">Forgot password?</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#reg_email">Register Email</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#reset_pass">Reset Password</a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" data-bs-toggle="tab" href="#wel_email">Welcome Email</a>
                                      </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active show container fade" id="activate_acc">
                                            <form method="post" action="#" id="activate_acc">
                                                <div class="row form-group">
                                                    <label class="col-lg-12 control-label">Subject  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="subject" class="form-control" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-lg-12 control-label">Email Body  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-12">
                                                        <textarea class="emil_body" name="emil_body">&lt;p&gt;Initial value.&lt;/p&gt;</textarea>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <button type="submmit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <div class="tab-pane container fade" id="change_email">
                                            <form method="post" action="#" id="change_email">
                                                <div class="row form-group">
                                                    <label class="col-lg-12 control-label">Change Email Subject  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="subject" class="form-control" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-lg-12 control-label">Email Body  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-12">
                                                        <textarea class="emil_body" name="emil_body">&lt;p&gt;Initial value.&lt;/p&gt;</textarea>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <button type="submmit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <div class="tab-pane container fade" id="forgot_email">
                                            <form method="post" action="#" id="forgot_email">
                                                <div class="row form-group">
                                                    <label class="col-lg-12 control-label">Forgot Email Subject  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="subject" class="form-control" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-lg-12 control-label">Email Body  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-12">
                                                        <textarea class="emil_body" name="emil_body">&lt;p&gt;Initial value.&lt;/p&gt;</textarea>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <button type="submmit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <div class="tab-pane container fade" id="reg_email">
                                            <form method="post" action="#" id="reg_email">
                                                <div class="row form-group">
                                                    <label class="col-lg-12 control-label">Register Email Subject  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="subject" class="form-control" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-lg-12 control-label">Email Body  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-12">
                                                        <textarea class="emil_body" name="emil_body">&lt;p&gt;Initial value.&lt;/p&gt;</textarea>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <button type="submmit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <div class="tab-pane container fade" id="reset_pass">
                                            <form method="post" action="#" id="reset_pass">
                                                <div class="row form-group">
                                                    <label class="col-lg-12 control-label">Reset Password Subject  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="subject" class="form-control" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-lg-12 control-label">Email Body  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-12">
                                                        <textarea class="emil_body" name="emil_body">&lt;p&gt;Initial value.&lt;/p&gt;</textarea>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <button type="submmit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <div class="tab-pane container fade" id="wel_email">
                                            <form method="post" action="#" id="wel_email">
                                                <div class="row form-group">
                                                    <label class="col-lg-12 control-label">Welcome Email Subject  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-12">
                                                        <input type="text" name="subject" class="form-control" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-lg-12 control-label">Email Body  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-12">
                                                        <textarea class="emil_body" name="emil_body">&lt;p&gt;Initial value.&lt;/p&gt;</textarea>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <button type="submmit" class="btn btn-primary">Save Changes</button>
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
@include('backend.common.footer')
@endsection