<?php 
    if(isset($assignuser_details)){
        $title = 'Edit';
        $form_id = 'Assign User';
		    $image_text = 'Update Image';
        $action  =  url('/admin/assignARuser/edit/'.$assignuser_id);
        $user_id = $assignuser_id;
    }else{
        $title = 'Add';
        $form_id = 'assignuser';
		    $image_text = 'Update Image';
        $action  =  url('/admin/assign/ar/add');
        $user_id = $agent_id;
    }
?>

@extends('backend.layouts.master')
@section('title','AR User Management')
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
                    <li class="pending_approval "><a href="{{url('/admin/assign/aragent/brokerlist')}}" data-toggle="tab" aria-expanded="true">Ar List</a>
                    </li>
    
                    <li class="all_leave active"><a href="javascript::void(0);" data-toggle="tab" aria-expanded="false">Add New</a>
                        </li>
                </ul>

                <div class="row">
                    <div class="col-xl-12 mx-auto acc-receivable">
                        <div class="card border-4 border-primary">
                            <div class="card-body p-3 col-xl-9 mx-auto">
                                <div class="card-title d-flex align-items-center pb-2">
                                    <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary ">Assign Account Receivable</h5>
                                </div>
                                <!-- <hr> -->
                                <div class="row g-3">
                                  <form action="{{ $action }}" method="post" id="{{$form_id}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                          <div class="form-group">
                                              <strong>AR List/Ac: <span class="text text-danger required">*</span></strong>
                                                <select name="assign_by"  class="form-control" required>
                                                    <option value="" disabled selected>Choose</option>
                                                  @foreach($userdata as $r)
                                                    <option value="{{$r->id}}"> {{ $r->name .' ' .$r->officerid }}</option>
                                                  @endforeach
                                              </select>
                                          </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>User List: <span class="text text-danger required">*</span></strong>
                                                  <select name="assign_to"  class="form-control" required>
                                                   <option value="" disabled selected>Choose</option>
                                                    @foreach($agent as $user_r)
                                                        <option value="{{$user_r->id}}"> {{ $user_r->name .' ' .$user_r->officerid }}</option>
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
