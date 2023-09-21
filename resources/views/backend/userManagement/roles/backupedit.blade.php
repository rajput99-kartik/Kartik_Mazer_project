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

                            <div class="row user-role role-Edit">
                                <form action="{{ route('roles.update', $role->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="name">Role Name</label>
                                            <input type="text" class="form-control" id="name" value="{{ $role->name }}" name="name" placeholder="Enter a Role Name">
                                        </div>
                                    </div>
                                    


                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label class="heading_label">Permission:</label>
                
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1" {{ App\Models\User::roleHasPermissions($role, $all_permissions) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="checkPermissionAll">All</label>
                                            </div>
                                            <hr>
                                            @php $i = 1; @endphp
                                            @foreach ($permission_groups as $group)
                                                <div class="row">
                                                    @php
                                                        $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                                        $j = 1;
                                                    @endphp
                                                    
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)" {{ App\Models\User::roleHasPermissions($role, $permissions) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="checkPermission">{{ $group->name }}</label>
                                                        </div>
                                                    </div>
                
                                                    <div class="col-9 role-{{ $i }}-management-checkbox">
                                                    
                                                        @foreach ($permissions as $permission)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" onclick="checkSinglePermission('role-{{ $i }}-management-checkbox', '{{ $i }}Management', {{ count($permissions) }})" name="permissions[]" {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }} id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                                                <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                            </div>
                                                            @php  $j++; @endphp
                                                        @endforeach
                                                        <br>
                                                    </div>
                
                                                </div>
                                                @php  $i++; @endphp
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <button type="submit" class="btn btn-primary">Update Role</button>
                                    </div>
                                </form>
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


           