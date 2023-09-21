<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

use App\Models\Shipmentrate;

use Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use App\Models\User;

class Invoices extends Model
{
    use HasFactory;use Loggable;
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
            $eventName = 'Invoices';
        }


         return LogOptions::defaults()
        ->useLogName('Invoices-table')
        ->setDescriptionForEvent(fn(string $eventName) => "Invoices {$eventName} by $uNameData")
        ->logOnly([ 'user_id', 'shipment_id','document_name','invoice_amt','customer_name'])
        ->logOnlyDirty();
      }
      
      
    public function priceget(){
        return $this->hasMany(Shipmentrate::class,'shipment_id','shipment_id');
      }
    
    public function broker(){
        return $this->hasMany(User::class,'id','user_id');
      }

    public function companyget(){
        return $this->hasMany(Company::class,'id','companies_id');
     }



     protected $fillable = [
      'user_id', 'shipment_id','document_name','invoice_amt','customer_name'
    ];

}
