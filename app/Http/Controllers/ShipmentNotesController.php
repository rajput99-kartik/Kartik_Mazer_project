<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB,Hash,DateTime,Mail,File,Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Redirect,Response;
use Carbon\Carbon;
use App\Models\Shipment;
use App\Models\Shipmentpick;
use App\Models\Shipmentdrop;
use App\Models\ShipmentDoc;
use App\Models\Shipmentrate;
use App\Models\AccountsPayable;
use App\Models\AccountReceivable;
use App\Models\Dat;
use App\Http\Requests;
use App\Models\User;
use App\Models\EquipmentType;
use App\Models\Company;
use App\Models\Notification;
use App\Models\AgencyDetail;
use App\Models\AssignUserTeam;
use App\Models\CarrierPayment;
use App\Models\LoadActivity;
use App\Models\LoadActivityInfo;
use App\Models\ShipmentBol;
use App\Models\ShipmentBolItem;
use App\Models\ShipmentNotes;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\LogOptions; 
use Spatie\Activitylog\Traits\LogsActivity;
class ShipmentNotesController extends Controller
{
    public $user;
    function __construct()
    {
         $this->middleware('permission:shipment-list|shipment-view|shipment-approve|shipment-create|shipment-edit|shipment-delete', ['only' => ['index','store']]);
         $this->middleware('permission:shipment-approve', ['only' => ['approve','approve']]);
         $this->middleware('permission:shipment-create', ['only' => ['create','store']]);
         $this->middleware('permission:shipment-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:shipment-delete', ['only' => ['destroy']]);
         $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('web')->user();
            return $next($request);
        });
    }
    public function ShipmentNotes(Request $request){
            // if (is_null($this->user) || !$this->user->can('shipment-notes')) {
            //     abort(403, 'Sorry !! You are Unauthorized to view any admin !');
            // }
            $user_id = auth()->user()->id ;   
            $user = DB::table('users')->where([
                        ['id', '=', $user_id],
                    ])->first();
                    $uid = $request->shipment_id;
            
            $Shipmentnotes = new ShipmentNotes;	
            $Shipmentnotes->user_id         = $request->user_id;
            $Shipmentnotes->type            =  $request->title_type;
            $Shipmentnotes->description     = $request->description;
            $Shipmentnotes->shipment_id     = $request->shipment_id;
            $ShipmentnotesSave = $Shipmentnotes->save();
            // $request->session()->flash('success', 'Shipment Note Add successfully');
            return back()->with('success', 'Shipment Note Add successfully');
    }
    public function rateprepay(Request $request){
        // $dd= $request->all();
        $cmpid= $request->shipper_name_testamb;
        $hun = 100;
        $bal1 = $request->unit1_customer;
        $bal2 = $request->unit2_customer;
        $bal3 = $request->lh_customer;
        $bal4 = $request->customer1;
        $bal5 = $request->customer2;
        $bal6 = $request->customer3;
        $bal7 = $request->customer4;
        $bal8 = $request->customer5;
        $bal9 = $request->customer6;
        $bal11 = $request->customer7;
        $bal12= $request->customer8;
        $subdata =  $bal1+$bal2+$bal3+$bal4+$bal5+$bal6+$bal7+$bal8+$bal9+$bal11+$bal12 ;
        // $ddataa = array_sum($bal1);
       
        
        $compdata = Company::where('id',$cmpid)->pluck('credit_limit')->first();
        $mblc = $compdata - $hun ;
        $maninbalance = $mblc - $bal1;
        if($maninbalance == $hun ||  $maninbalance < $subdata  || empty($subdata)){
                if($subdata == 0){
                    $data = [
                    'errors' => false,
                    'message'=> 'You are not eligible '.$compdata,
                    ] ;
                    // return 0;
                 return response()->json($data);
                }
                // return response()->json($data);
        }else{
                $data = [
                'success' => true,
                'message'=> 'You are eligible '.$maninbalance,
                ] ;
                //return 1;
                return response()->json($data);
        }
    }
    public function carrierrateprepay(Request $request){
        $hun = 100;
        //new way
         $carrier1 =   $request->rate_unit1_carrier;
         $carrier2 =   $request->rate_unit2_carrier;
         $carrier3 =   $request->lh_carrier;
         $carrier4 =   $request->carrier1;
         $carrier5 =   $request->carrier2;
         $carrier6 =   $request->carrier3;
         $carrier7 =   $request->carrier4;
         $carrier8 =   $request->carrier5;
         $carrier9 =   $request->carrier6;
         $carrier10 =  $request->carrier7;
         $carrier11 =  $request->carrier8;
        //end way
        $carriersum =  $carrier1+$carrier2+$carrier3+$carrier4+$carrier5+$carrier6+$carrier7+$carrier8+$carrier9+$carrier10+$carrier11;
        if($carriersum < 100 ){
                    $data = [
                    'errors' => false,
                    'message'=> 'You are not eligible ',
                    ] ;
                    return 0;
                //  return response()->json($data);
                // return response()->json($data);
        }else{
                $data = [
                'success' => true,
                'message'=> 'You are eligible',
                ] ;
                return 1;
                // return response()->json($data);
        }
    }
}
