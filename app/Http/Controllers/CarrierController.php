<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Carriers;
use App\Models\CarrierRequest;
use App\Models\EquipmentType;
use App\Models\Carrier_account;
use App\Models\User;
use App\Models\AssignUserTeam;
use App\Models\Shipment;
use Mail;
use App\Mail\NotifyMail;
use App\Models\Notification;

 

class CarrierController extends Controller
{
    
    public $user;
    
    function __construct()
    {
         $this->middleware('permission:carrier-all|carrier-list | carrier-view|carrier-create|carrier-edit|carrier-request
		| carrier-delete', ['only' => ['index','store']]);
         $this->middleware('permission:carrier-list', ['only' => ['create','store']]);
         $this->middleware('permission:carrier-create', ['only' => ['create','store']]);
         $this->middleware('permission:carrier-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:carrier-delete', ['only' => ['destroy']]);
         $this->middleware('permission:carrier-view', ['only' => ['view']]);
         $this->middleware('permission:carrier-request', ['only' => ['request']]);
         
         $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });

    }
    
	
/* Carrier dashboard funcation start here */	
	public function carrier_dashboard(){   
		
		$user_id = auth()->user()->id ;
		$user = DB::table('users')->where([
					['id', '=', $user_id],
				])->first();
		
		$Equipments = DB::table('equipment_types')->get();
		$carriers_data = DB::table('carriers')->where([
					['user_id', '=', $user_id],
				])->orderBy('id','DESC')->get();

		$active = 'carriers';
		return view('backend.shipmentManagement.carrier.index',['active'=>$active,'user'=>$user,'carriers_data'=>$carriers_data,'Equipments'=>$Equipments]);      
	}

/* Carrier dashboard funcation end here */		


/* Broker Carrier find Function Start Here */
	public function carriers_find(Request $request){
		if($request->ajax()){
			$carrier_name = $request->get('carrier_name');
			$carrier_mc = $request->get('carrier_mc');
			$carrier_dot = $request->get('carrier_dot');
			$carrier_data = DB::table('carriers');
			if(!empty($carrier_name)){
				$query = $carrier_data->where([ ['company_name', 'like', $carrier_name.'%'] ]);
			}
			if(!empty($carrier_mc)){
				$query = $carrier_data->where([ ['mc_no', '=', $carrier_mc] ]);
			}
			if(!empty($carrier_dot)){
				$query = $carrier_data->where([ ['dot_no', '=', $carrier_dot] ]);
			}
			$CarrierData = $query->get();
			$data = $CarrierData;
			echo json_encode($data);
		}
	}
	
/* Broker Carrier find Function End Here */	
	
	
/* Broker Add carrier form fetch Function Start Here */
	public function add_carrier_form(Request $request){
       
		$user_id = auth()->user()->id;        
        $user = DB::table('users')->where([
                    ['id', '=', $user_id],
                  ])->first();				  
		$equipments = DB::table('equipment_types')->get();
		return view('backend.shipmentManagement.carrier.add_carrier_form',['user'=>$user,'Equipments'=>$equipments]);
	}
/* Broker Add carrier form Function End Here */	
	
	
/*
 Broker add Carrier submit Function Start Here 
 */	
