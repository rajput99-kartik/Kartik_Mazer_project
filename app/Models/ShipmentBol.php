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



class ShipmentBol extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;

    public $table = "shipment_bols";


    public function getActivitylogOptions(): LogOptions
    {

      $uid =Auth::id();
      $uName =User::where('id',$uid)->first('name');
      $uNameData =  isset($uName->name) ? $uName->name :Null;
      
      $lastActivity = Activity::latest()->first();
      $eventName = '';

      $eventName =isset($eventName) ? $eventName : Null  ;
        if(empty($activity)){
          $eventName = 'ShipmentBol';
        }



        
       return LogOptions::defaults()
      ->useLogName('shipment_bols')
      ->setDescriptionForEvent(fn(string $eventName) => "ShipmentBol {$eventName} by $uNameData")
      ->logOnly(['shipment_id','user_id','ed','ofpieces','descriptions','weight','type','nmfc','hazmat','productclass','notes','shippickup_address','shipdrop_address'])
      ->logOnlyDirty();
    }

    
    protected $fillable = [
        'shipment_id','user_id','ed','ofpieces','descriptions','weight','type','nmfc','hazmat','productclass','notes','shippickup_address','shipdrop_address'
    ];

}
