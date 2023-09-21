@extends('backend.layouts.master')
@section('title','Loads Management')
@section('content')
<style>
    h2#swal2-title {
        font-size: 20px;
        margin: 0px;
    }
    div#swal2-html-container {
        font-size: 14px;
        margin: 10px 0px 0px;
    }
    .swal2-popup.swal2-modal.swal2-loading.swal2-show {
        width: 270px;
        padding-top: 10px;
    }
    .swal2-loader {
        border-color: #80c427 rgba(0,0,0,0) #80c427 rgba(0,0,0,0);
    }
    
    .agency {
        position: relative;
        padding: 10px 0px;
        border-left: solid 1px #1e55bf;
    }
    
    .agencies {
        background-color: #1e55bf;
        color: #fff;
        margin: 6px 0px 6px 2px;
        font-size: 10px;
        width: fit-content;
    }
    
    .agencies p {
        margin: 0px;
        padding: 4px 8px;
    }
</style>
	<!--start page wrapper -->
    <div class="page-wrapper">
		<div class="page-content">
		    <!--end breadcrumb-->
			@if ($message = Session::get('success'))
			<div class="alert alert-success">
			    <p>{{ $message }}</p>
			</div>
			@endif
			@if ($message = Session::get('error'))
			<div class="alert alert-danger">
			    <p>{{ $message }}</p>
			</div>
			@endif
			<ul class="nav nav-tabs">
                <li class="pending_approval"><a href="{{url('/admin/dashboard')}}" data-toggle="tab" aria-expanded="true">Dashboard </a>
                </li>
                <li class="all_leave active"><a data-bs-toggle="modal" data-bs-target="#TodayLanesLoads" data-toggle="tab" href="javascript::void(0)" aria-expanded="false">View Report</a></li>
            </ul>


            <div class="row">
                <div class="col-md-6">
                    <?php 
	
			$data  = DB::table('loads')->get();

			$datad1  = App\Models\Load::where('full_partial_tl_ltl','FUll')->count();
			$datad  = App\Models\Load::where('full_partial_tl_ltl','PARTIAL')->count();


                // $report = DB::table('loads')
                //     ->selectRaw('count(load_state_origin) as number_of_loads, load_state_origin')
                //     ->groupBy('load_state_origin')
                //     ->havingRaw('COUNT(*) > 1')
                //     ->get();

                // $stateData = $report->toArray() ;
                   // dd($stateData);
                ?>

                </div>

            </div>
			
			<div class="card">
				<div class="card-body table-responsive loads">	
				    <div class="report-filter">
				        <div class="row">
    				        <div class="col-md-3">
    				            <label>Report Type:</label>
    				            <select class="allcust form-control" id="report_fillter">
        						   <option value="">- Select Type -</option>
        						   <option value="load">Loads</option>
                                   <option value="agency">Agency</option>
                                   <option value="shipment">Shipment</option>
                                   <option value="shipper">Shipper</option>
                                </select>
    				        </div>
    				        <div class="col-md-3" id="load_users" style="display:none">
    				            @php
    				            $users = DB::table('users')->get();
    				            @endphp
    				            <label>Select User:</label>
    				            <select class="allcust form-control" id="load_users_fillter">
        						   <option selected disabled>- Select Type -</option>
        						   <option value="{{url('/admin/load-report/0')}}">All</option>
        						   @foreach($users as $user)
        						   <option value="{{url('/admin/load-report').'/'.$user->id}}">{{$user->name}}</option>
        						   @endforeach
                                </select>
    				        </div>

                            <div class="col-md-3" id="agency" style="display:none">
    				            @php
    				            $agncdata = DB::table('agencies')->get();
    				            @endphp
    				            <label>Select Agency:</label>
    				            <select class="allcust form-control" id="agency_fillter">
        						   <option selected disabled>- Select Type -</option>
        						   <option value="{{url('/admin/agency-report/0')}}">All</option>
        						   @foreach($agncdata as $item)
        						   <option value="{{url('/admin/agency-report').'/'.$item->id}}">{{$item->agencies_name}}</option>
        						   @endforeach
                                </select>
    				        </div>
    				    </div>
				    </div>
				    <div class="report_content">
				        <h4>View Your Report</h4>
				        <div class="get_data">
				            <div class="row">
				                <div class="col-md-6">
				                    <div class="agency_boxes">
				                        <div class="agency">
    				                        @php
    				                        $agencies = DB::table('agencies')->get();
    				                        @endphp
    				                        @foreach($agencies as $agencie)
    				                        <div class="agencies">
    				                            <p>{{$agencie->agencies_name}}</p>
    				                        </div>
    				                        @endforeach
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
    <script>
        $(document).ready(function(){
            
            $('#data').DataTable();
            $('#report_fillter').change(function(){
                var filter = $(this).val();
                if(filter=='load'){
                    $("#load_users").fadeIn();
                }else{
                    $("#load_users").fadeOut();
                }

                if(filter=='agency'){
                    $("#agency").fadeIn();
                }else{
                    $("#agency").fadeOut();
                }
                
                //shipment repoert
                if(filter=='shipment'){
                    $.ajax({
                       type:'GET',
                       url:"{{url('/admin/shipment-report')}}",
                       success:function(data){
                           let timerInterval
                            Swal.fire({
                              title: 'Wait..',
                              html: 'I will Filter in <b></b> milliseconds.',
                              timer: 1000,
                              timerProgressBar: true,
                              didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                  b.textContent = Swal.getTimerLeft()
                                }, 500)
                              },
                              willClose: () => {
                                clearInterval(timerInterval)
                              }
                            })
                            setTimeout(function(){
                                $(".report_content h4").text("View Shipment Report");
                                $(".report_content").fadeIn();
                                $(".get_data").html(data);
                            }, 500)
                       }
                    })
                }
                
                //shipper repoert
                if(filter=='shipper'){
                    $.ajax({
                       type:'GET',
                       url:"{{url('/admin/shipper-report')}}",
                       success:function(data){
                           let timerInterval
                            Swal.fire({
                              title: 'Wait..',
                              html: 'I will Filter in <b></b> milliseconds.',
                              timer: 1000,
                              timerProgressBar: true,
                              didOpen: () => {
                                Swal.showLoading()
                                const b = Swal.getHtmlContainer().querySelector('b')
                                timerInterval = setInterval(() => {
                                  b.textContent = Swal.getTimerLeft()
                                }, 500)
                              },
                              willClose: () => {
                                clearInterval(timerInterval)
                              }
                            })
                            setTimeout(function(){
                                $(".report_content h4").text("View Shipper Report");
                                $(".report_content").fadeIn();
                                $(".get_data").html(data);
                            }, 500)
                       }
                    })
                }
                
            })
            
            //load get
            $("#load_users_fillter").change(function(){
               var url = $(this).val();
               $.ajax({
                   type:'GET',
                   url:url,
                   success:function(data){
                    const chartData = data;
                    //alert(chartData);
                    console.log(chartData);
                    // return false;
                       let timerInterval
                        Swal.fire({
                          title: 'Wait..',
                          html: 'I will Filter in <b></b> milliseconds.',
                          timer: 1000,
                          timerProgressBar: true,
                          didOpen: () => {
                            Swal.showLoading()
                            const b = Swal.getHtmlContainer().querySelector('b')
                            timerInterval = setInterval(() => {
                              b.textContent = Swal.getTimerLeft()
                            }, 500)
                          },
                          willClose: () => {
                            clearInterval(timerInterval)
                          }
                        }).then((result) => {
                          /* Read more about handling dismissals below */
                          if (result.dismiss === Swal.DismissReason.timer) {
                            console.log('I was closed by the timer')
                          }
                        })
                        setTimeout(function(){


                             // STEP 3 - Chart Configurations
                            const chartConfig = {
                            type: 'column2d',
                            renderAt: 'chart-container-data',
                            width: '100%',
                            height: '400',
                            dataFormat: 'json',
                            dataSource: {
                                // Chart Configuration
                                "chart": {
                                    "caption": "Load Management System By City",
                                    "subCaption": "Load Info",
                                    "xAxisName": "AMB Logistic Pvt Ltd",
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
                            
                            //start
                            <?php 
	
                        		$data  = DB::table('loads')->get();
                        		$datad1  = App\Models\Load::where('full_partial_tl_ltl','FUll')->count();
                        		$datad  = App\Models\Load::where('full_partial_tl_ltl','PARTIAL')->count();
                        	?>
                            const chartData_two = [
                        		{
                                "label": "FUll",
                                "value": <?php echo $datad1 ;?>
                        		}, {
                        			"label": "PARTIAL",
                        			"value": <?php echo $datad ;?>
                        		}
                        
                        	];
                        
                            //STEP 3 - Chart Configurations
                            const chartConfigs = {
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
                                "data": chartData_two
                                }
                            };
                            FusionCharts.ready(function(){
                            var fusioncharts = new FusionCharts(chartConfigs);
                            fusioncharts.render();
                            });
                            //end

                            $(".report_content h4").text("View Loads Report");
                            $(".report_content").fadeIn();
                            $(".get_data").html(data);
                        }, 500)
                   }
               })
            })

            //agency data fetch here
            $("#agency_fillter").change(function(){
               var url = $(this).val();
               $.ajax({
                   type:'GET',
                   url:url,
                   success:function(data){
                        $(".report_content h4").text("View Agency Report");
                        $(".report_content").fadeIn();
                        $(".get_data").html(data);
                   }
                })
            })
        })
    </script>
@include('backend.common.footer')
@endsection
