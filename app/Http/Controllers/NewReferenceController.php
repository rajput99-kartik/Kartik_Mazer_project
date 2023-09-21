<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Load;
use App\Models\User; 
use App\Models\Company;
use App\Models\EquipmentType;
use App\Models\Truck_search;
use App\Models\LoadComment;
use App\Models\NewReference;
use App\Models\AssignUserTeam;
use DateTime;
use App\Mail\NotifyMail;
use App\Models\Notification;


class NewReferenceController extends Controller
{
        public function ReferencSearch(Request $request){
          $ref = $request->input('referenc');
          
                $url = "https://crmonline.co.in/api/ref/".$ref;
                
                //dd( $url );
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                
                $headers = array(
                    "X-Custom-Header: header-value",
                    "Content-Type: application/json"
                );
                curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($curl, CURLOPT_HEADER, true);
                $response = curl_exec($curl);
                curl_close($curl);
                
                $response = curl_exec($curl);
                $load_reference =   array($response) ;
                
            	    if($load_reference){
            	       // print_r($response); 
            	        $load_reference = $response;
            	        
            	    }else{
            	        print_r($error_msg);
            	    }
            	    
                        //$load_reference = json_decode($response);
                        
                        //   $load_reference = DB::table('loads')->where([
                        //     ['ref_no', '=', $ref],
                        //     ])->first();
                            
                        //  dd($load_reference);
              $Agent= '';
              $LoadComment= '';
              $page = 'Load'; 
          return view('frontend.newportal.referance-details', compact('load_reference','LoadComment','Agent'));
        }
        
        
    public function showload(Request $request,$ref){

       $Load = Load::with('usersref')->where('ref_no', $ref)->first();
        return json_encode($Load);
        return [
            "status" =>200,
            "data" =>$Load,
             
        ];
    }
}
