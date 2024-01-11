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
                            <ul class="nav nav-tabs user_tab">
                              <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#company_detail"><i class="fadeIn animated bx bx-info-circle"></i> Company Details</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#email_setting"><i class="fadeIn animated bx bx-envelope-open"></i> Email Setting</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#email_template"><i class="fadeIn animated bx bx-edit"></i> Email Template</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#api_manage"><i class="fadeIn animated bx bx-code"></i> Manage Api</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#"><i class="fadeIn animated bx bx-printer"></i> Invoice Settings</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#"><i class="bx bx-home-circle"></i> Dashboard Settings</a>
                              </li>
                            </ul>
                        </div>
                        <div class="col-md-9 usertab_txt">
                            <div class="tab-content">
                              <div class="tab-pane container active" id="company_detail">
                                  <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>Company Details</strong>
                                        <div class="pull-right">
                                            <span data-placement="top" data-toggle="tooltip" title="" data-original-title="">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 20px;">
                                    <form method="post" action="#">
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company Name <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="company_name" class="form-control" value="" required="">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Legal Name <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="company_legal_name" class="form-control" value="" required="">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Contact Person </label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="" name="contact_person">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company Address <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                            <textarea class="form-control" name="company_address" required=""></textarea>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">City</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="" name="company_city">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Zip Code </label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="" name="company_zip_code">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company Phone</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="" name="company_phone">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company Email</label>
                                            <div class="col-lg-9">
                                                <input type="email" class="form-control" value="" name="company_email">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company Website</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="" name="company_domain">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company VAT</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="" name="company_vat">
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
                              </div>
                              <div class="tab-pane container fade" id="email_setting">
                                  <div class="panel-heading">
                                        <div class="panel-title">
                                            <strong>Email Settings</strong>
                                        </div>
                                    </div>
                                <div class="row panel-body form-horizontal">
                                    <form method="post" action="#">
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company Email  <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="company_email" class="form-control" value="" required="">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Use Postmark <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="checkbox" name="postmark" id="postmark" class="" value="" required="">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Email Protocol <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <select name="protocol" required="" class="form-control">
                                                    <option value="mail">PHP mail</option>
                                                    <option value="smtp" selected="selected">SMTP</option>
                                                    <option value="sendmail">Send Mail</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Smtp Host</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="" name="smtp_host">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Smtp User </label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="" name="company_zip_code">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Smtp Password</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="" name="smtp_pass">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Smtp Port</label>
                                            <div class="col-lg-9">
                                                <input type="email" class="form-control" value="" name="smtp_port">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Email Encryption</label>
                                            <div class="col-lg-9">
                                                <select name="smtp_encryption" class="form-control">
                                                    <option value="">None</option>
                                                    <option value="ssl">SSL
                                                    </option>
                                                    <option value="tls" selected="selected">TLS
                                                    </option>
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
                                    <form method="post" action="#">
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Email Address  <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="company_email" class="form-control" value="" required="">
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
                              </div>
                              <div class="tab-pane container fade" id="email_template">
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
                              
                              <div class="tab-pane container fade" id="api_manage">
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
                                        <a class="nav-link" data-bs-toggle="tab" href="#MyCarrierPacket">MyCarrierPacket</a>
                                      </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active show container fade" id="dat">
                                            <form method="post" action="#" id="dat">
                                                <div class="row form-group">
                                                    <label class="col-lg-3 control-label">Username  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="username" class="form-control" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-lg-3 control-label">Password  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="password" class="form-control" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-lg-12">
                                                        <button type="submmit" class="btn btn-primary">Save Changes</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        
                                        <div class="tab-pane container fade" id="MyCarrierPacket">
                                            <form method="post" action="#" id="MyCarrierPacket">
                                                <div class="row form-group">
                                                    <label class="col-lg-3 control-label">Username  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="username" class="form-control" value="" required="">
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-lg-3 control-label">Password  <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input type="text" name="password" class="form-control" value="" required="">
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