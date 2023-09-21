<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Load;
use App\Models\User;
use App\Models\LoadRateHistory;
use App\Models\Company;
use App\Models\EquipmentType;
use App\Models\Truck_search;
use App\Models\LoadComment;
use App\Models\AssignUserTeam;
use DateTime;
use Carbon\Carbon;
use DataTables;


class LoadController extends Controller
{	
    public $user;
    public function __construct()
    {
         $this->middleware('permission:loads-list|loads-approve | loads-create|loads-edit|loads-delete|loads-reports', ['only' => ['index','store']]);
         $this->middleware('permission:loads-list', ['only' => ['list','list']]);
         $this->middleware('permission:loads-create', ['only' => ['create','store']]);
         $this->middleware('permission:loads-edit', ['only' => ['edit','update']]);

    
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }

  public function index(){
		$user_id = auth()->user()->id ;	
		$user = DB::table('users')->where([
						['id', '=', $user_id],
					  ])->first();

		$equipments = DB::table('equipment_types')->get(); 
		$dat_cities = DB::table('dat_cities')->get(); 
		
		$user_loads = DB::table('loads')->where([ ['user_id', '=', $user_id],['load_status', '=', '0'] ])->get(); 
		//$user_loads = DB::table('loads')->where([ ['user_id', '=', $user_id]])->get(); 
        $page = 'Load';
        return view('backend.loadsManagement.index', compact('page','equipments','dat_cities','user_loads'));
	}

  public function LoadReports(Request $request){
    if (is_null($this->user) || !$this->user->can('loads-reports')) {
      abort(403, 'Sorry !! You are Unauthorized to edit any user !');
    }
    $user_id = Auth::id();
	  $user = User::where('id',$user_id)->first();
    $userdata = User::where('status','1')->orderBy('id','DESC')->get();  
    
    
    //dd($userdata);
    return view('backend.loadsManagement.list', compact('userdata')); 
  }

  public function OldLoadReportslist(Request $request){
    if (is_null($this->user) || !$this->user->can('loads-reports')) {
        abort(403, 'Sorry !! You are Unauthorized to edit any user !');
    }
          $userid = 1 ;
          $user_id = base64_decode($userid);
          $user = User::where('id',$user_id)->first();
          $equipments = DB::table('equipment_types')->get();
          //die('here');
          $user_loads= Load::where('user_id',$user_id)->orderBy('created_at','DESC')->get();       
          //   $results = Load::sortBy('created_at', 'desc')->get();
          // $user_loads = Load::all();
          $user_loads = Load::orderBy('id', 'DESC')->get();
          
        //       $data = Inspector::latest('id')
        // ->select('id', 'firstname', 'status', 'state', 'phone')
        // ->where('firstname', 'LIKE', '%' . $searchtext . '%')
        // ->get() // now we're working with a collection
        // ->chunk(300);
          
         
           // dd($results);
      $page = 'Load';		
      return view('backend.loadsManagement.reportlist', compact('page','equipments','user_loads','userid', 'user_id'));
          
  }
  
  public function LoadReportslist(Request $request){
        if (is_null($this->user) || !$this->user->can('loads-reports')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }

              $fromDate =$request['fromdate']  ??  "";
              $toDate =$request['todate']  ??  "";
              
              $date = Carbon::now();
            // dd($date  );
              $search =$request['search']  ??  "";
              if(isset($search)){
                  $search =$request['search']  ??  "";
                  // dd($search);
                  if($search != ""){
                    $user_loads = Load::where('ref_no', 'LIKE', "%$search%")
                    ->orWhere('post_date', 'LIKE', "%$search%")
                    ->orWhere('load_state_origin', 'LIKE', "%$search%")
                    ->orWhere('load_city_desti', 'LIKE', "%$search%")
                    ->orWhere('full_partial_tl_ltl', 'LIKE', "%$search%")
                    ->orWhere('created_at', 'LIKE', "%$search%")
                    ->orWhere('equipments', 'LIKE', "%$search%")
                    ->paginate('15');
                    $user_loads->appends(array('search'=>  $search,));
                      if(count($user_loads )>0){
                        return view('backend.loadsManagement.manager.oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);
                      }
                      return back()->with('error','No results Found');
                  }else{
                    $user_loads =  Load::orderBy('id', 'DESC')->paginate('15');
                  }

              }
              // 2023-06-27 00:06:04.351213 Asia/Kolkata (+05:30)
             
              if(isset($fromDate)){
                  
                  if(empty($toDate) ){
                    
                        //if you want to selected date to current-date data then you can use this select only formdate only
                    
                            //  $user_loads = Load::whereBetween('created_at', [$fromDate, date('Y-m-d')])->paginate('15');
                            //  $user_loads =  $user_loads->appends(array('fromdate'=>  $fromDate,  'todate'=>  date('Y-m-d')));

                        //if we want to same date data then we use this function 
                        
                            $user_loads = Load::query()
                            ->whereDate('created_at', '>=', $fromDate)
                            ->whereDate('created_at', '<=', $fromDate)
                            ->paginate('15');

                  //  $toDate = '' ;
                    if(count($user_loads )>0){
                     return view('backend.loadsManagement.manager.oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);
                    }
                }
                
                
                $user_loads = Load::whereBetween('created_at', [$fromDate, $toDate])->paginate('15');
                $user_loads =  $user_loads->appends(array('fromdate'=>  $fromDate,  'todate'=>  $toDate));
                
                

                if(count($user_loads )>0){
                  return view('backend.loadsManagement.manager.oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);
                }
              }

              $userid = 1 ;
              $user_id = base64_decode($userid);
              $user = User::where('id',$user_id)->first();
              $equipments = DB::table('equipment_types')->get();
              //die('here');
              $user_loads= Load::where('user_id',$user_id)->orderBy('created_at','DESC')->get();       
              //   $results = Load::sortBy('created_at', 'desc')->get();
              // $user_loads = Load::all();
              $user_loads = Load::orderBy('id', 'DESC')->paginate('15');
              
          $page = 'Load';		
          return view('backend.loadsManagement.manager.oldreportlist', compact('page','equipments','user_loads','userid', 'user_id','search',
          'fromDate', 'toDate'));
        //   return view('backend.loadsManagement.oldreportlist', compact('page','equipments','user_loads','userid', 'user_id','search'));
              
  }

  public function OldLoadGet(Request $request){

    $user_id = Auth::id();
	  $user = User::where('id',$user_id)->first();

    $user_loads = Load::where('load_status','1')->where('user_id',$user_id)->orderBy('id','DESC')->get();
    $equipments = DB::table('equipment_types')->get(); 
		$dat_cities = DB::table('dat_cities')->get(); 
    //dd($userdata);
    return view('backend.loadsManagement.old_loads', compact('user_loads','equipments','dat_cities')); 

  }

  public function LoadRePost(Request $request){
		$user_id = auth()->user()->id;
	
		$user = DB::table('users')->where([
						['id', '=', $user_id],
					  ])->first();

          $loadinfo = Load::where('load_dat_id',$request->input("datId"))->first();
					
            $equipment = DB::table('equipment_types')->where([ ['equip_name', '=', $loadinfo->equipments ] ])->first();
            $ref_no = rand(0000000,9999999);
            //$micro = rand(000,999);
            
            			
            $tz = date_default_timezone_set('America/New_York');
            
                 $pick_up_date = date('Y-m-d');
                 $currenttime= strtotime("+1 days", strtotime($pick_up_date));
                 $nex_date= date("Y-m-d", $currenttime);
                 $zulu_time = date('h:i:s.u');
                 $Date = substr($zulu_time,0, -3);
                 $PickDate = $nex_date.'T'.$Date.'Z';
                 //print_r($loadinfo);
                 
                    $aid = Auth::id();
                    $mid = User::where('id', $aid)->pluck('dat_user_auth_status')->first();
                    $dat_details = '';
                    
                    if($mid == 0){
            		    $dat_details = DB::table('dat_login')->first();
                    }else{
                        $uaid = Auth::id();                
            		    $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
                    }
                    

            		$pick_cities = DB::table('dat_cities')->where([ ['city_id', '=', $loadinfo["load_state_origin_id"] ] ])->first();
            		$drop_cities = DB::table('dat_cities')->where([ ['city_id', '=', $loadinfo["load_city_desti_id"] ] ])->first();
            		
                


                $price= $loadinfo["load_offer_rate"];
                if($price){
                  $rate = 
                  '
                  "loadBoard":
                      {
                        "includesExtendedNetwork": true,
                        "transactionDetails": 
                        {
                            "transactionType": "NONBOOKABLE_OFFER_RATE",
                            "loadOfferRateUsd": '.$loadinfo["load_offer_rate"].'
                        }
                      }';
                }
                else{
                  $rate =  '  "loadBoard": true ';
                }

        
            $load_field = '{
              
              "freight": {
                "equipmentType": "'.$equipment->equip_type.'",
                "fullPartial": "'.$loadinfo["full_partial_tl_ltl"].'",
                "comments": [
                  {
                    "comment": "'.$loadinfo["special_requirement"].'"
                  }
                ],
            	"commodity": {
            		"details": "'.$loadinfo["load_commodity"].'"
            	},
                "lengthFeet": '.$loadinfo["length_load"].',
                "weightPounds": '.$loadinfo["weight_load"].'
              },
              "lane": {
                "origin": {
                  "city": "'.$pick_cities->city.'",
                  "stateProv": "'.$pick_cities->state_code.'",
                  "postalCode": "'.$pick_cities->zip.'"
                },
                "destination": {
                  "city": "'.$drop_cities->city.'",
                  "stateProv": "'.$drop_cities->state_code.'"
                }
              },
              "exposure": {
                "earliestAvailabilityWhen": "'.$PickDate.'",
                "latestAvailabilityWhen": "'.$PickDate.'",
                "preferredContactMethod": "EMAIL",
                "audience": {
                  '.$rate.'
                  
                  }
              },
          
          "referenceId": "'.$ref_no.'"
        }';

        //print_r($load_field);die;

        // $URL = "https://freight.api.nprod.dat.com/posting/v2/loads";
        $URL = "https://freight.api.dat.com/posting/v2/loads";
        		
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => $URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_TIMEOUT => 30000,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $load_field,
        CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        "Authorization: Bearer ".$dat_details->token.""
        ),
        ));
        	$response = curl_exec($curl);
          if (curl_errno($curl)) 
          {
            		$error_msg = curl_error($curl);
                print_r($error_msg);
          }	
        	curl_close($curl);
        
