<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AssignAcPayable;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Models\AccountPayable;

use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Auth;
use App\Models\User;

class AssignAcPayable extends Model
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
            $eventName = 'assign_ac_payables';
        }

        return LogOptions::defaults()
        ->useLogName('assign_ac_payables-table')
        ->setDescriptionForEvent(fn(string $eventName) => "New Assign Account Payable {$eventName} by $uNameData")
        ->logOnly(['user_id','assign_by','ap_user','assign_agent_to','status'])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
    }
    
    

    protected $fillable = [
        'user_id','assign_by','ap_user','assign_agent_to','status'
        
    ];



    

    //This is use only assign account payable
    public function apassignbyuser()  {
         return $this->hasMany('App\Models\User','id','user_id' ); 
    }
    public function apTeamLeader(){
         return $this->hasMany('App\Models\User','id','ap_user' ); 
    }
    public function apTeamAgent(){
         return $this->hasMany('App\Models\User','id','assign_agent_to' ); 
    }
    //This is use only assign account payable End

    public function getAccountPayable(){
     return $this->hasMany('App\Models\AccountsPayable','user_id','assign_agent_to' ); 
     }

}
