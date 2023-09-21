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


class ShipmentDoc extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;
    protected $table = 'shipment_doc';
    
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
            $eventName = 'shipment_doc';
        }

        return LogOptions::defaults()
        ->useLogName('shipment_doc-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Shipment Doc {$eventName} by $uNameData")
        ->logOnly(['shipment_id','user_id','document_name','type','pod'])
        ->logOnlyDirty();
    }
    
    
    protected $fillable = [
        'shipment_id','user_id','document_name','type','pod'
        
    ];
   
}