        	$res = json_decode($response);
        //print_r($res);die;
  		
  
    if(isset($res->id))	
    	{
				$new_load = new Load;	
                $new_load->load_dat_id = $res->id;
                $new_load->user_id = $user_id;
                $new_load->ref_no = $ref_no;
                $new_load->load_state_origin_id = $pick_cities->city_id;
                $new_load->load_state_origin = $pick_cities->city;
                $new_load->load_state_code = $pick_cities->state_code;
                $new_load->load_zipcode_origin = $pick_cities->zip;
                $new_load->load_city_desti_id = $drop_cities->city_id;
                $new_load->load_city_desti = $drop_cities->city;
                $new_load->drop_state_code = $drop_cities->state_code;
                $new_load->equipments = $equipment->equip_name;
                $new_load->full_partial_tl_ltl = $loadinfo["full_partial_tl_ltl"];
                $new_load->weight_load = $loadinfo["weight_load"];
                $new_load->length_load = $loadinfo["length_load"];
                $new_load->post_date = date('Y-m-d');
                $new_load->dat_pick_date = $PickDate;
                $new_load->load_offer_rate = $loadinfo["load_offer_rate"];
                $new_load->special_requirement = $loadinfo["special_requirement"];
                $new_load->load_commodity =$loadinfo["load_commodity"];
                $new_loadSave=$new_load->save();
                $Shipment_pickId = $new_load->id; 
			//print_r($res);die;
			return redirect('/admin/loads')->with('success', 'Load Post on DAT successfully!');
    				}
            else{
              return redirect('/old/loads')->with('error', 'Load posting faild,try sometime later!');
            }


    }

	/* New shipment create from load referenc Function Start Here */
	public function NewShipmentCreate(Request $request){  
		$user_id = auth()->user()->id ;
		$user = User::where('id',$user_id)->first();

		$data = $request->all();

     //$load = DB::table('loads')->where([ ['load_dat_id', '=', $data['load_id']] ])->first();
     //dd($load);

                    //   $dat_details = DB::table('dat_login')->first();
      
                    $aid = Auth::id();
                    $mid = User::where('id', $aid)->pluck('dat_user_auth_status')->first();
                    $dat_details = '';
                    
                    if($mid == 0){
            		    $dat_details = DB::table('dat_login')->first();
                    }else{
                        $uaid = Auth::id();                
            		    $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
                    }
                    
      $datId = $data['load_id'];
      
    //   $URL = "https://freight.api.nprod.dat.com/posting/v2/loads/".$datId."";
      $URL = "https://freight.api.dat.com/posting/v2/loads/".$datId."";
      
      $curl = curl_init();
      curl_setopt_array($curl,
      array(CURLOPT_URL => $URL,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FAILONERROR => true,
      CURLOPT_ENCODING => "",
      CURLOPT_TIMEOUT => 30000,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "DELETE",
      CURLOPT_POST => 1,
      CURLOPT_HTTPHEADER => array(
        
        'Content-Type: application/json',
        "Authorization: Bearer ".$dat_details->token."",
        
        ),
      ));
      
		$response = curl_exec($curl);
		$UpdateData = DB::update('update loads set load_status =? ,load_generate = ? where load_dat_id = ?' ,['1','1', $datId]);

		$load = Load::where('load_dat_id', $data['load_id'])->first();
		$Equipments = EquipmentType::get();

		$companies_data =  Company::where('user_id',$user_id)->where('approved','1')->get();
	  
		 DB::table('companies')->where([
			['user_id', '=', $user_id],['approved', '=', '1']
		 ])->orderBy('id','DESC')->get();

		$active = 'create_shipment';		
		return view('backend.shipmentManagement.shipment.createshipment',['active'=>$active,'user'=>$user,'load'=>$load,'companies_data'=>$companies_data,'Equipments'=>$Equipments]);
  
	}
	/* New shipment create from load referenc Function End Here */
    public function search_truck(){
		
		$user_id = auth()->user()->id;
    	
		$user = DB::table('users')->where([
						['id', '=', $user_id],
					  ])->first();

		$equipments = DB::table('equipment_types')->get(); 
		$dat_cities = DB::table('dat_cities')->get(); 
		$truck_searchs = Truck_search::where('status', '1')->where('user_id',$user_id)->get(); 
    

        $page = 'Load';  
      return view('backend.loadsManagement.search_truck', compact('page','equipments','dat_cities','truck_searchs'));
    }

    /*Load get origin data function Start*/
	public function ReferencSearch(Request $request){
      $user_id = auth()->user()->id;
      $User = User::where('id', $user_id)->first();
      $ref = $request->input('referenc');
      $load_reference = DB::table('loads')->where([
        ['ref_no', '=', $ref],
        ])->first();

      
      $Agent= '';
      $LoadComment= '';
      if($load_reference){
        $LoadComment = LoadComment::where('post_id', $load_reference->load_dat_id)->orderBy('id', 'DESC')->get();
        $Agent = User::where('id', $load_reference->user_id)->first();
        
      }
      
      $page = 'Load'; 
      return view('backend.loadsManagement.load_reference', compact('load_reference','LoadComment','User','Agent'));
  }

    public function ReferencSearchUpdate(Request $request){
    $user_id = auth()->user()->id;
    $User = User::where('id', $user_id)->first();
    $ref = $request->input('referenc');
    $load_reference = DB::table('loads')->where([
      ['ref_no', '=', $ref],
      ])->first();

      $ntf_data = LoadComment::where('post_id', $load_reference->load_dat_id)->update(['status' => '1']);
    
    $Agent= '';
    $LoadComment= '';
    if($load_reference){
      $LoadComment = LoadComment::where('post_id', $load_reference->load_dat_id)->get();
      
    }
    
    $page = 'Load'; 
    return view('backend.loadsManagement.load_reference', compact('load_reference','LoadComment','User'));
 }

    /*Broker load reference new comment add function Start*/
    public function newCommentAdd(Request $request){
        $user_id = auth()->user()->id;
        $data = $request->all();
       //dd($data);
        $User= User::where('id',$user_id)->first();
        $load= Load::where('load_dat_id',$data['load_id'])->first();

        $new_load = new LoadComment;	
        $new_load->sender_id = $user_id;
        $new_load->receiver_id = $load['user_id'];
        $new_load->post_id = $load['load_dat_id'];
        $new_load->reference = $load['ref_no'];
        $new_load->message = $data['loadComment'];
        $new_loadSave=$new_load->save();

        $ref = $data['load_id'];
        $load_reference = DB::table('loads')->where([
                            ['load_dat_id', '=', $ref],
                          ])->first();

      //dd($load_reference);
      $Agent= '';
      $LoadComment= '';
      if($load_reference){
        $LoadComment = LoadComment::where('post_id', $load_reference->load_dat_id)->orderBy('id', 'DESC')->get();
        $Agent = User::where('id', $load_reference->user_id)->first();
        
      }
      
      $page = 'Load'; 
      return view('backend.loadsManagement.load_reference', compact('load_reference','LoadComment','User','Agent'));

  }
    /*Broker load reference new comment add function End*/
	
	/*Load get origin data function Start*/
	public function GetLoadOriginData(Request $request){
		$city = $request->input('query');


		$dat_cities = DB::table('dat_cities')->where([ ['city', 'like', $city.'%' ] ])->orwhere([ ['zip', 'like', $city.'%' ] ])->select('city_id','city','state_code')->get();

    //  return $dat_cities;

		
		$result = array();
		foreach($dat_cities as $cities)
		{
			$result[] = '<li value="'.$cities->city_id.'" data-state="'.$cities->state_code.'">'.$cities->city.','.$cities->state_code.'</li>';
		}
			return $result;
		
	}
	/*Load get origin data function End*/	


        public function generateUserid() 
                  {
                      $length = random_int(1000000, 9999999);
                      // $ref_no = Str::random($length);//Generate random string
                      $ref_no = random_int(1000000, 9999999);
                      $ref_no = rand(0000000,9999999);
                      $ref_no = mt_rand(0000000,9999999);
                      
                      $exists = load::where('ref_no', '=', $ref_no)
                          ->get(['ref_no']);//Find matches for id = generated id
                      if (isset($exists[0]->ref_no)) {//id exists in users table
                           //Retry with another generated id
                          return  LoadController::generateUserid();
                      }
                      return $ref_no;//Return the generated id as it does not exist in the DB
                  }


        public function RateDatainfo(Request $request){

            if ($request->ajax()) {
                  // $data = User::latest()->get();
                  // $datainfo =  LoadRateHistory::where('load_refid', $ref)->get();
                  $datainfo =  LoadRateHistory::get();
                  return Datatables::of($datainfo)
                          ->addIndexColumn()
                          ->addColumn('action', function($row){
                                $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                                  return $btn;
                          })
                          ->rawColumns(['action'])
                          ->make(true);
              }
              $datainfo = '';

              // dd($datainfo);
            
              return view('backend.loadsManagement.manager.rateviewhistory', compact('datainfo'));

        }
          

      public function RateviewHistory(Request $request,$ref){

       $data =  LoadRateHistory::where('load_refid', $ref)->get();
        //  return $ref ;
        return view('backend.loadsManagement.manager.rateviewhistory', compact('ref','data'));

      }

      public function ratehistory(){
          $origin = DB::table('dat_cities')
            ->where(
              [ ['city_id', '=', $request->input("lane_origin_id") ] ]
            )->first();

          $destination = DB::table('dat_cities')
              ->where([
                        ['city_id', '=', $request->input("lane_drop_id")] 
                      ])->first();

          $rateview= '[
            {
              "origin": {
                "city": "'.$origin->city.'",
                "stateOrProvince": "'.$origin->state_code.'"
              },
              "destination": {
                "city": "'.$destination->city.'",
                "stateOrProvince": "'.$destination->state_code.'"
              },
              "rateType": "SPOT",
              "equipment": "VAN",
              "includeMyRate": true
            },
            {
              "origin": {
                "postalCode": "'.$origin->zip.'"
              },
              "destination": {
                "postalCode": "'.$destination->zip.'"
              },
              "rateType": "CONTRACT",
              "equipment": "VAN",
              "includeMyRate": false,
              "targetEscalation": {
                "escalationType": "BEST_FIT"
              }
              
            }
          ]';
  
          $URL = "https://analytics.api.nprod.dat.com/linehaulrates/v1/lookups"; //dev
          // $URL = "https://analytics.api.dat.com/linehaulrates/v1/lookups"; //live          
          $curl = curl_init();
            curl_setopt_array($curl,
              array(CURLOPT_URL => $URL,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_FAILONERROR => true,
              CURLOPT_ENCODING => "",
              CURLOPT_TIMEOUT => 30000,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_POSTFIELDS => $rateview,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POST => 1,
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "Authorization: Bearer ".$dat_details->token."",
                
                ),
            ));
    
          $response = curl_exec($curl);
          //dd($response);
          $error_msg = '';
          if (curl_errno($curl))
            {
                $error_msg = curl_error($curl);
                print_r($error_msg);
            }
            
            curl_close($curl);
            $results = json_decode($response);
            
                foreach($results->rateResponses as $result){
                  if($result->request->rateType == "SPOT"){
                    if(isset($result->response->rate)){
                      $report = $result->response->rate->reports;
                      $companies =  $result->response->rate->companies;
                      $mileage =   $result->response->rate->mileage;

                      $highUsd = $result->response->rate->perTrip->highUsd  + $result->response->rate->averageFuelSurchargePerTripUsd ;

                      $rateUsd = $result->response->rate->perTrip->rateUsd + $result->response->rate->averageFuelSurchargePerTripUsd ;

                      $timeframe = $result->response->escalation->timeframe;
                      $origin = $result->response->escalation->origin->name ;
                      $destination = $result->response->escalation->destination->name;


                      $ratehistory = new LoadRateHistory;	
                      $ratehistory->spotreport = $report;
                      $ratehistory->spotcompanies = $companies;
                      $ratehistory->spotmileage = $mileage;
                      $ratehistory->spothighUsd = $highUsd;
                      $ratehistory->spotrateUsd = $rateUsd;
                      $ratehistory->spottimeframe = $timeframe;
                      $ratehistory->spotorigin = $origin;
                      $ratehistory->spotdestination = $destination ;                            
                      $ratehistory->save();
                      


                      
                    }
                  // print_r($result->response->rate->perTrip);
                  }
                  if($result->request->rateType == "CONTRACT"){
                    if(isset($result->response->rate)){
                      $report = $result->response->rate->reports;
                      $companies =  $result->response->rate->companies;
                      $mileage =   $result->response->rate->mileage;

                      $highUsd = $result->response->rate->perTrip->highUsd  + $result->response->rate->averageFuelSurchargePerTripUsd ;

                      $rateUsd = $result->response->rate->perTrip->rateUsd + $result->response->rate->averageFuelSurchargePerTripUsd ;

                      $timeframe = $result->response->escalation->timeframe;
                      $origin = $result->response->escalation->origin->name ;
                      $destination = $result->response->escalation->destination->name;

                        $ratehistory = new LoadRateHistory;	
                        $ratehistory->contractreport  = $report;
                        $ratehistory->contractcompanies = $companies;
                        $ratehistory->contractmileage = $mileage;
                        $ratehistory->contracthighUsd = $highUsd;
                        $ratehistory->contractrateUsd = $rateUsd;
                        $ratehistory->contracttimeframe = $timeframe;
                        $ratehistory->contractorigin = $origin;
                        $ratehistory->contractdestination = $destination ;
                        $ratehistory->ref_no = $ref_no;
                        
                        $ratehistory->save();
                    }
                    //print_r ($result->response->rate->perTrip);
                  }
                
                  
                }

                return $results;
                // foreach($results->rateResponses as $result){
      
                //   if($result->request->rateType == "SPOT"){
                //     if(isset($result->response->rate)){
                //       $data['Spot']['Reports']= '<b>Reports:</b> '.$result->response->rate->reports.'<br>';
                //       $data['Spot']['Companies']= '<b>Companies:<b> '.$result->response->rate->companies.'<br>';
                //       $data['Spot']['Mileage']= '<b>Mileage:</b> '.$result->response->rate->mileage.'<br>';
                //       $data['Spot']['MaxPrice']= '<b>MaxPrice:</b> '.$result->response->rate->perTrip->highUsd  + $result->response->rate->averageFuelSurchargePerTripUsd .'<br>';
                //       $data['Spot']['FinalPrice']= '<b>FinalPrice:</b> '.$result->response->rate->perTrip->rateUsd + $result->response->rate->averageFuelSurchargePerTripUsd .'<br>';
                //       $data['Spot']['Timeframe']= '<b>Timeframe:</b> '.$result->response->escalation->timeframe.'<br>';
                //       $data['Spot']['Origin']= '<b>Origin:</b> '.$result->response->escalation->origin->name.'<br>';
                //       $data['Spot']['Destination']= '<b>Destination:</b> '.$result->response->escalation->destination->name.'<br>';
                      
                //     }
                //    // print_r($result->response->rate->perTrip);
                //   }
                //   if($result->request->rateType == "CONTRACT"){
                //     if(isset($result->response->rate)){
                //         $data['CONTRACT']['Reports']= '<b>Reports:</b> '.$result->response->rate->reports.'<br>';
                //         $data['CONTRACT']['Companies']= '<b>Companies:</b> '.$result->response->rate->companies.'<br>';
                //         $data['CONTRACT']['Mileage']= '<b>Mileage:</b> '.$result->response->rate->mileage.'<br>';
                //         $data['CONTRACT']['MaxPrice']= '<b>MaxPrice:</b> '.$result->response->rate->perTrip->highUsd + $result->response->rate->averageFuelSurchargePerTripUsd .'<br>';
                //         $data['CONTRACT']['FinalPrice']= '<b>FinalPrice:</b> '.$result->response->rate->perTrip->rateUsd + $result->response->rate->averageFuelSurchargePerTripUsd .'<br>';
                //         $data['CONTRACT']['Timeframe']= '<b>Timeframe:</b> '.$result->response->escalation->timeframe.'<br>';
                //         $data['CONTRACT']['Origin']= '<b>Origin:</b> '.$result->response->escalation->origin->name.'<br>';
                //         $data['CONTRACT']['Destination']= '<b>Destination:</b> '.$result->response->escalation->destination->name.'<br>';
                //     }
                //     //print_r ($result->response->rate->perTrip);
                //   }
                  
                  
                // }


                      // return  $data;
                    
      }

    	/*Broker post new load on DAT function Start*/
    	public function NewLanePost(Request $request){
    		$user_id = auth()->user()->id;
    		$user = DB::table('users')->where([
    						['id', '=', $user_id],
    					  ])->first();
    					  
          $equipment = DB::table('equipment_types')->where([ ['equip_type', '=', $request->input("equipment_type") ] ])->first();
          // $ref_no = rand(0000000,9999999);
            $ref_no  = $this->generateUserid(); 
          //$micro = rand(000,999);
          // $tz = date_default_timezone_set('America/New_York');
          $tz = date_default_timezone_set('UTC');
          $pick_up_date = $request->input('pick_date');
          $currenttime= strtotime($pick_up_date);
        //  $currenttime= strtotime("+1 days", strtotime($pick_up_date));
          $nex_date= date("Y-m-d", $currenttime);
          $zulu_time = date('H:i:s.u');
          $Date = substr($zulu_time,0, -3);
          $PickDate = $nex_date.'T'.$Date.'Z';
            //print_r($PickDate);
            //         $uaid = Auth::id();                
            // 		$dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
            
          // this is use when your multi user DAT is Activate if you Want to change single user then use (1120)
          $aid = Auth::id();
          $mid = User::where('id', $aid)->pluck('dat_user_auth_status')->first();
          $dat_details = '';
          
          if($mid == 0){
          $dat_details = DB::table('dat_login')->first(); // (1120)for single
          }else{
              $uaid = Auth::id();                
          $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
          }
            
        // THIS IS FOR LOAD POSTING ONLY start

          // 		$dat_details = DB::table('dat_login')->first();
          $pick_cities = DB::table('dat_cities')->where([ ['city_id', '=', $request->input("lane_origin_id") ] ])->first();
          $drop_cities = DB::table('dat_cities')->where([ ['city_id', '=', $request->input("lane_drop_id") ] ])->first();
          
            if($pick_cities == null){
                return redirect('/admin/loads')->with('error','Please Select Right Origin City');
              }
          
            if($drop_cities == null){
                return redirect('/admin/loads')->with('error','Please Select Right Drop City');
              }
              
            //print_r($_POST);
            $price= $request->input("offer_rate");
            if($price){
              $rate = 
              '
              "loadBoard":
                  {
                    "includesExtendedNetwork": true,
                    "transactionDetails": 
                    {
                        "transactionType": "NONBOOKABLE_OFFER_RATE",
                        "loadOfferRateUsd": '.$request->input("offer_rate").'
                    }
                  }';
            }
            else{
              $rate =  '  "loadBoard": true ';
            }

              //this is field form DAT API
            $load_field = '{
              
              "freight": {
                "equipmentType": "'.$request->input("equipment_type").'",
                "fullPartial": "'.$request->input("full_partial").'",
                "comments": [
                  {
                    "comment": "'.$request->input("comment1").'"
                  }
                ],
              "commodity": {
                "details": "'.$request->input("commodity").'"
              },
                "lengthFeet": '.$request->input("lengthFeet").',
                "weightPounds": '.$request->input("weightPounds").'
              },
              "lane": {
                "origin": {
                  "city": "'.$pick_cities->city.'",
                  "stateProv": "'.$pick_cities->state_code.'",
                  "postalCode": "'.$pick_cities->zip.'"
                },
                "destination": {
                  "city": "'.$drop_cities->city.'",
                  "stateProv": "'.$drop_cities->state_code.'"
                }
              },
              "exposure": {
                "earliestAvailabilityWhen": "'.$PickDate.'",
                "latestAvailabilityWhen": "'.$PickDate.'",
                "preferredContactMethod": "'.$request->input("primary_contact").'",
                "audience": {
                  '.$rate.'
                  
                  }
              },
          
              "referenceId": "'.$ref_no.'"
            }';

            //print_r($load_field);
            $URL = "https://freight.api.nprod.dat.com/posting/v2/loads"; //local
            // $URL = "https://freight.api.dat.com/posting/v2/loads"; //live
              
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $load_field,
            CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            "Authorization: Bearer ".$dat_details->token.""
            ),
            ));
            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                  $error_msg = curl_error($curl);
                  print_r($error_msg);
            }	
            curl_close($curl);
            $res = json_decode($response);
            //print_r($res);die;
          
            $tz = date_default_timezone_set('America/New_York');
            $pick_up_date = $request->input('pick_date');
            $currenttime= strtotime($pick_up_date);
            //  $currenttime= strtotime("+1 days", strtotime($pick_up_date));
            $nex_date= date("Y-m-d", $currenttime);
            $zulu_time = date('H:i:s.u');
            $Date = substr($zulu_time,0, -3);
            $PickDateNewYork = $nex_date.'T'.$Date.'Z';
        
        // THIS IS FOR LOAD POSTING ONLY END

        // THIS IS FOR RATEVIEW HISTORY SAVE OF CURRENT LOAD  START
          $origin = DB::table('dat_cities')->where(
                [ ['city_id', '=', $request->input("lane_origin_id") ] ])->first();
          $destination = DB::table('dat_cities')->where([
                    ['city_id', '=', $request->input("lane_drop_id")] ])->first();
          $rateview= '[
            {
              "origin": {
                "city": "'.$origin->city.'",
                "stateOrProvince": "'.$origin->state_code.'"
              },
              "destination": {
                "city": "'.$destination->city.'",
                "stateOrProvince": "'.$destination->state_code.'"
              },
              "rateType": "SPOT",
              "equipment": "VAN",
              "includeMyRate": true
            },
            {
              "origin": {
                "postalCode": "'.$origin->zip.'"
              },
              "destination": {
                "postalCode": "'.$destination->zip.'"
              },
              "rateType": "CONTRACT",
              "equipment": "VAN",
              "includeMyRate": false,
              "targetEscalation": {
                "escalationType": "BEST_FIT"
              }
              
            }
          ]';

          $URL = "https://analytics.api.nprod.dat.com/linehaulrates/v1/lookups"; //dev
          // $URL = "https://analytics.api.dat.com/linehaulrates/v1/lookups"; //live          
          $curl = curl_init();
            curl_setopt_array($curl,
              array(CURLOPT_URL => $URL,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_FAILONERROR => true,
              CURLOPT_ENCODING => "",
              CURLOPT_TIMEOUT => 30000,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_POSTFIELDS => $rateview,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POST => 1,
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                "Authorization: Bearer ".$dat_details->token."",
                
                ),
            ));
    
          $response = curl_exec($curl);
          $error_msg = '';
          if (curl_errno($curl)){
            $error_msg = curl_error($curl);
            print_r($error_msg);
          }
        
          curl_close($curl);
          $results = json_decode($response);
              //dd($results);

        if($results){    
              foreach($results->rateResponses as $result){
                if($result->request->rateType == "SPOT"){
                  if(isset($result->response->rate)){
                    $data['Spot']['Reports']= $result->response->rate->reports;
                    $data['Spot']['Companies']= $result->response->rate->companies;
                    $data['Spot']['Mileage']= $result->response->rate->mileage;
                    $data['Spot']['MaxPrice']= $result->response->rate->perTrip->highUsd  + $result->response->rate->averageFuelSurchargePerTripUsd ;
                    $data['Spot']['FinalPrice']= $result->response->rate->perTrip->rateUsd + $result->response->rate->averageFuelSurchargePerTripUsd ;
                    $data['Spot']['Timeframe']= $result->response->escalation->timeframe;
                    $data['Spot']['Origin']= $result->response->escalation->origin->name;
                    $data['Spot']['Destination']=$result->response->escalation->destination->name;
                  }
                  // print_r($result->response->rate->perTrip);
                }
                if($result->request->rateType == "CONTRACT"){
                    if(isset($result->response->rate)){
                      $data['CONTRACT']['Reports']= $result->response->rate->reports;
                      $data['CONTRACT']['Companies']= $result->response->rate->companies;
                      $data['CONTRACT']['Mileage']= $result->response->rate->mileage;
                      $data['CONTRACT']['MaxPrice']= $result->response->rate->perTrip->highUsd + $result->response->rate->averageFuelSurchargePerTripUsd ;
                      $data['CONTRACT']['FinalPrice']= $result->response->rate->perTrip->rateUsd + $result->response->rate->averageFuelSurchargePerTripUsd ;
                      $data['CONTRACT']['Timeframe']= $result->response->escalation->timeframe;
                      $data['CONTRACT']['Origin']= $result->response->escalation->origin->name;
                      $data['CONTRACT']['Destination']= $result->response->escalation->destination->name;
                    } 
                  //print_r ($result->response->rate->perTrip);
                }
              }
              $data;
              // END RATEVEIW HISTORY HERE       
      
                if(isset($res->id)){
                  //dd($res->id);
                    $new_load = new Load;	
                    $new_load->load_dat_id = $res->id;
                    $new_load->user_id = $user_id;
                    $new_load->ref_no = $ref_no;
                    $new_load->load_state_origin_id = $pick_cities->city_id;
                    $new_load->load_state_origin = $pick_cities->city;
                    $new_load->load_state_code = $pick_cities->state_code;
                    $new_load->load_zipcode_origin = $pick_cities->zip;
                    $new_load->load_city_desti_id = $drop_cities->city_id;
                    $new_load->load_city_desti = $drop_cities->city;
                    $new_load->drop_state_code = $drop_cities->state_code;
                    $new_load->equipments = $equipment->equip_name;
                    $new_load->full_partial_tl_ltl = $request->input("full_partial");
                    $new_load->weight_load = $request->input("weightPounds");
                    $new_load->length_load = $request->input("lengthFeet");
                    $new_load->post_date = $request->input("pick_date");
                    $new_load->dat_pick_date = $PickDateNewYork;
                    $new_load->load_offer_rate = $request->input("offer_rate");
                    $new_load->special_requirement = $request->input("comment1");
                    $new_load->load_commodity = $request->input("commodity");
                    // $new_loadSave=$new_load->save();
                    if($new_load->save()){
                      $ratehistory = new LoadRateHistory;	
                      $ratehistory->spotreport = $data['Spot']['Reports'];
                      $ratehistory->spotcompanies =  $data['Spot']['Companies'];
                      $ratehistory->spotmileage =  $data['Spot']['Mileage'];
                      $ratehistory->spothighUsd =  $data['Spot']['MaxPrice'];
                      $ratehistory->spotrateUsd =  $data['Spot']['FinalPrice'];
                      $ratehistory->spottimeframe =  $data['Spot']['Timeframe'];
                      $ratehistory->spotorigin =  $data['Spot']['Origin'];
                      $ratehistory->spotdestination =  $data['Spot']['Destination'] ; 
                      
                      $ratehistory->contractreport  = $data['CONTRACT']['Reports'];
                      $ratehistory->contractcompanies = $data['CONTRACT']['Companies'];
                      $ratehistory->contractmileage =  $data['CONTRACT']['Mileage'];
                      $ratehistory->contracthighUsd = $data['CONTRACT']['MaxPrice'];
                      $ratehistory->contractrateUsd =  $data['CONTRACT']['FinalPrice'];
                      $ratehistory->contracttimeframe = $data['CONTRACT']['Timeframe'];
                      $ratehistory->contractorigin = $data['CONTRACT']['Origin'];
                      $ratehistory->contractdestination = $data['CONTRACT']['Destination'];
                      $ratehistory->ref_no = $ref_no;
                      $ratehistory->load_refid  = $new_load->id;
                      
                      $ratehistory->save();

                    }
                  return redirect('/admin/loads')->with('success', 'Load Post on DAT successfully!');
                }
                else{
                  return redirect('/admin/loads')->with('error', 'Load posting faild,try sometime later!');
                }
          }else{  
                
                return redirect('/admin/loads')->with('error', 'Generate Token && Check Rate !!');
            }
    	
    	}
    	
    	/*Broker post load update on DAT function Start*/
    	public function LodePostUpdate(Request $request){
            		$user_id = auth()->user()->id ;
            	
            		$user = DB::table('users')->where([
            						['id', '=', $user_id],
            					  ])->first();
            
                        $load_data = DB::table('loads')->where([
                                  ['load_dat_id', '=', $request->input("dat_id")],
                                  ])->first();
                    
                          $datId = $request->input('dat_id');
                        					  
                        $equipment = DB::table('equipment_types')->where([ ['equip_name', '=', $request->input("equipment_type") ] ])->first();
                        $micro = rand(000,999);
            
                        // $tz = date_default_timezone_set('America/New_York');
                        
                        $tz = date_default_timezone_set('UTC');
                    
                        $pick_up_date = $request->input('pick_date');
                        $currenttime= strtotime($pick_up_date);
                        //  $currenttime= strtotime("+1 days", strtotime($pick_up_date));
                        $nex_date= date("Y-m-d", $currenttime);
                        $zulu_time = date('H:i:s.u');
                        $Date = substr($zulu_time,0, -3);
                        $PickDate = $nex_date.'T'.$Date.'Z';
                 
                // 		$dat_details = DB::table('dat_login')->first();
                		
                		        $aid = Auth::id();
                                $mid = User::where('id', $aid)->pluck('dat_user_auth_status')->first();
                                $dat_details = '';
                                
                                if($mid == 0){
                        		    $dat_details = DB::table('dat_login')->first();
                                }else{
                                    $uaid = Auth::id();                
                        		    $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
                                }
                                
                		
                		$pick_cities = DB::table('dat_cities')->where([ ['city_id', '=', $request->input("lane_origin_id") ] ])->first();
                		$drop_cities = DB::table('dat_cities')->where([ ['city_id', '=', $request->input("lane_drop_id") ] ])->first();
            
                        $price= $request->input("offer_rate");
                        if($price){
                          $rate = 
                          '
                          "loadBoard":
                              {
                                "includesExtendedNetwork": true,
                                "transactionDetails": 
                                {
                                    "transactionType": "NONBOOKABLE_OFFER_RATE",
                                    "loadOfferRateUsd": '.$request->input("offer_rate").'
                                }
                              }';
                        }
                        else{
                          $rate =  '  "loadBoard": true ';
                        }
            
            
                        $load_field = '{
                          "exposure": 
                          {
                            "preferredContactMethod": "'.$request->input("primary_contact").'",
                            "earliestAvailabilityWhen": "'.$PickDate.'",
                            "latestAvailabilityWhen": "'.$PickDate.'",
                            "audience": {
                              '.$rate.'
                                }
                              
                          },
                          "freight": {
                          
                            "lengthFeet": '.$request->input("lengthFeet").',
                            "weightPounds": '.$request->input("weightPounds").',
                            "fullPartial": "'.$request->input("full_partial").'",
                            
                            "comments": [
                              {
                                "comment": "'.$request->input("comment1").'"
                              }
                            ],
                            "commodity": {
                              "details": "'.$request->input("commodity").'"
                            }
                        }
            
                }';
                    //print_r($load_field);
                
                    $URL = "https://freight.api.nprod.dat.com/posting/v2/loads/".$datId.""; //test
                    // $URL = "https://freight.api.dat.com/posting/v2/loads/".$datId.""; //live
            
            		
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                        CURLOPT_URL => $URL,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "PATCH",
                        CURLOPT_POST => 1,
                        CURLOPT_POSTFIELDS => $load_field,
                        CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        "Authorization: Bearer ".$dat_details->token.""
                        ),
                        ));
                        	$response = curl_exec($curl);
                          if (curl_errno($curl)) 
                          {
                            		$error_msg = curl_error($curl);
                                print_r($error_msg);
                          }	
                        	curl_close($curl);
                        
                        	$res = json_decode($response);
                          //echo '<pre>'; print_r($res);die('yes');
                          
                           $tz = date_default_timezone_set('America/New_York');
                           
                            $pick_up_date = $request->input('pick_date');
                            $currenttime= strtotime($pick_up_date);
                            //  $currenttime= strtotime("+1 days", strtotime($pick_up_date));
                            $nex_date= date("Y-m-d", $currenttime);
                            $zulu_time = date('H:i:s.u');
                            $Date = substr($zulu_time,0, -3);
                            $PickDateNewYork = $nex_date.'T'.$Date.'Z';
                                  
                                  if(isset($res->id))	
                                  {
                        
                                    $load_details = Load::where('load_dat_id',$request->input("dat_id"))->first();
                                    $eid = $load_details->id ;
                        		
                                if ($request->isMethod('post')){
                                    $data = $request->all();
                                    $this->validate($request,[ 
                                        // 'employee_id' => 'unique:users,employee_id,'.$eid,
                                    ]);            
                                    $load_details->ref_no	= $load_data->ref_no;
                                    $load_details->load_state_origin_id	= $data['lane_origin_id'];
                                    $load_details->load_state_origin	= $pick_cities->city;
                                    $load_details->load_state_code	= $pick_cities->state_code;
                                    $load_details->load_zipcode_origin	= $pick_cities->zip;  
                                    $load_details->load_city_desti_id  =$data['lane_drop_id'];            
                                    $load_details->load_city_desti	= $drop_cities->city;
                                    $load_details->drop_state_code	= $drop_cities->state_code;
                                    $load_details->equipments	= $equipment->equip_name;
                                    $load_details->full_partial_tl_ltl	= $data['full_partial'];
                                    $load_details->weight_load	= $data['weightPounds'];
                                    $load_details->length_load	= $data['lengthFeet'];
                                    $load_details->post_date	= $request->input("pick_date");;
                                    $load_details->dat_pick_date	= $PickDateNewYork;
                                    $load_details->load_offer_rate	= $data['offer_rate'];
                                    $load_details->special_requirement	= $data['comment1'];
                                    $load_details->load_commodity	= $data['commodity'];
                                    $load_details->save();
                        
                                  }
                                      // $loadupdate = DB::update('update loads set ref_no =?, load_state_origin_id =?, load_state_origin =?, load_state_code =?, load_zipcode_origin =?, load_city_desti_id =?, load_city_desti =?, drop_state_code =?, equipments =?, full_partial_tl_ltl =?, weight_load =?, length_load =?, post_date =?, dat_pick_date =?, load_offer_rate =?, special_requirement =?, load_commodity =? where load_dat_id = ?',[ $load_data->ref_no,$request->input("lane_origin_id"),$pick_cities->city,$pick_cities->state_code,$pick_cities->zip,$request->input("lane_drop_id"),$drop_cities->city,$drop_cities->state_code,$equipment->equip_type,$request->input("full_partial"),$request->input("weightPounds"),$request->input("lengthFeet"),$request->input("pick_date"),$request->input("PickDate"),$request->input("offer_rate"),$request->input("comment1"),$request->input("commodity"),$request->input("dat_id")]);
                                    
                        
                                      return redirect('/admin/loads')->with('success', 'Load Post update successfully!');
                            				}
                                    else{
                                      return redirect('/admin/loads')->with('error', 'Load posting update faild,try sometime later!');
                                    }
            
            }
        /*Broker post load update on DAT function End*/

        /*Broker post new load on DAT function End*/
        public function LodePostUpdateForm(Request $request){
                $user_id = auth()->user()->id;
            	$datId = $request->input('datId');
                
                $user = DB::table('users')->where([	['id', '=', $user_id], ])->first();					
                
                $equipments = DB::table('equipment_types')->get(); 
                
                $load_data = DB::table('loads')->where([ ['load_dat_id', '=', $datId], ])->first();
                $dat_cities = DB::table('dat_cities')->get();
                
                return view('backend.loadsManagement.update_load', compact('equipments','dat_cities','load_data'));
        
          }

        /*Broker post new load on DAT function End*/
		public function LoadAgeRefresh(Request $request){

      $tz = date_default_timezone_set('America/New_York');
                  $user_id = auth()->user()->id;
                  $user = DB::table('users')->where([ ['id', '=', $user_id], ])->first();
                    //   $dat_details = DB::table('dat_login')->first();
                    $aid = Auth::id();
                    $mid = User::where('id', $aid)->pluck('dat_user_auth_status')->first();
                    $dat_details = '';
                    
                    if($mid == 0){
            		    $dat_details = DB::table('dat_login')->first();
                    }else{
                        $uaid = Auth::id();                
            		    $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
                    }
                 
                  $datId = $request->input('datId');
                  $id = '{ "id": "'.$datId.'"	 }';
                   $URL = "https://freight.api.nprod.dat.com/posting/v2/loads/".$datId."/refresh"; //test
                  // $URL = "https://freight.api.dat.com/posting/v2/loads/".$datId."/refresh"; //live
                  
                  $curl = curl_init();
                  curl_setopt_array($curl, 
                    array(CURLOPT_URL => $URL,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_FAILONERROR => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POST => 1,
                    CURLOPT_HTTPHEADER => array(
                      'Content-Type: application/json',
                      "Authorization: Bearer ".$dat_details->token."",
                      ),
                  ));
                
                  $response = curl_exec($curl);
                  // dd($response);


                  

                  if(curl_errno($curl)) {
                    $error_msg = curl_error($curl);
                    print_r($error_msg);
                  }

                  curl_close($curl);
                  $res = json_decode($response);
                  // return Redirect::back();
                    

                    if($res == true){
                      $tz = date_default_timezone_set('America/New_York');
                      $datId = $request->input('datId');
                      $timerreferesh = date("Y-n-j ") . date("H:i:s");
                      $ntf_data = Load::where('load_dat_id', $datId)->update(['timerreferesh' => $timerreferesh]);
                      echo '1';
                    }

                }
                
        public function LoadPostDelete(Request $request){
        		
          $user_id = auth()->user()->id;
          $user = DB::table('users')->where([	['id', '=', $user_id], ])->first();
                //   $dat_details = DB::table('dat_login')->first();
                    $aid = Auth::id();
                    $mid = User::where('id', $aid)->pluck('dat_user_auth_status')->first();
                    $dat_details = '';
                    
                    if($mid == 0){
            		    $dat_details = DB::table('dat_login')->first();
                    }else{
                        $uaid = Auth::id();                
            		    $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
                    }

        //   $uaid = Auth::id();                
        //   $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
          
          $datId = $request->input('datId');
          
        //   $URL = "https://freight.api.nprod.dat.com/posting/v2/loads/".$datId."";
          $URL = "https://freight.api.dat.com/posting/v2/loads/".$datId."";
          
          $curl = curl_init();
          curl_setopt_array($curl,
          array(CURLOPT_URL => $URL,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_FAILONERROR => true,
          CURLOPT_ENCODING => "",
          CURLOPT_TIMEOUT => 30000,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "DELETE",
          CURLOPT_POST => 1,
          CURLOPT_HTTPHEADER => array(
            
            'Content-Type: application/json',
            "Authorization: Bearer ".$dat_details->token."",
            
            ),
          ));
          
          $response = curl_exec($curl);
          $error_msg = '';
          
          if (curl_errno($curl))
           {
            		$error_msg = curl_error($curl);
                print_r($error_msg);
            }
            
            curl_close($curl);
            $res = json_decode($response);
            //print_r($res);die;
    
            // if($error_msg == '')
            // {
              		 $UpdateData = DB::update('update loads set load_status =? where load_dat_id = ?' ,['1', $datId]);		 
                   echo '1';
              
             // }
        }

        /* Broker load rate view function start here */
        public function LoadPostRateView(Request $request){
        		
          $validator = Validator::make($request->all(),[
            'origin' => 'required',
            'destination' => 'required',
            'equipment_type' => 'required',
          ]);
          if (!$validator->passes()) {
              $errors = $validator->errors()->all();
              return  implode('<li>',$errors);
          }
           
            //   $dat_details = DB::table('dat_login')->first();
        
            $aid = Auth::id();
            $mid = User::where('id', $aid)->pluck('dat_user_auth_status')->first();
            $dat_details = '';
            
            if($mid == 0){
            $dat_details = DB::table('dat_login')->first();
            }else{
                $uaid = Auth::id();                
            $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
            }
          
            // $uaid = Auth::id();                
            //  $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
            		
          $origin = DB::table('dat_cities')->where([ ['city_id', '=', $request->input('origin')], ])->first();
          $destination = DB::table('dat_cities')->where([ ['city_id', '=', $request->input('destination')], ])->first();
    
            $rateview= '[
              {
                "origin": {
                  "city": "'.$origin->city.'",
                  "stateOrProvince": "'.$origin->state_code.'"
                },
                "destination": {
                  "city": "'.$destination->city.'",
                  "stateOrProvince": "'.$destination->state_code.'"
                },
                "rateType": "SPOT",
                "equipment": "VAN",
                "includeMyRate": true
              },
              {
                "origin": {
                  "postalCode": "'.$origin->zip.'"
                },
                "destination": {
                  "postalCode": "'.$destination->zip.'"
                },
                "rateType": "CONTRACT",
                "equipment": "VAN",
                "includeMyRate": false,
                "targetEscalation": {
                  "escalationType": "BEST_FIT"
                }
                
              }
            ]';
    
          // $URL = "https://analytics.api.nprod.dat.com/linehaulrates/v1/lookups"; //dev
          $URL = "https://analytics.api.dat.com/linehaulrates/v1/lookups"; //live          
          $curl = curl_init();
            curl_setopt_array($curl,
              array(CURLOPT_URL => $URL,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_FAILONERROR => true,
              CURLOPT_ENCODING => "",
              CURLOPT_TIMEOUT => 30000,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_POSTFIELDS => $rateview,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POST => 1,
              CURLOPT_HTTPHEADER => array(
                
                'Content-Type: application/json',
                "Authorization: Bearer ".$dat_details->token."",
                
                ),
            ));
    
          $response = curl_exec($curl);
          
          //dd($response);
          $error_msg = '';
          
          if (curl_errno($curl))
            {
             		$error_msg = curl_error($curl);
                 print_r($error_msg);
            }
            
            curl_close($curl);
            $results = json_decode($response);
            
            //print_r($results->rateResponses);
            //die;
            
            foreach($results->rateResponses as $result){
              
              if($result->request->rateType == "SPOT"){
                if(isset($result->response->rate)){
                  $data['Spot']['Reports']= '<b>Reports:</b> '.$result->response->rate->reports.'<br>';
                  $data['Spot']['Companies']= '<b>Companies:<b> '.$result->response->rate->companies.'<br>';
                  $data['Spot']['Mileage']= '<b>Mileage:</b> '.$result->response->rate->mileage.'<br>';
                  $data['Spot']['MaxPrice']= '<b>MaxPrice:</b> '.$result->response->rate->perTrip->highUsd  + $result->response->rate->averageFuelSurchargePerTripUsd .'<br>';
                  $data['Spot']['FinalPrice']= '<b>FinalPrice:</b> '.$result->response->rate->perTrip->rateUsd + $result->response->rate->averageFuelSurchargePerTripUsd .'<br>';
                  $data['Spot']['Timeframe']= '<b>Timeframe:</b> '.$result->response->escalation->timeframe.'<br>';
                  $data['Spot']['Origin']= '<b>Origin:</b> '.$result->response->escalation->origin->name.'<br>';
                  $data['Spot']['Destination']= '<b>Destination:</b> '.$result->response->escalation->destination->name.'<br>';
                  
                }
               // print_r($result->response->rate->perTrip);
              }
              if($result->request->rateType == "CONTRACT"){
                if(isset($result->response->rate)){
                    $data['CONTRACT']['Reports']= '<b>Reports:</b> '.$result->response->rate->reports.'<br>';
                    $data['CONTRACT']['Companies']= '<b>Companies:</b> '.$result->response->rate->companies.'<br>';
                    $data['CONTRACT']['Mileage']= '<b>Mileage:</b> '.$result->response->rate->mileage.'<br>';
                    $data['CONTRACT']['MaxPrice']= '<b>MaxPrice:</b> '.$result->response->rate->perTrip->highUsd + $result->response->rate->averageFuelSurchargePerTripUsd .'<br>';
                    $data['CONTRACT']['FinalPrice']= '<b>FinalPrice:</b> '.$result->response->rate->perTrip->rateUsd + $result->response->rate->averageFuelSurchargePerTripUsd .'<br>';
                    $data['CONTRACT']['Timeframe']= '<b>Timeframe:</b> '.$result->response->escalation->timeframe.'<br>';
                    $data['CONTRACT']['Origin']= '<b>Origin:</b> '.$result->response->escalation->origin->name.'<br>';
                    $data['CONTRACT']['Destination']= '<b>Destination:</b> '.$result->response->escalation->destination->name.'<br>';
                }
                //print_r ($result->response->rate->perTrip);
              }
             
              
            }
            
            // print_r($data);
            // die('here');
            return  $data;
             
          
    
    
        }
        /* Broker load rate view function End here */

	    /*Broker surch truck on DAT function Start*/
	    public function TruckSearchDAT(Request $request){
      $user_id = auth()->user()->id ;
      $user = DB::table('users')->where([
              ['id', '=', $user_id],
              ])->first();


                      // $dat_details = DB::table('dat_login')->first();
      
      
                      $aid = Auth::id();
                      $mid = User::where('id', $aid)->pluck('dat_user_auth_status')->first();
                      $dat_details = '';
                      
                      if($mid == 0){
                      $dat_details = DB::table('dat_login')->first();
                      }else{
                          $uaid = Auth::id();                
                      $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
                      }
                      
              
              $equipment = DB::table('equipment_types')->where([ ['equip_type', '=', $request->input("equipment_type") ] ])->first();
              $pick_cities = DB::table('dat_cities')->where([ ['city_id', '=', $request->input("truck_lane_origin_id") ] ])->first();
          $drop_cities = DB::table('dat_cities')->where([ ['city_id', '=', $request->input("truck_lane_drop_id") ] ])->first();
        

              $micro = rand(000,999);
              $tz = date_default_timezone_set('America/New_York');
              
              $pick_up_date = $request->input('availability');
              $currenttime = date('H:i:s');
              
              //$PickDate = $pick_up_date.'T'.$currenttime.'.'.$micro.'Z';  
              $PickDate = $pick_up_date.'T'.$currenttime;
              
              
              $load_field = '{
                "criteria": {
                  "lane": {
                    "assetType": "TRUCK",
                    "equipment": {
                      "types": [
                        "'.$request->input("equipment_type").'"
                      ]
                    },
              
                    "origin": {
                      "place": {
                        "city": "'.$pick_cities->city.'",
                        "stateProv": "'.$pick_cities->state_code.'",
                        "latitude": '.$pick_cities->latitude.',
                        "longitude": '.$pick_cities->longitude.'
                      }
                    },
                    "destination": {
                      "place": {
                        "city": "'.$drop_cities->city.'",
                        "stateProv": "'.$drop_cities->state_code.'",
                        "latitude": '.$drop_cities->latitude.',
                        "longitude": '.$drop_cities->longitude.'
                      }
                    }
                  },
                  "maxAgeMinutes": '.$request->input("maxAgeMinutes").',
                  "maxOriginDeadheadMiles": '.$request->input("maxOriginDead").',
                  "maxDestinationDeadheadMiles": '.$request->input("maxDestinationDead").',
                  "availability": {
                    "earliestWhen": "'.$PickDate.'"
                    },
                  "capacity": {
                    "truck": {
                      "fullPartial": "'.$request->input("full_partial").'",
                      "availableLengthFeet": '.$request->input("length").',
                      "availableWeightPounds":  '.$request->input("weight").'
                    }
                  },
                  "audience": {
                    "includeLoadBoard": true,
                    "includeExtendedNetwork": true
                  },
                  "includeOnlyBookable": false,
                  "includeOnlyHasLength": false,
                  "includeOnlyHasWeight": false,
                  "includeOnlyQuickPayable": false,
                  "includeOnlyFactorable": false,
                  "includeOnlyAssurable": false,
                  "includeOnlyNegotiable": false,
                  "includeOnlyTrackable": false,
                  "excludeForeignAssets": true
                  
              }
              
              }';
              
              //print_r($load_field);
              // echo'<pre>';
              
                  $URL = "https://freight.api.nprod.dat.com/search/v3/queries"; //dev
                  // $URL = "https://freight.api.dat.com/search/v3/queries"; //live
                  
              $curl = curl_init();
              curl_setopt_array($curl, array(
              CURLOPT_URL => $URL,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_TIMEOUT => 30000,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POST => 1,
              CURLOPT_POSTFIELDS => $load_field,
              CURLOPT_HTTPHEADER => array(
              'Content-Type: application/json',
              "Authorization: Bearer ".$dat_details->token.""
              ),
              ));
                $response = curl_exec($curl);
                if (curl_errno($curl)) 
                {
                      $error_msg = curl_error($curl);
                      print_r($error_msg);
                }	
                curl_close($curl);
              
                $res = json_decode($response);
              
              echo '<pre>';  print_r($res);die('here');


            if(isset($res->queryId))	{
                      $truck_search = new Truck_search;	
                    
                      $truck_search->user_id = $user_id;
                      $truck_search->queryId = $res->queryId;
                      $truck_search->assetType = 'TRUCK';
                      $truck_search->equipment_type = $equipment->equip_name;
                      $truck_search->origin_city = $pick_cities->city;
                      $truck_search->origin_state = $pick_cities->state_code;
                      $truck_search->origin_lat = $pick_cities->latitude;
                      $truck_search->origin_long = $pick_cities->longitude;
                      $truck_search->destination_city = $drop_cities->city;
                      $truck_search->destination_state = $drop_cities->state_code;
                      $truck_search->destination_lat = $drop_cities->latitude;
                      $truck_search->destination_long = $drop_cities->longitude;
                      $truck_search->max_age = $request->input("maxAgeMinutes");
                      $truck_search->max_origin = $request->input("maxOriginDead");
                      $truck_search->max_destination = $request->input("maxDestinationDead");
                      $truck_search->earliest_date = $PickDate;
                      $truck_search->post_date = $pick_up_date;
                      $truck_search->full_partial = $request->input("full_partial");
                      $truck_search->length = $request->input("length");
                      $truck_search->weight = $request->input("weight");
                      $truck_searchSave = $truck_search->save();
                      //$new_loadSave=$new_load->save();
                    
                      return redirect('/admin/load/search_truck')->with('success', 'Truck Search post successfully!');
                    }
                    else{
                      return redirect('/admin/load/search_truck')->with('error', 'Truck Search faild,try sometime later!');
                    }

      }
	    /*Broker surch truck on DAT function End*/

	    /*Broker truck exact match on DAT function Start*/
	    public function TruckExactResult(Request $request){
          $user_id = auth()->user()->id ;
          
          $user = DB::table('users')->where([
            ['id', '=', $user_id],
            ])->first();
            
            
            // $dat_details = DB::table('dat_login')->first();
            
                        $aid = Auth::id();
                        $mid = User::where('id', $aid)->pluck('dat_user_auth_status')->first();
                        $dat_details = '';
                        
                        if($mid == 0){
                        $dat_details = DB::table('dat_login')->first();
                        }else{
                            $uaid = Auth::id();                
                        $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
                        }


          $URL = "https://freight.api.nprod.dat.com/search/v3/queryMatches/".$request->input('load_id').""; //dev
          // $URL = "https://freight.api.dat.com/search/v3/queryMatches/".$request->input('load_id').""; //live

		
          $curl = curl_init();
          curl_setopt_array($curl, array(
          CURLOPT_URL => $URL,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_TIMEOUT => 30000,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_POST => 1,
          //CURLOPT_POSTFIELDS => $load_field,
          CURLOPT_HTTPHEADER => array(
          'Content-Type: application/json',
          "Authorization: Bearer ".$dat_details->token.""
          ),
          ));
            $response = curl_exec($curl);
            if (curl_errno($curl)) 
            {
                  $error_msg = curl_error($curl);
                  print_r($error_msg);
            }	
            curl_close($curl);

            $results = json_decode($response);

          //echo '<pre>';  print_r($res);die('here');
        

        return view('backend.loadsManagement.match_truck',compact('results'));
        
      }
        /*Broker truck exact match on DAT function Start*/

        public function search_referance_truck(Request $request){
                  $ref = $request->referance;
                  $data = Load::where('ref_no', $ref)->get(); 
                  $data = json_decode($data);
                  return $data ;
            }
            
        /*Broker truck search delete on DAT function Start*/
        public function TruckSearchDelete(Request $request){
            $user_id = auth()->user()->id ;
      
            $user = DB::table('users')->where([
        ['id', '=', $user_id],
        ])->first();
        
        
        // $dat_details = DB::table('dat_login')->first();
        
        $aid = Auth::id();
                    $mid = User::where('id', $aid)->pluck('dat_user_auth_status')->first();
                    $dat_details = '';
                    
                    if($mid == 0){
            		    $dat_details = DB::table('dat_login')->first();
                    }else{
                        $uaid = Auth::id();                
            		    $dat_details = DB::table('dat_login')->where('user_id',$uaid)->first();
                    }


      $URL = "https://freight.api.nprod.dat.com/search/v3/queries/".$request->input('match_id').""; //dev
      // $URL = "https://freight.api.dat.com/search/v3/queries/".$request->input('match_id').""; //live


      $curl = curl_init();
      curl_setopt_array($curl,
      array(CURLOPT_URL => $URL,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FAILONERROR => true,
      CURLOPT_ENCODING => "",
      CURLOPT_TIMEOUT => 30000,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "DELETE",
      CURLOPT_POST => 1,
      CURLOPT_HTTPHEADER => array(
        
        'Content-Type: application/json',
        "Authorization: Bearer ".$dat_details->token."",
        
        ),
      ));
      
      $response = curl_exec($curl);
      $error_msg = '';
      
      if (curl_errno($curl))
      {
        		$error_msg = curl_error($curl);
            print_r($error_msg);
      }
        
        curl_close($curl);
        $res = json_decode($response);
        
        if($error_msg == '')
        {
          		 $UpdateData = DB::update('update truck_searches set status =? where queryId = ?' ,['0', $request->input('match_id')]);		 
               echo '1';
          
        }


    }
        /*Broker truck search delete on DAT function End*/

        /*Load data show all list fast track*/
        public function LoadReportslistData(Request $request){
            if (is_null($this->user) || !$this->user->can('loads-reports')) {
                abort(403, 'Sorry !! You are Unauthorized to edit any user !');
            }
                  $fromDate =$request['fromdate']  ??  "";
                  $toDate =$request['todate']  ??  "";
                  $search =$request['search']  ??  "";
                  // 2023-06-27 00:06:04.351213 Asia/Kolkata (+05:30)
                  $test = "test";
    
                  if(!empty($fromDate) && !empty($toDate) && !empty($search)){
    
                    if($search == "all"){
                      // return back()->with('error','No results Found');
                      $user_loads = Load::orderBy('id', 'DESC')->paginate('15');
                      return view('backend.loadsManagement.oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate, 'test'=>$test]);
                    }
                    
                    //Date Range will we work when you select from-date to todate
                    if($search == "Date-Range"){
                      // return back()->with('error','No results Found');
                      $user_loads = Load::query()
                                ->whereDate('created_at', '>=', $fromDate)
                                ->whereDate('created_at', '<=', $toDate)
                                ->orderBy('id', 'DESC')
                                ->paginate('15');
    
                      // $user_loads = Load::orderBy('id', 'DESC')->paginate('15');
                      return view('backend.loadsManagement.oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate, 'test'=>$test]);
                    }
                    
                    // && !empty($toDate) && !empty($search)
                    $user_loads = Load::query()
                                ->whereDate('created_at', '>=', $fromDate)
                                ->whereDate('created_at', '<=', $toDate)
                                ->where('agent_name', 'LIKE', "$search")
                                ->orderBy('id', 'DESC')
                                ->paginate('15');
    
                    // $user_loads = Load::whereBetween('created_at', [$fromDate, $toDate])->paginate('15');
                    $user_loads =  $user_loads->appends(array('fromdate'=>  $fromDate,  'todate'=>  $toDate));
    
                    $test = "3 frome date, todate, search ";
                    if(count($user_loads )>0){
                      return view('backend.loadsManagement.oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate, 'test'=>$test]);
                    }else{
                      return back()->with('error','No results Found');
                    }
                  }


                    $search =$request['searchref']  ??  "";
                    if(isset($search)){
                        $search =$request['searchref']  ??  "";
                        // dd($search);
                        if($search != ""){
                          $user_loads = Load::where('ref_no', 'LIKE', "%$search%")
                          ->orWhere('post_date', 'LIKE', "%$search%")
                          ->orWhere('load_state_origin', 'LIKE', "%$search%")
                          ->orWhere('load_city_desti', 'LIKE', "%$search%")
                          ->orWhere('full_partial_tl_ltl', 'LIKE', "%$search%")
                          ->orWhere('created_at', 'LIKE', "%$search%")
                          ->orWhere('equipments', 'LIKE', "%$search%")
                          ->orWhere('agent_name', 'LIKE', "%$search%")
                          ->paginate('15');
                          $user_loads->appends(array('search'=>  $search,));
                            if(count($user_loads )>0){
                              return view('backend.loadsManagement.oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);
        
                              // return view('backend.loadsManagement.manager.oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);
                            }
                            return back()->with('error','No results Found');
                        }else{
                          $user_loads =  Load::orderBy('id', 'DESC')->paginate('15');
                        }
      
                    }
    
    
                  $userid = 1 ;
                  $user_id = base64_decode($userid);
                  $user = User::where('id',$user_id)->first();
                  $equipments = DB::table('equipment_types')->get();
                  //die('here');
                  $user_loads= Load::where('user_id',$user_id)->orderBy('created_at','DESC')->get();       
                  //   $results = Load::sortBy('created_at', 'desc')->get();
                  // $user_loads = Load::all();
                  $user_loads = Load::orderBy('id', 'DESC')->paginate('15');
                  
                 
              $page = 'Load';		
              return view('backend.loadsManagement.oldreportlist', compact('page','equipments','user_loads','userid', 'user_id','search',
              'fromDate', 'toDate' ,'test'));
        }

        //for fast rendering data by this method
        public function allPosts(Request $request)
        {
            
            $columns = array( 
                                0 =>'id', 
                                1 =>'ref_no',
                                2=> 'post_date',
                                3=> 'load_state_origin',
                                4=> 'created_at',
                                5=> 'id',
                            );
      
            $totalData = Load::count();
                
            $totalFiltered = $totalData; 

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
                
            if(empty($request->input('search.value')))
            {            
                $posts = Load::offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
            }
            else {
                $search = $request->input('search.value'); 

                $posts =  Load::where('id','LIKE',"%{$search}%")
                                ->orWhere('ref_no', 'LIKE',"%{$search}%")
                                ->orWhere('post_date', 'LIKE', "%$search%")
                                ->orWhere('load_state_origin', 'LIKE', "%$search%")
                                ->orWhere('load_city_desti', 'LIKE', "%$search%")
                                ->orWhere('full_partial_tl_ltl', 'LIKE', "%$search%")
                                ->orWhere('created_at', 'LIKE', "%$search%")
                                ->orWhere('equipments', 'LIKE', "%$search%")
                                ->orWhere('agent_name', 'LIKE', "%$search%")
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();

                $totalFiltered = Load::where('id','LIKE',"%{$search}%")
                                ->orWhere('ref_no', 'LIKE',"%{$search}%")
                                ->count();
            }

            $data = array();
            if(!empty($posts))
            {
                foreach ($posts as $post)
                {
                    $show    =   url('admin/load/reports/allpost').'/'.$post->id;
                    $edit    =   url('admin/load/reports/allpost').'/'.$post->id ;

                        $status = $post->load_status;
                        $date_pick = explode('T', $post->dat_pick_date);
                        $date_pick1 = strtotime($date_pick['0']);
                        $today = strtotime(date('Y-m-d'));
                        $lstatus = '';                     
                        if ($today > $date_pick1) {
                            $lstatus = 'Expire';
                        } else {
                            if ($status == 1) {
                                $lstatus = 'Delete';
                            } else {
                                $lstatus = 'Active';
                            }
                        }


                    $nestedData['id'] = $post->id;
                    $nestedData['ref_no'] = $post->ref_no;
                    $nestedData['post_date'] = $post->post_date;
                    
                    $nestedData['load_state_origin'] = $post->load_state_origin;
                    $nestedData['load_city_desti'] = $post->load_city_desti;
                    $nestedData['full_partial_tl_ltl'] = $post->full_partial_tl_ltl;
                    $nestedData['equipments'] = $post->equipments;
                    $nestedData['agent_name'] = $post->agent_name;

                    $nestedData['load_status'] = $lstatus;

                    // date('d-m-Y', strtotime($post->created_at))
                    $nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
                    $nestedData['options'] = '<td style="width: 80px;" class="action_tooltip classToInclude">
                    <input type="hidden" value="{{ $post->load_dat_id }}" id="load_dat_id">

                    <button type="button" class="btn btn-outline-secondary btn-sm radius-30 px-4"
                        id="load_update_form_btn">
                        <i class="bx bx-edit"></i><span
                            class="tooltip">Edit</span></button>
                </td>';


            //     $nestedData['options'] ='<td style="width: 80px;" class="action_tooltip classToInclude"> <a href="'.url('/admin/load/LodePostUpdateForm/'.$post->id).'" title="Edit"><i class="fa fa-edit"></i>
            // </a></td>';

                    $data[] = $nestedData;

                }
            }
              
            $json_data = array(
                        "draw"            => intval($request->input('draw')),  
                        "recordsTotal"    => intval($totalData),  
                        "recordsFiltered" => intval($totalFiltered), 
                        "data"            => $data   
                        );
                
            echo json_encode($json_data); 
            
        }



        ///testing for new load report search

        public function LoadReportslistSearch(Request $request){
          if (is_null($this->user) || !$this->user->can('loads-reports')) {
              abort(403, 'Sorry !! You are Unauthorized to edit any user !');
          }
  
                $fromDate =$request['fromdate']  ??  "";
                $toDate =$request['todate']  ??  "";
                
                $date = Carbon::now();
              // dd($date  );
                $search =$request['search']  ??  "";
                if(isset($search)){
                    $search =$request['search']  ??  "";
                    // dd($search);
                    if($search != ""){
                      $user_loads = Load::where('ref_no', 'LIKE', "%$search%")
                      ->orWhere('post_date', 'LIKE', "%$search%")
                      ->orWhere('load_state_origin', 'LIKE', "%$search%")
                      ->orWhere('load_city_desti', 'LIKE', "%$search%")
                      ->orWhere('full_partial_tl_ltl', 'LIKE', "%$search%")
                      ->orWhere('created_at', 'LIKE', "%$search%")
                      ->orWhere('equipments', 'LIKE', "%$search%")
                      ->orWhere('agent_name', 'LIKE', "%$search%")
                      ->paginate('15');
                      $user_loads->appends(array('search'=>  $search,));
                        if(count($user_loads )>0){
                          return view('backend.loadsManagement.manager.oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);
    
                          // return view('backend.loadsManagement.manager.oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);
                        }
                        return back()->with('error','No results Found');
                    }else{
                      $user_loads =  Load::orderBy('id', 'DESC')->paginate('15');
                    }
  
                }
                // 2023-06-27 00:06:04.351213 Asia/Kolkata (+05:30)
               
                if(isset($fromDate)){
                    
                    if(empty($toDate) ){
                      
                          //if you want to selected date to current-date data then you can use this select only formdate only
                      
                              //  $user_loads = Load::whereBetween('created_at', [$fromDate, date('Y-m-d')])->paginate('15');
                              //  $user_loads =  $user_loads->appends(array('fromdate'=>  $fromDate,  'todate'=>  date('Y-m-d')));
  
                          //if we want to same date data then we use this function 
                          
                              $user_loads = Load::query()
                              ->whereDate('created_at', '>=', $fromDate)
                              ->whereDate('created_at', '<=', $fromDate)
                              ->paginate('15');
  
                    //  $toDate = '' ;
                      if(count($user_loads )>0){
                      //  return view('backend.loadsManagement.manager.oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);


                       return view('backend.loadsManagement.mid-oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);
                      }
                  }
                  
                  
                  $user_loads = Load::whereBetween('created_at', [$fromDate, $toDate])->paginate('15');
                  $user_loads =  $user_loads->appends(array('fromdate'=>  $fromDate,  'todate'=>  $toDate));
                  
                  
  
                  if(count($user_loads )>0){
                    // return view('backend.loadsManagement.manager.oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);


                    return view('backend.loadsManagement.mid-oldreportlist',['user_loads'=>$user_loads, 'search'=>$search, 'fromDate'=>$fromDate, 'toDate'=>$toDate]);


                    
                  }
                }
  
                $userid = 1 ;
                $user_id = base64_decode($userid);
                $user = User::where('id',$user_id)->first();
                $equipments = DB::table('equipment_types')->get();
                //die('here');
                $user_loads= Load::where('user_id',$user_id)->orderBy('created_at','DESC')->get();       
                //   $results = Load::sortBy('created_at', 'desc')->get();
                // $user_loads = Load::all();
                $user_loads = Load::orderBy('id', 'DESC')->paginate('15');
                
            $page = 'Load';		
            return view('backend.loadsManagement.mid-oldreportlist', compact('page','equipments','user_loads','userid', 'user_id','search',
            'fromDate', 'toDate'));
          //   return view('backend.loadsManagement.oldreportlist', compact('page','equipments','user_loads','userid', 'user_id','search'));
                
        }



        // testing with db table new way  load reprot


    public function Loadlistc(Request $request){
      if (is_null($this->user) || !$this->user->can('loads-reports')) {
          abort(403, 'Sorry !! You are Unauthorized to edit any user !');
      }

      // $user_loads= Load::where('user_id',$user_id)->orderBy('created_at','DESC')->get();       
      $user_loads = Load::orderBy('id', 'DESC')->paginate('15');
            
      $page = 'Load';		
      return view('backend.loadsManagement.manager.newolddata', compact('user_loads'));
            
    }

    // newolddata.blade.php

    public function Loadlist(){
	
      $draw = @$_POST['draw'];
        $row = @$_POST['start'];
        $rowperpage = @$_POST['length']; // Rows display per page
        $columnIndex = @$_POST['order'][0]['column']; // Column index
        $columnName = @$_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = @$_POST['order'][0]['dir']; // asc or desc
        $searchValue = @$_POST['search']['value']; // Search value

        $listing = Load::select('*');
                        // ->whereNull('deleted_at')
                        // ->skip($_POST['start'])
                        // ->take($_POST['length']);

        // $listing = $listing->orderBy($columnName,$columnSortOrder);

        $recordCount = Load::count();
        $with_filter_count = $listing->count();
  
        // ----- search
        if($searchValue != ''){
  
          $listing = $listing->where('ref_no','like','%'.$searchValue.'%')
                                  ->orWhere('post_date','like','%'.$searchValue.'%')
                                  ->orWhere('load_state_origin','like','%'.$searchValue.'%')
                                  ->orWhere('load_city_desti','like','%'.$searchValue.'%')
                                  ->orWhere('equipments','like','%'.$searchValue.'%')
                                  ->orWhere('full_partial_tl_ltl','like','%'.$searchValue.'%')
                                  ->orWhere('agent_name','like','%'.$searchValue.'%');
                                  
          $with_filter_count = $listing->count();
        } 
  
        if($with_filter_count == 0){
          $with_filter_count = $recordCount;
        }
  
        $allRecords = $listing->get()->toArray();
        // $allRecords = $listing->get()->toArray();
  
  
        // Total number of records without filtering
        $totalRecords = $recordCount;
  
        //Total number of record with filtering
        $totalRecordwithFilter = $with_filter_count;
        $data = array();
  
        foreach ($allRecords as $key => $value) {
  
  
          $joined_on 	= date('d M, Y', strtotime($value['created_at']));
          $encoded_id = $value['id'];
  
              // $img = $value['image'];
  
              // $image = '<img src=" '.url('/storage/app/public/categories/'.$img).' " id="old_image" alt="No image" class="img-fluid" width="50px" height="50px">';
  
          $action = '<a href="'.url('/admin/category/edit/'.$encoded_id).'" title="Edit"><i class="fa fa-edit"></i>
          </a>
          <a href="'.url('/admin/category/delete/'.$encoded_id).'" class="del_btn" title="Delete Credential"><i class="fas fa-trash-alt"></i>
          </a>';
  
              $encoded_id = base64_encode($value['id']);
              // if($value['status'] == 'active'){
              //     $checked = 'checked';
              // } else{
              //     $checked = '';
              // }
  
              // $status_content = '<input type="checkbox" class="stat_check" '.$checked.' data-toggle="toggle" cat='.$encoded_id.'>';


              

                            $status =  $value['load_status'];
                            $date_pick = explode('T', $value['dat_pick_date']);
                            $date_pick1 = strtotime($date_pick['0']);
                            $today = strtotime(date('Y-m-d'));
                            $lstatus = '';
                            // 2022-11-18T10:29:20.000Z
                            
                            if ($today > $date_pick1) {
                                $lstatus = 'Expire';
                            } else {
                                if ($status == 1) {
                                    $lstatus = 'Delete';
                                } else {
                                    $lstatus = 'Active';
                                }
                            }

                            
  
              if(Auth::user()->user_type == 'super_admin'){
                  $data[] = array( 
                      "ref_no"=> $value['ref_no'],
                      "post_date"=>$value['post_date'],                
                      "load_state_origin"=>$value['load_state_origin'],                
                      "load_city_desti"=>$value['load_city_desti'],                
                      "equipments"=>$value['equipments'],                
                      "full_partial_tl_ltl"=>$value['full_partial_tl_ltl'],
                      "agent_name"=>ucfirst($value['agent_name']),
                      "status"=>$lstatus,         
                      "created_at"=>$joined_on,         
                      "action"=>$action,
                  );
              } else{
                  $data[] = array( 
                    "ref_no"=> $value['ref_no'],
                    "post_date"=>$value['post_date'],                                   
                    "action"=>$action,
                  );
              }
  
        }
        $response = array(
          "draw" => intval($draw),
          "iTotalRecords" => $totalRecords,
          "iTotalDisplayRecords" => $totalRecordwithFilter,
          "aaData" => $data
        );
        echo json_encode($response);
    }



      public function cuisinesList()
      {

        $draw = @$_POST['draw'];
        $row = @$_POST['start'];
        $rowperpage = @$_POST['length']; // Rows display per page
        $columnIndex = @$_POST['order'][0]['column']; // Column index
        $columnName = @$_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = @$_POST['order'][0]['dir']; // asc or desc
        $searchValue = @$_POST['search']['value']; // Search value

        $listing = Load::select('*');
                        // ->whereNull('deleted_at')
                        // ->skip($_POST['start'])
                        // ->take($_POST['length']);

        // $listing = $listing->orderBy($columnName,$columnSortOrder);

        $recordCount = Load::count();

        $with_filter_count = $listing->count();

        // ----- search
        if($searchValue != ''){

            $listing = $listing->where('ref_no','like','%'.$searchValue.'%')
                        ->orWhere('agent_name','like','%'.$searchValue.'%')
              ;
            $with_filter_count = $listing->count();
        } 

        if($with_filter_count == 0){
            $with_filter_count = $recordCount;
        }

        $allRecords = $listing->get()->toArray();

        // Total number of records without filtering
        $totalRecords = $recordCount;

        //Total number of record with filtering
        $totalRecordwithFilter = $with_filter_count;
        $data = array();

        foreach ($allRecords as $key => $value) {

            $joined_on 	= date('d M, Y', strtotime($value['created_at']));
            $encoded_id = $value['id'];
            // $encoded_id = base64_encode($value['id']);

            $action = '<a href="'.url('/admin/cuisine/edit/'.$encoded_id).'" title="Edit"><i class="fa fa-edit"></i>
            </a>
            <a href="'.url('/admin/cuisine/delete/'.$encoded_id).'" class="del_btn" title="Send Credential"><i class="fas fa-trash-alt"></i>
            </a>';

            // $action = '';

            $data[] = array( 
                "ref_no"=>$value['ref_no'],
                "agent_name"=>ucfirst($value['agent_name']),
                "action"=>$action,
            );
        }
        
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );
        echo json_encode($response);
      }
	
}
// end class