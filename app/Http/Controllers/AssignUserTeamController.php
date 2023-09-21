<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use DB;
use Mail;
use Hash;
use Auth;
use App\Models\User;
use App\Models\Agency;
use App\Models\Agency_detail;
use App\Models\Notification;
use App\Models\AssignUserTeam;


class AssignUserTeamController extends Controller
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

         if (is_null($this->user) || !$this->user->can('uagent-list')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        
        $userid = Auth::id();
        //dd($userid);
        $userdata = User::where('assignto_id',$userid)->orderBy('id','DESC')->get();
        $data = User::where('user_type','agent');
        $roles = Role::pluck('name','id')->all();
        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.userManagement.assignuser.index',compact('data','roles','agency','userdata'));
    }

    public function list(Request $request){
         if (is_null($this->user) || !$this->user->can('uagent-view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        
        $userid = Auth::id();
        $user = User::where('id',$userid)->first();
        if($user->user_type == 'super_admin'){
            
            $userdata = User::where('user_type','Agent')->orderBy('id','DESC')->get();
        }else{
            $userdata = User::where('assignto_id',$userid)->orderBy('id','DESC')->get();
        }
        

        $data = User::where('user_type','agent');
        $roles = Role::pluck('name','id')->all();
        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.userManagement.assignuser.list',compact('data','roles','agency','userdata','user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function add(Request $request){
        if (is_null($this->user) || !$this->user->can('uagent-create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        
        if($request->isMethod('post'))
        {
            $validatedData = $request->validate
            ([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'roles' => 'required'
            ]);

            $assign_id = Auth::id();
            $data = $request->all();
            
            $mailname = $data['name'];
            $cmpn = $data['name'];
            $bc =    Str::replace('8.x', '9.x', $cmpn);
            $string = $cmpn.$bc;
            $generated = Str::random(8);

            function initials($str) {
                $ret = '';
                foreach (explode(' ', $str) as $word)
                    $ret .= strtoupper($word[0]);
                return $ret;
            }
            $st = initials($string);
            $a  = uniqid($st, '7');
            $b  = substr($a, 0, 7);

            
            $user = new User;
            $user->name	= $data['name'];
            $user->email	= $data['email'];
            $user->phone	= $data['phone'];
            $user->password	= Hash::make($generated);
            $user->user_type	= 'agent';
            $user->assign_id=  $assign_id;
            $user->assignto_id	= $data['assignto_id'];
            $user->officerid	= $b;

            if($user->save()){

                $data1 = array('to'=>$request->input('email'),'password'=>$generated, 'name'=>$mailname);
                        Mail::send('emails.user.restpassword', $data1, function($message) use ($data1) {
                        $message->to($data1['to'], 'AMB Logistic')->subject
                            ('TMS Login Created');
                        });


                $roleid = $user->assignRole($request->input('roles'));

                $aut = new AssignUserTeam;
                $aut->user_id	    = $user->id;
                $aut->assignby_id	= $assign_id;
                $aut->team_role	    = $data['roles'];
                $aut->assignto_id	= $data['assignto_id'];
                $aut->save();

                $notif = new Notification;
                $notif->user_id	    = $user->id;
                $notif->type        = 'user_assign';
                $notif->title	    = 'User assign '.$user->name;
                $notif->body	    = 'Name: '.$user->name.',Email: '.$user->email;
                $notif->assignto_id	= $data['assignto_id'];
                $notif->status	    = '0';
                $notif->url	        = 'admin/assignuser/list';
                $notif->save();

                // $data = $request->input('agencies_name');
                // $dd = implode(' ',$data); 
                $team_role = $request->input('roles');  

                $data = $request->input('assignto_id');  
                $id =  $data;
                // $data = $request->input('agencies_name');  
                $agid = Agency_detail::where('user_id', $id)->first('agency_id');
                $agid =   $agid->agency_id ;

                $agName = Agency::where('id', $agid)->first('agencies_name');
                $agencyName = $agName->agencies_name;


                $answer = Agency_detail::create([
                    'user_id'   => $user->id,
                    'agency_id' => $agid,
                    'team_role' => $team_role,
                    ]);
                    
                
                return redirect('/admin/assignuser/add')->with('success','Assignuser added successfully');
            } else {
                return redirect('/admin/assignuser/add')->with('errors',COMMON_ERROR);
            }
        }

        $userdata = User::where('user_type','officer')->orderBy('id','desc')->get();
        $roles = Role::where('name','Agent')->get();
        $agent_id = Auth::id();
        $agency = Agency::pluck('agencies_name','id')->all();
        $page = 'shipper';

            $curretn_user = Auth::id();
            $id =  $curretn_user ;
            $agid = Agency_detail::where('user_id', $id)->first('agency_id');
            // $idagid =   $agid->agency_id ;

            $authdata = User::where('id', $curretn_user)->first();
            // dd($authdata);
            if($authdata->user_type=='super_admin'){
                $aginfo = Agency_detail::all();
            }else{
                $aginfo = Agency_detail::where('agency_id',  $agid->agency_id)->get();
            }
        return view('backend.userManagement.assignuser.form', compact('page','roles','agency','agent_id','userdata','aginfo'));
    }

    public function create(){
        $roles = Role::pluck('name','id')->all();
        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.userManagement.assignuser.create',compact('roles','agency'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    public function store(Request $request){
        
        if (is_null($this->user) || !$this->user->can('uagent-view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        
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
     
    public function show(Request $request, $assignuser_id)
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
    public function editold($id)
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
    
    public function edit(Request $request, $assignuser_id){
        
        $id = $assignuser_id ;
        
        if($request->isMethod('post'))
        {
            $current_user_id = Auth::id();
            $data = $request->all();
            $validatedData = $request->validate
            ([
                // 'email' => 'required|email|unique:users,email',
                'email' => 'required|email|unique:users,email,'.$id,
                'password' => 'confirmed'
                // 'password' => 'required|confirmed|min:6'
            ]);

            
            $userdata = User::where('id',$id)->first();
            $userdata->name	    = $data['name'];
            $userdata->email	= $data['email'];
            $userdata->phone	= $data['phone'];
            $userdata->password	= $data['password'];
            $userdata->save();
           
            if($userdata->save()){
                return redirect('/admin/assignuser')->with('success','User Agent updated successfully');
            } else {
                return redirect('/admin/assignuser/list')->with('errors',COMMON_ERROR);
            }
        }
        $user_id= Auth::id();
        $userdata = User::where('id',$id)->first();        
        return view('backend.userManagement.assignuser.update', compact('user_id','id','userdata'));

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
    public function delete($assignuser_id)
    {        
        $userid = Auth::id();
        $user = User::where('id',$userid)->first();
        if($user->user_type == 'super_admin'){

            $forceDelete = User::where('id', $assignuser_id)->forceDelete();
            // User::where('user_id',$assignuser_id)->delete();
            AssignUserTeam::where('user_id',$assignuser_id)->delete();
            Agency_detail::where('user_id',$assignuser_id)->delete();
            Notification::where('user_id',$assignuser_id)->delete();
            
            return redirect('admin/assignuser/list')
                        ->with('success','User deleted successfully');
        }else{
            $forceDelete = User::where('id', $assignuser_id)->forceDelete();
            // User::where('user_id',$assignuser_id)->delete();
            AssignUserTeam::where('user_id',$assignuser_id)->delete();
            Agency_detail::where('user_id',$assignuser_id)->delete();
            Notification::where('user_id',$assignuser_id)->delete();
            return redirect('admin/assignuser')
                        ->with('success','User deleted successfully');
                
        }
        
    }
}
