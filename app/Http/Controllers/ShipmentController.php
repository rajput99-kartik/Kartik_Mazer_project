<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB,Hash,DateTime,Mail,File,Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Redirect,Response;
use Carbon\Carbon;
use App\Models\Shipment;
use App\Models\Shipmentpick;
use App\Models\Shipmentdrop;
use App\Models\ShipmentDoc;
use App\Models\Shipmentrate;
use App\Models\AccountsPayable;
use App\Models\AccountReceivable;
use App\Models\Dat;
use App\Http\Requests;
use App\Models\User;
use App\Models\EquipmentType;
use App\Models\Company;
use App\Models\Notification;
use App\Models\AgencyDetail;
use App\Models\AssignUserTeam;
use App\Models\CarrierPayment;
use App\Models\LoadActivity;
use App\Models\LoadActivityInfo;
use App\Models\ShipmentBol;
use App\Models\ShipmentBolItem;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\LogOptions; 
use Spatie\Activitylog\Traits\LogsActivity;
// use App\Models\carriers_payment;
class ShipmentController extends Controller
{
    	
   	    public $user;
        function __construct()
        {
             $this->middleware('permission:shipment-list|shipment-view|shipment-approve|shipment-create|shipment-edit|shipment-delete', ['only' => ['index','store']]);
             $this->middleware('permission:shipment-approve', ['only' => ['approve','approve']]);
             $this->middleware('permission:shipment-create', ['only' => ['create','store']]);
             $this->middleware('permission:shipment-edit', ['only' => ['edit','update']]);
             $this->middleware('permission:shipment-delete', ['only' => ['destroy']]);
    
             $this->middleware(function ($request, $next) {
                $this->user = Auth::guard('web')->user();
                return $next($request);
            });
        }
        public function shipment_statue_update(){   
            if (is_null($this->user) || !$this->user->can('shipment-approve')) {
                abort(403, 'Sorry !! You are Unauthorized to view any admin !');
            }
            
			$user_id = auth()->user()->id ;
			$user = DB::table('users')->where([
                        ['user_id', '=', $user_id],
                    ])->first();
            $shipment_data = DB::table('shipment')
                        ->leftjoin('shipment_lanes_picks','shipment_lanes_picks.shipment_id','=','shipment.shipment_id')
                        ->leftjoin('shipment_lanes_drops','shipment_lanes_drops.shipment_id','=','shipment.shipment_id')
                        ->where([ ['shipment.shipment_statue', '!=', 'Delivered'] ])
                        ->orderBy('shipment.shipment_id','DESC')->get();
                        
                       // $sdf = shipment::with('shipment_lanes_picks')->get() ;
                        
            
            $timezone=date_create("",timezone_open("America/New_York"));
            $todaydate = date_format($timezone,"Y-m-d");
            foreach($shipment_data as $shipment_res){
                if($shipment_res->shipment_statue == 'Open')
                {
                    if(!empty($shipment_res->shipment_c_mc))
                    {
                        $shipmentupdate = DB::update('update shipment set shipment_statue =? where shipment_id = ?',[ 'Covered',$shipment_res->shipment_id]);
                    }
                }
                
                if($shipment_res->shipment_statue == 'Covered')
                {
                    if($todaydate >= ($shipment_res->p_ready))
                    {  
                        $shipmentupdate = DB::update('update shipment set shipment_statue =? where shipment_id = ?',[ 'Consignee',$shipment_res->shipment_id]);
                    }
                }
                if($shipment_res->shipment_statue == 'Consignee') 
                {
                    if($todaydate >= ($shipment_res->d_ready))
                    {
                        $shipmentupdate = DB::update('update shipment set shipment_statue =? where shipment_id = ?',[ 'Intransit',$shipment_res->shipment_id]);
                    }
                }
            }		
            
            $shipment_open = DB::table('shipment')->where([ ['shipment.shipment_statue', '=', 'Intransit'],['shipment_c_dot', '=', NULL],['shipment_c_mc', '=', NULL] ])->orderBy('shipment.shipment_id','DESC')->first();
                if($shipment_open)
                {
                    $shipmentupdate = DB::update('update shipment set shipment_statue =? where shipment_id = ?',[ 'Open',$shipment_open->shipment_id]);
                }
            // shipment status update end
                        
            $carrier_data = DB::table('shipment')
                        ->leftjoin('shipment_lanes_picks','shipment_lanes_picks.shipment_id','=','shipment.shipment_id')
                        ->leftjoin('shipment_lanes_drops','shipment_lanes_drops.shipment_id','=','shipment.shipment_id')
                        ->where([ ['shipment.payment_status', '=', 1 ] ])
                        ->orderBy('shipment_lanes_drops.manage_order','DESC')->get();		
        
            foreach($carrier_data as $carrier_result)
            {
                $userdata = DB::table('users')->where([ ['user_id', '=', $carrier_result->user_id], ])->first();
                    
            $today = date('Y-m-d');
            $shipment_drop = $carrier_result->d_ready;            
                die;
            }
            
            $activity = Activity::all();
            $lastActivity = Activity::latest()->first();
            dd($lastActivity);
            return LogOptions::defaults()
            ->useLogName('Shipment Table')
            ->setDescriptionForEvent(fn(string $eventName) => "{$authName->name} {$eventName} User Shipment")
            ->logFillable()
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->logUnguarded();
            
            dd(LogOptions::defaults());
            
        }
        /* shipment page Function Start Here */
        public function shipment(Request $request){  
			$user_id = auth()->user()->id;   
			$user = DB::table('users')->where([
                        ['id', '=', $user_id],
                    ])->first();
            
            $Equipments = DB::table('equipment_types')->get();
            
            $shipment = DB::table('shipment')
						->leftjoin('companies', 'companies.id', '=', 'shipment.companies_id')
						->leftjoin('carriers', 'carriers.id', '=', 'shipment.carrier_id')
						->where([ ['shipment.user_id', '=', $user_id] ])
						->select('shipment.id','shipment.shipment_approved','companies.company_name','carriers.c_company_name','shipment.shipment_statue')
						->orderBy('shipment.id','DESC')->get();
            
            $total =  Shipment::where('user_id',$user_id)->count();
            $shipment_open =  Shipment::where('shipment_statue', '=', 'Open')->where('user_id',$user_id)->count();
            $shipment_covered =  Shipment::where('shipment_statue', '=', 'Covered')->where('user_id',$user_id)->count();
            $shipment_transit =  Shipment::where('shipment_statue', '=', 'In-transit')->where('user_id',$user_id)->count();
            $shipment_delivered =  Shipment::where('shipment_statue', '=', 'Delivered')->where('user_id',$user_id)->count();
            $shipment_paid =  Shipment::where('shipment_statue', '=', 'Paid')->where('user_id',$user_id)->count();
            $shipment_invoice =  Shipment::where('shipment_statue', '=', 'Invoiced')->where('user_id',$user_id)->count();
			
            $active = 'all_shipment';   
            return view('backend.shipmentManagement.shipment.index',['active'=>$active,'user'=>$user,'shipment'=>$shipment,'Equipments'=>$Equipments,'total'=>$total,'shipment_open'=>$shipment_open,'shipment_covered'=>$shipment_covered,'shipment_transit'=>$shipment_transit,'shipment_delivered'=>$shipment_delivered,'shipment_paid'=>$shipment_paid,'shipment_invoice'=>$shipment_invoice]);
        }
        /* shipment page Function End Here */  
        /* shipment page Function Start Here */
        public function shipmentReq(Request $request){  
			$user_id = auth()->user()->id;   
			$user = DB::table('users')->where([
                        ['id', '=', $user_id],
                    ])->first();
            $Equipments = DB::table('equipment_types')->get();
            $shipment = DB::table('shipment')
						->leftjoin('companies', 'companies.id', '=', 'shipment.companies_id')
						->leftjoin('carriers', 'carriers.id', '=', 'shipment.carrier_id')
						->where([ ['shipment.user_id', '=', $user_id] ])
						->select('shipment.id','shipment.shipment_approved','companies.company_name','carriers.c_company_name','shipment.shipment_statue')
						->orderBy('shipment.id','DESC')->get();
            $total =  Shipment::where('user_id',$user_id)->count();
            $shipment_open =  Shipment::where('shipment_statue', '=', 'Open')->where('user_id',$user_id)->count();
            $shipment_covered =  Shipment::where('shipment_statue', '=', 'Covered')->where('user_id',$user_id)->count();
            $shipment_transit =  Shipment::where('shipment_statue', '=', 'In-transit')->where('user_id',$user_id)->count();
            $shipment_delivered =  Shipment::where('shipment_statue', '=', 'Delivered')->where('user_id',$user_id)->count();
            $shipment_paid =  Shipment::where('shipment_statue', '=', 'Paid')->where('user_id',$user_id)->count();
            $shipment_invoice =  Shipment::where('shipment_statue', '=', 'Invoiced')->where('user_id',$user_id)->count();
            $active = 'all_shipment';   
            return view('backend.shipmentManagement.shipment.shipmentreq_approve',['active'=>$active,'user'=>$user,'shipment'=>$shipment,'Equipments'=>$Equipments,'total'=>$total,'shipment_open'=>$shipment_open,'shipment_covered'=>$shipment_covered,'shipment_transit'=>$shipment_transit,'shipment_delivered'=>$shipment_delivered,'shipment_paid'=>$shipment_paid,'shipment_invoice'=>$shipment_invoice]);
        }
        /* shipment page Function End Here */  
        /* shipment view Function Start Here */
        public function shipment_view($shipment_edit)
            {
                // if (is_null($this->user) || !$this->user->can('shipment-edit')) {
                //  abort(403, 'Sorry !! You are Unauthorized to view any admin !');
                // }
                    $shipment_id = base64_decode($shipment_edit);
                    $user_id = auth()->user()->id ;
                    $user = DB::table('users')->where([
                                ['id', '=', $user_id],
                            ])->first();	
                    $Equipments = DB::table('equipment_types')->get();
                    
                    $shipmentData = DB::table('shipment')
                            ->where([ ['id', '=', $shipment_id] ])
                            ->first();
                    $shipmentComp = DB::table('companies')
                            ->where([ ['id', '=', $shipmentData->companies_id] ])
                            ->first();
                    
                    $shipmentpick = DB::table('shipment_lanes_picks')->where([
                                ['shipment_id', '=', $shipment_id],['manage_order', '=', 1]
                            ])->first();
                    $shipment_picks = DB::table('shipment_lanes_picks')->where([
                                ['shipment_id', '=', $shipment_id] ])->get();
                    $total_picks = count($shipment_picks);
                    $shipmentdrop = DB::table('shipment_lanes_drops')->where([
                                ['shipment_id', '=', $shipment_id],['manage_order', '=', 1]
                            ])->first();
                    $shipment_drops = DB::table('shipment_lanes_drops')->where([
                                ['shipment_id', '=', $shipment_id] ])->get();
                    $total_drops = count($shipment_drops);
                    $shipment_rates = DB::table('shipment_c_s_rates')->where([
                                ['shipment_id', '=', $shipment_id] ])->first();
                    $shipment_doc = DB::table('shipment_doc')->where([
                                ['shipment_id', '=', $shipment_id] ])->get();
                $active = 'all_shipment';			  
                return view('backend.shipmentManagement.shipment.viewinfoshipment',['active'=>$active,'user'=>$user,'Equipments'=>$Equipments,'shipmentData'=>$shipmentData,'shipmentComp'=>$shipmentComp,'shipmentpick'=>$shipmentpick,'shipmentdrop'=>$shipmentdrop,'shipment_rates'=>$shipment_rates,'shipment_doc'=>$shipment_doc,'total_picks'=>$total_picks,'total_drops'=>$total_drops, 'shipment_id'=>$shipment_id]);
            }
        /* Broker shipment view Function End Here */	
        
