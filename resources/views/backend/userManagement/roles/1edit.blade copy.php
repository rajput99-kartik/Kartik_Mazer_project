@extends('backend.layouts.master')
@section('title','Update Role')
@section('content')

    <!--start page wrapper -->
    <div class="page-wrapper">
        <div class="page-content">
            <!--breadcrumb-->
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Role</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Update Role</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        
                        <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                    </div>
                </div>
            </div>
            <!--end breadcrumb-->
            
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
            <p>{{ $message }}</p>
            </div>
            @endif
           

            <div class="row">
                <div class="col-xl-12 mx-auto">
                    <h6 class="mb-0 text-uppercase"></h6>
                    <hr/>
                    <div class="card border-top border-0 border-4 border-primary">
                        <div class="card-body p-3 ">
                            <div class="card-title d-flex align-items-center pb-2">
                                <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                                </div>
                                <h5 class="mb-0 text-primary ">Update Role</h5>
                            </div>
                            <!-- <hr> -->
                           
                            <div class="row g-3">
                                <form action="{{ route('roles.update',$role->id) }}" method="PATCH">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Role Name</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter a Role Name">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Permissions</label>

                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1">
                                            <label class="form-check-label" for="checkPermissionAll">All</label>
                                        </div>
                                        <hr>
                                        @php $i = 1;
                                        
                                        //dd($permission_groups);
                                        
                                        @endphp
                                        @foreach ($permission_groups as $group)

                                    
                                            <div class="row">
                                                <table>
                                                    <th>
                                                   
                                                
                                                <div class="col-3">
                                                    <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                                                        <label class="form-check-label" for="checkPermission">{{ $group->name }}</label>
                                                    </div>
                                                </div>

                                                </th>

                                                <tr>
                                                
                                                <td>
                                                
                                                    <div class="col-9 role-{{ $i }}-management-checkbox">
                                                        @php
                                                            $permissions = App\Models\User::getpermissionsByGroupName($group->name);

                                                            $j = 1;
                                                            
                                                        @endphp
                                                        @foreach ($permissions as $permission)

                                                    
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{ $permission->id }}" value="{{ $permission->id }}">
                                                                <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                            </div>

                                                            
                                                            @php  $j++; @endphp
                                                        @endforeach
                                                        <br>
                                                    </div>
                                                </td>

                                                </tr>

                                                </table>

                                            </div>
                                            @php  $i++; @endphp
                                        @endforeach

                                    </div>                               
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">Save Role</button>
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


           