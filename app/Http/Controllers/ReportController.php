<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Load;
use App\Models\Agency;
use App\Models\Agency_detail;
use App\Models\User;
use App\Models\Shipment;
use App\Models\Company;
use DB;




class ReportController extends Controller
{
    function index(){
        return view('backend.reportManagement.index');
    }
    
    public function loadReport($id){
        $userid = $id;
        if($userid==0){
            $user_loads = Load::all();
        }else{
            $user_loads = Load::where('user_id', $userid)->get();
        }
        return view('backend.reportManagement.loads', compact('user_loads'));
    }


    public function agencyreport(Request $request, $id){
        $userid = $id;

        $data = Agency::with('office.officData')->get();
       // dd($data);
        if($userid== '0'){
            $data = Agency::with('office.officData')->get();
        //            dd($data);
        
        }else{
            $data = Agency::where('id',$id)->with('office.officData')->get();
        }
        //dd($data);
        return view('backend.reportManagement.agencyreport', compact('data'));
    }



    // public function newoffice(Request $request){
	// 	$data  = Agency::with('office.officData')->get();
	// 	//$item = User::where('assignto_id',$id)->get();
	// 	$page = 'Manager List';
    //     return view('backend.agencyManagement.agency.manage.newoffice', compact('page','data'));
	// }
	
	function shipmentreport(){
	    $user_id = auth()->user()->id ;   
			$user = DB::table('users')->where([
                        ['id', '=', $user_id],
                    ])->first();
            
            $GetUser =  User::where('user_type', 'agent')->orwhere('user_type', 'officer')->get();
            $Equipments = DB::table('equipment_types')->get();

            
           $shipment =  Shipment::get();
           $total =  Shipment::count();
           $shipment_open =  Shipment::where('shipment_statue', '=', 'Open')->count();
           $shipment_covered =  Shipment::where('shipment_statue', '=', 'Covered')->count();
           $shipment_transit =  Shipment::where('shipment_statue', '=', 'In-transit')->count();
           $shipment_delivered =  Shipment::where('shipment_statue', '=', 'Delivered')->count();
           $shipment_paid =  Shipment::where('shipment_statue', '=', 'Paid')->count();
           $shipment_invoice =  Shipment::where('shipment_statue', '=', 'Invoiced')->count();
           

            $shipment1 = DB::table('shipment')
						->leftjoin('companies', 'companies.id', '=', 'shipment.companies_id')
						->leftjoin('carriers', 'carriers.id', '=', 'shipment.carrier_id')
						->where([ ['shipment.user_id', '=', $user_id] ])
						->select('shipment.id','companies.company_name','carriers.c_company_name','shipment.shipment_statue')
						->orderBy('shipment.id','DESC')->get();
			
            $active = 'all_shipment';
            return view('backend.reportManagement.shipmentreport', compact('GetUser','shipment','shipment_open','shipment_covered','shipment_delivered','shipment_paid','shipment_invoice','shipment_transit','total'));
	}
	
	function shipperreport(){
	    $GetUser =  User::where('user_type', 'agent')->orwhere('user_type', 'officer')->get();
        $comp_data = Company::get();
        $total =  Company::count();
        $shipper_pending =  Company::where('approved', '=', '0')->count();
        $shipper_approve =  Company::where('approved', '=', '1')->count();
        $DisApprove =  Company::where('approved', '=', '2')->count();
        
        //echo '<pre>'; print_r($comp_data);die; 

        $page = 'shipper_details';
        return view('backend.reportManagement.shipperreport', compact('page','GetUser','comp_data','total','shipper_pending','shipper_approve', 'DisApprove'));
	}

}
