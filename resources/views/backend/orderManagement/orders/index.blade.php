@extends('backend.layouts.master')
@section('title','Products Managements')
@section('content')

    <!--start page wrapper -->
	<div class="page-wrapper">
		<div class="page-content">
			<!--breadcrumb-->
			<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
				<div class="breadcrumb-title pe-3">Product</div>
				<div class="ps-3">
					<nav aria-label="breadcrumb">
						<ol class="breadcrumb mb-0 p-0">
							<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
							</li>
							<li class="breadcrumb-item active" aria-current="page">Products Management</li>
						</ol>
					</nav>
				</div>
				<div class="ms-auto">
					<div class="btn-group">
						@can('role-create')
						<a class="btn btn-primary" href="{{ route('products.create') }}"> Create New Product</a>
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
						
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Details</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->detail }}</td>
                                <td>
                                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                                        <a class="btn btn-outline-info btn-sm radius-30 px-4" href="{{ route('products.show',$product->id) }}">Show</a>
                                        @can('product-edit')
                                        <a class="btn btn-outline-secondary btn-sm radius-30 px-4" href="{{ route('products.edit',$product->id) }}">Edit</a>
                                        @endcan


                                        @csrf
                                        @method('DELETE')
                                        @can('product-delete')
                                        <button type="submit" class="btn btn-outline-danger btn-sm radius-30 px-4">Delete</button>
                                        @endcan
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>

                        {!! $products->links() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--end page wrapper -->

    @include('backend.common.footer')
@endsection
