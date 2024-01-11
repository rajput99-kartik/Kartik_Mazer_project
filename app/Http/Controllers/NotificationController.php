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
use App\Models\Agency;
use App\Models\Agency_detail;
use App\Models\Notification;
use App\Models\AssignUserTeam;
use App\Models\CarrierRequest;
use App\Models\Shipper_request;
use App\Models\LoadComment;

class NotificationController extends Controller
{

    public function index(Request $request){
       // dd('hello');
        $inputagency = $request->all();
        // $ntf_data = Notification::where('id', $nid)->update(['status' => '1']);
        // $ndata = Notification::All();
        $current_userid = Auth::id();

        // $notification_data = Notification::where('id', $nid)->get();
        $notification_data = Notification::where('assignto_id',$current_userid)->paginate(10);
        $notification_count = $notification_data->count();
        $userdata =  $notification_data;
        //dd($notification_data);
        return view('backend.notification.index',compact('userdata'));
    }
	
	public function notificationMesssage(Request $request){
		
		$user_id = Auth::id();
		
		$message_data = CarrierRequest::where('receiver_id',$user_id)->orwhere('sender_id',$user_id)->orderBy('id','DESC')->get();
		
		return view('backend.notification.carriermsg',compact('message_data'));
	
	}
	
	public function notificationShipper(Request $request){
		
		$user_id = Auth::id();
		
		$message_data = Shipper_request::where('receiver_id',$user_id)->orwhere('sender_id',$user_id)->orderBy('id','DESC')->get();
		
		return view('backend.notification.shippermsg',compact('message_data'));
	
	}
	
	public function notificationLoad(Request $request){
		
		$user_id = Auth::id();
		
		$message_data = LoadComment::where('receiver_id',$user_id)->orwhere('sender_id',$user_id)->orderBy('id','DESC')->get();
		
		return view('backend.notification.loadmsg',compact('message_data'));
	
	}
	
	
    
    public function notifyStatus(Request $request){
        $response = [];
        if($request->isMethod('post')){
            $data = $request->all();
            // echo '<pre>'; print_r($data); die;
            
            

            if($data['curr'] == 'true'){
                $status = '1';
            } else{
                $status = '0';
            }
            
            $upd = Notification::where('id',$statusid)->update(['status'=>$status]);
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
    

    public function notification_assignuser(Request $request, $nid){
        $inputagency = $request->all();
        $ntf_data = Notification::where('id', $nid)->update(['status' => '1']);
        // $ndata = Notification::All();
        $current_userid = Auth::id();
        $notification_data = Notification::where('id', $nid)->get();
        $notification_count = $notification_data->count();
        $userdata =  $notification_data ;
        //dd($notification_data);
        return view('backend.userManagement.assignuser.notify',compact('userdata','nid','ntf_data','userdata'));
    }

    public function notificationRead(Request $request){
        $data = $request->all();
        $ntf_data = Notification::where('id', $data['id'])->update(['status' => '1']);
        //dd($ntf_data);

        $notification = Notification::where('id',$data['id'])->first();

        $current_userid = Auth::id();
		$notification_data = Notification::where('assignto_id', $current_userid)->where('status', '0')->get();
		$notification_count = $notification_data->count();

        //dd($notification); 
        if($ntf_data){
            $response['status'] = 'true';
            $response['msg']    = 'Status updated successfully';
            $response['url']    = $notification['url'];
        } else{
            $response['status'] = 'false';
            $response['msg']    = COMMON_ERROR;
        }
        return $response;
        //return redirect($notification['url']);
        //dd($notification_data);
        //return view('backend.userManagement.notification.updated',compact('notification_count'));

    }
	
	
	
	public function notificationAllRead(Request $request){
        $data = $request->all();
		//dd($data);
		
		$ntf_data = Notification::where('assignto_id', $data['carrier_id'])->update(['status' => '1']);
	}
	
	public function notificationMessAllRead(Request $request){
        $data = $request->all();
		$ntf_data = CarrierRequest::where('receiver_id', $data['carrier_id'])->update(['check_status' => '1']);
		$ntf_data = LoadComment::where('receiver_id', $data['carrier_id'])->update(['status' => '1']);
		$ntf_data = Shipper_request::where('receiver_id', $data['carrier_id'])->update(['check_status' => '1']);

	}

    
}
