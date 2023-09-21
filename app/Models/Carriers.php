<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Auth;
use App\Models\User;
use Spatie\Activitylog\Facades\LogBatch;


class Carriers extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;
    
    protected static $recordEvents = ['created','updated','deleted'];
     
   
   public function getActivitylogOptions(): LogOptions{
        $uid =Auth::id();
        $uName =User::where('id',$uid)->first('name');
        $uNameData =  isset($uName->name) ? $uName->name :Null;

        return LogOptions::defaults()
        ->useLogName('carriers-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Carrier {$eventName} by $uNameData") 
        ->logOnly(['user_id', 'c_company_name','carrier_comment','carrier_rating','carrier_country','nsc_no','mc_no','dot_no','carrier_city','carrier_city_main',
        'carrier_fax','carrier_state','carrier_zip','dispatcher','equipments','carrier_rates','phone_no','email','cargo','cargo_amount','cargo_expires',
        'cargo_deduct','cargo_deduct_amount','cargo_deduct_expires','liability','liability_amount','liability_expires','trailer_amount','trailer_expires','gen_liab_amount','gen_liab_expires',
        'reefer_bkdn','reefer_brk_deduct','contact_auth','common_auth','d_name','d_phone','safety','tax_id','status'])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
    }
    
    
    protected $fillable = [
        'user_id', 'c_company_name','carrier_comment','carrier_rating','carrier_country','nsc_no','mc_no','dot_no','carrier_city','carrier_city_main',
        'carrier_fax','carrier_state','carrier_zip','dispatcher','equipments','carrier_rates','phone_no','email','cargo','cargo_amount','cargo_expires',
        'cargo_deduct','cargo_deduct_amount','cargo_deduct_expires','liability','liability_amount','liability_expires','trailer_amount','trailer_expires','gen_liab_amount','gen_liab_expires',
        'reefer_bkdn','reefer_brk_deduct','contact_auth','common_auth','d_name','d_phone','safety','tax_id','status'
    ];
    
    
    
}
