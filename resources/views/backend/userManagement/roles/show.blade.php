@extends('backend.layouts.master')
@section('title','Role Permission')
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
    
                <li class="all_leave active"><a href="javascript::void(0);" data-toggle="tab" aria-expanded="false">View Role</a>
                    </li>
            </ul>
            <div class="card">
                <div class="card-body">
                    <!--<div class="d-lg-flex align-items-center mb-4 gap-3">-->
                    <!--    <div class="position-relative">-->
                    <!--        <input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>-->
                    <!--    </div>-->
                       
                    <!--</div>-->
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead class="table-light">
                                <tr>
                                <th>Roles Name</th>
                                <th>Permission</th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <!-- @if(!empty($rolePermissions))
                                        @foreach($rolePermissions as $v)
                                            <label class="label label-success">{{ $v->name }},</label>
                                        @endforeach
                                    @endif -->
                                    
                                    

                                    <div class="mb-3">

                                    <?php //dd($role); ?>
                                    @if(!empty($rolePermissions))

                                    <div class="role-view">    
                                    @foreach($rolePermissions as $v)
                                    <div class="bootstrap-tagsinput"><span class="badge bg-primary">{{ $v->name }}<span data-role="remove"></span></span>
                                    
                                    <input type="text" class="form-control visually-hidden" data-role="tagsinput" value="{{ $v->name }}">
                                    </div>
                                    @endforeach
                                    </div>
                                    @endif
                                </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end page wrapper -->    

@include('backend.common.footer')
@endsection
