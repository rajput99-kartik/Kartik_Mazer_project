<?php
namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use DB;
use Hash;
use Auth;
use App\Models\User;
use App\Models\Agency;
use App\Models\AccountsPayable;
use App\Models\Agency_detail;
use App\Models\Notification;
use App\Models\AssignUserTeam;
use App\Models\Carriers;
use App\Models\Shipment;
use App\Models\Carrier_account;
use App\Models\AssignAcPayable;
use App\Models\AccountPayable;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use Carbon;


class AccountsPayableController extends Controller
{
    public function index(Request $request){
        
        // if (is_null($this->user) || !$this->user->can('manageap-list')) {
        //     abort(403, 'Sorry !! You are Unauthorized to view !');
        // }
        
        $userid = Auth::id();
        $userdata = AssignAcPayable::where('ap_user',$userid)
        ->with('getAccountPayable.getshipmentdata.getapcdata')
        ->with('apassignbyuser')->with('apTeamLeader')
        ->with('apTeamAgent')->get(); 
       // dd($userdata);
        return view('backend.accountManagement.apManagement.apindex',compact('userdata'));
    }
    
    
     public function AllShipmentList(Request $request){
        
        // if (is_null($this->user) || !$this->user->can('manageap-list')) {
        //     abort(403, 'Sorry !! You are Unauthorized to view !');
        // }
        
        $userid = Auth::id();
        $userdata = AssignAcPayable::where('ap_user',$userid)
        ->with('getAccountPayable.getshipmentdata.getapcdata')
        ->with('apassignbyuser')->with('apTeamLeader')
        ->with('apTeamAgent')->get(); 
       // dd($userdata);
        return view('backend.accountManagement.apManagement.shipmentlist',compact('userdata'));
    }

    public function view($id){
        $userid = Auth::id();
        $data = User::where('user_type','agent');
        $roles = Role::pluck('name','id')->all();
        $agency = Agency::pluck('agencies_name','id')->all();
        $userdata = AssignAcPayable::where('assign_agent_to',$id)
        ->with('apassignbyuser')->with('apTeamLeader')
        ->with('apTeamAgent')->get(); 
        //$userdata = AccountPayable::where('user_id',$id)->with('apTeamAgent')->get();
        //dd($userdata);
        return view('backend.accountManagement.apManagement.view',compact('data','id','roles','agency','userdata'));
    }

    public function apshipmentlist($id){
        
        $userid = Auth::id();
        $data = User::where('user_type','agent');
        $roles = Role::pluck('name','id')->all();
        $agency = Agency::pluck('agencies_name','id')->all();
        $userdatass = AssignAcPayable::where('assign_agent_to',$id)
        ->with('apassignbyuser')->with('apTeamLeader')
        ->with('apTeamAgent')->get(); 
        

        $userdata = AssignAcPayable::where('assign_agent_to',base64_decode($id))
        ->with('getAccountPayable.getshipmentdata.getapcdata')
        ->with('apassignbyuser')->with('apTeamLeader')
        ->with('apTeamAgent')->get(); 


        $AssignAcPayable = AssignAcPayable::where('assign_agent_to',base64_decode($id))->where('ap_user',$userid)->first();
        
        if($AssignAcPayable->status == '1'){

            $shipdata = Shipment::where('user_id',base64_decode($id))->where('ap_access_status','1')
            ->with('getapcdata')->get();
       
        //dd($userdata);
        //$userdata = AccountPayable::where('user_id',$id)->with('apTeamAgent')->get();
        //dd($userdata);
        return view('backend.accountManagement.apManagement.apview',compact('data','id','roles','agency','userdata','shipdata','id'));
        }else{
            return redirect('/admin/accountap')->with('errors','You have no permission!');
        }
    }


    public function list(Request $request){
        $userid = Auth::id();
        $userdata = User::where('user_type','Agent')->orderBy('id','ASC')->get();
        $data = User::where('user_type','agent');
        $roles = Role::pluck('name','id')->all();
        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.accountManagement.apManagement.list',compact('data','roles','agency','userdata'));
    }

