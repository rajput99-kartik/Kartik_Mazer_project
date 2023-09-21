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
                                        <strong>Company Details</strong>
                                        <div class="pull-right">
                                            <span data-placement="top" data-toggle="tooltip" title="" data-original-title="">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body" style="padding: 20px;">
                                    <form method="post" action="{{url('/admin/save-company-details')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company Name <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="company_name" class="form-control" value="{{isset($company_detaills->company_name) ? $company_detaills->company_name : Null}}">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Legal Name <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="text" name="company_legal_name" class="form-control" value="{{isset($company_detaills->company_legal_name) ? $company_detaills->company_legal_name : Null}}">
                                            </div>
                                        </div>
                                        <div class="row form-group company_logo">
                                            <label class="col-lg-3 control-label">Company Logo <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <input type="file" name="company_logo" class="form-control">
                                                @error('company_logo') <span style="display: block;" class="text text-danger">{{$message}}</span> @enderror
                                                <input type="hidden" name="old_logo" value="{{isset($company_detaills->company_logo) ? $company_detaills->company_logo : Null}}">
                                                
                                                <?php 
                                                
                                                    $clogo = isset($company_detaills->company_logo) ? $company_detaills->company_logo : Null
                                                ?>
                                                @if($clogo)
                                                    <img style="width: 100px;margin-top: 8px;" src="{{url('public/backend/assets/office')."/".$company_detaills->company_logo}}">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Contact Person </label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="{{isset($company_detaills->contact_person) ? $company_detaills->contact_person : Null}}" name="contact_person">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company Address <span class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                            <textarea class="form-control" name="company_address">{{isset($company_detaills->company_address) ? $company_detaills->company_address : Null}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">City</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="{{isset($company_detaills->company_city) ? $company_detaills->company_city : Null}}" name="company_city">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Zip Code </label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="{{isset($company_detaills->company_zip_code) ? $company_detaills->company_zip_code : Null}}" name="company_zip_code">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company Phone</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="{{isset($company_detaills->company_phone) ? $company_detaills->company_phone : Null}}" name="company_phone">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company Email</label>
                                            <div class="col-lg-9">
                                                <input type="email" class="form-control" value="{{isset($company_detaills->company_email) ? $company_detaills->company_email : Null}}" name="company_email">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company Website</label>
                                            <div class="col-lg-9">
                                                <input type="url" class="form-control" value="{{isset($company_detaills->company_domain) ? $company_detaills->company_domain : Null}}" name="company_domain">
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-lg-3 control-label">Company VAT</label>
                                            <div class="col-lg-9">
                                                <input type="text" class="form-control" value="{{isset($company_detaills->company_vat) ? $company_detaills->company_vat : Null}}" name="company_vat">
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