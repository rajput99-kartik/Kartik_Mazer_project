<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shipment;
use App\Models\Shipmentrate;
use Haruncpi\LaravelUserActivity\Traits\Loggable;

class AccountReceivable extends Model
{
    use HasFactory;
    use Loggable;

   public function getShipments()
   {
        return $this->hasMany(Shipment::class,'user_id','user_id'); 
   }

   public function getCompany(){
     return $this->belongsTo('App\Models\Company','companies_id','id');
   }

   

}
