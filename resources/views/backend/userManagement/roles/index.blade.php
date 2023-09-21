@extends('backend.layouts.master')
@section('title','Role Management')
@section('content')

	<!--start page wrapper -->
	<div class="page-wrapper">
		<div class="page-content">
			
			@if ($message = Session::get('success'))
			<div class="alert alert-success">
			<p>{{ $message }}</p>
			</div>
			@endif
			<ul class="nav nav-tabs">
                <li class="pending_approval active"><a href="{{url('/admin/roles')}}" data-toggle="tab" aria-expanded="true">All Roles</a>
                </li>
    
                <li class="all_leave"><a href="{{url('/admin/roles/create')}}" data-toggle="tab" aria-expanded="false">Create New</a>
                    </li>
            </ul>
			<div class="card">
				<div class="card-body">
					<div class="d-lg-flex align-items-center mb-4 gap-3">
						
						<!-- <div class="ms-auto"><a href="{{ route('users.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New User</a></div> -->
					</div>
					<div class="table-responsive">
						
						<table class="table mb-0" id="carrier_table">
						<thead class="table-light">
						
							<tr>
							
								<th>No</th>
								<th style="text-align:center">Name</th>
								<th width="280px">Action</th>
							</tr>
						 </thead>
							 
							@foreach ($roles as $key => $role)
    							<?php 							  
    							  	$data = Auth::user()->roles()->first();
    								if($role->name=='superadmin'){
    								}else{
    							?>
							    <tr>
								<td>{{ ++$i }}</td>
								<td style="text-align:center"><span class="role-name">{{ $role->name }}</span></td>
								<td class="action_tooltip">
								    @php
                                        //$roleid = Crypt::encrypt($role->id);
                                        $roleid = base64_encode($role->id);
                                    @endphp
									<a class="btn btn-outline-info btn-sm radius-30 px-4" href="{{ route('roles.show',$roleid) }}"><i class="bx bx-show"></i><span class="tooltip">View</span></a>
									@can('role-edit')
										<a class="btn btn-outline-secondary btn-sm radius-30 px-4" href="{{ route('roles.edit',$roleid) }}"><i class="bx bx-edit"></i><span class="tooltip">Edit</span></a>
									@endcan
									@can('role-delete')
										<!--{!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
											{!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
										{!! Form::close() !!}-->
										<form method="POST" action="{{route('roles.destroy',$role->id )}}" accept-charset="UTF-8" style="display:inline">
											@csrf
											<input name="_method" type="hidden" value="DELETE">
											<button onclick="return confirm('Are You Sure Delete This Record..!')" class="btn btn-outline-danger btn-sm radius-30 px-4" type="submit"><i class="bx bx-trash"></i><span class="tooltip">Delete</span></button>
										</form>
									@endcan
								</td>
							
							</tr>
							    <?php }?>
							@endforeach
							
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end page wrapper -->
	


@include('backend.common.footer')
@endsection
