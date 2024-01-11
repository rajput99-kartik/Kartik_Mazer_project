@extends('backend.layouts.master')
@section('title','Clock View')
@section('content')

<style>
    .clock_details {
    position: fixed;
    top: 0;
    right: -100%;
    width: 60%;
    background-color: #fff;
    z-index: 9999;
    padding: 24px;
    height: 100%;
    box-shadow: 0px 0px 14px -10px;
    transition: 0.5s;
}
.clock_details p.close {
    position: absolute;
    left: -25px;
    top: 9px;
    background-color: red;
    color: #fff;
    width: 25px;
    height: 25px;
    text-align: center;
    font-size: 17px;
    cursor: pointer;
}
.clock_details.show {
    right: 0;
}
body:after {content: "";position: absolute;top: 0;left: 0;width: 100%;height: 100%;background-color: #00000091;z-index: 999;transition: 0.5s;opacity: 0; pointer-events: none;}
body.open:after {
    opacity: 1;
    pointer-events: all;
}
.clock_details h4 {
    font-size: 20px;
    color: #1e55bf;
    font-weight: 600;
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
                
                
                @if ($message = Session::get('errors'))
                    <div class="alert alert-danger">
                    <p>{{ $message }}</p>
                    </div>
                @endif
                
                <ul class="nav nav-tabs">
                  
                    <li class="pending_approval active"><a href="{{url('/admin/clockin/view')}}" data-toggle="tab" aria-expanded="true">All Clock</a>
                    </li>


                    <li class="pending_approval"><a href="{{ url()->previous() }}" data-toggle="tab" aria-expanded="true">Dasboard</a>
                    </li>

                  
                    
                </ul>
				<div class="card">
					<div class="card-body">
						<div class="d-lg-flex align-items-center mb-4 gap-3">
						
						</div>

						<div class="table-responsive3">
							<table class="table mb-0" id="carrier_table">
								<thead class="table-light">
									<tr>
                                        <th>No</th>
                                        <th>User Name</th>
                                        <th>Total Hours</th>
                                        <th>Time IN</th>
                                        <th>Time Out</th>
                                        <th>Date</th>
                                        <th>B-Timer</th>
                                        <th >Action</th>
									</tr>
								</thead>
								<tbody>
								@php
								$i=1;
								 $ii=1;
								@endphp
                                @foreach($clockin as $udata)
                                            @php
                                                $id = $udata->user_id;
                                                $uname = App\Models\User::where('id',$id)->first();
                                                $name = $uname->name ?? Null ;
                                                $officerid = $uname->officerid ?? Null ;
	                                            
                                                $datad = $udata->brackout;
                                            @endphp
                                        <tr>
                                            <td>{{ $ii }}</td>
                                            <td>{{$name }}</td>
                                            
                                            
                                                 @php
                                                     $timein = $udata->timein;
                                                     $timeout =$udata->timeout;
                                                     $totalhours = date_create($timein)->diff(date_create($timeout))->format('%H:%i:%s');
                                                     
                                                @endphp
                                            
                                             <td> {{ $totalhours }}</td>
                                            
                                            {{-- <td>{{ substr($udata->timein, 10)  }}</td> --}}
                                                @php
                                                     $current_date = date("Y-m-d");
                                                     $olddate =  $udata->date_data;
                                                    //dd($current_date);
                                                @endphp
                                            
                                                @if($current_date == $udata->date_data)
                                                    <td style="color:green;">{{ $udata->timein }}</td>
                                                @else
                                                    <td>{{ $udata->timein }}</td>
                                                @endif


                                                @if(empty($udata->timeout))
                                                <td style="color:red;"> 00:00 </td>
                                                @else
                                                    <td >{{ isset($udata->timeout) ? $udata->timeout : Null}}</td>
                                                @endif
                                            
                                                <td>{{ $udata->date_data }}</td>

                                                <script>
    
                                                    // Set the date we're counting down to
                                                    // 62d 21h 41m 35s
                                                    var countDownDate_{{$i}} = new Date("<?php echo $datad; ?>").getTime();
                                                    // var countDownDate = new Date("Jan 5, 2023 15:37:25").getTime();
                                                    // Update the count down every 1 second
                                                    var x_{{$i}} = setInterval(function() {
        
                                                    // Get today's date and time
                                                    var now_{{$i}} = new Date().getTime();
                                                    var currentdate_{{$i}} = new Date(); 
                                                        var datetime_{{$i}} = currentdate_{{$i}}.getFullYear() + "-"
                                                                    + (currentdate_{{$i}}.getMonth()+1)  + "-" 
                                                                    + currentdate_{{$i}}.getDate() + " "  
                                                                    + currentdate_{{$i}}.getHours() + ":"  
                                                                    + currentdate_{{$i}}.getMinutes() + ":" 
                                                                    + currentdate_{{$i}}.getSeconds();
        
                                                                    console.log(datetime_{{$i}});
                                                    //document.write(datetime);
                                                    // Find the distance between now and the count down date
                                                    var distance_{{$i}} =  currentdate_{{$i}} - countDownDate_{{$i}}    ;
                                                    // Find the distance between now and the count down date
                                                    // var distance_{{$i}} = now_{{$i}} - countDownDate_{{$i}} ;
                                                    // Time calculations for days, hours, minutes and seconds
                                                    var days_{{$i}} = Math.floor(distance_{{$i}} / (1000 * 60 * 60 * 24));
                                                    var hours_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                    var minutes_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60 * 60)) / (1000 * 60));
                                                    var seconds_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60)) / 1000);
                                                    if(hours_{{$i}}>=30){
                                                        var class_{{$i}} = "red";
                                                    }else{
                                                        var class_{{$i}} = "red";
                                                    }
                                                    // Output the result in an element with id="demo"
                                                    document.getElementById("demo_{{$i}}").innerHTML = "<span>"+hours_{{$i}} + "h </span>"
                                                    + "<span>"+minutes_{{$i}} + "m </span>" + "<span>"+seconds_{{$i}} + "s </span>";
        
                                                    // If the count down is over, write some text 
                                                    if (distance_{{$i}} < 0) {
                                                        clearInterval(x);
                                                        document.getElementById("demo_{{$i}}").innerHTML = "EXPIRED";
                                                    }
                                                    }, 1000);
                                                    </script>
                                              
                                                
                                            @if(empty($udata->brackout))
                                                <td> 00:00 </td>
                                              @else
                                                <td id="demo_{{$i}}" class="req_date">{{ isset($udata->brackout) ? $udata->brackout : Null}}</td>
                                            @endif
                                            <td class="action_tooltip" style="width:140px; display: flex; column-gap: 5px;">
                                                <a href="javascript::void(0)" class="show_clockd" open-detail="clock_detail_{{$udata->id}}"> 
                                                <button type="button" value="{{ $udata->id }}" class="btn btn-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a> 
                                               
												{{-- @can('uagent-delete') --}}
												
											   <a href="{{ url('admin/clockinfo/delete',$udata->id )}}"> 
											   <button type="button" value="{{ url('admin/clockinfo/delete',$udata->id )}}" class="btn btn-danger btn-sm radius-30 px-4" onclick="return confirm('Are You Sure Delete This Record..!')"><i class="bx bx-trash"></i><span class="tooltip">Delete</span></button></a>


                                            


                                                <form action="{{ url('admin/clockinfo/logout' )}}" method="post">
                                                @csrf
                                               <input type="hidden" name="id" value="{{$udata->id}}">
											   <button type="submit" value="{{ url('admin/clockinfo/breakout',$udata->id )}}" class="btn btn-primary btn-sm radius-30 px-4" onclick="return confirm('Are You Sure Logout This Record..!')"><i class="bx bx-log-out-circle"></i><span class="tooltip">L-Out</span></button>
                                            </form>
                                 

                                               <form action="{{ url('admin/clockinfo/breakout' )}}" method="post">
                                                @csrf
                                               <input type="hidden" name="id" value="{{$udata->id}}">
											   <button type="submit" value="{{ url('admin/clockinfo/breakout',$udata->id )}}" class="btn btn-success btn-sm radius-30 px-4" onclick="return confirm('Are You Sure Break Out This Record..!')"><i class="bx bx-coffee-togo"></i><span class="tooltip">Break Out</span></button>
                                            </form>
                                               
                                               <div class="clock_details" id="clock_detail_{{$udata->id}}">
                                                   <p class='close'>X</p>
                                                    <h4>Clock In Detail</h4>
                                                    <table class="table mb-0" id="carrier_table">
                    								<thead class="table-light">
                    									<tr>
                                                            <th>No</th>
                                                            <th>User Name</th>
                                                            <th>Time IN</th>
                                                            <th>Time Out</th>
                                                            <th>Date</th>
                                                         
                    									</tr>
                    								</thead>
                    								<tbody>
                    								@php
                    								$i = 0;
                    								$data = DB::table('clockin_infos')->where('clockin_id', $udata->id)->get();
                    								@endphp
                                                    @foreach($data as $udata)
                                                                @php
                                                                    $id = $udata->user_id;
                                                                    $uname = App\Models\User::where('id',$udata->user_id)->first();
                                                                    $name = $uname->name ?? Null ;
                                                                    $officerid = $uname->officerid ?? Null ;
                                                                @endphp
                                                            <tr>
                                                                <td>{{ ++$i }}</td>
                                                                <td>{{$name }}</td>
                                                                
                                                                @if(empty($udata->brackin))
                                                                <td> 00:00 </td>
                                                                @else
                                                                    <td >{{ isset($udata->brackin) ? $udata->brackin : Null}}</td>
                                                                @endif
                    
                    
                                                                @if(empty($udata->brackout))
                                                                    <td> 00:00 </td>
                                                                  @else
                                                                    <td id="demo_{{$i}}" class="req_date">{{ isset($udata->brackout) ? $udata->brackout : Null}}</td>
                                                                @endif
                                                                <td>{{ $udata->created_at }}</td>
                                                                
                                                            </tr>
                                                    @endforeach
                    								</tbody>
                    							</table>
                                               </div>
                                            </td>
                                        </tr>
                                        <?php $ii++; ?>
                                @endforeach
								</tbody>
							</table>
							
							<table class="table mb-0" id="carrier_table" style="display:none">
                                        <thead class="table-light">
                                            <tr>
                                                <th>No</th>
                                                {{-- <th>User Id</th> --}}
                                                <th>User Name</th>
                                                <th>Time IN</th>
                                                <th>Time Out</th>
                                                <th>Date</th>
                                                <th>B-Timer</th>
                                                <th >Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                        $i = 0;
                                        @endphp
                                        @foreach($clockin as $udata)
                                                    @php
                                                        $id = $udata->user_id;
                                                        $uname = App\Models\User::where('id',$id)->first();
                                                        $name = $uname->name ?? Null ;
                                                        $officerid = $uname->officerid ?? Null ;
        
                                                        $datad = $udata->brackout;
                                                    @endphp
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    {{-- <td>{{ $officerid }}</td> --}}
                                                    <td>{{$name }}</td>
                                                    {{-- <td>{{ substr($udata->timein, 10)  }}</td> --}}
                                                    @php
                                                         $current_date = date("Y-m-d");
                                                        $olddate =  $udata->date_data;
                                                        //dd($current_date);
                                                    @endphp
                                                    
                                                    @if($current_date == $udata->date_data)
                                                        <td style="color:green;">{{ $udata->timein }}</td>
                                                    @else
                                                        <td>{{ $udata->timein }}</td>
                                                    @endif
        
        
                                                    @if(empty($udata->timeout))
                                                    <td> 00:00 </td>
                                                    @else
                                                        <td >{{ isset($udata->timeout) ? $udata->timeout : Null}}</td>
                                                    @endif
                                                    
                                                    <td>{{ $udata->date_data }}</td>
        
                                                    <script>
        
                                                        // Set the date we're counting down to
                                                        // 62d 21h 41m 35s
                                                        var countDownDate_{{$i}} = new Date("<?php echo $datad; ?>").getTime();
                                                        // var countDownDate = new Date("Jan 5, 2023 15:37:25").getTime();
                                                        // Update the count down every 1 second
                                                        var x_{{$i}} = setInterval(function() {
            
                                                        // Get today's date and time
                                                        var now_{{$i}} = new Date().getTime();
                                                        var currentdate_{{$i}} = new Date(); 
                                                            var datetime_{{$i}} = currentdate_{{$i}}.getFullYear() + "-"
                                                                        + (currentdate_{{$i}}.getMonth()+1)  + "-" 
                                                                        + currentdate_{{$i}}.getDate() + " "  
                                                                        + currentdate_{{$i}}.getHours() + ":"  
                                                                        + currentdate_{{$i}}.getMinutes() + ":" 
                                                                        + currentdate_{{$i}}.getSeconds();
            
                                                                        console.log(datetime_{{$i}});
                                                        //document.write(datetime);
                                                        // Find the distance between now and the count down date
                                                        var distance_{{$i}} =  currentdate_{{$i}} - countDownDate_{{$i}}    ;
                                                        // Find the distance between now and the count down date
                                                        // var distance_{{$i}} = now_{{$i}} - countDownDate_{{$i}} ;
                                                        // Time calculations for days, hours, minutes and seconds
                                                        var days_{{$i}} = Math.floor(distance_{{$i}} / (1000 * 60 * 60 * 24));
                                                        var hours_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                        var minutes_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60 * 60)) / (1000 * 60));
                                                        var seconds_{{$i}} = Math.floor((distance_{{$i}} % (1000 * 60)) / 1000);
                                                        if(hours_{{$i}}>=30){
                                                            var class_{{$i}} = "red";
                                                        }else{
                                                            var class_{{$i}} = "red";
                                                        }
                                                        // Output the result in an element with id="demo"
                                                        document.getElementById("demo_{{$i}}").innerHTML = "<span>"+hours_{{$i}} + "h </span>"
                                                        + "<span>"+minutes_{{$i}} + "m </span>" + "<span>"+seconds_{{$i}} + "s </span>";
            
                                                        // If the count down is over, write some text 
                                                        if (distance_{{$i}} < 0) {
                                                            clearInterval(x);
                                                            document.getElementById("demo_{{$i}}").innerHTML = "EXPIRED";
                                                        }
                                                        }, 1000);
                                                        </script>
                                                      
                                                        
                                                    @if(empty($udata->brackout))
                                                        <td> 00:00 </td>
                                                      @else
                                                        <td id="demo_{{$i}}" class="req_date">{{ isset($udata->brackout) ? $udata->brackout : Null}}</td>
                                                    @endif
                                                    <td class="action_tooltip">
                                                        <a href="{{ url('admin/brackin/details',$udata->id )}}"> 
                                                        <button type="button" value="{{ $udata->id }}" class="btn btn-outline-info btn-sm radius-30 px-4"><i class="bx bx-show"></i><span class="tooltip">View</span></button></a> 
                                                    </td>
                                                </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--end page wrapper -->
    </div>
  </div>
</div>
<script>
    $(document).ready(function(){
        $("a.show_clockd").click(function(){
            var data = $(this).attr('open-detail');
            $("#"+data).addClass("show");
            $("body").addClass("open");
        })
        
        $(".clock_details p.close").click(function(){
            $(".clock_details").removeClass("show");
            $("body").removeClass("open");
        })
    })
</script>
@include('backend.common.footer')
@endsection

