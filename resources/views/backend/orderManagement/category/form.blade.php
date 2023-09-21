@extends('backend.layouts.master')
@section('title','Add Product')
@section('content')

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

        <div class="page-wrapper">
            <div class="page-content">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3">AMB</div>
                    <div class="ps-3">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 p-0">
                                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="ms-auto">
                        <div class="btn-group">
                        <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
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
                                    <h5 class="mb-0 text-primary ">Add Product</h5>
                                </div>
                                    <div class="row g-3">
                                    <a data-toggle="modal" href="#myModal1" class="btn btn-primary">Launch modal</a>
                                        <div class="modal" id="myModal1">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Modal 1</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="container"></div>
                                                    <div class="modal-body">
                                                        <p>
                                                            Content 1.
                                                        </p>
                                                        <a data-toggle="modal" href="#myModal2" class="btn btn-primary">Launch modal 2</a>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#" data-dismiss="modal" class="btn">Close</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal" id="myModal2">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">modal 2</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    </div>
                                                    <div class="container"></div>
                                                    <div class="modal-body">
                                                        <p>
                                                        modal 2
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a href="#" data-dismiss="modal" class="btn">Close</a>
                                                        <a href="#" class="btn btn-primary">Save changes</a>
                                        <a data-toggle="modal" href="#myModal3" class="btn btn-primary">Launch modal3</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal" id="myModal3">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Modal 3</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                </div>
                                                <div class="container"></div>
                                                <div class="modal-body">
                                                    <p>
                                                        modal 3
                                                    </p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="#" data-dismiss="modal" class="btn">Close</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@include('backend.common.footer')
@endsection

