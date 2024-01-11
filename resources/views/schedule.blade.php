@extends('backend.layouts.master')
@section('title','Api Setting')
@section('content')



            <?php 
        
                    $ip = getenv("REMOTE_ADDR") ;
                    $ipchecker =   App\Models\IpChecker::where('ip_address', $ip)->where('whitelisted', 1)->first();
                    // dd($ipchecker);
                    if($ipchecker == null){
                        Session::flush();
                       return  Route::resource('login', 'LoginController');
                    }
                    
            
                    //for logout if user inactive
                    $session_id = Session::all();
                    $authstatus = Auth::user()->status ;
                    $url = url('login');
                    if ($authstatus == 0){
                        Session::flush();
                        return  Route::resource('login', 'LoginController');
                    }
            ?>
		


            <center>
            <h2>Schedule Run By Cron Job</h2>
            </center>
            // <?php
            
                  session()->flash('success', 'Cron Job successfully updated.');
            
            // ?>
            <script>window.location = "/admin/setting/api";</script>


@include('backend.common.footer')
@endsection