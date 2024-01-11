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

class Carrier_account extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;
	
    protected $table="carrier_account";
     protected static $recordEvents = ['created','updated','deleted'];
    
    public function getActivitylogOptions(): LogOptions{
        $uid =Auth::id();
        $uName =User::where('id',$uid)->first('name');
        $uNameData =  isset($uName->name) ? $uName->name :Null;

        $lastActivity = Activity::latest()->first();
        $eventName = '';

        $eventName =isset($eventName) ? $eventName : Null  ;
        if(empty($activity)){
            $eventName = 'carrier_account';
        }

        return LogOptions::defaults()
        ->useLogName('carrier_account-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Carrier Account Detail {$eventName} by $uNameData")
        ->logOnly(['carrier_id', 'payto','f_noa','f_comp_name','f_address','f_city','f_state','f_zip','f_phone','f_fax',
        'f_email','c_comp_name','c_address','c_city','c_state','c_zip','c_phone','c_fax','c_email','a_comp_name','bank_name',
        'account_number','b_account_type','ach_routing_number','routing_number','ach_b_country','a_address','a_city','a_state','a_zip','w_bank_name',
        'w_account_number','wire_b_account_type','wire_routing_number','swift_code','wire_b_country','payment_mode','cc_comment','primery_method','w9_id'])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
    }
    

	protected $fillable = [
        'carrier_id', 'payto','f_noa','f_comp_name','f_address','f_city','f_state','f_zip','f_phone','f_fax',
        'f_email','c_comp_name','c_address','c_city','c_state','c_zip','c_phone','c_fax','c_email','a_comp_name',
        'bank_name','account_number','b_account_type','ach_routing_number','routing_number','ach_b_country','a_address',
        'a_city','a_state','a_zip','w_bank_name','w_account_number','wire_b_account_type','wire_routing_number','swift_code',
        'wire_b_country','payment_mode','cc_comment','primery_method','w9_id'
    ];
	
}