@extends('backend.layouts.master')
@section('title','Clock View')
@section('content')
		<!--start page wrapper -->
		<div class="page-wrapper">
			<div class="page-content">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                <p>{{ $message }}</p>
                </div>
                @endif
                <ul class="nav nav-tabs">
                  
                    <li class="pending_approval"><a href="{{url('/admin/assignuser/list')}}" data-toggle="tab" aria-expanded="true">All Clock</a>
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
                                        <th>User Id</th>
                                        <th>User Name</th>
                                        <th>Time IN</th>
                                        <th>Time Out</th>
                                        <th>Date</th>
                                        <th>B-Timer</th>
                                        <th style="width: 200px;">Action</th>
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
                                            <td>{{ $officerid }}</td>
                                            <td>{{$name }}</td>
                                            
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
                                               
												{{-- @can('uagent-delete') --}}
												|
											   <a href="{{ url('admin/clockinfo/delete',$udata->id )}}"> 
											   <button type="button" value="{{ url('admin/clockinfo/delete',$udata->id )}}" class="btn btn-outline-danger btn-sm radius-30 px-4" onclick="return confirm('Are You Sure Delete This Record..!')"><i class="bx bx-trash"></i><span class="tooltip">Delete</span></button></a>
											   {{-- @endcan --}}
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
@include('backend.common.footer')
@endsection

