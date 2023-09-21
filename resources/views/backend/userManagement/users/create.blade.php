@extends('backend.layouts.master')
@section('title','User Management')
@section('content')


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
                <ul class="nav nav-tabs">
                    <li class="pending_approval"><a href="{{url('/admin/users')}}" data-toggle="tab" aria-expanded="true">All Users</a>
                    </li>
    
                    <li class="all_leave active"><a href="{{url('/admin/users/create')}}" data-toggle="tab" aria-expanded="false">Add New</a>
                        </li>
                </ul>

                <div class="row">
					<div class="col-xl-12">
						<div class="card border-primary">
							<div class="card-body p-3 col-xl-9 mx-auto">
								<div class="card-title d-flex align-items-center pb-2">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary ">Add User</h5>
								</div>
								<!-- <hr> -->
								<div class="row g-3">
                                {!! Form::open(array('route' => 'users.store','method'=>'POST', 'class'=>'create_user', 'id'=>'userformdata')) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Name: <span class="text text-danger required">*</span></strong>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" minlength="2" maxlength="30" >
                                            <input type="hidden" name="status" value="0">
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Email: <span class="text text-danger required">*</span></strong>
                                            <!--{!! Form::email('email', null, array('placeholder' => 'Email','class' => 'form-control email', 'required')) !!}-->
                                            
                                             <input type="email" class="form-control" id="email" name="email" placeholder="Email" minlength="2" maxlength="60" >
                                             <span class="text-danger" id="email_error"></span>
                                            
                                            
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group passowrd_">
                                            <strong>Password: <span class="text text-danger required">*</span></strong>
                                            {!! Form::password('password', array('id' => 'password', 'placeholder' => 'Password','class' => 'form-control password', 'required')) !!}
                                            <i class="bx bx-show" id="show_password"></i>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group confirm_password">
                                            <strong>Confirm Password: <span class="text text-danger required">*</span></strong>
                                            {!! Form::password('confirm-password', array('name' => 'confirm_password', 'placeholder' => 'Confirm Password','class' => 'form-control  confirm_pass')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Role: <span class="text text-danger required">*</span></strong>
                                            {!! Form::select('roles[]', $roles,[], array('class' => 'form-control', 'required')) !!}
                                        </div>
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Agency: <span class="text text-danger required">*</span></strong>
                                            
                                            {{-- {!! Form::select('agencies_name[]', $agency,[], array('class' => 'form-control', 'required')) !!} --}}

                                            {!! Form::select('agencies_name[]', $agency, null, ['class' => 'form-control', 'placeholder' => 'Choose Option', 'required'])!!}
                                           
                                        </div>
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>User Type: <span class="text text-danger required">*</span></strong>
                                            {{-- {!! Form::select('agencies_name[]', $agency,[], array('class' => 'form-control', 'required')) !!} --}}
                                                <select name="user_type" id="" class="form-control" required>
                                                    <option value="admin">Admin </option>
                                                    <option value="officer">Manager </option>
                                                    <option value="teamleader">Team Leader </option>
                                                    <option value="accountant">Accountant</option>
                                                    <option value="ap">Ap</option>
                                                    <option value="ar">Ar</option>
                                                    <option value="other">Other</option>
                                                </select>
                                        </div>
                                    </div>
                                    
                                     <div class="col-xs-12 col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <strong>Phone No:<span class="text text-danger required">*</span></strong>
                                            
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="phone" value="" >
                                        </div>
                                    </div>
                                        
                                    <!--    <div class="col-xs-12 col-sm-12 col-md-6">-->
                                    <!--    <div class="form-group">-->
                                    <!--        <strong>Name: <span class="text text-danger required">*</span></strong>-->
                                    <!--        <input type="text" class="form-control" id="name" name="name" placeholder="Name" minlength="2" maxlength="30" >-->
                                    <!--        <input type="hidden" name="status" value="0">-->
                                    <!--    </div>-->
                                    <!--</div>-->

                                    
                                    <!-- <div class="col-xs-12 col-sm-12 col-md-8 text-center">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div> -->
                                    <!-- <div class="col-md-6">
										<label for="inputFirstName" class="form-label">First Name</label>
										<input type="email" class="form-control" id="inputFirstName">
									</div> -->

                                    <div class="col-12 pt-4">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>    
        <script>
            $(document).ready(function(){
                $("select.form-control").find("option:contains('superadmin')").hide();
                
                $(".email").keyup(function () {  
                    $(this).val($(this).val().toLowerCase());  
                });
                
                // $(".create_user").submit(function(){
                //     if($("input.confirm_pass").val()==$("input.password").val()){
                        
                //     }else{
                //         alert("Confirm Password Not Match");
                //         return false;
                //     }
                // })
                
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
            
            
            
            $(document).ready(function(){
                $("select.form-control").find("option:contains('Agent')").hide();
                
                $(".email").keyup(function () {  
                    $(this).val($(this).val().toLowerCase());  
                });
            })
        </script>
        
        
        
        
         
  
  <script>
      $(document).ready(function(){
        //var server = window.location.protocol+'//'+window.location.hostname+'/Quicktapp';
        $('form#userformdata').validate({
            rules:{
                
                name:{
                    required:true,
                    minlength:3,
                    maxlength:255,
                    // regex:/^[a-zA-z ]+$/
                },
                confirm_password: {
                    equalTo: "#password"
                },
                p_email:{
                    required:true,
                    p_email:true,
                    maxlength:255,
                    remote:{
                        url: "{{url('/admin/validate/agency-email')}}",
                        data:{
                            user:function(){
                                return $('#user').val();
                            },
                        },  
                    },
                },
                
            },
            messages:{
                p_email:{
                    remote:"This email-id is already exist"
                },
            },
        
        });
        
        $("input#email").keyup(function(){
            var email = $(this).val();
            $.ajax({
              url: "{{url('/admin/validate/user-email')}}",
              type:"POST",
              data:{
                "_token": "{{ csrf_token() }}",
                email:email,
              },
              success:function(response){
                if(response==1){
                    $("form#agencyform button#agency_update_btn").prop('disabled', true);
                    $("#email_error").text("This email-id is already exist");
                    $('form#userformdata button').prop('disabled', true);
                }else{
                    $("form#agencyform button#agency_update_btn").prop('disabled', false);
                    $("#email_error").text("");
                    $('form#userformdata button').prop('disabled', false);
                }
              }
            });
        })
        
        $('input, select').on('blur keyup change', function() {
            if ($("form#userformdata").valid()) {
                $('form#userformdata button').prop('disabled', false);  
            } else {
                $('form#userformdata button').prop('disabled', 'disabled');
            }
        });
        
        });
  </script>
@include('backend.common.footer')
@endsection
