<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


use Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;

class EmailSetting extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;
    
    
     public function getActivitylogOptions(): LogOptions
      {

        $uid =Auth::id();
        $uName =User::where('id',$uid)->first('name');
        $uNameData =  isset($uName->name) ? $uName->name :Null;
        
        $lastActivity = Activity::latest()->first();
        $eventName = '';

        $eventName =isset($eventName) ? $eventName : Null  ;
        if(empty($activity)){
            $eventName = 'emailsetting';
        }


        return LogOptions::defaults()
        ->useLogName('emailsetting-table')
        ->setDescriptionForEvent(fn(string $eventName) => "EmailSetting {$eventName} by ")
        ->logOnly(['id',
        'userid',
        'company_email',
        'use_postmark',
        'postmark_api',
        'postmark_email',
        'email_protocol',
        'smtp_host',
        'smtp_user',
        'smtp_password',
        'smtp_port',
        'email_encryption'])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
      }
      
      
      
    protected $fillable = [
        'id',
        'userid',
        'company_email',
        'use_postmark',
        'postmark_api',
        'postmark_email',
        'email_protocol',
        'smtp_host',
        'smtp_user',
        'smtp_password',
        'smtp_port',
        'email_encryption',
    ];
}
