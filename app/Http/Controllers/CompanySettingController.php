<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companydetail;
use App\Models\EmailSetting;
use App\Models\Dat;
use App\Models\User;
use File;
use Auth;
use Mail;
use DB;
use Illuminate\Support\Facades\Artisan;

    

class CompanySettingController extends Controller
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
    
    
    
    //company details start
    public function index(){
        $company_detaills = Companydetail::first();
        return view('backend/settingManagement/cDetails/index', compact('company_detaills'));
    }
    
    public function addcdetails(Request $request){
        $company_detaills = Companydetail::first();
        
        if($request->hasFile('company_logo')) {
            $request->validate([
                'company_logo' => 'required|mimes:png,jpg',
            ]);
      
            $file = $request->file('company_logo');
            $filename = time().'_'.$file->getClientOriginalName();
            $location = 'public/backend/assets/office/';
            $file->move($location,$filename);
            
            if(\File::exists(public_path('backend/assets/office/'.$request->old_logo))){
            \File::delete(public_path('backend/assets/office/'.$request->old_logo));
            }else{
            
            }
        }else{
            $filename = $request->old_logo;
        }
        
        $company_detaills = Companydetail::updateOrCreate([
            'id'   => "1",
        ],[
            'company_name'     => $request->company_name,
            'company_legal_name' => $request->company_legal_name,
            'company_logo'    => $filename,
            'contact_person'   => $request->contact_person,
            'company_address'       => $request->company_address,
            'company_city'   => $request->company_city,
            'company_zip_code'    => $request->company_zip_code,
            'company_phone'    => $request->company_phone,
            'company_email'    => $request->company_email,
            'company_domain'    => $request->company_domain,
            'company_vat'    => $request->company_vat
        ]);
        if($company_detaills){
            return back()->with('success', 'Setting Save Successfully..');
        }
    }
    //company details end
    
    public function emailSetting(){
        $emailSetting = EmailSetting::where('id', '1')->first();
        return view('backend/settingManagement/emailSetting/index', compact('emailSetting'));
    }

    /* Setting test email send function start */
    public function SendTestEmail(Request $request){
        
        $req = $request->all();
        $data = array('to'=>$request->input('email_to'),'msg'=>'');
					Mail::send('emails.smtp.smtpTest', $data, function($message) use ($req) {
					   $message->to($req['email_to'], 'AMB Logistic')->subject
						  ('SMTP Working');
					});
        return back()->with('success', 'Test email sent Successfully..');
        
    }
    /* Setting test email send function end */
    
    //email setting post
    public function addemaildetails(Request $request){
        $emaildetails = EmailSetting::updateOrCreate(
            [
             'id'   => "1",   
            ],
            [
                'userid'     => Auth::id(),
                'company_email' => $request->company_email,
                'use_postmark' => $request->postmark,
                'postmark_api'    => $request->postmarkapi,
                'postmark_email'   => $request->postmarkemail,
                'email_protocol'       => $request->protocol,
                'smtp_host'   => $request->smtp_host,
                'smtp_user'    => $request->smtp_user,
                'smtp_password'    => $request->smtp_pass,
                'smtp_port'    => $request->smtp_port,
                'email_encryption'    => $request->email_encryption
            ]
        );
        if($emaildetails){
            return back()->with('success', 'Setting Save Successfully..');
        }
    }
    
    function emailtemplateSetting(){
        return view('backend/settingManagement/emailSetting/email-template');
    }
    
    function apiSetting(){
         $uid = Auth::id();
         $Dat = DAT::where('user_id', $uid)->first();
        $CarrierPacket = DB::table('mycarrier_packets')->where([ ['id', '=', '1'] ])->first();
        return view('backend/settingManagement/apiSetting/index',compact('Dat','CarrierPacket'));
    }

    /* Setting DAT user detail save function start */
    public function ApiDatSaveOld(Request $request){
        if($request->isMethod('post')){
        $data = $request->all();
        $Dat_update = DB::update('update dat_login set username =?,password =? where id = ?',[ $data['username'],$data['password'],'1']);
        return back()->with('success', 'DAT credentials Update Successfully..');
        }
    }
    
    public function ApiDatSave(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $uid = Auth::id();
            $duid = DAT::where('user_id', $uid)->first();

            if(empty($duid)){
                    $data = $request->all();
                    $addusertetail = new DAT;
                    $addusertetail->user_id =  $uid;
                    $addusertetail->username = $request->username;
                    $addusertetail->password = $request->password;
                    $addusertetail->username_dat = $request->username_dat;
                    $addusertetail->save();
            }else{
                $duid->user_id = $uid;
                $duid->username = $request->username;
                $duid->password = $request->password;
                $duid->username_dat = $request->username_dat;
                $duid->save();
            }
            return back()->with('success', 'DAT credentials Update Successfully..');
        }
    }


    public function ApiCarrierPacket(Request $request){


        if($request->isMethod('post')){
            $data = $request->all();
            $Dat_update = DB::update('update mycarrier_packets set user_name =?,password =? where id = ?',[ $data['username'],$data['password'],'1']);
            //$dat->update([ 'username' => $data['username'], 'password' => $data['password'] ]);
            //die('yes');
            return back()->with('success', 'Mycarrierpackets credentials Update Successfully..');
         }
        }
    /* Setting DAT user detail save function end */
    
    function manageIP(){
        return view('backend/settingManagement/manageIP/manage-ip');
    }
    
    
    public function dottoken(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $uid = Auth::id();
            $Dat_update = DB::update('update dat_login set accessToken =?,token =? where id = ?',[ $data['accessToken'],$data['token'], 1]);
            return redirect('admin/setting/api')->with('
            success', 'Dat Token Update Successfully');
        }
    }
    
    
    public function userdattoken(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $mid= $data->usertokenid;
            $uid = Auth::id();
            $Dat_update = DB::update('update dat_login set accessToken =?,token =? where user_id = ?',[ $data['accessToken'],$data['token'], $mid]);
            // $Dat_update = DB::update('update dat_login set accessToken =?,token =? where user_id = ?',[ $data['accessToken'],$data['token'], $mid]);
            //              $datainfo = Dat::where('password',$data['password'])->first();
            // 			    $datainfo->accessToken	= $data['accessToken'];
            //              $datainfo->token	= $data['token'];
            // 			    $datainfo->update();
			
			 return redirect('admin/setting/user/dat/api'.'/'.$mid)->with('success', 'Dat User Token Update Successfully');
            // return redirect('admin/setting/api')->with('success', 'Dat User Token Update Successfully');
        }
    }
    
    
    // this is use for only DAT user token generate 
    public function userdattokeninfoOld(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $mid= $data['usertokenid'];
            
            
            $mid = base64_decode($mid);
            //dd($mid);
                $uid = Auth::id();
            
               
               $dat_details = DB::table('dat_login')->where('user_id', $mid)->first();
               
               $dat_details1 = \DB::table('dat_login')->first();
               
        	   $data= json_decode( json_encode($dat_details), true);
        	   $user= '{  "username": "'.$dat_details->username_dat.'" }';
        	   \Log::info($user);
                $curl = curl_init();
                curl_setopt_array($curl, array(
                // CURLOPT_URL => "https://identity.api.nprod.dat.com/access/v1/token/user",// your preferred link
                CURLOPT_URL => "https://identity.api.dat.com/access/v1/token/user",// your preferred link
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POST => 1,
                CURLOPT_POSTFIELDS => $user,
                CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
                "Authorization: Bearer ".$dat_details1->accessToken.""
                ),
                ));
        
            	$response = curl_exec($curl);
            	curl_close($curl);
            	$res = json_decode($response);
            	$data= json_decode( json_encode($response), true);
        	    
        	   //dd($res);
        		if(!empty($res)){
        		    
        		    $datupdate = DB::update('update dat_login set token =? where user_id = ?',[ $res->accessToken, $mid ]); //single user id 
        		    
        		}	  	   
        // 		Log::info("User acceess token genrated!");
        		
        		 $mid = base64_encode($mid);
        		return redirect('admin/setting/user/dat/api'.'/'.$mid)->with('success', 'Dat User Token Update Successfully');
            	//\Log::info($data);
        }
    }
    
    public function userdattokeninfo(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $mid= $data['usertokenid'];
                    $mid = base64_decode($mid);
                    //dd($mid);
                    $uid = Auth::id();
            
                    $dat_details = DB::table('dat_login')->where('user_id', $mid)->first();
                    if(!empty($dat_details->username_dat)){   
                       $dat_details1 = \DB::table('dat_login')->first();
                       
                	   $data= json_decode( json_encode($dat_details), true);
                	   $user= '{  "username": "'.$dat_details->username_dat.'" }';

                       // dd($data);
                	   \Log::info($user);
                        $curl = curl_init();
                        curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://identity.api.nprod.dat.com/access/v1/token/user",// your preferred link
                        // CURLOPT_URL => "https://identity.api.dat.com/access/v1/token/user",// live your preferred link
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_TIMEOUT => 30000,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POST => 1,
                        CURLOPT_POSTFIELDS => $user,
                        CURLOPT_HTTPHEADER => array(
                        // Set Here Your Requesred Headers
                        'Content-Type: application/json',
                        "Authorization: Bearer ".$dat_details1->accessToken.""
                        ),
                        ));
                
                    	$response = curl_exec($curl);
                    	curl_close($curl);
                    	$res = json_decode($response);
                    	$data= json_decode( json_encode($response), true);
                	    
                	    // dd($res);
                		    if(!empty($res)){
                		    
                		    $datupdate = DB::update('update dat_login set token =? where user_id = ?',[ $res->accessToken, $mid ]); //single user id 
                		    
                		    }	  	   
                        // 		Log::info("User acceess token genrated!");
                		
                		     $mid = base64_encode($mid);
                		    return redirect('admin/setting/user/dat/api'.'/'.$mid)->with('success', 'Dat User Token Update Successfully');
                    	//\Log::info($data);
                    }else{
                        $mid= $data['usertokenid'];
                        return redirect('admin/setting/user/dat/api'.'/'.$mid)->with('error', 'Check DAT-UserName & Wait 16 Mints');
                    }
        }
    }

    public function carriertoken(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $packet_user = \DB::table('mycarrier_packets')->first();
            // $data= json_decode( json_encode($packet_user), true);						   
            $access= 'grant_type=password&username='.$packet_user->user_name.'&password='.$packet_user->password;
						   
		    //dd($access);
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.mycarrierpackets.com/token",// your preferred link
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_TIMEOUT => 30000,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POST => 1,
			CURLOPT_POSTFIELDS => $access,
			CURLOPT_HTTPHEADER => array(
			// Set Here Your Requesred Headers
			'Content-Type: application/x-www-form-urlencoded'
			),
			));
				$response = curl_exec($curl);
				curl_close($curl);
				$res = json_decode($response);

            if(!empty($res)){
                $datupdate = DB::update('update mycarrier_packets set token =?',[ $res->access_token, ]);
            }
            return redirect('admin/setting/api')->with('success', 'Token Update Successfully');
        }
    }
    
    
    public function schedule(Request $request){
        Artisan::call('schedule:run');
        return redirect('admin/setting/user/dat/api')->with('success', 'Schedule Run By Cron Job');
    }
    
    
    public function apiuserSetting(){
        $uid  = Auth::id();
        $Dat = DAT::where('user_id', $uid)->offset(0)->first();
        $CarrierPacket = DB::table('mycarrier_packets')->where([ ['id', '=', '1'] ])->first();
        //print_r($CarrierPacket);die;
        return view('backend/settingManagement/apiSetting/index',compact('Dat','CarrierPacket'));
    }
    
    public function apiDatSettingUpdate(Request $request, $id){
        
        // $encoded_id = base64_encode($user->id);
        $id = base64_decode($id);
        
        //  if (is_null($this->user) || !$this->user->can('user-list')) {
        //     abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        // }
            
            if($request->isMethod('post')){
                $data = $request->all();
                $uid = Auth::id();
                $duid = DAT::where('user_id', $id)->first();

                if(empty($duid)){
                        $data = $request->all();
                        $addusertetail = new DAT;
                        $addusertetail->user_id =  $id;
                        $addusertetail->username = $request->username;
                        $addusertetail->password = $request->password;
                        $addusertetail->username_dat = $request->username_dat;
                        $addusertetail->accessToken = $request->accessToken;
                        $addusertetail->save();
                       User::where('id', $id)->update(['dat_user_auth_status' => $data['datathid']]);
                       
                       $id = base64_encode($id);
                        return redirect('admin/setting/user/dat/api'.'/'.$id)->with('success', 'DAT credentials Create Successfully..');
                        // return back()->with('success', 'DAT credentials Create Successfully..');
                }else{
                    
                    $data = $request->all();
                    
                    $duid->user_id = $id;
                    $duid->username = $request->username;
                    $duid->password = $request->password;
                    $duid->username_dat = $request->username_dat;
                    $duid->accessToken = $request->accessToken;
                    $duid->save();
                     User::where('id', $id)->update(['dat_user_auth_status' => $data['datathid']]);
                     
                     $id = base64_encode($id);
                    return redirect('admin/setting/user/dat/api'.'/'.$id)->with('success', 'DAT credentials Update Successfully.. ');
                    // return back()->with('success', 'DAT credentials Update Successfully..');
                }
            } 

            $Dat = DAT::where('user_id', $id)->first();
            $CarrierPacket = DB::table('mycarrier_packets')->where([ ['id', '=', '1'] ])->first();
            
            
            
            $id = base64_encode($id);
            
            return view('backend/settingManagement/apiDatinfoUser/form',compact('Dat','id','CarrierPacket'));
    }
    
    public function dataapiuserlist(Request $request){
        
        // if (is_null($this->user) || !$this->user->can('user-list')) {
        //     abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        // }
        
        
        $data = $request->all();
        $data = DAT::all();
        $Userdata = '';
        $data = Auth::id();
        if($data == 1){
            $Userdata = User::get();
        }else{
            
            $Userdata = User::where('id',$data)->get();
        }
        return view('backend/settingManagement/apiDatinfoUser/index',compact('data','Userdata'));
    }
    
    
    public function showadminapi(Request $request){
        
        //  if (is_null($this->user) || !$this->user->can('user-list')) {
        //     abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        // }
        
        $data = $request->all();
        $data = DAT::all();
        $Userdata = '';
        $data = Auth::id();
        // if($data == 1){
        //     $Userdata = User::where('dat_user_auth_status'> '0')->get();
        // }else{
            
        //     $Userdata = User::where('id',$data)->get();
        // }
        
        
        
        //  $Userdata = User::where('dat_user_auth_status','<>' ,0 )->get();
         $statusid = '0';
        
         $Userdata = User::where('dat_user_auth_status',$statusid)->get();
        return view('backend/settingManagement/apiDatinfoUser/adminapi',compact('data','Userdata'));
    }
    
    
    
    public function showselfapi(Request $request){
        
        //  if (is_null($this->user) || !$this->user->can('user-list')) {
        //     abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        // }
        
        $data = $request->all();
        $data = DAT::all();
        $Userdata = '';
        $data = Auth::id();
        // if($data == 1){
        //     $Userdata = User::where('dat_user_auth_status'> '0')->get();
        // }else{
            
        //     $Userdata = User::where('id',$data)->get();
        // }
        
        
        
        $Userdata = User::where('dat_user_auth_status','<>' ,1 )->get();
        return view('backend/settingManagement/apiDatinfoUser/selfapi',compact('data','Userdata'));
    }
    
    
    
    public function datauthuserapi(Request $request){
        return view('backend/settingManagement/apiDatinfoUser/auth/index');
    }
    
    
    
    
    public function datuserstatus(Request $request){
        $response = [];
        if($request->isMethod('post')){
            $data = $request->all();
            // echo '<pre>'; print_r($data); die;

            $statusid = $data['id'];
            if($data['curr'] == 'true'){
                $status = '1';
            } else{
                $status = '0';
            }
            
            if($data['id']==0){
                $upd = User::where('id', '<>' , 0)->update(['dat_user_auth_status'=>$status]);
            }else{
                $upd = User::where('id',$statusid)->update(['dat_user_auth_status'=>$status]);
            }
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

}
