<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\EquipmentType;
use App\Models\Carriers;
use App\Models\CarrierRequest;
use App\Models\User;
use App\Models\Notification;


class CarrierRequestController extends Controller
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



    
    /* Carrier pending requests funcation start here */	
    public function CarrierRequests(){   
        
        if (is_null($this->user) || !$this->user->can('carrier-request')) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }
        
        $user_id = auth()->user()->id;
        $user = User::where('id',$user_id)->first();
        $carrierData = Carriers::where('status','0')->get();
        $Equipments = EquipmentType::get();

        $active = 'carriers';
        return view('backend.shipmentManagement.carrier.CarrierRequest',['active'=>$active,'user'=>$user,'carriers_data'=>$carrierData,'Equipments'=>$Equipments]);      


    }
    /* Carrier pending requests funcation end here */

    public function CarrierRequestEdit($id){
        
        $user_id = Auth::id();
        //$data = $request->all();

        $carrierData = Carriers::where('status','0') ->where('id',base64_decode($id))->first();

        return view('backend.shipmentManagement.carrier.CarrierRequestEdit',compact('carrierData'));

    }

    public function CarrierStatusUpdate(Request $request){
        $response = [];
        if($request->isMethod('post')){

            $userid = Auth::id();
            $data = $request->all();
           // dd($data);
            // echo '<pre>'; print_r($data); die;

            $carrier = Carriers::where('id',$data['companies_id'])->first();
            $user_data = User::where('id',$carrier['user_id'])->first();
            
            if(isset($data['approve']) == 'true'){
                $status = '1';
            } else{
                $status = '2';
            }

            $upd = Carriers::where('id',$data['companies_id'])->update(['status'=>$status]);

            $req_comment = New CarrierRequest;
            $req_comment->sender_id = $userid;
            $req_comment->receiver_id = $carrier['user_id'];
            $req_comment->carrier_id = $data['companies_id'];
            $req_comment->mc_no = $carrier['mc_no'];
            $req_comment->dot_no = $carrier['dot_no'];
            $req_comment->comment = $data['comment'];
            $req_comment->request_date = date('Y-m-d');
            $req_comment->status = $status;
            $req_comment->save();

            $usid = auth()->user()->id;
			$usname = auth()->user()->name;

            // $notif = new Notification;
            // $notif->user_id	    = $usid;
            // $notif->title	    = "Carrier request updated";
            // $notif->body	    = $usname;
            // $notif->assignto_id	= $carrier['user_id'];
            // $notif->status	    = '0';
            // $notif->url	        = 'admin/carrier/list';
            // $notif->save();

            return redirect('/admin/carrier/requests')->with('success','Carrier requests updated');
        }
    }


   /*
    public function CarrierRequestForm(Request $request){   
        
        $user_id = Auth::id();
        $data = $request->all();

        $carrier = Carriers::where('id',$data['carrier_id'])->first();

        return view('backend.shipmentManagement.carrier.requestForm',compact('carrier'));

    }*/
    public function RequestCommentForm(Request $request){
        $user_id = Auth::id();
        $carrier_id = $request->get('carrier_id');

        $carrier = CarrierRequest::where('id',$carrier_id)->first();
        $carrierData = Carriers::where('mc_no',$carrier['mc_no'])->first();
        $requestform = CarrierRequest::where('mc_no',$carrier['mc_no'])->orwhere('receiver_id',$user_id)->get();
        $upd_comment = CarrierRequest::where('id',$carrier_id)->update(['check_status'=> '1']);
        
        return view('backend.shipmentManagement.carrier.requestForm',compact('requestform','carrier','carrier_id','carrierData'));
    }
    

    public function RequestCommentUpdate(Request $request){
        $response = [];
        

            $userid = Auth::id();
            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            $carrier_req = CarrierRequest::where('id',$data['carrier_id'])->orderBy('id', 'DESC')->first();
            $user_data = User::where('id',$carrier_req['user_id'])->first();
            $Carrier_data = Carriers::where('mc_no',$carrier_req['mc_no'])->first();
            
            if($carrier_req['sender_id'] == $userid){
                $user_id= $carrier_req['receiver_id'];
            }else{
                $user_id= $carrier_req['sender_id'];
            }
			
            if($data['curr'] == 'true'){
                $status = '0';
				$upd = Carriers::where('mc_no',$carrier_req['mc_no'])->update(['status'=>$status]);
            }
			
            
            

            $req_comment = New CarrierRequest;
            $req_comment->sender_id = $userid;
            $req_comment->receiver_id = $user_id;
            $req_comment->carrier_id = $Carrier_data['id'];
            $req_comment->mc_no = $carrier_req['mc_no'];
            $req_comment->dot_no = $carrier_req['dot_no'];
            $req_comment->comment = $data['Comment'];
            $req_comment->request_date = date('Y-m-d');
            $req_comment->save();
 
            //return redirect('/admin/carrier')->with('success','Carrier requests updated');
        
    }




}
