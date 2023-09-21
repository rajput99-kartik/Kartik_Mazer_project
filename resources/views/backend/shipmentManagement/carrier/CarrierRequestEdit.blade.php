@extends('backend.layouts.master')
@section('title','Carrier Management')
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
                    <li class="pending_approval"><a href="{{url('/admin/carrier')}}" data-toggle="tab" aria-expanded="true">All Carrier</a>
                    </li>
    
                    <li class="all_leave"><a href="{{url('/admin/new-carrier')}}" data-toggle="tab" aria-expanded="false">Create Carrier</a>
                        </li>
                        <li class=""><a href="{{url('/admin/carrier/requests')}}" data-toggle="tab" aria-expanded="false">All Request</a>
                        <li class="active"><a href="javascript::void(0)" data-toggle="tab" aria-expanded="false">Edit Request</a>
                    </li>
                </ul>

                  <div class="card col-xl-12" style="padding: 20px;">
                            
                            <div class="row">
                                @if($carrierData)
                                <div class="col-md-5">
                                    <div class="req_user_detail">
                                        <h4>Carrier Details:</h4>
                                        <p><b>Carrier Name: </b> <span>{{isset($carrierData->c_company_name) ? $carrierData->c_company_name : null}}</span></p>
                                        <p><b>MC Number: </b> <span>{{isset($carrierData->mc_no) ? $carrierData->mc_no : null }}</span></p>
                                        <p><b>DOT Number: </b> <span>{{isset($carrierData->dot_no) ? $carrierData->dot_no : null }}</span></p>
                                        <p><b>Address: </b> <span>{{isset($carrierData->carrier_city) ? $carrierData->carrier_city : null }}{{isset($carrierData->carrier_state) ? $carrierData->carrier_state : null}}</span></p>
                                        <p><b>Phone: </b> <span>{{isset($carrierData->phone_no) ? $carrierData->phone_no : null}}</span></p>
                                    </div>
                                </div>
                                <div class="col-md-2 search-or">
                                    <span>OR</span>
                                </div>
                                <div class="col-md-5">
                                    <div class="req_comment">
                                        <h4>Comments:</h4>
                                           
                                        <form action="{{url('/admin/carrier/StatusUpdate')}}" method="post">
                                          <div class="form-group">
                                            <strong>Comment:</strong>
                                            <textarea type="textarea" name="comment" id="comment" class="form-control"></textarea>
                                            <span class="error" id="commentcheck"></span>
                                           </div>
                                          <div class="col-12 pt-4">
                                              <input type="hidden" name="companies_id" value="{{isset($carrierData->id) ? $carrierData->id : null}}">
                                              <button type="submit" name="approve" class="btn btn-primary request_update" value="1">Approve</button>
                                              <button onclick="return confirm('Are You Sure Delete This Record..!')" name="disapprove" class="btn btn-danger  px-4 request_update" value="2" type="submit">DisApprove</button>
                                          </div>
                                        </form>
                                    </div>
                                </div>
                                @else
                                    {{'No result found, Try again!'}}
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