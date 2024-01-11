<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Auth,Hash,DateTime,Mail,PDF,File,Session;
use DB;
use App\Models\Carriers;
use App\Models\Shipment;
use App\Models\Carrier_account;
use App\Models\CarrierPayment;
use App\Models\AccountsPayable;
use App\Models\AssignAcPayable;
use App\Models\Shipmentrate;

class CarrierPaymentController extends Controller
{
    
    
    /* Carrier payment list Function Start Here */
    public function CarrierPayment(Request $request)
    {
        
        $shipment_data = AccountsPayable::where('aging_status','1')->where('pay_complete','0')->get();

        $active = 'CarrierPayment';
        $page = 'CarrierPayment';
        return view('backend.accountManagement.apManagement.carrierPayment.index', compact('page','active','shipment_data'));

    }
    /* Carrier payment list Function End Here */
    
    
    /* Carrier Urgent payments Function Start Here */
    public function CarrierUrgentPay(Request $request)
    {
        
        $shipment_data = CarrierPayment::where('m_status','0')->orwhere('quickpay_status','1')->orwhere('highlight_status','1')->get();

        //dd($shipment_data);
        $active = 'UrgentPayment';
        $page = 'UrgentPayment';
        return view('backend.accountManagement.apManagement.carrierPayment.urgentpay', compact('page','active','shipment_data'));

    }
    /* Carrier Urgent payments Function End Here */


    /* Carrier updated pay details Function Start Here */
    public function PendingPayment(Request $request)
    {

        $shipment_data = CarrierPayment::where('m_status','1')->where('p_status','0')->get();
        //dd('test');
        
        $active = 'CarrierPayment';
        $page = 'CarrierPayment';
        return view('backend.accountManagement.apManagement.carrierPayment.pendingpay', compact('page','active','shipment_data'));
    }
    /* Carrier updated pay details Function End Here */
    

    /* Carrier payment aging for agent Function Start Here */
    public function PaymentAging(Request $request)
    {

        $userid = Auth::id();
        $userdata = AssignAcPayable::where('ap_user',$userid)
        ->with('getAccountPayable.getshipmentdata.getapcdata')
        ->with('apassignbyuser')->with('apTeamLeader')
        ->with('apTeamAgent')->get(); 

        //dd($userdata);
        return view('backend.accountManagement.apManagement.carrierPayment.carrieraging', compact('userdata'));
    }
    /* Carrier payment aging for agent Function End Here */
    

    public function CarrierPayUpdate(Request $request,$id)
    {
        $shipment_id = base64_decode($id);

        $shipment = Shipment::where('id',$shipment_id)->first();
        $carrier = Carriers::where('id',$shipment->carrier_id)->first();
        $carrier_acc = Carrier_account::where('carrier_id',$shipment->carrier_id)->first();
        //dd($carrier_acc);
        return view('backend.accountManagement.apManagement.carrierPayment.form', compact('shipment_id','carrier','carrier_acc'));

    }
 
    
    public function CarrierPayDetails(Request $request,$id)
    {
        $shipment_id = base64_decode($id);
        
        
        $shipment = Shipment::where('id',$shipment_id)->first();
        $carrier = Carriers::where('id',$shipment->carrier_id)->first();
        $carrier_acc = Carrier_account::where('carrier_id',$shipment->carrier_id)->first();
        //dd($carrier_acc);
        return view('backend.accountManagement.apManagement.carrierPayment.payform', compact('shipment_id','carrier','carrier_acc'));

    }

    
    public function CarrierPayDone(Request $request,$id)
    {
        $shipment_id = base64_decode($id);

        $carrier_payment = CarrierPayment::where('shipment_id',$shipment_id)->first();
        
        $carrier_payment->p_status = '1';
        $carrier_payment->p_date   = date('Y-m-d');
        $carrier_payment->save();
       
        return redirect('/admin/carrier/pending/payment')->with('success','Carrier Payment Done!');
    }


    public function DonePayments(Request $request)
    {
        //$shipment_id = base64_decode($id);

        $pay_done = CarrierPayment::where('m_status','1')->where('p_status','1')->orderBy('shipment_id','desc')->get();
        
        return view('backend.accountManagement.apManagement.carrierPayment.paydone', compact('pay_done'));
    }

