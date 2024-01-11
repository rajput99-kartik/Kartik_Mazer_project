<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Auth,Hash,DateTime,Mail,PDF,File,Session;
use App\Models\EquipmentType;
use App\Models\Company;
use App\Models\Notification;
use App\Models\Shipper_request;
use App\Models\Carriers;
use App\Models\User;
use App\Models\ShipperHistory;
use App\Models\AssignUserTeam;
use Illuminate\Support\Str;
use DB;
class CompanyController extends Controller
{
    public $user;
    public function __construct(){
        $this->middleware('permission:shipper-all|shipper-list | shipper-view|shipper-create|shipper-edit|shipper-request
        | shipper-delete| shipper-approve', ['only' => ['index','store']]);
         $this->middleware('permission:shipper-list', ['only' => ['list','list']]);
         $this->middleware('permission:shipper-create', ['only' => ['create','store']]);
         $this->middleware('permission:shipper-edit', ['only' => ['edit','update']]);
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function index(){      
        $user_id = auth()->user()->id ;
        $user = User::where('id',$user_id)->first();
        $equipments = DB::table('equipment_types')->get();  
        $companies_data = DB::table('carriers')->where([
                        ['user_id', '=', $user_id],
                    ])->orderBy('id','DESC')->get();
        $cdata = Carriers::where('user_id',$user_id)->orderBy('id','DESC')->get();
        $comp_data = Company::where('user_id',$user_id)->orderBy('id','DESC')->get();
        $total =  Company::where('user_id',$user_id)->count();
        //$total =  Company::where('user_id',$user_id)->sum('id');
        // $curr_repayment = $transact->where('trans_type', '=', 'credit')->sum('Amount');
        $shipper_pending =  Company::where('approved', '=', '0')->where('user_id',$user_id)->count();
        $shipper_approve =  Company::where('approved', '=', '1')->where('user_id',$user_id)->count();
        $active = 'companies';
        $page = 'Company';
        return view('backend.shipmentManagement.shipper.index', compact('page','companies_data','equipments','cdata','comp_data','total','shipper_pending','shipper_approve'));
    }
    public function list(Request $request){
        if (is_null($this->user) || !$this->user->can('shipper-all')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        $GetUser =  User::where('user_type', 'agent')->orwhere('user_type', 'officer')->get();
        $comp_data = Company::orderBy('id','DESC')->get();
        $total =  Company::count();
        $shipper_pending =  Company::where('approved', '=', '0')->count();
        $shipper_approve =  Company::where('approved', '=', '1')->count();
        $shipper_disapprove =  Company::where('approved', '=', '2')->count();
        //echo '<pre>'; print_r($comp_data);die; 
        $page = 'shipper_details';
        return view('backend.shipmentManagement.shipper.list', compact('page','GetUser','comp_data','total','shipper_pending','shipper_approve','shipper_disapprove'));
    }
    
    //shipper filter
    public function shipperFilter(Request $request){
        $GetUser =  User::where('user_type', 'agent')->orwhere('user_type', 'officer')->get();
        $comp_data = Company::where($request->filter_type, $request->filter_value)->get();
        //echo '<pre>'; print_r($comp_data);die; 
        $page = 'shipper_details';
        return view('backend.shipmentManagement.shipper.shipper-filter', compact('page','GetUser','comp_data'));
    }
        
    public function shipperdateFilter(Request $request){
        $user_id = auth()->user()->id ;
        $user = User::where('id',$user_id)->first();
        $equipments = DB::table('equipment_types')->get();  
        $companies_data = DB::table('carriers')->where([
                        ['user_id', '=', $user_id],
                    ])->orderBy('id','DESC')->get();
        // dd($companies_data  carriers_id);
        $cdata = Carriers::where('user_id',$user_id)->orderBy('id','DESC')->get();
        $comp_data = Company::where('user_id',$user_id)->whereBetween('created_at', [$request->min, $request->max])->orderBy('id','DESC')->get();
        $active = 'companies';
        $page = 'Company';
        return view('backend.shipmentManagement.shipper.date-range', compact('page','companies_data','equipments','cdata','comp_data'));
    }
    
    // shipper/add
    public function addOld(Request $request){
        if (is_null($this->user) || !$this->user->can('shipper-create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        $ddate = date("Y-n-j ") . date("H:i:sa") ; 
        if($request->isMethod('post')){
            $company_id = Auth::id();
            $data = $request->all();
            $validatedData = $request->validate
            ([
                // 'company_name'=>'required|unique:users,employee_id',
                'company_name'=>'required',
            ]);
            $cmpn = $data['company_name'];
            $bc =    Str::replace('8.x', '9.x', $cmpn);
            $string = $cmpn.$bc;
            function initials($string) {
                $ret = '';
                foreach (explode(' ', $string) as $word)
                    $ret .= strtoupper($word[0]);
                return $ret;
            }
            $st = initials($string);
            // $a  = uniqid($st, '6');
            // $b  = substr($a, 0, 6);
            $bca = mt_rand(0000000,9999999);
            $axyt = $st.$bca;
            $b  = substr($axyt, 0, 6);

            //we can change and delete  start 
                $b = Company::where('encode_title', '=', $b)->get(['encode_title']);//Find matches for id = generated id
            
                if (isset($b[0]->encode_title)) {//id exists in users table
                    //Retry with another generated id
                    $st = initials($string);                            
                    $bca = mt_rand(0000000,9999999);
                    $axyt = $st.$bca;
                    $b  = substr($axyt, 0, 7);
                    //dd('kh');
                }
             //we can change and delete  end 

            $shipper = new Company;
            $shipper->company_name	= $data['company_name'];
            $shipper->business_name	= $data['business_name'];
            $shipper->business_type_info	= $data['business_type_info'];
            $shipper->address	= $data['address'];
            $shipper->shipper_country	= $data['shipper_country'];
            $shipper->shipper_state	= $data['state'];
            $shipper->shipper_city	= $data['city'];
            $shipper->shipper_zipcode	= $data['zipcode'];  
            $shipper->contact_name  = $data['contact_name'];            
            $shipper->email	= $data['email'];
            $shipper->phone_number	= $data['phone'];
            $shipper->currency_type	= $data['currency_type'];
            // $shipper->commodity	= $data['commodity'];
            // $shipper->special_instructions	= $data['special_instructions'];
            $shipper->fax	= $data['fax'];
            $shipper->website	= $data['website'];
            $shipper->business_type	= $data['business_type'];
            $shipper->years_in_business	= $data['years_in_business'];
            $shipper->location	= $data['location'];
            $shipper->incorporation_state	= $data['incorporation_state'];
            $shipper->fed_tax_id	= $data['fed_tax_id'];
            //shipment-manager-details
            $shipper->ship_firstname	= $data['ship_firstname'];
            $shipper->ship_lastname	= $data['ship_lastname'];
            $shipper->ship_phone	= $data['ship_phone'];
            $shipper->ship_email	= $data['ship_email'];
            //Billing details
            $shipper->bill_company_name	= $data['bill_company_name'];
            $shipper->bill_firstname	= $data['bill_firstname'];
            $shipper->bill_lastname	= $data['bill_lastname'];
            $shipper->bill_phone	= $data['bill_phone'];
            $shipper->bill_email	= $data['bill_email'];
            $shipper->bill_fax	    = $data['bill_fax'];
            $shipper->billing_email	= $data['billing_email'];
            //Billing Company Address
            $shipper->bill_address	= $data['bill_address'];
            $shipper->bill_city	= $data['bill_city'];
            $shipper->bill_state	= $data['bill_state'];
            $shipper->bill_country	= $data['bill_country'];
            $shipper->bill_zipcode	= $data['bill_zipcode'];
            //payment details
            $shipper->shipper_prepaid	= $data['shipper_prepaid'];
            $shipper->payment_terms	= $data['payment_terms'];
            $shipper->payment_method	= $data['payment_method'];
            $shipper->invoice_method	= $data['invoice_method'];
            $shipper->credit_limit_req	= $data['credit_limit_req'];
            $shipper->payment_document	= $data['payment_document'];
            //commodities details
            $shipper->instructions	= $data['instructions'];
            $shipper->equipment_type	= $data['equipment_type'];
            $shipper->equipment_mode	= $data['equipment_mode'];
            $shipper->commodities	= $data['commodities'];
            $shipper->commodities_type	= $data['commodities_type'];
            $shipper->co_package_type	= $data['co_package_type'];
            $shipper->dimensions	= $data['dimensions'];
            $shipper->consignee	= $data['consignee'];
            // $shipper->consignor	= $data['consignor'];
            $shipper->company_date	= $ddate;
            $shipper->user_id 	= $company_id;
            $shipper->encode_title 	=  $b ;
            // $shipper->ref_id 	=  $refid ;

            if($shipper->save()){
                $notif = new Notification;
                $notif->user_id	    = $company_id;
                $notif->type        = 'shipper_request';
                $notif->title	    = 'Shipper Request Approval';
                $notif->body	    = 'Shipper approval request sent!';
                $notif->assignto_id	= '1';
                $notif->status	    = '0';
                $notif->url	        = 'admin/shipper/request/edit/'.base64_encode($shipper->id); 
                $notif->save();
                $req_comment = New Shipper_request;
                $req_comment->sender_id = $company_id;
                $req_comment->companies_id = $shipper->id;
                $req_comment->comment = 'New request sent';
                $req_comment->request_date = date('Y-m-d');
                $req_comment->type = 'Shipper approved';
                $req_comment->req_sent = '1';
                $req_comment->save();
                return redirect('/admin/shipper')->with('success','Shipper added successfully');
            }else{
                return redirect('/admin/shipper')->with('errors',COMMON_ERROR);
            }
        }
        $page = 'shipper';
        return view('backend.shipmentManagement.shipper.form', compact('page'));
    }

    public function add(Request $request){
        if (is_null($this->user) || !$this->user->can('shipper-create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }
        $ddate = date("Y-n-j ") . date("H:i:sa") ; 
        if($request->isMethod('post')){
            $company_id = Auth::id();
            $data = $request->all();
            $validatedData = $request->validate
            ([
                // 'company_name'=>'required|unique:users,employee_id',
                'company_name'=>'required',
            ]);
            $cmpn = $data['company_name'];
            $bc =    Str::replace('8.x', '9.x', $cmpn);
            $string = $cmpn.$bc;

            function initials($string) {
                $ret = '';
                foreach (explode(' ', $string) as $word)
                    $ret .= strtoupper($word[0]);
                return $ret;
            }
            $st = initials($string);
            // $a  = uniqid($st, '6');
            // $b  = substr($a, 0, 6);
            $bca = mt_rand(0000000,9999999);
            $axyt = $st.$bca;
            $b  = substr($axyt, 0, 6);
            
            
            //we can change and delete  start 
                // $ba = Company::where('encode_title',$b)->pluck('encode_title');
                // if(!empty($ba)){
                //          $ab =   $cmpn.$bc;
                //         $st = initials($string);                           
                //         $bca = mt_rand(0000000,9999999);
                //         $axyt = $st.$bca;
                //         $b  = substr($axyt, 0, 7);
                // }
             //we can change and delete  end 
             
             
             function trial1($b){
                    $ba = Company::where('encode_title', '=', $b)
                    ->get(['encode_title']);
                   
                    if (isset($ba[0]->encode_title)) {   //id exists in users table //Retry with another generated id
                        $st = initials($string);                            
                        $bca = mt_rand(0000000,9999999);
                        $axyt = $st.$bca;
                        $b  = substr($axyt, 0, 7);
                        return $b;
                    }
                    else{
                        return $b;
                    }
                }

                $b = trial1($b);
             

            $shipper = new Company;
            $shipper->company_name	= $data['company_name'];
            $shipper->business_name	= $data['business_name'];
            $shipper->business_type_info	= $data['business_type_info'];

            $shipper->address	= $data['address'];
            $shipper->shipper_country	= $data['shipper_country'];
            $shipper->shipper_state	= $data['state'];
            $shipper->shipper_city	= $data['city'];
            $shipper->shipper_zipcode	= $data['zipcode'];  
            $shipper->contact_name  = $data['contact_name'];            
            $shipper->email	= $data['email'];
            $shipper->phone_number	= $data['phone'];
            $shipper->currency_type	= $data['currency_type'];
            // $shipper->commodity	= $data['commodity'];
            // $shipper->special_instructions	= $data['special_instructions'];
            $shipper->fax	= $data['fax'];

            $shipper->website	= $data['website'];
            $shipper->business_type	= $data['business_type'];
            $shipper->years_in_business	= $data['years_in_business'];
            $shipper->location	= $data['location'];
            $shipper->incorporation_state	= $data['incorporation_state'];
            $shipper->fed_tax_id	= $data['fed_tax_id'];

            //shipment-manager-details
            $shipper->ship_firstname	= $data['ship_firstname'];
            $shipper->ship_lastname	= $data['ship_lastname'];
            $shipper->ship_phone	= $data['ship_phone'];
            $shipper->ship_email	= $data['ship_email'];
            //Billing details
            $shipper->bill_company_name	= $data['bill_company_name'];
            $shipper->bill_firstname	= $data['bill_firstname'];
            $shipper->bill_lastname	= $data['bill_lastname'];
            $shipper->bill_phone	= $data['bill_phone'];
            $shipper->bill_email	= $data['bill_email'];
            $shipper->bill_fax	    = $data['bill_fax'];
            $shipper->billing_email	= $data['billing_email'];
            //Billing Company Address
            $shipper->bill_address	= $data['bill_address'];
            $shipper->bill_city	= $data['bill_city'];
            $shipper->bill_state	= $data['bill_state'];
            $shipper->bill_country	= $data['bill_country'];
            $shipper->bill_zipcode	= $data['bill_zipcode'];
            //payment details

            $shipper->shipper_prepaid	= $data['shipper_prepaid'];
            $shipper->payment_terms	= $data['payment_terms'];
            $shipper->payment_method	= $data['payment_method'];
            $shipper->invoice_method	= $data['invoice_method'];
            $shipper->credit_limit_req	= $data['credit_limit_req'];
            $shipper->payment_document	= $data['payment_document'];
            //commodities details

            $shipper->instructions	= $data['instructions'];
            $shipper->equipment_type	= $data['equipment_type'];
            $shipper->equipment_mode	= $data['equipment_mode'];
            $shipper->commodities	= $data['commodities'];
            $shipper->commodities_type	= $data['commodities_type'];
            $shipper->co_package_type	= $data['co_package_type'];
            $shipper->dimensions	= $data['dimensions'];
            $shipper->consignee	= $data['consignee'];
            // $shipper->consignor	= $data['consignor'];

            $shipper->company_date	= $ddate;
            $shipper->user_id 	= $company_id;
            $shipper->encode_title 	=  $b ;
            // $shipper->ref_id 	=  $refid ;


            if($shipper->save()){
                $notif = new Notification;
                $notif->user_id	    = $company_id;
                $notif->type        = 'shipper_request';
                $notif->title	    = 'Shipper Request Approval';
                $notif->body	    = 'Shipper approval request sent!';
                $notif->assignto_id	= '1';
                $notif->status	    = '0';
                $notif->url	        = 'admin/shipper/request/edit/'.base64_encode($shipper->id); 
                $notif->save();
                $req_comment = New Shipper_request;
                $req_comment->sender_id = $company_id;
                $req_comment->companies_id = $shipper->id;
                $req_comment->comment = 'New request sent';
                $req_comment->request_date = date('Y-m-d');
                $req_comment->type = 'Shipper approved';
                $req_comment->req_sent = '1';
                $req_comment->save();
                return redirect('/admin/shipper')->with('success','Shipper added successfully');
            }else{
                return redirect('/admin/shipper')->with('errors',COMMON_ERROR);
            }
        }
        $page = 'shipper';
        return view('backend.shipmentManagement.shipper.form', compact('page'));
    }



    public function ShipperNameCheck(Request $request){
        $data = $request->all();
        $shipper_details = DB::table('companies')->where([ ['company_name', 'like', $data['shipper_name'].'%'] ])->first();
        return $shipper_details;
    }
    public function RequsetResend(Request $request,$shipper_id){
        $user_id = Auth::id();
        //Company::where('id',$data['id'])->update(['check_status'=> '1']);
        $shipper = Company::where('id',base64_decode($shipper_id) )->update(['company_date'=> date("Y-m-d h:i:s"),'approved'=> '0']);
        $req_comment = New Shipper_request;
        $req_comment->sender_id = $user_id;
        $req_comment->companies_id = base64_decode($shipper_id);
        $req_comment->comment = 'New request re-sent';
        $req_comment->request_date = date('Y-m-d');
        $req_comment->type = 'Shipper approved';
        $req_comment->req_sent = '1';
        $req_comment->save();
        return redirect('/admin/shipper')->with('success','Shipper request re-sent Successfully');
    }
    public function show(Request $request,$shipper_id){
        $shipper_details = Company::where('id',$shipper_id)->first();
        $eid = $shipper_details->id ;
        if ($request->isMethod('post')){
            $data = $request->all();
            $this->validate($request,[ 
                // 'first_name'=>'required',
            ]);            
            $shipper_details->company_name	= $data['company_name'];
            $shipper_details->address	= $data['address'];
            $shipper_details->shipper_state	= $data['state'];
            $shipper_details->shipper_city	= $data['city'];
            $shipper_details->shipper_zipcode	= $data['zipcode'];  
            $shipper_details->contact_name  = $data['contact_name'];            
            $shipper_details->email	= $data['email'];
            $shipper_details->phone_number	= $data['phone'];
            $shipper_details->commodity	= $data['commodity'];
            $shipper_details->equipments	= $data['equipments'];
            $shipper_details->temprature	= $data['temprature'];
            $shipper_details->special_instructions	= $data['special_instructions'];
            if ($shipper_details->save()) {
                return redirect('/admin/shipper/edit/'.$shipper_id)->with('success','Shipper Updated Successfully');
            }else{
                return redirect()->back()->with('errors',COMMON_ERROR);
            }
        }
        $page = 'shipper_details';
        return view('backend.shipmentManagement.shipper.form', compact('page','shipper_details','shipper_id'));
    }
    
    public function edit(Request $request,$shipper_id){
        $id = base64_decode($shipper_id);
        $shipper_details = Company::where('id',$id)->first();
        if($shipper_details){
            $eid = $shipper_details->id;
            if ($request->isMethod('post')){
                $data = $request->all();
                $this->validate($request,[ 
                    // 'employee_id' => 'unique:users,employee_id,'.$eid,
                ]);            
                
                $shipper_details->company_name	        = $data['company_name'];
                $shipper_details->business_name	        = $data['business_name'];
                $shipper_details->business_type_info	= $data['business_type_info'];
                $shipper_details->address	            = $data['address'];
                $shipper_details->shipper_country	    = $data['shipper_country'];
                $shipper_details->shipper_state	        = $data['state'];
                $shipper_details->shipper_city	        = $data['city'];
                $shipper_details->shipper_zipcode	    = $data['zipcode'];  
                $shipper_details->contact_name          = $data['contact_name'];            
                $shipper_details->email	                = $data['email'];
                $shipper_details->phone_number	        = $data['phone'];
                $shipper_details->currency_type	        = $data['currency_type'];
                $shipper_details->fax	                = $data['fax'];
                // $shipper->commodity	= $data['commodity'];
                // $shipper->special_instructions	= $data['special_instructions'];
                //start work here 

                $shipper_details->website	        = $data['website'];
                $shipper_details->business_type	    = $data['business_type'];
                $shipper_details->years_in_business	= $data['years_in_business'];
                $shipper_details->location	        = $data['location'];
                $shipper_details->incorporation_state= $data['incorporation_state'];
                $shipper_details->fed_tax_id	    = $data['fed_tax_id'];
            
                //shipment-manager-details
                $shipper_details->ship_firstname	= $data['ship_firstname'];
                $shipper_details->ship_lastname	= $data['ship_lastname'];
                $shipper_details->ship_phone	= $data['ship_phone'];
                $shipper_details->ship_email	= $data['ship_email'];
                //Billing details
                $shipper_details->bill_company_name	= $data['bill_company_name'];
                $shipper_details->bill_firstname	= $data['bill_firstname'];
                $shipper_details->bill_lastname	= $data['bill_lastname'];
                $shipper_details->bill_phone	= $data['bill_phone'];
                $shipper_details->bill_email	= $data['bill_email'];
                $shipper_details->bill_fax	    = $data['bill_fax'];
                $shipper_details->billing_email	= $data['billing_email'];
                //Billing Company Address
                $shipper_details->bill_address	= $data['bill_address'];
                $shipper_details->bill_city	    = $data['bill_city'];
                $shipper_details->bill_state	= $data['bill_state'];
                $shipper_details->bill_country	= $data['bill_country'];
                $shipper_details->bill_zipcode	= $data['bill_zipcode'];
                //payment details
                $shipper_details->shipper_prepaid	= $data['shipper_prepaid'];
                $shipper_details->payment_terms	    = $data['payment_terms'];
                $shipper_details->payment_method	= $data['payment_method'];
                $shipper_details->invoice_method	= $data['invoice_method'];
                $shipper_details->credit_limit_req	= $data['credit_limit_req'];
                $shipper_details->payment_document	= $data['payment_document'];
                //commodities details
                $shipper_details->instructions	    = $data['instructions'];
                $shipper_details->equipment_type	= $data['equipment_type'];
                $shipper_details->equipment_mode	= $data['equipment_mode'];
                $shipper_details->commodities	    = $data['commodities'];
                $shipper_details->commodities_type	= $data['commodities_type'];
                $shipper_details->co_package_type	= $data['co_package_type'];
                $shipper_details->dimensions	    = $data['dimensions'];
                $shipper_details->consignee	        = $data['consignee'];
                
            // print_r($data['consignee']);
            // $data['consignee']
            //dd($data);
                // $shipper_details->consignee	        = $data['consignee'];
                // $shipper_details->consignor	        = $data['consignor'];
                if ($shipper_details->save()) {
                    return redirect('/admin/shipper/edit/'.$shipper_id)->with('success','Shipper Updated Successfully');
                }else{
                    return redirect()->back()->with('errors',COMMON_ERROR);
                }
            }
        }
        $page = 'shipper_details';
        return view('backend.shipmentManagement.shipper.form', compact('page','shipper_details','shipper_id'));
    }
    public function delete($shipper_id){
        $del = Company::where('id',$shipper_id)->delete();
        if ($del) {
            return redirect()->back()->with('success','Shipper deleted successfully');
        } else {
            return redirect()->back()->with('errors',COMMON_ERROR);
        }
    }
    public function check_user_employee_id(){
        $employee_id = $_GET['employee_id'];
        $user_id = $_GET['user'];
        $check = User::where('employee_id',$employee_id)->where('id','<>',$user_id)->count();
        if($check > 0){
            return 'false';
        }else{
            return 'true';
        }
    }
    public function checkEmail(){
        $email = $_GET['email'];
        $user_id = $_GET['user'];
        $check = User::where('email',$email)->where('id','<>',$user_id)->count();
        if($check>0){
            return 'false';
        } else{
            return 'true';
        }
    }

	/* Broker shipper request function start here */
	public function shipper_request(Request $request){
        if (is_null($this->user) || !$this->user->can('shipper-request')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }
		$user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
		$comp_data = Company::where('approved','0')->orderBy('company_date','DESC')->get();
		$page = 'shipper_details';
        return view('backend.shipmentManagement.shipper.shipper_request', compact('page','user','comp_data'));
	}
	/* Broker shipper request function end here */	

    /* Broker shipper request function start here */
	public function shipper_request_limit(Request $request){
        // if (is_null($this->user) || !$this->user->can('shipper-request')) {
        //     abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        // }
		$user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
		$comp_data = Company::where('approved','1')->orderBy('company_date','DESC')->get();
		// $comp_data = Company::orderBy('company_date','DESC')->get();
		$page = 'shipper_details';
        return view('backend.shipmentManagement.shipper.shipper_request_limit', compact('page','user','comp_data'));
	}
	/* Broker shipper request function end here */	


    /* Broker shipper request details function start here */
	public function shipper_request_edit(Request $request,$id){
		if (is_null($this->user) || !$this->user->can('shipper-request')) {
            abort(403, 'Sorry !! You are Unauthorized to edit any user !');
        }
		$user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
        $req_id = base64_decode($id);
        $comp_data = Company::where('id',$req_id)->first();
        // $comp_history = ShipperHistory::where('comp_id',$req_id)->orderBy('created_at','DESC')->get()->skip(1);
        $comp_history = ShipperHistory::where('comp_id',$req_id)->orderBy('created_at','DESC')->get();
        // $comp_history1 = ShipperHistory::where('comp_id',$req_id)->latest();
		$comp_history1 = ShipperHistory::where('comp_id',$req_id)->orderBy('created_at','DESC')->get();
        // dd($comp_history1);
        // $comp_history1 = ShipperHistory::where('comp_id',$req_id)->latest()->first();
        $page = 'shipper_details';
        return view('backend.shipmentManagement.shipper.shipper_request_edit', compact('page','user','comp_data','comp_history','req_id', 'comp_history1'));
    }
    /* Broker shipper request details function end here */

    /* Broker shipper request update function start here */
    // public function request_update(Request $request){
    //     $data = $request->all();
    //     //dd($data);
    //     $user_id = Auth::id();
    //     $user = User::where('id',$user_id)->first();
    //     if($request->isMethod('post')){
    //         $data = $request->all();
    //         $shipper = Company::where('id',$data['companies_id'])->first();

    //         // print_r($shipper->id);
    //         // dd($shipper->id);
    //         $agent = User::where('id',$shipper['user_id'])->first();
    //         if($data['prepay'] == ''){
    //             $prepay = '0';
    //             $prelimit = 'NULL';
    //         }else{
    //             $prepay = '1';
    //             $prelimit = $data['prepay'];
    //         }
    //         if($data['status'] == '1'){
    //             $upd = Company::where('id',$data['companies_id'] )->update(['un_secured_limit'=>$prelimit,'pre_pay'=>$prepay,'credit_limit'=>$data['limit'],'approved'=>$data['status']]);
    //             $req_comment = New Shipper_request;
    //             $req_comment->sender_id = $user_id;
    //             $req_comment->receiver_id = $agent['id'];
    //             $req_comment->companies_id = $data['companies_id'];
    //             $req_comment->comment = $data['comment'];
    //             // $req_comment->comment = ltrim($str($data['comment']));
    //             $req_comment->request_date = date('Y-m-d');
    //             $req_comment->type = 'Shipper approved';
    //             $req_comment->pre_pay_limit = $data['prepay'];
    //             $req_comment->limit_rquest =  $data['limit'];
    //             $req_comment->encode_title =  $data['titlecompany']; // this is unique id of compnay table
    //             $req_comment->save();
                    
    //                 if($req_comment->save()){
    //                     $uid = Auth::id();
    //                     $req_history = New ShipperHistory;
    //                     $req_history->comp_id           = $data['companies_id'];
    //                     $req_history->un_secured_limit  = $prelimit;
    //                     $req_history->pre_pay           = $prepay;
    //                     $req_history->credit_limit      = $data['limit'];
    //                     $req_history->approved          = $data['status'];
    //                     $req_history->comment          = $data['comment'];
    //                     // $req_history->comment          = ltrim($str($data['comment']));
    //                     $req_history->user_id           = $uid;
    //                     $req_history->save();
    //                 }
    //                 echo '1';

    //         }elseif($data['status'] == '2'){
    //             $upd = Company::where('id',$data['companies_id'] )->update(['credit_limit'=>$data['limit'],'approved'=>$data['status']]);
    //             $req_comment = New Shipper_request;
    //             $req_comment->sender_id = $user_id;
    //             $req_comment->receiver_id = $agent['id'];
    //             $req_comment->companies_id = $data['companies_id'];
    //             $req_comment->comment = ltrim($str($data['comment']));
    //             $req_comment->request_date = date('Y-m-d');
    //             $req_comment->type = 'Shipper Disapproved';
    //             $req_comment->encode_title = $data['titlecompany']; // this is unique id of compnay table
    //             $req_comment->pre_pay_limit = $data['prepay'];
    //             $req_comment->limit_rquest =  $data['limit'];
    //             $req_comment->save();
    //             // echo '2';
    //         }
    //     }


    //     // return view('backend.shipmentManagement.shipper.shipper_request_edit'.'/'.base64_encode($data['companies_id']), compact('page','user','comp_data','comp_history','req_id', 'comp_history1'));

    // }


    public function request_update(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            dd($data);
            $user_id = Auth::id();
            $user = User::where('id', $user_id)->first();
    
            $shipper = Company::where('id', $data['companies_id'])->first();
            $agent = User::where('id', $shipper['user_id'])->first();
    
            if ($data['prepay'] == '') {
                $prepay = '0';
                $prelimit = null;
            } else {
                $prepay = '1';
                $prelimit = $data['prepay'];
            }
    
            if ($data['status'] == '1') {
                $upd = Company::where('id', $data['companies_id'])->update([
                    'un_secured_limit' => $prelimit,
                    'pre_pay' => $prepay,
                    'credit_limit' => $data['limit'],
                    'approved' => $data['status']   
                ]);
    
                $req_comment = new Shipper_request;
                $req_comment->sender_id = $user_id;
                $req_comment->receiver_id = $agent['id'];
                $req_comment->companies_id = $data['companies_id'];
                $req_comment->comment = $data['comment'];
                $req_comment->request_date = date('Y-m-d');
                $req_comment->type = 'Shipper approved';
                $req_comment->pre_pay_limit = $data['prepay'];
                $req_comment->limit_rquest = $data['limit'];
                $req_comment->encode_title = $data['titlecompany'];
                $req_comment->save();
    
                if ($req_comment->save()) {
                    $uid = Auth::id();
                    $req_history = new ShipperHistory;
                    $req_history->comp_id = $data['companies_id'];
                    $req_history->un_secured_limit = $prelimit;
                    $req_history->pre_pay = $prepay;
                    $req_history->credit_limit = $data['limit'];
                    $req_history->approved = $data['status'];
                    $req_history->comment = $data['comment'];
                    $req_history->user_id = $uid;
                    $req_history->save();
                }
    
                return response()->json(['status' => 'success']);
            } elseif ($data['status'] == '2') {
                $upd = Company::where('id', $data['companies_id'])->update([
                    'credit_limit' => $data['limit'],
                    'approved' => $data['status']
                ]);
    
                $req_comment = new Shipper_request;
                $req_comment->sender_id = $user_id;
                $req_comment->receiver_id = $agent['id'];
                $req_comment->companies_id = $data['companies_id'];
                $req_comment->comment = $data['comment'];
                $req_comment->request_date = date('Y-m-d');
                $req_comment->type = 'Shipper Disapproved';
                $req_comment->encode_title = $data['titlecompany'];
                $req_comment->pre_pay_limit = $data['prepay'];
                $req_comment->limit_rquest = $data['limit'];
                $req_comment->save();
    
                return response()->json(['status' => 'success']);
            }
        }
    
        return response()->json(['status' => 'error']);
    }
    

    /* Broker shipper request update function end here */

    /* shipper request approver log function start here */
    public function srequsetLog(){
        if (is_null($this->user) || !$this->user->can('shipper-log-user') ) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }	
        $data = Company::All();
        $user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
		$comp_data = Company::where('approved','0')->orderBy('company_date','DESC')->get();
        $shiper_log = Shipper_request::get();
            $ship = '';
			if($user_id == 1){
				$ship = Shipper_request::get();
			}else{
				$ship = Shipper_request::where('sender_id',$user_id)->get();
			}
        // $ship = Shipper_request::where('sender_id',$user_id)->get();
		$page = 'shipper_details';
        return view('backend.shipmentManagement.shipper.log.shipperapproverlog', compact('page','user','comp_data','user_id','shiper_log','ship'));
    }
    public function srequsetLogall(){
        if (is_null($this->user) || !$this->user->can('shipper-log-admin') ) {
            abort(403, 'Sorry !! You are Unauthorized to create any role !');
        }	
        $data = Company::All();
        $user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
		$comp_data = Company::where('approved','0')->orderBy('company_date','DESC')->get();
        $shiper_log = Shipper_request::get();
        $ship = Shipper_request::get();
        // $ship = Shipper_request::where('sender_id',$user_id)->get();
		$page = 'shipper_details';
        return view('backend.shipmentManagement.shipper.log.shipperapproverlog', compact('page','user','comp_data','user_id','shiper_log','ship'));
    }

    /* shipper request approver log function start here */
    
    /* Broker shipper request update function start here */
    public function ShipperFilterAdmin(Request $request){
        $user_id = Auth::id();
        $user = User::where('id',$user_id)->first();
        if($request->isMethod('get')){
            $data = $request->all();
            $companies = DB::table('companies')->leftjoin('users','users.id','=','companies.user_id');
            $ShipperName = $data['ShipperName'];
            $AgentName = $data['AgentName'];
            if(isset($ShipperStatus)){
                $query = $companies->where([ ['companies.approved', '=', $ShipperStatus] ]);
            }
            if(!empty($ShipperName)){
                $query = $companies->where([ ['companies.id', '=', $ShipperName] ]);
            }
            if(!empty($AgentName)){
            $query = $companies->where([ ['companies.user_id', '=', $AgentName] ]);
            }
            $CompaniesData = $query->get();
            return view('backend.shipmentManagement.shipper.shipper_filter',['comp_data'=>$CompaniesData]);
        }
    }
    public function RequsetCommentForm(Request $request){
        $user_id = Auth::id();
        $data = $request->all();
        $req_get = Shipper_request::where('id',$data['id'])->first();
        $carrierData = Company::where('id',$req_get['companies_id'])->first();
        $shipper_req = Shipper_request::where('companies_id',$carrierData['id'])->get();
        $upd_comment = Shipper_request::where('id',$data['id'])->update(['check_status'=> '1']);
        return view('backend.shipmentManagement.shipper.commentRequestForm', compact('carrierData','shipper_req'));
    }
    /* Broker shipper request update function start here */
    public function RequsetCommentUpdate(Request $request){
        $user_id = Auth::id();
        $data = $request->all();
        if(isset($data['curr']) === 'true'){
            $status = '0';
        } else{
            $status = '2';
        }
        if($status == '0'){
        Company::where('id',$data['id'])->update(['approved'=> $status]);
        }
    
        $shipper_req = Shipper_request::where('companies_id',$data['id'])->orderBy('id', 'DESC')->first();
        $agent = User::where('id',$shipper_req['user_id'])->first();
        if($shipper_req['sender_id'] == $user_id){
            $user_id= $shipper_req['sender_id'];
            $send_id = $shipper_req['receiver_id'];
        }else{
            $user_id= $shipper_req['receiver_id'];
            $send_id = $shipper_req['sender_id'];
        }
        $req_comment = New Shipper_request;
        $req_comment->sender_id = $user_id;
        $req_comment->receiver_id = $send_id;
        $req_comment->companies_id = $data['id'];
        $req_comment->comment = $data['comment'];
        $req_comment->request_date = date('Y-m-d');
        $req_comment->type = 'Shipper approved';
        $req_comment->save();
    }
}