        public function list(Request $request){
                if (is_null($this->user) || !$this->user->can('shipment-all')) {
                    abort(403, 'Sorry !! You are Unauthorized to view any admin !');
                }
                $user_id = auth()->user()->id ;   
                $user = DB::table('users')->where([
                            ['id', '=', $user_id],
                        ])->first();
                
                $GetUser =  User::where('user_type', 'agent')->orwhere('user_type', 'officer')->get();
                $Equipments = DB::table('equipment_types')->get();
                $shipment =  Shipment::get();
                $total =  Shipment::count();
                $shipment_open =  Shipment::where('shipment_statue', '=', 'Open')->count();
                $shipment_covered =  Shipment::where('shipment_statue', '=', 'Covered')->count();
                $shipment_transit =  Shipment::where('shipment_statue', '=', 'In-transit')->count();
                $shipment_delivered =  Shipment::where('shipment_statue', '=', 'Delivered')->count();
                $shipment_paid =  Shipment::where('shipment_statue', '=', 'Paid')->count();
                $shipment_invoice =  Shipment::where('shipment_statue', '=', 'Invoiced')->count();
                $shipment1 = DB::table('shipment')
                            ->leftjoin('companies', 'companies.id', '=', 'shipment.companies_id')
                            ->leftjoin('carriers', 'carriers.id', '=', 'shipment.carrier_id')
                            ->where([ ['shipment.user_id', '=', $user_id] ])
                            ->select('shipment.id','companies.company_name','carriers.c_company_name','shipment.shipment_statue')
                            ->orderBy('shipment.id','DESC')->get();
                $active = 'all_shipment';
            return view('backend.shipmentManagement.shipment.list', compact('GetUser','shipment','shipment_open','shipment_covered','shipment_delivered','shipment_paid','shipment_invoice','shipment_transit','total'));
        }
        /*request list  */
        public function reqlist(Request $request){
            if (is_null($this->user) || !$this->user->can('shipments-approver')) {
                abort(403, 'Sorry !! You are Unauthorized to view any admin !');
            }
            $user_id = auth()->user()->id ;   
            $user = DB::table('users')->where([
                        ['id', '=', $user_id],
                    ])->first();
            
            $GetUser =  User::where('user_type', 'agent')->orwhere('user_type', 'officer')->get();
            $Equipments = DB::table('equipment_types')->get();
            $shipment =  Shipment::get();
            $total =  Shipment::count();
            $shipment_open =  Shipment::where('shipment_statue', '=', 'Open')->count();
            $shipment_covered =  Shipment::where('shipment_statue', '=', 'Covered')->count();
            $shipment_transit =  Shipment::where('shipment_statue', '=', 'In-transit')->count();
            $shipment_delivered =  Shipment::where('shipment_statue', '=', 'Delivered')->count();
            $shipment_paid =  Shipment::where('shipment_statue', '=', 'Paid')->count();
            $shipment_invoice =  Shipment::where('shipment_statue', '=', 'Invoiced')->count();
            $shipment1 = DB::table('shipment')
                        ->leftjoin('companies', 'companies.id', '=', 'shipment.companies_id')
                        ->leftjoin('carriers', 'carriers.id', '=', 'shipment.carrier_id')
                        ->where([ ['shipment.user_id', '=', $user_id] ])
                        ->select('shipment.id','companies.company_name','carriers.c_company_name','shipment.shipment_statue')
                        ->orderBy('shipment.id','DESC')->get();
            $active = 'all_shipment';
        return view('backend.shipmentManagement.shipment.reqlist', compact('GetUser','shipment','shipment_open','shipment_covered','shipment_delivered','shipment_paid','shipment_invoice','shipment_transit','total'));
        }
        
        // request list status 
        //disapprove shipment request list
        public function shipreqlist(Request $request){
            if (is_null($this->user) || !$this->user->can('all-shipments-approver')) {
                abort(403, 'Sorry !! You are Unauthorized to view any admin !');
            }
            $user_id = auth()->user()->id ;   
            $user = DB::table('users')->where([
                        ['id', '=', $user_id],
                    ])->first();
            
            $GetUser =  User::where('user_type', 'agent')->orwhere('user_type', 'officer')->get();
            $Equipments = DB::table('equipment_types')->get();
            $shipment =  Shipment::get();
            $total =  Shipment::count();
            $shipment_open =  Shipment::where('shipment_statue', '=', 'Open')->count();
            $shipment_covered =  Shipment::where('shipment_statue', '=', 'Covered')->count();
            $shipment_transit =  Shipment::where('shipment_statue', '=', 'In-transit')->count();
            $shipment_delivered =  Shipment::where('shipment_statue', '=', 'Delivered')->count();
            $shipment_paid =  Shipment::where('shipment_statue', '=', 'Paid')->count();
            $shipment_invoice =  Shipment::where('shipment_statue', '=', 'Invoiced')->count();
            $shipment1 = DB::table('shipment')
                        ->leftjoin('companies', 'companies.id', '=', 'shipment.companies_id')
                        ->leftjoin('carriers', 'carriers.id', '=', 'shipment.carrier_id')
                        ->where([ ['shipment.user_id', '=', $user_id] ])
                        ->select('shipment.id','companies.company_name','carriers.c_company_name','shipment.shipment_statue')
                        ->orderBy('shipment.id','DESC')->get();
            $active = 'all_shipment';
        return view('backend.shipmentManagement.shipment.shipreqlist', compact('GetUser','shipment','shipment_open','shipment_covered','shipment_delivered','shipment_paid','shipment_invoice','shipment_transit','total'));
        }
        
        public function changeshipmentreqStatus(Request $request){
            $response = [];
            if($request->isMethod('post')){
                $data = $request->all();
                
                $statusid = $data['cat'];
               // $statusid = $data['cat'];
               
                if($data['curr'] == 'true'){
                    $status = '1';
                } else{
                    $status = '0';
                }
                
                //$upd = Shipment::where('id',$statusid)->update(['ap_access_status'=>$status,'ap_access_date'=>date('Y-m-d')]);
                $shipmentget = Shipment::where('id',$statusid)->first();
                // $shipmentget->ap_access_date = date('Y-m-d');
                $shipmentget->shipment_approved = $status;
                $shipmentget->save();
    
                if($shipmentget){
                    $response['status'] = 'true';
                    $response['msg']    = 'Status updated successfully';
                } else{
                    $response['status'] = 'false';
                    $response['msg']    = 'COMMON_ERROR';
                }
            }
            return $response;
        }
    
