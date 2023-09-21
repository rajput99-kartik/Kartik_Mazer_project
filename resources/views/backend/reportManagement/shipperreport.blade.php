<style>
    /* @keyframes growProgressBar {
  0%, 33% { --pgPercentage: 0; }
  100% { --pgPercentage: var(--value); }
}

@property --pgPercentage {
  syntax: '<number>';
  inherits: false;
  initial-value: 0;
} */

div[role="progressbar"] {
  --size: 15rem;
  --fg: #1e55bf;
  --bg: #def;
  --pgPercentage: var(--value);
  animation: growProgressBar 3s 1 forwards;
  width: var(--size);
  height: var(--size);
  border-radius: 50%;
  display: grid;
  place-items: center;
  background: 
    radial-gradient(closest-side, white 80%, transparent 0 99.9%, white 0),
    conic-gradient(var(--fg) calc(var(--pgPercentage) * 1%), var(--bg) 0)
    ;
  font-family: Helvetica, Arial, sans-serif;
  font-size: calc(var(--size) / 5);
  color: var(--fg);
}

div[role="progressbar"]::after {
  counter-reset: percentage var(--value);
  content: counter(percentage) '%';
}
.progressbar h4 {
    font-size: 18px;
    color: #1e55bf;
    font-weight: 100;
}
.progressbar p {
    font-size: 21px;
    color: #e64c0f;
}
.progressbar {
    display: block !important;
    text-align: center;
    padding-top: 70px;
    position: relative;
}
.progressbar:after {
    position: absolute;
    bottom: 52px;
    left: 0;
    right: 0;
    font-size: 40px;
    color: #209c08;
}
.row.chart_shiper {padding: 20px;}
.progressbar.approve {--fg: #209c08;}
.progressbar.disapprove {--fg: #e62d0f;}
</style>
        <div id="carrier_table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
            <span class="s_b_d">Search By Date</span>
            <div class="row chart_shiper">
                <div class="col-md-4">
                    <?php
                        $pshipper = $shipper_pending / $total * 100;
                        $countpshipper = number_format($pshipper, 0);
                    ?>
                    <div class="progressbar" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:{{$countpshipper}}">
                        <h4>Pending</h4>
                        <p>{{$shipper_pending}} / {{$total}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                        $ashipper = $shipper_approve / $total * 100;
                        $countashipper = number_format($ashipper, 0);
                    ?>
                    <div class="progressbar approve" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:{{$countashipper}}">
                        <h4>Approve</h4>
                        <p>{{$shipper_approve}} / {{$total}}</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <?php
                        $dshipper = $DisApprove / $total * 100;
                        $countdshipper = number_format($dshipper, 0);
                    ?>
                    <div class="progressbar disapprove" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100" style="--value:{{$countdshipper}}">
                        <h4>Disapprove</h4>
                        <p>{{$DisApprove}} / {{$total}}</p>
                    </div>
                </div>
            </div>
            <table class="table mb-0" id="carrier_table">
                <div class="date-filter">
				    <div class="row">
    					<div class="col-md-12">
    						<h4 class="text text-primary">Search By Date:</h4>
    					</div>
    					<div class="col-md-2">
    						<label>From Date:</label>
    						<input type="text" id="min" name="min" class="form-control">
    					</div>
    					<div class="col-md-2">
    						<label>To Date:</label>
    						<input type="text" id="max" name="max" class="form-control">
    					</div>
    				</div>
				</div>
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Company</th>
                        <th>Secret Code</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Added By</th>
                        <th>Address</th>
                        <!--<th>State</th>-->
                        <!--<th>Zip</th>-->
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody id="shipper_filter">
                    @php
                    $i = 0;
                    @endphp
                    @if(count($comp_data) > 0)
                    @foreach($comp_data as $companies_res)
                            @php
                                $createdby = App\Models\User::where('id',$companies_res->user_id)->first();
                            @endphp
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td> {{ isset($companies_res->company_name) ? $companies_res->company_name : Null }}</td>
                                <td>{{ isset($companies_res->encode_title) ? $companies_res->encode_title : Null }}</td>
                                <td>{{ isset($companies_res->phone_number) ? $companies_res->phone_number : Null }}</td>
                                <td>{{ isset($companies_res->shipper_city) ? $companies_res->shipper_city : Null }}</td>
                                <td>{{ isset($companies_res->shipper_state) ? $companies_res->shipper_state : Null }}</td>
                                <td>{{ isset($createdby->name) ? $createdby->name : Null }}</td>
                                <td>{{ $companies_res->address }}</td>
                                <!--<td>{{ isset($companies_res->shipper_state) ? $companies_res->shipper_state : Null }}</td>-->
                                <!--<td>{{ isset($companies_res->shipper_zipcode) ? $companies_res->shipper_zipcode : Null }}</td>-->
                                <td>
                                    <span class="text text-<?php if($companies_res->approved == 0){echo " style='color:#1e55bf'"; }elseif($companies_res->approved == 2){echo "danger"; }elseif($companies_res->approved == 1){ echo 'success'; } ?>"><i class='bx bxs-circle me-1'></i><?php if($companies_res->approved == 0){echo "Pending"; }elseif($companies_res->approved == 1){ echo 'Approve'; }else{ echo 'DisApprove'; } ?></span>
                                </td>
                                <td>{{ date('m/d/Y', strtotime($companies_res->created_at) )}}</td>
                                
                            </tr>
                    @endforeach
                            @else
                            <tr style="background-color: #edf3f652;">
                                <td colspan="7">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 not-found">
                                            <img src="{{url('/public/backend/assets/images/message.png')}}">
                                            <h4> No Shipper created, yet.</h4>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </td>
                            </tr>
                            @endif
                </tbody>
            </table>
        </div>

<link rel="stylesheet" href="">

<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
	$(document).ready(function () {
	    $("span.s_b_d").click(function(){
            $(".date-filter").slideToggle();
        })
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#min').datepicker('getDate');
                    var max = $('#max').datepicker('getDate');
                    var startDate = new Date(data[9]);
                    if (min == null && max == null) return true;
                    if (min == null && startDate <= max) return true;
                    if (max == null && startDate >= min) return true;
                    if (startDate <= max && startDate >= min) return true;
                    return false;
                }
            );
        
            $('#min').datepicker();
            $('#max').datepicker();
            var table = $('#carrier_table').DataTable();
        
            // Event listener to the two range filtering inputs to redraw on input
            $('#min, #max').change(function () {
                table.draw();
            });
            
            var container = $('<div/>').insertBefore(table.table().container());
                var chart = Highcharts.chart(container[0], {
                    chart: {
                        type: 'pie',
                    },
                    title: {
                        text: 'Shipper Report',
                    },
                    series: [
                        {   
                            name:'Shipper',
                            data: chartData(table),
                        },
                    ],
                });
                // On each draw, update the data in the chart
                table.on('draw', function () {
                    chart.series[0].setData(chartData(table));
                });
                
                function chartData(table) {
        var counts = {};
        // Count the number of entries for each position
        table
            .column(4, { search: 'applied' })
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
        });
</script>