    /** Carrier payment request Complete from mam start Here **/
    public function PayCompleted(Request $request,$id)
    {
        $shipment_id = base64_decode($id);
        $shipment = Shipment::where('id',$shipment_id)->first();
        $carrier = Carriers::where('id',$shipment->carrier_id)->first();
        $carrier_acc = Carrier_account::where('carrier_id',$shipment->carrier_id)->first();
        $carrier_payment = CarrierPayment::where('shipment_id',$shipment_id)->first();
        //dd($shipment_id);

        $price = Shipmentrate::where('shipment_id',$shipment_id)->first();

        if($carrier_acc->payto == '0'){

            $payto = 'Carrier';
            $email = $carrier->email;
            $phone = $carrier->phone_no;

        }elseif($carrier_acc->payto == '1'){

            $payto = 'Factory';
            $email = $carrier_acc->f_email;
            $phone = $carrier_acc->f_phone;

        }
        if($carrier_acc->pay_mode == '3'){

            $routing = $carrier_acc->ach_routing_number;
            $b_name = $carrier_acc->bank_name;
            $acc_number = $carrier_acc->account_number;
            $payment_type = 'ACH';

        }elseif($carrier_acc->pay_mode == '4'){

            $routing = $carrier_acc->wire_routing_number;
            $b_name = $carrier_acc->w_bank_name;
            $acc_number = $carrier_acc->w_account_number;
            $swift_code = $carrier_acc->swift_code;
            $payment_type = 'WIRE';
        }elseif($carrier_acc->pay_mode == '5'){
            return redirect('/admin/carrier/payment/updates')->with('errors','Carrier Pay type Check Selected');
        }

        //dd($shipment_id);

        if(empty($carrier_payment)){

            $payment = New CarrierPayment;
            $payment->shipment_id   = $shipment_id;
            $payment->carrier_id    = $shipment->carrier_id;
            $payment->carrier_name  = $carrier->c_company_name;
            $payment->carrier_mc    = $carrier->mc_no;
            $payment->carrier_dot   = $carrier->dot_no;
            $payment->carrier_phone = $phone;
            $payment->carrier_email = $email;
            $payment->pay_to        = $payto;
            $payment->routing       = $routing;
            $payment->bank_name     = $b_name;
            $payment->account_number = $acc_number;
            $payment->carrier_payment = $price->carrier_total;
            $payment->payment_type  = $payment_type;
            $payment->m_status      = '1';
            $payment->m_date        = date('Y-m-d');
            $payment->p_status      = '0';
            
            if($payment->save()){

                $shipment_data = AccountsPayable::where('shipment_id',$shipment_id)->update(['pay_complete'=>'1']);

                return redirect('/admin/carrier/payment/updates')->with('success','Carrier Pay details Update');
            }else{
                return redirect('/admin/carrier/payment/updates')->with('errors','Carrier Banks Details not updated');
            }
        }else{

            $carrier_payment->pay_to        = $payto;
            $carrier_payment->routing       = $routing;
            $carrier_payment->bank_name     = $b_name;
            $carrier_payment->account_number = $acc_number;
            $carrier_payment->carrier_payment = $price->carrier_total;
            $carrier_payment->payment_type  = $payment_type;
            $carrier_payment->m_status      = '1';
            $carrier_payment->m_date        = date('Y-m-d');
            
            if($carrier_payment->save()){
                
                $shipment_data = AccountsPayable::where('shipment_id',$shipment_id)->update(['pay_complete'=>'1']);
                return redirect('/admin/carrier/payment/updates')->with('success','Carrier Pay details Update');

            }else{
                return redirect('/admin/carrier/payment/updates')->with('errors','Carrier Banks Details not updated');
            }
        }

    }
    /** Carrier payment request Complete from mam start End **/

