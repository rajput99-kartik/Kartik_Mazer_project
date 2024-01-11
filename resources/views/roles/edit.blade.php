@extends('backend.layouts.master')
@section('title','Update Role')
@section('content')

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <!--end breadcrumb-->
            
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
            @endif
           
            <ul class="nav nav-tabs">
                <li class="pending_approval"><a href="{{url('/admin/roles')}}" data-toggle="tab" aria-expanded="true">All Roles</a>
                </li>
    
                <li class="all_leave active"><a href="javascript::void(0);" data-toggle="tab" aria-expanded="false">Edit Role</a>
                    </li>
            </ul>
            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <div class="card border-4 border-primary">
                        <div class="card-body p-3 role-update">
                            <div class="card-title d-flex align-items-center pb-2">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary ">Update Role</h5>
                            </div>
                            <!-- <hr> -->

                            <div class="row g-3">
                            {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Name:23</strong>
                                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <strong>Permission:</strong>
                                            <br/>
                                            <div class="row user-role role-edit">
                                                @foreach($permission as $value)
                                                    <div class="col-md-2">
                                                        <div class="form-check">
                                                            <label>{{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-check-input name')) }}
                                                            <span>{{ $value->name }}</span></label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                    </div>


                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>



                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <!-- start new here  ****************************************-->

            

        
    </div>
    </div>
    <!--end page wrapper -->   

@include('backend.userManagement.roles.partials.scripts')
@include('backend.common.footer')
@endsection


           