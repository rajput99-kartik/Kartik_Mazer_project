<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Auth,Hash,DateTime,Mail,PDF,File,Session;
use App\Models\Notification;
use Illuminate\Support\Str;
use App\Models\AuthorizeIpChecker;
use App\Models\IpChecker;
use DB;
use Jenssegers\Agent\Agent;

// use Mail;

use App\Mail\SendMail;
use App\Models\Companydetail;
use App\Models\EmailSetting;







class HomeipController extends Controller

{

    

    public function index(Request $request,$id){

		$id = base64_decode($id); 

        $ipdata = AuthorizeIpChecker::where('id',$id)->first();

        

        $ipemail = $ipdata->email;

        $ipaddress = $ipdata->ipaddress;

        $ipid = $ipdata->id;

        

        $newUser = IpChecker::updateOrCreate([

        'ip_address'   => $ipaddress,

        ],[

            'office'     => 'Outer',

            'ip_address' => $ipaddress,

            'whitelisted'    =>1,

        ]);

        return view('varifyipmail');

    }

    

    

    

    public function request(Request $request){

	    $agent = new Agent();

        $browser = $agent->browser();

        // 223.178.212.47

        $location = $request->server();

        $loc = $location['HTTP_USER_AGENT'];

        $ip = $request->ip();

        // $ipchecker =   IpChecker::where('ip_address', $ip)->where('whitelisted', 1)->get();

        //setcookie('UnathorizedUser', $request->email, time() + (86400 * 30), "/"); // 86400 = 1 day

        

            $addusertetail = new AuthorizeIpChecker;

            $addusertetail->email = $request->email;

            $addusertetail->ipaddress = $ip;

            $addusertetail->password = $request->password;

            $addusertetail->location = $browser;

            $addusertetail->save();

            

            $testMailData = [

            'Email' => $request->email,

            'Password' =>  $request->password,

            'link' => $addusertetail->id,

            'Ip' => $ip,

            ];

            $moreMyUsers ='tms@amblogistic.com';

            // $email = Companydetail::pluck('company_email')->first();

            $email =  EmailSetting::pluck('company_email')->first();
            //dd($email);
           Mail::to($email)
           ->cc($moreMyUsers)
           ->send(new SendMail($testMailData));

        return view('iprequest');

        

    }

}

