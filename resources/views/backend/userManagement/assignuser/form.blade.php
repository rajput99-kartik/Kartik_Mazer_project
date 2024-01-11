<?php 
    if(isset($assignuser_details)){
        $title = 'Edit';
        $form_id = 'Assign User';
		    $image_text = 'Update Image';
        $action  =  url('/admin/assignuser/edit/'.$assignuser_id);
        $user_id = $assignuser_id;
    }else{
        $title = 'Add';
        $form_id = 'assignuser';
		    $image_text = 'Update Image';
        $action  =  url('/admin/assignuser/add');
        $user_id = $agent_id;
    }
?>

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
                
                 @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif
                
                <ul class="nav nav-tabs">
                    @can('uagent-all')
                    <li class="pending_approval"><a href="{{url('/admin/assignuser/list')}}" data-toggle="tab" aria-expanded="true">All Agent</a>
					@endcan
                    <li class="pending_approval"><a href="{{url('/admin/assignuser')}}" data-toggle="tab" aria-expanded="true">User Agent</a>
                    </li>
                    <li class="all_leave active"><a href="javascript::void(0);" data-toggle="tab" aria-expanded="false">Create New</a>
                        </li>
                </ul>
                <div class="row">
                    <div class="col-xl-12 mx-auto">
                        <div class="card border-4 border-primary">
                            <div class="card-body p-3 col-xl-9 mx-auto">
                                <div class="card-title d-flex align-items-center pb-2">
                                    <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary ">Assign User</h5>
                                </div>
                                <!-- <hr> -->
                                <div class="row g-3">
                                    
                                  <form action="{{ $action }}" method="post" id="{{$form_id}}" enctype="multipart/form-data" class="create_user">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Name: <span class="text text-danger required">*</span></strong>
                                                <input type="text" name="name"  class="form-control" placeholder="Name" name="company_name" value="{{ isset($assignuser_details['name'])? $assignuser_details['name']: old('name') }}" required>

                                                <input type="hidden" name="agent_id" id="name" value="{{ $user_id }}">
                                            </div>
                                        </div>
    
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Email: <span class="text text-danger required">*</span></strong>
                                                <input type="text" name="email" class="form-control" placeholder="Email" value="{{ isset($assignuser_details['email']) ? $assignuser_details['email']: old('email') }}" required>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Password: <span class="text text-danger required">*</span></strong>
                                                <input type="password" name="password" class="form-control password" placeholder="Password" value="{{ isset($assignuser_details['password']) ? $assignuser_details['password']: old('password') }}" required>
                                                <i class="bx bx-show" id="show_password"></i>
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Confirm Password: <span class="text text-danger required">*</span></strong>
                                                <input type="password" name="confirm-password" placeholder="confirm-password" class="form-control confirm_pass" value="{{ isset($assignuser_details['confirm-password']) ? $assignuser_details['confirm-password']: old('confirm-password') }}">

                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Phone : <span class="text text-danger required">*</span></strong>
                                                <input type="number" name="phone" placeholder="Phone No" class="form-control" value="{{ isset($assignuser_details['phone']) ? $assignuser_details['phone']: old('phone') }}" minlength="10" maxlength="10">
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Role: <span class="text text-danger required">*</span></strong>
                                                  <select name="roles" class="form-control" required>
                                                    @foreach($roles as $r)
                                                      <option value="{{$r->id}}"> {{ $r->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <strong>User List New: <span class="text text-danger required">*</span></strong>
                                              <select name="assignto_id"  class="form-control" id="assignto_id" required>
                                                @foreach ($aginfo as $agdata)

                                                       <?php
                                                        $nuserid = $agdata->user_id;
                                                        //echo $nuserid, "</br>" ;
                                                        $id =  $r->id ;
                                                        $agid = App\Models\User::where('id', $nuserid)->get();
                                                            foreach ($agid as $userd):
                                                                    if($userd->user_type == 'officer' && $userd->status == '1'){
                                                                        ?>
                                                                         <option value="{{$userd->id}}" data-show="{{$userd->id}}"> {{ $userd->name .' ' . $userd->officerid }}</option>
                                                                        <?php
                                                                    }
                                                            endforeach ;
                                                        //dd($agid);
                                                      ?>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                    
                                        <div class="col-12 pt-4">
                                            <button type="submit" class="btn btn-primary ">Submit</button>
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
