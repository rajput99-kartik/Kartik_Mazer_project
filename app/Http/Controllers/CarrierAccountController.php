<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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



class CarrierAccountController extends Controller
{
   
    public $user;
    // function __construct()
    // {
    //      $this->middleware('permission:agency-list|agency-view|agency-approve|agency-create|agency-edit|agency-delete', ['only' => ['index','store']]);
    //      $this->middleware('permission:agency-approve', ['only' => ['approve','approve']]);
    //      $this->middleware('permission:agency-create', ['only' => ['create','store']]);
    //      $this->middleware('permission:agency-edit', ['only' => ['edit','update']]);
    //      $this->middleware('permission:agency-delete', ['only' => ['destroy']]);

    //      $this->middleware(function ($request, $next) {
    //         $this->user = Auth::guard('web')->user();
    //         return $next($request);
    //     });
    // }



    public function index(){
	    // if (is_null($this->user) || !$this->user->can('agency-view')) {
        //     abort(403, 'Sorry !! You are Unauthorized to view !');
        // }
        $user_id = auth()->user()->id ;
        $user = User::where('id',$user_id)->first();				
        $equipments = DB::table('equipment_types')->get();  
        // $data =  Carrier_account::all();
        $data =  Carrier_account::orderBy('id','DESC')->get();
        $page = 'Carrier Account';
        return view('backend.accountManagement.apManagement.carrierAccount.index', compact('page','data'));
    }
   
	
	/* Admin agency create form funcation start */
    //carrierac/edit
    public function add(Request $request){
        if($request->isMethod('post'))
        {
            $assign_id = Auth::id();
            $data = $request->all();
            $cmpn = $data['name'];
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


            $validatedData = $request->validate
            ([
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|same:confirm-password',
                'roles' => 'required'
            ]);
            
            $user = new User;
            $user->name	= $data['name'];
            $user->email	= $data['email'];
            $user->password	= Hash::make($data['password']);
            $user->user_type	= 'agent';
            $user->assign_id=  $assign_id;
            $user->assignto_id	= $data['assignto_id'];
            $user->officerid	= $b;

            if($user->save()){
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
                $notif->title	    = $user->name;
                $notif->body	    = $user->email;
                $notif->assignto_id	= $data['assignto_id'];
                $notif->status	    = '0';
                $notif->save();
                
                return redirect('/admin/assignuser/list')->with('success','assignuser added successfully');
            } else {
                return redirect('/admin/assignuser/list')->with('errors',COMMON_ERROR);
            }
        }

        $userdata = User::where('user_type','officer')->orderBy('id','ASC')->get();
        // $roles = Role::where('name','Agent')->get();
        // $agent_id = Auth::id();
        // $agency = Agency::pluck('agencies_name','id')->all();
        
        $page = 'Carrier Account';
        // return view('backend.userManagement.assignuser.form', compact('page','roles','agency','agent_id','userdata'));
        return view('backend.accountManagement.apManagement.carrierAccount.form', compact('page'));
    }
	
	/* Admin agency form update funcation start */	
	public function edit1(Request $request,$id){
	   
        $carrdata = Carrier_account::where('id', $id )->first();

		$user_id= Auth::id();
		if ($request->isMethod('post')){
		    $data = $request->all();				
			$carrdata = Carrier_account::where('id', $id )->first();
			
			$carrdata->payto	= $data['payto'];
            $carrdata->f_noa	= $data['f_noa'];
            $carrdata->f_comp_name	= $data['f_comp_name'];
            $carrdata->f_address	= $data['f_address'];
            $carrdata->f_city	= $data['f_city'];
            $carrdata->f_state	= $data['f_state'];
            $carrdata->f_zip	= $data['f_zip'];
            $carrdata->f_phone	= $data['f_phone'];
            $carrdata->f_fax	= $data['f_fax'];
            $carrdata->f_email	= $data['f_email'];
			$carrdata->update();
			}
		// return redirect('admin/carrierac')->with('success', 'Agency Update Successfully');	
        return view('backend.accountManagement.apManagement.carrierAccount.form', compact('carrdata','id'));
	}
	/* Admin agency form update funcation start */



    public function edit(Request $request,$id){
        $carrdata = Carrier_account::where('id',$id)->first();
        $eid = $carrdata->id ;
		
        if ($request->isMethod('post')){
            $data = $request->all();
            $this->validate($request,[ 
                // 'employee_id' => 'unique:users,employee_id,'.$eid,
            ]);            
            $carrdata->payto	    = $data['payto'];
            // $carrdata->f_noa	    = $data['f_noa'];
            $carrdata->f_comp_name	= $data['f_comp_name'];
            $carrdata->f_address	= $data['f_address'];
            $carrdata->f_city	    = $data['f_city'];
            $carrdata->f_state	    = $data['f_state'];
            $carrdata->f_zip	    = $data['f_zip'];
            $carrdata->f_phone	    = $data['f_phone'];
            $carrdata->f_fax	    = $data['f_fax'];
            $carrdata->f_email	    = $data['f_email'];

            //carrier

            $carrdata->c_comp_name	    = $data['c_comp_name'];
            $carrdata->c_address	    = $data['c_address'];
            $carrdata->c_city	= $data['c_city'];
            $carrdata->c_state	= $data['c_state'];
            $carrdata->c_zip	    = $data['c_zip'];
            $carrdata->c_phone	    = $data['c_phone'];
            $carrdata->c_fax	    = $data['c_fax'];
            $carrdata->c_email	    = $data['c_email'];

            //
            $carrdata->bank_name	    = $data['bank_name'];
            $carrdata->account_number	    = $data['account_number'];
            $carrdata->b_account_type	= $data['b_account_type'];
            $carrdata->ach_routing_number	= $data['ach_routing_number'];
            $carrdata->w_bank_name	    = $data['w_bank_name'];
            $carrdata->w_account_number	    = $data['w_account_number'];
            $carrdata->wire_b_account_type	    = $data['wire_b_account_type'];
            $carrdata->wire_routing_number	    = $data['wire_routing_number'];
            $carrdata->swift_code	    = $data['swift_code'];
            $carrdata->address	    = $data['address'];




            $files = $request->file('f_noa');
            //upload multipal file one row diffrent name with seprate comma
            $i = 0;
            if($request->hasfile('f_noa')){
                foreach ($files as $file) {                   
                    // $name = $file->getClientOriginalName();
                    //with $i help you save diffrent name file
                    $name = time() . $i . '.' . $file->getClientOriginalExtension();
                    //movie file in folder location
                    $file->move(public_path().'/backend/carrieraccount',$name);
                    $datavk[] = $name;
                    //save data in database with diffrent name with comma
                    $carrdata->f_noa	= implode(",",$datavk);
                    $i++;
                }
            }

            

            if ($carrdata->save()) {
                return redirect('/admin/carrierac/edit/'.$id)->with('success','Carrier Account Updated Successfully');
            }else{
                return redirect()->back()->with('errors',COMMON_ERROR);
            }
        }
        $page = 'carrdata';
        return view('backend.accountManagement.apManagement.carrierAccount.form', compact('carrdata','id'));

    }
	
	 
   function deleteDoc(Request $req){
        $docname = $req->docname;
        $list = Carrier_account::where('id', $req->accid)->pluck('f_noa');
        $finddoc = array($docname);
        $explodedoc = explode(',', $list);
        $docs = array_diff($explodedoc, $finddoc);
        
        $finaldoc = implode(',', $docs);
        
        return $finddoc;
   }
   
}
