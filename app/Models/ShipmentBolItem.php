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

class ShipmentBolItem extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;

    
    public function getActivitylogOptions(): LogOptions
    {

      $uid =Auth::id();
      $uName =User::where('id',$uid)->first('name');
      $uNameData =  isset($uName->name) ? $uName->name :Null;
      
      $lastActivity = Activity::latest()->first();
      $eventName = '';

      $eventName =isset($eventName) ? $eventName : Null  ;
      if(empty($activity)){
          $eventName = 'ShipmentBolItem';
      }

      return LogOptions::defaults()
      ->useLogName('shipment_bol_items')
      ->setDescriptionForEvent(fn(string $eventName) => "ShipmentBolItem {$eventName} by $uNameData")
      ->logOnly(['consignee','shipment_bolid','shipment_id','user_id','ed','ofpieces','descriptions',
        'weight','type','nmfc','hazmat','productclass','notes'])
      ->logOnlyDirty();
    }

    protected $fillable = [
        'consignee','shipment_bolid','shipment_id','user_id','ed','ofpieces','descriptions','weight','type','nmfc','hazmat','productclass','notes',
    ];
}
