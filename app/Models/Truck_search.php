<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;


use Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Truck_search extends Model
{
    use Loggable;
    use HasFactory;
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
            $eventName = 'Truck_search';
        }


        return LogOptions::defaults()
        ->useLogName('truck_search-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Truck Search {$eventName} by $uNameData")
        ->logOnly(['user_id', 'queryId','assetType','equipment_type', 'origin_city','origin_state','origin_lat','origin_long','destination_city','destination_state',
             'destination_lat','destination_long','max_age','max_origin', 'max_destination','earliest_date','full_partial','length','weight','post_date','status'])
        ->logOnlyDirty();
        
      }

      
    protected $fillable = ['user_id', 'queryId','assetType','equipment_type', 'origin_city','origin_state','origin_lat','origin_long','destination_city','destination_state',
             'destination_lat','destination_long','max_age','max_origin', 'max_destination','earliest_date','full_partial','length','weight','post_date','status'];
    

}
