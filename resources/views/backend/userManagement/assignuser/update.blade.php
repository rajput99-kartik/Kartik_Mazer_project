@extends('backend.layouts.master')
@section('title','Dashboard')
@section('content')



        
        <div class="page-wrapper">
			<div class="page-content">
   
                <ul class="nav nav-tabs">
                    {{-- <li class="pending_approval"><a href="{{url('/admin/users')}}" data-toggle="tab" aria-expanded="true">All Users</a>
                    </li> --}}
    
                    

                    <li class="all_leave active"><a href="javascript::void(0)" data-toggle="tab" aria-expanded="false">Edit User</a>
                        </li>
                </ul>
                <div class="row">
                    
					<div class="col-xl-12 mx-auto">
						<div class="card border-primary" style="padding: 20px 0px;">
							<div class="card-body p-3 col-xl-9 mx-auto">

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

								<div class="card-title d-flex align-items-center pb-2">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary ">Update Agent User</h5>
								</div>
								<!-- <hr> -->
								
								            @php
                                                $userid = base64_encode($userdata->id); 
                                            @endphp
								<div class="row g-3">
                                
                                <form action="{{url('admin/assignuser/edit'.'/'.$userdata->id)}}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Name:<span class="text text-danger required">*</span></strong>
                                                <input type="text" name="name" id="" value="{{$userdata->name}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Email: <span class="text text-danger required">*</span></strong>
                                                <input type="email" name="email" id="" value="{{$userdata->email}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Password: <span class="text text-danger required">*</span></strong>
                                                <i class="bx bx-show" id="show_password"></i>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="current-password">
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Confirm Password: <span class="text text-danger required">*</span></strong>
                                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation"  autocomplete="current-password">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Phone : <span class="text text-danger required">*</span></strong>
                                                <input type="number" name="phone" placeholder="Phone No" class="form-control" value="{{ isset($userdata['phone']) ? $userdata['phone']: old('phone') }}" minlength="10" maxlength="10">
                                            </div>
                                        </div>

                                        <input type="hidden" name="userid" value="{{$userid}}">
                                            
                                    </div>

                                        <div class="col-12 pt-4 text-center">
										    <button type="submit" class="btn btn-primary">Submit</button>
									    </div>
                                    </div>
								    </div>
                                </form>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $("select.form-control").find("option:contains('superadmin')").hide();
                
                $(".create_user").submit(function(){
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
        </script>
        
@include('backend.common.footer')
@endsection
