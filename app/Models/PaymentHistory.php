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

class PaymentHistory extends Model
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
            $eventName = 'PaymentHistory';
        }


         return LogOptions::defaults()
        ->useLogName('PaymentHistory-table')
        ->setDescriptionForEvent(fn(string $eventName) => "PaymentHistory {$eventName} by $uNameData")
        ->logOnly(['user_id', 'shipment_id','invoice_id','customer_name','document_name','invoice_amt'])
        ->logOnlyDirty();
      }



      protected $fillable = [
        'user_id', 'shipment_id','invoice_id','customer_name','document_name','invoice_amt'
      ];

}
