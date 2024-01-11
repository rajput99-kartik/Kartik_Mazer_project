<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Userdetail;
use App\Models\Agency;
use App\Models\Agency_detail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Str;
use DB;
use Hash;
use Mail;
use Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Crypt;


use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportUser;
use App\Exports\ExportUser;


class UserTypeController extends Controller
{
    public $user;
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-approve', ['only' => ['approve','approve']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);


         $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //this is normal add funtion 
   

    //this is special add data with role permission to add role and assign value admin 
    public function index(Request $request)
    {
       
            $admin = User::where('username', 'superadmin')->first();
       
        
        $userid = Auth::id();
        $user = User::find($userid);
        $data = User::with('userDetailsdata')->get();
        $total = User::count();
        $totalagent = User::where('user_type','agent')->count();
        $active = User::where('status','1')->count();
        $unactive = User::where('status','0')->count();
        $admin = User::where('user_type','admin')->count();
        

        //dd($total);

        return view('backend.userManagement.users.index',compact('data','total','totalagent','active','unactive','admin'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $roles = Role::pluck('name','id')->all();
        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.userManagement.users.create',compact('roles','agency'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store36(Request $request)
    {
        $user_id = Auth::id();
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $input                  =    new User;
        $input->name	        =  $request->input('name');
        $input->email	        =  $request->input('email');
        $input->password	    =  $request->input('password');
        // $input->assignRole($request->input('roles'));
        $input->save()  ;
        $rid = $input->assignRole($request->input('roles'));
        $team_role  = $rid->id;
        
        $data = $request->input('agencies_name');
        $dd = implode(' ',$data); 
            //dd($dd );
        if($input->save()){
            $agency =               new Agency_detail;
            $agency->user_id	    =  $input->id;
            $agency->team_role	    =   $team_role;
            $agency->agency_id	    =   $dd;
            $agency->save()   ;

            return redirect()->route('users.index')
            ->with('success','User created successfully');
        } else {
            return redirect('/admin/users')->with('errors',COMMON_ERROR);
        }       
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'user_type' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
        //die('here');
        $input = $request->all();
        
            $cmpn = $input['name'];
            $bc =    Str::replace('8.x', '9.x', $cmpn);
            $string = $cmpn.$bc;

            function initials($str) {
                $ret = '';
                foreach (explode(' ', $str) as $word)
                    $ret .= strtoupper($word[0]);
                return $ret;
            }
            $st = initials($string);
            $a  = uniqid($st, '7');
            $b  = substr($a, 0, 7);

        $generated = Str::random(8);
        $input['password'] = Hash::make($generated);
        $input['user_type'] =$input['user_type'];
        $input['status'] = $input['status'];
        $input['officerid'] = $b;

        $user = User::create($input);
        $roleid = $user->assignRole($request->input('roles'));

        $rid = $request->input('roles');
        $team_role  = implode(' ',$rid);
        $data = $request->input('agencies_name');
        $agency_id = implode(' ',$data);
        

        
        $data1 = array('to'=>$input['email'],'password'=>$generated);
                        Mail::send('emails.user.restpassword', $data1, function($message) use ($data1) {
                        $message->to($data1['to'], 'AMB Logistic')->subject
                            ('TMS Login Created');
                        });

        //dd($agency_id);
        

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
    public function show($id)
    {
        // $userid = Crypt::decrypt($id);
        $userid = base64_decode($id);
        $user = User::find($userid);
        $agncydata = DB::table('agency_details')->where('user_id',$userid)->first();
        return view('backend.userManagement.users.show',compact('user','agncydata'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $userid = base64_decode($id);
        $user = User::find($userid);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();
        $agncydata = DB::table('agency_details')->where('user_id',$userid)->first();
        // $user_type = DB::table('users')->where('user_id',$id)->first();
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
        $id = base64_decode($id);
        
        $this->validate($request, [
            'name' => 'required',
            'user_type' => 'required',
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
    
    public function view_profile(){
        $userid = Auth::id();
        $userdata = User::where('id', $userid)->first();
        $userdetail = Userdetail::where('userid', $userid)->first();
        return view('users/profile', compact('userdata', 'userdetail'));
    }
    
    
    
    public function update_profile(Request $request){
        $userid = Auth::id();
        $edituser = User::where('id', $userid)->first();
        $edituser->name = $request->username;
        $edituser->email = $request->useremail;
        $edituser->phone = $request->userphone;
        $saveuser = $edituser->save();
        if($saveuser){
            if($request->hasfile('profile_new_pic')){
                $file = $request->file('profile_new_pic');
                $name = time().$file->getClientOriginalName();
                $path = $file->move(public_path() . '/user-pic/', $name);
                $profilepic = $name;
            }else{
                $profilepic = $request->profile_pic;
            }
            $usertetail = Userdetail::where('userid', $userid)->first();
            if($usertetail){
                $usertetail->userid = $userid;
                $usertetail->profile_pic = $profilepic;
                $usertetail->address = $request->address;
                $usertetail->mobile = $request->mobile;
                $usertetail->ext = $request->ext;
                $usertetail->save();
            }else{
                $addusertetail = new Userdetail;
                $addusertetail->userid = $userid;
                $addusertetail->profile_pic = $profilepic;
                $addusertetail->address = $request->address;
                $addusertetail->mobile = $request->mobile;
                $usertetail->ext = $request->ext;
                $addusertetail->save();
            }
            return back()->with('success','Profile Update successfully');
        }
    }


    public function userprofiledatasubmit(Request $request){

        //$id= Auth::id();
        //  $id = $request->user_id;
         
        // $id = base64_decode($id);
        // $input = $request->all();
        // $user = User::find($id);
        // $user->update($input);
        // return back()->with('success','Profile Update successfully');


        // $userid = Auth::id();
        
        $userid = $request->get('user_id');
        $data = $request->all();
        $edituser = User::where('id', $userid)->first();
      
        $edituser->gender= $data['gender'];
        $edituser->dob = $data['dob'];
        $edituser->marrid = $data['marrid'];
        $edituser->father_name = $data['father_name'];
        $edituser->mother_name = $data['mother_name'];
        $edituser->parmanent_address = $data['parmanent_address'];
        $saveuser = $edituser->save();

       // dd($saveuser);
        return back()->with('success','Profile Update successfully');
    }


    public function userprofiledata(Request $request){
		$userdata = $request->get('userprofileid');
		$data = DB::table('users')->where('id',$userdata)->first();  
		return view('backend.userManagement.users.useredit',['data'=>$data]);
	}

    public function changeuserStatus1254(Request $request){
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

            $upd = User::where('id',$statusid)->update(['status'=>$status]);
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


    public function changeuserStatus(Request $request){
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

            $upd = User::where('id',$statusid)->update(['status'=>$status]);
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

    
    
    function trashedUser(){
        $data = User::onlyTrashed()->get();
        return view('backend.userManagement.users.trashd-user',compact('data'));
    }
    
    function restoreUser($id){
        
        $restore = User::where('id', $id)->restore();
        if($restore){
            return redirect()->route('users.index')
            ->with('success','User Restored successfully');
        }
    }
    
    function deleteUser($id){
        $forceDelete = User::where('id', $id)->forceDelete();
        if($forceDelete){
            return redirect()->route('users.index')
            ->with('success','User Deleted successfully');
        }
    }
    
    
    public function userout(Request $request){
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        if ($response = $this->loggedOut($request)) {
            return $response;
        }
        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
    
    function change_user_password(Request $request){
        $user_id = $request->userid;
        $edituser = User::where('id', $user_id)->first();
        $password = Hash::make($request->password);
        $edituser->password = $password;
        if($edituser->save()){
            return back()->with('success','Profile Update successfully');
        }
    }
    
    
    //emport exprot users 
    
    public function importView(Request $request){
        return view('importFile');
    }

    public function import(Request $request){
        Excel::import(new ImportUser, $request->file('file')->store('files'));
        return redirect()->back();
    }

    public function exportUsers(Request $request){
        return Excel::download(new ExportUser, 'users.csv');
    }
}
