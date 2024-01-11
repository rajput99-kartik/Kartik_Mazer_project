<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\AccountReceivable;
use App\Models\Company;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Auth;

class AssignAcReceivable extends Model
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
            $eventName = 'assign_ac_receivables';
        }

        return LogOptions::defaults()
        ->useLogName('assign_ac_receivables-table')
        ->setDescriptionForEvent(fn(string $eventName) => "New Assign Account Receivable {$eventName} by $uNameData")
        ->logOnly(['user_id','assign_by','ar_user','assign_agent_to','status'])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
    }
    
    

    protected $fillable = [
        'user_id','assign_by','ar_user','assign_agent_to','status'
        
    ];



   //This is use only assign account receivable
   
   public function arTeamLeader(){
        return $this->hasMany(User::class,'id','ar_user' ); 
   }
   public function arAssignbyuser()  {
     return $this->hasMany(User::class,'id','user_id' ); 
     }
   public function arTeamAgent(){
        return $this->hasMany(User::class,'id','assign_agent_to' ); 
   }
   public function accountShipments(){
     return $this->hasMany(AccountReceivable::class,'user_id', 'assign_agent_to' ); 
   } 

   
   
   
}
