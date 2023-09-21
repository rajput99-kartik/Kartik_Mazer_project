<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;



use App\Models\User;
use App\Models\Dat;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Auth;


class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

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
        // $dat_details = \DB::table('dat_login')->first();
        $dat_details = \DB::table('dat_login')->first();
        $data= json_decode( json_encode($dat_details), true);
    	$user= '{  "username": "'.$dat_details->username.'",  "password": "'.$dat_details->password.'"}';
    	   \Log::info($user);
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://identity.api.nprod.dat.com/access/v1/token/organization",// your preferred link developermode
        // CURLOPT_URL => "https://identity.api.dat.com/access/v1/token/organization",// live your preferred link live link
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
        ),
        ));
    
    	$response = curl_exec($curl);
    	curl_close($curl);
    	$res = json_decode($response);
    			
    	if(!empty($res)){
    		$datupdate = DB::update('update dat_login set accessToken =? where user_id = ?',[ $res->accessToken, $dat_details->user_id ]); // single user 
    	}	   	   
    
    	\Log::info("Access token successfuly generated.");
    	
       //$res2 = json_decode($response2);
       //\Log::info($response2);
    
        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */
    }
    
     /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    
}
