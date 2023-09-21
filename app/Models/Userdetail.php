<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Models\User;

use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Auth;

class Userdetail extends Model
{
    use Loggable;
    use HasFactory;
    use LogsActivity;
    
    
    protected static $recordEvents = ['created','updated'];
    
    
    public function getActivitylogOptions(): LogOptions
     {
         
        $uid =Auth::id();
        $uName =User::where('id',$uid)->first('name');
        $uNameData =  isset($uName->name) ? $uName->name :Null;

        $lastActivity = Activity::latest()->first();
        $eventName = '';

        $eventName =isset($eventName) ? $eventName : Null  ;
        if(empty($activity)){
            $eventName = 'userdetails';
        }

        return LogOptions::defaults()
        ->useLogName('userdetails-table')
        ->setDescriptionForEvent(fn(string $eventName) => "User Profile {$eventName} by $uNameData")
        ->logOnly(['userid','address','mobile'])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
    }
    
    

    protected $fillable = [
        'userid','address','mobile'
        
    ];
    
    public function Userdetaildata() {
        return $this->belongsTo(User::class, 'userid', 'id');
    }
}
