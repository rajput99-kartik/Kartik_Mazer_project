<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Load;
use App\Models\Shipment;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Artisan;
use DB;
use Session;
use Spatie\Activitylog\Models\Activity;
use Jenssegers\Agent\Agent;
use App\Models\LoadActivity;
use App\Models\CarrierPayment;
use App\Models\AccountsPayable;
use App\Models\AssignAcPayable;
use App\Models\Carrier_account;
use App\Models\Clockin;
use App\Models\ClockinInfo;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index(){
    //     return view('backend.dashboard');
    // }
    
    public function index(){

        $userid = Auth::id();
        $user_id =User::where('id', $userid)->first();
        $uid = $user_id->status ;
        
        $tloads = 0;
        $tusers = 0;
        //dd($uid);
        if ($uid == 0) {
            //THROW ERROR WITH CUSTOM MESSAGE
            // throw ValidationException::withMessages([$this->username() => __('User account has been deactivated.')]);
            //  return $this->sendFailedLoginResponse($request);
            //  return route('login');
                    Session::flush();
                   Artisan::call('view:clear');
                 throw ValidationException::withMessages(['email' => 'User account has been deactivated.']);
                return redirect()->back()->with('status','User account has been deactivated.');
                
           // $this->route('login');
        }else{
           
            if($userid==1){
                $tloads = DB::table('loads')->count();
                $tusers = DB::table('users')->count();
                $tcarrier = DB::table('carriers')->count();
                $tshipper = DB::table('companies')->count();

            }else{
                // $tloads = DB::table('loads')->where('user_id', $userid)->count();
                $tloads = DB::table('loads')->where([ ['user_id', '=', $userid],['load_status', '=', '0'] ])->count();
                $tusers = DB::table('assign_user_teams')->where('user_id', $userid)->count();
                $tcarrier = DB::table('carriers')->where('user_id', $userid)->count();
                $tshipper = DB::table('companies')->where('user_id', $userid)->count();

            }

            $loadDatagraph = Load::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
            $userid = 1 ;      
            $loadfull = " ";
            $user_loads = " ";
            
            //count shipment
            if($user_id->user_type=='super_admin'){
                $user_loads = Load::orderBy('id', 'DESC')->get();
                $loadfull= $user_loads ;
                $tshipment = Shipment::all()->count();
                $tCoverd = Shipment::where('shipment_statue', 'Covered')->count();
                $tDelivered = Shipment::where('shipment_statue', 'Delivered')->count();
                $tIntransit = Shipment::where('shipment_statue', 'In-transit')->count();
                $tOpen = Shipment::where('shipment_statue', 'Open')->count();
                $tPaid = Shipment::where('shipment_statue', 'Paid')->count();
                $tInvoiced = Shipment::where('shipment_statue', 'Invoiced')->count();
            }else{
                $user_loads= Load::where('user_id',$user_id->id)->orderBy('id','DESC')->get();
                $loadfull= $user_loads ;
                $tshipment = Shipment::where('user_id', $user_id->id)->count();
                $tCoverd = Shipment::where('shipment_statue', 'Covered')->where('user_id', $user_id->id)->count();
                $tDelivered = Shipment::where('shipment_statue', 'Delivered')->where('user_id', $user_id->id)->count();
                $tIntransit = Shipment::where('shipment_statue', 'In-transit')->where('user_id', $user_id->id)->count();
                $tOpen = Shipment::where('shipment_statue', 'Open')->where('user_id', $user_id->id)->count();
                $tPaid = Shipment::where('shipment_statue', 'Paid')->where('user_id', $user_id->id)->count();
                $tInvoiced = Shipment::where('shipment_statue', 'Invoiced')->where('user_id', $user_id->id)->count();
            }

            // for shipper start 
            $GetUser =  User::where('user_type', 'agent')->orwhere('user_type', 'officer')->get();
            $comp_data = Company::get();
            $total =  Company::count();
            $shipper_pending =  Company::where('approved', '=', '0')->count();
            $shipper_approve =  Company::where('approved', '=', '1')->count();
            $DisApprove =  Company::where('approved', '=', '2')->count();
            // for shipper end
            
            $alluser = User::all();

            //for activity user start
                $agent = new Agent();
                $browser = $agent->browser();
                $authName = Auth::User();
                $data = Activity::orderBy('id','desc')->get();
                $data = Activity::orderBy('id','desc')->paginate(10);
                
            //for activity user end

            //for Dashboard CarrierUrgentPay for ap user only start 
            $apUrgentpayments = CarrierPayment::where('m_status','0')->orwhere('quickpay_status','1')->orwhere('highlight_status','1')->get();

            $apPaymentpending = AccountsPayable::where('aging_status','1')->where('pay_complete','0')->count();

            $us_id = Auth::id();
            $carrierAging = AssignAcPayable::where('ap_user',$us_id)
            ->with('getAccountPayable.getshipmentdata.getapcdata')
            ->with('apassignbyuser')->with('apTeamLeader')
            ->with('apTeamAgent')->count(); 

            $aptotalCarrier =  Carrier_account::all()->count();
           //dd($aptotalCarrier);
            //dd($apPaymentpending);
            //for CarrierUrgentPay for ap user only end 
            
            $userid = Auth::id();
            if($userid == 1 ){
                $clockin = Clockin::whereDate('created_at', '=', date('Y-m-d'))->orderBy('id','DESC')->get();
            }else{
                    $clockin = Clockin::where('user_id', $userid)->orderBy('id','DESC')->get();
                }

            return view('backend.dashboard', compact('tloads', 'tusers','tshipper','tcarrier','loadDatagraph','user_loads','loadfull','tshipment','tCoverd','tDelivered','tIntransit','tOpen',
            'GetUser','comp_data','total','shipper_pending','shipper_approve', 'DisApprove','alluser',
            'agent', 'browser','authName','data','tPaid','tInvoiced','apUrgentpayments','apPaymentpending','carrierAging','aptotalCarrier','clockin'
            ));
        }
    }

    public function userPasswordRest(Request $request){
        // $response = [];
        // if($request->isMethod('post')){
            $data = $request->all();
            print_r($data);die;

            return view('passwordrest',compact());

    }

    public function handleChart()
    {
        $loadDatagraph = Load::select(\DB::raw("COUNT(*) as count"))
                    ->whereYear('created_at', date('Y'))
                    ->groupBy(\DB::raw("Month(created_at)"))
                    ->pluck('count');
          
        return view('backend.dashboard', compact('loadDatagraph'));

    }

    public function CarrierUrgentPay(Request $request)
    {
        $shipment_data = CarrierPayment::where('m_status','0')->orwhere('quickpay_status','1')->orwhere('highlight_status','1')->get();
        //dd($shipment_data);
        $active = 'UrgentPayment';
        $page = 'UrgentPayment';
        return view('backend.accountManagement.apManagement.carrierPayment.urgentpay', compact('page','active','shipment_data'));

    }







}
