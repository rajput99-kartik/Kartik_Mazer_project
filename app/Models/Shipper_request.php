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

class Shipper_request extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;
    
    protected $table="shipper_request";
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
            $eventName = 'shipper_request';
        }

        return LogOptions::defaults()
        ->useLogName('shipper_request-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Shipper Request {$eventName} by $uNameData")
        ->logOnly(['sender_id','receiver_id', 'companies_id','type','comment','request_date',
        'ed','check_status'])
        ->logOnlyDirty();
    }

    protected $fillable = [
        'sender_id','receiver_id', 'companies_id','type','comment','request_date',
        'ed','check_status'
    ];
    
    
    
}