public function add_carrier(Request $request){        
		if($request->isMethod('post')){
			$user_id = Auth::id();
			$data= $request->all();    
			//print_r($data);die;
			$user = DB::table('users')->where([
                    ['id', '=', $user_id],
                  ])->first();
				  
				  $validatedData = $request->validate
				  ([	
				  		'mc_no' => 'required|unique:carriers,mc_no',
				  		'dot_no' => 'required|unique:carriers,dot_no'
				  ]);
			$get_value = substr($data['mc_no'], 0, 2);
				   
			$carrier_mc = Carriers::where('mc_no', '=', $get_value)->first();
			$carrier_dot = Carriers::where('dot_no', '=', $data['dot_no'])->first();
			
			// print_r($data['mc_no']);
			// print_r($data['dot_no']);
			// print_r($carrier_mc);
			// print_r($carrier_dot);
			// die('here');
			
			
			// if (($carrier_mc === NULL) || ($carrier_mc->mc_no != $request->input('mc_no')) || ($carrier_dot === NULL) || ($carrier_dot->dot_no != $request->input('dot_no')) ) {
			//    die('here');
			// }else{
				
			// 	$validatedData = $request->validate
			// 	([	
			// 		'mc_no' => 'required|unique:carriers,mc_no',
			// 		'dot_no' => 'required|unique:carriers,dot_no'
			// 	]);
			// 	die('here2222');
			// 	//return redirect('/admin/new-carrier')->with('errors',COMMON_ERROR);
			// }
			//die('here3333');

			$reqestresenddate = date("Y-m-d H:i:s");


			if(($get_value == '') || ($carrier_dot == '')){
		  	$CarrierAdd = new Carriers;  
			$CarrierAdd->user_id = $user_id;
			$CarrierAdd->c_company_name = $request->input('company_name');
			$CarrierAdd->mc_no = $request->input('mc_no');
			$CarrierAdd->dot_no = $request->input('dot_no');
			$CarrierAdd->carrier_city = $request->input('carrier_city');
			$CarrierAdd->carrier_city_main = $request->input('carrier_city_main');
			$CarrierAdd->carrier_state = $request->input('carrier_state');
			$CarrierAdd->carrier_zip = $request->input('carrier_zip');
			$CarrierAdd->equipments = $request->input('equipments');
			$CarrierAdd->phone_no = $request->input('phone_no');
			$CarrierAdd->carrier_fax = $request->input('carrier_fax');
			$CarrierAdd->email = $request->input('email');
			// $CarrierAdd->dispatcher = $request->input('dispatcher');
			$CarrierAdd->cargo_amount = $request->input('cargo_amount');
			$CarrierAdd->cargo_expires = $request->input('cargo_expires');
			$CarrierAdd->cargo_deduct_amount = $request->input('cargo_deduct_amount');
			$CarrierAdd->liability_amount = $request->input('liability_amount');
			$CarrierAdd->liability_expires = $request->input('liability_expires');
			$CarrierAdd->gen_liab_amount = $request->input('gen_liab_amount');
			$CarrierAdd->gen_liab_expires = $request->input('gen_liab_expires');
			$CarrierAdd->reefer_bkdn = $request->input('reefer_bkdn');
			$CarrierAdd->reefer_brk_deduct = $request->input('reefer_brk_deduct');
			$CarrierAdd->contact_auth = $request->input('contact_auth');
			$CarrierAdd->common_auth = $request->input('common_auth');
			$CarrierAdd->safety = $request->input('safety');
			$CarrierAdd->tax_id = $request->input('tax_id');
			$CarrierAdd->d_name = $request->input('d_name');
			$CarrierAdd->d_phone = $request->input('d_phone');

			$CarrierAdd->load_reference = $request->input('load_reference');

			
			$CarrierAdd->carrier_requestdate = $reqestresenddate;

			
			
			//die('here23');
			if($CarrierAdd->save()){
				
				
				$carrier_account = new Carrier_account;	
                
                $carrier_account->carrier_id = $CarrierAdd->id;
                $carrier_account->payto  = '0';
				$carrier_account->save();
				
				$usid = auth()->user()->id ;
				$usname = auth()->user()->name ;
				
				    $notif = new Notification;
					$notif->user_id	    = $usid;
					$notif->title	    = "Create New Carrier";
					$notif->body	    = $usname;
					$notif->assignto_id	= '1';
					$notif->status	    = '0';
					$notif->url	        = 'admin/carrier/request/edit/'.base64_encode($CarrierAdd->id);
					$notif->save();
                return redirect('/admin/carrier')->with('success','Carrier added successfully');
            } else {
					
                return redirect('/admin/new/carrier/detail')->with('errors',COMMON_ERROR);
            }
		}else{
			return redirect('/admin/new/carrier/detail')->with('errors','Carrier already added!');
		}
			
			$page = 'carriers';
			return view('backend.shipmentManagement.carrier', compact('page'));
		}
	}
/*
 Broker add Carrier submit Function End Here 
 */	

//request resend use when disapproved carrier by approver start 
	public function RequsetResend(Request $request,$carrier_id){
		$user_id = Auth::id();
		//Company::where('id',$data['id'])->update(['check_status'=> '1']);
		$shipper = Carriers::where('id',base64_decode($carrier_id) )->update(['carrier_requestdate'=> date("Y-m-d H:i:s"),'status'=> '0']);

		//  $req_comment = New Shipper_request;
		//  $req_comment->save();
		// $req_comment = New Shipper_request;
		// $req_comment->sender_id = $user_id;
		// $req_comment->companies_id = base64_decode($shipper_id);
		// $req_comment->comment = 'New request re-sent';
		// $req_comment->request_date = date('Y-m-d');
		// $req_comment->type = 'Shipper approved';
		// $req_comment->req_sent = '1';
		// $req_comment->save();
		return redirect('/admin/carrier')->with('success','Carrier request re-sent Successfully');
	}