    /** Carrier payment highlight request start here **/
    public function PaymentHighlight(Request $request,$id)
    {
        $shipment_id = base64_decode($id);
        $Carrier_Payment = CarrierPayment::where('shipment_id',$shipment_id)->first();
        //dd($Carrier_Payment);

        if(empty($Carrier_Payment)){

        $shipment = Shipment::where('id',$shipment_id)->first();
        $carrier = Carriers::where('id',$shipment->carrier_id)->first();
        $carrier_acc = Carrier_account::where('carrier_id',$shipment->carrier_id)->first();

        if($carrier_acc->payto == '0'){

            $email = $carrier->email;
            $phone = $carrier->phone_no;

        }elseif($carrier_acc->payto == '1'){

            $email = $carrier_acc->f_email;
            $phone = $carrier_acc->f_phone;

        }
        if($carrier_acc->pay_mode == '3'){

            $routing = $carrier_acc->ach_routing_number;
            $b_name = $carrier_acc->bank_name;
            $acc_number = $carrier_acc->account_number;

        }elseif($carrier_acc->pay_mode == '4'){

            $routing = $carrier_acc->wire_routing_number;
            $b_name = $carrier_acc->w_bank_name;
            $acc_number = $carrier_acc->w_account_number;
            $swift_code = $carrier_acc->swift_code;
        }

        //dd($shipment_id);
            $payment = New CarrierPayment;
            $payment->shipment_id = $shipment_id;
            $payment->carrier_id = $shipment->carrier_id;
            $payment->carrier_name = $carrier->c_company_name;
            $payment->carrier_mc = $carrier->mc_no;
            $payment->carrier_dot = $carrier->dot_no;
            $payment->carrier_phone = $phone;
            $payment->carrier_email = $email;
            $payment->highlight_status = '1';
            $payment->highlight_date = date('Y-m-d');
            $payment->m_status = '0';
            $payment->p_status = '0';
            $payment->save();

            return redirect('/admin/carrier/payment/aging')->with('success','Carrier Payment Update in priority.');
     }else{
        return redirect('/admin/carrier/payment/aging')->with('errors','Payment already added in priority.');
     }

    }
    /** Carrier payment highlight request start End **/


    /** Carrier payment quickpay request start Here **/
    public function PaymentQuickPay(Request $request)
    {
        $shipment_id = $request->input('shipment_id');

        $Carrier_Payment = CarrierPayment::where('shipment_id',$shipment_id)->first();
        $Shipmentrate = Shipmentrate::where('shipment_id',$shipment_id)->first();

        if(!empty($Shipmentrate->quickpay_amount)){
            //dd($Shipmentrate->quickpay_amount);
                if(empty($Carrier_Payment)){

                $shipment = Shipment::where('id',$shipment_id)->first();
                $carrier = Carriers::where('id',$shipment->carrier_id)->first();
                $carrier_acc = Carrier_account::where('carrier_id',$shipment->carrier_id)->first();

                if($carrier_acc->payto == '0'){

                    $email = $carrier->email;
                    $phone = $carrier->phone_no;

                }elseif($carrier_acc->payto == '1'){

                    $email = $carrier_acc->f_email;
                    $phone = $carrier_acc->f_phone;

                }
                if($carrier_acc->pay_mode == '3'){

                    $routing = $carrier_acc->ach_routing_number;
                    $b_name = $carrier_acc->bank_name;
                    $acc_number = $carrier_acc->account_number;

                }elseif($carrier_acc->pay_mode == '4'){

                    $routing = $carrier_acc->wire_routing_number;
                    $b_name = $carrier_acc->w_bank_name;
                    $acc_number = $carrier_acc->w_account_number;
                    $swift_code = $carrier_acc->swift_code;
                }

                //dd($shipment_id);
                    $payment = New CarrierPayment;
                    $payment->shipment_id = $shipment_id;
                    $payment->carrier_id = $shipment->carrier_id;
                    $payment->carrier_name = $carrier->c_company_name;
                    $payment->carrier_mc = $carrier->mc_no;
                    $payment->carrier_dot = $carrier->dot_no;
                    $payment->carrier_phone = $phone;
                    $payment->carrier_email = $email;
                    $payment->quickpay_precent = $Shipmentrate->quickpay_deduction;
                    $payment->quickpay_amount = $Shipmentrate->quickpay_amount;
                    $payment->quickpay_date = date('Y-m-d');
                    $payment->quickpay_status = '1';
                    $payment->m_status = '0';
                    $payment->p_status = '0';
                    $payment->save();

                    echo '1';
                    //return redirect('/admin/carrier/payment/aging')->with('success','Carrier Payment Update in priority.');
            }else{


                    echo '2';
                    
                    $Carrier_Payment->quickpay_precent = $Shipmentrate->quickpay_deduction;
                    $Carrier_Payment->quickpay_amount = $Shipmentrate->quickpay_amount;
                    $Carrier_Payment->quickpay_date = date('Y-m-d');
                    $Carrier_Payment->save();
                //return redirect('/admin/carrier/payment/aging')->with('errors','Payment already added in priority.');
            }
        }else{
            echo '3'; //shipment price not save yet
        }

    }
    /** Carrier payment quickpay request End Here **/
    


}
