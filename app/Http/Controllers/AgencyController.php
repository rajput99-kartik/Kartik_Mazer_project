<?php
namespace App\Http\Controllers;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agency;
use App\Models\Agency_detail;
use App\Models\Carriers;
use App\Models\Notification;

class AgencyController extends Controller
{
	
	
	public $user;
    function __construct()
    {
         $this->middleware('permission:agency-list|agency-view|agency-approve|agency-create|agency-edit|agency-delete', ['only' => ['index','store']]);
         $this->middleware('permission:agency-approve', ['only' => ['approve','approve']]);
         $this->middleware('permission:agency-create', ['only' => ['create','store']]);
         $this->middleware('permission:agency-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:agency-delete', ['only' => ['destroy']]);

         $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
	
	public function index(){
	    if (is_null($this->user) || !$this->user->can('agency-view')) {
            abort(403, 'Sorry !! You are Unauthorized to view !');
        }
        $user_id = auth()->user()->id ;
        $user = User::where('id',$user_id)->first();				
        $equipments = DB::table('equipment_types')->get();  
        $cdata = Carriers::where('user_id',$user_id)->orderBy('id','DESC')->get();
        		
        $userid = Auth::id();
		$user = User::where('id',$userid)->first();
		if($user->user_type == 'super_admin'){
			$agency_data = Agency::orderBy('id','DESC')->get();
		}else{
			$agency_data = Agency::where('user_id',$user_id)->orderBy('id','DESC')->get();
		}

		$active = 'companies';
        $page = 'Agency';
        return view('backend.agencyManagement.agency.index', compact('page','equipments','cdata','agency_data'));
    }
	
	/* Admin agency create form funcation start */
	 public function create(Request $request){
        $page = 'Agency';
        return view('backend.agencyManagement.agency.create', compact('page'));
    }
	/* Admin agency create form funcation end */

	/* Admin agency create form submit funcation start */	
		public function agency_add(Request $request){
			if (is_null($this->user) || !$this->user->can('agency-create')) {
				abort(403, 'Sorry !! You are Unauthorized to view !');
			}
			
			if($request->isMethod('post'))
			{
					$user_id = Auth::id();
					//dd($user_id);
					$data = $request->all();
					$validatedData = $request->validate
					([	
						'office' => 'required',
						'name' => 'required',
						'email' => 'required',
						'p_email' => 'required',
						'phone' => 'required'
					]);
					
				$agency = new Agency;
				$agency->agencies_name	= $data['office'];
				$agency->name	= $data['name'];
				$agency->p_email	= $data['email'];
				$agency->agencies_phone	= $data['phone'];
				$agency->agencies_email	= $data['p_email'];

				$agency->user_id 	= $user_id; 
				if($agency->save()){

					$usname = auth()->user()->name;
					$usid = auth()->user()->id;

					$notif = new Notification;
					$notif->user_id	    = $usid;
					$notif->title	    = "Create New Office";
					$notif->body	    = $data['name'];
					$notif->assignto_id	= '1';
					$notif->status	    = '0';
					$notif->url	        = 'admin/agency';
					$notif->save();


					return redirect('/admin/agency')->with('success','Agency added successfully');
				}else{
					return redirect('/admin/agency')->with('errors',COMMON_ERROR);
				}

			$page = 'Agency';
			return view('backend.agencyManagement.agency', compact('page'));
			}	
		}
	/* Admin agency create form submit funcation end */
	
	/* Admin agency form details funcation start */	
	public function agency_details(Request $request){
		$agency_id = $request->get('agency_id');
		$data = DB::table('agencies')->where('id',$agency_id)->first();  
		return view('backend.agencyManagement.agency.edit',['data'=>$data]);
	}
	/* Admin agency form details funcation start */
	
	/* Admin agency form update funcation start */	
	public function agency_update(Request $request){
	    if (is_null($this->user) || !$this->user->can('agency-edit')) {
            abort(403, 'Sorry !! You are Unauthorized to view !');
        }
		$user_id= Auth::id();
		if ($request->isMethod('post')){
		$data = $request->all();
		
		$validatedData = $request->validate
				([	
					'office' => 'required',
					'name' => 'required',
					'p_email' => 'required',
					'email' => 'required',
					'phone' => 'required'
				]);

				
			$agency_details = Agency::where('id',$data['agency_id'])->first();
			
			$agency_details->agencies_name	= $data['office'];
            $agency_details->name	= $data['name'];
            $agency_details->p_email	= $data['email'];
            $agency_details->agencies_email	= $data['p_email'];
            $agency_details->agencies_phone	= $data['phone'];
			$agency_details->save();
			}
			
			

		return redirect('admin/agency')->
					with('success', 'Agency Update Successfully');	
	}
	/* Admin agency form update funcation start */
	
	/* Admin agency manage funcation start */	
	public function agency_manage(Request $request){
		$data  = Agency::with('office.officData')->get();
		//dd($data);
		// $agencies = DB::table('agency_details as agency_detail')
        //     ->leftJoin('users as us', 'agency_detail.user_id', '=', 'us.id')  
        //     ->leftJoin('agencies as ag', 'agency_detail.agency_id', '=', 'ag.id')
        //     ->leftJoin('roles as rls', 'agency_detail.team_role', '=', 'rls.id')
		// 	->select('us.id','us.name','us.email','rls.name as rlname','ag.id as agid','ag.agencies_name as agname')
        //     ->get();
		$page = 'Agency';
        return view('backend.agencyManagement.agency.agency_manage', compact('page','data'));
	}
	/* Admin agency manage funcation end */	
	
	
	/* Admin agency manage edit funcation start */	
	public function manage_edit(Request $request){
		$agencies = Agency::orderBy('id','DESC')->get();
        $userRoles = User::orderBy('id','DESC')->get();
		//print_r($agencies);die;
		$page = 'Agency';
        return view('backend.agencyManagement.agency.manage_edit', compact('page','agencies','userRoles'));
	}
	/* Admin agency manage edit funcation start */	
	
	
	/* Admin agency manage form submit funcation start */	
	public function manage_submit(Request $request){
		if($request->isMethod('post'))
		{
				
				$user_id = Auth::id();

				//dd($user_id);
			$data = $request->all();
			
				$validatedData = $request->validate
				([	
					'agencies' => 'required',
					'user' => 'required',
				]);
				
				
				 $agency_detail = new Agency_detail;

            $agency_detail->agency_id	= $data['agencies'];
            $agency_detail->user_id	= $data['user'];


            if($agency_detail->save()){
                return redirect('/admin/agency/manage')->with('success','Agency added successfully');
            } else {

                return redirect('/admin/agency/manage')->with('errors',COMMON_ERROR);
            }

			
		}
		
	}
	/* Admin agency manage form submit funcation end */	
		
		
	// for manager agency data and show like office type

	
	public function officedata(Request $request,$id){
	    
	    if (is_null($this->user) || !$this->user->can('agency-view')) {
				abort(403, 'Sorry !! You are Unauthorized to view !');
			}
			
				$id = base64_decode($id); 
			    $id = substr("$id",11);
			
		$datanew  = Agency::with('office.officData')->get();
		$data = Agency::where('id',$id)->with('office.officData')->get();
		
		//dd($data);
		$page = 'Manager List';
        return view('backend.agencyManagement.agency.manage.index', compact('page','data'));
	}

	public function agentdata(Request $request,$id){
	    if (is_null($this->user) || !$this->user->can('agency-view')) {
				abort(403, 'Sorry !! You are Unauthorized to view !');
			}
			
				$id = base64_decode($id); 
			    $id = substr("$id",15);
		$item = User::where('assignto_id',$id)->get();

		$page = 'Manager List';
        return view('backend.agencyManagement.agency.manage.agent', compact('page','item','id'));
	}


	

	public function newoffice(Request $request){
		$data  = Agency::with('office.officData')->get();
		//$item = User::where('assignto_id',$id)->get();
		$page = 'Manager List';
        return view('backend.agencyManagement.agency.manage.newoffice', compact('page','data'));
	}

	
	
	public function managerdata(Request $request,$id){
		$data  = Agency::with('office.officData')->get();	
		$dataitem = Agency::where('id',$id)->with('office.officData')->get();
		//dd($dataitem);
		//$item = User::where('assignto_id',$id)->get();
		$page = 'Manager List';
        return view('backend.agencyManagement.agency.manage.view', compact('page','data','dataitem'));
	}
		
		
}
