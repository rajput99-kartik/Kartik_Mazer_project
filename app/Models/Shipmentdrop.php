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
class Shipmentdrop extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;
    protected $table = 'shipment_lanes_drops';
    
    
    
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
            $eventName = 'shipment_lanes_drops';
        }

        return LogOptions::defaults()
        ->useLogName('shipment_lanes_drops-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Shipment Drop {$eventName} by $uNameData")
        ->logOnly(['shipment_id','user_id','d_name','d_address','d_city','d_state','d_zip','d_countary','d_contact','d_ref','d_phone','d_email',
        'd_ready','d_rtime','d_appt','d_atime','d_appt_note','manage_order'])
        ->logOnlyDirty();
    }
    
    
    protected $fillable = [
        'shipment_id','user_id','d_name','d_address','d_city','d_state','d_zip','d_countary','d_contact','d_ref','d_phone','d_email',
        'd_ready','d_rtime','d_appt','d_atime','d_appt_note','manage_order'
    ];
}