        //shipment filter
        public function shipmentFilter(Request $request){
            $user_id = auth()->user()->id ;   
			$user = DB::table('users')->where([
                        ['id', '=', $user_id],
                    ])->first();
            $GetUser =  User::where('user_type', 'agent')->orwhere('user_type', 'officer')->get();
            $Equipments = DB::table('equipment_types')->get();
            $shipment =  Shipment::where($request->filter_type, $request->filter_value)->get();
            $shipment1 = DB::table('shipment')
						->leftjoin('companies', 'companies.id', '=', 'shipment.companies_id')
						->leftjoin('carriers', 'carriers.id', '=', 'shipment.carrier_id')
						->where([ ['shipment.user_id', '=', $user_id] ])
						->select('shipment.id','companies.company_name','carriers.c_company_name','shipment.shipment_statue')
						->orderBy('shipment.id','DESC')->get();
            $active = 'all_shipment';
            return view('backend.shipmentManagement.shipment.status-filter', compact('GetUser','shipment'));
        }
        /* shipment create Function Start Here */
        public function createshipment(Request $request){            
            if (is_null($this->user) || !$this->user->can('shipment-create')) {
                abort(403, 'Sorry !! You are Unauthorized to edit any user !');
            }
            $user_id = auth()->user()->id ;
            $user = User::where('id',$user_id)->first();
			$companies_data = DB::table('companies')->where([
                        ['user_id', '=', $user_id],['approved', '=', '1']
                    ])->orderBy('id','DESC')->get();
            $Equipments = EquipmentType::get();
            
            //$Equipments = DB::table('equipment_types')->get();
            $active = 'create_shipment';		
            return view('backend.shipmentManagement.shipment.createshipment',['active'=>$active,'user'=>$user,'companies_data'=>$companies_data,'Equipments'=>$Equipments]);                
        }		
        /* shipment create Function End Here */ 
        /* shipment create submit Function Start Here */
        public function createshipmentsubmit(Request $request){  
            if (is_null($this->user) || !$this->user->can('shipment-create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
            }
                $user_id = auth()->user()->id ;
				$user = DB::table('users')->where([
                            ['id', '=', $user_id],
                        ])->first();	
                $shipment = new Shipment;
                $shipment->user_id = $user_id;
                $shipment->loads_id = 0;
                $shipment->carrier_id = $request->input('carriers_id');
                $shipment->new_loads_id = $request->input('new_loads_id');
                $shipment->companies_id = $request->input('companies_id');
                $shipment->shipment_statue = 'Open';
                $shipment->ref_loads = $request->input('ref_no');
                $shipment->payment_mode = $request->input('payment_mode');
                $shipment->equipment_loads = $request->input('equipment_type');
                $shipment->full_partial = $request->input('full_partial');
                $shipment->commodity_laod = $request->input('commodity_laod');
                $shipment->mode = $request->input('mode');
                $shipment->footage_loads = $request->input('footage_loads');
                $shipment->weight_loads = $request->input('weight_loads');
                $shipment->declared_loads = $request->input('declared_loads');
                $shipment->temp_min = $request->input('temp_min');
                $shipment->temp_max = $request->input('temp_max');
                $shipment->temp_precool = $request->input('temp_precool');
                $shipment->customer_name = $request->input('shippername');
                $shipment->customer_address = $request->input('shipperaddress');
                $shipment->customer_city = $request->input('shippercity');
                $shipment->customer_state = $request->input('shipperstate');
                $shipment->customer_zip = $request->input('shipperzip');
                $shipment->customer_phone = $request->input('shipperphone');
                $shipment->customer_c_name = $request->input('customer_c_name');
                $shipment->b_customer_name = $request->input('billname');
                $shipment->b_customer_address = $request->input('billaddress');
                $shipment->b_customer_city = $request->input('billcity');
                $shipment->b_customer_state = $request->input('billstate');
                $shipment->b_customer_zip = $request->input('billzip');
                $shipment->b_customer_phone = $request->input('billphone');
                $shipment->b_customer_c_name = $request->input('b_customer_c_name');
                $shipment->shipment_c_mc = $request->input('carrier_mc');
                $shipment->shipment_c_dot = $request->input('carrier_dot');
                $shipment->shipment_c_carrier = $request->input('carrier_name');
                $shipment->shipment_c_dispatcher = $request->input('dispatched');
                $shipment->shipment_c_phone = $request->input('shipment_c_phone');
                $shipment->shipment_c_email = $request->input('shipment_c_email');
                $shipment->shipment_c_driver_n = $request->input('shipment_c_driver_n');
                $shipment->shipment_c_driver_p = $request->input('shipment_c_driver_p');
                $shipment->shipment_carrier_instruction = $request->input('carrier_instruction');
                $shipment->shipment_shipper_instruction = $request->input('shipper_instruction');
                $shipmentSave=$shipment->save();
                $insertedId = $shipment->id;

                $pickready=	$request->input('pickready');
                $pick_ready = date('Y-m-d', strtotime($pickready) );
                $Shipment_pick = new Shipmentpick;	
                $Shipment_pick->shipment_id = $insertedId;
                $Shipment_pick->user_id = $user_id;
                $Shipment_pick->p_name = $request->input('pickname');
                $Shipment_pick->p_address = $request->input('pickaddress');
                $Shipment_pick->p_city = $request->input('pickcity');
                $Shipment_pick->p_state = $request->input('pickstate');
                $Shipment_pick->p_zip = $request->input('pickzip');
                $Shipment_pick->p_ref = $request->input('p_ref');
                $Shipment_pick->p_contact = $request->input('p_contact');
                $Shipment_pick->p_phone = $request->input('pickphone');
                $Shipment_pick->p_ready = $pickready;
                $Shipment_pick->p_rtime = $request->input('picktime');
                $Shipment_pick->p_appt = $request->input('pickappt');
                $Shipment_pick->p_atime = $request->input('p_atime');
                $Shipment_pick->p_appt_note = $request->input('p_appt_note');
                $Shipment_pick->manage_order = 1;
                $Shipment_pickSave=$Shipment_pick->save();
                $Shipment_pickId = $Shipment_pick->id; 
                
                $dropready=	$request->input('dropready');
                //$drop_ready = date('Y-m-d', strtotime($dropready) );
                $Shipment_drop = new Shipmentdrop;	
                $Shipment_drop->shipment_id = $insertedId;
                $Shipment_drop->user_id = $user_id;
                $Shipment_drop->d_name = $request->input('dropname');
                $Shipment_drop->d_address = $request->input('dropaddress');
                $Shipment_drop->d_city = $request->input('dropcity');
                $Shipment_drop->d_state = $request->input('dropstate');
                $Shipment_drop->d_zip = $request->input('dropzip');
                $Shipment_drop->d_ref = $request->input('d_ref');
                $Shipment_drop->d_contact = $request->input('d_contact');
                $Shipment_drop->d_phone = $request->input('dropphone');
                $Shipment_drop->d_email = $request->input('dropemail');
                $Shipment_drop->d_ready = $dropready;
                $Shipment_drop->d_rtime = $request->input('droptime');
                $Shipment_drop->d_appt = $request->input('dropappt');
                $Shipment_drop->d_atime = $request->input('d_appt_time');
                $Shipment_drop->d_appt_note = $request->input('d_appt_note');
				$Shipment_drop->manage_order = 1;
                $Shipment_dropSave = $Shipment_drop->save();
                $Shipment_dropId = $Shipment_drop->id;
                    $carrier_total = ($request->input('rate_unit1_carrier')) + ($request->input('rate_unit2_carrier')) + ($request->input('lh_carrier')) + ($request->input('carrier1')) + ($request->input('carrier2')) + ($request->input('carrier3')) + ($request->input('carrier4')) + ($request->input('carrier5')) + ($request->input('carrier6')) + ($request->input('carrier7')) + ($request->input('carrier8'));
                    $customer_total =($request->input('unit1_customer')) +  ($request->input('unit2_customer')) + ($request->input('lh_customer')) + ($request->input('customer1')) + ($request->input('customer2')) + ($request->input('customer3')) + ($request->input('customer4')) + ($request->input('customer5')) + ($request->input('customer6')) + ($request->input('customer7')) + ($request->input('customer8'));
                $shipment_rate = new Shipmentrate;
                $shipment_rate->shipment_id = $insertedId;
                $shipment_rate->user_id = $user_id;
                $shipment_rate->customer_rate_dropdown = $request->input('customer_rate_dropdown');
                $shipment_rate->carrier_rate_dropdown = $request->input('carrier_rate_dropdown');
                $shipment_rate->unit1_customer = $request->input('unit1_customer');
                $shipment_rate->unit2_customer = $request->input('unit2_customer');
                $shipment_rate->lh_customer = $request->input('lh_customer');
                $shipment_rate->rate_unit1_carrier = $request->input('rate_unit1_carrier');
                $shipment_rate->rate_unit2_carrier = $request->input('rate_unit2_carrier');
                $shipment_rate->lh_carrier = $request->input('lh_carrier');
                $shipment_rate->carrier_rate_haul = $request->input('carrier_rate_haul');
                $shipment_rate->customer_rate_haul = $request->input('customer_rate_haul');
                $shipment_rate->transportation1 = $request->input('transportation1');
                $shipment_rate->line_haul1 = $request->input('line_haul1');
                $shipment_rate->carrier1 = $request->input('carrier1');
                $shipment_rate->customer1 = $request->input('customer1');
                $shipment_rate->transportation2 = $request->input('transportation2');
                $shipment_rate->line_haul2 = $request->input('line_haul2');
                $shipment_rate->carrier2 = $request->input('carrier2');
                $shipment_rate->customer2 = $request->input('customer2');
                $shipment_rate->transportation3 = $request->input('transportation3');
                $shipment_rate->line_haul3 = $request->input('line_haul3');
                $shipment_rate->carrier3 = $request->input('carrier3');
                $shipment_rate->customer3 = $request->input('customer3');
                $shipment_rate->transportation4 = $request->input('transportation4');
                $shipment_rate->line_haul4 = $request->input('line_haul4');
                $shipment_rate->carrier4 = $request->input('carrier4');
                $shipment_rate->customer4 = $request->input('customer4');
                $shipment_rate->transportation5 = $request->input('transportation5');
                $shipment_rate->line_haul5 = $request->input('line_haul5');
                $shipment_rate->carrier5 = $request->input('carrier5');
                $shipment_rate->customer5 = $request->input('customer5');
                $shipment_rate->carrier6 = $request->input('carrier6');
                $shipment_rate->customer6 = $request->input('customer6');
                $shipment_rate->carrier7 = $request->input('carrier7');
                $shipment_rate->customer7 = $request->input('customer7');
                $shipment_rate->carrier8 = $request->input('carrier8');
                $shipment_rate->customer8 = $request->input('customer8');
                $shipment_rate->carrier_total = $carrier_total;
                $shipment_rate->customer_total = $customer_total;
                $shipment_rateSave = $shipment_rate->save();
                $shipment_rateId = $shipment_rate->id;


                $cmpid = Shipment::where('id', $insertedId)->pluck('companies_id')->first();
                $exd = Company::where('id', $cmpid)->pluck('credit_limit')->first();
                $exdidnum = Company::where('id', $cmpid)->pluck('id')->first();
                $customer_total = Shipmentrate::where('shipment_id', $insertedId)->pluck('customer_total')->first();
                $grand_total = $exd - $customer_total ;
                $updatedCustomerLimit = DB::update('update companies set credit_limit =? where id = ?',[$grand_total, $exdidnum]);

                // print_r($updatedCustomerLimit);
                // dd($updatedCustomerLimit);

                $ac_payable	= new AccountsPayable;
				$ac_payable->shipment_id	= $insertedId;
				$ac_payable->carrier_id	    = $request->input('carriers_id');
				$ac_payable->user_id	    = $user_id;
				// $ac_payable->age_day	    = date('Y-m-d');
				$ac_payable->ap_date	    = date('Y-m-d');
				$ac_payable->user_id	    = $user_id;                
				$ac_payable->status	        = '0';
				$ac_payable->save();
                $ac_receivable	= new AccountReceivable;
				$ac_receivable->shipment_id	= $insertedId;
                $ac_receivable->companies_id	= $request->input('companies_id');
				$ac_receivable->user_id	        = $user_id;
				$ac_receivable->ar_date	        = date('Y-m-d');
				$ac_receivable->status	        = '0';
				$ac_receivable->save();
                    //bol shipment data enter here 
                    // foreach($request->ofpieces as $key=>$val){
                    //     ShipmentBol::create([
                    //         'shipment_id' => $insertedId,
                    //         'user_id' => $user_id,
                    //         'ofpieces' => $request->ofpieces[$key],
                    //         'descriptions' => $request->descriptions[$key],
                    //         'weight' => $request->weight[$key],
                    //         'type' => $request->type[$key],
                    //         'nmfc' => $request->nmfc[$key],
                    //         'hazmat' => $request->hazmat[$key],
                    //         'productclass' => $request->productclass[$key],
                    //         'notes' => $request->notes[$key]
                    //     ]);
                    // }
                    
                    if($ac_receivable->save()){
                        $usname = auth()->user()->name ;
                        $usid = auth()->user()->id ;
                        $notif = new Notification;
                        $notif->user_id	    = $usid;
                        $notif->title	    = "Create New Shipment";
                        $notif->body	    = ucfirst($usname).', Load: '.$insertedId;
                        $notif->assignto_id	= '1';
                        $notif->status	    = '0';
                        $notif->status	    = 'admin/shipment';
                        $notif->save();
                        return redirect('/admin/shipment')->with('success','Shipment Create successfully');
                    } else {
                        return redirect('/admin/shipment')->with('errors',COMMON_ERROR);
                    }
			return redirect('/admin/shipment')->with('success','Shipment Create successfully');
		}
        /* shipment create submit Function End Here */
            
        /* shipment edit Function Start Here */
        public function shipment_edit($shipment_edit){
                if (is_null($this->user) || !$this->user->can('shipment-edit')) {
                 abort(403, 'Sorry !! You are Unauthorized to view any admin !');
                }
                    $shipment_id = base64_decode($shipment_edit);
                    $user_id = auth()->user()->id ;
                    $user = DB::table('users')->where([
                                ['id', '=', $user_id],
                            ])->first();	
                    $Equipments = DB::table('equipment_types')->get();
                    
                    $shipmentData = DB::table('shipment')
                            ->where([ ['id', '=', $shipment_id] ])
                            ->first();
                    $shipmentComp = DB::table('companies')
                            ->where([ ['id', '=', $shipmentData->companies_id] ])
                            ->first();
                    
                    $shipmentpick = DB::table('shipment_lanes_picks')->where([
                                ['shipment_id', '=', $shipment_id],['manage_order', '=', 1]
                            ])->first();
                    $shipment_picks = DB::table('shipment_lanes_picks')->where([
                                ['shipment_id', '=', $shipment_id] ])->get();
                    $total_picks = count($shipment_picks);
                    $shipmentdrop = DB::table('shipment_lanes_drops')->where([
                                ['shipment_id', '=', $shipment_id],['manage_order', '=', 1]
                            ])->first();
                    $shipment_drops = DB::table('shipment_lanes_drops')->where([
                                ['shipment_id', '=', $shipment_id] ])->get();
                    $total_drops = count($shipment_drops);
                    $shipment_rates = DB::table('shipment_c_s_rates')->where([
                                ['shipment_id', '=', $shipment_id] ])->first();
                    $shipment_doc = DB::table('shipment_doc')->where([
                                ['shipment_id', '=', $shipment_id] ])->get();
                $active = 'all_shipment';			  
                return view('backend.shipmentManagement.shipment.editshipment',['active'=>$active,'user'=>$user,'Equipments'=>$Equipments,'shipmentData'=>$shipmentData,'shipmentComp'=>$shipmentComp,'shipmentpick'=>$shipmentpick,'shipmentdrop'=>$shipmentdrop,'shipment_rates'=>$shipment_rates,'shipment_doc'=>$shipment_doc,'total_picks'=>$total_picks,'total_drops'=>$total_drops, 'shipment_id'=>$shipment_id]);
            }
        /* Broker shipment edit Function End Here */	
        //view shipment
        public function viewShipment($shipment_edit){
            $shipment_id = base64_decode($shipment_edit);
                $user_id = auth()->user()->id ;
                $user = DB::table('users')->where([
                            ['id', '=', $user_id],
                        ])->first();	
                $Equipments = DB::table('equipment_types')->get();
                $shipmentData = DB::table('shipment')
						->where([ ['id', '=', $shipment_id] ])
						->first();
				$shipmentComp = DB::table('companies')
						->where([ ['id', '=', $shipmentData->companies_id] ])
						->first();
                $shipmentpick = DB::table('shipment_lanes_picks')->where([
                            ['shipment_id', '=', $shipment_id],['manage_order', '=', 1]
                        ])->first();
                $shipment_picks = DB::table('shipment_lanes_picks')->where([
                            ['shipment_id', '=', $shipment_id] ])->get();
                
                $total_picks = count($shipment_picks);
                $shipmentdrop = DB::table('shipment_lanes_drops')->where([
                            ['shipment_id', '=', $shipment_id],['manage_order', '=', 1]
                        ])->first();
                        
                $shipment_drops = DB::table('shipment_lanes_drops')->where([
                            ['shipment_id', '=', $shipment_id] ])->get();
                $total_drops = count($shipment_drops);
                $shipment_rates = DB::table('shipment_c_s_rates')->where([
                            ['shipment_id', '=', $shipment_id] ])->first();
                $shipment_doc = DB::table('shipment_doc')->where([
                            ['shipment_id', '=', $shipment_id] ])->get();
            $active = 'all_shipment';			  
            return view('backend.shipmentManagement.shipment.viewshipment',['active'=>$active,'user'=>$user,'Equipments'=>$Equipments,'shipmentData'=>$shipmentData,'shipmentComp'=>$shipmentComp,'shipmentpick'=>$shipmentpick,'shipmentdrop'=>$shipmentdrop,'shipment_rates'=>$shipment_rates,'shipment_doc'=>$shipment_doc,'total_picks'=>$total_picks,'total_drops'=>$total_drops]);
        }
        
        //end view shippment
        /* Broker shipment update Function Start Here */
            public function shipmentupdate(Request $request){

                //dd($request->all());
                if (is_null($this->user) || !$this->user->can('shipment-edit')) {
                    abort(403, 'Sorry !! You are Unauthorized to view any admin !');
                }
				$user_id = auth()->user()->id ;                
                $shipment_id = $request->input('shipment_id');
                $data = $request->all();
                // $shipmentData = ShipmentBol::where('id',$shipment_id)->first();
                $shipmentData = Shipment::where('id',$shipment_id)->first();
                if(($shipmentData->ap_access_status !== '1') || ($shipmentData->ar_access_status !== '1')){
                $user = DB::table('users')->where([
                            ['id', '=', $shipmentData->user_id],
                        ])->first();
                //$user_id = $user->id;              
                $shipmentData['carrier_id']	        = $data['carrier_id'];
                $shipmentData['ref_loads']	        = $data['ref_no'];
                $shipmentData['equipment_loads']	= $data['equipment_type'];
                $shipmentData['full_partial']	    = $data['full_partial'];
                $shipmentData['commodity_laod']	    = $data['commodity_laod'];
                $shipmentData['pieces_laod']	    = $data['pieces_laod'];
                //$shipmentData['payment_mode']	    = $data['payment_mode'];
                $shipmentData['weight_loads']	    = $data['weight_loads'];
                $shipmentData['declared_loads']	    = $data['declared_loads'];
                $shipmentData['mode']	            = $data['mode'];
                $shipmentData['footage_loads']	    = $data['footage_loads'];
                $shipmentData['temp_min']	        = $data['temp_min'];
                $shipmentData['temp_max']	        = $data['temp_max'];
                $shipmentData['customer_name']	    = $data['shippername'];
                $shipmentData['customer_address']	= $data['shipperaddress'];
                $shipmentData['customer_city']	    = $data['shippercity'];
                $shipmentData['customer_state']	    = $data['shipperstate'];
                $shipmentData['customer_zip']	    = $data['shipperzip'];
                $shipmentData['customer_phone']	    = $data['shipperphone'];
                $shipmentData['customer_c_name']	= $data['customer_c_name'];
                $shipmentData['b_customer_name']	= $data['billname'];
                $shipmentData['b_customer_address']	= $data['billaddress'];
                $shipmentData['b_customer_city']	= $data['billcity'];
                $shipmentData['b_customer_state']	= $data['billstate'];
                $shipmentData['b_customer_zip']	    = $data['billzip'];
                $shipmentData['b_customer_phone']	= $data['billphone'];
                $shipmentData['b_customer_c_name']	= $data['b_customer_c_name'];
                $shipmentData['shipment_c_mc']	    = $data['carrier_mc'];
                $shipmentData['shipment_c_dot']	    = $data['carrier_dot'];
                $shipmentData['shipment_c_carrier']	            = $data['carrier_name'];
                $shipmentData['shipment_c_dispatcher']	        = $data['dispatched'];
                $shipmentData['shipment_c_phone']	            = $data['shipment_c_phone'];
                $shipmentData['shipment_c_email']	            = $data['shipment_c_email'];
                $shipmentData['shipment_c_driver_n']	        = $data['shipment_c_driver_n'];
                $shipmentData['shipment_c_driver_p']	        = $data['shipment_c_driver_p'];
                $shipmentData['shipment_carrier_instruction']	= $data['carrier_instruction'];
                $shipmentData['shipment_shipper_instruction']	= $data['shipper_instruction'];
			    $shipmentData->save();
                //dd($shipmentData);
                
                
                $pickready=	$data['pickready'];
                $pick_ready = DateTime::createFromFormat('Y-m-d', $pickready);
                $newDate = Carbon::createFromFormat('Y-d-m', $pickready)->format('Y-m-d');
                //dd($newDate);
                //$pick_ready = $data['pickready']; 
                $ShipmentPickUpdate = Shipmentpick::where('shipment_id',$shipment_id)->orderBy('manage_order','DESC')->first();
                $ShipmentPickUpdate['p_name']     = $data['pickname'];
                $ShipmentPickUpdate['p_address']  = $data['pickaddress'];
                $ShipmentPickUpdate['p_city']     = $data['pickcity'];
                $ShipmentPickUpdate['p_state']    = $data['pickstate'];
                $ShipmentPickUpdate['p_zip']      = $data['pickzip'];
                $ShipmentPickUpdate['p_ref']      = $data['p_ref'];
                $ShipmentPickUpdate['p_contact']  = $data['p_contact'];
                $ShipmentPickUpdate['p_phone']    = $data['pickphone'];
                $ShipmentPickUpdate['p_email']    = $data['pickemail'];
                $ShipmentPickUpdate['p_ready']    = $pickready;
                $ShipmentPickUpdate['p_rtime']    = $data['picktime'];
                $ShipmentPickUpdate['p_appt_note']    = $data['p_appt_note'];
                $ShipmentPickUpdate->save();
                
                $dropready=	$data['dropready'];
                $drop_ready = DateTime::createFromFormat('Y-m-d', $dropready);
                //dd($drop_ready);
                //$drop_ready = $data['dropready'];
                $ShipmentDropUpdate = Shipmentdrop::where('shipment_id',$shipment_id)->orderBy('manage_order','DESC')->first();
                $ShipmentDropUpdate['d_name']     = $data['dropname'];
                $ShipmentDropUpdate['d_address']  = $data['dropaddress'];
                $ShipmentDropUpdate['d_city']     = $data['dropcity'];
                $ShipmentDropUpdate['d_state']    = $data['dropstate'];
                $ShipmentDropUpdate['d_zip']      = $data['dropzip'];
                $ShipmentDropUpdate['d_ref']      = $data['d_ref'];
                $ShipmentDropUpdate['d_contact']  = $data['d_contact'];
                $ShipmentDropUpdate['d_phone']    = $data['dropphone'];
                $ShipmentDropUpdate['d_email']    = $data['dropemail'];
                $ShipmentDropUpdate['d_ready']    = $dropready;
                $ShipmentDropUpdate['d_rtime']    = $data['droptime'];
                $ShipmentDropUpdate['d_appt_note']    = $data['d_appt_note'];
                $ShipmentDropUpdate->save();
                
                
                
                $carrier_total = ($request->input('rate_unit1_carrier')) + ($request->input('rate_unit2_carrier')) + ($request->input('lh_carrier')) + ($request->input('carrier1')) + ($request->input('carrier2')) + ($request->input('carrier3')) + ($request->input('carrier4')) + ($request->input('carrier5')) + ($request->input('carrier6')) + ($request->input('carrier7')) + ($request->input('carrier8'));
                    
                        
                $customer_total = ($request->input('unit1_customer')) + ($request->input('unit2_customer')) + ($request->input('lh_customer')) + ($request->input('customer1')) + ($request->input('customer2')) + ($request->input('customer3')) + ($request->input('customer4')) + ($request->input('customer5')) + ($request->input('customer6')) + ($request->input('customer7')) + ($request->input('customer8'));
                // print_r($request->customer_total_data);
                $ctvalue59 = ltrim($request->customer_total, '$');
                $ctvalue = $customer_total;
                $strptr = ltrim($request->customer_total_data, '$');
                
                // dd($customer_total);

                if($customer_total !== $strptr){
                    $comp_id = $request->companies_id;
                    $c_limit_data = Company::where('id', $comp_id)->pluck('credit_limit')->first();
                    $cr_limit_total = $c_limit_data + $strptr;
                    $ex = DB::update('update companies set credit_limit =? where id = ?',[$cr_limit_total, $comp_id]);
                    $current_limit_amount = Company::where('id', $comp_id)->pluck('credit_limit')->first();
                    $real_time_limit_amount = $current_limit_amount -$customer_total ;
                    $g_total_limit_amount = DB::update('update companies set credit_limit =? where id = ?',[$real_time_limit_amount, $comp_id]);
                }
                
                    
                $ShipmentRate = Shipmentrate::where('shipment_id',$shipment_id)->first();
                $ShipmentRate['customer_rate_dropdown']     = $data['customer_rate_dropdown'];
                $ShipmentRate['carrier_rate_dropdown']      = $data['carrier_rate_dropdown'];
                $ShipmentRate['rate_unit1_carrier']         = $data['rate_unit1_carrier'];
                $ShipmentRate['rate_unit2_carrier']         = $data['rate_unit2_carrier'];
                $ShipmentRate['unit1_customer']         = $data['unit1_customer'];
                $ShipmentRate['unit2_customer']         = $data['unit2_customer'];
                
                $ShipmentRate['lh_customer']                = $data['lh_customer'];
                $ShipmentRate['lh_carrier']                 = $data['lh_carrier'];
                $ShipmentRate['transportation1']            = $data['transportation1'];
                $ShipmentRate['line_haul1']                 = $data['line_haul1'];
                $ShipmentRate['carrier1']                   = $data['carrier1'];
                $ShipmentRate['customer1']                  = $data['customer1'];
                $ShipmentRate['transportation2']            = $data['transportation2'];
                $ShipmentRate['line_haul2']                 = $data['line_haul2'];
                $ShipmentRate['carrier2']                   = $data['carrier2'];
                $ShipmentRate['customer2']                  = $data['customer2'];
                $ShipmentRate['transportation3']            = $data['transportation3'];
                $ShipmentRate['line_haul3']                 = $data['line_haul3'];
                $ShipmentRate['carrier3']                   = $data['carrier3'];
                $ShipmentRate['customer3']                  = $data['customer3'];
                $ShipmentRate['transportation4']            = $data['transportation4'];
                $ShipmentRate['line_haul4']                 = $data['line_haul4'];
                $ShipmentRate['carrier4']                   = $data['carrier4'];
                $ShipmentRate['customer4']                  = $data['customer4'];
                $ShipmentRate['transportation5']            = $data['transportation5'];
                $ShipmentRate['line_haul5']                 = $data['line_haul5'];
                $ShipmentRate['carrier5']                   = $data['carrier5'];
                $ShipmentRate['customer5']                  = $data['customer5'];
                $ShipmentRate['transportation6']            = $data['transportation6'];
                $ShipmentRate['line_haul6']                 = $data['line_haul6'];
                $ShipmentRate['carrier6']                   = $data['carrier6'];
                $ShipmentRate['customer6']                  = $data['customer6'];
                $ShipmentRate['transportation7']            = $data['transportation7'];
                $ShipmentRate['line_haul7']                 = $data['line_haul7'];
                $ShipmentRate['carrier7']                   = $data['carrier7'];
                $ShipmentRate['customer7']                  = $data['customer7'];
                $ShipmentRate['transportation8']            = $data['transportation8'];
                $ShipmentRate['line_haul8']                 = $data['line_haul8'];
                $ShipmentRate['carrier8']                   = $data['carrier8'];
                $ShipmentRate['customer8']                  = $data['customer8'];
                $ShipmentRate['quickpay_deduction']         = $data['quickpay_deduction'];
                $ShipmentRate['quickpay_amount']            = $data['quickpay_amount'];
                $ShipmentRate['carrier_total']              = $carrier_total;
                $ShipmentRate['customer_total']             = $customer_total;
                $ShipmentRate->save();
                 //shipment bol
                //  foreach($request->bol_id as $key=>$val){
                //     ShipmentBol::where('id', $val)->updateOrCreate([
                //         'shipment_id' => $shipment_id,
                //         'user_id' => $user_id,
                //         'ofpieces' => $request->ofpieces[$key],
                //         'descriptions' => $request->descriptions[$key],
                //         'weight' => $request->weight[$key],
                //         'type' => $request->type[$key],
                //         'nmfc' => $request->nmfc[$key],
                //         'hazmat' => $request->hazmat[$key],
                //         'productclass' => $request->productclass[$key],
                //         'notes' => $request->notes[$key]
                //     ]);
                    
                // }
                
                $shipment_id = $request->input('shipment_id');
                // foreach($request->ofpieces as $key=>$val){
                //     if($request->bol_id[$key]!=0){
                //         ShipmentBol::where('id', $request->bol_id[$key])->update([
                //             'shipment_id' => $shipment_id,
                //             'user_id' => $user_id,
                //             'ofpieces' => $request->ofpieces[$key],
                //             'descriptions' => $request->descriptions[$key],
                //             'weight' => $request->weight[$key],
                //             'type' => $request->type[$key],
                //             'nmfc' => $request->nmfc[$key],
                //             'hazmat' => $request->hazmat[$key],
                //             'productclass' => $request->productclass[$key],
                //             'notes' => $request->notes[$key]
                //         ]);
                //     }else{
                //         ShipmentBol::create([
                //             'shipment_id' => $shipment_id,
                //             'user_id' => $user_id,
                //             'ofpieces' => $request->ofpieces[$key],
                //             'descriptions' => $request->descriptions[$key],
                //             'weight' => $request->weight[$key],
                //             'type' => $request->type[$key],
                //             'nmfc' => $request->nmfc[$key],
                //             'hazmat' => $request->hazmat[$key],
                //             'productclass' => $request->productclass[$key],
                //             'notes' => $request->notes[$key]
                //         ]);
                //     }
                    
                // }
                
                        if($ShipmentRate->save()){
                            $loadactivity = new LoadActivity;    
                            $loadactivity['p_name']     = $data['pickname'];
                            $loadactivity['p_address']  = $data['pickaddress'];
                            $loadactivity['p_city']     = $data['pickcity'];
                            $loadactivity['p_state']    = $data['pickstate'];
                            $loadactivity['p_zip']      = $data['pickzip'];
                            $loadactivity['p_ref']      = $data['p_ref'];
                            $loadactivity['p_contact']  = $data['p_contact'];
                            $loadactivity['p_phone']    = $data['pickphone'];
                            $loadactivity['p_email']    = $data['pickemail'];
                            $loadactivity['p_ready']    = $pickready;
                            $loadactivity['p_rtime']    = $data['picktime'];
                            $loadactivity['p_appt_note']    = $data['p_appt_note'];
                            $loadactivity['d_name']     = $data['dropname'];
                            $loadactivity['d_address']  = $data['dropaddress'];
                            $loadactivity['d_city']     = $data['dropcity'];
                            $loadactivity['d_state']    = $data['dropstate'];
                            $loadactivity['d_zip']      = $data['dropzip'];
                            $loadactivity['d_ref']      = $data['d_ref'];
                            $loadactivity['d_contact']  = $data['d_contact'];
                            $loadactivity['d_phone']    = $data['dropphone'];
                            $loadactivity['d_email']    = $data['dropemail'];
                            $loadactivity['d_ready']    = $dropready;
                            $loadactivity['d_rtime']    = $data['droptime'];
                            $loadactivity['d_appt_note']    = $data['d_appt_note'];
                            //this button is runing
                            $loadactivity['carrier_rate_dropdown']      = $data['carrier_rate_dropdown'];
                            $loadactivity['rate_unit1_carrier']         = $data['rate_unit1_carrier'];
                            $loadactivity['rate_unit2_carrier']         = $data['rate_unit2_carrier'];
                            $loadactivity['lh_customer']                = $data['lh_customer'];
                            $loadactivity['lh_carrier']                 = $data['lh_carrier'];
                            $loadactivity['transportation1']            = $data['transportation1'];
                            $loadactivity['line_haul1']                 = $data['line_haul1'];
                            $loadactivity['carrier1']                   = $data['carrier1'];
                            $loadactivity['customer1']                  = $data['customer1'];
                            $loadactivity['transportation2']            = $data['transportation2'];
                            $loadactivity['line_haul2']                 = $data['line_haul2'];
                            $loadactivity['carrier2']                   = $data['carrier2'];
                            $loadactivity['customer2']                  = $data['customer2'];
                            $loadactivity['transportation3']            = $data['transportation3'];
                            $loadactivity['line_haul3']                 = $data['line_haul3'];
                            $loadactivity['carrier3']                   = $data['carrier3'];
                            $loadactivity['customer3']                  = $data['customer3'];
                            $loadactivity['transportation4']            = $data['transportation4'];
                            $loadactivity['line_haul4']                 = $data['line_haul4'];
                            $loadactivity['carrier4']                   = $data['carrier4'];
                            $loadactivity['customer4']                  = $data['customer4'];
                            $loadactivity['transportation5']            = $data['transportation5'];
                            $loadactivity['line_haul5']                 = $data['line_haul5'];
                            $loadactivity['carrier5']                   = $data['carrier5'];
                            $loadactivity['customer5']                  = $data['customer5'];
                            $loadactivity['transportation6']            = $data['transportation6'];
                            $loadactivity['line_haul6']                 = $data['line_haul6'];
                            $loadactivity['carrier6']                   = $data['carrier6'];
                            $loadactivity['customer6']                  = $data['customer6'];
                            // $loadactivity['transportation7']            = $data['transportation7'];
                            // $loadactivity['line_haul7']                 = $data['line_haul7'];
                            // $loadactivity['carrier7']                   = $data['carrier7'];
                            // $loadactivity['customer7']                  = $data['customer7'];
                            $loadactivity['quickpay_deduction']         = $data['quickpay_deduction'];
                            $loadactivity['quickpay_amount']            = $data['quickpay_amount'];
                            $loadactivity['carrier_total']              = $carrier_total;
                            $loadactivity['customer_total']             = $customer_total;
                            $loadactivity['user_id']                    = $user_id;
                            $loadactivity['shipment_id_load']           = $shipment_id;
                            $loadactivity->save();
                            // if($ShipmentRate->save()){
                            //     $loadactivity = new LoadActivity;    
                            // }
                            if($loadactivity->save()){
                            //  $loadactivity = DB::table('load_activi_data'); 
                            $dataloadactivity = new LoadActivityInfo;    
                            $dataloadactivity['carrier_id']	        = $data['carrier_id'];
                            $dataloadactivity['ref_loads']	        = $data['ref_no'];
                            $dataloadactivity['equipment_loads']	= $data['equipment_type'];
                            $dataloadactivity['full_partial']	    = $data['full_partial'];
                            $dataloadactivity['commodity_laod']	    = $data['commodity_laod'];
                            $dataloadactivity['pieces_laod']	    = $data['pieces_laod'];
                            //$dataloadactivity['payment_mode']	    = $data['payment_mode'];
                            $dataloadactivity['weight_loads']	    = $data['weight_loads'];
                            $dataloadactivity['declared_loads']	    = $data['declared_loads'];
                            $dataloadactivity['mode']	            = $data['mode'];
                            $dataloadactivity['footage_loads']	    = $data['footage_loads'];
                            $dataloadactivity['temp_min']	        = $data['temp_min'];
                            $dataloadactivity['temp_max']	        = $data['temp_max'];
                            $dataloadactivity['customer_name']	    = $data['shippername'];
                            $dataloadactivity['customer_address']	= $data['shipperaddress'];
                            $dataloadactivity['customer_city']	    = $data['shippercity'];
                            $dataloadactivity['customer_state']	    = $data['shipperstate'];
                            $dataloadactivity['customer_zip']	    = $data['shipperzip'];
                            $dataloadactivity['customer_phone']	    = $data['shipperphone'];
                            $dataloadactivity['customer_c_name']	= $data['customer_c_name'];
                            $dataloadactivity['b_customer_name']	= $data['billname'];
                            $dataloadactivity['b_customer_address']	= $data['billaddress'];
                            $dataloadactivity['b_customer_city']	= $data['billcity'];
                            $dataloadactivity['b_customer_state']	= $data['billstate'];
                            $dataloadactivity['b_customer_zip']	    = $data['billzip'];
                            $dataloadactivity['b_customer_phone']	= $data['billphone'];
                            $dataloadactivity['b_customer_c_name']	= $data['b_customer_c_name'];
                            $dataloadactivity['shipment_c_mc']	    = $data['carrier_mc'];
                            $dataloadactivity['shipment_c_dot']	    = $data['carrier_dot'];
                            $dataloadactivity['shipment_c_carrier']	            = $data['carrier_name'];
                            $dataloadactivity['shipment_c_dispatcher']	        = $data['dispatched'];
                            $dataloadactivity['shipment_c_phone']	            = $data['shipment_c_phone'];
                            $dataloadactivity['shipment_c_email']	            = $data['shipment_c_email'];
                            $dataloadactivity['shipment_c_driver_n']	        = $data['shipment_c_driver_n'];
                            $dataloadactivity['shipment_c_driver_p']	        = $data['shipment_c_driver_p'];
                            $dataloadactivity['shipment_carrier_instruction']	= $data['carrier_instruction'];
                            $dataloadactivity['shipment_shipper_instruction']	= $data['shipper_instruction'];
                            $dataloadactivity['load_activity_id']	            = $loadactivity->id;
                            
                             $dataloadactivity->save();
                            }
                            
                        }
                
                        //print_r($_FILE);die;
                
                    if ($request->hasfile('shipper_files')) {
                        foreach ($request->file('shipper_files') as $file) {
                            $name = time().$file->getClientOriginalName();
                            $path = $file->move(public_path() . '/shipment_doc/', $name);
                            
                            
                            $shipment_doc = new shipmentDoc;	
                
                            $shipment_doc->shipment_id = $shipment_id;
                            $shipment_doc->user_id = $user_id;
                            $shipment_doc->document_name = $name;
                            $shipment_doc->type = 'shipper_doc';
                            $shipment_docSave = $shipment_doc->save();
                            $shipment_docId = $shipment_doc->id;
                            
                        }
                    }
                    
                    if ($request->hasfile('pod_files')) {
                        foreach ($request->file('pod_files') as $file) {
                            $name = time().$file->getClientOriginalName();
                            $path = $file->move(public_path() . '/shipment_doc/', $name);
                            
                            
                            $shipment_doc = new shipmentDoc;	
                
                            $shipment_doc->shipment_id = $shipment_id;
                            $shipment_doc->user_id = $user_id;
                            $shipment_doc->document_name = $name;
                            $shipment_doc->type = 'pod';
                            $shipment_docSave = $shipment_doc->save();
                            $shipment_docId = $shipment_doc->id;
                            
                            
                        }
                    }
                    if ($request->hasfile('lumper_files')) {
                        foreach ($request->file('lumper_files') as $file) {
                            $name = time().$file->getClientOriginalName();
                            $path = $file->move(public_path() . '/shipment_doc/', $name);
                            
                            
                            $shipment_doc = new shipmentDoc;	
                
                            $shipment_doc->shipment_id = $shipment_id;
                            $shipment_doc->user_id = $user_id;
                            $shipment_doc->document_name = $name;
                            $shipment_doc->type = 'lumper';
                            $shipment_docSave = $shipment_doc->save();
                            $shipment_docId = $shipment_doc->id;
                            
                        }
                    }
                    if ($request->hasfile('gate_fees')) {
                        foreach ($request->file('gate_fees') as $file) {
                            $name = time().$file->getClientOriginalName();
                            $path = $file->move(public_path() . '/shipment_doc/', $name);
                            
                            
                            $shipment_doc = new shipmentDoc;	
                
                            $shipment_doc->shipment_id = $shipment_id;
                            $shipment_doc->user_id = $user_id;
                            $shipment_doc->document_name = $name;
                            $shipment_doc->type = 'gate_fees';
                            $shipment_docSave = $shipment_doc->save();
                            $shipment_docId = $shipment_doc->id;
                            
                        }
                    }
                    if ($request->hasfile('rate_con')) {
                        foreach ($request->file('rate_con') as $file) {
                            $name = time().$file->getClientOriginalName();
                            $path = $file->move(public_path() . '/shipment_doc/', $name);
                            
                            
                            $shipment_doc = new shipmentDoc;	
                
                            $shipment_doc->shipment_id = $shipment_id;
                            $shipment_doc->user_id = $user_id;
                            $shipment_doc->document_name = $name;
                            $shipment_doc->type = 'rate_con';
                            $shipment_docSave = $shipment_doc->save();
                            $shipment_docId = $shipment_doc->id;
                            
                        }
                    }
                        
                    
                $shipment_doc = DB::table('shipment_doc')->where([ ['shipment_id', '=', $shipment_id],['type', '=', 'pod']]) ->first();
                //$CarriersAging = DB::table('carriers_aging')->where([ ['shipment_id', '=', $shipment_id] ]) ->first();
                
                if($shipment_doc){
                    
                    $Shipment_Status = DB::update('update shipment set shipment_statue =?,payment_status_ap =? where id = ?',['Delivered','0',$shipment_id]);
                    
                }
                
                
                $request->session()->flash('UpdateShipment', 'Shipment Update successfully');
                return redirect('admin/shipment/shipment-edit/'.(base64_encode($shipment_id)));
                
              }else{
                return redirect('/admin/shipment/shipment-edit/'.(base64_encode($shipment_id)))->with('errors','You have no permission to change,after delivered!');
              }
            }
        /* Broker shipment update Function Start Here */
      /* Broker shipment mc details get Function Start Here */
        public function GetShipperDataShipment(Request $request)
        {		 
                
                $user_id = auth()->user()->id ;
                $shipper_id = $request->input('shipper_name');
                $query = DB::table('companies'); 
                $ShipperData = DB::table('companies')->where([ ['id', '=', $shipper_id ],['user_id', '=', $user_id ],['approved', '=', '1' ] ])->first();
                
                return $ShipperData;
        }
        /* Broker shipment mc details get Function End Here */
	/* Broker shipment mc detail get Function Start Here */
        public function shipment_mc_get(Request $request)
        {		 
                $user_id = auth()->user()->id ;
				$shipment_mc = $request->input('shipment_mc');		
				$carriersData = DB::table('carriers')
                                ->where([ ['mc_no', '=', $shipment_mc], ['carrier_disputed', '=', '0'] ])
                                ->first();
                                
			return Response::json($carriersData);	
		}
	/* Broker shipment mc detail get Function End Here */
		
            
        /* Broker carrier rate pdf Function Start Here */
        public function carrier_rate_pdf($shipmentid){
            $timezone=date_create("",timezone_open("America/New_York"));
            $todaydate = date_format($timezone,"m-d-Y");
            $shipment_id = ($shipmentid);
            $user_id = Auth::id();
                $shipmentData = Shipment::where('id', $shipment_id)->first();
                $carriersData = DB::table('carriers')
								->leftjoin('shipment', 'shipment.carrier_id', '=', 'carriers.id')
                                ->where([['carriers.id', '=', $shipmentData->carrier_id],])
                                ->first();
                $user = User::where('id',$shipmentData->user_id)->first();
                $shipmentpick = Shipmentpick::where('shipment_id',$shipment_id)->orderBy('manage_order','DESC')->get();
                $shipmentdrop = Shipmentdrop::where('shipment_id', $shipment_id)->orderBy('manage_order','DESC')->get();	
                $shipmentrate = Shipmentrate::where('shipment_id', $shipment_id)->first();						
            $customPaper = array(0,0,650,1040);
            $shipment_id = base64_encode($shipmentid);
            // dd($shipment_id);
            $pdf = PDF::loadView('backend.shipmentManagement.shipment.rate-load-pdf', ['user'=>$user,'todaydate'=>$todaydate,'shipmentData'=>$shipmentData,'carriersData'=>$carriersData,'shipmentpick'=>$shipmentpick,'shipmentdrop'=>$shipmentdrop,'shipmentrate'=>$shipmentrate])->setPaper($customPaper);
            return $pdf->stream('c.pdf');
        }
        /* Broker carrier rate pdf Function End Here */
        /* Broker carrier Bol pdf Function Start Here */
        public function CarrierBOl($shipmentid){
            $timezone=date_create("",timezone_open("America/New_York"));
            $todaydate = date_format($timezone,"m-d-Y");
            $shipment_id = ($shipmentid);
                $user_id = Auth::id();
                $shipmentData = Shipment::where('id', $shipment_id)->first();
                $carriersData = DB::table('carriers')
								->leftjoin('shipment', 'shipment.carrier_id', '=', 'carriers.id')
                                ->where([['carriers.id', '=', $shipmentData->carrier_id],])
                                ->first();
                $user = User::where('id',$shipmentData->user_id)->first();
                // $shipmentpick = Shipmentpick::where('shipment_id',$shipment_id)->get();
                // $shipmentdrop = Shipmentdrop::where('shipment_id', $shipment_id)->get();	
                // $shipmentrate = Shipmentrate::where('shipment_id', $shipment_id)->first();
                
                $shipmentpick = Shipmentpick::where('shipment_id',$shipment_id)->orderBy('manage_order','DESC')->get();
                $shipmentdrop = Shipmentdrop::where('shipment_id', $shipment_id)->orderBy('manage_order','DESC')->get();	
                $shipmentrate = Shipmentrate::where('shipment_id', $shipment_id)->first();	
            $customPaper = array(0,0,650,1040);
            $pdf = PDF::loadView('backend.shipmentManagement.shipment.newpdf', ['shipmentid'=>$shipmentid,'user'=>$user,'todaydate'=>$todaydate,'shipmentData'=>$shipmentData,'carriersData'=>$carriersData,'shipmentpick'=>$shipmentpick,'shipmentdrop'=>$shipmentdrop,'shipmentrate'=>$shipmentrate])->setPaper($customPaper);
            return $pdf->stream('c.pdf');
        }
        /* Broker carrier Bol pdf Function End Here */
        /* Broker carrier Bol pdf Function Start Here */
        public function CarrierBOlitem($shipmentid){
            $shipmentid = base64_decode($shipmentid);
            $timezone=date_create("",timezone_open("America/New_York"));
            $todaydate = date_format($timezone,"m-d-Y");
            $shipment_id = ($shipmentid);
                $user_id = Auth::id();
                $shipmentData = Shipment::where('id', $shipmentid)->first();
                $carriersData = DB::table('carriers')
								->leftjoin('shipment', 'shipment.carrier_id', '=', 'carriers.id')
                                ->where([['carriers.id', '=', $shipmentData->carrier_id],])
                                ->first();
                $user = User::where('id',$shipmentData->user_id)->first();
                $shipmentpick = Shipmentpick::where('shipment_id',$shipment_id)->orderBy('manage_order','DESC')->get();
                $shipmentdrop = Shipmentdrop::where('shipment_id', $shipment_id)->orderBy('manage_order','DESC')->get();	
                $shipmentrate = Shipmentrate::where('shipment_id', $shipment_id)->first();						
            $customPaper = array(0,0,650,1040);
            // $pdf = PDF::loadView('backend.shipmentManagement.shipment.bol.index', ['user'=>$user,'todaydate'=>$todaydate,'shipmentData'=>$shipmentData,'carriersData'=>$carriersData,'shipmentpick'=>$shipmentpick,'shipmentdrop'=>$shipmentdrop,'shipmentrate'=>$shipmentrate])->setPaper($customPaper);
            // return $pdf->stream('c.pdf');
            $shipment_id = base64_decode($shipmentid);
            $shipmentData = DB::table('shipment')
                            ->where([ ['id', '=', $shipment_id] ])
                            ->first();
          
            $shipmentComp = '';
            $ship = base64_encode($shipmentid);
            return view('backend.shipmentManagement.shipment.bol.index', compact('shipmentdrop','shipmentpick','shipmentComp','shipmentData','shipmentid','shipment_id'));
        }
        /* Broker carrier Bol pdf Function End Here */
        public function CarrierBOlitemOne($shipmentid){

            $shipmentid = base64_decode($shipmentid);

            $timezone=date_create("",timezone_open("America/New_York"));
            $todaydate = date_format($timezone,"m-d-Y");
            $shipmentid = ShipmentBol::where('id',$shipmentid)->select('id','shipment_id','shippickup_address','shipdrop_address')->first();
            $shipment_id = $shipmentid->shipment_id ;
                $user_id = Auth::id();
                $shipmentData = Shipment::where('id', $shipment_id)->first();
                $carriersData = DB::table('carriers')
								->leftjoin('shipment', 'shipment.carrier_id', '=', 'carriers.id')
                                ->where([['carriers.id', '=', $shipmentData->carrier_id],])
                                ->first();
                $user = User::where('id',$shipmentData->user_id)->first();
                $shipmentpick = Shipmentpick::where('id',$shipmentid->shippickup_address)->first();
                $shipmentdrop = Shipmentdrop::where('id',$shipmentid->shipdrop_address)->first();
                $shipmentrate = Shipmentrate::where('shipment_id', $shipment_id)->first();						
                // $shipmentrate = Shipmentrate::where('shipment_id', $shipment_id)->first();						
                $shipboldata = ShipmentBol::where('shipment_id',$shipment_id)
                        ->orWhere('shippickup_address',$shipmentid->shippickup_address)
                        ->orWhere('shipdrop_address',$shipmentid->shipdrop_address)
                        ->get();
                //dd($$datain);
            $customPaper = array(0,0,650,1040);
            $pdf = PDF::loadView('backend.shipmentManagement.shipment.bol.newpdfone', ['shipmentid'=>$shipmentid,'shipboldata'=>$shipboldata,'shipment_id'=>$shipment_id,'user'=>$user,'todaydate'=>$todaydate,'shipmentData'=>$shipmentData,'carriersData'=>$carriersData,'shipmentpick'=>$shipmentpick,'shipmentdrop'=>$shipmentdrop,'shipmentrate'=>$shipmentrate])->setPaper($customPaper);
            return $pdf->stream('c.pdf');
        }
        
        public function CarrierBOlitemOneOld($shipmentid){
            // $shipmentid = base64_decode($shipmentid);
            $shipmentid = ShipmentBol::where('id',$shipmentid)->select('shipment_id')->first();
           // dd($shipmentid);
            $shipmentid = $shipmentid->shipment_id ;
            $timezone=date_create("",timezone_open("America/New_York"));
            $todaydate = date_format($timezone,"m-d-Y");
            $shipment_id = ($shipmentid);
                $user_id = Auth::id();
                $shipmentData = Shipment::where('id', $shipmentid)->first();
                $carriersData = DB::table('carriers')
								->leftjoin('shipment', 'shipment.carrier_id', '=', 'carriers.id')
                                ->where([['carriers.id', '=', $shipmentData->carrier_id],])
                                ->first();
                $user = User::where('id',$shipmentData->user_id)->first();
                $shipmentpick = Shipmentpick::where('shipment_id',$shipment_id)->orderBy('manage_order','DESC')->get();
                $shipmentdrop = Shipmentdrop::where('shipment_id', $shipment_id)->orderBy('manage_order','DESC')->get();	
                $shipmentrate = Shipmentrate::where('shipment_id', $shipment_id)->first();						
            $customPaper = array(0,0,650,1040);
            // $pdf = PDF::loadView('backend.shipmentManagement.shipment.bol.index', ['user'=>$user,'todaydate'=>$todaydate,'shipmentData'=>$shipmentData,'carriersData'=>$carriersData,'shipmentpick'=>$shipmentpick,'shipmentdrop'=>$shipmentdrop,'shipmentrate'=>$shipmentrate])->setPaper($customPaper);
            // return $pdf->stream('c.pdf');
            $shipment_id = base64_decode($shipmentid);
            $shipmentData = DB::table('shipment')
                            ->where([ ['id', '=', $shipment_id] ])
                            ->first();
          
            $shipmentComp = '';
            $ship = base64_encode($shipmentid);
            return view('backend.shipmentManagement.shipment.bol.index', compact('shipmentComp','shipmentData','shipmentid'));
        }
        public function CarrierBOlnew(){
            $customPaper = array(0,0,650,1040);
            $pdf = PDF::loadView('backend.shipmentManagement.shipment.newpdf')->setPaper($customPaper);
            return $pdf->stream('c.pdf');
        }
        
        public function loadPdfNew(){
            $customPaper = array(0,0,650,1040);
            $pdf = PDF::loadView('backend.shipmentManagement.shipment.rate-load-pdf')->setPaper($customPaper);
            return $pdf->stream('c.pdf');
        }
        public function loadPdfNewInvoice(){
            $customPaper = array(0,0,650,1040);
            $pdf = PDF::loadView('backend.shipmentManagement.shipment.invoice-pdf')->setPaper($customPaper);
            return $pdf->stream('c.pdf');
        }
        
        /*
        Broker Shipper BOL Pdf Function Start Here 
        */
        public function shipper_BOL_pdf($shipmentid){ 
            $timezone=date_create("",timezone_open("America/New_York"));
            $todaydate = date_format($timezone,"m-d-Y");
            $shipment_id = base64_decode($shipmentid);
                $user_id = auth()->user()->id ;
                $shipmentData = DB::table('shipment')
                                ->leftjoin('carriers','carriers.carriers_id','=','shipment.carriers_id')
                                ->where([['shipment.shipment_id', '=', $shipment_id],])
                                ->first();
                $companies = DB::table('companies')->where([
                            ['companies_id', '=', $shipmentData->companies_id],
                        ])->first();
                $user = DB::table('users')->where([
                            ['user_id', '=', $shipmentData->user_id],
                        ])->first();
                $shipmentpick = DB::table('shipment_lanes_picks')
                                ->where([ ['shipment_id', '=', $shipment_id],['manage_order', '=', 1]])
                                ->get();
                $shipmentdrop = DB::table('shipment_lanes_drops')
                                ->where([ ['shipment_id', '=', $shipment_id],['manage_order', '=', 1]])
                                ->get();	
                $shipmentrate = DB::table('shipment_c_s_rates')->where([ ['shipment_id', '=', $shipment_id]])->first();						
            $pdf = PDF::loadView('broker.shipment.shipper_BOL', ['user'=>$user,'todaydate'=>$todaydate,'shipmentData'=>$shipmentData,'shipmentpick'=>$shipmentpick,'shipmentdrop'=>$shipmentdrop,'shipmentrate'=>$shipmentrate,'companies'=>$companies]);
            return $pdf->stream('BOL_Confirmation.pdf');
            
        }
        /*
        Broker Shipper BOL Pdf Function End Here 
        */
        /*
        Broker Shipper BOL Pdf Function Start Here 
        */
        public function shipper_rate_pdf($shipmentid){
            $timezone=date_create("",timezone_open("America/New_York"));
            $todaydate = date_format($timezone,"m-d-Y");
            $shipment_id = base64_decode($shipmentid);
                $user_id = auth()->user()->id ;
                $shipmentData = DB::table('shipment')
                                ->leftjoin('carriers','carriers.carriers_id','=','shipment.carriers_id')
                                ->where([['shipment.shipment_id', '=', $shipment_id],])
                                ->first();
                $companies = DB::table('companies')->where([
                            ['companies_id', '=', $shipmentData->companies_id],
                        ])->first();
                $user = DB::table('users')->where([
                            ['user_id', '=', $shipmentData->user_id],
                        ])->first();
                $shipmentpick = DB::table('shipment_lanes_picks')
                                ->where([ ['shipment_id', '=', $shipment_id],['manage_order', '=', 1]])
                                ->get();
                $shipmentdrop = DB::table('shipment_lanes_drops')
                                ->where([ ['shipment_id', '=', $shipment_id],['manage_order', '=', 1]])
                                ->get();	
                $shipmentrate = DB::table('shipment_c_s_rates')->where([ ['shipment_id', '=', $shipment_id]])->first();						
            $pdf = PDF::loadView('broker.shipment.shipper_rate_con', ['user'=>$user,'todaydate'=>$todaydate,'shipmentData'=>$shipmentData,'shipmentpick'=>$shipmentpick,'shipmentdrop'=>$shipmentdrop,'shipmentrate'=>$shipmentrate,'companies'=>$companies]);
            return $pdf->stream('BOL_Confirmation.pdf');
        }
        /*
        Broker Shipper BOL Pdf Function End Here 
        */
        
        /* Shipment status change on click Function Start Here */
        public function ShipmentStatusUpdate(Request $request)
        {
                $user_id = auth()->user()->id ;
                $user = DB::table('users')->where([
                            ['id', '=', $user_id],
                        ])->first();	
                
                $data = $request->all();
                $Shipment_data = Shipment::where('id',$data['shipmentId'])->first();
                
                $Shipment_data->shipment_statue = $data['status'];
                if($Shipment_data->save()){
                    echo '1';
                }
                //$Shipment_Status = DB::update('update shipment set shipment_statue =? where id = ?',[$request->input('status'),$request->input('shipmentId')]);
        }
        /* Shipment status change on click Function End Here */
        
        /* Broker extra pick&drop form Function Start Here */
        public function PicksDropsForm(Request $request)
        {
            $user_id = auth()->user()->id;
            $user = DB::table('users')->where([
                ['id', '=', $user_id],
                ])->first();
                
                $Shipment_id = $request->input('Shipment_id');
                 
                $Picks = Shipmentpick::where('shipment_id', $Shipment_id)->get();
                $Drops = Shipmentdrop::where('shipment_id', $Shipment_id)->get();
                // print_r($Picks);die;
                return view('backend.shipmentManagement.shipment.PicksDropsForm',compact('Picks','Drops','Shipment_id'));
        }
        /* Broker extra pick&drop form Function End Here */
        /* Broker extra pick add Function Start Here */
        public function AddExtraPick(Request $request)
        {		 
                $user_id = auth()->user()->id;
                
                $Shipment_id = $request->input('ManagePick_id');
                
                $ShipmentPickData = DB::table('shipment_lanes_picks')->where([ ['shipment_id', '=', $Shipment_id ] ])->first();
                //$user_id = $ShipmentPickData->user_id;
                
                
                $Shipment_pick = new shipmentpick;	
                
                $Shipment_pick->shipment_id = $Shipment_id;
                $Shipment_pick->user_id = $user_id;
                $Shipment_pick->p_name = $ShipmentPickData->p_name;
                $Shipment_pick->p_address = $ShipmentPickData->p_address;
                $Shipment_pick->p_city = $ShipmentPickData->p_city;
                $Shipment_pick->p_state = $ShipmentPickData->p_state;
                $Shipment_pick->p_zip = $ShipmentPickData->p_zip;
                $Shipment_pick->p_phone = $ShipmentPickData->p_contact;
                $Shipment_pick->p_ready = $ShipmentPickData->p_ready;
                $Shipment_pick->p_email = $ShipmentPickData->p_email;
                $Shipment_pickSave = $Shipment_pick->save();
                $Shipment_pickId = $Shipment_pick->id;
                $NewPick = DB::table('shipment_lanes_picks')->where([ ['id', '=', $Shipment_pickId ] ])->first();
                
                $Picks = Shipmentpick::where('shipment_id', $Shipment_id)->get();
                $Drops = Shipmentdrop::where('shipment_id', $Shipment_id)->get();
                //print_r($Picks);die;
                return view('backend.shipmentManagement.shipment.PicksDropsForm',compact('Picks','Drops','Shipment_id'));
        }
        /* Broker extra pick add Function End Here */
        /* Broker extra drop add Function Start Here */
        public function AddExtraDrop(Request $request)
        {		 
                
                $user_id = auth()->user()->id;
                
                $Shipment_id = $request->input('ManagePick_id');
                
                $ShipmentDropData = DB::table('shipment_lanes_drops')->where([ ['shipment_id', '=', $Shipment_id ] ])->first();
                //$user_id = $ShipmentDropData->user_id;
                
                
                $Shipment_drop = new shipmentdrop;	
                
                $Shipment_drop->shipment_id = $Shipment_id;
                $Shipment_drop->user_id = $user_id;
                $Shipment_drop->d_name = $ShipmentDropData->d_name;
                $Shipment_drop->d_address = $ShipmentDropData->d_address;
                $Shipment_drop->d_city = $ShipmentDropData->d_city;
                $Shipment_drop->d_state = $ShipmentDropData->d_state;
                $Shipment_drop->d_zip = $ShipmentDropData->d_zip;
                $Shipment_drop->d_contact = $ShipmentDropData->d_contact;
                $Shipment_drop->d_email = $ShipmentDropData->d_email;
                $Shipment_drop->d_ready = $ShipmentDropData->d_ready;
                $Shipment_dropSave = $Shipment_drop->save();
                $Shipment_dropId = $Shipment_drop->id;
                
                $NewDrop = DB::table('shipment_lanes_drops')->where([ ['id', '=', $Shipment_dropId ] ])->first();
                
                $Picks = Shipmentpick::where('shipment_id', $Shipment_id)->get();
                $Drops = Shipmentdrop::where('shipment_id', $Shipment_id)->get();
                //print_r($Picks);die;
                return view('backend.shipmentManagement.shipment.PicksDropsForm',compact('Picks','Drops','Shipment_id'));
        }
        /* Broker extra drop add Function End Here */
        
        /* Broker extra drop submit Function Start Here */
        public function ExtraDropSubmit(Request $request)
        {		 
                $user_id = auth()->user()->id;
                $shipment_id = $request->input('drop_id');
                $dropready = $request->input('dropready');
                $drop_ready = date('Y-m-d', strtotime($dropready) );
                $ShipmentDropData = DB::table('shipment_lanes_drops')->where([ ['id', '=', $shipment_id ] ])->first();
                    $shipmentupdate = DB::update('update shipment_lanes_drops set d_name =?,d_address =?,d_city =?,d_state =?,d_zip =?,d_ref =?,d_contact =?,d_phone =?,d_email =?,d_ready =?,d_rtime =?,d_appt_note =? where id = ?',[ $request->input('d_name'),$request->input('d_address'),$request->input('city'),$request->input('state'),$request->input('zip'),$request->input('d_ref'),$request->input('contact'),$request->input('phone'),$request->input('email'),$drop_ready,$request->input('time'),$request->input('d_appt_note'),$shipment_id]);
                    echo $shipmentupdate;
                    //return redirect('extra-picks-drop/'.base64_encode($ShipmentDropData->shipment_id));                
        }	
        /* Broker extra drop submit Function End Here */
// shipment_lanes_drops
        /* Broker extra pick submit Function Start Here */
        public function ExtraPickSubmit(Request $request){		 
                $user_id = auth()->user()->id;
                $shipment_id = $request->input('pick_id');
                $pickready = $request->input('pickready');
                $pick_ready = date('Y-m-d', strtotime($pickready) );
                
                $ShipmentPickData = DB::table('shipment_lanes_picks')->where([ ['id', '=', $shipment_id ] ])->first();
                $shipmentupdate = DB::update('update shipment_lanes_picks set p_name =?,p_address =?,p_city =?,p_state =?,p_zip =?,p_ref =?,p_contact =?,p_phone =?,p_email =?,p_ready =?,p_rtime =?,p_appt_note =? where id = ?',[ $request->input('p_name'),$request->input('p_address'),$request->input('city'),$request->input('state'),$request->input('zip'),$request->input('p_ref'),$request->input('contact'),$request->input('phone'),$request->input('email'),$pick_ready,$request->input('time'),$request->input('p_appt_note'),$shipment_id]);
                echo $shipmentupdate;
        }	
        /* Broker extra pick submit Function end Here */
        /* Broker extra pick delete Function Start Here */
        public function DeleteExtraPick(Request $request)
        {		 
                $user_id = auth()->user()->id;
                $pick_id = $request->input('ManagePick_id');
                $Shipment_id = $request->input('shipmentId');
                $data = DB::delete('delete from shipment_lanes_picks where id = ?',[$pick_id]);
    
                $Picks = Shipmentpick::where('shipment_id', $Shipment_id)->get();
                $Drops = Shipmentdrop::where('shipment_id', $Shipment_id)->get();
                return view('backend.shipmentManagement.shipment.PicksDropsForm',compact('Picks','Drops','Shipment_id'));
                
        }
        /* Broker extra pick delete Function end Here */
         /* Broker extra drop delete Function Start Here */
         public function DeleteExtraDrop(Request $request)
         {		 
                $user_id = auth()->user()->id;
                $drop_id = $request->input('drop_id');
                $Shipment_id = $request->input('shipmentId');
                 
                 $data = DB::delete('delete from shipment_lanes_drops where id = ?',[$drop_id]);
                 
                 $Picks = Shipmentpick::where('shipment_id', $Shipment_id)->get();
                 $Drops = Shipmentdrop::where('shipment_id', $Shipment_id)->get();
 
                
 
                return view('backend.shipmentManagement.shipment.PicksDropsForm',compact('Picks','Drops','Shipment_id'));
                 
         }
         /* Broker extra drop delete Function Start Here */
        /* Broker extra pick/drop Function Start Here */
        public function extra_picks_drop($shipmentid)
        {
              
                
            $shipment_id = base64_decode($shipmentid);
            
                $user_id = auth()->user()->id ;
                
                $shipmentData = DB::table('shipment')->where([
                            ['shipment_id', '=', $shipment_id],
                        ])->first();
                
                $user = DB::table('users')->where([
                            ['user_id', '=', $shipmentData->user_id],
                        ])->first();
                
                $Equipments = DB::table('equipment_types')->get();
                
                $shipmentpick = DB::table('shipment_lanes_picks')->where([
                            ['shipment_id', '=', $shipment_id],['manage_order', '=', 1]
                        ])->get();
                        
                $shipmentdrop = DB::table('shipment_lanes_drops')->where([
                            ['shipment_id', '=', $shipment_id],['manage_order', '=', 1]
                        ])->get();
            
                
                $active = 'all_shipment';
                return view('broker.shipment.extra_picks_drop',['active'=>$active,'user'=>$user,'shipmentData'=>$shipmentData,'ShipmentPickData'=>$shipmentpick,'shipmentdrop'=>$shipmentdrop,'Equipments'=>$Equipments]);
        }
        /* Broker extra pick/drop Function Start Here */
        /*
        Broker shipment mc details get Function Start Here 
        */
        public function carrier_mc(Request $request)
        {		 
                
                
                $user_id = session('user_id');
                $mc_number = $request->input('carrier_mc');
                
                $mc_result = DB::table('carriers')->where([ ['mc_no', '=', $mc_number] ])->first();
                
                if((isset($mc_result->status)) == 1)
                {
                    $CarriersData = DB::table('carriers')->where([ ['mc_no', '=', $mc_number ] ])->first();
                }
                elseif((isset($mc_result->status)) == 0){
                    $CarriersData = 1;
                }
                elseif((isset($mc_result->status)) == 2){
                    $CarriersData = 2;
                }
                
                
                
                return $CarriersData;
        }
        public function ShipmentDotGet(Request $request)
        {		 
                
                $user_id = session('user_id');
                $mc_number = $request->input('shipment_mc');
                
                $mc_result = DB::table('carriers')->where([ ['dot_no', '=', $mc_number] ])->first();
                
                if((isset($mc_result->status)) == 1)
                {
                    $CarriersData = DB::table('carriers')->where([ ['dot_no', '=', $mc_number ] ])->first();
                }
                elseif((isset($mc_result->status)) == 0){
                    
                    $CarriersData = 1;
                }
                elseif((isset($mc_result->status)) == 2){
                   
                    $CarriersData = 2;
                }
             
                
                
                return $CarriersData;
        }
        /* 
        Broker shipment mc details get Function End Here
        */
        /*
        Broker shipment Dot details get Function Start Here 
        */
        public function carrier_dot(Request $request)
        {		 
                if(!(session('admin_username')))
                {
                return redirect()->action('LoginController@login');
                }
                
                $user_id = session('user_id');
                $carrier_dot = $request->input('carrier_dot');
                
                $CarriersData = DB::table('carriers')->where([ ['dot_no', '=', $carrier_dot ] ])->first();
                
                return $CarriersData;
        }
        /* 
        Broker shipment Dot details get Function End Here
        */
  
        /*
        shipment page Function Start Here
        */
            public function every_shipment(Request $request)
            {
                
                if(!(session('admin_username')))
                {
                return redirect()->action('LoginController@login');
                }
            
                $user_id = session('user_id');
                $user = DB::table('users')->where([
                            ['user_id', '=', $user_id],
                        ])->first();
                
                $Equipments = DB::table('equipment_types')->get();
                
                $shipment = DB::table('shipment')
                            ->leftjoin('carriers','carriers.carriers_id','=','shipment.carriers_id')
                            //->leftjoin('shipment_lanes_picks','shipment_lanes_picks.shipment_id','=','shipment.shipment_id')
                            //->join('shipment_lanes_drops','shipment_lanes_drops.shipment_id','=','shipment.shipment_id')
                            ->leftjoin('users','users.user_id','=','shipment.user_id')
                            ->orderBy('shipment.shipment_id','DESC')
                            ->get();
                
                        
                $active = 'every_shipment';
                return view('broker.shipment.every_shipment',['active'=>$active,'user'=>$user,'shipment'=>$shipment,'Equipments'=>$Equipments]);
                        
            }
        /*
        shipment page Function End Here 
        */
        
        
        
       
        
        /*
        shipment load status update Function Start Here 
        */
            
            public function shipment_doc_del(Request $request)
            {
               
                $user_id = session('user_id');
                $user = DB::table('users')->where([
                            ['id', '=', $user_id],
                        ])->first();
                
                $ShipperDocId = $request->input('ShipperDocId');
                $ShipmentDoc = ShipmentDoc::where('id', $ShipperDocId)->first();
                //$ShipmentDoc = DB::table('shipment_doc')->where([ ['id', '=', $ShipperDocId] ])->first();
   
                $files = 'shipment_doc/'.$ShipmentDoc->document_name;
                if(File::delete(public_path($files)))
                { 
                    $shipment_doc = ShipmentDoc::findOrFail($ShipperDocId);
                    $doc = $shipment_doc->delete();
                    echo $doc;
                }
                
                        
            }
        /*
        shipment load status update Function End Here 
        */
  	
	
 /* Admin shipment all list get function start here */
 public function AllShipmentFilterAdmin(Request $request)
 {
            
         $user_id = Auth::id();
         $user = DB::table('users')->where([
                         ['id', '=', $user_id],
                     ])->first();
            
              $f_date = $request->input('from_date');
              $t_date = $request->input('to_date');
              if(isset($f_date)){
                //die('here');
                $from_date = Carbon::createFromFormat('Y-m-d', $f_date)->format('Y-d-m');
            
              if(!empty($from_date)){
                print_r($from_date);
                    $Shipment_data = Shipment::with('getCompany')->with('carrierget')->
                            whereHas('shipmentPick', function($query) use ($request,$from_date){
                            $query->where('p_ready', '>=', $from_date);
                        });
                }
            }
            if(isset($t_date)){
                //die('yes');
                $to_date = Carbon::createFromFormat('Y-d-m', $t_date)->format('Y-d-m');
            
              if(!empty($to_date)){
                
                    $Shipment_data = Shipment::with('getCompany')->with('carrierget')->
                            whereHas('shipmentPick', function($query) use ($request,$to_date){
                            $query->where('p_ready', '<=',$to_date);
                        });
                }
            }
            if(empty($from_date)){
                  $Shipment_data = Shipment::with('getCompany')->with('carrierget')->with('shipmentPick');
              }
             
          
//print_r($to_date);
//print_r($Shipment_data->get());die;
$ShipmentStatus = $request->input('ShipmentStatus');
$AgentName = $request->input('AgentName');
$Load = $request->input('Load');
// $from_date = $request->input('from_date');
// if($from_date)
// {
//  $s_from = $sales_t = Carbon::createFromFormat('Y-m-d', $from_date)->format('Y-d-m');
// }
// $to_date = $request->input('to_date');
// if($to_date)
// {
//  $sales_t = Carbon::createFromFormat('Y-m-d', $to_date)->format('Y-d-m');
 
// }
//die('here'); 
if(!empty($Load)){
 $query = $Shipment_data->where([ ['shipment.id', '=', $Load] ]);
}
if(!empty($ShipmentStatus)){
 $query = $Shipment_data->where([ ['shipment.shipment_statue', '=', $ShipmentStatus] ]);
}
if(!empty($f_date)){
 $query = $Shipment_data;
}
if(!empty($t_date)){
 $query = $Shipment_data;
}
if(!empty($AgentName)){
$query = $Shipment_data->where([ ['shipment.user_id', '=', $AgentName] ]);
}
$ShipmentData = $query->get();
  //print_r($ShipmentData);
//  die('here');
     return view('backend.shipmentManagement.shipment.shipment_filter',['shipment'=>$ShipmentData]);
 }
 /* Admin shipment all list get fillter function End here */
	/* Admin shipment list fillter function start here */
	public function ShipmentFilterAdmin(Request $request)
    {
            $user_id = auth()->user()->id ;
            $user = DB::table('users')->where([
                            ['id', '=', $user_id],
                        ])->first();
                //print_r($_GET);
                $Shipment_data = Shipment::where('user_id',$user_id)->with('getCompany')->with('carrierget');
$ShipmentStatus = $request->input('ShipmentStatus');
$AgentName = $request->input('AgentName');
$Load = $request->input('Load');
$from_date = $request->input('from_date');
if($from_date)
{
    $s_from = $sales_t = Carbon::createFromFormat('Y-m-d', $from_date)->format('Y-d-m');
}
$to_date = $request->input('to_date');
if($to_date)
{
    $sales_t = Carbon::createFromFormat('Y-m-d', $to_date)->format('Y-d-m');
}
//die('here'); 
if(!empty($Load)){
    $query = $Shipment_data->where([ ['shipment.id', '=', $Load] ]);
}
if(!empty($ShipmentStatus)){
    $query = $Shipment_data->where([ ['shipment.shipment_statue', '=', $ShipmentStatus] ]);
}
if(!empty($from_date)){
    $query = $Shipment_data->where([ ['shipment_lanes_picks.p_ready', '>=', $s_from] ]);
}
if(!empty($to_date)){
    $query = $Shipment_data->where([ ['shipment_lanes_picks.p_ready', '<=', $sales_t] ]);
}
if(!empty($AgentName)){
$query = $Shipment_data->where([ ['shipment.user_id', '=', $AgentName] ]);
}
$ShipmentData = $query->get();
//  print_r($ShipmentData);
//  die('here');
        return view('backend.shipmentManagement.shipment.shipment_filter',['shipment'=>$ShipmentData]);
    }
	/* Admin shipment list fillter function End here */
//     public function vonagecalllog(Request $request){
//         $url = "https://api.nexmo.com/v1/calls";
//         $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzMyODkzNzgsImV4cCI6MTY3MzMxMDk3OCwianRpIjoiR0dzSW5ydE1abHFnIiwiYXBwbGljYXRpb25faWQiOiI3OTU4Y2M5MC1mY2QwLTQ3OTQtOGM0Ny0xMGQxN2E2OWZiNmMifQ.WSgHFdiFCqjWveuypd76okGsufuOhTJxC731pbti0IvSqx_dXYrehq1cTm0IRCse62XUaWAgLhUbRbEEYy7HBqbQKcgWZ_skwgQmkotZpviNf80NFXlqe_sjArkjQ2RAQ-yo7m89m5xM8MVUwKx6iIEEd_JWJge0hAIo-VHydBxi7OQn0aHfUjCnmP536X0DFDMNozxwcCGg7RglRVHfR5TYyOfjmXlhBSGvr8oyeiXaJtt5cQnNPxX17RZjq7MOLI5prY491UNugvtutF9QsF-Ij3KHyHYD53iUHg7CeXD5wYtBbaMGqCJ1odXBeUmI8omx4W5ypU17LcudXSeOrw";
//         $curl = curl_init();
//         curl_setopt_array($curl, array(
//         CURLOPT_URL => $url,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_ENCODING => "",
//         CURLOPT_TIMEOUT => 30000,
//         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//         CURLOPT_CUSTOMREQUEST => "GET",
//         CURLOPT_POST => 1,
//         //CURLOPT_POSTFIELDS => $load_field,
//         CURLOPT_HTTPHEADER => array(
//         'Content-Type: application/json',
//         "Authorization: Bearer ".$token.""
//         ),
//         ));
//         $response = curl_exec($curl);
//         if (curl_errno($curl)) 
//         {
//                 $error_msg = curl_error($curl);
//             print_r($error_msg);
//         }	
//         curl_close($curl);
    
//         $res = json_decode($response);
//         echo '<pre>';
//         print_r($res);
//     }
    
//     public function vonagecall(Request $request){
//         $url = "https://api.nexmo.com/v1/calls";
//         $jdata = 
//         '{ "to": [{"type": "phone","number": "5864353800"}],
//         "from": {"type": "phone","number": "15866360949"},
//         "ncco": [
//             {
//                 "action": "talk",
//                 "text": "This is a text to speech call from Vonage"
//             }
//         ] }';
//         //dd( $jdata);
// $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzMyODkzNzgsImV4cCI6MTY3MzMxMDk3OCwianRpIjoiR0dzSW5ydE1abHFnIiwiYXBwbGljYXRpb25faWQiOiI3OTU4Y2M5MC1mY2QwLTQ3OTQtOGM0Ny0xMGQxN2E2OWZiNmMifQ.WSgHFdiFCqjWveuypd76okGsufuOhTJxC731pbti0IvSqx_dXYrehq1cTm0IRCse62XUaWAgLhUbRbEEYy7HBqbQKcgWZ_skwgQmkotZpviNf80NFXlqe_sjArkjQ2RAQ-yo7m89m5xM8MVUwKx6iIEEd_JWJge0hAIo-VHydBxi7OQn0aHfUjCnmP536X0DFDMNozxwcCGg7RglRVHfR5TYyOfjmXlhBSGvr8oyeiXaJtt5cQnNPxX17RZjq7MOLI5prY491UNugvtutF9QsF-Ij3KHyHYD53iUHg7CeXD5wYtBbaMGqCJ1odXBeUmI8omx4W5ypU17LcudXSeOrw";
// $curl = curl_init();
// curl_setopt_array($curl, array(
// CURLOPT_URL => $url,
// CURLOPT_RETURNTRANSFER => true,
// CURLOPT_ENCODING => "",
// CURLOPT_TIMEOUT => 30000,
// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// CURLOPT_CUSTOMREQUEST => "POST",
// CURLOPT_POST => 1,
// CURLOPT_POSTFIELDS => $jdata,
// CURLOPT_HTTPHEADER => array(
// 'Content-Type: application/json',
// "Authorization: Bearer ".$token.""
// ),
// ));
//     $response = curl_exec($curl);
//     if (curl_errno($curl)) 
//     {
//             $error_msg = curl_error($curl);
//         print_r($error_msg);
//     }	
//     curl_close($curl);
//     $res = json_decode($response);
//     print_r($res);
// }
// public function vonagecalldetail(Request $request){
//     $ACCOUNT_ID="4bc1c543";
//     $REPORT_PRODUCT="outbound";
//     $REPORT_DIRECTION="CONVERSATIONS";
//     $ID = "a768b6c8-f769-4aaf-bcf4-939350a3d603";
//     $url = "https://api.nexmo.com/v1/calls/20ea8959-60e3-4ae4-b87f-40d77aaacebf";
//     //print_r( $url); 
//     //die;
// $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NzMyODkzNzgsImV4cCI6MTY3MzMxMDk3OCwianRpIjoiR0dzSW5ydE1abHFnIiwiYXBwbGljYXRpb25faWQiOiI3OTU4Y2M5MC1mY2QwLTQ3OTQtOGM0Ny0xMGQxN2E2OWZiNmMifQ.WSgHFdiFCqjWveuypd76okGsufuOhTJxC731pbti0IvSqx_dXYrehq1cTm0IRCse62XUaWAgLhUbRbEEYy7HBqbQKcgWZ_skwgQmkotZpviNf80NFXlqe_sjArkjQ2RAQ-yo7m89m5xM8MVUwKx6iIEEd_JWJge0hAIo-VHydBxi7OQn0aHfUjCnmP536X0DFDMNozxwcCGg7RglRVHfR5TYyOfjmXlhBSGvr8oyeiXaJtt5cQnNPxX17RZjq7MOLI5prY491UNugvtutF9QsF-Ij3KHyHYD53iUHg7CeXD5wYtBbaMGqCJ1odXBeUmI8omx4W5ypU17LcudXSeOrw";
// $curl = curl_init();
// curl_setopt_array($curl, array(
// CURLOPT_URL => $url,
// CURLOPT_RETURNTRANSFER => true,
// CURLOPT_ENCODING => "",
// CURLOPT_TIMEOUT => 30000,
// CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
// CURLOPT_CUSTOMREQUEST => "GET",
// CURLOPT_POST => 1,
// //CURLOPT_POSTFIELDS => $load_field,
// CURLOPT_HTTPHEADER => array(
// 'Content-Type: application/json',
// "Authorization: Bearer ".$token.""
// ),
// ));
// $response = curl_exec($curl);
// if (curl_errno($curl)) 
// {
//         $error_msg = curl_error($curl);
//     print_r($error_msg);
// }	
// curl_close($curl);
// $res = json_decode($response);
// echo '<pre>';
// print_r($res);
// }
    
            public function CarrierBOlitemItem(Request $request, $shipmentid){
                $shipmentid = base64_decode($shipmentid);
                $user_id = Auth::id();
                if($request->isMethod('post')){
                    // $shipment_bolid = $request->input('shipid');
                    // $shipmentbolid = $request->input('shipmentbolid');
                    ShipmentBolItem::create([
                        'shipment_bolid' => $request->shipid,
                        'shipment_id' => $request->shipmentbolid,
                        'user_id' => $user_id,
                        'ofpieces' => $request->ofpieces,
                        'descriptions' => $request->descriptions,
                        'weight' => $request->weight,
                        'type' => $request->type,
                        'nmfc' => $request->nmfc,
                        'hazmat' => $request->hazmat,
                        'productclass' => $request->productclass,
                        'notes' => $request->notes,
                        // 'shippickup_address' => $request->shippickup_address,
                        'consignee' => $request->shipmentDropid
                    ]);
                    $request->session()->flash('success', 'Shipment Bol Create successfully');
                    return redirect('admin/shipment-bol/'.(base64_encode($shipment_id)));
                }
                $shipboldatas =  ShipmentBolItem::where('shipment_bolid',$shipmentid)->get(); 
                
                // echo '<pre>',print_r($shipboldatas),'</pre>';
                // print_r($shipboldatas);
                return view('backend.shipmentManagement.shipment.bol.form',compact('shipmentid','shipboldatas' ));
                // $request->session()->flash('success', 'Shipment Bol Create successfully');
                // return redirect('admin/shipment-bol/'.(base64_encode($shipment_id)));
                
            }
            
            public function CarrierBOlitemItemEdit(Request $request, $shipmentid){
                $shipmentid = base64_decode($shipmentid);
                
                // dd($shipmentid);
                $user_id = Auth::id();
                
                $data = $request->all();
                if($request->isMethod('post')){
                    $data = $request->all();
                    // dd($data);
                    $shpitems = ShipmentBolItem::where('id',$shipmentid)->first();

                    $shpitems['ofpieces']	        = $data['ofpieces'];
                    $shpitems['descriptions']	    = $data['descriptions'];
                    $shpitems['weight']	            = $data['weight'];
                    $shpitems['type']	            = $data['type'];
                    $shpitems['nmfc']	            = $data['nmfc'];
                    $shpitems['hazmat']	            = $data['hazmat'];
                    $shpitems['productclass']	    = $data['productclass'];
                    $shpitems['notes']	            = $data['notes'];
                    $shpitems['ed']	                = $data['delivery_date'];
                    $shpitems->save();
                    // dd($shpitems);$shpitems
                    //  $shipmentid = base64_encode($shipmentid);
                    $request->session()->flash('success', 'Shipment Bol Item Update successfully');
                    return redirect('admin/shipment-bol/item/edit/'.base64_encode($shipmentid));
                }
                // $shipmentid = base64_encode($shipmentid);
                // $shipboldatas =  ShipmentBolItem::where('shipment_bolid',$shipmentid)->get(); 
                $shpitemupdate = ShipmentBolItem::where('id',$shipmentid)->first();
                return view('backend.shipmentManagement.shipment.bol.formEdit',compact('shipmentid','shpitemupdate' ));
                // $request->session()->flash('success', 'Shipment Bol Create successfully');
                // return redirect('admin/shipment-bol/'.(base64_encode($shipment_id)));
                
            }
            
            public function shipmentbolupdatedata(Request $request){
                $shipment_id = $request->input('shipment_id');
                $user_id = Auth::id();
                //dd($shipment_id);
                ShipmentBol::create([
                    'shipment_id' => $shipment_id,
                    'user_id' => $user_id,
                    'shippickup_address' => $request->shippickup_address,
                    'shipdrop_address' => $request->shipdrop_address,
                ]);
                
                //dd('done');
                $request->session()->flash('success', 'Shipment Bol Create successfully');                
                return redirect('admin/shipment-bol/'.(base64_encode($shipment_id)));
            }
            public function shipmentbolupdate(Request $request){
                    // $shipment_id = $request->input('shipment_id');
                    $user_id = Auth::id();
                    
                    $shipment_bolid = $request->input('shipid');
                    $shipmentbolid = $request->input('shipmentbolid');
                    //dd($ald);
                    ShipmentBolItem::create([
                        'shipment_bolid' => $shipment_bolid,
                        'shipment_id' => $shipmentbolid,
                        'user_id' => $user_id,
                        'ofpieces' => $request->ofpieces,
                        'descriptions' => $request->descriptions,
                        'weight' => $request->weight,
                        'type' => $request->type,
                        'nmfc' => $request->nmfc,
                        'hazmat' => $request->hazmat,
                        'productclass' => $request->productclass,
                        'notes' => $request->notes,
                        'consignee' => $request->shipmentDropid,
                        'ed' => $request->delivery_date
                    ]);
                    $request->session()->flash('success', 'Shipment Bol Create successfully');
                    return redirect('admin/shipment-bol/'.(base64_encode($shipmentbolid)));
                    // dd('Miss you lopmudra');
                    // foreach($request->ofpieces as $key=>$val){
                    //     if($request->bol_id[$key]!=0){
                    //         ShipmentBol::where('id', $request->bol_id[$key])->update([
                    //             'shipment_id' => $shipment_id,
                    //             'user_id' => $user_id,
                    //             'ofpieces' => $request->ofpieces[$key],
                    //             'descriptions' => $request->descriptions[$key],
                    //             'weight' => $request->weight[$key],
                    //             'type' => $request->type[$key],
                    //             'nmfc' => $request->nmfc[$key],
                    //             'hazmat' => $request->hazmat[$key],
                    //             'productclass' => $request->productclass[$key],
                    //             'notes' => $request->notes[$key]
                    //         ]);
                    //     }else{
                    //         ShipmentBol::create([
                    //             'shipment_id' => $shipment_id,
                    //             'user_id' => $user_id,
                    //             'ofpieces' => $request->ofpieces[$key],
                    //             'descriptions' => $request->descriptions[$key],
                    //             'weight' => $request->weight[$key],
                    //             'type' => $request->type[$key],
                    //             'nmfc' => $request->nmfc[$key],
                    //             'hazmat' => $request->hazmat[$key],
                    //             'productclass' => $request->productclass[$key],
                    //             'notes' => $request->notes[$key]
                    //         ]);
                    //     }
                        
                    // }
            }
}
