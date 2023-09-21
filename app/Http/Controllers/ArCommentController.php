<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\ArComment;
use App\Models\AssignAcReceivable;
use eloquentFilter\QueryFilter\ModelFilters\ModelFilters;
use DB;
use Hash;
use Auth;

class ArCommentController extends Controller
{
    //

    public function PaymentComment(Request $request){
        $carrier_id = $request->get('carrier_id');
        $user_id = auth()->user()->id;
        $ardata =  ArComment::where('shipmentid_loadid', $carrier_id)->orderBy('created_at', 'desc')->get();

        //echo '<pre>',print_r($userdata),'</pre>';

       // dd($apdata);
        $userid = Auth::id();
        $userdata = AssignAcReceivable::where('ar_user',$userid)
        ->with('accountShipments.getShipments.shipmentPrice')->with('accountShipments.getCompany')
        ->with('arTeamLeader')->with('arAssignbyuser')->with('arTeamAgent')->get(); 
        //dd($carrier_id);
        return view('backend.accountManagement.arManagement.arcomment',compact('userdata','ardata','carrier_id','userid'));
    }


    public function PaymentCommentSubmit(Request $request){
        
            $current_user_id = Auth::id();
            $data = $request->all();
            $validatedData = $request->validate
            ([
                // 'email' => 'required|email|unique:users,email',
            ]);
            //dd($data);

            $user = new ArComment;
            $user->current_user_id	        = $current_user_id;
            $user->ar_agentid	            = $data['user_id'];
            $user->shipmentid_loadid	    = $data['carrier_id'];
            $user->description	            = $data['description'];
           
            
            $userid = Auth::id();
            $carrier_id = $data['carrier_id'];
           

            $userdata = AssignAcReceivable::where('ar_user',$userid)
            ->with('accountShipments.getShipments.shipmentPrice')->with('accountShipments.getCompany')
            ->with('arTeamLeader')->with('arAssignbyuser')->with('arTeamAgent')->get();

            if($user->save()){
                
                $ardata =  ArComment::where('shipmentid_loadid', $carrier_id)->orderBy('created_at', 'desc')->get();
                return view('backend.accountManagement.arManagement.arcomment',compact('userdata','ardata','carrier_id','userid'));

            } else {
                return redirect('/admin/accountap')->with('errors',COMMON_ERROR);
            }
        
        
    }

    public function TlCheckComment(Request $request){
        
        $current_user_id = Auth::id();
        $data = $request->all();


    
    }


}
