@extends('backend.layouts.master')
@section('title','Create New Role')
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
                    <li class="pending_approval"><a href="{{url('/admin/roles')}}" data-toggle="tab" aria-expanded="true">All Roles</a>
                    </li>
        
                    <li class="all_leave active"><a href="{{url('/admin/roles/create')}}" data-toggle="tab" aria-expanded="false">Create New</a>
                        </li>
                </ul>
                <div class="row user-role">
					<div class="col-xl-12 mx-auto">
						<div class="card border-4 border-primary">
							<div class="card-body p-3 ">
								<div class="card-title d-flex align-items-center pb-2">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary ">Add User Role</h5>
								</div>
								<!-- <hr> -->
                                <div class="row g-3">
                                    <form action="{{ route('roles.store') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Role Name</label>
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter a Role Name">
                                        </div>

                                        <div class="form-group">
                                            <label for="name" class="heading_label">Permissions</label>

                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="checkPermissionAll" value="1">
                                                <label class="form-check-label" for="checkPermissionAll">All</label>
                                            </div>
                                            <hr>
                                            @php $i = 1; @endphp
                                            @foreach ($permission_groups as $group)
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="{{ $i }}Management" value="{{ $group->name }}" onclick="checkPermissionByGroup('role-{{ $i }}-management-checkbox', this)">
                                                            <label class="form-check-label" for="checkPermission">{{ ucfirst($group->name) }}</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-9 role-{{ $i }}-management-checkbox">
                                                        @php
                                                            $permissions = App\Models\User::getpermissionsByGroupName($group->name);
                                                            $j = 1;
                                                        @endphp
                                                        @foreach ($permissions as $permission)
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" name="permissions[]" id="checkPermission{{ $permission->id }}" value="{{ ucfirst($permission->name) }}">
                                                                <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ ucfirst($permission->name) }}</label>
                                                            </div>
                                                            @php  $j++; @endphp
                                                        @endforeach
                                                        <br>
                                                    </div>
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
        </div>
@include('backend.common.footer')
@include('backend.userManagement.roles.partials.scripts')
@endsection
