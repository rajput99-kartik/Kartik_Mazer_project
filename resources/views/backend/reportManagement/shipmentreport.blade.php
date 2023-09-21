<div id="carrier_table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
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
				<span class="s_b_d">Search By Date</span>

    <table class="table mb-0" id="carrier_table">
        <thead class="table-light">

            
            <tr>
                <th>No</th>
                <th>Load</th>
                <th>Company</th>
                <th>Carrier Name</th>
                <th>Added By</th>
                <th>Pick</th>
                <th>Drop</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        
        <tbody id="shipment_filter">
        @php
        $i = 0;
        @endphp
        @if(count($shipment) > 0)
        @foreach($shipment as $key => $companies_res)
                <tr>
                    <?php 
                        $cid = $companies_res->companies_id ;
                        $dc =  App\Models\Company::where('id',$cid)->select('company_name')->first();
                        $carrier_name = $companies_res->carrier_id ;
                        $carrier_name =  App\Models\Carriers::where('id',$carrier_name)->select('c_company_name')->first();
                        $uidi = $companies_res->user_id ;
                        $agent_name =  App\Models\User::where('id',$uidi)->select('name')->first();

                        //pick
                        $pickid = $companies_res->id ;
                        $pick_date =  App\Models\Shipmentpick::where('shipment_id',$pickid)->select('p_ready')->first();
                        //drop
                        $dropid = $companies_res->id ;
                        $drop_date =  App\Models\Shipmentdrop::where('shipment_id',$dropid)->select('d_ready')->first();

                    ?>
                    <td>{{ ++$i }}</td>
                    <td>{{ $companies_res->id }}</td>
                    <td>{{ isset($dc['company_name']) ? $dc['company_name'] : null }}</td>
                    {{-- <td>{{ $carrier_name['c_company_name'] }}</td> --}}
                    <td>{{ isset($carrier_name['c_company_name']) ? $carrier_name['c_company_name'] : Null }}</td>
                    <!--<td>{{$companies_res->equipment_loads}}</td>-->
                    <td>{{ isset($agent_name['name']) ? $agent_name['name'] : Null }}</td>
                    <td>{{ isset($pick_date['p_ready']) ? $pick_date['p_ready']: null}}</td>
                    <td>{{isset($drop_date['d_ready']) ? $drop_date['d_ready'] : Null}}</td>
                    <td>
                    <input type="hidden" value="{{ $companies_res->id }}" id="shipment_id">
                    
                        <select class="form-control select2 {{$companies_res->shipment_statue}}" id="shipment_status_change" style="width: 100%;">
                            <option selected>{{$companies_res->shipment_statue}}</option>												
                        </select>
                    </td>
                    <td>{{ date('m/d/Y', strtotime($companies_res->created_at) )}}</td>
                </tr>
        @endforeach
                @else
                <tr style="background-color: #edf3f652;">
                    <td colspan="9">
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4 not-found">
                                <img src="{{url('/public/backend/assets/images/message.png')}}">
                                <h4>You have no Shipment, yet.</h4>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    </td>
                </tr>
                @endif
        </tbody>
    </table>
</div>

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
                    var startDate = new Date(data[8]);
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
                        text: 'Shipment Report',
                    },
                    series: [
                        {
                            name: 'Load',
                            data: chartData(table),
                        },
                    ],
                });
                // On each draw, update the data in the chart
                table.on('draw', function () {
                    chart.series[
                0].setData(chartData(table));
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
