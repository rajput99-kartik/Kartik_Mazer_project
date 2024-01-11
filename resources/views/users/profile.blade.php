@extends('backend.layouts.master')

@section('title','User Management')

@section('content')

<style>

    input[type="submit"] {

        border-radius: 2px;

    }

</style>

    <div class="page-wrapper">

        <div class="page-content">

            

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

            

			@if ($message = Session::get('success'))
			<div class="alert alert-success">
			<p>{{ $message }}</p>
			</div>
			@endif

            

            <!--<ul class="nav nav-tabs">-->

            <!--    <li class="pending_approval"><a href="{{url('/admin/dashboard')}}" data-toggle="tab" aria-expanded="true">Dashboard </a>-->

            <!--    </li>-->

            <!--    <li class="pending_approval active"><a href="javascript::void(0)" data-toggle="tab" aria-expanded="true">Edit Profile </a>-->

            <!--    </li>-->

            <!--</ul>-->

            <div class="bg-white" style="margin-bottom: 40px;">
                <div class="row">

                    <div class="col-md-3 border-right text-center" style="padding-top: 60px;">
                        <form method="post" action="{{url('/admin/save-profile')}}" enctype="multipart/form-data">
						@csrf

                        <label class="profile-img pic-main">
    				        <div class="bg-primary" style="background: none !important;">

    							<?php 

    								$img = '1';
    								if (!empty($userdetail->profile_pic)) {

    									$imga = $userdetail->profile_pic;
    									$img = url('public/user-pic/').'/'.$imga;

    								}else{
    									$img = ADMIN_FACKIMG_PATH ;

    								}
    							?>

    					{{-- <img src="{{ url('public/user-pic').'/'.$userdetail->profile_pic}}" alt="Admin" class="rounded-circle p-1" width="110"> --}}

    					<img src="{{ $img }}" alt="Admin" class="rounded-circle p-1" width="110">

    					</div>

    					<input type="file" name="profile_new_pic">
    					<input type="hidden" name="profile_pic" value="{{isset($userdetail->profile_pic) ? $userdetail->profile_pic : Null}}">
    					<i class="fadeIn animated bx bx-message-square-edit"></i>

    					</label>
    					<h4 style="color: #c1292e; margin: 10px 0px 20px;">{{isset($userdata->name) ? $userdata->name : null }}</h4>

    					<ul class="list-group list-group-flush" id="user_details">

							<!--<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">-->

							<!--	<h6 class="mb-0"><i class="bx bx-map"></i>Address</h6>-->

							<!--	<span class="text-secondary">{{isset($userdetail->address) ? $userdetail->address: Null}}</span>-->

							<!--</li>-->

							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

								<i class="bx bx-phone"></i> {{ isset($userdata->phone) ? $userdata->phone : null }}

							</li>

							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

								<i class="bx bx-envelope"></i>{{ isset($userdata->email) ? $userdata->email : null }}

							</li>

							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">

								<i class="bx bx-mobile"></i> {{isset($userdetail->mobile) ? $userdetail->mobile: Null}}

							</li>

						</ul>

                    </div>

                    <div class="col-md-5 border-right basic_dt">

                        <div class="p-3 py-5">

                            <h5 class="d-flex align-items-center mb-3 text text-primary" style="margin-bottom:30px !important;">Basic Detail</h5>

                                <div class="mb-3">

									<div class="col-sm-12">

										<h6 class="mb-0">Full Name</h6>

									</div>

									<div class="col-sm-12 text-secondary">

										<input type="text" class="form-control" value="{{isset($userdata->name) ? $userdata->name : null }}" name="username">

									</div>

								</div>

								<div class="mb-3">

									<div class="col-sm-12">

										<h6 class="mb-0">Email</h6>

									</div>

									<div class="col-sm-12 text-secondary">

										<input type="text" class="form-control" value="{{isset($userdata->email) ? $userdata->email : null }}" name="useremail" readonly>

									</div>

								</div>

								<div class="mb-3">

									<div class="col-sm-12">

										<h6 class="mb-0">Phone</h6>

									</div>

									<div class="col-sm-12 text-secondary">

										<input type="text" class="form-control" value="{{isset($userdata->phone) ? $userdata->phone : null }}" name="userphone" readonly>

									</div>

								</div>

								<div class="mb-3">

									<div class="col-sm-12">

										<h6 class="mb-0">Ext No.</h6>

									</div>

									<div class="col-sm-12 text-secondary">

										<input type="text" class="form-control" value="{{isset($userdetail->ext) ? $userdetail->ext : null }}" name="ext">

									</div>

								</div>

								<div class="mb-3">

									<div class="col-sm-12">

										<h6 class="mb-0">Mobile</h6>

									</div>

									<div class="col-sm-12 text-secondary">

										<input type="text" class="form-control" value="{{isset($userdetail->mobile) ? $userdetail->mobile :Null}}" name="mobile">

									</div>

								</div>

								<div class="mb-3">

									<div class="col-sm-12">

										<h6 class="mb-0">Address</h6>

									</div>

									<div class="col-sm-12 text-secondary">

										<input type="text" class="form-control" value="{{isset($userdetail->address) ? $userdetail->address: Null}}" name="address">

									</div>

								</div>

								<div class="mb-3">

									<div class="col-sm-3"></div>

									<div class="col-sm-12 text-secondary">

										<input type="submit" class="btn btn-primary px-4" value="Save Changes">

									</div>

								</div>

                        </div>

                        </form>

                    </div>

                    <div class="col-md-4">

                        <div class="p-3 py-5">

                            <h5 class="d-flex align-items-center mb-3 text text-primary" style="margin-bottom:30px !important;">Change Password</h5>

							<form method="post" action="{{url('/admin/user/change-password')}}" class="change_password">

							    <div class="mb-3">

									<div class="col-sm-12">

										<h6 class="mb-0">Password <span class="text text-danger required">*</span></h6>

									</div>

									<div class="col-sm-12 text-secondary form-group">

										<input type="password" class="form-control password" name="password" required>

										<i class="bx bx-show" id="show_password" style="right: 20px;"></i>

									</div>

								</div>

								<div class="mb-3">

									<div class="col-sm-12">

										<h6 class="mb-0">Confirm Password <span class="text text-danger required">*</span></h6>

									</div>

									<div class="col-sm-12 text-secondary">

										<input type="text" class="form-control confirm_pass" name="conf_pass">

									</div>

								</div>

								<div class="mb-3">

									<div class="col-sm-12 text-secondary">

									    <input type="hidden" class="form-control" name="userid" value="{{$userdata->id}}">

										<input type="submit" class="btn btn-primary px-4" value="Change Password">

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



        <script>
            $(document).ready(function(){
                $(".change_password").submit(function(){
                    if($("input.confirm_pass").val()==$("input.password").val()){

                    }else{
                        alert("Confirm Password Not Match");
                        return false;
                    }
                })

                $("i#show_password").click(function(){
                    if($(".password").attr('type')=='password'){
                        $(".password, .confirm_pass").prop('type', 'text');
                         $(this).addClass('bx-hide');
                         $(this).removeClass('bx-show');
                    }else{

                        $(".password, .confirm_pass").prop('type', 'password');
                        $(this).removeClass('bx-hide');
                        $(this).addClass('bx-show');

                    }
                   
                })

            })

            function readURL(input) {

              if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {

                  $('label.profile-img img').attr('src', e.target.result);
                  $('label.profile-img img').hide();
                  $('label.profile-img img').fadeIn(650);

                }
                reader.readAsDataURL(input.files[0]);
              }

            }

            $('label.profile-img input[type="file"]').change(function() {
              readURL(this);

            });

            
        </script>


@include('backend.common.footer')
@endsection
