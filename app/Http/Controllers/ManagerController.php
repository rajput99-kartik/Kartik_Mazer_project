<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Load;
use App\Models\User;
use App\Models\Carriers;
use App\Models\Company;
use App\Models\Shipment;
use App\Models\AssignUserTeam;
use DateTime;

class ManagerController extends Controller
{
    public $user;
    function __construct()
    {
         $this->middleware('permission:carrier-agentcarrier|loads-agentloads|shipper-agentshipper|shipment-agentshipment', ['only' => ['index','view']]);
        //  $this->middleware('permission:user-approve', ['only' => ['approve','approve']]);
        //  $this->middleware('permission:user-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:user-delete', ['only' => ['destroy']]);


         $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });

    }


    /* Manage assign user carrier data start */
    public function CarrierManagerAssign(Request $request){

        if (is_null($this->user) || !$this->user->can('carrier-agentcarrier')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }
        $user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
              
              $userdata = AssignUserTeam::where('assignto_id',$user_id)->with('getagent')->get();
              //dd($userdata);
              
              return view('backend.shipmentManagement.carrier.manager.list', compact('userdata')); 
      }
     
      public function AssignUserCarrier($userid){

        if (is_null($this->user) || !$this->user->can('carrier-agentcarrier')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }
              $user_id = base64_decode($userid);
              $user = User::where('id',$user_id)->first();
              $Equipments = DB::table('equipment_types')->get();
              //die('here');
              $carriers_data= Carriers::where('user_id',$user_id)->orderBy('id','DESC')->get();
          
          $active = 'carriers';		
          return view('backend.shipmentManagement.carrier.manager.carrier', compact('active','Equipments','carriers_data','userid'));
              
      }
    /* Manage assign user carrier data End */


    /* Manage assign user Load data start */
      public function LoadManagerAssign(Request $request){

        if (is_null($this->user) || !$this->user->can('loads-agentloads')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }

        $user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
              
              $userdata = AssignUserTeam::where('assignto_id',$user_id)->with('getagent')->get();
              //dd($userdata);
              
              return view('backend.loadsManagement.manager.list', compact('userdata')); 
      }
     
     public function LoadManagerAssignList(Request $request){

        if (is_null($this->user) || !$this->user->can('loads-team-agent')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }

        $user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
              
            $userdata = AssignUserTeam::where('assignto_id',$user_id)->with('getagent')->get();
            //dd($userdata);
              
            return view('backend.loadsManagement.manager.loadlist', compact('userdata')); 
      }
      
      public function LoadManagerAssignListOlddata(Request $request){

        if (is_null($this->user) || !$this->user->can('loads-team-agent')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }

        $user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
              
            $userdata = AssignUserTeam::where('assignto_id',$user_id)->with('getagent')->get();
            //dd($userdata);
              
            return view('backend.loadsManagement.manager.loadlistold', compact('userdata')); 
      }
      
      public function AssignUserLoad($userid){

        if (is_null($this->user) || !$this->user->can('loads-agentloads')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }
              $user_id = base64_decode($userid);
              $user = User::where('id',$user_id)->first();
              $equipments = DB::table('equipment_types')->get();
              //die('here');
              $user_loads= Load::where('user_id',$user_id)->orderBy('id','DESC')->get();
              
            //   $results = Load::sortBy('created_at', 'desc')->get();

              $results = Load::all();

               // dd($results);
          
          $page = 'Load';		
          return view('backend.loadsManagement.manager.load', compact('page','equipments','user_loads','userid', 'user_id'));
              
      }
      
      //search filter load
      
      public function AssignUserLoadFilter(Request $req){

        if (is_null($this->user) || !$this->user->can('loads-agentloads')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }
              $user_id = base64_decode($req->userid);
              $user = User::where('id',$user_id)->first();
              $equipments = DB::table('equipment_types')->get();
              //die('here');
              $user_loads= Load::where('user_id',$user_id)->where('full_partial_tl_ltl', $req->lodetypeerStatus)->whereBetween('created_at', [$req->from_date, $req->to_date])->orderBy('id','DESC')->get();
                
            //   dd($user_loads);
          $page = 'Load';		
          return view('backend.loadsManagement.manager.loadfilter', compact('page','equipments','user_loads'));
              
      }
      
      //end search filtter
    /* Manage assign user Load data End */

    /* Manage assign user Shipper data Start */
    public function ShipperManagerAssign(Request $request){

        if (is_null($this->user) || !$this->user->can('shipper-agentshipper')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }
        

            $user_id = Auth::id();
            $user = User::where('id',$user_id)->first();
              
            $userdata = AssignUserTeam::where('assignto_id',$user_id)->with('getagent')->get();
              
            return view('backend.shipmentManagement.shipper.manager.list', compact('userdata')); 
      }
     
      public function AssignUserShipper($userid){

        if (is_null($this->user) || !$this->user->can('shipper-agentshipper')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }

              $user_id = base64_decode($userid);
              $user = User::where('id',$user_id)->first();
              $equipments = DB::table('equipment_types')->get();
              
              $comp_data= Company::where('user_id',$user_id)->orderBy('id','DESC')->get();
          
          $active = 'companies';
          $page = 'Company';		
          return view('backend.shipmentManagement.shipper.manager.shipper', compact('page','equipments','comp_data','user_id'));
          
          
      }
      /* Manage assign user Shipper data End */


      public function ManagerAssignShipment(Request $request){

        if (is_null($this->user) || !$this->user->can('shipment-agentshipment')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }
        $user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
        
        $userdata = AssignUserTeam::where('assignto_id',$user_id)->with('getagent')->get();
        //dd($userdata);
        
        return view('backend.shipmentManagement.shipment.manager.list', compact('userdata'));
        
    }
    
    
    public function ManagerAssignShipmentlist(Request $request){

        if (is_null($this->user) || !$this->user->can('shipment-agentshipment')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }
        $user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
        
        $userdata = AssignUserTeam::where('assignto_id',$user_id)->with('getagent')->get();
        // dd($userdata);
       
        return view('backend.shipmentManagement.shipment.manager.allshipment', compact('userdata'));
    }   
    
    public function AssignUserShipment($userid){

        if (is_null($this->user) || !$this->user->can('shipment-agentshipment')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }

        $user_id = base64_decode($userid);
        $user = User::where('id',$user_id)->first();
        //die('here');
        $shipment= Shipment::where('user_id',$user_id)->orderBy('id','DESC')->get();
        
        $total =  Shipment::where('user_id',$user_id)->count();
        $shipment_open =  Shipment::where('shipment_statue', 'Open')->where('user_id', $user_id)->count();
        $shipment_covered =  Shipment::where('shipment_statue', 'Covered')->where('user_id', $user_id)->count();
        $shipment_transit =  Shipment::where('shipment_statue', 'In-transit')->where('user_id', $user_id)->count();
        $shipment_delivered =  Shipment::where('shipment_statue', 'Delivered')->where('user_id', $user_id)->count();
        $shipment_paid =  Shipment::where('shipment_statue', 'Paid')->where('user_id', $user_id)->count();
        $shipment_invoice =  Shipment::where('shipment_statue','Invoiced')->where('user_id', $user_id)->count();
        
        
        return view('backend.shipmentManagement.shipment.manager.shipment', compact('shipment','user_id','total','shipment_open','shipment_covered','shipment_transit','shipment_delivered','shipment_paid','shipment_invoice'));
    }



    public function loadFilterAdmin(Request $request)
    {
		
        $user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
        if($request->isMethod('get'))
        {
            $data = $request->all();


                $companies = DB::table('loads')
                    ->leftjoin('users','users.id','=','loads.user_id');

                    $ShipperStatus = $data['ShipperStatus'];
                    $ShipperName = $data['ShipperName'];
                    $AgentName = $data['AgentName'];

                    // if(isset($ShipperStatus)){
                    //     $query = $companies->where([ ['companies.approved', '=', $ShipperStatus] ]);
                    // }

                    // if(!empty($ShipperName)){
                    //     $query = $companies->where([ ['companies.id', '=', $ShipperName] ]);
                    // }
                    // if(!empty($AgentName)){

                    // $query = $companies->where([ ['companies.user_id', '=', $AgentName] ]);
                    // }

                    $CompaniesData = $query->get();

                    //  print_r($CompaniesData);
                    //   die('here');
                    return view('backend.shipmentManagement.shipper.shipper_filter',['comp_data'=>$CompaniesData]);

                    }

    }

}
