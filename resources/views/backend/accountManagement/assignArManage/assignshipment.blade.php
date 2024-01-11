@extends('backend.layouts.master')
@section('title','Assign Shipment Ar Management')
@section('content')
<style>
  .Delivered input{
    display:none;
  }
  span.switch.ap {
    width: 60px;
    border-radius: 2px;
    height: 28px;
}

</style>
<!--start page wrapper -->
<div class="page-wrapper">
  <div class="page-content">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
    @endif
    
    <!--div class="row">
      <div class="col-md-3 pl-lg">

      <div class="panel widget bg-gradient-deepblue">
          <div class="pl-sm pr-sm pb-sm">
            <strong><a style="font-size: 15px" class="b_status" search-type="unconfirmed" id="unconfirmed" href="#">Open</a>
              <small class="pull-right " style="padding-top: 2px">200</small>
            </strong>
            <div class="progress progress-striped progress-xs mb-sm">
              <div class="progress-bar progress-bar-primary " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-md-3">

      <div class="panel widget bg-gradient-ibiza">
          <div class="pl-sm pr-sm pb-sm">
            <strong><a style="font-size: 15px" class="b_status" search-type="confirmed" id="confirmed" href="#">Covered</a>
              <small class="pull-right " style="padding-top: 2px">300</small>
            </strong>
            <div class="progress progress-striped progress-xs mb-sm">
              <div class="progress-bar progress-bar-info " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
            </div>
          </div>
        </div>

      </div>
      <div class="col-md-3">

      <div class="panel widget bg-gradient-moonlit">
          <div class="pl-sm pr-sm pb-sm">
            <strong><a style="font-size: 15px" class="b_status" search-type="in_progress" id="in_progress" href="#">Delivered</a>
              <small class="pull-right " style="padding-top: 2px"> 6</small>
            </strong>
            <div class="progress progress-striped progress-xs mb-sm">
              <div class="progress-bar progress-bar-warning " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
            </div>
          </div>
        </div>

      </div>
      
      <div class="col-md-3">

      <div class="panel widget bg-gradient-ohhappiness">
          <div class="pl-sm pr-sm pb-sm">
            <strong><a style="font-size: 15px" class="b_status" search-type="resolved" id="resolved" href="#">Paid</a>
              <small class="pull-right " style="padding-top: 2px"> 10</small>
            </strong>
            <div class="progress progress-striped progress-xs mb-sm">
              <div class="progress-bar progress-bar-danger " data-toggle="tooltip" data-original-title="0%" style="width: 0%"></div>
            </div>
          </div>
        </div>

      </div>
    </div -->
    <div class="card card-primary ar">
      <div class="card-header">
        <h2 class="card-title">AccountAR List</h2>
      </div>
      <div class="card-body">
        <form action="{{url('admin/accountap/fillter/')}}" method="get">
          <div class="row"> 
            <div class="col-md-4 col-sm-4 col-xs-12">
              <label>Status</label>
              <select class="allcust form-control" id="ApStatus" name="ApStatus">
                <option value="">Choose</option>
                <option value="Open">Open</option>
                <option value="Covered">Covered</option>
                <option value="Intransit">In-transit</option>
                <option value="Delivered">Delivered</option> 
              </select>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-12">
              <label>Load#</label>
              {{-- <input type="text" id="LoadNumber" class="form-control allcust" > --}}
              <input type="text" id="LoadNumber" class="form-control allcust" name="shipmentload" value="">
            </div>
            
            {{-- <div class="col-md-3 col-sm-3 col-xs-12">
              <label>From</label>
              <input type="date" id="from_date" class="form-control allcust">
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <label>To</label>
              <input type="date" id="to_date" class="form-control allcust">
            </div> --}}
            <div class="col-md-2 col-sm-2 col-xs-12">
              <label style="visibility: hidden;display: block;">buttonrefresh</label>
              <button type="submit" id="ApfillterRefreshB" class="reficon btn btn-primary"><i class="fa fa-refresh" aria-hidden="true"></i>Refresh</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <ul class="nav nav-tabs">
      <li class="pending_approval active"><a href="{{url('/admin/assign/ar')}}" data-toggle="tab" aria-expanded="true">Shipment List</a>
      </li>
    </ul>
    
    <div class="card">
      <div class="card-body">
        <div class="d-lg-flex align-items-center mb-4 gap-3">
        </div>
        
        <div class="table-responsive3">
          <table class="table mb-0 " id="carrier_table">
            <thead class="table-light">
              <tr>
                <th>Load#</th>
                <th>Carrier</th>
                <th>Shipment</th>
                <th>User Name</th>
                <th>Delivered</th>
                <th width="150px">Status</th>
                <th>Sent Date</th> 
                <th>Action</th>                                       
              </tr>
            </thead>
            <tbody class="arfillterlist">
              @php
              $i = 0;
              //dd($userdata);
              @endphp

              @foreach($userdata as $user_shipment)
                <?php
                    $shipmentdata = \App\Models\Shipment::where('user_id',$user_shipment['user_id'])->get();
                  ?>
                @foreach($shipmentdata as $udata)
                   
                {{-- 10005 --}}
                        <?php 
                                
                            $company = \App\Models\Company::where('id',$udata['companies_id'])->first();
                            $user_name = \App\Models\User::where('id',$udata['user_id'])->first();
                            $drop = \App\Models\Shipmentdrop::where('shipment_id',$udata['id'])->orderBy('manage_order','ASC')->first();
                            

                          $encoded_id = $udata->id;
                          $statusdata =  isset($udata->ar_access_status) ? $udata->ar_access_status : Null;
                          //dd($statusdata);
                          if ($statusdata == '1') {
                            $checked = 'checked';
                          }else {
                            $checked = '';
                          }


                          if(($udata->shipment_statue == 'Delivered') && ($udata->ar_access_status != '1')){

                            $status_content = '<input type="checkbox" cid="'.$encoded_id.'"  class="stat_check" '.$checked.' data-toggle="toggle" cat='.$encoded_id.'>';

                          }elseif($udata->ar_access_status == '1'){
                            $status_content = '<input type="checkbox" style="display:none" cid="'.$encoded_id.'"  class="stat_check hide_switch" '.$checked.' data-toggle="toggle" cat='.$encoded_id.'>';

                          }else{
                            $status_content = '<input type="checkbox" style="display:none" cid="'.$encoded_id.'"  class="stat_check hide_switch" '.$checked.' data-toggle="toggle" cat='.$encoded_id.'>';
                          }
                          
                          $bg = '';
                            if($udata['shipment_statue']=='Delivered'){
                                $bg = "background-color:#96c93d !important";
                            }elseif($udata['shipment_statue']=='Covered'){
                                $bg = "background-color:#1797be !important";
                            }elseif($udata['shipment_statue']=='Open'){
                                $bg = "background-color:#ff6a00 !important";
                            }elseif($udata['shipment_statue']=='In-transit'){
                                $bg = "background-color:#1e55bf !important";
                            }

                        ?>

                        <tr>
                            
                            <td class="loadid">
                                {{isset($udata['id']) ? $udata['id'] : Null }}
                            </td>
                            
                            <td>
                                
                                {{ isset($company['company_name'])  ? $company['company_name'] : Null }}
                               
                            </td>
                            
                            <td>
                                <div style="width: 100px;<?php echo $bg; ?>" class="badge rounded-pill text-white bg-info p-2 text-uppercase px-3"><i class="bx bxs-circle me-1"></i>{{ isset($udata['shipment_statue'])  ? $udata['shipment_statue'] : Null }}</div>
                            </td>

                            <td>
                                {{ isset($user_name['name'])  ? $user_name['name'] : Null }}
                            </td>

                            <td>
                            {{ isset($drop['d_ready'])  ? $drop['d_ready'] : Null }}
                            </td>
                            
                            <td class="switch-btn">
                              {{!! $status_content !!}}
                              <span class="switch ap"></span>
                            </td>
                        
                            <td>
                            {{ isset($udata['ar_access_date'])  ? $udata['ar_access_date'] : Null }}
                            </td>

                            <td class="ap-action">
                                

                                <!--<button type="button" value="{{ $udata['user_id'] }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i></button>-->

                                <button id="ArCommentForm" type="button" ar_agentid="{{ $udata['user_id'] }}" shipment_id="{{isset($udata['id']) ? $udata['id']: Null }}" value="{{isset($udata['id']) ? $udata['id']: Null }}" data-toggle="tab" class="btn btn-outline-info btn-sm radius-30 px-4" aria-expanded="false"><i class="bx bx-comment"></i></button>
                            </td>
                        </tr>
                       
                @endforeach
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end page wrapper -->

  
<!-- Ar payment update Modal start here -->
<div class="modal" id="ArPaymentUpt">
</div>
<!-- Ar payment update Modal end here -->

<div class="modal" id="ArCommentShow">	
</div>



{{-- for status checking start here --}}
<script>
$(function() {
    $(document).on('change','.stat_check', function() {
        var curr    = $(this).prop('checked');
        var cat     = $(this).attr('cat');
        $.ajax({
            type:"post",
            url:"{{ url('admin/ar/assignuser/details/status') }}",
            data: {'curr': curr, 'cat':cat},
            success:function(resp){
                if(resp.status == 'true'){
                    swal(resp.msg,'','success');
                } else{
                    swal(resp.msg,'','warning');
                }
            }
        })
    })
})
</script>



<script>
    $(document).ready(function () {
    $('#carrier_table').DataTable({
        order: [[0, 'desc']],
    });
});
</script>

@include('backend.common.footer')
@endsection

