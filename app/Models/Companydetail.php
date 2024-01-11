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


class Companydetail extends Model
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
            $eventName = 'companydetails';
        }

        return LogOptions::defaults()
        ->useLogName('companydetails-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Company Detail {$eventName} by ")
        ->logOnly(['id', 'company_name', 'company_legal_name','company_logo', 'contact_person',
        'company_address', 'company_city',  'company_zip_code','company_phone',
        'company_email','company_domain','company_vat',])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
    }
    
    
     
    protected $fillable = [
        'id',
        'company_name', 'company_legal_name','company_logo', 'contact_person',
        'company_address', 'company_city',  'company_zip_code','company_phone',
        'company_email','company_domain','company_vat',
    ];
}