//request resend use when disapproved carrier by approver end

public function NewCarrierDetail(Request $request){
	
	if (is_null($this->user) || !$this->user->can('carrier-create')) {
		abort(403, 'Sorry !! You are Unauthorized to edit any user !');
	}

	$user_id = Auth::id();

	$user = User::where('id',$user_id)->first();
	
	$Equipments = EquipmentType::get();
	
	return view('backend.shipmentManagement.mycarrier-packet.add', compact('user','Equipments'));	
}


	/* MyCarrier-packet more detail funcation start here */	
	public function NewCarrierAdd(Request $request){ 
	
		$user_id = Auth::id();
		$user = DB::table('users')->where([
					['id', '=', $user_id],
				])->first();
		$Equipments = EquipmentType::get();

		
				if($request->isMethod('post')){

					$data = $request->all();
					
					// $get_value = substr($carrier_id, 0, 3);
					// $filter_value = substr($carrier_id, 3);

					if(isset($data['DotNumber'])){
						$carrierId = '?DotNumber='.$data['DotNumber'];
					}
					if(isset($data['DocketNumber'])){
						$carrierId = '?DocketNumber=MC'.$data['DocketNumber'];
					}
				

				$mycarrier_packet = DB::table('mycarrier_packets')->first();

				$URL = "https://api.mycarrierpackets.com/api/v1/Carrier/GetCarrierData".$carrierId."";
				$curl = curl_init();
				curl_setopt_array($curl, array(
				CURLOPT_URL => $URL,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_TIMEOUT => 30000,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "POST",
				CURLOPT_POST => 1,
				CURLOPT_HTTPHEADER => array(
				'Content-Type: application/json',
				"Authorization: Bearer ".$mycarrier_packet->token.""
				)

				));
					$response = curl_exec($curl);
				if (curl_errno($curl)) 
				{
							$error_msg = curl_error($curl);
						print_r($error_msg);
				}	
					curl_close($curl);
					$results = json_decode($response);
					//dd($results);
					//print_r($results);die;
					return view('backend.shipmentManagement.carrier.Carrier-profile', compact('results'));
				}else{
					return view('backend.shipmentManagement.mycarrier-packet.add', compact('user','Equipments'));
				}

	}
	/* MyCarrier-packet more detail funcation end here */	



/*
 Broker Carrier find Function Start Here 
 */
	public function carriers_edit(Request $request){
		
		$user_id = Auth::id();
		$carrier_id = $request->get('carrier_id');

		$user = User::where('id',$user_id)->first();
					  
		$Equipments = DB::table('equipment_types')->get();
		$CarrierData = Carriers::where('id',$carrier_id)->first();
			
		return view('backend.shipmentManagement.carrier.carriers_edit',['CarrierData'=>$CarrierData,'Equipments'=>$Equipments]);
	}
