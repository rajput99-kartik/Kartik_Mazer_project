<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;



use Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;


class Dat extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;
    protected $table="dat_login";



 public function getActivitylogOptions(): LogOptions
      {

        $uid =Auth::id();
        $uName =User::where('id',$uid)->first('name');
        $uNameData =  isset($uName->name) ? $uName->name :Null;
        
        $lastActivity = Activity::latest()->first();
        $eventName = '';

        $eventName =isset($eventName) ? $eventName : Null  ;
        if(empty($activity)){
            $eventName = 'dat_login';
        }

        return LogOptions::defaults()
        ->useLogName('dat_login-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Dat {$eventName} by ")
        ->logOnly(['name', 'Dat'])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
      }
      
	protected $fillable = [
        'name', 'Dat'
    ];
}
