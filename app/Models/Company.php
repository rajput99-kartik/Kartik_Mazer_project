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

class Company extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;
    
    
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
            $eventName = 'companies';
        }

        return LogOptions::defaults()
        ->useLogName('companies-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Shipper Detail {$eventName} by $uNameData")
        ->logOnly(['company_name','encode_title','address','country','shipper_state','shipper_city','shipper_zipcode','phone_number','contact_name','email','commodity',
        'company_date','equipments','temprature','special_instructions','company_comment','acc_email','acc_name','acc_phone','credit_limit','un_secured_limit','trimph_limit',
        'status','assign_status','approved'])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
    }
    
    

    protected $fillable = [
        'company_name','encode_title','address','country','shipper_state','shipper_city','shipper_zipcode','phone_number','contact_name','email','commodity',
        'company_date','equipments','temprature','special_instructions','company_comment','acc_email','acc_name','acc_phone','credit_limit','un_secured_limit','trimph_limit',
        'status','assign_status','approved'
        
    ];
   

    
    
    


}

