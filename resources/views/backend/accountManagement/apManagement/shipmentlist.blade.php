@extends('backend.layouts.master')
@section('title','Shipper Management')
@section('content')
<!--start page wrapper -->
<style>
    td.ap-action.action_tooltip button {
        padding: 0px !important;
    }
    .Delivered {
        background-color: #96c93d !important;
    }
    .Covered {
        background-color: #1797be !important;
    }
    .In-transit {
        background-color: #ff6a00 !important;
    }
</style>
<div class="page-wrapper">
  <div class="page-content">
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
    @endif
    
    <div class="row">
      <div class="col-md-3 pl-lg">
        <!-- START widget-->
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
        <!-- END widget-->
      </div>
      <div class="col-md-3">
        <!-- START widget-->
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
        <!-- END widget-->
      </div>
      <div class="col-md-3">
        <!-- START widget-->
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
        <!-- END widget-->
      </div>
      
      <div class="col-md-3">
        <!-- START widget-->
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
        <!-- END widget-->
      </div>
    </div>
    <div class="card card-primary ar">
      <div class="card-header">
        <h2 class="card-title">AccountAP List</h2>
      </div>
      <div class="card-body">
        <form action="{{url('admin/accountap/fillter/')}}" method="get">
          <div class="row"> 
            <div class="col-md-5 col-sm-4 col-xs-12">
              <label>Status</label>
              <select class="allcust form-control" id="ApStatus" name="ApStatus">
                <option value="">Choose</option>
                <option value="Open">Open</option>
                <option value="Covered">Covered</option>
                <option value="Intransit">In-transit</option>
                <option value="Delivered">Delivered</option> 
              </select>
            </div>
            <div class="col-md-5 col-sm-4 col-xs-12">
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
      <li class="pending_approval"><a href="{{url('/admin/accountap')}}" data-toggle="tab" aria-expanded="true">Broker Assign</a>
      </li>
      <li class="pending_approval active"><a href="{{url('/admin/accountap')}}" data-toggle="tab" aria-expanded="true">Broker Shipments</a>
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
                <th>Status</th>
                <th>Delivery Date</th>
                <th>Days</th>
                <th>Carrier Price</th>
                <th>Broker</th>
                <th style="width:150px">Action</th>                                       
              </tr>
            </thead>
            <tbody class="apfillterlist">
              @php
              $i = 1;
              @endphp

                 

                @foreach($userdata as $user_data)
                @if($user_data->status == '1')
                    <?php
                        $shipment_data = App\Models\Shipment::where('user_id',$user_data->assign_agent_to)->where('ap_access_status','1')->get();
                    ?>
                    @foreach($shipment_data as $udata)
                    <?php
                        $accounts_payables = App\Models\AccountsPayable::where('shipment_id',$udata->id)->where('aging_status','!=',1)->first();
                    ?>
                    @if(empty($accounts_payables))

                              <td> {{ isset($udata->id) ? $udata->id : null }}</td>

                              @php
                                $carrier = App\Models\Carriers::where('id',$udata->carrier_id)->first();
                              @endphp
                              <td> {{ isset($carrier->c_company_name) ? $carrier->c_company_name : null }} </td>

                              <td> {{ isset($udata->shipment_statue) ? $udata->shipment_statue : null }} </td>


                              <td>
                                @php
                                    $shipmentdrop = App\Models\Shipmentdrop::where('shipment_id',$udata->id)->orderBy('manage_order','desc')->first();
                                @endphp
                                {{ isset($shipmentdrop->d_ready) ? $shipmentdrop->d_ready : null }}
                              </td>
                              
                              <td>
                                    <?php
                                        $in_datte2 = Carbon\Carbon::createFromFormat('Y-d-m', $shipmentdrop->d_ready)->format('Y-m-d');
                                        $datework = new Carbon($in_datte2);
                                        $now = Carbon::now();
                                        $diff = $datework->diffInDays($now);
                                    ?>
									              {{ $diff }}
                              </td>

                              <td>
                              @php
                                $shipmentrate = App\Models\Shipmentrate::where('shipment_id',$udata->id)->first();
                              @endphp
                              {{ isset($shipmentrate->carrier_total) ? $shipmentrate->carrier_total : null }}
                              </td>
                              
                              @php
                                $usern = App\Models\User::where('id',$udata->user_id)->first();
                              @endphp
                              <td>
                                {{ isset($usern->name) ? $usern->name : null }}
                              </td>

                              <td class="ap-action action_tooltip">
                                
                                <button type="button" data-bs-toggle="modal" data-bs-target="#Apupload" data-toggle="tab" class="btn btn-outline-info btn-sm radius-30 px-4 apshipupload_fetch" aria-expanded="false" value="{{isset($udata['id']) ? $udata['id']: Null }}"><i class="bx bx-upload"></i><span class="tooltip">Uploads</span></button> <a href="{{ url('admin/accountap/view',$udata['user_id'] )}}">
                                <button type="button" value="{{ $udata['user_id'] }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a>
                                
                                <button id="apshowcmnt" type="button" data-bs-toggle="modal" ap_agentid="{{ $udata['user_id'] }}" shipmentid_loadid="{{isset($udata['id']) ? $udata['id']: Null }}" data-bs-target="#Apcomment_{{ $udata['user_id'] }}" value="{{isset($udata['id']) ? $udata['id']: Null }}" data-toggle="tab" class="btn btn-outline-info btn-sm radius-30 px-4 apcomment_fetch" aria-expanded="false"><i class="bx bx-comment"></i><span class="tooltip">Comments</span></button>
                              </td>
                            </tr>
                    @endif
                  @endforeach
                  @endif
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--end page wrapper -->

  <div class="modal" id="Apupload" aria-modal="true" role="dialog">
                        
  </div>
  <div class="modal" id="Apcomment" aria-modal="true" role="dialog">
  </div>






