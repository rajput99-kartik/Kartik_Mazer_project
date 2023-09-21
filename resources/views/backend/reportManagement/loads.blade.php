



				<div class="row">
					<div class="col-md-2">
					</div>
					<div class="col-md-8">
						<!--<div id="chart-container">AMB Load Chart load here!</div>-->
					</div>
					<div class="col-md-2">
						
					</div>

					{{-- <div class="col-md-6">
						<div id="chart-container-data">AMB Load Chart load here!</div>
					</div> --}}
				</div>

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

				<div id="carrier_table_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
				    <span class="s_b_d">Search By Date</span>
					<table class="table datatable mb-0" id="carrier_table">
    					<thead class="table-light">
    					  <tr>
    						 <th>#</th>
    						 <th>Referenc</th>
    						 <th>Pick Date</th>
    						 <th>Origin</th>
    						 <th>Drop</th>
    						 <th>Truck</th>
    						 <th>Load Type</th>
    						 <th>Broker</th>
    						 <th>Load Weight</th>
    						 <th>Dat Id</th>
    						 <th>Status</th>
    						 <th>Date</th>
    					  </tr>
    					</thead>

						<tbody id="lodetypeerStatus">
						@php $i=1;
						// dd('hell');
						@endphp
						@if(count($user_loads) > 0)
							@foreach($user_loads as $user_load)
    						
							<tr class="odd">
								<td class="cdata">{{ $i++ }}</td>
								<td>{{ $user_load->ref_no }}</td>
								<td>{{ $user_load->post_date }}</td>
								<td>{{ $user_load->load_state_origin }}</td>
								<td>{{ $user_load->load_city_desti }}</td>
								<td>{{ $user_load->equipments }}</td>
								<td>{{ $user_load->full_partial_tl_ltl }}</td>
								
								@php
									$user =  App\Models\User::where('id',$user_load['user_id'])->first();
									$name= isset($user['name']) ? $user['name'] : null;
								@endphp
								<td>{{ucfirst($name)}}</td>
								<td>{{ $user_load->weight_load }}</td>
								<td>{{ $user_load->load_dat_id }}</td>
								
								<?php
									
									$status= $user_load->load_status;
									$date_pick= explode("T",$user_load->dat_pick_date);
									$date_pick1= strtotime($date_pick['0']);
									$today= strtotime(date('Y-m-d'));
									$lstatus= '';
									if($today > $date_pick1){
										$lstatus = 'Expire'; 
										$class = "danger";
									}else{
										if($status == 1){
												$lstatus = 'Delete'; 
												$class = "danger";
										}else{
											$lstatus = 'Active';
											$class = "success";
										}
									}
								?>
								

								<td><span class="text text-{{$class}}">{{ $lstatus }}</span></td>
								<td>{{ date('m/d/Y', strtotime($user_load->created_at) )}}</td>
							</tr>
							
							@endforeach
							@else
							<tr style="background-color: #edf3f652;">
                                <td colspan="10">
                                    <div class="row">
                                        <div class="col-md-4"></div>
                                        <div class="col-md-4 not-found">
                                            <img src="{{url('/public/backend/assets/images/message.png')}}">
                                            <h4>No user loads, yet.</h4>
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </td>
                            </tr>
							@endif
						</tbody>
					</table>
				</div>



				 
<script>
    $(document).ready(function () {
        
        $("span.s_b_d").click(function(){
            $(".date-filter").slideToggle();
        })
        
        // Create DataTable
        var table = $('#carrier_table').DataTable({
            dom: 'Pfrtip',
        });
        // Create the chart with initial data
        var container = $('<div/>').insertBefore(table.table().container());
        var chart = Highcharts.chart(container[0], {
            chart: {
                type: 'pie',
            },
            title: {
                text: 'Loads Report',
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
	$(document).ready(function () {
            $.fn.dataTable.ext.search.push(
                function (settings, data, dataIndex) {
                    var min = $('#min').datepicker('getDate');
                    var max = $('#max').datepicker('getDate');
                    var startDate = new Date(data[11]);
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
        });
</script>



{{-- 
	

	<?php 
		
	// $report = DB::table('loads')
	// 	->selectRaw('count(load_state_origin) as number_of_loads, load_state_origin')
	// 	->groupBy('load_state_origin')
	// 	->havingRaw('COUNT(*) > 1')
	// 	->get();

	// //$stateData = $report;			
	//  $stateData = $report->toArray() ;			
	// //dd($stateData);
	// $jsonArray = array();

	

	// foreach($stateData as $key =>  $rdata){
	// 	$jsonArrayItem = array();
	// 	//dd($rdata);
	// 	$jsonArrayItem['label'] = $rdata->load_state_origin;
	// 	$jsonArrayItem['value'] = $rdata->number_of_loads;
	// 	//append the above created object into the main array.
	// 	$jsonArrayItem = json_encode($jsonArrayItem);

	// 	array_push($jsonArray, $jsonArrayItem);
	// 	//dd(jsonArray);
	// }

		//echo "<pre>". print_r($jsonArray). "</pre>" ;	
	//return $jsonArray ;
	// $jsonArray = array();
	

?>
	
	


<script type="text/javascript">
    //STEP 2 - Chart Data
	<?php 
	
		$data  = DB::table('loads')->get();
		$datad1  = App\Models\Load::where('full_partial_tl_ltl','FUll')->count();
		$datad  = App\Models\Load::where('full_partial_tl_ltl','PARTIAL')->count();
	?>
    const chartData = [
		{
        "label": "FUll",
        "value": <?php echo $datad1 ;?>
		}, {
			"label": "PARTIAL",
			"value": <?php echo $datad ;?>
		}

	];

    //STEP 3 - Chart Configurations
    const chartConfig = {
    type: 'column2d',
    renderAt: 'chart-container',
    width: '100%',
    height: '400',
    dataFormat: 'json',
    dataSource: {
        // Chart Configuration
        "chart": {
            "caption": "Load Management System",
            "subCaption": "Load Info",
            "xAxisName": "AMB Logistic",
            "yAxisName": "(MMbbl)",
            "numberSuffix": "Load",
            "theme": "AMB",
            },
        // Chart Data
        "data": chartData
        }
    };
    FusionCharts.ready(function(){
    var fusioncharts = new FusionCharts(chartConfig);
    fusioncharts.render();
    });

</script>
	--}}