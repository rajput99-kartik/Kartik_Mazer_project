<header>
    <style>
        ul#clock_in_out button {padding: 3px 6px;box-shadow: unset !important;font-size: 11px;margin: 0px 5px;}
    </style>
    <?php 
    
    // $ip = getenv("REMOTE_ADDR") ;
    // $ipchecker =   App\Models\IpChecker::where('ip_address', $ip)->where('whitelisted', 1)->first();
    //dd($ipchecker);
    
    // if($ipchecker == null){
        //     Session::flush();
        //     return  Route::resource('login', 'LoginController');
        // }
        
        //for logout if user inactive
        $session_id = Session::all();
        $authstatus = Auth::user()->status ;
        $url = url('login');
        if ($authstatus == 0){
            Session::flush();
            return  Route::resource('login', 'LoginController');
        }
        ?>
        <?php 
        $current_userid = Auth::id();
        $notification_data = App\Models\Notification::where('assignto_id', $current_userid)->where('status', '0')->get();
        $notification_res = App\Models\Notification::where('assignto_id', $current_userid)->orderBy('id', 'DESC')->limit(14)->get();
        //dd($notification_res);
        $notification_count = $notification_data->count();
        //company setting data
        $CompanyDetail = App\Models\Companydetail::first();
        ?>
        
        <div class="topbar d-flex align-items-center">
            <nav class="navbar navbar-expand">
                <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                </div>
                
                <div class="search-bar flex-grow-1">
                    <div class="position-relative search-bar-box">
                        <input type="number" class="form-control" id="referenc" placeholder="Load Referenc...">
                        <span class="position-absolute top-50 search-show translate-middle-y"><!-- i class='bx bx-search'></i --></span>
                        <span class="position-absolute top-50 translate-middle-y search_icon"><i class='bx bx-search'></i></span>
                    </div>
                </div>
                <!--<a href="https://www.amblogistic.us/bug-fix/" target="_blank" id="bugs" class="btn btn-danger">Report Bug</a>	-->
                
                <div class="top-menu ms-auto">
                    
                    <ul class="navbar-nav align-items-center" id="clock_in_out">
                        <!--<li class="any-help">-->
                            <!--    <a href="tel:{{ isset($CompanyDetail->company_phone) ? $CompanyDetail->company_phone : Null }}"><i class="fadeIn animated bx bx-help-circle"></i> Any Help</a>-->
                            <!--</li>-->
                            
                            {{-- start work of timer  --}}
                            @php
                            $userid = Auth::id();
                            $clockindata = App\Models\Clockin::where('user_id', $userid)
                            ->orderBy('id', 'DESC')
                            ->latest()
                            ->take(1)
                            ->get();
                            @endphp
                            
                            <table class="table mb-0">
                                <tbody>
                                    @php
                                    date_default_timezone_set('America/New_York');
                                    @endphp
                                    @foreach ($clockindata as $udata)
                                    @php
                                    $j = 0;
                                    $id = $udata->user_id;
                                    $uname = App\Models\User::where('id', $id)->first();
                                    $name = $uname->name ?? null;
                                    $officerid = $uname->officerid ?? null;
                                    $datad = $udata->brackout;
                                    @endphp
                                    @php
                                    $timein = $udata->timein;
                                    $timeout = $udata->timeout;
                                    $totalhours = date_create($timein)
                                    ->diff(date_create($timeout))
                                    ->format('%H:%i:%s');
                                    @endphp
                                    {{-- <td> {{ $totalhours }}</td> --}}
                                    <?php ++$j; ?>
                                    <script>
                                        // Set the date we're counting down to
                                        // 62d 21h 41m 35s
                                        var countDownDate_{{ $j }} = new Date("<?php echo $datad; ?>").getTime();
                                        // var countDownDate = new Date("Jan 5, 2023 15:37:25").getTime();
                                        // Update the count down every 1 second
                                        var x_{{ $j }} = setInterval(function() {
                                            
                                            // Get today's date and time
                                            var now_{{ $j }} = new Date().getTime();
                                            var currentdate_{{ $j }} = new Date();
                                            var datetime_{{ $j }} = currentdate_{{ $j }}.getFullYear() + "-" +
                                            (currentdate_{{ $j }}.getMonth() + 1) +
                                            "-" +
                                            currentdate_{{ $j }}.getDate() + " " +
                                            currentdate_{{ $j }}.getHours() + ":" +
                                            currentdate_{{ $j }}.getMinutes() + ":" +
                                            currentdate_{{ $j }}.getSeconds();
                                            
                                            // console.log(datetime_{{ $j }});
                                            //document.write(datetime);
                                            // Find the distance between now and the count down date
                                            var distance_{{ $j }} = currentdate_{{ $j }} -
                                            countDownDate_{{ $j }};
                                            // Find the distance between now and the count down date
                                            // var distance_{{ $j }} = now_{{ $j }} - countDownDate_{{ $j }} ;
                                            // Time calculations for days, hours, minutes and seconds
                                            var days_{{ $j }} = Math.floor(distance_{{ $j }} / (1000 * 60 * 60 * 24));
                                            var hours_{{ $j }} = Math.floor((distance_{{ $j }} % (1000 * 60 * 60 * 24)) / (
                                            1000 * 60 * 60));
                                            var minutes_{{ $j }} = Math.floor((distance_{{ $j }} % (1000 * 60 * 60)) / (
                                            1000 * 60));
                                            var seconds_{{ $j }} = Math.floor((distance_{{ $j }} % (1000 * 60)) / 1000);
                                            if (hours_{{ $j }} >= 30) {
                                                var class_{{ $j }} = "red";
                                            } else {
                                                var class_{{ $j }} = "red";
                                            }
                                            // Output the result in an element with id="demo"
                                            document.getElementById("timerinfo_{{ $j }}").innerHTML = "<span>" +
                                                hours_{{ $j }} +  "h </span>" + "<span>" + minutes_{{ $j }} + "m </span>" + "<span>" + seconds_{{ $j }} + "s </span>";                                                                   
                                                
                                                // If the count down is over, write some text 
                                                if (distance_{{ $j }} < 0) {
                                                    clearInterval(x);
                                                    document.getElementById("timerinfo_{{ $j }}").innerHTML = "EXPIRED";
                                                }
                                            }, 1000);
                                        </script>
                                        @if (empty($udata->brackout))
                                        
                                        @else
                                        <td id="timerinfo_{{ $j }}" class="req_date">
                                            {{ isset($udata->brackout) ? $udata->brackout : null }}</td>
                                            @endif
                                            
                                            <?php ?>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                    {{-- end work of timer --}}
                                    
                                    
                                    <?php
                                    $clockin =  App\Models\Clockin::where('user_id', Auth::id())
                                    ->where('date_data', date("Y-m-d"))->where('clockin', 1)->first();
                                    ?>
                                    
                                    @if($clockin)
                                    @php
                                    date_default_timezone_set('America/New_York');
                                    @endphp
                                    <form action="{{url('admin/clockin')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="clockin" value="0">
                                        <input type="hidden" name="clockout" value="1">
                                        <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">
                                        <input type="hidden" name="timeout" value="<?php echo date("h:i:s A"); ?>">
                                        <input type="hidden" name="timein" value="0">
                                        <input type="hidden" name="userid" value="<?php echo Auth::id();?>">
                                        <button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Are You Sure ! You want to logout today..!')">Clock Out</button>
                                    </form>
                                    
                                    <?php
                                    $clockin =  App\Models\Clockin::where('user_id', Auth::id())
                                    ->where('date_data', date("Y-m-d"))->where('clockin', 1)->first();
                                    
                                    ?>
                                    
                                    @if($clockin->brackout == 0)
                                    <form action="{{url('admin/brackin')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="clockin_id" value="<?php echo $clockin->id ; ?>">
                                        
                                        <?php 
                                        
                                        $ddate = date("Y-n-j ") . date("H:i:s"); 
                                        ?>
                                        
                                        <input type="hidden" name="brackin" value="<?php echo $ddate; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo Auth::id();?>">
                                        <button type="submit" class="btn btn-success btn-sm">Break In</button>
                                    </form>
                                    @else
                                    
                                    <?php 
                                    
                                    $ddate = date("Y-n-j ") . date("H:i:s"); 
                                    ?>
                                    
                                    <form action="{{url('admin/brackout')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="clockin_id" value="<?php echo $clockin->id ; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo Auth::id();?>">
                                        <input type="hidden" name="brackout" value="<?php echo $ddate; ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Break Out</button>
                                    </form>
                                    @endif
                                    @else
                                    
                                    <?php 
                                    $ddate = date("Y-n-j ") . date("H:i:s"); 
                                    ?>
                                    <form action="{{url('admin/clockin')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="clockin" value="1">
                                        <input type="hidden" name="clockout" value="0">
                                        <input type="hidden" name="date" value="<?php echo date("Y-m-d"); ?>">
                                        <!--<input type="hidden" name="timein" value="<?php //echo $ddate; ?>">-->
                                        <input type="hidden" name="timein" value="<?php echo date("h:i:s A"); ?>">
                                        <input type="hidden" name="timeout" value="0">
                                        <input type="hidden" name="userid" value="<?php echo Auth::id();?>">
                                        {{-- <button type="submit" class="btn btn-primary">Clock Out</button> --}}
                                        <button type="submit" class="btn btn-primary btn-sm">Clock In</button>
                                    </form>
                                    @endif
                                    <li class="nav-item dropdown dropdown-large">
                                        <div class="notification nav-link -toggle dropdown-toggle-nocaret position-relative" href="javascript:void(0);" role="button" id=""  aria-expanded="false"> <span class="alert-count">
                                            {{ $notification_count}}
                                        </span>
                                        <i class='bx bx-bell'></i>
                                    </div>
                                    
                                    <div class="dropdown-menu dropdown-menu-end notification_box" id="another-element"data-hide="hide">
                                        <a href="javascript:void(0);">
                                            <div class="msg-header">
                                                <p class="msg-header-title">Notifications</p>
                                                <p class="msg-header-clear ms-auto" id="AllReadNotification" value="{{Auth::id()}}">Read All</p>
                                            </div>
                                        </a>
                                        
                                        <div class="header-notifications-list">
                                            @foreach ($notification_res as $notify_data )
                                            <?php 
                                            $ul = $notify_data->url;
                                            if(!empty($ul)){
                                                ?>
                                                <div class="noti-list" status="{{$notify_data->status}}" id="notification_col" value="{{ $notify_data->id }}">
                                                    <a href="javascript:void(0);">
                                                         <h6> <i class="bx bx-group"></i><span class="msg-time float-end" style="float: none !important;" id="notificationsRead" >{{ $notify_data->title }}</span></h6>
                                                         
                                                         </a> 
                                                         
                                                         <span id="notificationsRead" value="{{ $notify_data->id }}"><?php if($notify_data->status == '0'){ ?><i class="bx bx-check"></i><?php } ?></span>
                                                </div>

                                               <div class=""> <h6 class="msg-name"><i class="bx bx-group"></i> <a href="{{ url($notify_data->url) }}"><span class="msg-time float-end">{{ $notify_data->title }}</a></span></h6> <span id="notificationsRead" value="{{ $notify_data->id }}"><i class="bx bx-message"></i></span></div>
                                                <?php }else {?>
                                                    <div class="noti-list" status="{{$notify_data->status}}"><a href="{{ url('admin/notification').'/'.$ul}}"> <h6> <i class="bx bx-group"></i><span class="msg-time float-end"  style="float: none !important;">{{ $notify_data->title }}</span></h6></a><i class="bx bx-check"></i></div>
                                                    <?php }?>
                                                    @endforeach
                                                </div>								
                                                
                                                <a href="{{url('admin/notification')}}">
                                                    <div class="text-center msg-footer"> View All Notifications</div>
                                                </a>
                                            </div>
                                        </li>
                                        <?php
                                        $current_userid = Auth::id();
                                        $LoadComment_data = App\Models\LoadComment::where('receiver_id', $current_userid)->where('status', '0')->get();
                                        $LoadComment_res = App\Models\LoadComment::where('receiver_id', $current_userid)->orderBy('id', 'DESC')->limit(5)->get();
                                        $LoadComment_count = $LoadComment_data->count();
                                        $CarrierRequest_data = App\Models\CarrierRequest::where('receiver_id', $current_userid)->where('check_status', '0')->get();
                                        $CarrierRequest_res = App\Models\CarrierRequest::where('receiver_id', $current_userid)->orderBy('id', 'DESC')->limit(5)->get();
                                        $CarrierRequest_count = $CarrierRequest_data->count();
                                        $ShipperRequest_data = App\Models\Shipper_request::where('receiver_id', $current_userid)->where('check_status', '0')->get();
                                        $ShipperRequest_res = App\Models\Shipper_request::where('receiver_id', $current_userid)->orderBy('id', 'DESC')->limit(5)->get();
                                        $ShipperRequest_count = $ShipperRequest_data->count();
                                        $total = $LoadComment_count + $CarrierRequest_count + $ShipperRequest_count;
                                        ?>
                                        
                                        <li class="nav-item dropdown dropdown-large">
                                            <div class="message nav-link -toggle dropdown-toggle-nocaret position-relative" href="javascript:void(0);" role="button" id="" aria-expanded="false"> <span class="alert-count">
                                                {{ $total}}
                                            </span>
                                            <i class="bx bx-message"></i>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-end message_box" id="another-element" data-hide="hide" style="display: none;">
                                            <a href="javascript:void(0);">
                                                <div class="msg-header">
                                                    <p class="msg-header-title">Messages</p>
                                                    <!--<p class="msg-header-clear ms-auto">Read All</p>-->
                                                    <p class="msg-header-clear ms-auto" id="AllReadMessageNotification" value="{{Auth::id()}}">Read All</p>
                                                </div>
                                            </a>
                                            <div class="header-notifications-list ps">
                                                @foreach ($CarrierRequest_res as $CarrierRequest )
                                                
                                                <div class="noti-list" status="{{$CarrierRequest->check_status}}" id="CarrierRequest_col" value="{{$CarrierRequest->id}}">
                                                    <a href="javascript:void(0)"> <h6> <i class="bx bx-group"></i> <span class="msg-time float-end" id="notificationsRead" value=""><b>MC:</b>{{$CarrierRequest->mc_no}} <b>Comment:</b>{{substr($CarrierRequest->comment, 0, 10) }}...</span></h6> </a><?php if($CarrierRequest->check_status == '0'){ ?><i class="bx bx-check"></i><?php } ?></div>
                                                    
                                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div>
                                                    
                                                    @endforeach
                                                    
                                                    
                                                    @foreach ($LoadComment_data as $loadComment )
                                                    
                                                    <div class="noti-list" status="{{$loadComment->status}}" id="loadComment_col" value="{{$loadComment->reference}}">
                                                        <a href="javascript:void(0)"> <h6> <i class="bx bx-group"></i> <span class="msg-time float-end" id="notificationsRead" value=""><b>Referenc:</b>{{$loadComment->reference}} <b>Comment:</b>{{$loadComment->message}}</span></h6> </a></div>
                                                        
                                                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div>
                                                        
                                                        @endforeach
                                                        
                                                        @foreach ($ShipperRequest_res as $ShipperRequest )
                                                        
                                                        <div class="noti-list" status="{{ $ShipperRequest->check_status }}" id="ShipperRequest_col" value="{{ $ShipperRequest->id }}">
                                                            <a href="javascript:void(0)"> <h6> <i class="bx bx-group"></i><span class="msg-time float-end" value=""><b>{{$ShipperRequest->type}}:</b>{{$ShipperRequest->comment}}</span></h6> </a><?php if($ShipperRequest->check_status == '0'){ ?><?php } ?></div>
                                                            
                                                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div>
                                                            
                                                            @endforeach
                                                            
                                                        </div>	
                                                        
                                                        <a href="{{url('admin/notification/messsage')}}">
                                                            <div class="text-center msg-footer"> View All Notifications</div>
                                                        </a>
                                                    </div>
                                                </li>
                                                
                                                <li class="nav-item dropdown dropdown-large">
                                                    
                                                    {{-- <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span class="alert-count">8</span>
                                                        
                                                        <i class='bx bx-comment'></i>
                                                        
                                                    </a> --}}
                                                    
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        
                                                        <a href="javascript:;">
                                                            
                                                            <div class="msg-header">
                                                                
                                                                <p class="msg-header-title">Messages</p>
                                                                
                                                                <p class="msg-header-clear ms-auto">Read All</p>
                                                                
                                                            </div>
                                                            
                                                        </a>
                                                        
                                                        <div class="header-message-list">
                                                            
                                                            <a class="dropdown-item" href="javascript:;">
                                                                
                                                                <div class="d-flex align-items-center">
                                                                    
                                                                    <div class="user-online">
                                                                        
                                                                        <img src="{{ url('public/backend/assets/images/avatars/avatar-1.png') }}" class="msg-avatar" alt="user avatar">
                                                                        
                                                                    </div>
                                                                    
                                                                    <div class="flex-grow-1">
                                                                        
                                                                        <h6 class="msg-name">Daisy Anderson <span class="msg-time float-end">5 sec
                                                                            
                                                                            ago</span></h6>
                                                                            
                                                                            <p class="msg-info">The standard chunk of lorem</p>
                                                                            
                                                                        </div>
                                                                        
                                                                    </div>
                                                                    
                                                                </a>
                                                                
                                                            </div>
                                                            
                                                            <a href="javascript:;">
                                                                
                                                                <div class="text-center msg-footer">View All Messages</div>
                                                                
                                                            </a>
                                                            
                                                        </div>
                                                        
                                                    </li>
                                                    
                                                </ul>
                                                
                                            </div>
                                            
                                            <div class="user-box dropdown">
                                                
                                                <?php 
                                                
                                                $userid = Auth::id();
                                                
                                                $userdata = App\Models\User::where('id', $userid)->first();
                                                
                                                $userdetail = App\Models\Userdetail::where('userid', $userid)->first();
                                                
                                                $img = '1';
                                                
                                                if (!empty($userdetail->profile_pic)) {
                                                    
                                                    $imga = $userdetail->profile_pic;
                                                    
                                                    $img = url('public/user-pic/').'/'.$imga;
                                                    
                                                }else {
                                                    
                                                    $img = ADMIN_FACKIMG_PATH ;
                                                    
                                                }
                                                
                                                $profile_type = $userdata->user_type;
                                                
                                                ?>
                                                
                                                <?php  
                                                
                                                // $image = DefaultImgPath;
                                                
                                                $image = '1';
                                                
                                                if(!empty($userdetail->profile_pic)){
                                                    
                                                    $image = url('public/user-pic/').'/'.$userdetail->profile_pic;
                                                    
                                                }
                                                
                                                ?>
                                                
                                                
                                                
                                                {{-- <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    
                                                    <img src="{{ url('public/user-pic/').'/'.$userdetail->profile_pic }}" class="user-img" alt="user avatar">
                                                    
                                                    <div class="user-info ps-3">
                                                        
                                                        <p class="user-name mb-0"> {{ Auth::user()->name }}</p>
                                                        
                                                        
                                                        
                                                    </div>
                                                    
                                                </a> --}}
                                                
                                                
                                                
                                                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    
                                                    <img src="{{ $img }}" class="user-img" alt="user avatar">
                                                    
                                                    {{-- <img src="https://crmonline.co.in/public/user-pic/{{$userdetail->profile_pic}}" alt="Admin" class="rounded-circle p-1" width="110"> --}}
                                                    
                                                    <div class="user-info ps-3">
                                                        
                                                        <p class="user-name mb-0"> {{ Auth::user()->name }}</p>
                                                        
                                                        <!-- <p class="designattion mb-0">Web Designer</p> -->
                                                        
                                                    </div>
                                                    
                                                </a>
                                                
                                                <ul class="dropdown-menu dropdown-menu-end profile_dropdown">
                                                    
                                                    <div class="user-header">
                                                        
                                                        <img src="{{ $img }}" class="user-img" alt="user avatar">
                                                        
                                                        <p class="user-name mb-0"> {{ Auth::user()->name }}</p>
                                                        
                                                    </div>
                                                    
                                                    <div class="user-body row">
                                                        
                                                        <div class="col-md-4 text-center">
                                                            
                                                            <a href="#">Activities</a>
                                                            
                                                        </div>
                                                        
                                                        <div class="col-md-4 text-center">
                                                            
                                                            @php
                                                            //$userid = Crypt::encrypt(Auth::id());
                                                            $userid = base64_encode(Auth::id());
                                                            @endphp
                                                            
                                                            <!--<a href="{{url('admin/users').'/'.$userid}}">My Details</a>-->
                                                            
                                                        </div>
                                                        
                                                        <div class="col-md-4 text-center">
                                                            
                                                            <a href="#">Lock</a>
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class="user-footer">
                                                        
                                                        <a href="{{url('admin/profile')}}">Update Profile</a>
                                                        
                                                        <a href="{{ route('logout') }}" class="btn-right" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                                                        
                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">-->
                                                            
                                                            @csrf
                                                            
                                                        </form>
                                                        
                                                    </div>
                                                    
                                                    
                                                    
                                                </ul>
                                                
                                            </div>
                                            
                                        </nav>
                                        
                                    </div>
                                    
                                </header>
                                
                                
                                
                                <!-- The Load refernce search modal start here-->
                                <div class="modal search_modal" id="LoadRefernceSearch">
                                </div>
                                <!-- The Load refernce search modal end here-->
                                
                                <!-- The Load refernce search modal start here-->
                                <div class="modal search_modal" id="CarrierCommentForm">
                                </div>
                                <!-- The Load refernce search modal end here-->
                                
                                <!-- The Load refernce search modal start here-->
                                <div class="modal search_modal" id="ShipperCommentForm">
                                </div>
                                <!-- The Load refernce search modal end here-->
                                
                                <script>
                                    $(".notification").click(function(){
                                        $(".notification_box").toggle();
                                    })
                                    $(".message").click(function(){
                                        $(".message_box").toggle();
                                    })
                                    
                                    
                                </script>