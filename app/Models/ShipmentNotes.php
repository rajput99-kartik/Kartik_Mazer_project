<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;
use App\Models\Shipmentrate;
use App\Models\Shipmentdrop;
use App\Models\Shipmentpick;
use App\Models\Company;
use App\Models\Invoices;
use App\Models\Agency_detail;
use Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;

class ShipmentNotes extends Model
{
    use HasFactory;
    use Loggable;
    use LogsActivity;
    protected $table = 'shipment_notes';
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
            $eventName = 'shipment notes';
        }
        return LogOptions::defaults()
        ->useLogName('shipment_notes')
        ->setDescriptionForEvent(fn(string $eventName) => "Shipment Notes {$eventName} by $uNameData")
        ->logOnly(['user_id', 'shipment_id','type','description'])
        ->logOnlyDirty();
        //return LogOptions::defaults()->logAll();
      }
      protected $fillable = [
        'user_id', 'shipment_id','type','description'
      ];
}