    public function add(Request $request){
        if($request->isMethod('post'))
        {
            $assign_id = Auth::id();
            $data = $request->all();
            $validatedData = $request->validate
            ([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'roles' => 'required'
            ]);
            
            $user = new AccountsPayable;
            $user->name	= $data['name'];
            $user->email	= $data['email'];
            $user->password	= Hash::make($data['password']);
            $user->user_type	= 'agent';
            $user->assign_id=  $assign_id;
            $user->assignto_id	= $data['assignto_id'];
            $user->officerid	= $b;

            if($user->save()){
                // $roleid = $user->assignRole($request->input('roles'));

                // $aut = new AssignUserTeam;
                // $aut->user_id	    = $user->id;
                // $aut->assignby_id	= $assign_id;
                // $aut->team_role	    = $data['roles'];
                // $aut->assignto_id	= $data['assignto_id'];
                // $aut->save();

                // $notif = new Notification;
                // $notif->user_id	    = $user->id;
                // $notif->title	    = $user->name;
                // $notif->body	    = $user->email;
                // $notif->assignto_id	= $data['assignto_id'];
                // $notif->status	    = '0';
                // $notif->save();
                
                return redirect('/admin/accountap')->with('success','Data added successfully');
            } else {
                return redirect('/admin/accountap')->with('errors',COMMON_ERROR);
            }
        }

        $userdata = User::where('user_type','officer')->orderBy('id','ASC')->get();
        $roles = Role::where('name','Agent')->get();
        $agent_id = Auth::id();
        $agency = Agency::pluck('agencies_name','id')->all();


        // $carrier = Carriers::pluck('c_company_name','id')->all();
        // $shipment = Shipment::pluck('shipment_statue','id')->all();
        // $carrac = Carrier_account::pluck('carrier_id','id')->all();
        
        $carrier = Carriers::all();
        $shipment = Shipment::all();
        $carrac = Carrier_account::all();

        $page = 'shipper';
        return view('backend.accountManagement.apManagement.form', compact('page','shipment', 'carrac',  'carrier', 'roles','agency','agent_id','userdata'));
    }

    public function  statuschanges(Request $request){
        $response = [];
        if($request->isMethod('post')){
            $data = $request->all();
            // echo '<pre>'; print_r($data); die;
            $statusid = base64_decode($data['cat']);
            if($data['curr'] == 'true'){
                $status = '1';
            } else{
                $status = '0';
            }

            $upd = AccountPayable::where('id',$statusid)->update(['status'=>$status]);
            if($upd){
                $response['status'] = 'true';
                $response['msg']    = 'Status updated successfully';
            } else{
                $response['status'] = 'false';
                $response['msg']    = COMMON_ERROR;
            }
        }
        return $response;
    }

    public function edit($id){
        $user = AccountPayable::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $agncydata = DB::table('agency_details')->where('user_id',$id)->first();
        $agencyName = Agency::pluck('agencies_name','id')->all();
        return view('backend.accountManagement.apManagement.edit',compact('user','roles','userRole','agencyName','agncydata'));
    }
 
    public function destroy($id){
        AccountPayable::find($id)->delete();
        return redirect()->url('admin/accountap')
                ->with('success','Data deleted successfully');
    }

    public function fillter(Request $request){
        $user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
        
        if($request->isMethod('get')){
            $userid = Auth::id();
            $userdata = AssignAcPayable::where('ap_user',$userid)
                ->with('getAccountPayable.getshipmentdata.getapcdata')
                ->with('apassignbyuser')->with('apTeamLeader')
                ->with('apTeamAgent')->get(); 
            $data = $request->all();        
            $apstatus = $data['ApStatus'];           
            
            $userid = Auth::id();
            $apfilltervk = (array)$apstatus;
            //you can use without array function $apfilltervk
            //you can use with normal variable like $apstatus & replace with $apfilltervk
                if(isset($apstatus)){
                    $userdata = AssignAcPayable::where('ap_user',$userid)
                    ->with('getAccountPayable.getshipmentdata.getapcdata')
                    ->whereHas('getAccountPayable.getshipmentdata', function($query) use ($userdata, $apfilltervk){
                        $query->where('shipment_statue',$apfilltervk['0']);
                    })->with('apassignbyuser')->with('apTeamLeader')
                    ->with('apTeamAgent')->get(); 
                }

                if(empty(isset($apstatus))){
                    $userdata = AssignAcPayable::where('ap_user',$userid)
                    ->with('getAccountPayable.getshipmentdata.getapcdata')
                    ->with('apassignbyuser')->with('apTeamLeader')
                    ->with('apTeamAgent')->get(); 
                }

                $shipmentload = $data['shipmentload'];
                if(isset($shipmentload)){
                    $userdata = AssignAcPayable::where('ap_user',$userid)
                    ->with('getAccountPayable.getshipmentdata.getapcdata')
                    ->whereHas('getAccountPayable.getshipmentdata', function($query) use ($userdata, $shipmentload){
                        $query->where('id',$shipmentload);
                    })->with('apassignbyuser')->with('apTeamLeader')
                    ->with('apTeamAgent')->get(); 
                }


                // $all = $data['ApStatus'];
                // if(isset($all)){
                //     $userdata = AssignAcPayable::where('ap_user',$userid)
                //     ->with('getAccountPayable.getshipmentdata.getapcdata')
                //     ->with('apassignbyuser')->with('apTeamLeader')
                //     ->with('apTeamAgent')->get(); 
                // }


                //dd($shipmentload );
            

            //echo '<pre>',print_r($userdata),'</pre>';
            $companiesData = $userdata;
            return view('backend.accountManagement.apManagement.apfillter',compact('companiesData'));
        }

    }
    
}
