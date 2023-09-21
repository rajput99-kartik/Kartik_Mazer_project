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
use App\Models\ApComment;
use App\Models\ShipmentDoc;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use DB;
use Hash;
use Auth;

class ApCommentController extends Controller
{
    public function index(Request $request){
        $userid = Auth::id();
        $userdata = AssignAcPayable::where('ap_user',$userid)
        ->with('getAccountPayable.getshipmentdata.getapcdata')
        ->with('apassignbyuser')->with('apTeamLeader')
        ->with('apTeamAgent')->get(); 
        return view('backend.accountManagement.apManagement.index',compact('userdata'));
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


    public function list(Request $request){
        $userid = Auth::id();
        $userdata = User::where('user_type','Agent')->orderBy('id','ASC')->get();
        $data = User::where('user_type','agent');
        $roles = Role::pluck('name','id')->all();
        $agency = Agency::pluck('agencies_name','id')->all();
        return view('backend.accountManagement.apManagement.list',compact('data','roles','agency','userdata'));
    }

    public function fetchcommentdata(Request $request){
			$carrier_id = $request->get('carrier_id');
			$user_id = auth()->user()->id;
            $apdata =  ApComment::where('shipmentid_loadid', $carrier_id)->orderBy('created_at', 'desc')->get();

            //echo '<pre>',print_r($userdata),'</pre>';

           // dd($apdata);
            $userid = Auth::id();
            $userdata = AssignAcPayable::where('ap_user',$userid)
            ->with('getAccountPayable.getshipmentdata.getapcdata')
            ->with('apassignbyuser')->with('apTeamLeader')
            ->with('apTeamAgent')->get(); 
			//dd($userdata);
			return view('backend.accountManagement.apManagement.apcomment',compact('userdata','apdata','carrier_id'));
	}

    public function apdocumentfetch(Request $request){
        $carrier_id = $request->get('carrier_id');
        $user_id = auth()->user()->id;
        $apdata =  ShipmentDoc::where('shipment_id', $carrier_id)->where('type','ap_invoice')->orderBy('created_at', 'desc')->get();


        //echo '<pre>',print_r($userdata),'</pre>';
        $userid = Auth::id();
        $userdata = AssignAcPayable::where('ap_user',$userid)
        ->with('getAccountPayable.getshipmentdata.getapcdata')
        ->with('apassignbyuser')->with('apTeamLeader')
        ->with('apTeamAgent')->get(); 
        //dd($userdata);
        return view('backend.accountManagement.apManagement.apshipupload',compact('userdata','apdata','carrier_id'));
}

    


    public function add(Request $request){
        if($request->isMethod('post'))
        {
            $current_user_id = Auth::id();
            $data = $request->all();
            $validatedData = $request->validate
            ([
                // 'email' => 'required|email|unique:users,email',
            ]);
            
            $user = new ApComment;
            $user->current_user_id	        = $current_user_id;
            $user->ap_agentid	            = $data['ap_agentid'];
            $user->shipmentid_loadid	    = $data['shipmentid_loadid'];
            $user->description	            = $data['description'];
           
            

            if($user->save()){
                // $roleid = $user->assignRole($request->input('roles'));
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
        return redirect('/admin/accountap')->with('success','Data added successfully');
    }

    public function documentupload(Request $request){
        if($request->isMethod('post'))
        {
            $current_user_id = Auth::id();
            $data = $request->all();
            $validatedData = $request->validate
            ([
                // 'email' => 'required|email|unique:users,email',
            ]);

            $apinvoice = 'ap_invoice';
            $user                   = new ShipmentDoc;
            $user->user_id	        = $current_user_id;
            $user->shipment_id	    = $data['shipmentid'];   
            $user->type	            = $apinvoice;   

            $files = $request->file('image_path');
            //upload multipal file one row diffrent name with seprate comma
            $i = 0;

            if($request->hasfile('image_path')){
                foreach ($files as $file) {                   
                    // $name = $file->getClientOriginalName();
                    //with $i help you save diffrent name file
                    $name = time() . $i . '.' . $file->getClientOriginalExtension();
                    //movie file in folder location
                    $file->move(public_path().'/backend/shipment_doc/',$name);
                    $datavk[] = $name;
                    //save data in database with diffrent name with comma
                    $user->document_name	= implode(",",$datavk);
                    $i++;
                }
            }

            if($user->save()){

               $AccountsPayable =  AccountsPayable::where('shipment_id', $data['shipmentid'])->update(['aging_status' => '1', 'aging_date' => date("Y-m-d") ]);

                return redirect('/admin/accountap')->with('success','Data added successfully');
            } else {
                return redirect('/admin/accountap')->with('errors',COMMON_ERROR);
            }
        }
        return redirect('/admin/accountap')->with('success','Data added successfully');
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
                    ->whereHas('getAccountPayable.getshipmentdata', function($query) use ($userdata, $apfilltervk){
                        $query->where('shipment_statue',$apfilltervk['0']);
                    })->with('apassignbyuser')->with('apTeamLeader')
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

            //echo '<pre>',print_r($userdata),'</pre>';
            $companiesData = $userdata;
            return view('backend.accountManagement.apManagement.apfillter',compact('companiesData'));
        }

    }
}
