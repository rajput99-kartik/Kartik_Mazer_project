<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


use App\Models\User;
use App\Models\Dat;
use App\Models\Load;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Auth;

class UserToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'token:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
     
    public function handle(){
        $datainfo=  Dat::get();
        $dat_details11 = DB::table('dat_login')->first();
        foreach($datainfo as $dat_details){ 
                    if(!empty($dat_details->username_dat)){
                        //   $dat_details = \DB::table('dat_login')->where('user_id', 1)->first();
                	   $data= json_decode( json_encode($dat_details), true);
                	   $user= '{  "username": "'.$dat_details->username_dat.'" }';
                	   \Log::info($user);
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://identity.api.nprod.dat.com/access/v1/token/user",// development  your preferred link
                        // CURLOPT_URL => "https://identity.api.dat.com/access/v1/token/user",// your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POST => 1,
                        CURLOPT_POSTFIELDS => $user,
                        CURLOPT_HTTPHEADER => array(
                        // Set Here Your Requesred Headers
                        'Content-Type: application/json',
                        "Authorization: Bearer ".$dat_details11->accessToken.""
                        ),
                        ));
                
                    	$response = curl_exec($curl);
                    	curl_close($curl);
                    	$res = json_decode($response);
                    	//$data= json_decode( json_encode($response), true);
                	
                		if(!empty($res)){
                			$datupdate = DB::update('update dat_login set token =? , accessToken =? where user_id = ?',[ $res->accessToken, $dat_details11->accessToken, $dat_details->user_id ]);
                			
                			        $user = Load::all();
                                foreach( $user as  $users){
                                    $load = User::where('id', $users->user_id)->get();
                                  foreach($load as $loads){
                                    $datupdate = DB::update('update loads set agent_name = ? where user_id = ?',[ $loads->name, $loads->id ]); // single 
                                  }
                                }
                		}
                    }else{
                            $dat_details11 = DB::table('dat_login')->first();
                            $datupdate = DB::update('update dat_login set token =? , accessToken =? , username_dat=? where user_id = ?',[ $dat_details11->token, $dat_details11->accessToken, $dat_details11->username_dat, $dat_details->user_id ]);
                    }
                		
        		continue;
         }		
		\Log::info("User acceess token genrated!");
    	//\Log::info($data);
    } 
//     public function handle(){
//         $aid = Auth::id();
//         $mid = User::where('id', $aid)->pluck('dat_user_auth_status')->first();
//         $dat_details = '';
        
//         if($mid == 0){
// 		    $dat_details = DB::table('dat_login')->first();
//         }else{
//             $uaid = Auth::id();                
// 		    $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
//         }
        
//         $dat_details1 = \DB::table('dat_login')->first();
        
//         // $uaid = Auth::id();                
// 		//  $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
//         // $dat_details = \DB::table('dat_login')->first();
// 	   $data= json_decode( json_encode($dat_details), true);
// 	   $user= '{  "username": "'.$dat_details->username_dat.'" }';
// 	   \Log::info($user);
//         $curl = curl_init();
//         curl_setopt_array($curl, array(
//         // CURLOPT_URL => "https://identity.api.nprod.dat.com/access/v1/token/user",// your preferred link
//         CURLOPT_URL => "https://identity.api.dat.com/access/v1/token/user",// your preferred link
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => "",
//         CURLOPT_TIMEOUT => 30000,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => "POST",
//         CURLOPT_POST => 1,
//         CURLOPT_POSTFIELDS => $user,
//         CURLOPT_HTTPHEADER => array(
//         // Set Here Your Requesred Headers
//         'Content-Type: application/json',
//         "Authorization: Bearer ".$dat_details1->accessToken.""
//         ),
//         ));

//     	$response = curl_exec($curl);
//     	curl_close($curl);
//     	$res = json_decode($response);
    	
//     	//dd($res);
//     	//$data= json_decode( json_encode($response), true);
	
// 		if(!empty($res)){
// 		    $datupdate = DB::update('update dat_login set token =? where user_id = ?',[ $res->accessToken, $dat_details->user_id ]); //single user id 
		    
// 		}	  	   
// 		\Log::info("User acceess token genrated!");
//     	//\Log::info($data);
//     }
}
