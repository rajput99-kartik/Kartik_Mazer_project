@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">Notify User</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Notify User Page</li>
							</ol>
						</nav>
					</div>

				</div>
				<!--end breadcrumb-->
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif

				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
						
						</div>

						<div class="table-responsive3">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>No</th>
                                        <th>User Name</th>
                                        <th>Email</th>
                                        <th>Assign To</th>
                                        
                                        {{-- <th style="width: 200px;">Action</th> --}}
									</tr>
								</thead>
								<tbody>
								@php
								$i = 0;
								@endphp
                                @foreach($userdata as $udata)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $udata->title }}</td>
                                            <td>{{ $udata->body }}</td>
                                            <td>
												@php
													$assignto_id = App\Models\User::where('id', $udata->assignto_id)->get('name');

													$assignby_id = App\Models\User::where('id', $udata->assign_id)->get('name');
												@endphp

												@foreach($assignto_id as $bought)
													{{ $bought['name'] }}
												@endforeach
											</td>
                                            
                                            <td>
                                                {{-- <a href="{{ url('admin/assignuser/view',$udata->id )}}"> 
                                                <button type="button" value="{{ $udata->companies_id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i></button></a> | --}}
                                                {{-- <a href="{{ url('admin/assignuser/edit',$udata->id )}}" class="btn btn-outline-secondary btn-sm radius-30 px-4"> <i class="bx bx-edit"></i> </a>  | --}}
                                                {{-- <a href="{{ url('admin/assignuser/delete',$udata->id )}}"> 
                                                <button type="button" value="{{ url('admin/assignuser/delete',$udata->delete )}}" class="btn btn-outline-danger btn-sm radius-30 px-4" onclick="return confirm('Are You Sure Delete This Record..!')"><i class="bx bx-trash"></i></button></a> --}}
                                            </td>
                                        </tr>
                                @endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
    </div>
  </div>
</div>



@include('backend.common.footer')

@include('backend.common.notification') 

	
@endsection

