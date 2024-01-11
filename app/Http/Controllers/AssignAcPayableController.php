<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\User;
use App\Models\Agency;
use App\Models\Agency_detail;
use App\Models\Notification;
use App\Models\AssignUserTeam;
use App\Models\AssignAcPayable;
use App\Models\Shipment;
use App\Models\AccountsPayable;

use DB;
use Hash;
use Auth;

class AssignAcPayableController extends Controller
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
        
        if (is_null($this->user) || !$this->user->can('uagent-view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        
        $userid = Auth::id();

        $userdata = AssignUserTeam::where('assignto_id',$userid)->get();
        

        $userdataOld = AssignAcPayable::where('user_id',$userid)
        ->with('apassignbyuser')->with('apTeamLeader')
        ->with('apTeamAgent')->get();    

        // $userdata = AssignAcPayable::where('user_id',$userid)
        // ->with('getAccountPayable.getshipmentdata.getapcdata')
        // ->with('apassignbyuser')->with('apTeamLeader')
        // ->with('apTeamAgent')->get(); 

        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.accountManagement.assignApManage.index',compact('agency','userdata'));
    }

    
     public function AssignAllShipment(Request $request){
        
        if (is_null($this->user) || !$this->user->can('uagent-view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        
        $userid = Auth::id();
        $userdata = AssignUserTeam::where('assignto_id',$userid)->get();
        
        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.accountManagement.assignApManage.assignshipment',compact('agency','userdata'));
    }
    
    
    
    
    public function ApagentBrokerList(Request $request){
        $userid = Auth::id();

        $userdata = AssignAcPayable::get();

        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.accountManagement.assignApManage.apindex',compact('agency','userdata'));
        //dd($userlist);
    }


            

    public function list(Request $request){
        if (is_null($this->user) || !$this->user->can('uagent-list')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        
        $userid = Auth::id();
        $userdata = AssignAcPayable::with('apassignbyuser')->with('apTeamLeader')
        ->with('apTeamAgent')->get();        
        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.accountManagement.assignApManage.list',compact('agency','userdata'));
    }

    


    public function teamleaderindex(Request $request){
        $userid = Auth::id();
        $userdata = AssignAcPayable::where('assign_by',$userid)
        ->with('apassignbyuser')->with('apTeamLeader')
        ->with('apTeamAgent')->get();        
        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.accountManagement.assignApManage.index',compact('agency','userdata'));
        
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function add(Request $request){

        $current_userid = Auth::id();
        if($request->isMethod('post'))
        {
            $data = $request->all();
            $validatedData = $request->validate
            ([
                // 'name' => 'required',
                // 'email' => 'required|email|unique:users,email',
                // 'password' => 'required|same:confirm-password',
                // 'roles' => 'required'
            ]);
            
            $user = AssignAcPayable::where('ap_user',$data['assign_by'])->Where('assign_agent_to',$data['assign_to'])->get();
            $user =  count($user);
            //dd($user);
            
          if($user < 1 ){
                $user = new AssignAcPayable;
                $user->assign_by        =  $current_userid;
                $user->user_id          =  $current_userid;
                $user->ap_user	        = $data['assign_by'];
                $user->assign_agent_to	= $data['assign_to'];
                // $user->officerid	= $b;
    
                if($user->save()){
                    $notif = new Notification;
                    $notif->user_id	    = $user->id;
                    $notif->title	    = "New Ap Assign Data";
                    $notif->body	    = $user->assign_to;
                    $notif->assignto_id	= $data['assign_by'];
                    $notif->status	    = '0';
                    $notif->save();
                    return redirect('/admin/assign/apagent/brokerlist')->with('success','Data Added successfully');
                } else {
                    return redirect('/admin/assign/apagent/brokerlist')->with('errors',COMMON_ERROR);
                }
            }
             return redirect('/admin/assign/apagent/brokerlist')->with('danger','Alrady Exist This User');
        }
        //  $userdata = User::where('user_type','ap')->orWhere('user_type','ar')->orderBy('id','ASC')->get();
        $userdata = User::where('user_type', 'like', 'ap%')
                ->orWhere('user_type', 'like', 'accountant%')
                ->get();

        //$agent = AssignUserTeam::where('assignto_id',$current_userid)->with('getagent')->get();
        $agent = User::where('user_type','officer')->orwhere('user_type','agent')->get();
        
        $roles = Role::where('name','Agent')->get();
        $agent_id = Auth::id();
        $agency = Agency::pluck('agencies_name','id')->all();
        $page = 'shipper';
        return view('backend.accountManagement.assignApManage.form', compact('page','roles','agency','agent_id','userdata','agent'));
    }

    public function detailtlist($id){
        //dd(base64_decode($id));
        $userid = Auth::id();
        $data = User::where('user_type','agent');
        $roles = Role::pluck('name','id')->all();
        $agency = Agency::pluck('agencies_name','id')->all();
        $userdatass = AssignAcPayable::where('assign_agent_to',base64_decode($id))
        ->with('apassignbyuser')->with('apTeamLeader')
        ->with('apTeamAgent')->get(); 

        // $userdata = AssignAcPayable::where('assign_agent_to',base64_decode($id))
        // ->with('getAccountPayable.getshipmentdata.getapcdata')
        // ->with('apassignbyuser')->with('apTeamLeader')
        // ->with('apTeamAgent')->get();

        $userdata = Shipment::where('user_id',base64_decode($id))->get();

        $shipdata = Shipment::where('user_id',base64_decode($id))
        ->with('getapcdata')->get(); 
       
        
        //$userdata = AccountPayable::where('user_id',$id)->with('apTeamAgent')->get();
        //dd($userdata);
        return view('backend.accountManagement.assignApManage.details',compact('data','id','roles','agency','userdata','shipdata','id'));


        
    }

    public function create()
    {        
        $roles = Role::pluck('name','id')->all();
        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.accountManagement.assignApManage.create',compact('roles','agency'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $user = User::create($input);
        $roleid = $user->assignRole($request->input('roles'));

        $rid = $request->input('roles');
        $team_role  = implode(' ',$rid);
        $data = $request->input('agencies_name');
        $agency_id = implode(' ',$data); 

        $answer = Agency_detail::create([
        'user_id'   => $user->id,
        'agency_id' => $agency_id,
        'team_role' => $team_role,
        ]);

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($assignuser_id)
    {

        $userid = Auth::id();
            //dd($userid);
        $userdata = User::where('assignto_id',$userid)->orderBy('id','ASC')->get();

        $user = User::find($assignuser_id);
        return view('backend.userManagement.users.show',compact('user','assignuser_id','userdata'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $agncydata = DB::table('agency_details')->where('user_id',$id)->first();
        // agency_details 
        //dd($agncydata);
         $agencyName = Agency::pluck('agencies_name','id')->all();
        return view('backend.userManagement.users.edit',compact('user','roles','userRole','agencyName','agncydata'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
        $user->assignRole($request->input('roles'));

        $inputagency = $request->all();
        Agency_Detail::where('user_id', $id)->update(['agency_id' => $inputagency['agencies_name']]);

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }



    
    public function changeuserStatus(Request $request){
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
            $shipmentget->ap_access_date = date('Y-m-d');
            $shipmentget->ap_access_status = $status;
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



    public function changeuserApaccess(Request $request){
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

            $upd = AssignAcPayable::where('assign_agent_to',$statusid)->update(['status'=>$status]);
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



}
