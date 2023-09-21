
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

<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:void(0);" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
<footer class="page-footer">
    <p class="mb-0">
    All Rights Reserved by {{ PROJECT_NAME }}.
    </p>
</footer>


@include('backend.common.notifications')