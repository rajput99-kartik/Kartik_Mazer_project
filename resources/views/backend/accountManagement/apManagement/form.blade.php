<?php 
    if(isset($assignuser_details)){
        $title = 'Edit';
        $form_id = 'Assign User';
		    $image_text = 'Update Image';
        $action  =  url('/admin/accountap/edit/'.$ap_id);
        $user_id = $ap_id;
    }else{
        $title = 'Add';
        $form_id = 'assignuser';
		    $image_text = 'Update Image';
        $action  =  url('/admin/accountap/add');
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
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">Account Payable</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Account Payable Managements</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ms-auto">
                        <div class="btn-group">
                            <a class="btn btn-primary" href="{{ url('/admin/accountap') }}"> Back</a>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-8 mx-auto">
                        <h6 class="mb-0 text-uppercase"></h6>
                        <hr/>
                        <div class="card border-top border-0 border-4 border-primary">
                            <div class="card-body p-3 ">
                                <div class="card-title d-flex align-items-center pb-2">
                                    <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                    </div>
                                    <h5 class="mb-0 text-primary ">Account Payable User</h5>
                                </div>
                                <!-- <hr> -->
                                <div class="row g-3">
                                  <form action="{{ $action }}" method="post" id="{{$form_id}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        {{-- <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Carrier:</strong>
                                                <input type="text" name="name"  class="form-control" placeholder="Name" name="company_name" value="{{ isset($assignuser_details['name'])? $assignuser_details['name']: old('name') }}">
                                                <input type="hidden" name="agent_id" id="name" value="{{ $user_id }}">
                                            </div>
                                        </div> --}}

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Carrier List:</strong>
                                                  <select name="assignto_id"  class="form-control">
                                                    @foreach($carrier as $r)
                                                      <option value="{{ $r->id}}"> {{ $r->c_company_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Shipment :</strong>
                                                  <select name="assignto_id"  class="form-control">
                                                    @foreach($shipment as $r)
                                                      <option value="{{ $r->id}}"> {{ $r->shipment_statue }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                            <div class="form-group">
                                                <strong>Carrier Account :</strong>
                                                  <select name="assignto_id"  class="form-control">
                                                    @foreach($carrac as $r)
                                                      <option value="{{ $r->id}}"> {{ $r->carrier_id }}</option>
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
