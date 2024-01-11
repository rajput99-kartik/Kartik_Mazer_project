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

class CarrierRequest extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;
    
     protected static $recordEvents = ['created','updated','deleted'];
     
      public function getActivitylogOptions(): LogOptions{
        $uid =Auth::id();
        $uName =User::where('id',$uid)->first('name');
        $uNameData =  isset($uName->name) ? $uName->name :Null;

        $lastActivity = Activity::latest()->first();
        $eventName = '';

        $eventName =isset($eventName) ? $eventName : Null  ;
        if(empty($activity)){
            $eventName = 'carrier_requests';
        }

        return LogOptions::defaults()
        ->useLogName('carrier_requests-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Carrier Request {$eventName} by $uNameData")
        ->logOnly(['sender_id', 'receiver_id','carrier_id','mc_no','dot_no','comment','request_date','request_type','status','check_status'])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
    }
    

	protected $fillable = [
        'sender_id', 'receiver_id','carrier_id','mc_no','dot_no','comment','request_date','request_type','status','check_status'
    ];
    
    
}
