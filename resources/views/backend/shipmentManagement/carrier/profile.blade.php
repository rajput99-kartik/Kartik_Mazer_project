@extends('backend.layouts.master')
@section('title','Carrier Profile')
@section('content')
    
    <div class="page-wrapper">
		<div class="page-content">
			
			<ul class="nav nav-tabs">
                <li class="pending_approval"><a href="{{url('/admin/dashboard')}}" data-toggle="tab" aria-expanded="true">Dashboard</a>
                </li>

                <li class="all_leave active"><a href="javascript:void(0);" data-toggle="tab" aria-expanded="false">Carrier Profile</a>
                    </li>
            </ul>
			
			<div class="card">
			    <div class="card-body">
			        
			            <div class="unwrap">

                        <div class="cover-photo bg-cover">
                            <div class="row p-xl text-white">
                    
                                <div class="row col-sm-4">
                                    <div class="row pull-left col-sm-6">
                                        <div class=" row-table row-flush">
                                            <div class="pull-left text-white ">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">{{$load}}</h4>
                                                    <p class="mb0 text-muted">Total Loads</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-lg row-flush" style="margin-top: -30px;">
                    
                                            <div class="pull-left">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">0                                </h4>
                                                    <p class="mb0 text-muted">Open Loads</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pull-right col-sm-6">
                                        <div class=" row-table row-flush">
                    
                                            <div class="pull-left text-white ">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">5                                </h4>
                                                    <p class="mb0 text-muted">Close Loads</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-lg row-table row-flush">
                    
                                            <div class="pull-left">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">0                                </h4>
                                                    <p class="mb0 text-muted">Complete Loads</p>
                                                    <!--<small><a href="#" class="mt0 mb0">More info<i class="fa fa-arrow-circle-right"></i></a></small>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="text-center ">
                                        <img src="{{BACKEND_IMG_PATH}}/dummy-user.png" class="img-thumbnail img-circle thumb128 ">
                                    </div>
                                    <h3 class="m0 text-center">Carrier Name</h3>
                                </div>
                                <div class="row col-sm-5">
                                    <div class="pull-left col-sm-6">
                                        <div class=" row-table row-flush">
                                            <div class="pull-left text-white ">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">{{$sum}}</h4>
                                                    <p class="mb0 text-muted">Total Amount</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-lg row-table row-flush">
                    
                                            <div class="pull-left">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">0                                </h4>
                                                    <p class="mb0 text-muted">Total Paid</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="pull-right col-sm-6">
                                        <div class=" row-table row-flush">
                    
                                            <div class="pull-left text-white ">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">0                                </h4>
                                                    <p class="mb0 text-muted">Pending Amount</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-lg row-table row-flush">
                    
                                            <div class="pull-left">
                                                <div class="">
                                                    <h4 class="mt-sm mb0">0                                </h4>
                                                    <p class="mb0 text-muted">Total Award</p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    
                        </div>
                        
                    
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <ul class="nav nav-tabs user_tab" role="tablist">
                              <li class="nav-item" role="presentation">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home" aria-selected="true" role="tab">Basic Details</a>
                              </li>
                              <li class="nav-item" role="presentation">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu1" aria-selected="false" tabindex="-1" role="tab">Bank Details</a>
                              </li>
                            </ul>
                        </div>
                        <div class="col-md-9 usertab_txt">
                            <div class="tab-content">
                              <div class="tab-pane container active" id="home" role="tabpanel">
                                  <div class="panel-heading">
                                    <div class="panel-title">
                                        <strong>Carrier Name</strong>
                                        <div class="pull-right">
                                            <span data-placement="top" data-toggle="tooltip" title="" data-original-title="">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row panel-body form-horizontal">
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="control-label col-sm-5"><strong>Company Name:</strong></label>
                                        <div class="col-sm-7 ">
                                            <p class="form-control-static">{{ isset($carrier['c_company_name']) ? $carrier['c_company_name'] : Null}}</p>
            
                                        </div>
                                    </div>
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="control-label col-sm-5"><strong>MC#:</strong></label>
                                        <div class="col-sm-7 ">
                                            <p class="form-control-static">{{ isset($carrier['mc_no']) ? $carrier['mc_no'] : Null  }}</p>
            
                                        </div>
                                    </div>
                                        <div class="form-group mb0  col-sm-6">
                                            <label class="control-label col-sm-5"><strong>DOT:</strong></label>
                                            <div class="col-sm-7 ">
                                                <p class="form-control-static">{{isset($carrier['dot_no']) ? $carrier['dot_no'] : Null }}</p>
            
                                            </div>
                                        </div>
                                        <div class="form-group mb0  col-sm-6">
                                            <label class="control-label col-sm-5"><strong>Address:</strong></label>
                                            <div class="col-sm-7 ">
                                                <p class="form-control-static">{{isset($carrier['carrier_city']) ? $carrier['carrier_city'] : Null}}</p>
                                            </div>
                                        </div>
                                                            <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label">City: </label>
                                        <div class="col-sm-7">										<p class="form-control-static">{{isset($carrier['carrier_city_main']) ? $carrier['carrier_city_main'] : Null}}</p>										</div>
                                    </div>
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label">State:</label>
                                        <div class="col-sm-7">											<p class="form-control-static">{{isset($carrier['carrier_state']) ? $carrier['carrier_state'] : Null}}</p>
                                         </div>
                                    </div>
                                    <div class="form-group mb0  col-sm-6">
            
                                        <label class="col-sm-5 control-label">Zip: </label>
                                        <div class="col-sm-7">											<p class="form-control-static">{{isset($carrier['carrier_zip']) ? $carrier['carrier_zip'] : Null}}</p>                                         </div>
                                    </div>
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label">Phone:</label>
                                        <div class="col-sm-7">											<p class="form-control-static">{{isset($carrier['phone_no']) ? $carrier['phone_no'] : Null}}</p>                                         </div>
                                    </div>
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label">Email: </label>
                                        <div class="col-sm-7">
                                            <p class="form-control-static">{{isset($carrier['email']) ? $carrier['email'] : Null}}</p>
                                        </div>
                                    </div>
                                    <div class="form-group mb0  col-sm-6">
                                        <label class="col-sm-5 control-label">Dispatcher: </label>
                                        <div class="col-sm-7">                                            <p class="form-control-static">{{isset($carrier['dispatcher']) ? $carrier['dispatcher'] : Null}}</p>                                        </div>
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
