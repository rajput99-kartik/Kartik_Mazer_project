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

class Shipmentrate extends Model
{
    use HasFactory;
    use Loggable;
     use LogsActivity;
    protected $table = 'shipment_c_s_rates';
    
    
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
            $eventName = 'shipment_c_s_rates';
        }

        return LogOptions::defaults()
        ->useLogName('shipment_c_s_rates-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Shipment Price {$eventName} by $uNameData")
        ->logOnly(['shipment_id','user_id','customer_rate_dropdown','carrier_rate_dropdown','unit1_customer','unit2_customer','lh_customer','rate_unit1_carrier','rate_unit2_carrier','lh_carrier','carrier_rate_haul','customer_rate_haul',
        'line_haul1','carrier1','customer1','transportation1','line_haul2','carrier2','customer2','transportation2','line_haul3','carrier3','customer3','transportation3','line_haul4','carrier4','customer4','transportation4','line_haul5','carrier5',
        'customer5','transportation5','line_haul6','carrier6','customer6','transportation6','line_haul7','carrier7','customer7','transportation7','line_haul8','carrier8',
        'customer8','transportation8','carrier_total','customer_total'])
        ->logOnlyDirty();
    }
    
    protected $fillable = [
        'shipment_id','user_id','customer_rate_dropdown','carrier_rate_dropdown','unit1_customer','unit2_customer','lh_customer','rate_unit1_carrier','rate_unit2_carrier','lh_carrier','carrier_rate_haul','customer_rate_haul',
        'line_haul1','carrier1','customer1','transportation1','line_haul2','carrier2','customer2','transportation2','line_haul3','carrier3','customer3','transportation3','line_haul4','carrier4','customer4','transportation4','line_haul5','carrier5',
        'customer5','transportation5','line_haul6','carrier6','customer6','transportation6','line_haul7','carrier7','customer7','transportation7','line_haul8','carrier8',
        'customer8','transportation8','carrier_total','customer_total'
        
        
    ];
}
