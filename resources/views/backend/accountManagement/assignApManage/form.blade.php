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
        $action  =  url('/admin/assignacp/add');
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
                <ul class="nav nav-tabs">
                    <li class="pending_approval "><a href="{{url('/admin/assign/apagent/brokerlist')}}" data-toggle="tab" aria-expanded="true">Ap List</a>
                    </li>
    
                    <li class="all_leave active"><a href="javascript::void(0);" data-toggle="tab" aria-expanded="false">Assign User</a>
                        </li>
                </ul>

                <div class="row">
                    <div class="col-xl-12 mx-auto acc-payable">
                        <div class="card border-4 border-primary">
                            <div class="card-body p-3 col-xl-9 mx-auto">
                                <div class="card-title d-flex align-items-center pb-2">
                                    <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary ">Assign Account Payable</h5>
                                </div>
                                <!-- <hr> -->
                                <div class="row g-3">
                                  <form action="{{ $action }}" method="post" id="{{$form_id}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        {{-- <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Name:</strong>
                                                <input type="text" name="name"  class="form-control" placeholder="Name" name="company_name" value="{{ isset($assignuser_details['name'])? $assignuser_details['name']: old('name') }}">

                                                <input type="hidden" name="agent_id" id="name" value="{{ $user_id }}">
                                            </div>
                                        </div>
    
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Email:</strong>
                                                <input type="text" name="email" class="form-control" placeholder="Email" value="{{ isset($assignuser_details['email']) ? $assignuser_details['email']: old('email') }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Password:</strong>
                                                <input type="password" name="password" class="form-control" placeholder="Password" value="{{ isset($assignuser_details['password']) ? $assignuser_details['password']: old('password') }}">
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Confirm Password:</strong>
                                                <input type="password" name="confirm-password" placeholder="confirm-password" class="form-control" value="{{ isset($assignuser_details['confirm-password']) ? $assignuser_details['confirm-password']: old('confirm-password') }}">
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Role:</strong>
                                                  <select name="roles" class="form-control">
                                                    @foreach($roles as $r)
                                                      <option value="{{$r->id}}"> {{ $r->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div> --}}
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Agent List: <span class="text text-danger required">*</span></strong>
                                                  <select name="assign_to"  class="form-control" required>
                                                    <option value="" disabled selected>Choose</option>
                                                    @foreach($agent as $user_r)
                                                        <option value="{{$user_r->id}}"> {{ $user_r->name .' ' .$user_r->officerid }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                          </div>
                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                          <div class="form-group">
                                              <strong>Ap List/Ac: <span class="text text-danger required">*</span></strong>
                                                <select name="assign_by"  class="form-control" required>
                                                    <option value="" disabled selected>Choose</option>
                                                  @foreach($userdata as $r)
                                                    <option value="{{$r->id}}"> {{ $r->name .' ' .$r->officerid }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
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
            })
        </script>
@include('backend.common.footer')
@endsection
