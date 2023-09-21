<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agency;
use App\Models\AssignAcReceivable;
use App\Models\AccountReceivable;
use App\Models\Shipment;
use App\Models\AssignUserTeam;

use DB;
use Hash;
use Auth;

class AssignAcReceivableController extends Controller
{
    
    public $user;
    function __construct(){
         $this->middleware('permission:uagent-list|uagent-view|uagent-create|uagent-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-approve', ['only' => ['approve','approve']]);
         $this->middleware('permission:uagent-create', ['only' => ['create','store']]);
         $this->middleware('permission:uagent-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:uagent-delete', ['only' => ['destroy']]);

         $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }

    public function index(Request $request){
        
        $userid = Auth::id();
        $userdata = AssignUserTeam::where('assignto_id',$userid)->get();
        
        
        // $userdata = AssignAcReceivable::where('user_id',$userid)
        // ->with('arAssignbyuser')->with('arTeamLeader')
        // ->with('arTeamAgent')->get();
        //dd($userdata);    

        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.accountManagement.assignArManage.index',compact('agency','userdata'));
        
    }


    public function ManagerShipmentList(Request $request){
        
        $userid = Auth::id();
        $userdata = AssignUserTeam::where('assignto_id',$userid)->get();

        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.accountManagement.assignArManage.assignshipment',compact('agency','userdata'));
        
    }
    
    
    public function AragentBrokerList(Request $request){
        $userid = Auth::id();

        $userdata = AssignAcReceivable::get();

        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.accountManagement.assignArManage.arindex',compact('agency','userdata'));
        //dd($userlist);
    }

    
    public function AssignAgentList(Request $request){
        
        $userid   = Auth::id();
        $userdata = AssignAcReceivable::get();

        $agency   = Agency::pluck('agencies_name','id')->all();
        return view('backend.accountManagement.assignArManage.arindex',compact('agency','userdata'));
    }

    
    public function ChangeUserArAccess(Request $request){
        $response = [];
        if($request->isMethod('post')){
            $data = $request->all();
            
            // echo '<pre>'; print_r($data); die;
           // $statusid = base64_decode($data['cat']);
             $statusid = $data['cat'];
            if($data['curr'] == 'true'){
                $status = '1';
            } else{
                $status = '0';
            }

            $upd = AssignAcReceivable::where('assign_agent_to',$statusid)->update(['status'=>$status]);
            if($upd){
                $response['status'] = 'true';
                $response['msg']    = 'Status updated successfully';
            } else{
                $response['status'] = 'false';
                $response['msg']    = 'COMMON_ERROR';
            }
        }
        return $response;
    }


    public function ChangeUserArStatus(Request $request){
        $response = [];
        if($request->isMethod('post')){
            $data = $request->all();
            // echo '<pre>'; print_r($data); die;
            $statusid = ($data['cat']);
            // $statusid = $data['cat'];
            if($data['curr'] == 'true'){
                $status = '1';
            } else{
                $status = '0';
            }

            //$upd = Shipment::where('id',$statusid)->update(['ar_access_status'=>$status,'ar_access_date'=>date('Y-m-d')]);
            $shipmentget = Shipment::where('id',$statusid)->first();
            $shipmentget->ar_access_date = date('Y-m-d');
            $shipmentget->ar_access_status = $status;
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

    public function add(Request $request){

        
        $current_userid = Auth::id();
        if($request->isMethod('post'))
        {

            $data = $request->all();
            $validatedData = $request->validate([ ]);

            $user = AssignAcReceivable::where('ar_user',$data['assign_by'])->Where('assign_agent_to',$data['assign_to'])->get();
            $user =  count($user);
            
          if($user < 1 ){

            $user = new AssignAcReceivable;
            $user->assign_by    =  $current_userid;
            $user->user_id      =  $current_userid;
            $user->ar_user	    = $data['assign_by'];
            $user->assign_agent_to	= $data['assign_to'];

            if($user->save()){
                return redirect('/admin/ar/assign/agent/list')->with('success','AR User Added successfully');
            } else {
                return redirect('/admin/ar/assign/agent/list')->with('errors',COMMON_ERROR);
            }

            }
            return redirect('/admin/ar/assign/agent/list')->with('danger','Alrady Exist This User');

        }

        $userdata = User::where('user_type', 'like', 'ar%')
                ->orWhere('user_type', 'like', 'accountant%')
                ->get();

        //$agent = User::where('user_type', 'like', 'agent%')->get();
        $agent = User::where('user_type','officer')->orwhere('user_type','agent')->get();
        //dd($agent);
        $roles = Role::where('name','Agent')->get();
        $agent_id = Auth::id();
        $agency = Agency::pluck('agencies_name','id')->all();
        $page = 'shipper';
        return view('backend.accountManagement.assignArManage.form', compact('page','roles','agency','agent_id','userdata','agent'));
    }


    public function ArDetailtList($id){
        //dd($id);
        $userid = Auth::id();
        $data = User::where('user_type','agent');
        $roles = Role::pluck('name','id')->all();
        $agency = Agency::pluck('agencies_name','id')->all();
        $userdatass = AssignAcReceivable::where('user_id',$userid)
        ->with('arAssignbyuser')->with('arTeamLeader')
        ->with('arTeamAgent')->get();

        $shipment2222 = AssignAcReceivable::where('assign_agent_to',$id)
        ->with('accountShipments.getShipments.shipmentPrice')
        ->with('accountShipments.getShipments.shipmentPick')
        ->with('accountShipments.getShipments.shipmentDrop')
        ->with('accountShipments.getShipments.getCompany')
        ->with('arTeamLeader')->with('arAssignbyuser')->with('arTeamAgent')->get();

        $shipment = Shipment::where('user_id',base64_decode($id))->get();

        $shipdata = Shipment::where('user_id',$id)->get(); 
       
        //dd($userdata);
        //$userdata = AccountPayable::where('user_id',$id)->with('apTeamAgent')->get();
        //dd($userdata);
        return view('backend.accountManagement.assignArManage.details',compact('data','id','roles','agency','shipment','shipdata','id'));


        
    }




}
