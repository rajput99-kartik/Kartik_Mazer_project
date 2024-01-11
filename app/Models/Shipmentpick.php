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

class Shipmentpick extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;
    protected $table = 'shipment_lanes_picks';
    
    
    
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
            $eventName = 'shipment_lanes_picks';
        }

        return LogOptions::defaults()
        ->useLogName('shipment_lanes_picks-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Shipment Pickup {$eventName} by $uNameData")
        ->logOnly(['shipment_id','user_id','p_name','p_address','p_city','p_state','p_zip','p_countary','p_contact','p_ref','p_phone','p_email',
        'p_ready','p_rtime','p_appt','p_atime','p_appt_note','manage_order'])
        ->logOnlyDirty();
    }
    
    protected $fillable = [
        'shipment_id','user_id','p_name','p_address','p_city','p_state','p_zip','p_countary','p_contact','p_ref','p_phone','p_email',
        'p_ready','p_rtime','p_appt','p_atime','p_appt_note','manage_order'
    ];
}
