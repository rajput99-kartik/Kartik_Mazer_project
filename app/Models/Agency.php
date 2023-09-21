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
class Agency extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;


    //protected static $logAttributes = ['name','agencies_name','p_email'];
    protected static $recordEvents = ['created','updated','deleted'];
    //protected $fillable = ['name','agencies_name','p_email'];

    public function getActivitylogOptions(): LogOptions
     {
         
        $uid =Auth::id();
        $uName =User::where('id',$uid)->first('name');
        $uNameData =  isset($uName->name) ? $uName->name :Null;

        $lastActivity = Activity::latest()->first();
        $eventName = '';

        $eventName =isset($eventName) ? $eventName : Null  ;
        if(empty($activity)){
            $eventName = 'agencies';
        }


        return LogOptions::defaults()
        ->useLogName('Agency Table')
        ->setDescriptionForEvent(fn(string $eventName) => "Agency Detail {$eventName} by $uNameData")
        ->logOnly(['name','agencies_name','p_email','agencies_phone','agencies_email'])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
    }

    protected $fillable = [
        'name','agencies_name','p_email','agencies_phone','agencies_email'
        
    ];
   

        


        public function office(){
            return $this->hasMany('App\Models\Agency_detail', 'agency_id');
        }
        

}
