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


class AssignUserTeam extends Model
{
    use HasFactory;
    use Loggable;
     use LogsActivity;
    
    protected $table="assign_user_teams";
    
     protected static $recordEvents = ['created','updated','deleted'];
    
    
    public function getActivitylogOptions(): LogOptions{
        $uid =Auth::id();
        $uName =User::where('id',$uid)->first('name');
        $uNameData =  isset($uName->name) ? $uName->name :Null;

        $lastActivity = Activity::latest()->first();
        $eventName = '';

        $eventName =isset($eventName) ? $eventName : Null  ;
        if(empty($activity)){
            $eventName = 'companies';
        }

        return LogOptions::defaults()
        ->useLogName('assign_user_teams-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Agent {$eventName} by $uNameData")
        ->logOnly(['user_id', 'assignby_id','assignto_id', 'team_role','user_name', 'ed','deleted_at'])
        ->logOnlyDirty();
    }
    
    

    protected $fillable = [
        'user_id', 'assignby_id','assignto_id', 'team_role','user_name', 'ed','deleted_at'
    ];
    
    
    
    public function getagent(){
        return $this->hasMany('App\Models\User','id','user_id');
    }
    
}
