<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Models\Shipmentrate;
use App\Models\Shipmentdrop;
use App\Models\Shipmentpick;
use App\Models\Company;
use App\Models\Invoices;
use App\Models\Agency_detail;

use Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


use App\Models\User;


class Shipment extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;
    protected $table = 'shipment';

      protected static $recordEvents = ['created','updated','deleted'];
    

      public function getActivitylogOptions(): LogOptions
      {

        $uid =Auth::id();
        $uName =User::where('id',$uid)->first('name');
        $uNameData =  isset($uName->name) ? $uName->name :Null;
        
        $lastActivity = Activity::latest()->first();
        $eventName = '';

        $eventName =isset($eventName) ? $eventName : Null  ;
        if(empty($activity)){
            $eventName = 'shipment';
        }


        return LogOptions::defaults()
        ->useLogName('shipment-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Shipment Detail {$eventName} by $uNameData")
        ->logOnly(['user_id', 'loads_id','carrier_id','companies_id', 'shipment_statue','ref_loads','equipment_loads','full_partial','mode','payment_mode',
    'weight_loads','declared_loads','footage_loads','temp_min', 'temp_max','temp_precool','temp_precool_val','commodity_laod','pieces_laod','customer_name',
    'customer_address','customer_city','customer_state','customer_zip', 'customer_phone','customer_c_name','customer_fax','b_customer_name','b_customer_address','b_customer_city',
    'b_customer_state','b_customer_zip','b_customer_phone','b_customer_c_name', 'b_customer_fax','shipment_carrier_instruction','shipment_shipper_instruction','shipment_c_mc','shipment_c_dot','shipment_c_carrier',
    'shipment_c_dispatcher','shipment_c_driver_n','shipment_c_driver_p','shipment_c_phone', 'shipment_c_email','payment_status','payment_status_ar','ap_team','ar_invoice','tonu_status','ap_access_status','ap_access_date','ar_access_status','ar_access_date'])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
      }
 



  // this is use for Account Payable data
  public function getapcdata(){
    return $this->hasMany(User::class,'id','carrier_id');
  }

  // Company data start here then all data will be work in AR
  public function getCompany(){
    return $this->hasMany('App\Models\Company','id','companies_id');
  }
  //end

  //these are use for AR data start
  public function shipmentPrice(){
     return $this->hasMany('App\Models\Shipmentrate','shipment_id','id');
  }

  public function companyDetail(){
    return $this->hasOne(Company::class,'id','companies_id');
  }

  public function shipmentPick(){
    return $this->hasMany('App\Models\Shipmentpick','shipment_id','id');
  }

  public function shipmentDrop(){
    return $this->hasMany(Shipmentdrop::class,'shipment_id','id');
  }
  public function carrierget(){
    return $this->hasMany('App\Models\Carriers','id','carrier_id');
  }

  //these are use for ar data end

  public function UserDetail(){
    return $this->hasMany(User::class,'id','user_id');
  }
  public function userdataagency(){
    return $this->hasMany('App\Models\Agency_detail', 'user_id', 'user_id');
  }

  public function invoiceget(){
    return $this->hasMany(Invoices::class,'shipment_id','id');
  }

protected $fillable = [
    'user_id', 'loads_id','carrier_id','companies_id', 'shipment_statue','ref_loads','equipment_loads','full_partial','mode','payment_mode',
    'weight_loads','declared_loads','footage_loads','temp_min', 'temp_max','temp_precool','temp_precool_val','commodity_laod','pieces_laod','customer_name',
    'customer_address','customer_city','customer_state','customer_zip', 'customer_phone','customer_c_name','customer_fax','b_customer_name','b_customer_address','b_customer_city',
    'b_customer_state','b_customer_zip','b_customer_phone','b_customer_c_name', 'b_customer_fax','shipment_carrier_instruction','shipment_shipper_instruction','shipment_c_mc','shipment_c_dot','shipment_c_carrier',
    'shipment_c_dispatcher','shipment_c_driver_n','shipment_c_driver_p','shipment_c_phone', 'shipment_c_email','payment_status','payment_status_ar','ap_team','ar_invoice','tonu_status','ap_access_status','ap_access_date','ar_access_status','ar_access_date'
    
];


  
    
    


}