/*
 Broker Carrier find Function End Here 
 */
 
	
		
		/* New Carrier form funcation start here */	
			public function new_carrier(){   
				$user_id = auth()->user()->id ;
					$user = DB::table('users')->where([
								['id', '=', $user_id],
							])->first();
					$Equipments = DB::table('equipment_types')->get();
				$active = 'new_carrier';	
				return view('backend.shipmentManagement.carrier.new_carrier',['user'=>$user,'Equipments'=>$Equipments]);
							
			}
		/* New Carrier form funcation start here */	


		/*
		Broker Carrier form update Function Start Here 
		*/
		public function update_carriers(Request $request)
		{	
			
			$user_id = auth()->user()->id;
			$user = DB::table('users')->where([
						['id', '=', $user_id],
					])->first();	
					
			$carriers_id = $request->input('carriers_id');
			$data = $request->all();
			//print_r($carriers_id);die;
				
			$carriersupdate = Carriers::where('id',$carriers_id)->first();
			$carriersupdate['c_company_name'] 		= $data['company_name'];
			$carriersupdate['mc_no'] 				= $data['mc_no'];
			$carriersupdate['dot_no'] 				= $data['dot_no'];
			$carriersupdate['carrier_city'] 		= $data['carrier_city'];
			$carriersupdate['carrier_city_main'] 	= $data['carrier_city_main'];
			$carriersupdate['carrier_state'] 		= $data['carrier_state'];
			$carriersupdate['carrier_zip'] 			= $data['carrier_zip'];
			$carriersupdate['phone_no'] 			= $data['phone_no'];
			$carriersupdate['carrier_fax'] 			= $data['carrier_fax'];
			$carriersupdate['email'] 				= $data['email'];
			$carriersupdate['dispatcher'] 			= $data['dispatcher'];
			$carriersupdate['equipments'] 			= $data['equipments'];
			$carriersupdate['cargo_amount'] 		= $data['cargo_amount'];
			$carriersupdate['cargo_expires'] 		= $data['cargo_expires'];
			$carriersupdate['cargo_deduct_amount'] 	= $data['cargo_deduct_amount'];
			$carriersupdate['liability_amount'] 	= $data['liability_amount'];
			$carriersupdate['liability_expires'] 	= $data['liability_expires'];
			$carriersupdate['gen_liab_amount'] 		= $data['gen_liab_amount'];
			$carriersupdate['gen_liab_expires'] 	= $data['gen_liab_expires'];
			$carriersupdate['reefer_bkdn'] 			= $data['reefer_bkdn'];
			$carriersupdate['reefer_brk_deduct'] 	= $data['reefer_brk_deduct'];
			$carriersupdate['contact_auth'] 		= $data['contact_auth'];
			$carriersupdate['common_auth'] 			= $data['common_auth'];
			$carriersupdate['d_name'] 				= $data['d_name'];
			$carriersupdate['d_phone'] 				= $data['d_phone'];
			$carriersupdate['tax_id'] 				= $data['tax_id'];
			$carriersupdate->save();
			
			return redirect('admin/carrier')->
						with('success', 'Carrier Update Successfully');
			
		}
		/*
		Broker Carrier form update Function End Here 
		*/
 
	
	
		/* MyCarrier packet index funcation start here */	
		public function MyCarrierPacket()
		{   
			$user_id = auth()->user()->id ;
			$user = DB::table('users')->where([
						['id', '=', $user_id],
					])->first();

			$Equipments = DB::table('equipment_types')->get();

		$active = 'new_carrier';	
		return view('backend.shipmentManagement.mycarrier-packet.index',['user'=>$user,'Equipments'=>$Equipments]);

		}
		/* MyCarrier packet index funcation end here */	
	

		/* MyCarrier-packet details preview funcation start here */	
		public function PreviewCarrierDetail(Request $request)
		{   
			$user_id = auth()->user()->id ;
			$user = DB::table('users')->where([
						['id', '=', $user_id],
					])->first();
			
				if($request->isMethod('get')){

					$data = $request->all();

					if(isset($data['DotNumber'])){
						$carrierId = '?DotNumber='.$data['DotNumber'];
						$carrier_id = 'DOT'.$data['DotNumber'];
					}
					if($data['DocketNumber']){
						$carrierId = '?DocketNumber=MC'.$data['DocketNumber'];
						$carrier_id = 'MCN'.$data['DocketNumber'];
					}
				}
				//dd($carrierId);

			$mycarrier_packet = DB::table('mycarrier_packets')->first();


			$URL = "https://api.mycarrierpackets.com/api/v1/carrier/previewcarrier".$carrierId."";
			// 	https://api.mycarrierpackets.com/api/v1/carrier/previewcarrier?DocketNumber=MC1198665
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => $URL,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_TIMEOUT => 30000,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POST => 1,
			CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			"Authorization: Bearer ".$mycarrier_packet->token.""
			)

			));
				$response = curl_exec($curl);
			if (curl_errno($curl)) 
			{
						$error_msg = curl_error($curl);
					print_r($error_msg);
			}	
				curl_close($curl);

			$results = json_decode($response);
			//print_r($response);die;

			return view('backend.shipmentManagement.mycarrier-packet.preview_data', compact('results','carrier_id'));


		}
		/* MyCarrier-packet details preview funcation end here */	



		/* MyCarrier-packet more detail funcation start here */	
		public function PreviewCarrierProfile(Request $request,$carrier_id)
		{   
			$user_id = auth()->user()->id ;
			$user = DB::table('users')->where([
						['id', '=', $user_id],
					])->first();

			
					if($request->isMethod('get')){

						$data = $request->all();
						$get_value = substr($carrier_id, 0, 3);
						$filter_value = substr($carrier_id, 3);

						if($get_value == 'DOT'){
							$carrierId = '?DotNumber='.$filter_value;
						}
						if($get_value == 'MCN'){
							$carrierId = '?DocketNumber=MC'.$filter_value;
						}
					}
		
				$mycarrier_packet = DB::table('mycarrier_packets')->first();
		
		
			$URL = "https://api.mycarrierpackets.com/api/v1/Carrier/GetCarrierData".$carrierId."";
			
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => $URL,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_TIMEOUT => 30000,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POST => 1,
			CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			"Authorization: Bearer ".$mycarrier_packet->token.""
			)
			
			));
			$response = curl_exec($curl);
		if (curl_errno($curl)) 
		{
					$error_msg = curl_error($curl);
				print_r($error_msg);
		}	
			curl_close($curl);
		
			$results = json_decode($response);
		//print_r($results);die;
			
			return view('backend.shipmentManagement.mycarrier-packet.carrier_profile', compact('results'));

		}
		/* MyCarrier-packet more detail funcation end here */	


	
		/* MyCarrier-packet more detail funcation start here */	
		public function CarrierGetDocument(Request $request)
		{   
			$user_id = auth()->user()->id ;
			$user = DB::table('users')->where([
						['id', '=', $user_id],
					])->first();
					
			
					// if($request->isMethod('post')){

						$data = $request->all();
						
					//}
		
				$mycarrier_packet = DB::table('mycarrier_packets')->first();
		
			//$URL = "https://api.mycarrierpackets.com/api/v1/carrier/getDocument?name=".$data['file']."";
			$URL = "https://api.mycarrierpackets.com/api/v1/carrier/getDocument?name=certificate-image/b06412dc-9f3d-4425-92bd-1a7db32a2fd0.pdf";
			//dd($URL);
			print_r($URL);
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => $URL,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_TIMEOUT => 30000,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POST => 1,
			CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			"Authorization: Bearer ".$mycarrier_packet->token.""
			)
			
			));
				$response = curl_exec($curl);
			if (curl_errno($curl)) 
			{
						$error_msg = curl_error($curl);
					print_r($error_msg);
			}	
				curl_close($curl);
		
			$results = json_decode($response);
		print_r($results);die('here');
			
			return view('backend.shipmentManagement.mycarrier-packet.carrier_profile', compact('results'));

		}

		/* MyCarrier-packet email invite form funcation start here */	
		public function CarrierEmailInviteForm(Request $request)
		{   
				$user_id = auth()->user()->id;
				$user = DB::table('users')->where([
						['id', '=', $user_id],
					])->first();

			
					if($request->isMethod('get')){
						$data = $request->all();
						if($data['DotNumber']){
							$carrierId = '?DotNumber='.$data['DotNumber'];
						}
						if($data['DocketNumber']){
							$carrierId = '?DocketNumber='.$data['DocketNumber'];
						}
						$mycarrier_packet = DB::table('mycarrier_packets')->first();
			
				$URL = "https://api.mycarrierpackets.com/api/v1/carrier/previewcarrier".$carrierId."";
				
				
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => $URL,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_TIMEOUT => 30000,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POST => 1,
			CURLOPT_HTTPHEADER => array(
			'Content-Type: application/json',
			"Authorization: Bearer ".$mycarrier_packet->token.""
			)
			
			));
				$response = curl_exec($curl);
			if (curl_errno($curl)) 
			{
						$error_msg = curl_error($curl);
					print_r($error_msg);
			}	
				curl_close($curl);
			
				$results = json_decode($response);
				

			return view('backend.shipmentManagement.mycarrier-packet.email_invite', compact('results'));

					}

		}
		/* MyCarrier-packet email invite form funcation end here */	


		/* Carrier-packet email invite sent funcation start here */	
		public function EmailInviteSent(Request $request)
		{   
				$user_id = Auth::id();
				$user = User::where('id', $user_id)->first();


						$req = $request->all();
						$data = array('name'=>$user['name'],'from'=>$user['email'],'to'=>$req['verify_emails']);
						
		
						Mail::send('emails.CarrierPacketInvite.invite_link', $data, function($message)use ($data) {
						$message->to($data['to'], 'AMB Logistic')->subject
							('Carrier Packet Invitation from AMB Logistic');
							$message->from($data['from'],$data['name']);
						});
					

		}
		/* Carrier-packet email invite sent funcation end here */	



        public function carrierlist(Request $request){
			$user_id = auth()->user()->id;
			$user = DB::table('users')->where([
					['id', '=', $user_id],
				])->first();
				
				if (is_null($this->user) || !$this->user->can('carrier-all')) {
                    abort(403, 'Sorry !! You are Unauthorized to create any role !');
                }	
			$Equipments = DB::table('equipment_types')->get();
			$carriers_data = DB::table('carriers')->orderBy('id','DESC')->get();
			$active = 'carriers';
			return view('backend.shipmentManagement.carrier.list',['active'=>$active,'user'=>$user,'carriers_data'=>$carriers_data,'Equipments'=>$Equipments]); 
		}

		
		public function disputedcarrier(Request $request){
			$user_id = auth()->user()->id;
			$user = DB::table('users')->where([
					['id', '=', $user_id],
				])->first();
				
				// if (is_null($this->user) || !$this->user->can('carrier-all')) {
                //     abort(403, 'Sorry !! You are Unauthorized to create any role !');
                // }	
			$Equipments = DB::table('equipment_types')->get();
			if($user_id == 1){
				$carriers_data = DB::table('carriers')->orderBy('id','DESC')->get();
			}else{
					$carriers_data = DB::table('carriers')->where([
						['user_id', '=', $user_id],
					])->orderBy('id','DESC')->get();
				}
			$active = 'carriers';
			return view('backend.shipmentManagement.carrier.disputedcarrier',['active'=>$active,'user'=>$user,'carriers_data'=>$carriers_data,'Equipments'=>$Equipments]); 
		}


		//disputed carrier status

		
		public function disputedcarrierstatus(Request $request){
            $response = [];
            if($request->isMethod('post')){
                $data = $request->all();
                
                $statusid = $data['cat'];

				//dd($statusid);
               // $statusid = $data['cat'];
               
                if($data['curr'] == 'true'){
                    $status = '1';
                } else{
                    $status = '0';
                }
                
                //$upd = Shipment::where('id',$statusid)->update(['ap_access_status'=>$status,'ap_access_date'=>date('Y-m-d')]);
                $shipmentget = Carriers::where('id',$statusid)->first();
                // $shipmentget->ap_access_date = date('Y-m-d');
                $shipmentget->carrier_disputed = $status;
                $shipmentget->save();
    
                if($shipmentget){
                    $response['status'] = 'true';
                    $response['msg']    = 'Carrier Blocked Status updated successfully';
                } else{
                    $response['status'] = 'false';
                    $response['msg']    = 'COMMON_ERROR';
                }
            }
            return $response;
        }

	
		public function CarrierProfileCheck($id){
		    
		     $id = base64_decode($id);
			
			$carrier = Carriers::where('id',$id)->first();
			
			$shipmentsdata = Shipment::where('carrier_id',$id)->with('shipmentPrice')->get();
			$load = Count($shipmentsdata);
			
			$sum= 0;
			//	$price = 0;
			foreach($shipmentsdata as $result){
			    $price = 0;
				foreach($result['shipmentPrice'] as $res_item){
					$price= $res_item['carrier_total'];
				}
					$sum += $price;
			}
			//dd($sum);
			return view('backend.shipmentManagement.carrier.profile', compact('carrier','load','sum'));
		}
		
		
		
		public function CarrierPacketToken(Request $request){
			
			$user_id = Auth::id();
			
			$packet_user = DB::table('mycarrier_packets')->first();
			//$access= '{"grant_type": "password"}{"username": "'.$packet_user->user_name.'"}{"password": "'.$packet_user->password.'"}';
			$access= 'grant_type=password&username='.$packet_user->user_name.'&password='.$packet_user->password;
			
			
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.mycarrierpackets.com/token",// your preferred link
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_TIMEOUT => 30000,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $access,
			CURLOPT_HTTPHEADER => array(
			// Set Here Your Requesred Headers
			'Content-Type: application/x-www-form-urlencoded'
			

			),
			));

				$response = curl_exec($curl);
				curl_close($curl);

				$res = json_decode($response);
				//print_r($res);
				
				if(!empty($res))
				{
					$datupdate = DB::update('update mycarrier_packets set token =? where id = ?',[ $res->access_token, $packet_user->id ]);
				}
			
		}



		public function srequsetLog(){
			if (is_null($this->user) || !$this->user->can('carrier-log-user')) {
				abort(403, 'Sorry !! You are Unauthorized to create any role !');
			}	
			// $data = Company::All();
			$user_id = Auth::id();
			$user = User::where('id',$user_id)->first();
			// $comp_data = Company::where('approved','0')->orderBy('company_date','DESC')->get();
			// $shiper_log = Shipper_request::get();

			$ship = '';
			if($user_id == 1){
				$ship = CarrierRequest::get();

			}else{
				$ship = CarrierRequest::where('sender_id',$user_id)->get();
			}
			$page = 'shipper_details';
			// return view('backend.shipmentManagement.carrier.log.approverlog', compact('page','user','user_id','ship'));//testing
			return view('backend.shipmentManagement.carrier.log.carrierapproverlog', compact('page','user','user_id','ship'));//live
		}


		public function srequsetLogall(){
			if (is_null($this->user) || !$this->user->can('carrier-log-admin') ) {
				abort(403, 'Sorry !! You are Unauthorized to create any role !');
			}	

			// $data = Company::All();
			$user_id = Auth::id();
			$user = User::where('id',$user_id)->first();
			// $comp_data = Company::where('approved','0')->orderBy('company_date','DESC')->get();
			// $shiper_log = Shipper_request::get();

			$ship = CarrierRequest::get();
			$page = 'shipper_details';
			// return view('backend.shipmentManagement.carrier.log.approverlog', compact('page','user','user_id','ship'));//testing
			return view('backend.shipmentManagement.carrier.log.carrierapproverlog', compact('page','user','user_id','ship'));//live
		}


		



		public function allPosts(Request $request){
                    
            $columns = array( 
                                0 =>'id', 
                                1 =>'mc_no',
                                2=> 'dot_no',
                                3=> 'comment',
                                4> 'status',
                                5=> 'created_at',
                            );

							
      
            // $totalData = Load::count();
			$user_id = Auth::id();
			$ship = CarrierRequest::where('sender_id',$user_id)->get();
                
            $totalFiltered = $totalData; 

            $limit = $request->input('length');
            $start = $request->input('start');
            $order = $columns[$request->input('order.0.column')];
            $dir = $request->input('order.0.dir');
                
            if(empty($request->input('search.value')))
            {            
              $posts = CarrierRequest::offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();
            }

            else {
                $search = $request->input('search.value'); 
                $posts =  CarrierRequest::where('id','LIKE',"%{$search}%")
                                ->orWhere('mc_no', 'LIKE',"%{$search}%")
                                ->orWhere('dot_no', 'LIKE', "%$search%")
                                ->orWhere('comment', 'LIKE', "%$search%")
                                ->orWhere('created_at', 'LIKE', "%$search%")                                
                                ->offset($start)
                                ->limit($limit)
                                ->orderBy($order,$dir)
                                ->get();

                $totalFiltered = CarrierRequest::where('id','LIKE',"%{$search}%")
                                ->orWhere('mc_no', 'LIKE',"%{$search}%")
                                ->count();
            }

            $data = array();
            if(!empty($posts))
            {
                foreach ($posts as $post){

					//dd($post );
					$user_data = App\Models\User::where('id',$post->sender_id)->first();
					$comment = isset($post->comment) ? $post->comment : Null ;
						$status = ''; 
						if ($post->status == 1){
							$status = 'Approved';
						}
						else{
							$status = 'DisApproved';
						}
                                            
                    $show    =   url('admin/load/reports/allpost').'/'.$post->id;
                    $edit    =   url('admin/load/reports/allpost').'/'.$post->id ;
                    $show    =   $post->load_dat_id;


                    $nestedData['id'] = $post->id;
                    $nestedData['mc_no'] = $post->mc_no;
                    $nestedData['dot_no'] = $post->dot_no;
                    $nestedData['comment'] = $post->comment;
                    $nestedData['status'] = $status;
                    $nestedData['created_at'] = date('j M Y h:i a',strtotime($post->created_at));
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
		
		
	
 }