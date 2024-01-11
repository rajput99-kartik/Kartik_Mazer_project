<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\AccountsPayable;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Agency;
use App\Models\Shipment;
use App\Models\Company; 
use App\Models\AssignAcReceivable;
use App\Models\AccountReceivable;
use App\Models\Carrier_account; 
use App\Models\Agency_detail;
use App\Models\ShipmentDoc;
use App\Models\Invoices;
use Carbon\Carbon;
use App\Models\PaymentHistory;
use Barryvdh\DomPDF\Facade\Pdf;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;

use DB;
use Hash;
use File;
use Auth;
use Mail;



class AccountReceivableController extends Controller
{

public function index(){

    $userid = Auth::id();
    $userdata = AssignAcReceivable::where('ar_user',$userid)
    ->with('accountShipments.getShipments.shipmentPrice')->with('accountShipments.getShipments.getCompany')
    ->with('arTeamLeader')->with('arAssignbyuser')->with('arTeamAgent')->get();

     

    $userdata_price = AssignAcReceivable::where('ar_user',$userid)
        ->with('arAssignbyuser')->with('arTeamLeader')
        ->with('arTeamAgent')->with('accountShipments.getShipments.shipmentprice')->with('accountShipments.getShipments.getCompany')->get();
       
        
        $price = [];
        $total_price = [];
        

    return view('backend.accountManagement.arManagement.index',compact('userdata','total_price'));

}

public function ArAssignShipmentList(Request $request){

    $userid = Auth::id();
    // $userdata = AssignAcReceivable::where('ar_user',$userid)
    // ->with('accountShipments.getShipments.shipmentPrice')->with('accountShipments.getShipments.getCompany')
    // ->with('arTeamLeader')->with('arAssignbyuser')->with('arTeamAgent')->get();

    $userdata = AssignAcReceivable::where('ar_user',$userid)->where('status','1')->get();
    //dd($AssignAcReceivable);

    return view('backend.accountManagement.arManagement.shipment_list',compact('userdata','userid'));

}

public function AgingInvoiceGenerated(){
    $userid = Auth::id();
    
    $userdata = AssignAcReceivable::where('ar_user',$userid)->get();

    $Invoicedata = [];

    $Invoicedata = Invoices::where('invoice_status','0')->where('pay_status','1')->get();

    // foreach($userdata as $result){
    //     $Invoicedata[] = Shipment::where('user_id',$result['assign_agent_to'])
    //     ->has('invoiceget')
    //     ->with('invoiceget.priceget')
    //     ->with('invoiceget.broker')->with('invoiceget.companyget')
    //     ->get();
    // }

    return view('backend.accountManagement.arManagement.invoice_aging',compact('Invoicedata','userid'));
}



public function ArPayCompleted(Request $request)
{
    $userid = Auth::id();
    $req = $request->all();

    $pay_data = Invoices::where('pay_status','2')->get();

    return view('backend.accountManagement.arManagement.pay_completed',compact('pay_data','userid'));
}

public function ShipmentDetail($id)
{
    $userid = Auth::id();
    

    $shipment = AssignAcReceivable::where('assign_agent_to',base64_decode($id))
    ->with('accountShipments.getShipments.shipmentPrice')
    ->with('accountShipments.getShipments.shipmentPick')
    ->with('accountShipments.getShipments.shipmentDrop')
    ->with('accountShipments.getShipments.getCompany')
    ->with('arTeamLeader')->with('arAssignbyuser')->with('arTeamAgent')->get();


    $AssignAcReceivable = AssignAcReceivable::where('assign_agent_to',base64_decode($id))->where('ar_user',$userid)->first();
        //dd($AssignAcReceivable);
    if($AssignAcReceivable->status == '1'){

        $shipdataResult = Shipment::where('user_id',base64_decode($id))->where('ar_access_status', '1')->where('ar_invoice', null)->orderBy('id','desc')->get(); 
       
        return view('backend.accountManagement.arManagement.Shipment_detail',compact('shipment','userid','shipdataResult'));
    }else{
        return redirect('/admin/ar/shipment-list')->with('errors','You have no permission!');
    }
}

public function view($id){
    $userid = Auth::id();
    $data = User::where('user_type','agent');
    $roles = Role::pluck('name','id')->all();
    $agency = Agency::pluck('agencies_name','id')->all();
    $userdata = AssignAcReceivable::where('assign_agent_to',base64_decode($id))
    ->with('arAssignbyuser')->with('arTeamLeader')
    ->with('arTeamAgent')->get();
    //$userdata = AccountPayable::where('user_id',$id)->with('apTeamAgent')->get();
    //dd($userdata);

    return view('backend.accountManagement.arManagement.view',compact('data','id','roles','agency','userdata'));
}

public function list(){
        $userid = Auth::id();
        
        $userdata = AssignAcReceivable::where('assign_agent_to',$userid)
        //->with('accountShipments.getShipments.shipmentPrice')->with('accountShipments.getShipments.getCompany')
        //->with('arTeamLeader')->with('arAssignbyuser')->with('arTeamAgent')
        ->get();
    
        
            
            $Invoicedata[] = Shipment::where('shipment_statue','Invoiced')
            ->has('invoiceget')
            ->with('invoiceget.priceget')
            ->with('invoiceget.broker')->with('invoiceget.companyget')
            ->get();
    
        //dd($Invoicedata);
    
        return view('backend.accountManagement.arManagement.aging_list',compact('Invoicedata','userid'));
    }


/* Invoice generated and save documnet file funnction start*/
public function InvoiceGenerate($id)
{
    $userid = Auth::id();

    $timezone=date_create("",timezone_open("America/New_York"));
    $todaydate = date_format($timezone,"m-d-Y");

    $shipments = Shipment::where('id',$id)
                ->with('companyDetail')->with('shipmentPrice')
                ->with('shipmentPick')->with('shipmentDrop')
                ->with('UserDetail')->get(); 
        //dd($shipments);

    foreach($shipments as $key => $sdata){
        $cname = $sdata->companyDetail['company_name'];
        $cid = $sdata->companyDetail['id'];
        $uid = $sdata['user_id'];
        $price = $sdata->shipmentPrice[$key]['customer_total'];
    }
    //dd($shipments);  
        
    $customPaper = array(0,0,650,1040);
    $pdf = PDF::loadView('backend.accountManagement.arManagement.invoice_generate_pdf',compact('shipments','todaydate'))->setPaper($customPaper);
    
    $path = base_path('public/ar_invoice/');
    $fileName =  time().'ar_invoic_'.$id.'.pdf';
    $fileName2 = $path.$fileName;

    $pdf->save($path . '/' . $fileName);
    $file = base_path('public/ar_invoice/').$fileName;

    
    $file1 = '';
    $shipment_doc1 = ShipmentDoc::where('shipment_id',$id)->where('type','pod')->first();
    if($shipment_doc1){
        $file1 =   public_path('/').'shipment_doc/'.$shipment_doc1['document_name'];
        //$file1 =  public_path('/').'shipment_doc/1662726682RCsample.pdf';
    }
    $shipment_doc2 = ShipmentDoc::where('shipment_id',$id)->where('type','shipper_doc')->first();
    if($shipment_doc2){
        $file2 =  public_path('/').'shipment_doc/'.$shipment_doc2['document_name'];
    }

    $ffff = public_path('/').'ar_invoice/'.$fileName;
    
if(!empty($file1)){
        $oMerger = PDFMerger::init();

        $oMerger->addPDF($ffff, 'all');
        if(isset($file1)){ $oMerger->addPDF($file1, 'all'); }
        if(isset($file2)){ $oMerger->addPDF($file2, 'all'); }
        

        $oMerger->merge();
        //$finl = $oMerger->stream('Invoice_5545');
        
        $pathInvoice = base_path('public/invoice_generate/');
        $InvoiceName =  time().'Invoice_'.$id.'.pdf';
        $InvoiceNamePath = 'public/invoice_generate/'.$InvoiceName;

        $oMerger->save($pathInvoice . '/' . $InvoiceName);
        $fileInv = base_path('public/invoice_generate/').$InvoiceName;


        $InvoicResult = Invoices::where('shipment_id',$id)->first();

        if(empty($InvoicResult))
        {
                $invoice = new Invoices;
                $invoice->shipment_id   =  $id;
                $invoice->companies_id	= $cid;
                $invoice->user_id       =  $uid;
                $invoice->document_name	= $InvoiceNamePath;
                $invoice->start_date	= $todaydate;
                $invoice->customer_name	= $cname;
                $invoice->invoice_amt	= $price;
                $invoice->save();

                $payHistory = new PaymentHistory;
                $payHistory->shipment_id   =  $id;
                $payHistory->invoice_id   =  $invoice->id;
                $payHistory->user_id       =  $uid;
                $payHistory->document_name	= $InvoiceNamePath;
                $payHistory->customer_name	= $cname;
                $payHistory->invoice_amt	= $price;
                $payHistory->save();

                $ShipmentStatus = Shipment::where('id',$id)->Update(['shipment_statue' => 'Invoiced']);

        }else{
                
            //$InvUpdate = Invoices::where('id',$InvoicResult['id'])->first();
            //dd($InvUpdate);
            $InvoicResult->document_name = $InvoiceNamePath;
            $InvoicResult->invoice_amt = $price;
            $InvoicResult->start_date = $todaydate;
            $InvoicResult->save();
            

            $payHistory = new PaymentHistory;
            $payHistory->shipment_id   =  $id;
            $payHistory->invoice_id   =  $InvoicResult['id'];
            $payHistory->user_id       =  $uid;
            $payHistory->document_name	= $InvoiceNamePath;
            $payHistory->customer_name	= $cname;
            $payHistory->invoice_amt	= $price;
            $payHistory->save();
        }
        
        


    return view('backend.accountManagement.arManagement.invoice_generate',compact('shipments','InvoiceName','id','cid','uid'));
}else {
    return redirect('/admin/ar/shipment-detail/'.base64_encode($uid))->with('errors','Documents not uploaded yet!');
}

}
/* Invoice generated and save documnet file funnction end*/


public function ShipperEmailSent(Request $request)
{
    $userid = Auth::id();
    $req = $request->all();
    
    $Invoices = Invoices::where('shipment_id',$req['load_id'])->first();
    $files= base_path('/').$Invoices['document_name'];
      
        $data = array('to'=>$request->input('email_to'),'email_body'=>$request->input('email_body'));
					Mail::send('emails.billing.invoice_sent', $data, function($message) use ($req,$files) {
					   $message->to($req['email_to'], 'AMB Logistic')->cc('rohn16@amblogistic.us')->attach($files)->subject
						  ($req['subject']);
					});


        $invoice_update = DB::update('update invoices set invoice_status =? where shipment_id = ?',[ '1',$req['load_id']]);
        $shipment = DB::update('update shipment set shipment_statue =? where id = ?',[ 'Invoiced',$req['load_id'] ]);
   
}



public function PaymentUpdateForm(Request $request)
{
    $userid = Auth::id();
    $req = $request->all();
    
    $Invoices = Invoices::where('shipment_id',$req['shipment_id'])->first();
    //print_r($Invoices);die;
    return view('backend.accountManagement.arManagement.payment_update',compact('Invoices'));

   }


public function PaymentUpdateSubmit(Request $request)
{
    $userid = Auth::id();
    $data = $request->all();
    //print_r($data['pay_mode']);die;
    
    $invoice_update = Invoices::where('id',$data['shipment_id'])->first();
    //$invoice_update = new Invoices;
    $invoice_update->pay_mode	        = $data['pay_mode'];
    $invoice_update->invoice_amt	    = $data['invoice_amount'];
    $invoice_update->balance_due	    = $data['balance_due'];
    $invoice_update->amount_paid	    = $data['amount_paid'];
    $invoice_update->check_date	        = $data['check_date'];
    $invoice_update->date_received	    = $data['received_date'];
    $invoice_update->deposit_date	    = $data['deposit_date'];
    $invoice_update->pay_status	        = '2';
    $invoice_update->save();

    //$upd = Company::where('id',$data['companies_id'] )->update(['credit_limit'=>$data['limit'],'approved'=>$data['status']]);
    //$shipdataResult = Shipment::where('user_id',base64_decode($id))->where('ar_access_status', '1')->where('ar_invoice', null)->orderBy('id','desc')->get();
    $Invoices = Shipment::where('id',$data['pro_num'])->Update(['ar_invoice'=>'1','shipment_statue' => 'Paid']);

}



    
   
}
