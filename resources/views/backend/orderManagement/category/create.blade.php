@extends('backend.layouts.master')
@section('title','Add Category')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2></h2>
            </div>
            <div class="pull-right">
               
            </div>
        </div>
    </div>

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
					<div class="breadcrumb-title pe-3">AMB</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">Add Category</li>
							</ol>
						</nav>
					</div>
					<div class="ms-auto">
						<div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('ordercategory.index') }}"> Back</a>
						</div>
					</div>
				</div>

                <div class="row">
					<div class="col-xl-12 mx-auto">
						<h6 class="mb-0 text-uppercase"></h6>
						<hr/>
						<div class="card border-top border-0 border-4 border-primary">
							<div class="card-body p-3 ">
								<div class="card-title d-flex align-items-center pb-2">
									<div><i class="bx bxs-user me-1 font-22 text-primary"></i>
									</div>
									<h5 class="mb-0 text-primary ">Add Category</h5>
								</div>
								<!-- <hr> -->
								<div class="row g-3">
                                    <form action="{{ route('ordercategory.store') }}" method="POST">
                                    @csrf
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Category Name:</strong>
                                                    <input type="text" name="category_name" class="form-control" placeholder="Category Name">
                                                </div>
                                            </div>
                                            <?php $id = auth()->user()->id ;   ?>
                                            <input type="hidden" name="user_id" class="form-control" placeholder="user_id" value="{{ $id }}">
                                            
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
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



@include('backend.common.footer')
@endsection
