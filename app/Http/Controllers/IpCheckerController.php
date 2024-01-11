<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use DB;
use Hash;
use Auth;
use App\Models\User;
use App\Models\IpChecker;
use App\Models\Notification;


class IpCheckerController extends Controller
{
    

    public function add(Request $request){
        //$ddate = date("Y-n-j ") . date("H:i:sa") ; 
        if($request->isMethod('post')){
            $company_id = Auth::id();
            $data = $request->all();
            $validatedData = $request->validate
            ([
                
                'ip_address' => 'required|max:255|unique:ip_checkers'
                // |regex:/(^[a-zA-Z]+[a-zA-Z0-9\\-]*$)/u
            ]);
            
            $ipchecker = new IpChecker;
            $ipchecker->office    	= $data['office'];
            $ipchecker->ip_address	= $data['ip_address'];
            // $ipchecker->whitelisted	= $data['whitelisted'];

            if($ipchecker->save()){
                // $notif = new Notification;
                // $notif->user_id	    = $company_id;
                // $notif->type        = 'shipper_request';
                // $notif->title	    = 'Shipper Request Approval';
                // $notif->body	    = 'Shipper approval request sent!';
                // $notif->assignto_id	= '1';
                // $notif->status	    = '0';
                // $notif->url	        = 'admin/shipper/request/edit/'.$shipper->id;
                // $notif->save();admin/setting/ip/add
                return redirect('/admin/setting/ip')->with('success','Ip address added successfully');
            } else {
                return redirect('/admin/setting/ip')->with('errors',COMMON_ERROR);
            }
        }
        $page = 'setting';
        return view('backend.settingManagement.manageIP.manage-ip', compact('page'));
        
    }
    
    
    public function ipStatus(Request $request){
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

            $upd = IpChecker::where('id',$statusid)->update(['whitelisted'=>$status]);
            if($upd){
                $response['whitelisted'] = 'true';
                $response['msg']    = 'Status updated successfully';
            } else{
                $response['whitelisted'] = 'false';
                $response['msg']    = COMMON_ERROR;
            }
        }

        return $response;
    }
}