<!-- <script src="https://code.highcharts.com/highcharts.js"></script> -->
<script>

  $(document).ready(function () {
    // Create DataTable
    var table = $('#').DataTable({
        dom: 'Pfrtip',
    });
 
    // Create the chart with initial data
    var container = $('<div/>').insertBefore(table.table().container());
 
    var chart = Highcharts.chart(container[0], {
        chart: {
            type: 'pie',
        },
        title: {
            text: 'Carrier Aging',
        },
        series: [
            {
                data: chartData(table),
            },
        ],
    });
 
    // On each draw, update the data in the chart
    table.on('draw', function () {
        chart.series[0].setData(chartData(table));
    });
});
 
function chartData(table) {
    var counts = {};
 
    // Count the number of entries for each position
    table
        .column(3, { search: 'applied' })
        .data()
        .each(function (val) {
            if (counts[val]) {
                counts[val] += 1;
            } else {
                counts[val] = 1;
            }
        });
 
    // And map it to the format highcharts uses
    return $.map(counts, function (val, key) {
        return {
            name: key,
            y: val,
        };
    });
}
  </script>


  <script>                
            /* Admin shipper list filter funcation Start Here*/
            $(document).on('click','#ApfillterRefreshB', function(){
                var ApStatus = $('#ApStatus').val();
                if((ApStatus != '') || (ShipperName != '') || (AgentName != '')){
                $.ajax({
                        url: "{{ url('admin/accountap/fillter/') }}",
                        type: 'get',
                        cache : false,
                        data: {ApStatus:ApStatus},
                        success: function(data){
                            var filterdata = data.find(".datacfillter");
                            $('.apfillterlist').html(filterdata);			
                            setTimeout(function () {
                                    Swal.close();
                            }, 500);
                        }	
                    });
                }else{
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'Select some details first!',
                            showConfirmButton: false,
                            timer: 1000
                        })
                    }
                
            });
  </script>

<script>

  $(function () {
    $('#ap_comment').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        type: 'head',
        url: "{{ url('admin/apcomment/add/') }}",
        data: $('#ap_comment').serialize(),
        success: function () {
          alert('form was submitted');
        }
      });
    });

  });



  $(function () {
    $('#apshowcmnt').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        type: 'head',
        url: "{{ url('admin/apcomment/add/') }}",
        data: $('#ap_comment').serialize(),
        success: function () {
          alert('form was submitted');
        }
      });
    });

  });


  // $(document).on('click','#apshowcmnt', function(){
  //   $.ajax({
  //       url: "{{ url('admin/apcomment/list/') }}",
  //       type: 'get',
  //       cache : false,
  //         data: $('#ap_comment').serialize(),
  //         success: function () {
  //           alert('form was submitted');
  //         }
  //       }	
  //     });

</script>


<script>
$(document).ready(function () {
    $('#carrier_table').DataTable({
        order: [[0, 'desc']],
    });  
});
</script>

      
      @include('backend.common.footer')
      @include('backend.common.notification') 
      @endsection

      
      
