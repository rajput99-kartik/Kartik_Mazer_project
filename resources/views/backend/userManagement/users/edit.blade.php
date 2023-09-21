@extends('backend.layouts.master')
@section('title','Dashboard')
@section('content')



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

        <div class="page-wrapper">
			<div class="page-content">
    <!--            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">-->
				<!--	<div class="breadcrumb-title pe-3">AMB</div>-->
				<!--	<div class="ps-3">-->
				<!--		<nav aria-label="breadcrumb">-->
				<!--			<ol class="breadcrumb mb-0 p-0">-->
				<!--				<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>-->
				<!--				</li>-->
				<!--				<li class="breadcrumb-item active" aria-current="page">User Managements</li>-->
				<!--			</ol>-->
				<!--		</nav>-->
				<!--	</div>-->
				<!--	<div class="ms-auto">-->
				<!--		<div class="btn-group">-->
    <!--                        <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>-->
				<!--		</div>-->
				<!--	</div>-->
				<!--</div>-->
                
                <ul class="nav nav-tabs">
                    <li class="pending_approval"><a href="{{url('/admin/users')}}" data-toggle="tab" aria-expanded="true">All Users</a>
                    </li>
    
                    <li class="all_leave active"><a href="javascript::void(0)" data-toggle="tab" aria-expanded="false">Edit User</a>
                        </li>
                </ul>
                <div class="row">
					<div class="col-xl-12 mx-auto">
						<div class="card border-primary" style="padding: 20px 0px;">
							<div class="card-body p-3 col-xl-9 mx-auto">
								<div class="card-title d-flex align-items-center pb-2">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary ">Update User</h5>
								</div>
								<!-- <hr> -->
								
								            @php
                                                $userid = base64_encode($user->id); 
                                            @endphp
								<div class="row g-3">
                                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $userid], 'class'=>'create_user']) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Name:<span class="text text-danger required">*</span></strong>
                                                <!--{!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control', 'required')) !!}-->
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$user->name}}" minlength="2" maxlength="30" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Email: <span class="text text-danger required">*</span></strong>
                                                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control', 'required')) !!}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Password: <span class="text text-danger required">*</span></strong>
                                                {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control password')) !!}
                                                <i class="bx bx-show" id="show_password"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Confirm Password: <span class="text text-danger required">*</span></strong>
                                                {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control confirm_pass')) !!}
                                            </div>
                                        </div>
                                        <input type="hidden" name="userid" value="{{$userid}}">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Role: <span class="text text-danger required">*</span></strong>
                                                {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control', 'required')) !!}
                                            </div>
                                        </div>
                                        <!-- <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div> -->

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Agency: <span class="text text-danger required">*</span></strong>
                                                <select id="agc" name="agencies_name" class="form-control" required>
                                                        @php
                                                         $agid = '';
                                                        if(!empty( $agncydata->agency_id)){
                                                            $agid = $agncydata->agency_id ;
                                                        }else {
                                                            $agid = '0' ;
                                                        }
                                                        $ages = DB::table('agencies')->get();
                                                        @endphp
                                                        @foreach ($ages as $agesall)
                                                        @php
                                                            $matchid = $agesall->id;
                                                        @endphp
                                                        <option value="{{$agesall->id}}" @if($agid==$matchid) selected @endif> {{$agesall->agencies_name}}  
                                                        </option>
                                                        @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>User Type: <span class="text text-danger required">*</span></strong>
                                                {{-- {!! Form::select('agencies_name[]', $agency,[], array('class' => 'form-control')) !!} --}}
                                                    <select name="user_type" id="" class="form-control" required>
                                                        <option value=""> Choose </option>
                                                        <option value="admin" @if($user['user_type']=='admin') selected @endif>Admin</option>
                                                        <option value="officer" @if($user['user_type']=='officer') selected @endif>Manager </option>
                                                        <option value="teamleader" @if($user['user_type']=='teamleader') selected @endif>Team Leader </option>
                                                        <option value="accountant" @if($user['user_type']=='accountant') selected @endif>Accountant</option>
                                                        <option value="ap" @if($user['user_type']=='ap') selected @endif>Ap</option>
                                                        <option value="ar" @if($user['user_type']=='ar') selected @endif>Ar</option>
                                                        <option value="agent" @if($user['user_type']=='agent') selected @endif>Agent</option>
                                                        <option value="other" @if($user['user_type']=='other') selected @endif>Other</option>
                                                    </select>
                                            </div>
                                        </div>
                                        
                                        
                                       <?php 
                                                $uinfodtl = App\Models\Userdetail::where('userid', $user->id)->first();
                                        ?>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Phone No:<span class="text text-danger required">*</span></strong>
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" value=" {{ isset($uinfodtl->mobile) ? $uinfodtl->mobile :Null }}" required>
                                            </div>
                                        </div>
                                    

                                        <div class="col-12 pt-4 text-center">
										    <button type="submit" class="btn btn-primary ">Submit</button>
									    </div>
                                    </div>
                                    {!! Form::close() !!}

								</div>
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
