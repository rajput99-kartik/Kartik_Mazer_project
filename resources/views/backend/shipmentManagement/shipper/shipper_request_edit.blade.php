@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
<style>
    .col-md-2.search-or {
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
				<!--breadcrumb-->
				<ul class="nav nav-tabs">
                    @can('shipper-all')
                    <li class="pending_approval"><a href="{{url('/admin/shipper/list')}}" data-toggle="tab" aria-expanded="true">All Shipper</a>
                    </li>
                    @endcan
                    @can('shipper-agentshipper')
                    <li class="pending_approval"><a href="{{url('/admin/shipper/manager/list')}}" data-toggle="tab" aria-expanded="true">Team Shipper</a></li>
                    @endcan
                    <li class="all_leav"><a href="{{url('/admin/shipper')}}" data-toggle="tab" aria-expanded="false">Shipper</a>
                        </li>
                    @can('shipper-create')
                    <li class=""><a href="{{url('/admin/shipper/add')}}" data-toggle="tab" aria-expanded="false">Create Shipper</a>
                    </li>
                    @endcan

                    @can('shipper-request')

                    <li class="active"> <a href="{{url('admin/shipper/request')}}" data-toggle="tab" aria-expanded="false"> Shipper Request</a>

                    </li>

                    @endcan
                </ul>

                  <div class="card col-xl-12" style="padding: 20px;">
                            
                            <div class="row">

                                @if($comp_data)
                                <div class="col-md-5">
                                    <div class="req_user_detail">
                                        <h4>Shipper Details:</h4>
                                        <p><b>Company Name: </b> <span>{{ isset($comp_data->company_name) ? $comp_data->company_name : null; }}</span></p>
                                        <p><b>Address: </b> <span>{{ isset($comp_data->address) ? $comp_data->address : null }}</span></p>
                                        <p><b>City: </b> <span>{{ isset($comp_data->shipper_city) ? $comp_data->shipper_city : null; }}</span></p>
                                        <p><b>Zip: </b> <span>{{ isset($comp_data->shipper_zipcode) ? $comp_data->shipper_zipcode : null; }}</span></p>
                                        <p><b>Phone: </b> <span>{{ isset($comp_data->phone_number) ? $comp_data->phone_number : null; }}</span></p>
                                        <p><b>Email: </b> <span>{{ isset($comp_data->email) ? $comp_data->email : null; }}</span></p>
                                        <p><b>Contact: </b> <span>{{ isset($comp_data->contact_name) ? $comp_data->contact_name : null; }}</span></p>
                                    </div> 
                                </div>
                                <div class="col-md-2 search-or">
                                    <span>OR</span>
                                </div>
                                <div class="col-md-5">
                                    <div class="req_comment">
                                        <h4>Comments:</h4>
                                        
                                        <div class="form-group">
                                            <strong>Pre-pay Limit:</strong>
                                            <input type="text" name="prepay_limit" id="prepay_limit" class="form-control">
                                            <span class="error" id="prepay_check"></span>
                                        </div>
                                        
                                        <div class="form-group">
                                            <strong>Limit:</strong>
                                            <input type="text" name="limit" id="limit" class="form-control" required>
                                            <span class="error" id="limitcheck"></span>
                                        </div>
                                           
                                          <div class="form-group">
                                            <strong>Comment:</strong>
                                            <textarea type="textarea" name="comment" id="comment" class="form-control"></textarea>
                                            <span class="error" id="commentcheck"></span>
                                           </div>
                                          <div class="col-12 pt-4">
                                              <input type="hidden" id="companies_id" value="{{ isset($comp_data->id) ? $comp_data->id: null }}">
                                              <button type="submit" class="btn btn-primary request_update" value="1">Approve</button>
                                              <button onclick="return confirm('Are You Sure Delete This Record..!')" class="btn btn-danger  px-4 request_update" value="2" type="submit">DisApprove</button>
                                          </div>
                                    </div>
                                </div>
                                @else
                                No, result found.
                                @endif
                            </div>
                    
                  </div>
        </div>
    </div>


        <script>
        function myFunction() {
          // Get the text field
          var copyText = document.getElementById("myInput");
          // Select the text field
          copyText.select();
          copyText.setSelectionRange(0, 99999); // For mobile devices
          // Copy the text inside the text field
          navigator.clipboard.writeText(copyText);
          
          // Alert the copied text
         
        }
        </script>

@include('backend.common.footer')
@endsection