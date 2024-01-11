<?php // dd('kljsadf') ;?>

@extends('backend.layouts.master')
@section('title','Category Managements')
@section('content')

    <!--start page wrapper -->
	<div class="page-wrapper">
		<div class="page-content">
			<!--breadcrumb-->
			<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
				<div class="breadcrumb-title pe-3">Order</div>
				<div class="ps-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 p-0">
							<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Category Management</li>
						</ol>
					</nav>
				</div>
				<div class="ms-auto">
					<div class="btn-group">
						@can('ordercategory-create')
						<a class="btn btn-primary" href="{{ route('ordercategory.create') }}"> New Category</a>
						@endcan
					</div>
				</div>
			</div>
			<!--end breadcrumb-->
			
			
			<div class="card">
				<div class="card-body">
					<div class="d-lg-flex align-items-center mb-4 gap-3">
						<div class="position-relative">
							<input type="text" class="form-control ps-5 radius-30" placeholder="Search Order"> <span class="position-absolute top-50 product-show translate-middle-y"><i class="bx bx-search"></i></span>
						</div>
						<!-- <div class="ms-auto"><a href="{{ route('users.create') }}" class="btn btn-primary radius-30 mt-2 mt-lg-0"><i class="bx bxs-plus-square"></i> New User</a></div> -->
					</div>
                    @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                    <p>{{ $message }}</p>
                    </div>
                    @endif
					<div class="table-responsive">
                        <table class="table mb-0">
                            <tr class="table-light">
                                <th>No</th>
                                <th>Category Name</th>
                                <th>User Name</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($category_data as $data)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $data->category_name }}</td>
                                <td>{{ $data->name }}</td>
                                <td class="action">
                                    <form action="{{ route('ordercategory.destroy',$data->id) }}" method="POST">
                                        <a class="btn btn-outline-info btn-sm radius-30 px-4" href="{{ route('ordercategory.show',$data->id) }}"><i class="bx bx-show"></i></a>
                                        @can('ordercategory-edit')
                                        <a class="btn btn-outline-secondary btn-sm radius-30 px-4" href="{{ route('ordercategory.edit',$data->id) }}"><i class="bx bx-edit"></i></a>
                                        @endcan

                                        @csrf
                                        @method('DELETE')
                                        @can('ordercategory-delete')
                                        <button type="submit" class="btn btn-outline-danger btn-sm radius-30 px-4" onclick="return confirm('Are You Sure Delete This Record..!')"><i class="bx bx-trash"></i></button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
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
